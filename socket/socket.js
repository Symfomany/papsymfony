// Getting server, socket and redis
var app = require('express')();
var http = require('http').Server(app);
var server = require('http').createServer();
var io = require('socket.io').listen(server);
var redis = require('socket.io-redis');

// Adapter SocketIO - Redis
io.adapter(redis({ host: '127.0.0.1', port: 6379 }));

server.listen(8081, '127.0.0.1');