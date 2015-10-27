var request = require('request');

var fs = require('fs');

function send(data){

request.post({
	url: 'http://127.0.0.1:1081/bingo',
	form: JSON.stringify(data)
}, function(err, httpres, body){
console.log(err, httpres, body);
});

}
fs.readFile('./data/json.json', 'utf8' ,function(err, text){
	var obj = JSON.parse(text);
	obj.forEach(function(obj){
		send(obj);	
	});	
});


