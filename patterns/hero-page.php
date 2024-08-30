<?php

/**
 * Title: Hero Page
 * Slug: press-wind/hero-page
 * Categories: press-wind/press-wind-patterns
 */
?>

<!-- wp:group {"align":"full","className":"gm-hero-page","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull gm-hero-page"><!-- wp:group {"align":"wide","style":{"dimensions":{"minHeight":"60vh"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"center"}} -->
    <div class="wp-block-group alignwide" style="min-height:60vh;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"className":"is-style-underscore","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontFamily":"Sora","metadata":{
		"bindings":{
			"content":{
				"source":"core/post-meta",
				"args":{
					"key":"wp-page-thematic"
				}
			}
		}
	}} -->
        <p class="is-style-underscore has-sora-font-family" style="font-style:normal;font-weight:600">Totalement open-source</p>
        <!-- /wp:paragraph -->

        <!-- wp:post-title {"className":"is-style-title-hero","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"fontSize":"6xlarge"} /-->

        <!-- wp:post-excerpt {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}}},"textColor":"secondary","fontSize":"xlarge"} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->