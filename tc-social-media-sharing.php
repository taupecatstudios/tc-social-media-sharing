<?php
/**
 * Plugin Name: Social Media Sharing by Taupecat Studios
 * Plugin URI: http://taupecatstudios.com
 * Description: Adds social media sharing buttons to posts and pages.
 * Version: 1.0
 * Author: Taupecat Studios
 * Author URI: http://taupecatstudios.com
 *
 * @package Social Media Sharing
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Create function to add social media sharing buttons to posts and pages.
 *
 * @param int $post_id The post ID.
 *
 * @return void
 */
function tc_social_media_sharing( $post_id = null ) {

	// If no post ID is passed, use the current post.
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	$title           = rawurlencode( wp_strip_all_tags( get_the_title() ) );
	$title_email     = rawurlencode( htmlspecialchars_decode( get_the_title() ) );
	$title_twitter   = $title;
	$title_opengraph = $title;
	$url             = rawurlencode( get_the_permalink() );

	$facebook = 'event.preventDefault(); window.open(\'//facebook.com/sharer/sharer.php?u=' . $url . '&t=' . $title_opengraph . '\', \'facebook_share\', \'height=320, width=640, \');';
	$twitter  = '//twitter.com/intent/tweet?url=' . $url . '&text=' . $title_twitter;
	$linkedin = '//linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title_opengraph;
	$email    = 'mailto:?subject=' . $title_email . '&body=' . $url;
	?>
	<div class="tc-social-media-sharing">
		<div class="label"><strong><?php esc_html_e( 'Share:', 'tcsms' ); ?></strong></div>
		<div class="facebook"><a href="//facebook.com" onclick="<?php echo esc_attr( $facebook ); ?>"><?php esc_html_e( 'Facebook', 'tcsms' ); ?></a></div>
		<div class="twitter"><a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><?php esc_html_e( 'Twitter', 'tcsms' ); ?></a></div>
		<div class="linkedin"><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><?php esc_html_e( 'LinkedIn', 'tcsms' ); ?></a></div>
		<div class="email"><a href="<?php echo esc_url( $email, 'mailto' ); ?>" target="_blank"><?php esc_html_e( 'Email', 'tcsms' ); ?></a></div>
	</div>
	<?php
}

/**
 * Enqueue the stylesheet.
 */
function tc_social_media_sharing_enqueue() {
	wp_enqueue_style( 'tc-social-media-sharing', plugin_dir_url( __FILE__ ) . 'tc-social-media-sharing.css', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'tc_social_media_sharing_enqueue' );
