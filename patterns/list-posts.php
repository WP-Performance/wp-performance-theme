<?php

/**
 * Title: List Posts
 * Slug: press-wind/list-posts
 * Categories: press-wind/press-wind-patterns
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-right:0;padding-left:0"><!-- wp:heading {"align":"wide"} -->
    <h2 class="wp-block-heading alignwide">Les derniers articles</h2>
    <!-- /wp:heading -->

    <!-- wp:query {"queryId":0,"query":{"perPage":"5","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"full","layout":{"type":"default"}} -->
    <div class="wp-block-query alignfull"><!-- wp:post-template {"align":"wide","className":"wpp-list-posts","layout":{"type":"default"}} -->
        <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"right":"0","left":"0","top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"grid","minimumColumnWidth":"29rem","columnCount":null}} -->
        <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--20);padding-right:0;padding-bottom:var(--wp--preset--spacing--20);padding-left:0"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","width":"","height":"","sizeSlug":"large","style":{"border":{"radius":"1rem"},"spacing":{"padding":{"right":"var:preset|spacing|20","left":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} /-->

            <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|20","left":"var:preset|spacing|20"},"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left","verticalAlignment":"center"}} -->
            <div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:post-date /-->

                <!-- wp:post-title {"isLink":true,"fontSize":"3xlarge"} /-->

                <!-- wp:post-excerpt /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->
    </div>
    <!-- /wp:query -->
</div>
<!-- /wp:group -->