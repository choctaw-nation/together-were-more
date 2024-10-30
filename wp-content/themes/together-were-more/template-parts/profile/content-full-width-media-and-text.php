<?php
/**
 * Full Width Media + Text Layout
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

use ChoctawNation\ACF\Full_Width_Media_And_Text;

$acf_fields = new Full_Width_Media_And_Text( $args, get_the_ID() );


?>
<section class="d-flex flex-column flex-lg-column-reverse row-gap-3 full-width-media-and-text overflow-hidden">
	<div class="container">
		<div class="row">
			<div class="<?php $acf_fields->the_text_col_classes(); ?>">
				<?php $acf_fields->the_text(); ?>
			</div>
		</div>
	</div>
	<div class="container-fluid gx-0">
		<div class="row">
			<div class="col">
				<?php $acf_fields->the_media(); ?>
			</div>
		</div>
	</div>
</section>
