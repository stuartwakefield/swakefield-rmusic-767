var http = require("http");

http.createServer(function(req, res) {
	
	console.log("Request received");

	req.on("data", function(data) {
		console.log("The client has sent some data", data);
	});

	req.on("close", function() {
		console.log("The client has prematurely gone away");
	});

	req.on("end", function() {
		console.log("The client has gone away");
	});

	res.end();

}).listen(8182);