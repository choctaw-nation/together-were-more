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
<div class="bg-white h-100 d-flex flex-column">
	<figure class="ratio ratio-16x9 mb-0">
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
	</figure>
	<div class="mx-5 mb-3 d-flex flex-column flex-grow-1">
		<div class="text-center">
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
			<h3 class="text-uppercase fs-2 my-3 fw-normal">
				<?php echo esc_textarea( $category->name ); ?>
			</h3>
		</div>
		<div class="mb-3">
			<?php echo acf_esc_html( $acf['content'] ); ?>
		</div>
		<?php $link_color = 'var(--bs-' . cno_get_category_color( $category->name ) . '-rgb)'; ?>
		<a href="<?php echo site_url( "/{$category->slug}" ); ?>" class="text-uppercase stretched-link mt-auto d-block" style="--bs-link-color-rgb:<?php echo $link_color; ?>">See More
		</a>
	</div>
</div>