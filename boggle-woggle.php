<?php
/*
Plugin Name: Boggle Woggle
Plugin URI:
Version: 1.00
Author:
Description: Boggle Woggle lets you add a text (html code) to display at the top of your blog (even before header)
License: GPLv2 a

*/
if (!class_exists("BoggleWoggle")) {
	class BoggleWoggle {
		function BoggleWoggle() { //constructor remains empty

		}
		function addHeaderCode() {
			?>
			<?php

		}

		function addHeader() {
			$content = '';
			$original = $content;
			$content = get_option('bw_text');
			$content = '<center>' . $content . '</center>';
			$content = '<BR>' . $content;

		  echo $content;

	 	}



	}

} //End Class BoggleWoggle


if (class_exists("BoggleWoggle")) {
	$dl_pluginSeries = new BoggleWoggle();
}
//Actions and Filters
if (isset($dl_pluginSeries)) {
	//Actions
	//Filters
	add_action( 'wp_head', array( &$dl_pluginSeries, 'addHeader' ) );
}

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'boggle_woggle_install');

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'boggle_woggle_remove' );

function boggle_woggle_install() {
/* Creates new database field */
add_option("bw_text", '', '', 'yes');

}

function boggle_woggle_remove() {
/* Deletes the database fields */

}

if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'boggle_woggle_admin_menu');

function boggle_woggle_admin_menu() {
add_options_page('Boggle Woggle', 'Boggle Woggle', 'administrator',
'boggle_woggle', 'boggle_woggle_page');
}
}

?>
<?php
function boggle_woggle_page() {
?>

<h2>Boggle Woggle - Settings</h2>


		<div style="width:965px;">

			<div style="float:left">
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>



<BR><BR>
										<table class="widefat" cellspacing="0" style="width:600px;"><tbody>

											<thead>
							<tr>
								<th colspan="2" scope="col">
									Boggle Woggle
									<div style="float:right">
										<input name="save" type="submit" value="Save" class="button-primary"/>
										<input type="hidden" name="action" value="save" />
									</div>
								</th>
							</tr>
						</thead>

						<tr>
							<td width="250px">

									On the right you can enter the text you want to appear on top of your blog. You may use html code in this textarea.
									<BR>
							</td>
							<td width="350px">

							<textarea name="bw_text" id="bw_text" style="width:340px; height:220px; font-size:11px;" cols="" rows=""><?php echo get_option('bw_text'); ?></textarea>
							</td>
						</tr>


											</tbody></table>
<BR><BR>



<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="bw_text" />

<p>
<input type="submit" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>

</div>



<BR><BR>
<?php
}
?>