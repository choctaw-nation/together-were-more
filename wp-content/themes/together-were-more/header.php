<?php
/**
 * Basic Header Template
 *
 * @package ChoctawNation
 */

?>

<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<header class="container-fluid text-bg-dark position-sticky top-0 py-3" id="site-header">
		<div class="row gx-0 justify-content-between align-items-center w-100">
			<div class="col-auto flex-shrink-1">
				<h2 class="my-2 align-items-center fw-bold d-flex column-gap-3 flex-wrap">
					<?php $hover_color = cno_get_primary_color(); ?>
					<a class="navbar-brand fs-5 font-gill-sans" href="<?php echo esc_url( site_url() ); ?>" class="logo" aria-label="to Home Page"
						style="--bs-navbar-brand-hover-color:var(--bs-<?php echo $hover_color; ?>);">
						Choctaw Nation
					</a>
				</h2>
			</div>
			<div class="col-auto">
				<nav class="navbar navbar-expand-lg py-0">
					<button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
							aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="offcanvas offcanvas-end ms-auto" id='navbarNav' tabindex="-1">
						<?php
							$bg_texture = get_template_directory_uri() . '/src/assets/white-texture.jpeg';
							echo "<img src='{$bg_texture}' loading='lazy' class='position-absolute object-fit-cover w-100 h-100 top-0 d-lg-none z-n1'/>";
						?>
						<div class="offcanvas-header">
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<?php get_template_part( 'template-parts/menu', 'main-menu' ); ?>
					</div>
				</nav>
			</div>
		</div>
	</header>
	<?php
	get_template_part( 'template-parts/modal', 'search-form' );
