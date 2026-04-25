<?php
/**
 * Title: List of posts, 1 column
 * Slug: commonplace/template-query-loop
 * Categories: query
 * Block Types: core/query
 * Description: A list of posts with title, date, reading time, excerpt, and tag pills.
 *
 * @package WordPress
 * @subpackage Commonplace
 * @since Commonplace 0.1.0
 */

?>
<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-query alignfull">
	<!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"default"}} -->
		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"},"border":{"top":{"color":"var:preset|color|rule-soft","width":"1px"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--rule-soft);border-top-width:1px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">

			<!-- Date · reading time row -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
			<div class="wp-block-group">
				<!-- wp:post-date {"format":"F j, Y","className":"commonplace-mono-label","fontSize":"small"} /-->
				<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"commonplace/reading-time"}}},"className":"commonplace-mono-label","fontSize":"small"} -->
				<p class="commonplace-mono-label has-small-font-size">8 min read</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- Title (linked) -->
			<!-- wp:post-title {"isLink":true,"level":2,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} /-->

			<!-- Excerpt -->
			<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"style":{"typography":{"fontSize":"var:preset|font-size|medium"}},"textColor":"ink-soft"} /-->

			<!-- Tag pills -->
			<!-- wp:post-terms {"term":"post_tag","separator":"  ","className":"is-style-post-terms-1","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->

	<!-- No results -->
	<!-- wp:query-no-results -->
		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'commonplace' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	<!-- /wp:query-no-results -->

	<!-- Pagination -->
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
		<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-numbers /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:query -->
