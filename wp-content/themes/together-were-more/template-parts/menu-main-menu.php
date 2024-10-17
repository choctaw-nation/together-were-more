<?php
/**
 * Main Menu
 *
 * @package ChoctawNation
 */

$hover_color = isset( $args['hover_color'] ) ? $args['hover_color'] : null;
if ( null === $hover_color ) {
	$front_page_id      = get_option( 'page_on_front' );
	$category_spotlight = get_field( 'category_spotlight', $front_page_id )['category_to_spotlight']->name;
	$hover_color        = cno_get_category_color( $category_spotlight );
}
$categories = get_categories(
	array(
		'hide_empty' => false,
		'exclude'    => get_cat_ID( 'Uncategorized' ),
	)
);
usort(
	$categories,
	function ( $a, $b ) {
		$order = array( 'Artists', 'Culture', 'Inspire', 'Competitors' );
		$pos_a = array_search( $a->name, $order, true );
		$pos_b = array_search( $b->name, $order, true );
		return $pos_a - $pos_b;
	}
);
?>
<ul class='navbar-nav ms-lg-0 text-uppercase fs-5' id='main-menu'>
	<?php foreach ( $categories as $category ) : ?>
	<li class="nav-item">
		<a class="nav-link fw-bold" href="<?php echo site_url( "/{$category->slug}" ); ?>" style="<?php echo "--bs-nav-link-hover-color:var(--bs-{$hover_color})"; ?>">
			<?php echo $category->name; ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>