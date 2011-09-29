// Start with the map page
//window.location.replace(window.location.href.split("#")[0] + "#mappage");

var selectedFeature = null;

$(document).bind("mobileinit", function()
		{


});


$(document).ready(function() {

    // fix height of content
    function fixContentHeight() {
        var header = $("div[data-role='header']:visible"),
            footer = $("div[data-role='footer']:visible"),
            content = $("div[data-role='content']:visible:visible"),
            viewHeight = $(window).height(),
            contentHeight = viewHeight - header.outerHeight() - footer.outerHeight();

        if ((content.outerHeight() +footer.outerHeight()+ header.outerHeight()) !== viewHeight) {
            contentHeight -= (content.outerHeight() - content.height() + 1);
            content.height(contentHeight);
        }

        if (window.map) {
        //    map.updateSize();
        } else {
            // initialize map
            init(function(feature) { 
                selectedFeature = feature; 
                $.mobile.changePage("#popup", "pop"); 
            });
        }
    }

    $(window).bind("orientationchange resize pageshow", fixContentHeight);
    document.body.onload = fixContentHeight;

    // Map zoom  
    $("#plus").click(function(){
        map.zoomIn();
    });
    $("#minus").click(function(){
        map.zoomOut();
    });
    $("#locate").click(function(){
    });
    
		$("#checkbox-1").change(function()
			{
			
			var checked = 	$(this).is(':checked'); 
			//alert(JSON.stringify(checked));
			if(checked == true)
				{
				$("#checkbox-2").checkboxradio('enable');
				anno.setVisibility(true);
				}
			else
				{
				$("#checkbox-2").checkboxradio('disable');
				anno.setVisibility(false);
				}
	
			});


		$("#checkbox-2").bind( "change", function(event, ui) {
				var checked = $(this).is(':checked');
				if(checked == true)
					{
					alert('Labels ON');
					}
				
			});

		//$("#checkbox-2").live();

			$("#checkbox-2").checkboxradio();
			$("#checkbox-2").checkboxradio('disable');

});


