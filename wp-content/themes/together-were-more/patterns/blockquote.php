<?php
/**
 * Title: Blockquote
 * Slug: twm/blockquote
 * Description: The Blockquote pattern with the background image
 * Post Types: post
 * Viewport Width: 1320
 * Keywords: blockquote, quote, pullquote
 *
 * @package ChoctawNation
 */

?>
<!-- wp:group {"tagName":"section","metadata":{"name":"Blockquote"},"align":"full","style":{"background":{"backgroundImage":{"url":"https://cnotwmdev.wpenginepowered.com/wp-content/uploads/2024/10/black-bg-chevron-noise.jpg","id":89,"source":"file","title":"black-bg-chevron-noise"},"backgroundSize":"cover","backgroundPosition":"50% 50%"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-white-color has-text-color has-link-color">
	<!-- wp:quote {"style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}}} -->
	<blockquote class="wp-block-quote" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
		<!-- wp:paragraph {"align":"center","fontSize":"h2","fontFamily":"script"} -->
		<p class="has-text-align-center has-script-font-family has-h-2-font-size">“A nice big quote goes here.”</p>
		<!-- /wp:paragraph -->
	</blockquote>
	<!-- /wp:quote -->
</section>
<!-- /wp:group -->