<?php
    // Register the style like this for a plugin:
	wp_register_style( 'fuyuko-behance-wp-admin-style', plugins_url( '/css/fuyuko_behance_admin_style.css', __FILE__ ));

	//enqueue the style:
	wp_enqueue_style( 'fuyuko-behance-wp-admin-style' );
?>


<?php  
    //SETTING UPDATE 
    if($_POST['wp_behance_project_setting_updated'] == 'Y') {  
        //Form data sent  
        $behance_username = $_POST['behance_username'];
        $behance_api = $_POST['behance_api'];
        update_option('behance_username', $behance_username);
        update_option('behance_api', $behance_api);
?>
        <div class="updated"><p><strong><?php _e('Setting saved.');?></strong></p></div>
<?php
    } else {  
        //Normal page display  
        $behance_username = get_option('behance_username');
        $behance_api = get_option('behance_api');
    }  
?> 

<?php
    //MANUALLY UPDATE PROJECTS (RETRIEVE DATA FROM BEHANCE)

    if($_POST['wp_behance_project_update_project'] == 'Y'){
        $behance_username = get_option('behance_username');
        $behance_api = get_option('behance_api');

        $behance_url = "http://www.behance.net/v2/users/" . $behance_username . "/projects?api_key=" . $behance_api;
        $temp_file_location = download_url($behance_url);
        $file_content = file_get_contents($temp_file_location);
        update_option('wp_behance_projects', $file_content);
?>
         <div class="updated"><p><strong><?php _e('Your Projects are updated.');?></strong></p></div>
<?php       
    }
?>

<div id="fuyuko-behance-wp" class="wrap">
    <div class="main-content">

	    <?php  echo "<h1>" . __( 'WP Behance Project Display Settings', 'fuyuko_net' ) . "</h1>"; ?>

        <p>This plugin will extract the specified user's project information (public data only) through Behance API and display in a page or post.

        <?php  echo "<h2>" . __( 'How To Display Your Behance Projects', 'fuyuko_net' ) . "</h2>"; ?>
        <p>place the following shortcode in a post or a page where you want to display Behance projects:</p>
        <p><pre>[wpbehance]</pre></p>
        <p>For those who are not familiar with shortcode, 
            please <a href="http://codex.wordpress.org/Shortcode_API" alt="Shortcode API" target="_blank">read this article</a>.</p>
			
	    <form name="fuyuko_behance_wp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <!-- Determine if the update setting button is pressed or not-->
		    <input type="hidden" name="wp_behance_project_setting_updated" value="Y">

            <!--Behance Account Setting Form Fields-->
		    <?php    echo "<h2>" . __( 'Plugin Setting', 'fuyuko_net' ) . "</h2>"; ?>
            <p><label style="width: 130px; text-align: right; margin-right: 5px; display: inline-block;"><?php _e("Behance API Key: " ); ?></label><input type="text" name="behance_api" value="<?php echo $behance_api; ?>" size="40"> Enter your Behance API key. If you don't have one, please <a href="https://www.behance.net/dev/register" traget="_blank">register</a>.</p>
		    <p><label style="width: 130px; text-align: right; margin-right: 5px; display: inline-block;"><?php _e("Behance Username: " ); ?></label><input type="text" name="behance_username" value="<?php echo $behance_username; ?>" size="40"> <?php _e("Type Behance's username of the projects you want to dispaly (ex: your_username)" ); ?></p>
		    <p class="submit">
		    <input type="submit" name="Submit" value="<?php _e('Update Plugin Setting', 'fuyuko_net' ) ?>" />
		    </p>
	    </form>

        <?php    echo "<h2>" . __( 'Sync Behance Projects', 'fuyuko_net' ) . "</h2>"; ?>
        <p>Whenever you modify your project(s) at Behance site, you need to press "Sync Projects" button below to update the project contents on your Wordpress site.</p>
        <form name="fuyuko_behance_wp_update_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <!-- Determine if the update setting button is pressed or not-->
		    <input type="hidden" name="wp_behance_project_update_project" value="Y">	
		    <p class="submit">
		    <input type="submit" name="Submit" value="<?php _e('Sync Projects', 'fuyuko_net' ) ?>" />
		    </p>
	    </form>
    </div>

    <!--Side Bar Content-->
    <div class="side-bar">
		<div class="sidearea metabox-holder postbox">
            <h2 style="margin-left: 10px;"><span>About This Plugin</span></h2>
            <p>For documentation and other information about this plugin, please <a href="http://fuyuko.net/wordpress-plugins/wp-behance-project-display/" target="_blank">visit plugin page.</a></p>
			<ul>
				<li><a href="https://github.com/fuyuko/wp-behance-project-display" target="_blank">Plugin Source Code</a>
				<li><a href="https://github.com/fuyuko/wp-behance-project-display/issues" target="_blank">Report Issues</a> (for help and support)
				<li><a href="https://github.com/fuyuko/wp-behance-project-display/wiki" target="_blank">Documentation</a> (currently under construction)
                <li><a href="http://fuyuko.net/donation/" target="_blank">Please Consider Donating</a> 
        </div>
    </div>
    
</div>
	