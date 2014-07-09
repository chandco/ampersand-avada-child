<?php


// custom locations for Ampersand
/**
* This plugin will fix the problem where next/previous of page number buttons are broken on list
* of posts in a category when the custom permalink string is:
* /%category%/%postname%/
* The problem is that with a url like this:
* /categoryname/page/2
* the 'page' looks like a post name, not the keyword "page"
*/


//require_once("custom-framework/helpers/menu-subtitles.php");

function remove_page_from_query_string($query_string)
{
if ($query_string['name'] == 'page' && isset($query_string['page'])) {
unset($query_string['name']);
// 'page' in the query_string looks like '/2', so i'm spliting it out
list($delim, $page_index) = split('/', $query_string['page']);
$query_string['paged'] = $page_index;
}
return $query_string;
}

add_filter('request', 'remove_page_from_query_string');






function ampersand_events_init() {
	
	// menu for the general ampersand locations	
	  register_nav_menu('ampersand-group-menu',__( 'Ampersand Group Menu' ));
	 // register_nav_menu('homepage-section-menu',__( 'Ampersand Homepage Section Menu' ));
	  register_nav_menu('category-section-menu',__( 'Ampersand Category Section' ));  
	  register_nav_menu('sidebar-menu-categories',__( 'Ampersand Side Bar Menus' ));  
}

add_action( 'init', 'ampersand_events_init' );

function ampersand_widgets_init() {

	register_sidebar( array(
		'name' => 'Category Banner Title Area',
		'id' => 'ampersand_category_title_area',
		'before_widget' => '<div class="one_third">',
		'description'   => 'Only appears for Category Archive Pages',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded" style="display:none;">',
		'after_title' => '</h2>',
	) );

	
	
}
add_action( 'widgets_init', 'ampersand_widgets_init' );

add_filter('widget_text', 'do_shortcode');


add_filter( 'wp_nav_menu_objects', 'menu_manipulation', 10, 2 );
function menu_manipulation ( $items, $args ) {
    //post_title
    	// we should add more things 

		$allow_on = array(
		//'homepage-section-menu', 
		'category-section-menu',
		);

    	if (in_array($args->theme_location, $allow_on))
        foreach ($items as $key => $item) 
        {
        	$first_word = strstr($item->title, ' ', true);

        	$treated = str_replace($first_word, "<strong>" . $first_word . "</strong> ", $item->title);
        	$items[$key]->title = $treated;
        }
    
    return $items;
}


add_filter( 'single_cat_title', 'ta_modified_post_title');
function ta_modified_post_title ($title) {
	$first_word = strstr($title, ' ', true);
	$treated = str_replace($first_word, "<strong>" . $first_word . "</strong> ", $title);
	return $treated;
}


function output_news_feed_ajax()
{
	$output = "<div class='widget-old-news-feed'><div class='loading'>Loading news...</div><div class='holdingbay'></div></div>";
	return $output;
}

add_shortcode("aenewsfeed", "output_news_feed_ajax" );


function output_menu_shortcode($atts)
{
	if (has_nav_menu( $atts["menu"] )):
		
		return wp_nav_menu( array( 'theme_location' => $atts["menu"], 'container_class' => $atts["menu"], 'echo' => false ) );

	else:
		return false;
	endif;
}

add_shortcode("showmenu", "output_menu_shortcode" );

?>