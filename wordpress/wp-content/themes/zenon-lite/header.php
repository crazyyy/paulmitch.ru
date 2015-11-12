<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>

  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
  <link href='http://fonts.googleapis.com/css?family=Cuprum&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
  <link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon">

  <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script>
  <![endif]-->
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="social_wrap">
  <div class="social">
    <ul>
      <li class="soc_vk">
        <a title="Vkontakte" rel="nofollow" target="_blank" href="http://vk.com/pmitchellsell">Vkontakte</a>
      </li>
      <li class="soc_fb">
        <a title="Facebook" target="_blank" rel="nofollow" href="https://www.facebook.com/pmitchellsell">Facebook</a>
      </li>
      <li class="soc_inst">
        <a title="Instagram" target="_blank" rel="nofollow" href="https://www.instagram.com/paul_mitchell_sell/">Instagram</a>
      </li>
    </ul>
  </div>
</div><!-- social_wrap -->

<div class="center">
  <!--HEADER START-->
  <div id="header">
    <!--LOGO START-->
    <div class="logo">
      <h6><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name') ;?></a></h6>
      <div class="desc"><?php bloginfo('description')?></div>
    </div>
    <!--LOGO END-->

    <!--MENU STARTS-->
    <div id="menu_wrap">
      <div class="center">
        <div id="topmenu">
          <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
          <div class="search-block">
            <form id="form-cart" method="get" name="searchform" action="<?php bloginfo('url'); ?>/">
                <input type="text" value="" name="s" placeholder="Поиск" />
                <button class="fa fa-search"></button>
            </form>
            <div id="shopping-cart" class="shopping-cart">
              <i class="fa fa-shopping-cart"></i>: <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span>) <a href="javascript:;" class="simpleCart_checkout"><i class="fa-check-circle fa"></i></a>
            </div><!-- /.shopping-cart -->
          </div>
          <!-- /.search-block -->
        </div><!-- topmenu -->
      </div>
    </div>
    <!--MENU END-->
  </div>
  <!--HEADER END-->


