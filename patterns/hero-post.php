<?php

/**
 * Title: Hero Post
 * Slug: press-wind/hero-post
 * Categories: press-wind/press-wind-patterns
 */
?>

<!-- wp:group {"align":"full","className":"gm-hero-page","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull gm-hero-page"><!-- wp:group {"align":"wide","style":{"dimensions":{"minHeight":"60vh"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"center"}} -->
    <div class="wp-block-group alignwide" style="min-height:60vh;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"className":"is-style-underscore","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontFamily":"Sora"} -->
        <p class="is-style-underscore has-sora-font-family" style="font-style:normal;font-weight:600">Les articles</p>
        <!-- /wp:paragraph -->

        <!-- wp:post-title {"className":"is-style-title-hero","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"6xlarge"} /-->

        <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"}} -->
        <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"0.3rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}}},"textColor":"secondary"} -->
                <p class="has-secondary-color has-text-color has-link-color">Publié le</p>
                <!-- /wp:paragraph -->

                <!-- wp:post-date {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}}} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:post-terms {"term":"category","separator":"/","prefix":"Dans : ","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent"}}}},"textColor":"secondary"} /-->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->