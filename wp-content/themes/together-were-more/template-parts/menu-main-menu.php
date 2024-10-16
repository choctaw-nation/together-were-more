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

echo "<ul class='navbar-nav ms-lg-0 text-uppercase fs-5' id='main-menu'>";
foreach ( $categories as $category ) {
	echo '<li class="nav-item">';
	echo "<a class='nav-link fw-bold' href='" . esc_url( get_category_link( $category->term_id ) ) . "' style='--bs-nav-link-hover-color:var(--bs-{$hover_color})'>" . esc_html( $category->name ) . '</a>';
	echo '</li>';
}
echo '</ul>';