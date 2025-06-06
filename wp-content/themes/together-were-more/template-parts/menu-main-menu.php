<?php
/**
 * Main Menu
 *
 * @package ChoctawNation
 */

$categories      = cno_get_categories_array();
$active_category = null;
if ( is_single() || is_category() ) {
	if ( ! empty( get_the_category() ) ) {
		$active_category = get_the_category()[0]->slug;
	}
}
?>
<ul class="navbar-nav ms-lg-0 text-uppercase fs-5 align-items-center gap-5" id="main-menu">
	<?php foreach ( $categories as $category ) : ?>
		<?php $hover_color = cno_get_category_color( $category->name ); ?>
	<li class="<?php echo ( $category->slug === $active_category ) ? 'nav-item active fw-bold' : 'nav-item'; ?>"
		style="<?php echo "--bs-nav-link-hover-color:var(--bs-{$hover_color});--bs-border-hover-color:var(--bs-{$hover_color});"; ?>">
		<a class="nav-link p-0 d-block border-bottom ls-1" href="<?php echo site_url( "/{$category->slug}" ); ?>">
			<?php echo $category->name; ?>
		</a>
	</li>
	<?php endforeach; ?>
	<?php $hover_color = cno_get_primary_color(); ?>
	<li class="nav-item" style="<?php echo "--hover-color:var(--bs-{$hover_color});"; ?>">
		<button class="nav-link border-0 bg-transparent p-0 search-button d-flex flex-row-reverse column-gap-2" aria-label="search" data-bs-toggle="modal" data-bs-target="#site-search">
			<div class="d-lg-none text-uppercase ls-1 p-0 d-block border-bottom ls-1">Search</div>
			<figure class="mb-0">
				<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					<path
							d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
					</path>
				</svg>
			</figure>
		</button>
	</li>
</ul>
