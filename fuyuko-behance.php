<?php   
    /* 
    Plugin Name: Fuyuko - Behance Project Integration with WP 
    Plugin URI: http://wp-behance.fuyuko.net/
    Description: Plugin for displaying  your Behance projects inside Wordpress 
    Author: Fuyuko Gratton 
    Version: 0.1
    Author URI: http://wp-behance.fuyuko.net/
    */ 
    
//activation setup
function fuyuko_behance_activate(){
    update_option('fuyuko_behance_wp_hp_api','FnkCCad9zds37g3lW5RXSMI78cvwo6gV');
} 
register_activation_hook( __FILE__, 'fuyuko_behance_activate' );

//deactivation setup
function fuyuko_behance_deactivate(){
    delete_option('fuyuko_behance_wp_hp_api');
} 
register_deactivation_hook( __FILE__, 'fuyuko_behance_deactivate' );



//admin page setup	
function fuyuko_behance_admin() {  
    include('fuyuko_behance_admin.php');  
}  

function fuyuko_behance_admin_actions() {  
     add_options_page("Fuyuko Project Display Plugin", "Project Display", "manage_options", "fuyuko_behance_wp", "fuyuko_behance_admin");  
}  
add_action('admin_menu', 'fuyuko_behance_admin_actions'); 


//add stylesheet
function fuyuko_behance_stylesheet()
{
	// Register the style like this for a plugin:
	wp_register_style( 'fuyuko-behance-wp-style', plugins_url( '/css/fuyuko_behance_style.css', __FILE__ ));

	//enqueue the style:
	wp_enqueue_style( 'fuyuko-behance-wp-style' );
}
add_action( 'wp_enqueue_scripts', 'fuyuko_behance_stylesheet', 0);

/* 	Shortcode to display project contents
**	Attribute Names: display
**  Possible attribute Values for display: default, alpha02
*/
function fuyuko_behance_shortcode($atts){
    
	extract( shortcode_atts( array(
		'display' => 'default',
	), $atts ) );
	
	//apply stylesheet for the shortcode
	
    $string = get_option('fuyuko_behance_wp_projects');
    $json_data=json_decode($string,true);
    $output = '<div id="behance-projects" class="' . $display . '">'. "\n";

    foreach ($json_data['projects'] as $project) {
	
		
		if(strcmp($display, "default") == 0){ //if "display" attribute is NOT set = default layout code
			$output .= '<div class="behanceProject">' . "\n";
			$output .= '<div class="projectName"><a href="' . $project['url'] . '" target="_blank" >' . $project['name'] . '</a></div>' . "\n";
			$output .= '<div class="projectThumbnail"><a href="' . $project['url'] . '" target="_blank" >' . '<img src="' . $project['covers']['202'] . '" /></a></div>' . "\n";
			$output .= '<div class="projectStat">';
			$output .= '<div class="projectStatView"><label>views</label>' . $project['stats']['views'] . "</div>\n";
			$output .= '<div class="projectStatAppreciation"><label>appreciations</label>' . $project['stats']['appreciations'] . "</div>\n";
			$output .= '<div class="projectStatComment"><label>comments</label>' . $project['stats']['comments'] . "</div>\n";
			$output .= "</div>\n";
			$output .= '</div>' . "\n";
		}//end of default layout code
		else if(strcmp($display, "alpha02") == 0){ //if "display" attribute is set to "alpha02" = default layout for version 0.2 alpha
			$output .= '<div class="behanceProject alpha02">' . "\n";
			$output .= '<div class="projectName"><a href="' . $project['url'] . '" target="_blank" >' . $project['name'] . '</a></div>' . "\n";
			$output .= '<div class="projectThumbnail"><a href="' . $project['url'] . '" target="_blank" >' . '<img src="' . $project['covers']['202'] . '" /></a></div>' . "\n";
			$output .= '<div class="projectStat">';
			$output .= 'views:' . $project['stats']['views'];
			$output .= '<br/>  appreciations:' . $project['stats']['appreciations'];
			$output .= '<br/>  comments:' . $project['stats']['comments'];
			$output .= "</div>\n";
			$output .= '</div>' . "\n";		
		}
	}
    $output .= '</div>' . "\n";

    return $output;
}add_shortcode('fuyukoprojects', 'fuyuko_behance_shortcode');



?>