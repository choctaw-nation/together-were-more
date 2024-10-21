<?php
/**
 * Profile Preview Card
 * Similar to the card-post-preview, but for use on the index.php page
 *
 * @package ChoctawNation
 */

$category_name = get_queried_object()->name;
if ( empty( $category_name ) ) {
	$category      = get_the_category();
	$category_name = $category[0]->name;
}
$color = cno_get_category_color( $category_name );
?>
<div class="d-flex flex-column h-100 position-relative">
	<figure class="mb-0 ratio ratio-16x9">
		<?php
		the_post_thumbnail(
			'profile-preview-card',
			array(
				'class'   => 'w-100 object-fit-cover',
				'loading' => 'lazy',
			)
		);
		?>
	</figure>
	<div class="text-gray p-3 d-flex flex-column h-100">
		<h3 class="fs-2 fw-bold text-uppercase">
			<?php the_title(); ?>
		</h3>
		<p class="fs-5 text-uppercase mb-0">
			<?php echo get_field( 'meta' )['title']; ?>
		</p>
		<?php
		get_template_part(
			'template-parts/ui/hr',
			'diamonds',
			array(
				'color' => empty( $color ) ? 'gray' : $color,
				'class' => 'w-50',
			)
		);
		?>
		<p>
			<?php the_field( 'archive_content' ); ?>
		</p>
		<div class="d-flex flex-wrap gap-3 align-items-center">
			<?php
			get_template_part(
				'template-parts/ui/button',
				'read-story',
				array(
					'class' => 'btn-outline-gray fs-6',
				)
			);
			$meta = get_field( 'meta' );
			if ( ! empty( $meta['video_details']['video_url'] ) ) {
				get_template_part(
					'template-parts/ui/button',
					'video-modal-trigger',
					array(
						'class'               => 'btn-outline-gray fs-6',
						'featured_profile_id' => get_the_ID(),
					)
				);
			}
			?>
		</div>
	</div>
</div>