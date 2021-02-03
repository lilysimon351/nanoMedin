<?php get_header(); ?>
	 <div class="sect">
	 	<div class="sect-header fx-row fx-middle">
	 		<div class="sect-title fx-1 title">Все статьи</div>
	 	</div>
	 	<?php if(have_posts()): ?>
	 	<div class="sect-content">
	 		<div id='dle-content'>
	 			<?php 
					four_in_row("orderby=date&order=DESC&post_type=post&posts_per_page=4"); 
				?>
				<?php 
					$args = array(
						'show_all'           => true, // показаны все страницы участвующие в пагинации
						'end_size'           => 1,     // количество страниц на концах
						'mid_size'           => 1,     // количество страниц вокруг текущей
						'prev_next'          => false,  // выводить ли боковые ссылки "предыдущая/следующая страница".
						'add_args'           => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
						'add_fragment'       => '',     // Текст который добавиться ко всем ссылкам.
						'screen_reader_text' => __( 'Навигация по записям' ),
						'aria_label'         => __( 'Записи' ), // aria-label="" для nav элемента. С WP 5.3
						'class'              => 'pagination',  // class="" для nav элемента. С WP 5.5
					);

				 ?>
				<?php echo get_the_posts_pagination($args); ?>
	 		</div>
	 	</div>
	 	<?php else: ?>
	 		<p>нет постов</p>
	 	<?php endif; ?>
	 </div>
<?php get_footer(); ?>