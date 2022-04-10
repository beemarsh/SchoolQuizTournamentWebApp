document.addEventListener('DOMContentLoaded', function(){
    let closeButt = document.querySelectorAll(".close-section")
    for(i=0;i < closeButt.length; i++){
        closeButt[i].addEventListener("click", function(){
        document.querySelector("#cover").style.display = "none";
        this.parentElement.style.display = "none";
        })
    }
    document.querySelector(".alert-button").onclick= function(){
        document.querySelector('.alert-container').style.display='none';        
    }
});
function showError(HowToDo){
    document.querySelector('.alert-container').style.display='flex';
    if(HowToDo==1){//If Multiplayer Click
        document.querySelector('#errDisplay').innerHTML="Register an account To Play Multiplayer !!!";
    }else{//If Quiz Clicked
        document.querySelector('#errDisplay').innerHTML="Register an account To Manage Quiz !!!";
    }
}