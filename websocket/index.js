var app     = require('express')();
var http    = require('http').Server(app);
var io      = require('socket.io')(3000);


app.get('/', function(req, res){    
   io.emit('message', { for: 'everyone' });
   res.send("enviando mensaje...");
});

http.listen(8080, function(){
    console.log("listening on *:8080");
});

io.on('connection', function(socket){
    console.log("connection estabilished!");
});