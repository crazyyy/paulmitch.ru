<?php
    add_theme_support('custom-background');
  add_theme_support('automatic-feed-links');
  if ( ! isset( $content_width ) )
  $content_width = 630;

//Post Thumbnail

   add_theme_support( 'post-thumbnails' );

//Register Menus
  register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'zenon' ),
    'footer' => __( 'Footer Navigation', 'zenon' )
  ) );


//Include CSS
function znn_customstyle() { ?>

<?php if(of_get_option('prmtrans_checkbox') == "1"){ ?>
<style type="text/css">
#zn_slider, .midrow_blocks, .lay1 .hentry, .lay2, .lay3 .post_image, .lay3 .post_content, .single_post, .commentlist li, #commentform, #commentform label, #sidebar .widgets .widget, #footer, #copyright, .amp_current, .amp_page:hover, .amp_next:hover, .amp_prev:hover, .page-numbers:hover, .navigation .current, #related_wrap ul, .trigger_wrap, .search_term, ol#controls li, .amp_page, .amp_next, .amp_prev, .page-numbers{ background:url(<?php echo get_template_directory_uri(); ?>/images/trans_black4.png) repeat; }
.comment-form-comment textarea, .comment-form-author input, .comment-form-email input, .comment-form-url input{background:url(<?php echo get_template_directory_uri(); ?>/images/trans_black3.png) repeat;}
.lay3_bridge{ display:none;}

.skew_bottom_big, .skew_bottom_right, .skew_top_big, .skew_top_right, .single_skew, .single_skew .skew_bottom_big, .single_skew .skew_bottom_right, .depth-1 .single_skew, .single_skew_comm, .single_skew_comm .skew_top_big, .single_skew_comm .skew_top_right, #respond_wrap .single_skew, #respond_wrap .single_skew_comm{display:none!important;}
.commentlist .depth-1{ margin-top:10px;}
.midrow_blocks{ margin-top:30px;}
.commentlist li{border-bottom:1px solid #ececec; border-top:1px solid #ececec;}
</style>
<?php } ?>

<?php if(of_get_option('rounded_checkbox') == "1"){ ?>
<style type="text/css">
.skew_bottom_big, .skew_bottom_right, .skew_top_big, .skew_top_right, .single_skew, .single_skew .skew_bottom_big, .single_skew .skew_bottom_right, .depth-1 .single_skew, .single_skew_comm, .single_skew_comm .skew_top_big, .single_skew_comm .skew_top_right, #respond_wrap .single_skew, #respond_wrap .single_skew_comm{display:none!important;}
.commentlist .depth-1{ margin-top:10px;}
.midrow_blocks{ margin-top:30px;}
.commentlist li{border-bottom:1px solid #ececec; border-top:1px solid #ececec;}

.home #topmenu{border-radius: 8px 8px 0 0; -moz-border-radius: 8px 8px 0 0; -webkit-border-radius: 8px 8px 0 0;behavior: url(<?php echo get_template_directory_uri(); ?>/images/PIE.htc);}
#zn_slider, #topmenu ul li ul{border-radius: 0 0 8px 8px; -moz-border-radius: 0 0 8px 8px; -webkit-border-radius: 0 0 8px 8px;behavior: url(<?php echo get_template_directory_uri(); ?>/images/PIE.htc);}
#topmenu, .midrow_blocks, #footer, #copyright, .lay1 .hentry, .single_post, #sidebar .widgets .widget, .commentlist .depth-1, #commentform, .comment-form-comment textarea, .form-submit input, #searchsubmit, #related_wrap ul, .znn_paginate span, .znn_paginate a, .navigation a, .navigation span, .lay2, .lay3 .post_image, .lay3 .post_content, .comment-form-author input, .comment-form-email input, .comment-form-url input, .commentlist li ul li .comment-body{border-radius:8px; -moz-border-radius:8px; -webkit-border-radius:8px;behavior: url(<?php echo get_template_directory_uri(); ?>/images/PIE.htc);}
#commentform label{border-radius: 8px 0 0 8px; -moz-border-radius: 8px 0 0 8px; -webkit-border-radius: 8px 0 0 8px;behavior: url(<?php echo get_template_directory_uri(); ?>/images/PIE.htc);}

</style>
<?php } ?>

<?php if(of_get_option('skewed_checkbox') == "0"){ ?>
<style type="text/css">
.skew_bottom_big, .skew_bottom_right, .skew_top_big, .skew_top_right, .single_skew, .single_skew .skew_bottom_big, .single_skew .skew_bottom_right, .depth-1 .single_skew, .single_skew_comm, .single_skew_comm .skew_top_big, .single_skew_comm .skew_top_right, #respond_wrap .single_skew, #respond_wrap .single_skew_comm{display:none!important;}
.commentlist .depth-1{ margin-top:10px;}
.midrow_blocks{ margin-top:30px;}
.commentlist li{border-bottom:1px solid #ececec; border-top:1px solid #ececec;}
</style>
<?php } else { ?>
<style type="text/css">#zn_slider{ border:none;}</style>
<?php } ?>

<?php }

add_action( 'wp_head', 'znn_customstyle' );


function znn_mobile_css() {
if ( !is_admin() ) {
wp_enqueue_style( 'znn_mobile', get_template_directory_uri() . '/mobile.css', false, '1.0', 'only screen and (max-width: 400px)' );
  }
}
add_action('wp_enqueue_scripts', 'znn_mobile_css');

function znn_ie_css() {
if ( !is_admin() ) {
    wp_register_style( 'znn_ie', get_template_directory_uri().'/css/ie.css', false, 1.5 );
    $GLOBALS['wp_styles']->add_data( 'znn_ie', 'conditional', 'IE 8' );
    wp_enqueue_style( 'znn_ie' );
  }
}
add_action('wp_enqueue_scripts', 'znn_ie_css');



function wpeHeaderScripts() {
  if (!is_admin()) {
    wp_deregister_script('jquery'); // Deregister WordPress jQuery   RU: Отключаю стандартный JQuery WordPress'а
    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.js', array(), '1.11.0'); // Google CDN jQuery   RU: Регистрирую JQuery с хостинга Google
    wp_enqueue_script('jquery'); // Enqueue it!    RU: Подключаю его

    wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.8.3'); // Modernizr
    wp_enqueue_script('modernizr'); // Enqueue it!

    wp_register_script('jqueryf', get_template_directory_uri() . '/js/jquery.js', array(), '1.11.0', true);
    wp_enqueue_script('jqueryf'); // Enqueue it!    RU: Подключаю его

    //  Load footer scripts (footer.php)
    wp_register_script('wpeScripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true); // Custom scripts
    wp_enqueue_script('wpeScripts'); // Enqueue it!
  }
}
add_action('wp_enqueue_scripts', 'wpeHeaderScripts');

//  Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action('wp_head', array(
    $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
    'recent_comments_style'
  ));
}



//Zenon get the first image of the post Function
function znn_get_images($overrides = '', $exclude_thumbnail = false) {
  return get_posts(wp_parse_args($overrides, array(
      'numberposts' => -1,
      'post_parent' => get_the_ID(),
      'post_type' => 'attachment',
      'post_mime_type' => 'image',
      'order' => 'ASC',
      'exclude' => $exclude_thumbnail ? array(get_post_thumbnail_id()) : array(),
      'orderby' => 'menu_order ID'
  )));
}


// Change what's hidden by default
add_filter('default_hidden_meta_boxes', 'znn_hidden_meta_boxes', 10, 2);
function znn_hidden_meta_boxes($hidden, $screen) {
  if ( 'post' == $screen->base || 'page' == $screen->base || 'slider' == $screen->base  )
    $hidden = array('slugdiv', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv');
    // removed 'postcustom',
  return $hidden;
}


//Custom Excerpt Length
function znn_excerptlength_teaser($length) {
    return 33;
}
function znn_excerptlength_index($length) {
    return 12;
}
function znn_excerptmore($more) {
    return '...';
}

function znn_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

//SIDEBAR
function znn_widgets_init(){
  register_sidebar(array(
  'name'          => __('Right Sidebar', 'zenon'),
  'id'            => 'sidebar',
  'description'   => __('Right Sidebar', 'zenon'),
  'before_widget' => '<li id="%1$s" class="widget %2$s"><div class="widget_top"></div><div class="widget_wrap">',
  'after_widget'  => '</div><div class="widget_bottom"></div>',
  'before_title'  => '<h3 class="widgettitle">',
  'after_title'   => '</h3>'
  ));

  register_sidebar(array(
  'name'          => __('Footer Widgets', 'zenon'),
  'id'            => 'foot_sidebar',
  'description'   => __('Widget Area for the Footer', 'zenon'),
  'before_widget' => '<li id="%1$s" class="widget %2$s"><div class="widget_wrap">',
  'after_widget'  => '</div>',
  'before_title'  => '<h3 class="widgettitle">',
  'after_title'   => '</h3>'
  ));
}

add_action( 'widgets_init', 'znn_widgets_init' );


//ZENON COMMENTS
function znn_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div class="single_skew_comm">
        <div class="skew_top_big"></div>
        <div class="skew_top_right"></div>
    </div>

     <div id="comment-<?php comment_ID(); ?>" class="comment-body">
      <div class="comment-author vcard">
      <div class="avatar"><?php echo get_avatar($comment,$size='50' ); ?></div>
      </div>
      <div class="comment-meta commentmetadata">
      <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> <?php _e('on' , 'zenon'); ?> <a class="comm_date"><?php printf(get_comment_date()) ?></a> <a class="comm_time"><?php printf( get_comment_time()) ?></a>
        </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'zenon') ?></em>
         <br />
      <?php endif; ?>

      <div class="org_comment"><?php comment_text() ?>
        <div class="comm_meta_reply">
        <div class="comm_reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
        <div class='comm_edit'><?php edit_comment_link(__('Edit', 'zenon'),'  ','') ?></div></div>
     </div>

     </div><div class="single_skew">
        <div class="skew_bottom_big"></div>
        <div class="skew_bottom_right"></div>
    </div>
<?php
        }

