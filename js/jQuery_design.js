$(function(){
    $( "div#imgDoc" ).swiperight( function ( ){
        $( "nav" ).addClass( "swiperight" );
        $( "div#btnMenu" ).addClass( "swiperightButton" );
        window.setTimeout(function(){ $( "nav" ).removeClass("swipeleft");},2);
        window.setTimeout(function(){ $( "div#btnMenu" ).removeClass("swipeleftButton");},2);
    })
});

//Swipe left menu
$(function(){
    $( "div#row div").swipeleft( function ( ){

        $( "div#menuLat" ).addClass( "swipeleft" );
        $( "div#buttonMenu" ).addClass( "swipeleftButton" );
        window.setTimeout(function(){ $( "nav" ).removeClass("swiperight");},2);
        window.setTimeout(function(){ $( "div#btnMenu" ).removeClass("swiperightButton");},2);
    })
});

$(function() {
    var x = 1;
    $( "button#buttonInfo" ).tap( function ( ){
        if(x==1)
        {
            $( "nav" ).addClass( "swiperight" );
            $( "div#info" ).addClass( "mostraInfo" );
            $(function (){
                $("button#btnInfo").removeClass("ui-icon-info").addClass("ui-icon-home");});
            window.setTimeout(function(){ $( "nav" ).removeClass("swipeleft");},2);
            window.setTimeout(function(){ $( "div#btnMenu" ).removeClass("swipeleftButton");},2);
            window.setTimeout(function(){ $( "div#info" ).removeClass("nascondiInfo");},2);
            x=2;
        }
        else
        {
            $( "nav" ).addClass( "swipeleft" );
            $( "div#btnMenu" ).addClass( "swipeleftButton" );
            $( "div#info" ).addClass( "nascondiInfo" );
            $(function (){
                $("button#btnInfo").removeClass("ui-icon-home").addClass("ui-icon-info");});
            window.setTimeout(function(){ $( "nav" ).removeClass("swiperight");},2);
            window.setTimeout(function(){ $( "div#btnMenu" ).removeClass("swiperightButton");},2);
            window.setTimeout(function(){ $( "div#info" ).removeClass("mostraInfo");},2);
            x=1;
        }
    })
});