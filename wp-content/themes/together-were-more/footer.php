<?php
/**
 * Basic Footer Template
 *
 * @package ChoctawNation
 */

?>

<footer class="footer container-fluid text-bg-gray d-flex flex-column align-items-center gx-0">
	<div class="container">
		<div class="row row-cols-1 row-cols-xl-2 row-gap-4 flex-row-reverse justify-content-center justify-content-lg-between align-items-center py-5">
			<div class="col-auto text-center text-lg-start">
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
								<h5 class="modal-title text-dark h2 text-capitalize" id="shareStoryModalLabel">Share Your Story</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body text-dark">
								<?php echo do_shortcode( '[gravityform id="1" ajax="true" title="false"]' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-auto">
				<a href="<?php echo esc_url( site_url() ); ?>" class="text-decoration-none d-flex column-gap-3 align-items-center">
					<?php
						$logo = get_template_directory_uri() . '/src/assets/the-great-seal--white.svg';
						echo "<img src='{$logo}' class='logo' alt='Choctaw Nation of Oklahoma Seal' loading='lazy' />";
					?>
					<span aria-label="to Home Page" class="font-gill-sans fw-bold">
						Choctaw Nation of Oklahoma
					</span>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col text-center text-lg-start" id="copyright">
				<p><?php echo '&copy;&nbsp;' . gmdate( 'Y' ) . '&nbsp;Choctaw Nation of Oklahoma'; ?></p>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>