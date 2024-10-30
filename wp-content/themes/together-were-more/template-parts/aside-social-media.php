<?php
/**
 * Share our Stories Section
 *
 * @package ChoctawNation
 */

$socials        = get_field( 'social_media_channels', 'options' );
$texture_bg_url = get_template_directory_uri() . '/src/assets/white-texture.jpeg';
?>
<aside id="socials" class="position-relative overflow-x-hidden">
	<img src="<?php echo $texture_bg_url; ?>" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1" alt="" aria-hidden="true" />
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 py-5 d-flex flex-column justify-content-center gap-4">
				<div class="socials-container row justify-content-center align-items-center gap-4">
					<?php foreach ( $socials as $social ) : ?>
						<?php
						$url  = esc_url( $social['social_platform']['url'] );
						$name = esc_attr( $social['social_platform']['title'] );
						$icon = $social['social_icon'];
						?>
					<div class="social-container bg-gray rounded-circle p-2">
						<a class="social ratio ratio-1x1 d-block text-white fs-6" href="<?php echo $url; ?>" target="_blank" title="<?php echo "Follow us on {$name}"; ?>"
							rel="noopener noreferrer">
							<?php echo $icon; ?>
						</a>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="row">
					<div class="col text-gray text-center">
						<span class="display-2 fw-normal text-uppercase">
							<b>Follow and Subscribe to</b><br />See and Share our stories on social media.
						</span>
						<?php
						get_template_part(
							'template-parts/ui/hr',
							'diamonds',
							array(
								'color' => 'gray',
								'class' => 'my-2',
							)
						);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</aside>
