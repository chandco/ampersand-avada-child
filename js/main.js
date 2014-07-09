// JavaScript Document


// get the info from the news feed.  
jQuery(function ($) {

$(document).ready( function() {


	// tooltips on menus

	$("ul.menu li.menu-item a").tooltip();

	if ($(".widget-old-news-feed").length)
	{

		// get the content from the old feed.  
		var $temp = $("<div class='loaded-news'></div>");

		$temp.load("/news.php?z=5&c=33&n=News #subPageContent .newsList:lt(4)", function() {
			$temp.find(".leftImage").remove();
			$temp.appendTo(".widget-old-news-feed .holdingbay");
			$(".widget-old-news-feed .loading").fadeOut( function() {
				$(".widget-old-news-feed .holdingbay").fadeIn();
			});

		});

	

		// repurpose it into the format we want.

		// fade it in.
	}

})});