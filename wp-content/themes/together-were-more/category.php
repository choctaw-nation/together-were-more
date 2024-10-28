<?php
/**
 * Category Archive pages
 *
 * @package ChoctawNation
 */

get_header();
$bg_image      = get_template_directory_uri() . '/src/assets/black-bg-chevron-noise.png';
$category      = get_queried_object()->name;
$acf_settings  = get_field( strtolower( $category ), 'options' );
$color_overlay = cno_get_category_color( $category );

?>

<main <?php post_class( 'mb-5' ); ?>>
	<section class="hero position-relative overflow-hidden py-5 d-flex flex-column align-items-stretch justify-content-center mb-lg-5">
		<img src="<?php echo $bg_image; ?>" class="object-fit-cover position-absolute top-0 start-0 w-100 h-100 z-n1" />
		<div class="<?php echo "image-overlay bg-{$color_overlay} position-absolute top-0 w-100 h-100"; ?>" style="mix-blend-mode:screen"></div>
		<div class="container py-5 text-center">
			<div class="row justify-content-center">
				<div class="col-10 col-lg-8">
					<span class="h3 text-uppercase text-white">Our stories make us more</span>
					<?php
					get_template_part(
						'template-parts/ui/hr',
						'diamonds',
						array(
							'class' => 'my-4',
							'color' => 'white',
						)
					);
					?>
				</div>
			</div>
			<div class="row row-cols-1">
				<div class="col">
					<h1 class="text-white fw-bolder display-1 text-uppercase">
						Together We're More
					</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="container-lg gx-0 mb-5">
		<div class="row row-gap-4 flex-row-reverse justify-content-between">
			<div class="col-lg-7 px-0 px-lg-4">
				<figure class="mb-0 ratio ratio-16x9">
					<?php
					echo wp_get_attachment_image(
						$acf_settings['hero_image'],
						'category-archive',
						false,
						array(
							'class'   => 'w-100 object-fit-cover',
							'loading' => 'lazy',
						)
					);
					?>
				</figure>
			</div>
			<div class="col px-4">
				<h2 class="text-uppercase text-gray text-center">
					<span class="display-1">We are</span><br /><?php echo $category; ?>
				</h2>
				<?php
				get_template_part(
					'template-parts/ui/hr',
					'diamonds',
					array(
						'color' => $color_overlay,
						'class' => 'w-75 mx-auto my-3',
					)
				);
				echo acf_esc_html( $acf_settings['content'] );
				?>
			</div>
		</div>
	</section>
	<section class="container d-flex flex-column row-gap-4 mb-5">
		<div class="row row-cols-1 row-cols-lg-2 row-gap-5">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					echo "<div class='col'>";
					get_template_part( 'template-parts/card', 'profile-preview' );
					echo '</div>';
				}
			} else {
				echo '<div class="col-12 text-center"><p class="display-4 text-gray text-capitalize">No stories found.</p></div>';
			}
			?>
		</div>
	</section>
</main>
<?php
get_footer();