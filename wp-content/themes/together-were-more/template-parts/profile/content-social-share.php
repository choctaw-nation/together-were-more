<?php
/**
 * Social Share Component
 *
 * @package ChoctawNation
 */

$socials         = get_field( 'social_media_channels', 'options' );
$allowed_socials = array( 'Facebook', 'Twitter', 'Instagram' );
?>
<div class="socials d-flex gap-3 justify-content-evenly text-white">
	<?php
	foreach ( $socials as $social ) {
		if ( ! in_array( $social['social_platform']['title'], $allowed_socials, true ) ) {
			continue;
		}
		echo "<a href='{$social['social_platform']['url']}' class='text-white d-block h-100 fs-3' title='{$social['social_platform']['title']}'>{$social['social_icon']}</a>";
	}
	?>
</div>
