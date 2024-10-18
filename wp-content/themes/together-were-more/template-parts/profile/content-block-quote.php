<?php
/**
 * Block Quote Layout
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

$classes = array( 'blockquote', 'position-relative', 'mb-0' );
if ( $args['with_bg'] ) {
	$has_bg  = array(
		'text-white',
		'py-5',
		'd-flex',
		'align-items-center',
		'justify-content-center',
		'h-100',
	);
	$classes = array_merge( $classes, $has_bg );
}
$quote_classes = array(
	'font-script',
	'mb-0',
	'lh-lg',
);
if ( ! empty( $args['class'] ) ) {
	if ( is_array( $args['class'] ) ) {
		$quote_classes = array_merge( $quote_classes, $args['class'] );
	} else {
		$quote_classes[] = $args['class'];
	}
}
?>
<blockquote class="<?php echo join( ' ', $classes ); ?>">
	<?php
	if ( $args['with_bg'] ) {
		$bg_image = get_template_directory_uri() . '/src/assets/black-bg-chevron-noise.png';
		if ( $bg_image ) {
			echo "<img src='{$bg_image}' class='position-absolute top-0 w-100 h-100 object-fit-cover' aria-hidden='true' loading='lazy'/>";
		}
	}
	?>
	<div class="container position-relative z-2">
		<div class="row justify-content-center">
			<div class="col-lg-8 text-center">
				<p class="<?php echo join( ' ', $quote_classes ); ?>" data-aos='fade-in'>
					<?php echo $args['content']; ?>
				</p>
			</div>
		</div>
	</div>
</blockquote>