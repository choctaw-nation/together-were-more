<?php
/**
 * Post Preview Card
 *
 * @package ChoctawNation
 */

$alternate_image_id = mp_get_field( 'homepage_current_feature_image' );
$image_size         = 'profile-preview-card';
$image_args         = array(
	'class'   => 'w-100 object-fit-cover',
	'loading' => 'lazy',
);
?>
<div class="post-preview-card d-flex flex-column h-100 position-relative">
	<figure class="post-preview-card__cover mb-0 ratio ratio-16x9">
		<?php
		if ( $alternate_image_id ) {
			echo wp_get_attachment_image(
				$alternate_image_id,
				$image_size,
				false,
				$image_args
			);
		} else {
			the_post_thumbnail(
				$image_size,
				$image_args
			);
		}
		?>
		<div class="post-preview-card__overlay bg-dark bg-opacity-50 w-100 h-100 z-1"></div>
		<figcaption class="h-auto text-white position-relative z-2 mx-5 mb-3">
			<h3 class="fs-2 fw-bold text-uppercase mb-0">
				<?php the_title(); ?>
			</h3>
			<p class="fs-5 text-uppercase mb-0">
				<?php
				$subtitle = mp_get_field( 'meta_profile_title' );
				echo ! empty( $subtitle ) ? $subtitle : get_field( 'meta' )['title'];
				?>
			</p>
		</figcaption>
	</figure>
	<div class="post-preview-card__body text-white p-5 pt-3 d-flex flex-column h-100 z-2">
		<p class="mb-5">
			<?php
			if ( ! empty( $homepage_alt_description ) ) {
				echo $homepage_alt_description;
			} elseif ( empty( get_the_excerpt() ) ) {
				echo get_field( 'archive_content', );
			} else {
				echo get_the_excerpt();
			}
			?>
		</p>
		<?php
		$category       = get_the_category();
		$color_overlay  = cno_get_category_color( $category[0]->name );
		$button_classes = "btn-outline-{$color_overlay} mt-auto align-self-start fs-6 post-preview-card__cta-button";

		if ( get_post_status() === 'future' ) {
			$button_text = 'Read Story in ' . get_the_date( 'M' );
			echo "<button class='btn {$button_classes} text-uppercase' disabled>{$button_text}</button>";
		} else {
			$button_classes .= ' stretched-link';
			get_template_part( 'template-parts/ui/button', 'read-story', array( 'class' => $button_classes ) );
		}
		?>
	</div>
</div>