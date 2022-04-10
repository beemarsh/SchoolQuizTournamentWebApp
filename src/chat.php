<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use McryptCipher;
databaseTablesEmptier();//Empty Database For the first Time server starts
class Chat implements MessageComponentInterface {
    protected $clients;
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }
    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        // echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        //     , $from->resourceId,$msg, $numRecv, $numRecv == 1 ? '' : 's');
        $tocheckMsg=json_decode($msg);
        if(is_array($tocheckMsg)==1 && count($tocheckMsg)==3 && $tocheckMsg[2]=='112battling' || count($tocheckMsg)==4 ){
            if(count($tocheckMsg)==3){
                    insertHimActiveInBattleDB($from->resourceId,$tocheckMsg,0);//If client sends Request frgom Multiplplay
            }
            if(count($tocheckMsg)==4){
                    insertHimActiveInBattleDB($from->resourceId,$tocheckMsg,1);//IF admin sends Rerquest from MultiplePlay
            }
        }elseif(is_array($tocheckMsg)==1 && count($tocheckMsg)==3 && $tocheckMsg[0]=='112score'){//To display all the scores of Ther users Active on Here
            $storeUsersData=sendAllUsersScore($from->resourceId,$tocheckMsg);
            foreach ($this->clients as $client){
                if ($from == $client) {
                    $client->send(json_encode($storeUsersData));
                }
            }
        }else{
        switch($msg){
            case '112PLAYS'://IF user says to Only Get SQL DATAS
                $uPlayList=playerShower($from->resourceId);                
                foreach ($this->clients as $client){
                    if ($from == $client) {
                        $client->send($uPlayList);
                    }
                }
            break;
            case '112stop': //IF user pressed stop searching set ready=1 in JOINTABLE
                stopUserAdminActive($from->resourceId);
            break;
            case '112proceed':  //IF user PRoceeds To QUiz FIELD SELECT
                userWantToProceed($from->resourceId);
            break;
            case '112start':                
                $checkIfAdminStarted=adminStartedGame($from->resourceId);//If Admin clicks I  submit QuizField
                foreach ($this->clients as $clientOnThisCode){
                    if(in_array($clientOnThisCode->resourceId,$checkIfAdminStarted))
                        $clientOnThisCode->send('112goPlay');
                }
                break;
            case '112checkAdmClient'://If Bychance Admin Turns Off the Game At last Stage when The game is About to Load in multiplayer
                $isAdmAlive=checkIfAdminIsAliveForClientLastProcess($from->resourceId);
                if($isAdmAlive!==false){
                    echo 'Sorry !Your user has gone offline';
                }
            break;
            default:
                $myDATA=json_decode($msg);
                sql_processing($myDATA);//After user sends data to save data to SQL
                ratchetIDSQL($myDATA,$from->resourceId);
        }
    }

    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $listOfusersTobeDisconnected=searchInbattleField($conn->resourceId);
        if($listOfusersTobeDisconnected!==false){//Disconnect all clients if admin disconnedcted
            echo $listOfusersTobeDisconnected[0];
            foreach ($this->clients as $client){
                if (in_array($client->resourceId,$listOfusersTobeDisconnected)==1){
                    $client->close();
                }
            }
        }
        $this->clients->detach($conn);
        removeIfDisconnectedFromDB($conn->resourceId);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
    function sql_processing($datas){
        // DB STUFFS
        $sql_connect=mysqli_connect('localhost','root','');
        $db_connect=mysqli_select_db($sql_connect,'user_record');
        mysqli_query($sql_connect,$db_connect);
        //
        // check if admin
        $query_for_multiplay="SELECT * FROM multiplay WHERE id=$datas[1] AND code='$datas[0]' AND status=1";
        $query_for_multiplay_DB=mysqli_query($sql_connect,$query_for_multiplay);
        $no_OFROWS=mysqli_num_rows($query_for_multiplay_DB);
        // 
        $query_TO_PUT="SELECT * FROM jointable WHERE id='$datas[1]'";
        $query_TO_PUT_DB=mysqli_query($sql_connect,$query_TO_PUT);
        $no_of_rows=mysqli_num_rows($query_TO_PUT_DB);
        if($no_of_rows==1 && $no_OFROWS==1){
            $new_colQuery="UPDATE jointable SET code=$datas[0],status=2,tempcode=$datas[0] WHERE id=$datas[1]";
        }else if($no_of_rows==1 && $no_OFROWS!==1){
            $new_colQuery="UPDATE jointable SET code=$datas[0],status=1,tempcode=$datas[0] WHERE id=$datas[1]";
        }else if($no_of_rows!==1 && $no_OFROWS==1){
            $new_colQuery="INSERT INTO `jointable` (`id`, `code`, `status`, `tempcode`) VALUES ($datas[1],$datas[0],2,$datas[0])";    
        }else{
            $new_colQuery="INSERT INTO `jointable` (`id`, `code`, `status`, `tempcode`) VALUES ($datas[1],$datas[0],1,$datas[0])";    
        }
        mysqli_query($sql_connect,$new_colQuery);
    }
    function ratchetIDSQL($Ud,$rid){
                // DB STUFFS
                $sql_connect1=mysqli_connect('localhost','root','');
                $db_connect1=mysqli_select_db($sql_connect1,'user_record');
                mysqli_query($sql_connect1,$db_connect1);
                //
                // check if admin
        // Put user existence in RATCHET databaseSQL
        $sql1="SELECT * FROM ratchet WHERE id=$Ud[1]";
        $sql1_query=mysqli_query($sql_connect1,$sql1);
        $if_Sel=mysqli_num_rows($sql1_query);
        // Check if ID exists in Ratchet
        if($if_Sel!==1){
            $sql2="INSERT INTO `ratchet` (`id`, `resId`, `code`) VALUES ($Ud[1],$rid,$Ud[0])";
        }else{
            $sql2="UPDATE ratchet SET resId=$rid, code=$Ud[0] WHERE id=$Ud[1]";
        }
        mysqli_query($sql_connect1,$sql2);
        // 
        // Now Make User Resourcely active in JOINTABLE SQL
        $sql2="UPDATE jointable SET resId=$rid WHERE id=$Ud[1] AND code=$Ud[0]";
        if(!mysqli_query($sql_connect1,$sql2)){
            echo "Could'nt add User Resource ID in Jointable";
        }
        // 
    }

    function removeIfDisconnectedFromDB($uSiD){
        // DB STUFFS
        $sql_connect2=mysqli_connect('localhost','root','');
        $db_connect2=mysqli_select_db($sql_connect2,'user_record');
        mysqli_query($sql_connect2,$db_connect2);
        //
        $sql1="DELETE FROM ratchet WHERE resId='$uSiD'";
        if(!mysqli_query($sql_connect2,$sql1)){
            echo "Couldn't Delete From DB when User disconnected";
        }
        $sql2="UPDATE jointable SET status=0 WHERE resId=$uSiD";
        if(!mysqli_query($sql_connect2,$sql2)){
            echo "Couldn't make User Inactive status In Jointable";
        }
        $sql3="SELECT * FROM jointable WHERE resId=$uSiD";
        $sql3_Query=mysqli_query($sql_connect2,$sql3);
        $currAdm=mysqli_fetch_assoc($sql3_Query);
        $sql4="DELETE FROM multiplay WHERE id=$currAdm[id]";
        mysqli_query($sql_connect2,$sql4);
        $sql5="DELETE FROM battle_active WHERE resId=$uSiD";//Remove from Battle Field too
        mysqli_query($sql_connect2,$sql5);
    }

