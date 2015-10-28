var request = require('request');

var fs = require('fs');

function send(data){

request.post({
	url: 'http://104.155.200.193//bingo',
	form: JSON.stringify(data)
}, function(err, httpres, body){
console.log(err, httpres, body);
});

}
fs.readFile('/tmp/result6.json', 'utf8' ,function(err, text){
	var obj = JSON.parse(text);
	obj.forEach(function(obj){
		send(obj);	
	});	
});


