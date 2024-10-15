<?php
/**
 * Media + Text Layout
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

use ChoctawNation\ACF\Media_And_Text;

extract( $args );
$acf = new Media_And_Text( $args );


?>
<section class='container media-and-text'>
	<div class="<?php $acf->the_row_classes(); ?>">
		<div class="<?php $acf->the_text_col_classes(); ?>">
			<?php $acf->the_text(); ?>
		</div>
		<div class='col d-flex flex-column justify-content-center align-items-stretch'>
			<?php $acf->the_media(); ?>
		</div>
	</div>
</section>
