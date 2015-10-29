<?php
/**
 * tanzanite Theme Customizer
 *
 * @package tanzanite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tanzanite_customize_register( $wp_customize ) {
	
	// Add custom description to Colors and Background sections.
	$wp_customize->get_section( 'colors' )->description           = __( 'Background may only be visible on wide screens.', 'tanzanite' );
	$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'tanzanite' );
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'tanzanite' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'tanzanite' );

	$wp_customize->add_section( 'tanzanite_general_options' , array(
       'title'      => __('Sitewide General Options','tanzanite'),
	   'description' => sprintf( __( 'Use the following settings to set Sitewide General options.', 'tanzanite' )),
       'priority'   => 30,
    ) );
	
	// Add the featured content section in case it's not already there.
	$wp_customize->add_section( 'featured_content', array(
		'title'       => __( 'Tanzanite Featured Content', 'tanzanite' ),
		'description' => sprintf( __( 'Use a <a href="%1$s">tag</a> to feature your posts. If no posts match the tag, <a href="%2$s">sticky posts</a> will be displayed instead.', 'tanzanite' ), admin_url( '/edit.php?tag=featured' ), admin_url( '/edit.php?show_sticky=1' ) ),
		'priority'    => 31,
	) );
	
	
	// Setting group for social icons
   $wp_customize->add_section( 'tanzanite_social_options' , array(
		'title'      => __('Social Options','tanzanite'),
		'description' => sprintf( __( 'Use the following settings to set Social Icon options.', 'tanzanite' )),
		'priority'   => 32,
   ) );
   
   $wp_customize->add_section( 'tanzanite_fitvids_options' , array(
       'title'      => __('Tanzanite FitVids Options','tanzanite'),
	   'description' => sprintf( __( 'Use the following settings to set fitvids script options. Options are: Enable script, Set selector (Default is .post) and set custom selector (optional) for other areas like .sidebar or a custom section!', 'tanzanite' )),
       'priority'   => 33,
    ) );
	
	$wp_customize->add_section( 'tanzanite_footer_options' , array(
       'title'      => __('Tanzanite Footer Options','tanzanite'),
	   'description' => sprintf( __( 'Use the following settings to set footer options. Current Option is: Show/Hide Footer Credits!', 'tanzanite' )),
       'priority'   => 34,
    ) );
	
	$wp_customize->add_setting('tanzanite_logo_image', array(
        'default-image'  => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'tanzanite_logo',
            array(
               'label'          => __( 'Upload a logo', 'tanzanite' ),
               'section'        => 'title_tagline',
               'settings'       => 'tanzanite_logo_image',
            )
        )
    );
	
	$wp_customize->add_setting(
        'tanzanite_logo_alt_text', array (
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
    'tanzanite_logo_alt_text',
    array(
        'type' => 'text',
		'default' => '',
        'label' => __('Enter Logo Alt Text Here', 'tanzanite'),
        'section' => 'title_tagline',
		'priority' => 20,
        )
    );
	
	// Begin General Options Section
	$wp_customize->add_setting(
    'tanzanite_feed_excerpt_length', array(
		'sanitize_callback' => 'tanzanite_sanitize_integer',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
    'tanzanite_feed_excerpt_length',
    array(
        'type' => 'text',
		'default' => '85',
        'label' => __('Blog Feed Excerpt Length', 'tanzanite'),
        'section' => 'tanzanite_general_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
    'tanzanite_recentpost_excerpt_length', array(
		'sanitize_callback' => 'tanzanite_sanitize_integer',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
    'tanzanite_recentpost_excerpt_length',
    array(
        'type' => 'text',
		'default' => '25',
		'sanitize_callback' => 'tanzanite_sanitize_integer',
        'label' => __('Recent Post Widget Excerpt Length', 'tanzanite'),
        'section' => 'tanzanite_general_options',
		'priority' => 2,
        )
    );
	
	
	// Add the featured content layout setting and control.
	$wp_customize->add_setting(
        'tanzanite_featured_section_visibility', array (
			'sanitize_callback' => 'tanzanite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'tanzanite_featured_section_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Disable Featured Content Section?', 'tanzanite'),
        'section' => 'featured_content',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
        'tanzanite_featured_layout', array (
			'sanitize_callback' => 'tanzanite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'tanzanite_featured_layout',
    array(
        'type' => 'checkbox',
        'label' => __('Switch Featured Section To Boxed View?', 'tanzanite'),
        'section' => 'featured_content',
		'priority' => 2,
        )
    );
	
	$wp_customize->add_setting( 'featured_content_layout', array(
		'default'           => 'slider',
		'sanitize_callback' => 'tanzanite_sanitize_layout',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'featured_content_layout', array(
		'label'   => __( 'Layout', 'tanzanite' ),
		'section' => 'featured_content',
		'priority' => 3,
		'type'    => 'select',
		'choices' => array(
			'slider' => __( 'Slider', 'tanzanite' ),
			'grid'   => __( 'Grid',   'tanzanite' ),
		),
	) );
	
	// Primary post type to be featured.
	$wp_customize->add_setting('featured_content_custom_type', array(
	    'default'  => 'post',
		'sanitize_callback' => 'tanzanite_sanitize_featured_type',
	));
	
	$wp_customize->add_control( 'featured_content_custom_type', array(
	    'settings' => 'featured_content_custom_type',
	    'label'   => __('Select Post Type - posts, pages & custom post types are supported!', 'tanzanite'),
	    'section'  => 'featured_content',
	    'priority' => 4,
	    'type'    => 'select',
	    'choices' => tanzanite_featured_content_type(),
	));
	
	// Featured Section Order By.
	$wp_customize->add_setting( 'tanzanite_featured_orderby', array(
	    'default' => 'date',
		'sanitize_callback' => 'tanzanite_sanitize_orderby',
		'capability' => 'edit_theme_options',
	) );
	
	$wp_customize->add_control( 'tanzanite_featured_orderby', array(
        'label'   => __( 'Featured Content Order By', 'tanzanite' ),
        'section' => 'featured_content',
	    'priority' => 5,
        'type'    => 'radio',
        'choices' => array(
            'date'          => __( 'Default - By Post Dates', 'tanzanite' ),				
		    'name'          => __( 'By Post Names', 'tanzanite' ),
			'comment_count' => __( 'Popular By Comments', 'tanzanite' ),
			'title'         => __( 'By Titles {*Pages - works on posts}', 'tanzanite' ),
			'menu_order'    => __( 'By Menu {For Pages Only!}', 'tanzanite' ),
			'rand'          => __( 'Random', 'tanzanite' ),
        ),
    ));
		
	$wp_customize->add_setting( 'tanzanite_featured_order', array(
	    'default' => 'DESC',
		'sanitize_callback' => 'tanzanite_sanitize_order',
		'capability' => 'edit_theme_options',
	) );
	
	$wp_customize->add_control( 'tanzanite_featured_order', array(
        'label'   => __( 'Featured Content Display Order - Descending|Ascending order!', 'tanzanite' ),
        'section' => 'featured_content',
	    'priority' => 6,
        'type'    => 'radio',
            'choices' => array(
                'DESC' => __( 'Descending Order - Default', 'tanzanite' ),
			    'ASC'  => __( 'Ascending Order', 'tanzanite' ),
        ),
    ));
		
    $wp_customize->add_setting( 'num_posts_slider', array( 
	    'default' => '6',
        'sanitize_callback' => 'tanzanite_sanitize_integer',
		'capability' => 'edit_theme_options',		
	) );
	
	$wp_customize->add_control( 'num_posts_slider', array(
        'label' => __( 'Number of posts for slider', 'tanzanite'),
        'section' => 'featured_content',
		'priority' => 4,
        'settings' => 'num_posts_slider',
    ) );
	
	$wp_customize->add_setting( 'num_posts_grid', array( 
	    'default' => '6',
        'sanitize_callback' => 'tanzanite_sanitize_integer',
		'capability' => 'edit_theme_options',		
	) );
	
	$wp_customize->add_control( 'num_posts_grid', array(
        'label' => __( 'Number of posts for grid - multiple of 4 i.e 4, 8, 12', 'tanzanite'),
        'section' => 'featured_content',
		'priority' => 5,
        'settings' => 'num_posts_grid',
    ) );
	
	$wp_customize->add_setting(
        'tanzanite_featured_visibility', array (
			'sanitize_callback' => 'tanzanite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'tanzanite_featured_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Show Featured Posts In Blog Feed?', 'tanzanite'),
        'section' => 'featured_content',
		'priority' => 25,
        )
    );
		
	// Begin Slider Options
	$wp_customize->add_setting(
        'tanzanite_enable_autoslide', array (
			'sanitize_callback' => 'tanzanite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'tanzanite_enable_autoslide',
    array(
        'type'     => 'checkbox',
        'label'    => __('Check to set Slider to Auto Slide', 'tanzanite'),
        'section'  => 'featured_content',
		'priority' => 26,
        )
    );
	
	$wp_customize->add_setting( 'tanzanite_slider_transition', array(
		'default' => 'fade',
		'sanitize_callback' => 'tanzanite_sanitize_slider_transition',
		'capability' => 'edit_theme_options',
	) );

	
	$wp_customize->add_control( 'tanzanite_slider_transition', array(
    'label'   => __( 'Set Slider Transition', 'tanzanite' ),
    'section' => 'featured_content',
	'priority' => 27,
    'type'    => 'radio',
        'choices' => array(
            'fade' => __( 'Fade', 'tanzanite' ),
        	'slide' => __( 'Slide', 'tanzanite' ),
		),
    ));
	
	$wp_customize->add_setting(
        'tanzanite_slider_height',
    array(
        'default' => '500',
		'sanitize_callback' => 'tanzanite_sanitize_integer',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_slider_height',
    array(
        'label' => __('Set Slider max-height (numbers only!) - Default is 500!','tanzanite'),
        'section' => 'featured_content',
		'priority' => 28,
        'type' => 'text',
    ));
		
	// == Social Links Icons Section == //
    // Begin Social Icons	
	$wp_customize->add_setting(
        'tanzanite_sidebar_social_visibility', array (
			'sanitize_callback' => 'tanzanite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'tanzanite_sidebar_social_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Show Sidebar Social Icons?','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 2,
        )
    );
	$wp_customize->add_setting(
        'tanzanite_sidebar_social_title',
    array(
		'default' => 'Connect With Us',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_sidebar_social_title',
    array(
        'label' => __('Sidebar Social Title','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 3,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_facebook_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_facebook_url',
    array(
        'label' => __('Facebook URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 4,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_gplus_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_gplus_url',
    array(
        'label' => __('Google+ URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 5,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_twitter_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_twitter_url',
    array(
        'label' => __('Twitter URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 6,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_pinterest_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_pinterest_url',
    array(
        'label' => __('Pinterest URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 7,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_instagram_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_instagram_url',
    array(
        'label' => __('Instagram URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 8,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_linkedin_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_linkedin_url',
    array(
        'label' => __('LinkedIn URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 9,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_youtube_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_youtube_url',
    array(
        'label' => __('YouTube URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 10,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_flicker_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_flicker_url',
    array(
        'label' => __('Flicker URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 11,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_wordpress_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_wordpress_url',
    array(
        'label' => __('WordPress URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 12,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_github_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
        'tanzanite_github_url',
    array(
        'label' => __('GitHub URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 13,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'tanzanite_dribbble_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
		'tanzanite_dribbble_url',
    array(
        'label' => __('Dribbble URL','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 14,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
		'tanzanite_rss_url', array (
			'sanitize_callback' => 'tanzanite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
		'tanzanite_rss_url',
    array(
        'type' => 'checkbox',
        'label' => __('Use Default RSS Feed url?', 'tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 15,
        )
    );
	
	$wp_customize->add_setting(
		'tanzanite_custom_rss_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
		'tanzanite_custom_rss_url',
    array(
        'label' => __('Alternative Custom RSS Feed URL - leave blank if above default url checked!','tanzanite'),
        'section' => 'tanzanite_social_options',
		'priority' => 16,
        'type' => 'text',
    ));
	
	// Add FitVids to site
    $wp_customize->add_setting(
        'tanzanite_fitvids_enable', array (
		'sanitize_callback' => 'tanzanite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'tanzanite_fitvids_enable',
    array(
        'type'     => 'checkbox',
        'label'    => __('Enable FitVids?', 'tanzanite'),
        'section'  => 'tanzanite_fitvids_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
    'tanzanite_fitvids_selector',
    array(
        'default' => '.post',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
    'tanzanite_fitvids_selector',
    array(
        'label' => __('Enter a selector for FitVids - i.e. .post','tanzanite'),
        'section' => 'tanzanite_fitvids_options',
		'priority' => 2,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
    'tanzanite_fitvids_custom_selector',
    array(
        'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
    'tanzanite_fitvids_custom_selector',
    array(
        'label' => __('Enter a custom selector for FitVids - i.e. .sidebar','tanzanite'),
        'section' => 'tanzanite_fitvids_options',
		'priority' => 3,
        'type' => 'text',
    ));
	
	// Begin Footer Section
	$wp_customize->add_setting(
        'tanzanite_credits_visibility', array (
		'sanitize_callback' => 'tanzanite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'tanzanite_credits_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Hide Footer Credits - We understand if you must!','tanzanite'),
        'section' => 'tanzanite_footer_options',
        )
    );
}
add_action( 'customize_register', 'tanzanite_customize_register' );

/**
 * Sanitize the Featured Content layout value.
 *
 * @since Tanzanite 1.0
 *
 * @param string $layout Layout type.
 * @return string Filtered layout type (grid|slider).
 */
