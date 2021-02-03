<?php 
function post_breadcrumbs() {

	$text['home']     = get_bloginfo('name');
	$text['category'] = '%s';

	$wrap_before    = '<span class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';
	$wrap_after     = '</span><!-- .breadcrumbs -->';
	$sep            = '<span class="breadcrumbs__separator"> » </span>';
	$before         = '<span class="breadcrumbs__current">';
	$after          = '</span>';

	$show_on_home   = 0;
	$show_home_link = 1; 
	$show_current   = 1; 
	$show_last_sep  = 1; 

	global $post;
	$home_url       = home_url('/');
	$link           = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$link          .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
	$link          .= '<meta itemprop="position" content="%3$s" />';
	$link          .= '</span>';
	$parent_id      = ( $post ) ? $post->post_parent : '';
	$home_link      = sprintf( $link, $home_url, $text['home'], 1 );

	$position = 0;
	echo $wrap_before;

	if ( $show_home_link ) {
		$position += 1;
		echo $home_link;
	}

	if ( is_single() && ! is_attachment() ) {
		if ( get_post_type() != 'post' ) {
			$position += 1;
			$post_type = get_post_type_object( get_post_type() );
			if ( $position > 1 ) echo $sep;
			echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;
		} else {
			$cat = get_the_category(); $catID = $cat[0]->cat_ID;
			$parents = get_ancestors( $catID, 'category' );
			$parents = array_reverse( $parents );
			$parents[] = $catID;
			foreach ( $parents as $cat ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
			}
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;
		}
	} 

	echo $wrap_after;
}

?>