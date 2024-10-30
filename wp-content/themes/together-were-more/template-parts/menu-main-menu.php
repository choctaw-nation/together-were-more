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
<ul class="navbar-nav ms-lg-0 text-uppercase fs-5 align-items-center gap-5" id="main-menu">
	<?php foreach ( $categories as $category ) : ?>
	<li class="nav-item">
		<a class="nav-link p-0 d-block border-bottom ls-1" href="<?php echo site_url( "/{$category->slug}" ); ?>"
			style="<?php echo "--bs-nav-link-hover-color:var(--bs-{$hover_color});--bs-border-hover-color:var(--bs-{$hover_color});"; ?>">
			<?php echo $category->name; ?>
		</a>
	</li>
	<?php endforeach; ?>
	<li class="nav-item">
		<button class="border-0 bg-transparent p-0" aria-label="search" data-bs-toggle="modal" data-bs-target="#site-search">
			<figure class="mb-0 search-icon d-inline-block" style="<?php echo "--hover-color:var(--bs-{$hover_color});"; ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					<path
							d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
					</path>
				</svg>
			</figure>
		</button>
	</li>
</ul>