// User Players Displaying Mainer 
    function playerShower($Pid){
        // DB STUFFS
        $sql_connect3=mysqli_connect('localhost','root','');
        $db_connect3=mysqli_select_db($sql_connect3,'user_record');
        mysqli_query($sql_connect3,$db_connect3);
        //
        // Make Admin Available When Continue Searching
        $userIDFind="SELECT * FROM ratchet WHERE resId=$Pid";//First Searching UserID from PlayerID in ratchet
        $userIDFindFetch=mysqli_query($sql_connect3,$userIDFind);
        $userIDstore=mysqli_fetch_assoc($userIDFindFetch);
        $RealUserCODEFound=$userIDstore['code'];
        $sqlForReady="UPDATE multiplay SET ready=0 WHERE code=$RealUserCODEFound";
        mysqli_query($sql_connect3,$sqlForReady);
        $sql1="SELECT code FROM ratchet WHERE resId=$Pid";
        $sql1_query=mysqli_query($sql_connect3,$sql1);
        $ROWCHECK=mysqli_num_rows($sql1_query);
        if($ROWCHECK==0){
            echo 'User doesnt exist While PlayerShower';
        }
        $player=mysqli_fetch_assoc($sql1_query);
        $playerCode=$player['code'];        
        if(checkAdminStatus($playerCode)==true){
            $faKeDatA=['112off'];
            $jsonified=json_encode($faKeDatA);
            echo 'ADmin IS OFF';
            return $jsonified;
        }else{
        $sql2="SELECT * FROM jointable WHERE code=$playerCode AND status=2 OR status=1";
        $empArr=[];
        $sql2_query=mysqli_query($sql_connect3,$sql2);
        // Making IDS LIST
        while($fetchData=mysqli_fetch_assoc($sql2_query)){
            $makeData=[$fetchData['id'],$fetchData['status']];
            array_push($empArr,$makeData);
        }
        // Making Players List Array
        $playerInfo=[];
        for($i=0;$i<sizeof($empArr);$i++){
            $P_ID=$empArr[$i][0];
            $sql3="SELECT * FROM account WHERE id=$P_ID";
            $sql3Query=mysqli_query($sql_connect3,$sql3);
            $sql3Store=mysqli_fetch_assoc($sql3Query);
            $uInFo=[$sql3Store['username'],$sql3Store['name'],$sql3Store['pic_dir']];
            array_push($playerInfo,$uInFo);
        }
        $playerInfoObj=json_encode($playerInfo);
        return $playerInfoObj;
    }
    }

