
<?php 
if ( post_password_required() ) {
	return;
}

$commenter = wp_get_current_commenter();

$fields =  array(
    'author' => '<div id="add-comms"><div class="ac-inputs fx-row">' . 
        '<input id="author" name="author" type="text" placeholder="Ваше имя" value="' . esc_attr( $commenter['comment_author'] ) . '" size="60"/></p>',
    'email'  => '<input id="email" name="email" type="text" placeholder="Ваш e-mail" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="60" />
    	</div>
    	</div>'
);
 
$comments_args = array(
    'fields' =>  $fields,
    'comment_field' => '<div class="ac-textarea"><textarea id="comment" name="comment" cols="50" class="ajaxwysiwygeditor fr-box fr-ltr gray-theme fr-basic fr-top"></textarea></div>',
    'must_log_in'          => '',
	'logged_in_as'         => '',
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	'id_form'              => 'commentform',
	'id_submit'            => 'submit',
	'class_form'           => 'add-comms comment-form',
	'class_submit'         => 'submit',
	'name_submit'          => 'submit',
	'title_reply'          => '',
	'title_reply_to'       => '',
	'title_reply_before'   => '',
	'title_reply_after'    => '',
	'cancel_reply_before'  => '',
	'cancel_reply_after'   => '',
	'cancel_reply_link'    => '',
	'label_submit'         => '',
	'submit_button'        => '<button name="%1$s" class="%3$s" type="submit">Добавить</button>',
	'submit_field'         => '<div class="ac-submit">%1$s %2$s</div>',
	'format'               => 'html',

);
 
comment_form($comments_args);

 ?>