<?php
/**
 * The Profile Hero Section
 *
 * @package ChoctawNation
 */

?>
<div class="profile-hero hero position-relative p-0 py-lg-5 d-flex align-items-center">
	<?php
	the_post_thumbnail(
		'hero',
		array(
			'class' => 'bg-image object-fit-cover position-absolute top-0 start-0 w-100 h-100',
		)
	);
	?>
	<div class="container-fluid position-relative py-5 d-none d-lg-block">
		<div class="row justify-content-end align-items-center">
			<div class="col-7 col-md-6 d-flex flex-column flex-wrap align-items-center py-5 text-white">
				<?php get_template_part( 'template-parts/profile/content', 'hero-content' ); ?>
			</div>
		</div>
	</div>
</div>
<div class="mobile-hero-text text-bg-dark d-lg-none py-5">
	<div class="container">
		<div class="row">
			<div class="col d-flex flex-column align-items-center text-center">
				<?php get_template_part( 'template-parts/profile/content', 'hero-content' ); ?>
			</div>
		</div>
	</div>
</div>
