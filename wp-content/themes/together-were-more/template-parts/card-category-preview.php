<?php
/**
 * Category Preview Card
 *
 * @package ChoctawNation
 */

$category = isset( $args['category'] ) ? $args['category'] : false;
if ( false === $category ) {
	return;
}
$color = cno_get_category_color( $category->name );
$acf   = get_field( $category->name, 'options' );
?>
<div class="bg-white pb-3 position-relative">
	<div class="ratio ratio-16x9">
		<?php
		echo wp_get_attachment_image(
			$acf['hero_image'],
			'large',
			false,
			array(
				'class'   => 'w-100 object-fit-cover',
				'loading' => 'lazy',
			)
		);
		?>
	</div>
	<div class="mx-3">
		<div class="col-auto text-center">
			<h3 class="text-uppercase fs-2 my-3 fw-normal">
				<?php echo esc_textarea( $category->name ); ?>
			</h3>
			<?php
			get_template_part(
				'template-parts/ui/hr',
				'diamonds',
				array(
					'color' => $color,
					'class' => 'my-3',
				)
			);
			?>
		</div>
		<p>
			<?php echo acf_esc_html( $acf['content'] ); ?>
		</p>
		<a href="<?php echo site_url( "/{$category->slug}" ); ?>" class="btn btn-outline-gray text-uppercase stretched-link">See More
		</a>
	</div>
</div>
