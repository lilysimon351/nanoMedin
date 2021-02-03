<?php 

add_action('add_meta_boxes', 'my_extra_fields', 1);
function my_extra_fields() {
	add_meta_box( 'related_posts', 'Допольнительные поля', 'related_posts_box_func', 'post', 'normal', 'high'  );
}

function related_posts_box_func( $post ){
	?>
	<p>
		<label for="rel-input">Похожие темы</label>
		<br>
		<br>
		<input id="rel-input" type="text" name="extra[related_posts]" value="<?php echo get_post_meta($post->ID, 'related_posts', 1); ?>" style="width:50%" placeholder="23, 46, 53">
	</p>

	<p>
		<label for="rel-input">Читать еще</label>
		<br>
		<br>
		<input id="rel-input" type="text" name="extra[read_also]" value="<?php echo get_post_meta($post->ID, 'read_also', 1); ?>" style="width:50%" placeholder="23, 46, 53">
	</p>

	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<?php
}

add_action( 'save_post', 'my_extra_fields_update', 0 );
function my_extra_fields_update( $post_id ){

	if (
		   empty( $_POST['extra'] )
		|| ! wp_verify_nonce( $_POST['extra_fields_nonce'], __FILE__ )
		|| wp_is_post_autosave( $post_id )
		|| wp_is_post_revision( $post_id )
	)
		return false;
	
	$_POST['extra'] = array_map( 'sanitize_text_field', $_POST['extra'] );
	foreach( $_POST['extra'] as $key => $value ){
		if( empty($value) ){
			update_post_meta( $post_id, $key, $value );
			continue;
		}

		update_post_meta( $post_id, $key, $value );
	}

	return $post_id;
}