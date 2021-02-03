<?php
class BannerWidget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'banner_widget', 
			'Баннеры, посты сайдбара', // заголовок виджета
			array( 'description' => 'Выводит баннеры и посты в сайдбар' ) // описание
		);
	}
	
	public function widget( $args, $instance ) {
 
 		?>
 		<aside class="col-right">
 			<div class="side-box">
 				<a href="<?php echo $instance[ 'link_0_id' ]; ?>">
 					<?php echo wp_get_attachment_image($instance[ 'image_0_id' ], 'full '); ?>
 				</a>
 			</div>
 			<div class="side-box">
				<div class="side-bt title">Лента новостей</div>
				<div class="side-bc">
					<?php
						$post_ids = explode(",", $instance[ 'post_ids' ]);
						$ids_arr = array_filter($post_ids, 'strlen');
						$q = new WP_Query( [ "post__in" => $ids_arr, "orderby" => "date" ] );
						if( $q->have_posts() ): ?>

							<?php

							while( $q->have_posts() ): $q->the_post(); ?>
								<a href="<?php the_permalink(); ?>" class="small-item fx-row">
					 				<div class="small-item-img img-box img-fit">
					 					<?php if(has_post_thumbnail()): ?>
					 						<?php the_post_thumbnail(); ?>
					 						<?php else: ?>
					 							<img src="/wp-content/themes/nano/images/no_image.jpg" alt="нет фото">
					 						<?php endif; ?>
					 				</div>
					 				<div class="small-item-text fx-1">
					 					<div class="small-item-title title"><?php the_title(); ?></div>
					 					<div class="small-item-meta nowrap"><?php echo get_the_date('d\.m\.y'); ?>, <?php $cat = wp_get_object_terms( get_the_ID(), 'category', array('fields' => 'names') ); echo $cat[0] ; ?></div>
					 				</div>
				 				</a>

						<?php	
							endwhile;
						endif;
						wp_reset_postdata();
					 ?>
	 			</div>
 			</div>
 			<div class="side-box side-sticky">
 				<a href="<?php echo $instance[ 'link_1_id' ]; ?>">
 					<?php echo wp_get_attachment_image($instance[ 'image_1_id' ], 'full '); ?>
 				</a>
 			</div>
 		</aside>
 		<?php 
		
	}
 
	public function form( $instance ) {
		$count = 2;
		for ($i=0; $i < $count; $i++) { 
			if ( isset( $instance[ 'link_'.$i.'_id' ] ) ) {
				$link_id = $instance[ 'link_'.$i.'_id' ];
			}
			else {
				$link_id = 'http://nanomedin.ru';
			}
			$image_id = $instance[ 'image_'.$i.'_id' ];
		?>

			<p>
				<label for="<?php echo $this->get_field_id( 'image_'.$i.'_id' ); ?>">ID изображения</label> 
				<br>
				<input id="<?php echo $this->get_field_id( 'image_'.$i.'_id' ); ?>" name="<?php echo $this->get_field_name( 'image_'.$i.'_id' ); ?>" type="number" value="<?php echo ($image_id) ? esc_attr( $image_id ) : '745'; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'link_'.$i.'_id' ); ?>">Ссылка для баннера: </label> 
				<br>
				<input id="<?php echo $this->get_field_id( 'link_'.$i.'_id' ); ?>" name="<?php echo $this->get_field_name( 'link_'.$i.'_id' ); ?>" type="text" value="<?php echo ($link_id) ? esc_attr( $link_id ) : '/'; ; ?>"  placeholder="https://"/>
			</p>
		<?php 
		}

			$post_ids = $instance[ 'post_ids' ];

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'post_ids' ); ?>">ID постов:</label> 
			<input id="<?php echo $this->get_field_id( 'post_ids' ); ?>" name="<?php echo $this->get_field_name( 'post_ids' ); ?>" type="text" value="<?php echo ($post_ids); ?>" placeholder="1, 3, 4, 5" />
		</p>
		<?php 
	}
 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$count = 2;
		for ($i=0; $i < $count; $i++) { 
			$instance['link_'.$i.'_id'] = $new_instance['link_'.$i.'_id'];
			$instance['image_'.$i.'_id'] = $new_instance['image_'.$i.'_id'];
		}

		$instance['post_ids'] = $new_instance['post_ids'] ; 
		return $instance;
	}
}
 
function sidebarBanner_widget() {
	register_widget( 'BannerWidget' );
}
add_action( 'widgets_init', 'sidebarBanner_widget' );