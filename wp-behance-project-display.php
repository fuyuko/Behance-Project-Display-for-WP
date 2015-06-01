<?php   
    /* 
    Plugin Name: WP Behance Project Display
    Plugin URI: http://fuyuko.net/wordpress-plugins/wp-behance-project-display/
    Description: Plugin for displaying  your Behance projects in a WordPress site using a shortcode
    Author: Fuyuko Gratton 
    Version: 0.4.2
    Author URI: http://fuyuko-net/
    */ 
    
//activation setup
register_activation_hook( __FILE__, 'wp_behance_project_diplay_' );
function wp_behance_project_display_activate(){
    update_option('behance_api','');  //FnkCCad9zds37g3lW5RXSMI78cvwo6gV
} 


//deactivation setup
register_deactivation_hook( __FILE__, 'wp_behance_project_display_deactivate' );
function wp_behance_project_display_deactivate(){
   
} 



/**
 * BACKEND INSTALLED PLUGIN PAGE - additional links below the plugin title
 **/
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wp_behance_project_display_action_links' );
function wp_behance_project_display_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=wp-behance-project-display') ) .'">Settings</a>';
   return $links;
}

/**
 * ADMIN PAGE SETUP
 **/
add_action('admin_menu', 'wp_behance_project_display_admin_actions'); 
function wp_behance_project_display_admin() {  
    include('wp-behance-project-display-admin.php');  
}  
function wp_behance_project_display_admin_actions() {  
     add_options_page("WP Behance Project Display", "Behance Project Display", "manage_options", "wp-behance-project-display", "wp_behance_project_display_admin");  
}  


/**
 * STYLESHEET
 **/
add_action( 'wp_enqueue_scripts', 'wp_behance_project_display_style_stylesheet', 0);
function wp_behance_project_display_style_stylesheet()
{
	// Register the style like this for a plugin:
	wp_register_style( 'wp-behance-project-display-style', plugins_url( '/css/wp-behance-project-display.css', __FILE__ ));

	//enqueue the style:
	wp_enqueue_style( 'wp-behance-project-display-style' );
}


/**
* Shortcode to display project contents
* Attribute Names: display
* Possible attribute Values for display: default, alpha02
**/
add_shortcode('wpbehance', 'wp_behance_project_display_shortcode');
function wp_behance_project_display_shortcode($atts){
    //enqueue awesome font stylesheet
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

	extract( shortcode_atts( array(
		'display' => 'default',
	), $atts ) );
	
	//apply stylesheet for the shortcode
	
    $string = get_option('wp_behance_projects');
    $json_data=json_decode($string,true);
    $output = '<section id="behance-projects" class="' . $display . '">'. "\n";

    foreach ($json_data['projects'] as $project) {
		$output .= '<article class="behanceProject">' . "\n";
		$output .= '<figure class="projectThumbnail"><a href="' . $project['url'] . '" target="_blank" >' . '<img src="' . $project['covers']['404'] . '" /></a></figure>' . "\n";
		$output .= '<h1 class="projectName"><a href="' . $project['url'] . '" target="_blank" >' . $project['name'] . '</a></h1>' . "\n";
		$output .= '<footer class="projectStat">';
		$output .= '<div class="projectStatView"><i class="fa fa-eye"></i> ' . $project['stats']['views'] . "</div>\n";
		$output .= '<div class="projectStatAppreciation"><i class="fa fa-thumbs-o-up"></i> ' . $project['stats']['appreciations'] . "</div>\n";
		$output .= '<div class="projectStatComment"><i class="fa fa-comments"></i> ' . $project['stats']['comments'] . "</div>\n";
		$output .= "</footer>\n";
		$output .= '</article>' . "\n";
}
    $output .= '</section>' . "\n";

    return $output;
}




?>