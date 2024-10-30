<?php
/**
 * Social Share Component
 *
 * @package ChoctawNation
 */

$socials         = get_field( 'social_media_channels', 'options' );
$allowed_socials = array( 'Facebook', 'Twitter', 'Instagram' );
?>
<div class="socials d-flex gap-3 justify-content-evenly">
	<?php foreach ( $socials as $social ) : ?>
		<?php
		if ( ! in_array( $social['social_platform']['title'], $allowed_socials, true ) ) {
			continue;
		}
		?>
	<figure class='mb-0 ratio ratio-1x1 text-bg-light rounded-circle'>
		<?php echo "<a href='{$social['social_platform']['url']}' class='d-block text-white' title='{$social['social_platform']['title']}'>{$social['social_icon']}</a>"; ?>
	</figure>
	<?php endforeach; ?>
</div>
