<?php
/*
Plugin Name: Coming Next
Plugin URI: http://nettuts.com
Description: Shows the next scheduled posts with brief descriptions. 
Version: 1.0
Author: Jarkko Laine
Author URI: http://jarkkolaine.com
*/
define(COMING_NEXT_WIDGET_ID, "widget_coming_next");

function list_upcoming_posts($num_posts = 1, $show_excerpt = false, 
                             $text_format = "Coming Up on [date]") {
  $posts = get_posts("numberposts=".$num_posts."&order=ASC&post_status=future");
 
  echo "<ul class=\"upcoming-posts\">";
  global $post;
  $old_post = $post;
 
  foreach ($posts as $post) :
    setup_postdata($post);
    $my_date = the_date('', '', '', FALSE);
    $coming_up_text = str_replace("[date]", $my_date, $text_format);
  ?>
    <li class="upcoming-post">
      <span class="upcoming-post-date"><?php echo $coming_up_text; ?></span>
      <span class="upcoming-post-title"><?php the_title(); ?></span>
      <?php if ($show_excerpt) : ?>
        <span class="upcoming-post-description">
          <?php the_excerpt_rss(); ?>
        </span>
      <?php endif; ?>
    </li>
  <?php
  endforeach;
 
  $post = $old_post;
  setup_postdata($post);
  echo "</ul>";
}
//Render the widget
function widget_coming_next($args) {
  extract($args, EXTR_SKIP);
  $options = get_option(COMING_NEXT_WIDGET_ID);
 
  // Query the next scheduled post
  $num_posts = $options["num_posts"];
  $show_excerpt = $options["show_excerpt"];
  $coming_up_text = $options["coming_up_text"];
 
  echo $before_widget;
  list_upcoming_posts($num_posts, $show_excerpt, $coming_up_text);
  echo $after_widget;
}

//Register the widget
function widget_coming_next_init() {
  wp_register_sidebar_widget(COMING_NEXT_WIDGET_ID, 
    __('Coming Next'), 'widget_coming_next');
}
 
// Register widget to WordPress
add_action("plugins_loaded", "widget_coming_next_init");

//Widget settings
function widget_coming_next_control() {
  $options = get_option(COMING_NEXT_WIDGET_ID);
  if (!is_array($options)) {
    $options = array();
  }
 
  $widget_data = $_POST[COMING_NEXT_WIDGET_ID];
  if ($widget_data['submit']) {
    $options['num_posts'] = $widget_data['num_posts'];
    $options['coming_up_text'] = $widget_data['coming_up_text'];
    $options['show_excerpt'] = $widget_data['show_excerpt'];
 
    update_option(COMING_NEXT_WIDGET_ID, $options);
  }
 
  // Render form
  $num_posts = $options['num_posts'];
  $coming_up_text = $options['coming_up_text'];
  $show_excerpt = $options['show_excerpt'];
   
  // The HTML form will go here
  ?>
<p>
  <label for="<?php echo COMING_NEXT_WIDGET_ID;?>-num-posts">
    Number of posts to show:
  </label>
  <input class="widefat"
    type="text"
    name="<?php echo COMING_NEXT_WIDGET_ID; ?>[num_posts]" 
    id="<?php echo COMING_NEXT_WIDGET_ID; ?>-num-posts" 
    value="<?php echo $num_posts; ?>"/>
</p>
<p>
  <label for="<?php echo COMING_NEXT_WIDGET_ID;?>-coming-up-text">
    "Coming Up Next" text (use the [date] tag to 
    display the publish date):
  </label>
  <input class="widefat" type="text"
    name="<?php echo COMING_NEXT_WIDGET_ID; ?>[coming_up_text]" 
    id="<?php echo COMING_NEXT_WIDGET_ID; ?>-coming-up-text" 
    value="<?php echo $coming_up_text; ?>"/>
</p>
<p>
  <label for="<?php echo COMING_NEXT_WIDGET_ID;?>-show-excerpt">
    Show excerpt:
  </label>
  <select class="widefat"
    name="<?php echo COMING_NEXT_WIDGET_ID; ?>[show_excerpt]"
    id="<?php echo COMING_NEXT_WIDGET_ID;?>-show-exceprt">
    <option value="1" <?php echo ($show_excerpt == "1") ? "selected" : ""; ?>>
      Yes
    </option>
    <option value="0" <?php echo ($show_excerpt == "1") ? "" : "selected"; ?>>
      No
    </option>
  </select>
</p>
<input type="hidden"
  name="<?php echo COMING_NEXT_WIDGET_ID; ?>[submit]" 
  value="1"/>
<?php
}
//Register form 
wp_register_widget_control(COMING_NEXT_WIDGET_ID, 
    __('Coming Next'), 'widget_coming_next_control');

?>