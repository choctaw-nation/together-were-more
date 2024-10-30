<?php
/**
 * Social Share Component
 *
 * @package ChoctawNation
 */

$socials         = get_field( 'social_media_channels', 'options' );
$allowed_socials = array( 'Facebook', 'Twitter', 'Pinterest' );
$bg_color        = cno_get_category_color( get_the_category()[0]->name );
?>
<aside class="text-bg-dark">
	<div class="container py-5">
		<div class="row gap-3 text-center align-items-center">
			<div class="col d-flex gap-3">
				<p class="mb-0 text-uppercase">Share this story</p>
				<div class="socials d-flex gap-3 justify-content-evenly">
					<?php
					foreach ( $socials as $social ) {
						if ( ! in_array( $social['social_platform']['title'], $allowed_socials, true ) ) {
							continue;
						}
						echo "<a href='{$social['social_platform']['url']}' data-aos='fade-in' class='text-{$bg_color}' title='{$social['social_platform']['title']}'>{$social['social_icon']}</a>";

					}
					$post_title = get_the_title();
					$permalink  = get_permalink();
					$subject    = rawurlencode( "Together We're More Article: {$post_title}" );
					$body       = rawurlencode( "Look at this great article on {$post_title}! {$permalink}" );
					echo "<a href='mailto:?subject='{$subject}'&body={$body}' data-aos='fade-in' class='text-{$bg_color}' title='email'><i class='fa-light fa-envelope'></i></a>";
					?>
				</div>
			</div>
		</div>
</aside>
