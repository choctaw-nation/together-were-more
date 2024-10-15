<?php
/**
 * Share our Stories Section
 *
 * @package ChoctawNation
 */

$socials        = get_field( 'social_media_channels', 'options' );
$texture_bg_url = get_template_directory_uri() . '/src/assets/white-texture.jpeg';
?>
<aside id='contact' class='position-relative'>
	<img src="<?php echo $texture_bg_url; ?>" class='position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1' alt='' aria-hidden="true" />
	<div class='row justify-content-center'>
		<div class='col-lg-8 py-5 d-flex flex-column justify-content-center'>
			<div class='col-lg-10 py-5 mx-auto'>
				<div class='container-fluid d-flex flex-column align-items-stretch row-gap-4'>
					<div class='row row-cols-5 justify-content-center'>
						<?php foreach ( $socials as $social ) : ?>
							<?php
							$url  = esc_url( $social['social_platform']['url'] );
							$name = esc_attr( $social['social_platform']['title'] );
							$icon = $social['social_icon'];
							?>
						<div class="col d-flex justify-content-center align-items-center">
							<a class="social d-block text-gray" href="<?php echo $url; ?>" target="_blank" title="<?php echo "Follow us on {$name}"; ?>" rel="noopener noreferrer">
								<?php echo $icon; ?>
							</a>
						</div>
						<?php endforeach; ?>
					</div>
					<div class='row row-cols-1 gx-0'>
						<div class='col text-gray text-center'>
							<p class='display-3 fw-normal text-uppercase'>
								<b>See and share our stories</b><br /> on social
								media
							</p>
							<?php
							get_template_part(
								'template-parts/ui/hr',
								'diamonds',
								array(
									'color' => 'gray',
									'class' => 'my-4',
								)
							);
							?>
							<p class='text-uppercase display-3 fw-normal'>
								Follow and subscribe <br />for more content.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</aside>
