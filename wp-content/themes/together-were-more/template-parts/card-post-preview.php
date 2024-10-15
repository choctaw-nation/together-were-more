<?php
/**
 * Post Preview Card
 *
 * @package ChoctawNation
 */

?>
<div class='post-preview-card d-flex flex-column'>
	<figure class='card-cover position-relative mb-0 ratio ratio-16x9 d-flex flex-column justify-content-end'>
		<?php the_post_thumbnail( 'profile-preview-card', array( 'class' => 'w-100 object-fit-cover' ) ); ?>
		<div class='overlay bg-dark bg-opacity-75 w-100 h-100 z-1'></div>
		<figcaption class='card-title text-white position-relative z-2 px-3'>
			<h3 class='fs-2 fw-bold text-uppercase'>
				<?php the_title(); ?>
			</h3>
			<p class='fs-5 text-uppercase'><?php echo get_field( 'meta' )['title']; ?></p>
		</figcaption>
	</figure>
	<div class='post-preview-card__body text-white px-3'>
		<p class='mb-5'>
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
		$button_classes = "btn btn-outline-{$color_overlays[ $category[0]->name ]} text-uppercase mb-3 fs-6";
		$pronouns       = get_field( 'meta' )['pronouns'];
		$button_text    = "See {$pronouns} Story";
		$href           = "href='" . get_the_permalink() . "'";
		if ( get_post_status() === 'future' ) {
			$scheduled_date = get_the_date( 'M' );
			$button_element = 'button';
			$button_text   .= " in {$scheduled_date}";
			$href           = null;
		}
		echo "<{$button_element} " . ( $href ?? '' ) . " class='{$button_classes}'>{$button_text}</{$button_element}>";
		?>
	</div>
</div>
