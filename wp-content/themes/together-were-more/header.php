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
	<header class="container-fluid gx-5 d-flex text-bg-dark position-sticky top-0 py-3" id="site-header">
		<div class="row justify-content-between align-items-center w-100">
			<div class="col-auto flex-shrink-1">
				<h2 class="my-2 align-items-center fw-bold d-flex column-gap-3 flex-wrap">
					<?php
						$front_page_id      = get_option( 'page_on_front' );
						$category_spotlight = get_field( 'category_spotlight', $front_page_id )['category_to_spotlight']->name;
						$hover_color        = cno_get_category_color( $category_spotlight );
					?>
					<a class="navbar-brand fs-5 font-gill-sans" href="<?php echo esc_url( site_url() ); ?>" class="logo" aria-label="to Home Page"
						style="--bs-navbar-brand-hover-color:var(--bs-<?php echo $hover_color; ?>);">
						Choctaw Nation of Oklahoma
					</a>
				</h2>
			</div>
			<div class="col-auto">
				<nav class="navbar navbar-expand-lg py-0">
					<button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
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
			<div class="col-auto d-none d-lg-block border-0 bg-transparent">
				<button class="border-0 bg-transparent" aria-label="search" data-bs-toggle="modal" data-bs-target="#site-search">
					<figure class="mb-0 text-white d-inline-block">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
							<path
									d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
							</path>
						</svg>
					</figure>
				</button>
			</div>
		</div>
	</header>
	<?php
	get_template_part( 'template-parts/modal', 'search-form' );
