<?php
/**
 * The Profile Hero Section
 *
 * @package ChoctawNation
 */

?>
<section class="hero position-relative overflow-hidden py-5 d-flex align-items-center">
	<?php
		the_post_thumbnail(
			'hero',
			array(
				'class' => 'bg-image position-absolute top-0 start-0 w-100 h-100',
			)
		);
		?>
	<div class="container-fluid position-relative z-2 py-5">
		<div class="row justify-content-end align-items-center">
			<div class="col-7 col-md-6 text-bg-dark bg-opacity-75 text-center d-flex flex-column flex-wrap align-items-center py-5">
				<h2 class="display-1 text-uppercase mb-4 mb-md-0"><?php the_title(); ?></h2>
				<p class="fw-light display-5 text-uppercase mb-3 mb-md-5">
					<?php the_field( 'meta_title' ); ?>
				</p>
				<?php
					get_template_part(
						'template-parts/button',
						'video-modal-trigger',
						array(
							'featured_profile_id' => get_the_ID(),
							'button_text'         => "<i class='fa-light fa-play'></i> View Video",
							'class'               => 'btn-outline-light text-uppercase fs-6',
						)
					);
					?>
				<div class="d-none d-md-flex mt-3 text-center text-white d-flex gap-3">
					<p class="mb-0 text-uppercase">Share this story</p>
					<?php get_template_part( 'template-parts/profile/content', 'social-share' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