// When User wants to Stop other Players from Adding
function stopUserAdminActive($id_UserWhoStop){
    // DB STUFFS
    $sql_connect4=mysqli_connect('localhost','root','');
    $db_connect4=mysqli_select_db($sql_connect4,'user_record');
    mysqli_query($sql_connect4,$db_connect4);
    //
    $userIDFind="SELECT * FROM ratchet WHERE resId=$id_UserWhoStop";//First Searching UserID from PlayerID in ratchet
    $userIDFindFetch=mysqli_query($sql_connect4,$userIDFind);
    $userIDstore=mysqli_fetch_assoc($userIDFindFetch);
    $RealUserIDFound=$userIDstore['id'];
    $sql1="UPDATE multiplay SET ready=1 WHERE id=$RealUserIDFound";
    mysqli_query($sql_connect4,$sql1);
}

//When user wants to proceed
function userWantToProceed($userKoId){
    // DB STUFFS
    $sql_connect5=mysqli_connect('localhost','root','');
    $db_connect5=mysqli_select_db($sql_connect5,'user_record');
    mysqli_query($sql_connect5,$db_connect5);
    //
    $sql1="SELECT * FROM ratchet WHERE resId=$userKoId";
    $sql1_query=mysqli_query($sql_connect5,$sql1);
    $sql1Store=mysqli_fetch_assoc($sql1_query);
    $USERCODE=$sql1Store['code'];
    $sql2="UPDATE jointable SET ready=1 WHERE code=$USERCODE";
    mysqli_query($sql_connect5,$sql2);
}

