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
$categories = cno_get_categories_array();
?>
<ul class="navbar-nav ms-lg-0 text-uppercase fs-5" id="main-menu">
	<?php foreach ( $categories as $category ) : ?>
	<li class="nav-item">
		<a class="nav-link fw-bold" href="<?php echo site_url( "/{$category->slug}" ); ?>" style="<?php echo "--bs-nav-link-hover-color:var(--bs-{$hover_color})"; ?>">
			<?php echo $category->name; ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>