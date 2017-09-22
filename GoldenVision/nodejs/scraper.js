var express = require('express');
var path = require('path');
var app = express();
var request = require('request');
var cheerio = require('cheerio');
var fs = require('fs');
var port = 8080;

app.set('view engine', 'handlebars');
app.set('views', path.join(__dirname, 'views'));

//var url = "https://www.reddit.com/r/MLBStreams/";
var url = "https://www.mlbstream.me/";
request(url, function(err, resp, body){
  var $ = cheerio.load(body);

  /*var arr = $('.md td');   
  var array = [];
  var numb = 0;
  arr.each(function() {
      if (numb == 0) {
        array.push({
          gametime: $(this).text()
        });
        numb = 1;
        return;
      }
      if (numb == 1) {
        array.push({
          gametitle: $(this).text()
        });
        numb = 2;
        return;
      }
      if (numb == 2) {
        numb = 0;
        return;
      }
  });*/

  var arr = $('#clock2');  
  var arrText = arr.text(); 
  /*var array = [];
  arr.each(function() {
    array.push({
      game: $(this).text()
    });
  });*/

  console.log('games ', body);
});

app.listen(port);
console.log('server running on '+port);
