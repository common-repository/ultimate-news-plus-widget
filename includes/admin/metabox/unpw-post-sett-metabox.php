<?php
/**
 * Handles 'News' post settings metabox HTML
 *
 * @package Ultimate News Plus Widget
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = CCS_UNPW_META_PREFIX; // Metabox prefix

// Getting saved values
$read_more_link = get_post_meta( $post->ID, $prefix.'more_link', true );
?>

<table class="form-table unpw-post-sett-table">
	<tbody>

		<tr valign="top">
			<th scope="row">
				<label for="unpw-more-link"><?php _e('Read More Link', 'ccs-ultimate-news-plus-widget'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo ccs_unpw_esc_attr($read_more_link); ?>" class="large-text unpw-more-link" id="unpw-more-link" name="<?php echo $prefix; ?>more_link" /><br/>
				<span class="description"><?php _e('Redirect to a custom link URL. e.g http://conceptcorners.com', 'ccs-ultimate-news-plus-widget'); ?></span>
			</td>
		</tr>

	</tbody>
</table><!-- end .wtwp-tstmnl-table -->