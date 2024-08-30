<?php

/**
 * Title: Carousel Posts
 * Slug: press-wind/carousel-posts
 * Categories: press-wind/press-wind-patterns
 */
?>


<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"left","level":3,"align":"wide","fontSize":"1xlarge"} -->
    <h3 class="wp-block-heading alignwide has-text-align-left has-1-xlarge-font-size">
        D'autres articles qui pourraient vous intéresser
    </h3>
    <!-- /wp:heading -->

    <!-- wp:query {"queryId":0,"query":{"perPage":"6","pages":"1","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"tagName":"section","align":"wide","className":"wpp-carousel"} -->
    <section class="wp-block-query alignwide wpp-carousel"><!-- wp:post-template {"style":{"spacing":{"blockGap":"0"}}} -->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
        <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:post-featured-image {"isLink":true,"dimRatio":20,"style":{"border":{"width":"0px","style":"none","radius":"1rem"}}} /-->

            <!-- wp:post-date {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}},"textColor":"secondary"} /-->

            <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
            <div class="wp-block-group"><!-- wp:post-title {"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","right":"0","bottom":"0","left":"0"}}},"fontSize":"3xlarge"} /-->

                <!-- wp:post-excerpt /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->
    </section>
    <!-- /wp:query -->
</div>
<!-- /wp:group -->