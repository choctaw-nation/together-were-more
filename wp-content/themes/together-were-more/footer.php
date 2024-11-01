<?php
/**
 * Basic Footer Template
 *
 * @package ChoctawNation
 */

$page_template     = get_page_template();
$is_blank_template = strpos( $page_template, 'page-templates/blank.php' );

if ( ! $is_blank_template ) {
	get_template_part( 'template-parts/aside', 'social-media' );
}
$hover_color = cno_get_primary_color();
?>
<footer class="footer container-fluid gx-0 text-bg-dark d-flex flex-column align-items-stretch">
	<div class="container-xxl">
		<div class="row row-gap-4 column-gap-2 gx-0 flex-row-reverse justify-content-center justify-content-lg-between align-items-center py-5">
			<div class="col-sm-12 col-md-5 text-center text-md-start">
				<p class="h1 text-uppercase text-white">Are you Choctaw Proud?</p>
				<!-- Button trigger modal -->
				<button type="button" class="<?php echo "btn btn-{$hover_color} text-uppercase"; ?>" data-bs-toggle="modal" data-bs-target="#shareStoryModal">
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
							<div class="modal-footer justify-content-start text-dark">
								<p>This site is protected by reCAPTCHA and the Google
									<a href="https://policies.google.com/privacy">Privacy Policy</a> and
									<a href="https://policies.google.com/terms">Terms of Service</a> apply.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col col-lg-5 text-center text-md-start">
				<a href="<?php echo esc_url( site_url() ); ?>" class="text-decoration-none font-gill-sans fw-bold footer-link-text"
					style="--cno-link-hover-color:<?php echo "var(--bs-{$hover_color})"; ?>" aria-label="to Home Page">
					Choctaw Nation
				</a>
				<p class="mb-0">We are humble, resilient people who value faith, family, and culture. Honoring the past, living in the present, and looking to the future, we work hard to
					succeed and give back to our communities.</p>
			</div>
		</div>
		<div class="row border-top border-2 border-light gap-2 pt-4 mb-3 flex-column flex-lg-row justify-content-center justify-content-lg-start row-gap-3"
			<?php echo "style='--bs-link-color-rgb:255,255,255;--bs-link-hover-color-rgb:var(--bs-{$hover_color}-rgb);'"; ?>>
			<div class="col-auto text-center text-lg-start fs-base"><?php echo '<p class="mb-0">&copy;&nbsp;' . gmdate( 'Y' ) . '&nbsp;Choctaw Nation of Oklahoma</p>'; ?></div>
			<?php if ( has_nav_menu( 'footer_menu' ) ) : ?>
			<div class="col-auto">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer_menu',
						'container'       => 'nav',
						'container_class' => 'footer-nav',
						'menu_class'      => 'nav justify-content-center justify-content-lg-start',
						'items_wrap'      => '<ul id="%1$s" class="%2$s fs-base">%3$s</ul>',
					)
				);
				?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
