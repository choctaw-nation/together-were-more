<?php
/**
 * Current Featured Profile Section
 *
 * @package ChoctawNation
 */

wp_enqueue_style( 'current-feature' );
$featured_profile_id = get_field( 'current_feature' )['featured_profile'];

$bg_image = get_template_directory_uri() . '/src/assets/white-texture.jpeg';
?>
<section class='featured container-fluid gx-0 overflow-hidden position-relative'>
	<img src="<?php echo $bg_image; ?>" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1" alt='' aria-hidden="true" loading="lazy" />
	<div class='row row-cols-1 row-cols-lg-2 align-items-center justify-content-between'>
		<div class='col-lg-5 gx-0' style='max-height: 800px;'>
			<?php
			echo get_the_post_thumbnail(
				$featured_profile_id,
				'profile-preview',
				array(
					'class'   => 'w-100 object-fit-cover',
					'style'   => 'object-position: 20% 60%',
					'loading' => 'lazy',
				)
			);
			?>
		</div>
		<div class='col py-5 px-4 d-flex flex-column justify-content-center align-items-center'>
			<div class='featured__content-container'>
				<?php
					$name       = get_the_title( $featured_profile_id );
					$first_name = explode( ' ', $name )[0];
					$last_name  = explode( ' ', $name )[1];
					echo "<h2 class='featured__title text-gray text-uppercase'>{$first_name}<br />{$last_name}</h2>";
					get_template_part(
						'template-parts/ui/content',
						'diamonds-hr',
						array(
							'color' => 'gold',
							'class' => 'w-75 my-5',
						)
					);
					?>
				<p class='featured__subtitle text-uppercase font-pill-gothic text-gray fs-4 fw-normal'>
					<?php the_field( 'archive_content', $featured_profile_id ); ?>
				</p>
				<div class='row row-cols-auto gap-3'>
					<div class='col'>
						<?php
						get_template_part(
							'template-parts/button',
							'video-modal-trigger',
							array(
								'featured_profile_id' => $featured_profile_id,
								'class'               => 'featured__btn btn-outline-gray lh-3 align-self-start rounded-0 fs-3 font-pill-gothic px-5 py-3 text-uppercase',
							)
						);
						?>
					</div>
					<div class='col'>
						<a href='<?php the_permalink( $featured_profile_id ); ?>'
							class='featured__btn btn btn-outline-gray lh-3 align-self-start rounded-0 fs-3 font-pill-gothic px-5 py-3 text-uppercase'>
							Read Story
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
