// JavaScript Document
$(function(){
		$( "div#imgDoc" ).swiperight( function ( ){
			$( "div#menuLat" ).addClass( "swiperight" );
			$( "div#buttonMenu" ).addClass( "swiperightButton" );
			window.setTimeout(function(){ $( "div#menuLat" ).removeClass("swipeleft");},2);
			window.setTimeout(function(){ $( "div#buttonMenu" ).removeClass("swipeleftButton");},2);
		})
		});
	  
//Swipe left menu
$(function(){
	$( "div#row div").swipeleft( function ( ){
		
		$( "div#menuLat" ).addClass( "swipeleft" );
		$( "div#buttonMenu" ).addClass( "swipeleftButton" );
		window.setTimeout(function(){ $( "div#menuLat" ).removeClass("swiperight");},2);
		window.setTimeout(function(){ $( "div#buttonMenu" ).removeClass("swiperightButton");},2);
	})
	});

$(function() { 
	var x = 1;
	 $( "button#buttonInfo" ).tap( function ( ){
		if(x==1)
		{
			$( "div#menuLat" ).addClass( "swiperight" );
			$( "div#buttonMenu" ).addClass( "swiperightButton" );
			$(function (){
				$("button#buttonInfo").removeClass("ui-icon-info").addClass("ui-icon-home");});
			window.setTimeout(function(){ $( "div#menuLat" ).removeClass("swipeleft");},2);
			window.setTimeout(function(){ $( "div#buttonMenu" ).removeClass("swipeleftButton");},2);
			x=2;
		}
		else
		{ 
			$( "div#menuLat" ).addClass( "swipeleft" );
			$( "div#buttonMenu" ).addClass( "swipeleftButton" );
			$(function (){
				$("button#buttonInfo").removeClass("ui-icon-home").addClass("ui-icon-info");});
			window.setTimeout(function(){ $( "div#menuLat" ).removeClass("swiperight");},2);
			window.setTimeout(function(){ $( "div#buttonMenu" ).removeClass("swiperightButton");},2);
			x=1;
		}
	})
});