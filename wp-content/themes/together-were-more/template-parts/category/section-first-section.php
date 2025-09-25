<?php
/**
 * Category Page First Section
 *
 * @package ChoctawNation
 */

$category      = get_queried_object()->name;
$acf_settings  = get_field( strtolower( $category ), 'options' );
$color_overlay = cno_get_category_color( $category );
?>
<section class="row row-gap-4 flex-row-reverse justify-content-between">
	<div class="col-lg-7 px-0 px-lg-4">
		<figure class="mb-0 ratio ratio-16x9">
			<?php
			echo wp_get_attachment_image(
				$acf_settings['hero_image'],
				'large',
				false,
				array(
					'class'   => 'w-100 object-fit-cover',
					'loading' => 'lazy',
				)
			);
			?>
		</figure>
	</div>
	<div class="col px-4">
		<h2 class="text-uppercase text-gray text-center">
			<span class="display-2">We are</span><br /><?php echo $category; ?>
		</h2>
		<?php
		get_template_part(
			'template-parts/ui/hr',
			'diamonds',
			array(
				'color' => $color_overlay,
				'class' => 'w-75 mx-auto my-3',
			)
		);
		echo acf_esc_html( $acf_settings['content'] );
		?>
	</div>
</section>
