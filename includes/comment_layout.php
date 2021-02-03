<?php 

function my_comments_callback( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    $comment_id = get_comment_ID();
?>
    <div id="li-comment-<?php echo $comment_id; ?>" <?php comment_class(); ?>>
	    <div class="comm-item js-comm" id="comment-<?php echo $comment_id; ?>">
	    	<div class="comm-avatar img-box img-fit js-avatar">
	    		<div class="comm-letter" style="background-color:#778ca3"></div>
	    	</div>
	    	<div class="comm-right fx-1">
	    		<div class="comm-one nowrap">
	    			<span class="comm-author js-author"><?php echo get_comment_author(); ?></span>
	    			<?php if( get_option('admin_email') == get_comment_author_email() ): ?>
	    				<span><b><span style="color:red">Администратор</span></b></span>
	    			<?php endif; ?>
	    			<span><?php echo get_comment_date( 'd M Y, h:m ' ); ?></span>
	    		</div>
	    		<div class="comm-two clearfix full-text">
	    			<?php if(wp_get_comment_status($comment_id) == 'unapproved' && !(get_option('admin_email') == get_comment_author_email()) ): ?>
	    				<p class="com-moderate">Ваш комментарий ожидает проверки</p>
	    			<?php endif; ?>
	    			<div id="comm-id-<?php comment_ID(); ?>"><?php echo get_comment_text($comment_id); ?></div>
	    		</div>
	    		<div class="comm-three fx-row fx-middle">
	    			<div class="comm-three-left">
	    				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Ответить' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	    			</div>
	    		</div>
	    	</div>
	    </div>
    <?php
}