<?php
/**
 * Breadcrumbs
 *
 * @package ChoctawNation
 */

$breadcrumbs   = array();
$breadcrumbs[] = array(
	'title' => 'Home',
	'url'   => home_url(),
);

if ( is_category() ) {
	$breadcrumbs[] = array(
		'title' => single_cat_title( '', false ),
	);
}

if ( is_single() ) {
	$breadcrumbs[] = array(
		'title' => get_the_category()[0]->name,
		'url'   => '/' . get_the_category()[0]->slug,
	);
	$breadcrumbs[] = array(
		'title' => get_the_title(),
	);
}
$is_gutenberg      = ! empty( $args['is_gutenberg'] ) && $args['is_gutenberg'];
$container_classes = array( 'my-5' );
if ( $is_gutenberg ) {
	$container_classes[] = 'container-xxl';
} else {
	$container_classes[] = 'container';
}
?>
<nav aria-label="breadcrumb" class="<?php echo implode( ' ', $container_classes ); ?>">
	<div class="row">
		<div class="<?php echo 'col' . ( $is_gutenberg ? ' px-xxl-0' : '' ); ?>">
			<ol class="breadcrumb list-unstyled m-0 w-100">
				<?php foreach ( $breadcrumbs as $index => $breadcrumb ) : ?>
					<?php $is_current = count( $breadcrumbs ) - 1 === $index; ?>
				<li class="breadcrumb-item<?php echo $is_current ? ' active' : ''; ?>" <?php echo $is_current ? 'aria-current="page"' : ''; ?>
					style="--bs-link-color-rgb:var(--bs-<?php echo cno_get_primary_color(); ?>-rgb);">
					<?php if ( ! $is_current ) : ?>
					<a href="<?php echo esc_url( $breadcrumb['url'] ); ?>">
						<?php echo esc_html( $breadcrumb['title'] ); ?>
					</a>
					<?php else : ?>
						<?php echo esc_html( $breadcrumb['title'] ); ?>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div>
</nav>