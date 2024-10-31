<?php
/**
 * Site Search Modal
 *
 * @package ChoctawNation
 */

$btn_color = cno_get_primary_color();
?>
<div class="modal fade" id="site-search" tabindex="-1" aria-hidden="true" data-primary-color="<?php echo $btn_color; ?>">
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
				<div id="modal-search-results" class="d-flex flex-column row-gap-4 align-items-stretch text-dark" aria-live="polite">
				</div>
			</div>
		</div>
	</div>
</div>
