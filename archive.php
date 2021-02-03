<?php get_header(); ?>
<?php
	if( is_category() ):
		$title = get_cat_name(get_query_var('cat'));
	else:
		$title = "Статьи";
	endif;
?>
		 <div class="sect">
		 	<div class="sect-header fx-row fx-middle">
		 		<div class="sect-title fx-1 title"><?php echo $title; ?></div>
		 	</div>
		 	<?php if(have_posts()): ?>

			 	<div class="sect-content">
			 		<div id='dle-content'>

			 			<?php while ( have_posts() ) : ?>
			 				<?php the_post(); ?>
			 				<?php get_template_part('post-templates/short-item'); ?>
			 			<?php endwhile; ?>
			 					
						<?php pagination(); ?>
						
			 		</div>
			 	</div>

		 	<?php else: ?>
		 		<p>нет постов</p>
		 	<?php endif; ?>
		 </div>
		 
<?php get_footer(); ?>