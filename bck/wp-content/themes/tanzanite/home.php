<?php

get_header(); ?>
<div class="container">
<div class="row" role="main">
	<div class="span8">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', 'home' ); ?>
			<?php endwhile; ?>
			
			<?php tanzanite_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

	</div><!-- #content -->
	
	<div class="span4">
        <?php get_sidebar(); ?>
    </div>
</div>
</div>
<?php get_footer(); ?>