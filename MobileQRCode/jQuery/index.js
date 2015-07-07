$(function(){
  $( "div" ).bind( "tap", tapHandler );
 
  function tapHandler( event ){
    $( event.target ).addClass( "tap" );
    $ ("#imgDoc").hide();
  }
});
  