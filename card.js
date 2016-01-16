<div class = "card">
	<div class = "content break">
		<p class = "title">{{title}}</p>
		<p class = "text">{{text}}</p>{{#button1}}
		<div class = "button click-me-button ripple-effect {{btn1Class}}" {{btn1Attr}}>
			<p class = "button-text unselectable">{{btn1Text}}</p>
		</div>{{/button1}}{{#button2}}
		<div class = "button click-me-button ripple-effect {{btn2Class}}" {{btn2Attr}}>
			<p class = "button-text unselectable">{{btn2Text}}</p>
		</div>{{/button2}}
	</div>
</div>