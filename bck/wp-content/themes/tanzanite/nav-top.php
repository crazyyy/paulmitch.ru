<div class="navbar navbar-static-top">
    <div class="navbar-inner top-menu">
        <div class="container">
		<div class="row">
        <?php if (get_theme_mod( 'tanzanite_logo_image' )) : ?>
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			    <img src="<?php echo get_theme_mod( 'tanzanite_logo_image' ); ?>" alt="<?php echo esc_html(get_theme_mod( 'tanzanite_logo_alt_text' )); ?>" />
			</a>
		<?php else : ?>
            <a class="brand" href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span><?php bloginfo( 'name' ); ?></span></a>
        <?php endif; ?>
			<?php // if ( get_theme_mod( 'tanzanite_top_menu_visibility' ) != 0 ) { ?>
			<?php if ( has_nav_menu( 'top-menu' ) ) : ?>
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
			<!-- Our menu needs to go here -->
			
			<?php wp_nav_menu( array(
	           'theme_location'	 => 'top-menu',
			   'container_class' => 'nav-collapse top-collapse',
	           'menu_class'		 =>	'nav pull-right',
	           'depth'			 =>	0,
	           'fallback_cb'	 =>	false,
	           'walker'			 =>	new Tanzanite_Nav_Walker,
	           )); 
             endif; //} ?>
		</div> <!-- /.row -->
		<div class="row">
	    <h3 class="span6 site-description"><?php bloginfo( 'description' ); ?></h3>
	    <div class="span6 pull-right">
		    <?php get_template_part( 'social-widget' ); ?>
	    </div>
        </div>
        </div> <!-- /.container -->
	</div><!-- /.navbar-inner -->
</div><!-- /.navbar -->

<div class="navbar navbar-inverse navbar-static-top">
       <div class="navbar-inner">
        <div class="container">
            
			<!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".bottom-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
			<!-- Our menu needs to go here -->
			<?php wp_nav_menu( array(
	           'theme_location'	 => 'primary',
			   'container_class' => 'nav-collapse bottom-collapse',
	           'menu_class'		 =>	'nav',
	           'depth'			 =>	0,
	           'fallback_cb'	 =>	false,
	           'walker'			 =>	new Tanzanite_Nav_Walker,
	           )); 
            ?>
        </div>
		</div><!-- /.navbar-inner -->
	</div><!-- /.navbar -->
