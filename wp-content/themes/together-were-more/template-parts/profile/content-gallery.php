<?php
/**
 * Gallery Section
 *
 * @package ChoctawNation
 */

$gallery = $args;
$photos  = $gallery['photos'];
?>
<section class="gallery container">
	<div class="row">
		<div class="col-1 position-relative">
			<div class="swiper-button-prev gallery-swiper-button-prev"></div>
		</div>
		<div class="col-10">
			<div class="swiper" id="gallery-swiper">
				<div class="swiper-wrapper">
					<?php foreach ( $photos as $photo ) : ?>
					<div class="swiper-slide">
						<?php
							echo wp_get_attachment_image(
								$photo['ID'],
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
</section>