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
	<div class="container-fluid position-relative py-5">
		<div class="row justify-content-end align-items-center">
			<div class="col-7 col-md-6 text-bg-dark bg-opacity-75 d-flex flex-column flex-wrap align-items-center py-5">
				<h2 class="display-1 text-uppercase mb-4 mb-md-0 text-center"><?php the_title(); ?></h2>
				<p class="text-center fw-light display-5 text-uppercase mb-3 mb-md-5">
					<?php the_field( 'meta_title' ); ?>
				</p>
				<?php
				get_template_part(
					'template-parts/ui/button',
					'video-modal-trigger',
					array(
						'featured_profile_id' => get_the_ID(),
						'class'               => 'btn-outline-light fs-6',
					)
				);
				?>
				<!-- <div class="d-none d-md-flex mt-3 text-center text-white d-flex gap-3 align-items-center"> -->
				<!-- <p class="mb-0 text-uppercase">Share this story</p> -->
				<?php // get_template_part( 'template-parts/profile/content', 'social-share' ); phpcs:ignore Squiz.PHP.CommentedOutCode.Found ?>
				<!-- </div> -->
			</div>
		</div>
	</div>
</section>
