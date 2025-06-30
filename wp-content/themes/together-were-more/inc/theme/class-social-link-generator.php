<?php
/**
 * Social Link Generator
 * Builds links for social sharing
 *
 * @package ChoctawNation
 * @subpackage Content
 */

namespace ChoctawNation;

use CNO_Facebook_Link_Generator;

/**
 * Social Link Generator
 * Builds links for social sharing
 */
class Social_Link_Generator {
	/**
	 * Facebook Link Generator
	 *
	 * @var CNO_Facebook_Link_Generator $fb
	 */
	private CNO_Facebook_Link_Generator $fb;

	/**
	 * Constructor
	 *
	 * @param string $the_permalink The permalink of the profile to share
	 */
	public function __construct( string $the_permalink ) {
		$this->fb = new CNO_Facebook_Link_Generator( $the_permalink );
	}


	/**
	 * Gets the href
	 *
	 * @param "Facebook"|"Twitter"|"Email"|"Pinterest" $platform The social platform
	 * @return string
	 */
	public function get_the_href( string $platform ): string {
		$allowed_platforms = array( 'Facebook', 'Twitter', 'Email', 'Pinterest' );
		if ( ! in_array( $platform, $allowed_platforms, true ) ) {
			return _doing_it_wrong(
				__FUNCTION__,
				'Invalid platform. Expected one of: ' . implode( ', ', $allowed_platforms ) . 'but got ' . $platform,
				'1.0'
			);
		}
		if ( 'Facebook' === $platform ) {
			return $this->fb->get_the_href();
		}
		if ( 'Twitter' === $platform ) {
			return 'https://twitter.com/intent/tweet?url=' . rawurlencode( get_the_permalink() ) . '&text=' . rawurlencode( 'Check out ' . get_the_title() . "'s story!" );
		}
		if ( 'Email' === $platform ) {
			$post_title = get_the_title();
			$permalink  = get_permalink();
			$subject    = rawurlencode( "Together We're More Article: {$post_title}" );
			$body       = rawurlencode( "Look at this great article about {$post_title}! {$permalink}" );
			return "mailto:?subject='{$subject}'&body={$body}";
		}
		if ( 'Pinterest' === $platform ) {
			return 'https://pinterest.com/pin/create/button/?url=' . rawurlencode( get_the_permalink() ) . '&media=' . rawurlencode( get_the_post_thumbnail_url() ) . '&description=' . rawurlencode( get_the_title() . "'s story on the Together We're More site by the Choctaw Nation of Oklahoma." );
		}
	}
}
