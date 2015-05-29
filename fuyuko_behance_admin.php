<?php
    // Register the style like this for a plugin:
	wp_register_style( 'fuyuko-behance-wp-admin-style', plugins_url( '/css/fuyuko_behance_admin_style.css', __FILE__ ));

	//enqueue the style:
	wp_enqueue_style( 'fuyuko-behance-wp-admin-style' );
?>


<?php  
    //SETTING UPDATE 
    if($_POST['fuyuko_behance_wp_setting_updated'] == 'Y') {  
        //Form data sent  
        $fuyuko_behance_wp_username = $_POST['fuyuko_behance_wp_username'];
        update_option('fuyuko_behance_wp_username', $fuyuko_behance_wp_username);
?>
        <div class="updated"><p><strong><?php _e('Setting saved.');?></strong></p></div>
<?php
    } else {  
        //Normal page display  
        $fuyuko_behance_wp_username = get_option('fuyuko_behance_wp_username');
    }  
?> 

<?php
    //MANUALLY UPDATE PROJECTS (RETRIEVE DATE FROM BEHANCE)

    if($_POST['fuyuko_behance_wp_update_project'] == 'Y'){
        $fuyuko_behance_wp_username = get_option('fuyuko_behance_wp_username');
        $fuyuko_behance_wp_hp_api = get_option('fuyuko_behance_wp_hp_api');

        $fuyuko_behance_wp_url = "http://www.behance.net/v2/users/" . $fuyuko_behance_wp_username . "/projects?api_key=" . $fuyuko_behance_wp_hp_api;
        $temp_file_location = download_url($fuyuko_behance_wp_url);
        $file_content = file_get_contents($temp_file_location);
        update_option('fuyuko_behance_wp_projects', $file_content);
?>
         <div class="updated"><p><strong><?php _e('Your Projects are updated.');?></strong></p></div>
<?php       
    }
?>

<div id="fuyuko-behance-wp" class="wrap">
    <div class="main-content">

	    <?php    echo "<h2>" . __( 'Fuyuko Project Display Plugin for WP Settings', 'fuyuko_net' ) . "</h2>"; ?>

        <p>This plugin will extract the specified user's project information (public data only) through Behance API and display in a page or post
            by using a shortcode: <pre>[fuyukoprojects]</pre></p>
        <p>For those who are not familiar with shortcode, 
            please <a href="http://codex.wordpress.org/Shortcode_API" alt="Shortcode API" target="_blank">read this article</a>.)</p>
			
	    <form name="fuyuko_behance_wp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <!-- Determine if the update setting button is pressed or not-->
		    <input type="hidden" name="fuyuko_behance_wp_setting_updated" value="Y">

            <!--Behance Account Setting Form Fields-->
		    <?php    echo "<h3>" . __( 'Behance Account Setting', 'fuyuko_net' ) . "</h3>"; ?>
		    <p><?php _e("Your Behance Username: " ); ?><input type="text" name="fuyuko_behance_wp_username" value="<?php echo $fuyuko_behance_wp_username; ?>" size="20"><?php _e(" (ex: your_username)" ); ?></p>
			
		    <p class="submit">
		    <input type="submit" name="Submit" value="<?php _e('Update Behance Account Info', 'fuyuko_net' ) ?>" />
		    </p>
	    </form>

        <?php    echo "<h3>" . __( 'Update Your Project Contents', 'fuyuko_net' ) . "</h3>"; ?>
        <p>Whenever you modify your project(s) at Behance site, you need to press "Update Project" button below to update the project contents on your Wordpress site.</p>
        <form name="fuyuko_behance_wp_update_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <!-- Determine if the update setting button is pressed or not-->
		    <input type="hidden" name="fuyuko_behance_wp_update_project" value="Y">	
		    <p class="submit">
		    <input type="submit" name="Submit" value="<?php _e('Update Projects', 'fuyuko_net' ) ?>" />
		    </p>
	    </form>
    </div>

    <!--Side Bar Content-->
    <div class="side-bar">
        <div class="sidearea metabox-holder postbox">
            <h3><span>Please Consider Donating</span></h3>
            <p>This plugin is developed and maintained without any source of funding (other than out of my pocket). Please consider donating (any amount will do) to support maintaining this free plugin.</p>
            <p>Thank you!</p>
            <div style="text-align: center;">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                ">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
            </div>
        </div>
        <div class="sidearea metabox-holder postbox">
            <h3><span>Credits</span></h3>
            <img src="<?php get_bloginfo('wpurl');?>/wp-content/plugins/fuyuko-behance/images/PbyBehance-vertical-145px.png" alt="Powered by Behance" />
        </div>

    </div>
    
</div>
	