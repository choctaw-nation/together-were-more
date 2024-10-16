<?php
/**
 * Basic Footer Template
 *
 * @package ChoctawNation
 */

?>

<footer class="footer container-fluid text-bg-gray d-flex flex-column align-items-center gx-0">
	<div class="container">
		<div class="row row-cols-1 row-cols-xl-2 justify-content-between align-items-center py-5">
			<div class="col-auto">
				<a href="<?php echo esc_url( site_url() ); ?>" class="logo">
					<figure class="logo-img d-inline-block">
						<span aria-label="to Home Page" class="font-gill-sans fw-bold">
							Choctaw Nation of Oklahoma
						</span>
					</figure>
				</a>
			</div>
			<div class="col-auto">
				<p class="h1 text-uppercase text-white mb-0">Are you Choctaw Proud?</p>
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-outline-light text-uppercase font-pill-gothic fw-normal fs-6" data-bs-toggle="modal" data-bs-target="#shareStoryModal">
					Share your story with us
				</button>

				<!-- Modal -->
				<div class="modal fade" id="shareStoryModal" tabindex="-1" aria-labelledby="shareStoryModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="shareStoryModalLabel">Share Your Story</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col" id="copyright">
				<p><?php echo '&copy;&nbsp;' . gmdate( 'Y' ) . '&nbsp;Choctaw Nation of Oklahoma'; ?></p>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
