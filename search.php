<?php get_header(); ?>
	<div class="sect">
		<?php global $wp_query; ?>
		<?php if ( have_posts() ) : ?>
			<div class="sect-content">
				<div id="dle-content">
					<div class="search-page">
						<div class="berrors">
							<b>Информация</b>
							<br><br
							>По Вашему запросу найдено <?php echo  $wp_query->found_posts; ?> ответов 
						</div>
					</div>

				 			<?php while ( have_posts() ) : ?>
				 				<?php the_post(); ?>
				 				<?php get_template_part('post-templates/short-item'); ?>
				 			<?php endwhile; ?>
				 					
							<?php pagination(); ?>
				</div>
			</div>
        <?php else : ?>
			
			<div class="berrors">
				<b>Информация</b><br><br>
				К сожалению, поиск по сайту не дал никаких результатов. Попробуйте изменить или сократить Ваш запрос.
			</div>
			<div class="sect">
							
				<div class="sect-content">
					<div id="dle-content"><div class="search-page">
						<header class="sub-title"><h1>Поиск по сайту</h1></header>
							<div class="searchtable" id="searchtable" name="searchtable">
								<?php get_template_part('search-form-templates/full'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>

		</div>
<?php get_footer(); ?>