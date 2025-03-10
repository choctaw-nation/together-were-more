<?php
/**
 * Social Share Component
 *
 * @package ChoctawNation
 */

use ChoctawNation\Social_Link_Generator;

$bg_color = cno_get_category_color( get_the_category()[0]->name );
?>
<aside class="text-bg-dark social-share-bar">
	<div class="container py-5">
		<div class="row gap-3 text-center align-items-center">
			<div class="col d-flex gap-3">
				<p class="mb-0 text-uppercase">Share this story</p>
				<div class="socials d-flex gap-3 justify-content-evenly">
					<?php
					$socials   = array(
						'Facebook'  => 'fa-brands fa-facebook-f',
						'Twitter'   => 'fa-brands fa-x-twitter',
						'Pinterest' => 'fa-brands fa-pinterest-p',
						'Email'     => 'fa-light fa-envelope',
					);
					$aos_delay = 0;
					foreach ( $socials as $platform => $icon ) {
						$link_generator = new Social_Link_Generator( get_the_permalink() );
						$href           = $link_generator->get_the_href( $platform );
						$aos_delay      = $aos_delay + 50;
						echo "<a href='{$href}' data-aos='fade-in' data-aos-delay='{$aos_delay}' class='text-{$bg_color} d-block' title='Share with {$platform}' target='_blank' style='--bs-border-hover-color:var(--bs-{$bg_color});'><i class='{$icon}'></i></a>";
					}
					?>
				</div>
			</div>
		</div>
</aside>
