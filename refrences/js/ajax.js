function getname(str){
    if (window.XMLHttpRequest) {        
        xmlhttp=new XMLHttpRequest();
      } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function(){
          if(this.readyState==4 && this.status==200){
            if(str.length==0){
              document.getElementsByClassName('search-result')[0].innerHTML='';
            }else{
              document.getElementsByClassName('search-result')[0].innerHTML=xmlhttp.responseText;
            }
          }
      }
    xmlhttp.open("GET","handle/searchopp.php?text="+str);
    xmlhttp.send();


}
