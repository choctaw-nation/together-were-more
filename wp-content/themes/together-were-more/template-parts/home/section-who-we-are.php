<?php
/**
 * Who We Are
 * Section with animated text
 *
 * @package ChoctawNation
 */

$section = get_field( 'who_we_are' );
$img_id  = $section['background_image']['id'];
wp_enqueue_style( 'who-we-are' );
wp_enqueue_script( 'who-we-are' );
$statements = array_map( fn( $word ) => esc_textarea( $word['statement'] ), $section['statements'] );
?>
<section class='position-relative py-5 overflow-hidden' id='who-we-are'>
	<?php
	echo wp_get_attachment_image(
		$img_id,
		'full',
		false,
		array(
			'class'       => 'position-absolute top-0 start-0 w-100 h-100 z-n1 object-fit-cover',
			'aria-hidden' => 'true',
		)
	);
	?>
	<div class="container position-relative z-1">
		<div class="row row-cols-1 justify-content-center">
			<div class="col-xl-6 text-center statements" aria-label="We are <?php echo implode( ',', $statements ); ?>">
				<div class="statement text-white text-uppercase fw-bold ls-1" aria-hidden="true">
					We are
				</div>
				<p class="display-2 text-white text-uppercase" id="statement-word" data-statements="<?php echo implode( ',', $statements ); ?>" aria-hidden="true">
					Choctaw Proud.
				</p>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-8 text-center">
				<p class="font-pill-gothic fw-lighter text-white">
					<?php echo esc_textarea( $section['body'] ); ?>
				</p>
			</div>
		</div>
	</div>
</section>
