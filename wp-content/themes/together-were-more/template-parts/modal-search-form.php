<?php
/**
 * Site Search Modal
 *
 * @package ChoctawNation
 */

$front_page_id      = get_option( 'page_on_front' );
$category_spotlight = get_field( 'category_spotlight', $front_page_id )['category_to_spotlight']->name;
$btn_color          = cno_get_category_color( $category_spotlight );
?>
<div class="modal fade" id="site-search" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="d-flex flex-wrap gap-2 mb-5" action="<?php echo site_url(); ?>" method="get">
					<input type="search" class="form-control flex-grow-1 fs-6" name="s" id="search-query" aria-label="Search for stories" placeholder="Search stories" />
					<button type="submit" class="btn btn-outline-<?php echo $btn_color; ?> text-uppercase fs-6">Search</button>
				</form>
				<div id="modal-search-results" class="d-flex flex-column row-gap-4 align-items-stretch">
				</div>
			</div>
		</div>
	</div>
</div>
