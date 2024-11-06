<?php
/**
 * Fallback for archive pages
 *
 * @package ChoctawNation
 */

get_header();
$bg_image = get_template_directory_uri() . '/src/assets/black-bg-chevron-noise.png';
if ( is_category() ) {
	$color_overlay = cno_get_category_color( get_queried_object()->name );
}
?>
<main <?php post_class(); ?>>
	<section class="hero position-relative overflow-hidden py-5 d-flex flex-column align-items-stretch justify-content-center mb-lg-5">
		<img src="<?php echo $bg_image; ?>" class="object-fit-cover position-absolute top-0 start-0 w-100 h-100 z-n1" />
		<?php
		if ( is_category() ) {
			echo "<div class='image-overlay bg-{$color_overlay} position-absolute top-0 w-100 h-100' style='mix-blend-mode:screen'></div>";
		}
		?>
		<div class="container py-5 text-center">
			<div class="row justify-content-center">
				<div class="col-10 col-lg-8">
					<span class="h3 text-uppercase text-white ls-3">Our stories make us more</span>
					<?php
					get_template_part(
						'template-parts/ui/hr',
						'diamonds',
						array(
							'class' => 'my-2',
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
	<div class="container-lg gx-0 d-flex flex-column row-gap-5 align-items-stretch mb-5">
		<?php
		if ( is_search() ) {
			echo '<section class="container pt-5 gx-lg-0"><div class="row row-gap-4 flex-row-reverse justify-content-between">
			<div class="col"><p class="fs-5 text-gray">Showing results for "' . get_search_query() . '"</p></div></div></section>';
		}
		?>
		<section class="row row-cols-1 row-cols-lg-2 row-gap-5 gx-0 gx-lg-4">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					echo "<div class='col'>";
					get_template_part( 'template-parts/card', 'profile-preview' );
					echo '</div>';
				}
			} else {
				echo '<div class="col-12 text-center"><p class="display-4 text-gray">No stories found.</p></div>';
			}
			?>
		</section>
	</div>
</main>
<?php
get_footer();
