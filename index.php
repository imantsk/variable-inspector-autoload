<?php 

add_action('in_admin_footer', function() {
if (get_current_screen()->base == 'tools_page_variable-inspector'){ 
echo '<script>
var autoReload = null;
var count = 0;
function AjaxAutoLoad(selector){(function($){
	$.ajax({
        type: "GET",
        url: window.location.href
    }).done(function(res){
    	$(selector).html( $(res).find(selector) );
		
		$(".accordion__control").click(function() {
			$("#auto_load").prop( "checked", false );
			clearInterval(autoReload);
			openClose(this);
		});
		
		$(selector).removeAttr("style");
    });
	console.log(count++);
})(jQuery);}

function AjaxManual(selector){(function($){
	$(selector).css({"opacity":"0.2","pointer-events":"none","cursor":"wait"});
	AjaxAutoLoad(selector);
})(jQuery);}

function openClose(selector){(function($){
	$(selector).toggleClass("accordion__control--active");
	$(selector).parents(".accordion").find(".accordion__panel").slideToggle();
})(jQuery);}

(function($){
$(".csf-header-left h1").append("<br><label for=\'auto_load\'><input type=\'checkbox\' id=\'auto_load\' name=\'auto_load\' value=\'auto_load\'>Auto update</label><a class=\'button\' onclick=\"AjaxManual(\'#inspection-results\')\" >Refesh</a>")
$(".csf-header-left h1 label").css("font-size","0.7em")

$(".csf-header-left").append("<pre>do_action( \'inspect\', [ \'variable_name\', $variable_name ] );</pre>").css("margin-left","1em");

$(".csf-header-left h1").css("margin-right","1em");
$(".csf-header-left label").css("margin-right","1em");

$("#auto_load").change(function() {
    if(this.checked) {
        autoReload = setInterval( function(){ AjaxAutoLoad("#inspection-results"); }, 1000);
    } else {
		clearInterval(autoReload);
	}
});
})(jQuery);</script>';}
});