function tanzanite_sanitize_layout( $layout ) {
	if ( ! in_array( $layout, array( 'grid', 'slider' ) ) ) {
		$layout = 'grid';
	}

	return $layout;
}

/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'tanzanite_sanitize_checkbox' ) ) :
	function tanzanite_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return 0;
		}
	}
endif;

/**
 * Sanitize dial select
 */
 if ( ! function_exists( 'tanzanite_sanitize_slider_transition' ) ) :
function tanzanite_sanitize_slider_transition( $transition ) {
	if ( ! in_array( $transition, array( 'slide', 'fade' ) ) ) {
		$transition = 'slide';
	}
	return $transition;
}
endif;

/**
 * Sanitize the Integer Input values.
 *
 * @since Tanzanite 1.0.1
 *
 * @param string $input Integer type.
 */
function tanzanite_sanitize_integer( $input ) {
	return absint( $input );
}

function tanzanite_featured_content_type() {
    $post_types = get_post_types();
	$cpt = array( __('Select Post Type To Feature', 'tanzanite') );
	$i = 0;
	foreach($post_types as $post_type){
		if ( in_array( $post_type, array( 'attachment', 'revision', 'nav_menu_item' ) ) ) continue;
		    if($i==0){
			    $default = $post_type;
			    $i++;
	        }
	    $cpt[$post_type] = $post_type;
	}
	return $cpt;
}

