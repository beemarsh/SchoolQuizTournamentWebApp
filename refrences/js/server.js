var socket=io.connect("http://localhost:3001",{});
user_id=getCookie('node_id');
user_Code=getCookie('node_code');
arrData=[user_id,user_Code];
socket.emit("new_order",arrData);
document.addEventListener('click', function(){
  user_id=getCookie('node_id');
  suser_Code=getCookie('node_code');
  arrData=[user_id,user_Code];
  socket.emit("new_order",arrData);
});
socket.on('last_ord',function(data){
    console.log(data);
    for(i=0;i<data.length;i++){
      // document.querySelector('#this_data').innerHTML+=data[0][i]['name']+data[0][i]['email']+data[0][i]['pic_dir'];      
    }
})

//  Getting values from cookie using this function
 function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

// Disable inspection
// document.onkeydown = function(e) {
//     if(event.keyCode == 123) {
//        return false;
//     }
//     if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
//        return false;
//     }
//     if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
//        return false;
//     }
//     if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
//        return false;
//     }
//   }
// // ******************
// // Promting user to enter password
// user_ask();
// function user_ask(){
//     var user=prompt('Enter username');
//     if(user!=='username'){
//         user_ask();
//     }else{
//         var pw=prompt('Enter password');
//         if(pw!=='password'){
//             pw_ask();
//         }
//     }
// }
// function pw_ask(){
//     var pw=prompt('Enter password');
//     if(pw!=='password'){
//         pw_ask();
//     }
// }
// ******************
// ireed();
// function ireed(){
//     setInterval(contajxrqst,2000);
// }
// function contajxrqst(){
//         $.ajax({
//             type:'POST',
//             url:'handle/servercontrol',
//             cache:false,
//             success:function(html){
//                 console.log(html);
//         }
//         })
//         return false;
//     }