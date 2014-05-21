<?php


// custom locations for Ampersand


function ampersand_events_init() {
	
	// menu for the general ampersand locations	
	  register_nav_menu('ampersand-group-menu',__( 'Ampersand Group Menu' ));
	  
	  
	  
	  
}





add_action( 'init', 'ampersand_events_init' );





?>