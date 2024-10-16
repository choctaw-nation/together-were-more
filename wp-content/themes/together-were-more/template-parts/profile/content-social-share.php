<?php
/**
 * Social Share Component
 *
 * @package ChoctawNation
 */

$socials = array(
	array(
		'href' => 'https://facebook.com',
		'icon' => 'facebook',
		'alt'  => 'Facebook',
	),
	array(
		'href' => 'https://instagram.com',
		'icon' => 'instagram',
		'alt'  => 'Instagram',
	),
	array(
		'href' => 'https://x.com',
		'icon' => 'twitter',
		'alt'  => 'Twitter',
	),
);
?>
<div class='socials d-flex gap-3 justify-content-evenly'>
	<?php foreach ( $socials as $social ) : ?>
	<a href="<?php echo esc_url( $social['href'] ); ?>" class="text-white d-block h-100" title="<?php echo esc_attr( $social['alt'] ); ?>">
		<i class="fa-brands fa-<?php echo esc_attr( $social['icon'] ); ?>"></i>
	</a>
	<?php endforeach; ?>
</div>
