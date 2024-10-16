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
	<header class="d-flex text-bg-dark position-sticky top-0" id="site-header">
		<div class="container">
			<nav class="navbar navbar-expand-lg py-0">
				<?php
				$front_page_id      = get_option( 'page_on_front' );
				$category_spotlight = get_field( 'category_spotlight', $front_page_id )['category_to_spotlight']->name;
				$hover_color        = cno_get_category_color( $category_spotlight );
				?>
				<a class="navbar-brand my-2 align-items-center fw-bold d-flex column-gap-3 flex-wrap" href="<?php echo esc_url( site_url() ); ?>" class="logo" aria-label="to Home Page"
				   style="--bs-navbar-brand-hover-color:var(--bs-<?php echo $hover_color; ?>);">
					<?php
					$logo = get_template_directory_uri() . '/src/assets/the-great-seal--white.svg';
					echo "<img src='{$logo}' class='logo' alt='Choctaw Nation of Oklahoma Seal' loading='lazy' />";
					?>

					<span class="d-none d-lg-block font-gill-sans">Choctaw Nation of Oklahoma</span>
					<span class="d-block d-lg-none font-pill-gothic text-uppercase fs-4">Together We're More</span>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
						aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="offcanvas offcanvas-end ms-auto flex-grow-0" id='navbarNav' tabindex="-1">
					<?php
					$bg_texture = get_template_directory_uri() . '/src/assets/white-texture.jpeg';
					echo "<img src='{$bg_texture}' loading='lazy' class='position-absolute object-fit-cover w-100 h-100 top-0 d-lg-none z-n1'/>";
					?>
					<div class="offcanvas-header mt-5">
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<?php get_template_part( 'template-parts/menu', 'main-menu' ); ?>
				</div>
			</nav>
		</div>
	</header>