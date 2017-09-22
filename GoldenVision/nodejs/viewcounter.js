// Setup basic express server
var express = require('express');
var app = express();
var mysql = require('mysql');
var server = require('http').createServer(app);
var io = require('socket.io')(server);
var port = 8001;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});

// Routing
app.use(express.static(__dirname + '/public'));

var con = mysql.createConnection({
  host: "127.0.0.1",
  user: "username",
  password: "password",
  database: "databasename"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected to mysql!");
});

var count = 0;
var check = [];
io.on('connection', function(socket) {
    count++;
    io.sockets.emit('userupd', {
        Count: count,
    });
    io.sockets.emit('checked', check);
    //console.log('co. ' + count + ' connecter');

    socket.on('copied', function(data) {
        io.sockets.emit('newcheck', data);
        if (check.length >= 20) {
            check = [];
        }
        check.push(data);
    });

    socket.on('chat message', function(msg){
        io.sockets.emit('new message', msg);
        var sql = "INSERT INTO chatmsg (username, message) VALUES ('"+msg.username+"', '"+msg.mess+"')";
        con.query(sql, function (err, result) {
            if (err) throw err;
            console.log("1 record inserted");
        });
    });

    socket.on('disconnect', function(){
        count--;
        io.sockets.emit('userupd', {
            Count: count,
        });
        //console.log('deco. ' + count + ' encore connecter');
    });
});
