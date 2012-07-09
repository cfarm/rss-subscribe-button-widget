<?php
/*Plugin Name: RSS Subscribe Button Widget
Plugin URI: http://blogs.brynmawr.edu/
Version: 1.0
Description: A widget that adds an RSS Subscribe Button to your sidebar for your blog's RSS feed
Author: Catherine Farman, Bryn Mawr Web Services
Author URI: http://brynmawr.edu/web
*/
 
class RSS_subscribe_button_widget extends WP_Widget
{
  function RSS_subscribe_button_widget()
  {
    $widget_ops = array('classname' => 'RSS_subscribe_button_widget', 'description' => 'adds an RSS Subscribe Button to your sidebar for your blog\'s RSS feed');
    $this->WP_Widget('RSS_subscribe_button_widget', 'RSS Subscribe Button Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array( 'title' => 'Subscribe to RSS feed' ));
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
//    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
 
//    if (!empty($title))
//      echo $before_title . $title . $after_title;;
 	
	$feed_url = get_bloginfo('rss2_url');
	$theme_url = get_bloginfo('template_directory');
    // Do Your Widgety Stuff Here...
    echo "<h3><a href='$feed_url'><img style='float:left;margin-top:3px;margin-right:5px;background:orange;color:white;border:none;' width='14' height='14' src='$theme_url' alt='RSS' />$title</a></h3>"; 
//    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("RSS_subscribe_button_widget");') );
 
?>