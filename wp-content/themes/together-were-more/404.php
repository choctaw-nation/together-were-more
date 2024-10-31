<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ChoctawNation
 */

get_header();
$button_color = cno_get_primary_color();
?>
<main id="main" class="site-main container py-5 mt-5">
	<section class="error-404 not-found">
		<div class="page-404">
			<h1 class="mb-3 display-1">404</h1>
			<p class="alert alert-info mb-4 fs-5">
				<?php esc_html_e( 'Page not found.', 'cno' ); ?>
			</p>
			<a class="<?php echo "btn btn-outline-{$button_color}"; ?>" href="<?php echo esc_url( home_url() ); ?>" role="button">
				<?php esc_html_e( 'Back Home &raquo;', 'cno' ); ?>
			</a>
		</div>
	</section>
</main>
<?php
get_footer();