function tanzanite_sanitize_featured_type($cpt) {
    if ( ! in_array( $cpt, array() ) ) {
		$types = $cpt;
	}
	return $types;
}


/**
 * Sanitize Orderby
 */
 if ( ! function_exists( 'tanzanite_sanitize_orderby' ) ) :
function tanzanite_sanitize_orderby( $orderby ) {
	if ( ! in_array( $orderby, array( 'date', 'name', 'comment_count', 'title', 'menu_order', 'rand' ) ) ) {
		$orderby = 'date';
	}
	return $orderby;
}
endif;

/**
 * Sanitize Orderby
 */
 if ( ! function_exists( 'tanzanite_sanitize_order' ) ) :
function tanzanite_sanitize_order( $order ) {
	if ( ! in_array( $order, array( 'DESC', 'ASC' ) ) ) {
		$order = 'DESC';
	}
	return $order;
}
endif;

if ( get_theme_mod( 'tanzanite_slider_height' ) ) {
function tanzanite_slider_scripts() {
 
$overall_slider_height = esc_html( get_theme_mod( 'tanzanite_slider_height' ));
?>
    <style>
		.slider .featured-content .hentry {
			max-height: <?php echo $overall_slider_height; ?>px;
        }
	</style>
<?php }

add_action( 'wp_head', 'tanzanite_slider_scripts', 210 );
}