//Check if Admin Is disconnected
function checkAdminStatus($userCode){
        // DB STUFFS
        $sql_connect6=mysqli_connect('localhost','root','');
        $db_connect6=mysqli_select_db($sql_connect6,'user_record');
        mysqli_query($sql_connect6,$db_connect6);
        //
        $sql1="SELECT * FROM multiplay WHERE code=$userCode";
        $storeSQL1=mysqli_query($sql_connect6,$sql1);
        $SQL1ROWS=mysqli_num_rows($storeSQL1);
        $SQL1_DATA_FETCH=mysqli_fetch_assoc($storeSQL1);
        if($SQL1ROWS==0 || $SQL1_DATA_FETCH['status']==0){//If admin becomes Offline Turn all clients off
            $sql2="UPDATE jointable SET status=0,ready=0 WHERE code=$userCode";
            mysqli_query($sql_connect6,$sql2);
            return true;
        }
}

function adminStartedGame($adminIdWhoStarted){//When ADmin clicks on Submit and Starts the Game
    // DB STUFFS
    $sql_connect7=mysqli_connect('localhost','root','');
    $db_connect7=mysqli_select_db($sql_connect7,'user_record');
    mysqli_query($sql_connect7,$db_connect7);
    //
    $sql1="SELECT * FROM ratchet WHERE resId=$adminIdWhoStarted";//FInding admin id and Code
    $sql1_store=mysqli_query($sql_connect7,$sql1);
    $sql1_store_fetch=mysqli_fetch_assoc($sql1_store);
    $admId=$sql1_store_fetch['id'];
    $hostCode=$sql1_store_fetch['code'];//****** */

    $sql2="UPDATE multiplay SET playReady=1 WHERE id=$admId AND code=$hostCode";//Making DB playReady=1 When Admin starts the QUiz
    $sql3="UPDATE jointable SET playing=1 WHERE code=$hostCode";//Making DB playing=1 When Admin starts the QUiz
    mysqli_query($sql_connect7,$sql2);
    mysqli_query($sql_connect7,$sql3);
    $getClientsListToSendReloader=getClientsId($hostCode);
    return $getClientsListToSendReloader;
}

function getClientsId($currAdminCode){//Get clients ID currently active To send Them message to Get to NExt Page when Admin Submits Quiz Field
    // DB STUFFS
    $sql_connect8=mysqli_connect('localhost','root','');
    $db_connect8=mysqli_select_db($sql_connect8,'user_record');
    mysqli_query($sql_connect8,$db_connect8);
    //
    $sql1="SELECT * FROM ratchet WHERE code=$currAdminCode";
    $sql1_query=mysqli_query($sql_connect8,$sql1);
    $empArray=[];
    while($sql1Store=mysqli_fetch_assoc($sql1_query)){
        $storeDatasHere=$sql1Store['resId'];
        array_push($empArray,$storeDatasHere);
        $userId=$sql1Store['id'];
        // $sql2="INSERT INTO score_multiplay(id,code)VALUES($userId,$currAdminCode)";
        // mysqli_query($sql_connect8,$sql2);
    }
    return $empArray;
}

//If Bychance Admin Turns Off the Game At last Stage when The game is About to Load in multiplayer
function checkIfAdminIsAliveForClientLastProcess($userKoResourceId){
        // DB STUFFS
        $sql_connect9=mysqli_connect('localhost','root','');
        $db_connect9=mysqli_select_db($sql_connect9,'user_record');
        mysqli_query($sql_connect9,$db_connect9);
        //
        $sql1="SELECT * FROM ratchet WHERE resId=$userKoResourceId";
        $sqlQuery=mysqli_query($sql_connect9,$sql1);
        $sql1QueryFetch=mysqli_fetch_assoc($sql1_query);
        $userCode=$sql1QueryFetch['code'];
        $usersArrayList=getClientsId($userCode);//Get clients ID currently active To check if Admin left server
        $sql2="SELECT * FROM multiplay WHERE code=$userKoResourceId";
        $sql2Query=mysqli_query($sql_connect9,$sql2);
        $sql2QueryFetch=mysqli_fetch_assoc($sql_connect9);
        $noOfRows_sql2=mysqli_num_rows($sql2Query);
        if($noOfRows_sql2==0 || $sql2QueryFetch['status']==0){
            return $usersArrayList;
        }else{
            return false;
        }
}

