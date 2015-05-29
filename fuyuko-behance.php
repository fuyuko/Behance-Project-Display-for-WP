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


//add stylesheet - used inside shortcode function
function fuyuko_behance_stylesheet()
{
	// Register the style like this for a plugin:
	wp_register_style( 'fuyuko-behance-wp-style', plugins_url( '/css/fuyuko_behance_style.css', __FILE__ ));

	//enqueue the style:
	wp_enqueue_style( 'fuyuko-behance-wp-style' );
}

//shortcode to display project contents
function fuyuko_behance_shortcode(){
    //apply stylesheet for the shortcode
    fuyuko_behance_stylesheet();

    $string = get_option('fuyuko_behance_wp_projects');
    $json_data=json_decode($string,true);
    $output = '<div id="behance-projects">'. "\n";

    foreach ($json_data['projects'] as $project) {
        $output .= '<div class="behanceProject">' . "\n";
        $output .= '<div class="projectName"><a href="' . $project['url'] . '" target="_blank" >' . $project['name'] . '</a></div>' . "\n";
        $output .= '<div class="projectThumbnail"><a href="' . $project['url'] . '" target="_blank" >' . '<img src="' . $project['covers']['202'] . '" /></a></div>' . "\n";
        $output .= '<div class="projectStat">';
        $output .= 'views:' . $project['stats']['views'];
        $output .= '  appreciations:' . $project['stats']['appreciations'];
        $output .= '  comments:' . $project['stats']['comments'];
        $output .= "</div> <!--end of projectStat class -->\n";
        $output .= '</div> <!-- end of behanceProject class -->' . "\n";
	}
    $output .= '</div>' . "\n";

    return $output;
}add_shortcode('fuyukoprojects', 'fuyuko_behance_shortcode');



?>