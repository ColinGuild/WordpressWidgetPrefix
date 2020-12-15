<?php
/**
* Plugin Name: Practice Plugin
* Description: Working with settings
* Version: 1.0
* Author: Your Colin Guild
**/

function myplugin_register_settings() {
   add_option( 'myplugin_option_name', 'Default Prefix');//parameter1: name of option parameter2: Default value
   register_setting( 'myplugin_options_group', 'myplugin_option_name', 'myplugin_callback' );//parameter1: group name parameter2: Option from line 10
}
add_action( 'admin_init', 'myplugin_register_settings' );


function myplugin_register_options_page() {
  add_options_page('Prefix', 'Prefix Menu', 'manage_options', 'myplugin', 'myplugin_options_page');//parameter1:Shows in tab parameter2: Title parameter3: Capabilities parameter4: Slug parameter5: line 22 
}
add_action('admin_menu', 'myplugin_register_options_page');


function myplugin_options_page()
{
?>
  <div>
  <h2>Prefix Menu</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'myplugin_options_group' ); //parameter1: line 11 ?>
  <p>Type your widget prefix below </p>
  <table>
  <tr valign="top">
  <th scope="row"><label for="myplugin_option_name">Prefix</label></th>
  <td><input type="text" id="myplugin_option_name" name="myplugin_option_name" value="<?php echo get_option('myplugin_option_name'); ?>" /></td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
} 


function my_edit_widget_func($params) {
    $params[0]['before_title'] = $params[0]['before_title'] . get_option('myplugin_option_name')." ";//put option prefix before widget
    return $params;
}
add_filter('dynamic_sidebar_params', 'my_edit_widget_func');







/*
function my_php_function() {
$w=get_option('siteurl');
var_dump(wp_get_sidebars_widgets());
}
add_action('wp_footer', 'my_php_function');

*/

/*
function remove_widget_title() {
     $titleNew = $instance['title'];
    return $titleNew;
}
add_filter ( 'widget_title', 'remove_widget_title' );
*/




/*function my_php_function() {
  echo '<script>
    function myFunction() {
      console.log("myFunction() was called.");
    }
	myFunction();
  </script>';
}
add_action('wp_footer', 'my_php_function');
*/