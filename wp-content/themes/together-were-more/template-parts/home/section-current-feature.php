<?php
/**
 * Current Featured Profile Section
 *
 * @package ChoctawNation
 */

wp_enqueue_style( 'current-feature' );
$featured_profile_id = get_field( 'current_feature' )['featured_profile'];

$bg_image = get_template_directory_uri() . '/src/assets/white-texture.jpeg';

$srcset_str  = wp_get_attachment_image_srcset( get_post_thumbnail_id( $featured_profile_id ), 'full' );
$srcset_by_w = explode( ',', $srcset_str );
$srcset_by_h = array_map(
	function ( $srcset ) {
		return substr( $srcset, 0, -1 ) . 'h';
	},
	$srcset_by_w
);
?>
<section class="featured container-fluid gx-0 overflow-hidden position-relative">
	<img src="<?php echo $bg_image; ?>" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1" alt="" aria-hidden="true" loading="lazy" />
	<div class="row row-cols-1 row-cols-lg-2 align-items-center justify-content-between">
		<div class="col-lg-5 gx-0 featured__image">
			<?php
			echo get_the_post_thumbnail(
				$featured_profile_id,
				'full',
				array(
					'class'   => 'w-100 object-fit-cover',
					'loading' => 'lazy',
					'srcset'  => implode( ', ', $srcset_by_h ),
				)
			);
			?>
		</div>
		<div class="col py-5 px-4 d-flex flex-column justify-content-center align-items-center text-center text-lg-start">
			<div class="featured__content-container d-flex flex-column align-items-stretch">
				<?php
					$name = implode( '<br/>', explode( ' ', get_the_title( $featured_profile_id ) ) );
					echo "<h2 class='featured__title text-gray text-uppercase mb-0'>{$name}</h2>";
					get_template_part(
						'template-parts/ui/hr',
						'diamonds',
						array(
							'color' => 'gold',
							'class' => 'w-75 mx-auto mx-lg-0 mt-2 mb-3 mt-lg-4 mb-lg-5',
						)
					);
					?>
				<p class="featured__subtitle text-uppercase font-pill-gothic text-gray fs-4 fw-normal">
					<?php the_field( 'archive_content', $featured_profile_id ); ?>
				</p>
				<div class="row row-cols-auto gap-3 justify-content-center justify-content-lg-start">
					<div class="col">
						<?php
						get_template_part(
							'template-parts/ui/button',
							'video-modal-trigger',
							array(
								'featured_profile_id' => $featured_profile_id,
								'class'               => 'featured__btn btn-gray align-self-start',
							)
						);
						?>
					</div>
					<div class="col">
						<?php
						get_template_part(
							'template-parts/ui/button',
							'read-story',
							array(
								'class'      => 'featured__btn--story btn-outline-gray align-self-start',
								'profile_id' => $featured_profile_id,
							)
						);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
