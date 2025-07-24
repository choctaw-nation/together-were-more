<?php
/**
 * Title: Two Column Layout
 * Slug: twm/two-col
 * Description: A two column layout pattern with media on one side and text on the other.
 * Post Types: post
 * Viewport Width: 1320
 * Keywords: two columns, layout, media, text
 *
 * @package ChoctawNation
 */

?>
<!-- wp:group {"tagName":"section","templateLock":"all","lock":{"move":true,"remove":true},"align":"wide","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignwide">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","isDirectionReversed":true} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center" style="flex-direction:row-reverse">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:paragraph -->
			<p>Insert some text here...</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"id":584,"sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img
					 src="https://together-were-more.local/wp-content/uploads/2025/08/BioPortrait-corey-berlin-august-marathon-runner-Together-Were-more-TWM-togetherweremore-Choctaw-nation-scaled.jpg"
					 alt="" class="wp-image-584" /></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->