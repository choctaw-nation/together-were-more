<?php
/**
 * Slider Layout
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

use ChoctawNation\Asset_Loader;
use ChoctawNation\Enqueue_Type;

$bg_image = get_template_directory_uri() . '/src/assets/white-texture.jpeg';
new Asset_Loader( 'profile-swiper', Enqueue_Type::both, 'pages' );

$pagination_color = cno_get_category_color( get_the_category( $post->ID )[0]->name );
?>
<section class="container-fluid gx-0 position-relative" id="profile-swiper">
	<img src="<?php echo $bg_image; ?>" class="position-absolute top-0 start-0 w-100 h-100" alt="" aria-hidden="true" />
	<div class="swiper">
		<div class="swiper-wrapper align-items-stretch">
			<?php
			for ( $i = 1; $i <= 5; $i++ ) {
				echo "<div class='swiper-slide d-flex flex-column justify-content-center align-items-center' data-hash='slide{$i}'>";
				get_template_part(
					'template-parts/profile/content',
					"slider-slide-{$i}",
					array(
						"slide_{$i}" => $args[ "slide_{$i}" ],
					)
				);
				echo '</div>';
			}
			?>
		</div>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-12 position-relative">
			<div class="swiper-pagination" style="<?php echo "--swiper-pagination-color:var(--bs-{$pagination_color});"; ?>"></div>
		</div>
	</div>
</div>