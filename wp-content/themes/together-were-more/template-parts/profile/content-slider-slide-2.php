<?php
/**
 * Profile Slider Slide 2
 *
 * @package ChoctawNation
 */

$bg_image_src = get_template_directory_uri() . '/src/assets/black-bg-chevron-noise.png';
$quote_text   = acf_esc_html( $args['slide_2']['quote'] );
?>
<blockquote class="blockquote position-relative mb-0 text-white py-5 px-3 d-flex align-items-center justify-content-center h-100">
	<img src="<?php echo $bg_image_src; ?>" class='position-absolute top-0 w-100 h-100 object-fit-cover' aria-hidden='true' loading='lazy' />
	<p class="font-script mb-0 lh-lg display-6 text-center" data-aos='fade-in'>
		<?php echo $quote_text; ?>
	</p>
</blockquote>