//ZENON TRACKBACKS & PINGS
function znn_ping($comment, $args, $depth) {

$GLOBALS['comment'] = $comment; ?>

   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

     <div id="comment-<?php comment_ID(); ?>" class="comment-body">
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'zenon') ?></em>
         <br />
      <?php endif; ?>

      <div class="org_ping">
        <?php printf(__('<cite class="citeping">%s</cite> <span class="says">:</span>'), get_comment_author_link()) ?>
      <?php comment_text() ?>
            <div class="comment-meta commentmetadata">
            <a class="comm_date"><?php printf(get_comment_date()) ?></a>
            <a class="comm_time"><?php printf( get_comment_time()) ?></a>
            <div class='comm_edit'><?php edit_comment_link(__('Edit', 'zenon'),'  ','') ?></div></div>
     </div>
     </div>


<?php }

//Add Custom Slider Post
add_action('init', 'znn_slider_register');

function znn_slider_register() {

  $labels = array(
    'name' => __('Slider', 'zenon'),
    'singular_name' => __('Slider Item', 'zenon'),
    'add_new' => __('Add New', 'zenon'),
    'add_new_item' => __('Add New Slide', 'zenon'),
    'edit_item' => __('Edit Slides', 'zenon'),
    'new_item' => __('New Slider', 'zenon'),
    'view_item' => __('View Sliders', 'zenon'),
    'search_items' => __('Search Sliders', 'zenon'),
    'menu_icon' => get_stylesheet_directory_uri() . 'images/article16.png',
    'not_found' =>  __('Nothing found', 'zenon'),
    'not_found_in_trash' => __('Nothing found in Trash', 'zenon'),
    'parent_item_colon' => ''
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'menu_icon' => get_stylesheet_directory_uri() . '/images/slides.png',
    'rewrite' => false,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','excerpt','thumbnail'),
    'register_meta_box_cb' => 'znn_add_meta'
    );

  register_post_type( 'slider' , $args );
}
//Slider Link Meta Box
add_action("admin_init", "znn_add_meta");