//If User first Goes TO anotther Page then First this function is executed
function insertHimActiveInBattleDB($nextPageResId,$userArrayDetails,$whoIsThis){
    // DB STUFFS
    $sql_connect10=mysqli_connect('localhost','root','');
    $db_connect10=mysqli_select_db($sql_connect10,'user_record');
    mysqli_query($sql_connect10,$db_connect10);
    //
    $userID=$userArrayDetails[0];
    $hostcode=$userArrayDetails[1];
    if($whoIsThis==0){//Means if sender is Client Player
        $sql1="INSERT INTO `battle_active` (`id`, `code`, `resId`) VALUES ('$userID', '$hostcode', '$nextPageResId')";
    }else{
        $sql1="INSERT INTO `battle_active` (`id`, `code`, `resId`, `adm_stat`) VALUES ('$userID', '$hostcode', '$nextPageResId',1)";
    }
    mysqli_query($sql_connect10,$sql1);
}

function sendAllUsersScore($userResId,$userMessage){//If users scores of everyone
        // DB STUFFS
        $sql_connect11=mysqli_connect('localhost','root','');
        $db_connect11=mysqli_select_db($sql_connect11,'user_record');
        mysqli_query($sql_connect11,$db_connect11);
        //
        $userId=$userMessage[2];
        $userHostcode=$userMessage[1];
        $sql1="SELECT * FROM battle_active WHERE code=$userHostcode";
        $sql1query=mysqli_query($sql_connect11,$sql1);
        $emptyArray=[];
        while($sql1fetch=mysqli_fetch_assoc($sql1query)){
            $thisData=[$sql1fetch['id'],$sql1fetch['score']];
            array_push($emptyArray,$thisData);
        }
        for($i=0;$i<count($emptyArray);$i++){
            $thisUser=$emptyArray[$i][0];
            $SQL2="SELECT * FROM account WHERE id=$thisUser";
            $sql2QueryStore=mysqli_query($sql_connect11,$SQL2);
            $sql2fetch=mysqli_fetch_assoc($sql2QueryStore);
            $username=$sql2fetch['name'];
            array_push($emptyArray[$i],$username);
        }
        return $emptyArray;
}

function searchInbattleField($usrResourceId){//Disconnect cliwnwts if admin disconnects
    // DB STUFFS
    $sql_connect12=mysqli_connect('localhost','root','');
    $db_connect12=mysqli_select_db($sql_connect12,'user_record');
    mysqli_query($sql_connect12,$db_connect12);
    //
    $sql1="SELECT * FROM battle_active WHERE resId=$usrResourceId AND adm_stat=1";
    $sql1store=mysqli_query($sql_connect12,$sql1);
    if(mysqli_num_rows($sql1store)==1){
        $varForArr=[];
        $sql1fetch=mysqli_fetch_assoc($sql1store);
        $userCodeHost=$sql1fetch['code'];
        $sql2="SELECT * FROM battle_active WHERE code=$userCodeHost";
        $sql2Query=mysqli_query($sql_connect12,$sql2);
        while($sqlFetch2=mysqli_fetch_assoc($sql2Query)){
            $ThisMansResourceID=$sqlFetch2['resId'];
            array_push($varForArr,$ThisMansResourceID);
        }
        return $varForArr;
    }else{
        return false;
    }

}
function databaseTablesEmptier(){
    // DB STUFFS
    $sql_connect13=mysqli_connect('localhost','root','');
    $db_connect13=mysqli_select_db($sql_connect13,'user_record');
    mysqli_query($sql_connect13,$db_connect13);
    //
    $sql1="TRUNCATE `ratchet`";
    mysqli_query($sql_connect13,$sql1);
    $sql2="TRUNCATE `multiplay`";
    mysqli_query($sql_connect13,$sql2);
    $sql3="TRUNCATE `jointable`";
    mysqli_query($sql_connect13,$sql3);
    $sql4="TRUNCATE `battle_active`";
    mysqli_query($sql_connect13,$sql4);
    echo 'Database Emptied  All clear To Go';
}