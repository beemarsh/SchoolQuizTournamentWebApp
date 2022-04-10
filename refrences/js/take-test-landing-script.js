document.addEventListener("DOMContentLoaded",function(){
	let dat = { 
		noOfSelected : 0
	}
    document.querySelector(".done-bttn").onclick =  function(){
		
	}
	document.querySelector("select[name=level]").addEventListener("click",function(){
		ab = this.value;
		if(ab=="easy"){
			document.getElementById("duration").innerText = "20s";
		}else if(ab=="medium"){
			  document.getElementById("duration").innerText = "15s";
			}else{
				document.getElementById("duration").innerText = "8s";
		}
	})
	var zz = document.querySelectorAll(".btns");
	for(i=0;i<zz.length;i++){
	zz[i].onclick = function(){
	if( document.getElementById("mixed-btns").className.indexOf("selected-btn") == -1 && this.className.indexOf("selected-btn")==-1){
			this.className +="selected-btn ";
			dat.noOfSelected++;
			document.querySelector(".done-bttn").style.display = "block";
		} else {
			this.className ="btns ";
			dat.noOfSelected--;
			document.querySelector(".done-bttn").style.display = "none";
		}
		if (document.getElementById("mixed-btns").className.indexOf("selected-btn") != -1){
			document.querySelector(".done-bttn").style.display = "block";
		}
	}
}
document.querySelector(".done-bttn").onclick = function(){
	aa = document.querySelectorAll(".selected-btn")
		b = "";
		for(i=0;i<aa.length;i++){
			b += aa[i].innerText + ",";
		}
		b = b.slice(0, -1);
		document.getElementById("field_select").innerText = b;
		document.querySelector("input[name=field_select]").value = b;
		document.getElementById("duration").innerText = "20s";
		document.querySelector("#cover").style.display = "block";
}


	document.getElementById("cancel-butt").addEventListener("click",function(){
		document.querySelector("#cover").style.display = "none";
	})
	// document.querySelector('#noticeBar').style.display='none';//Make The INfo Bottom bar Hide at First
	// document.querySelector('#playerInfo').style.display='none';
	document.querySelector("#mixed-btns").addEventListener("click",()=>{
		if(document.querySelector("#mixed-btns").className.indexOf("selected-btn") != -1){
		document.querySelector(".done-bttn").style.display = "block";
		}
		a = document.querySelectorAll(".selected-btn")
		a.forEach(e => {
			if(!e.id){
				e.className = "btns "
			}
		});
	})
})
function c(){
	document.getElementById("Done-select").click();
	return "True"
}

