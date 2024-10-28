<?php
/**
 * Post Preview Card
 *
 * @package ChoctawNation
 */

?>
<div class="post-preview-card d-flex flex-column h-100 position-relative">
	<figure class="post-preview-card__cover mb-0 ratio ratio-16x9">
		<?php
		the_post_thumbnail(
			'profile-preview-card',
			array(
				'class'   => 'w-100 object-fit-cover',
				'loading' => 'lazy',
			)
		);
		?>
		<div class="post-preview-card__overlay bg-dark bg-opacity-50 w-100 h-100 z-1"></div>
		<figcaption class="h-auto text-white position-relative z-2 mx-5">
			<h3 class="fs-2 fw-bold text-uppercase mb-0">
				<?php the_title(); ?>
			</h3>
			<p class="fs-5 text-uppercase mb-0">
				<?php echo get_field( 'meta' )['title']; ?>
			</p>
		</figcaption>
	</figure>
	<div class="post-preview-card__body text-white py-3 px-5 d-flex flex-column h-100 z-2">
		<p class="mb-5">
			<?php the_field( 'archive_content' ); ?>
		</p>
		<?php
		$category       = get_the_category();
		$color_overlay  = cno_get_category_color( $category[0]->name );
		$button_classes = "btn-outline-{$color_overlay} mt-auto align-self-start fs-6";

		if ( get_post_status() === 'future' ) {
			$pronouns    = get_field( 'meta' )['pronouns'];
			$button_text = "<i class='fa-light fa-book'></i> See {$pronouns} Story in " . get_the_date( 'M' );
			echo "<button class='btn {$button_classes} text-uppercase' disabled>{$button_text}</button>";
		} else {
			$button_classes .= ' stretched-link';
			get_template_part( 'template-parts/ui/button', 'read-story', array( 'class' => $button_classes ) );
		}
		?>
	</div>
</div>