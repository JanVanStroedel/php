/*

var cardTemplate = $('#cardTemplate').html();
console.log(cardTemplate);
var template = $('#cardTemplate');
console.log(template);

cardN = 0;
function generateCards(n, context, btn1, btn2){
	for(i=0; i<n;i++){
		cardN+=2;
		var data = {
			title: context[i].title,
			text: context[i].text,
			button1: btn1[i].state,
			btn1Text: btn1[i].text,
			btn1Class: 'listen-'+cardN,
			button2: btn2[i].state,
			btn2Text: btn2[i].text,
			btn2Class: 'listen-'+cardN + 1
		}
		cCard = Mustache.to_html(cardTemplate, data);
		
		$('.cardlist').append(cCard);
	}
}
generateCards(2, [{title: "hoi", text: "hai"},{title: "doei", text:"tot ziens"}], [{text: "btn1", state:true},{text: "btn2", state:true}], [{text: "btn1", state:true},{text: "btn2", state:true}]);
generateCards(2, [{title: "hoi", text: "hai"},{title: "doei", text:"tot ziens"}], [{text: "btn1", state:true},{text: "btn2", state:true}], [{text: "btn1", state:true},{text: "btn2", state:true}]);
generateCards(2, [{title: "hoi", text: "hai"},{title: "doei", text:"tot ziens"}], [{text: "btn1", state:true},{text: "btn2", state:true}], [{text: "btn1", state:true},{text: "btn2", state:true}]);

/*/

$('.listen-ip').on('click', function(){
	var win = window.open('//'+$(this).data('ip'), '_blank');
	win.focus();
});