//dequeue/enqueue scripts
function tanzanite_featured_content_scripts() {
$tanzanite_theme = wp_get_theme();
$version = $tanzanite_theme->get( 'Version' );
if ( get_theme_mod( 'tanzanite_enable_autoslide' ) != 0 &&  get_theme_mod( 'featured_content_layout' ) == 'slider' ) {

if ( is_front_page() ) :
    wp_dequeue_script( 'tanzanite-slider' );

    wp_enqueue_script( 'tanzanite-flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array( 'jquery', ), $version, true );
    wp_localize_script( 'tanzanite-flexslider', 'featuredSliderDefaults', array(
        'prevText' => __( 'Previous', 'tanzanite' ),
        'nextText' => __( 'Next', 'tanzanite' )
    ) );

if ( get_theme_mod( 'tanzanite_slider_transition' ) ==  'slide' ) :
    wp_enqueue_script( 'tanzanite-slider-slide', get_template_directory_uri() . '/js/flexslider/slider-slide.js', array( 'jquery', ), $version, true );

elseif ( get_theme_mod( 'tanzanite_slider_transition' ) == 'fade' ) :
    wp_enqueue_script( 'tanzanite-slider-fade', get_template_directory_uri() . '/js/flexslider/slider-fade.js', array( 'jquery', ), $version, true );

endif;

endif;
} elseif ( get_theme_mod( 'featured_content_layout' ) == 'slider' ) {
    wp_enqueue_script( 'tanzanite-slider-fade', get_template_directory_uri() . '/js/flexslider/slider-default.js', array( 'jquery', ), $version, true );
}
}
add_action( 'wp_enqueue_scripts' , 'tanzanite_featured_content_scripts' , 210 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tanzanite_customize_preview_js() {
	wp_enqueue_script( 'tanzanite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'tanzanite_customize_preview_js' );
