$(function () {
	var _TL = TweenLite;

	$(".ripple-effect").on("click", function (e) {
		var x = e.pageX;
		var y = e.pageY;
		var clickY = y - $(this).offset().top;
		var clickX = x - $(this).offset().left;
		var box = this;
		var color = $(box).data('ripple-color') || "";
		color = (color == "")?"blue":color;

		var setX = parseInt(clickX);
		var setY = parseInt(clickY);
		$(this).find("svg").remove();
		$(this).prepend('<svg><circle class = "ripple-circle-'+color+'" cx="'+setX+'" cy="'+setY+'" r="'+0+'"></circle></svg>');


		var c = $(box).find("circle");
		var cr = {
			r: 0
		};
		_TL.to(cr, 0.4, {r: $(box).outerWidth() * 1.5, onUpdate: onUpdateHandler});
		_TL.to(c, 0.8, {opacity:0});

		function onUpdateHandler(){
			c.attr('r', cr.r);
		}

	});
	
	$(".menu-button").on("click", function(e){				
		$(".menu-button").not(this).css("background-color", "initial");
		$(this).css("background-color", "#eee");
	});
	
	$(".hamburger").on("click", toggleMenu);
	$(".overlay").on("click", function (e){
		if($(this).css("opacity") > 0){
			toggleMenu();
		}
	});
	
	klaar = true;
	menu = true;
	function toggleMenu(e){
		if(klaar){
			klaar = false;
			var h1 = $(".hamburger1");
			var h2 = $(".hamburger2");
			var h3 = $(".hamburger3");
			var overlay = $(".overlay");
			var leftMenu = $(".left-menu");

			if(menu){
				leftMenu.css("box-shadow", "2px 0px 4px gray");
				overlay.css('display', 'initial');
				_TL.to(overlay, 1, {opacity: 0.5});
				_TL.to(leftMenu, 1, {x:250});
				_TL.to(h1, 1, {x: 250, y:6});
				_TL.to(h2, 1, {x: 250});
				_TL.to(h3, 1, {x: 250, y:-6, onComplete: function(){					
					h1.css('display', 'none');
					_TL.to(h2, 1, {rotation: 45});
					_TL.to(h3, 1, {rotation: -45, onComplete: function(){
						menu = false;
						klaar = true;				
					}});

				}});

			}
			else{
				_TL.to(h2, 1, {rotation: 0});
				_TL.to(h3, 1, {rotation: 0, onComplete: function(){
					h1.css('display', 'initial');
					_TL.to(overlay, 1, {opacity: 0, onComplete: function(){					
						overlay.css('display', 'none');
					}});
					_TL.to(leftMenu, 1, {x:0});
					_TL.to(h1, 1, {x:0, y:0});
					_TL.to(h2, 1, {x:0});	
					_TL.to(h3, 1, {x:0, y:0, onComplete: function(){
						leftMenu.css("box-shadow", "0px 0px 0px gray");
						$(".menu-button").css("background-color", "initial");
						menu = true;
						klaar = true;				
					}});
				}});
			}
		}
	}					   
});