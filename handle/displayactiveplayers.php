<script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js'></script>
<script>
  var socket=io.connect("http://localhost:3001");
  socket.on('new_order',function (data){
    console.log(data);
    cookie_data="temp_user="+data[0]+"; expires=0; path=/";
    playcode_data="temp_code="+data[1]+"; expires=0; path=/";
    document.cookie=playcode_data;
  })
</script>