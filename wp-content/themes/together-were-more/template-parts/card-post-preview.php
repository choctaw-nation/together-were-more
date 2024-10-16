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
		<figcaption class="h-auto text-white position-relative z-2 px-3">
			<h3 class="fs-2 fw-bold text-uppercase">
				<?php the_title(); ?>
			</h3>
			<p class="fs-5 text-uppercase mb-0">
				<?php echo get_field( 'meta' )['title']; ?>
			</p>
		</figcaption>
	</figure>
	<div class="post-preview-card__body text-white p-3 d-flex flex-column h-100 z-2">
		<p class="mb-5">
			<?php the_field( 'archive_content' ); ?>
		</p>
		<?php
		$category       = get_the_category();
		$color_overlays = array(
			'Artists'     => 'gold',
			'Culture'     => 'violet',
			'Inspiring'   => 'plum',
			'Competitors' => 'garnet',
		);

		$button_element = 'a';
		$button_classes = "btn btn-outline-{$color_overlays[ $category[0]->name ]} text-uppercase mt-auto align-self-start fs-6";
		$pronouns       = get_field( 'meta' )['pronouns'];
		$button_text    = "See {$pronouns} Story";
		$href           = "href='" . get_the_permalink() . "'";
		if ( get_post_status() === 'future' ) {
			$scheduled_date = get_the_date( 'M' );
			$button_element = 'button';
			$button_text   .= " in {$scheduled_date}";
			$href           = null;

		} else {
			$button_classes .= ' stretched-link';
		}
		echo "<{$button_element} " . ( $href ?? '' ) . " class='{$button_classes}' " . ( 'button' === $button_element ? 'disabled' : '' ) . ">{$button_text}</{$button_element}>";
		?>
	</div>
</div>