function znn_add_meta(){
  add_meta_box("znn_credits_meta", "Link", "znn_credits_meta", "slider", "normal", "low");
}


function znn_credits_meta( $post ) {

  // Use nonce for verification
  $znndata = get_post_meta($post->ID, 'znn_slide_link', TRUE);
  wp_nonce_field( 'znn_meta_box_nonce', 'meta_box_nonce' );

  // The actual fields for data entry
  echo '<input type="text" id="znn_sldurl" name="znn_sldurl" value="'.$znndata.'" size="75" />';
}

//Save Slider Link Value
add_action('save_post', 'znn_save_details');
function znn_save_details($post_id){
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'znn_meta_box_nonce' ) ) return;

  if ( !current_user_can( 'edit_post', $post_id ) )
        return;

$znndata = esc_url( $_POST['znn_sldurl'] );
update_post_meta($post_id, 'znn_slide_link', $znndata);
return $znndata;
}



add_action('do_meta_boxes', 'znn_slider_image_box');

function znn_slider_image_box() {
  remove_meta_box( 'postimagediv', 'slider', 'side' );
  add_meta_box('postimagediv', __('Slide Image', 'zenon'), 'post_thumbnail_meta_box', 'slider', 'normal', 'high');
}

/*
 * Loads the Options Panel
 */



  /* Set the file path based on whether we're in a child theme or parent theme */

  if ( STYLESHEETPATH == TEMPLATEPATH ) {
    define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
  } else {
    define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/admin/');
  }

  require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');


include(TEMPLATEPATH . '/lib/script/pagination.php');
include(TEMPLATEPATH . '/lib/includes/shortcodes.php');
include(TEMPLATEPATH . '/lib/includes/widgets.php');


//  Catch first image from post and display it
function catchFirstImage() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
    $post->post_content, $matches);
  $first_img = $matches [1] [0];
  if(empty($first_img)){
    $first_img = get_template_directory_uri() . '/img/noimage.jpg'; }
    return $first_img;
}


?>
