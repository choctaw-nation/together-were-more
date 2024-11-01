<?php
/**
 * Media + Text Layout
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

use ChoctawNation\ACF\Media_And_Text;

$acf_fields = new Media_And_Text( $args, get_the_ID() );
?>
<section class="container media-and-text">
	<div class="<?php $acf_fields->the_row_classes(); ?>">
		<div class="<?php $acf_fields->the_text_col_classes(); ?>">
			<?php $acf_fields->the_text(); ?>
		</div>
		<?php if ( $acf_fields->has_media() ) : ?>
		<div class="col d-flex flex-column justify-content-center align-items-stretch position-relative">
			<?php $acf_fields->the_media(); ?>
		</div>
		<?php endif; ?>
	</div>
</section>
