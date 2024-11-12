<?php
/**
 * Gallery Section
 *
 * @package ChoctawNation
 */

use ChoctawNation\Asset_Loader;
use ChoctawNation\Enqueue_Type;

$gallery = $args;
$photos  = $gallery['photos'];
new Asset_Loader( 'gallery-swiper', Enqueue_Type::both, 'pages' );

$primary_color = cno_get_primary_color();
?>
<section class="gallery bg-light pt-5" style="<?php echo "--swiper-pagination-color:var(--bs-{$primary_color});--swiper-navigation-color:var(--bs-{$primary_color})"; ?>">
	<div class="container">
		<div class="row">
			<div class="col-1 position-relative">
				<div class="swiper-button-prev gallery-swiper-button-prev"></div>
			</div>
			<div class="col-10">
				<div class="swiper" id="gallery-swiper">
					<div class="swiper-wrapper align-items-stretch">
						<?php foreach ( $photos as $photo ) : ?>
						<div class="swiper-slide">
							<?php
							echo wp_get_attachment_image(
								$photo,
								'full',
								false,
								array(
									'class'   => 'object-fit-cover w-100 h-100',
									'loading' => 'lazy',
								)
							);
							?>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="col-1 position-relative">
				<div class="swiper-button-next gallery-swiper-button-next"></div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col position-relative">
				<div class="swiper-pagination gallery-swiper-pagination"></div>
			</div>
		</div>
	</div>
</section>
