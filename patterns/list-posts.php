<?php

/**
 * Title: List Posts
 * Slug: press-wind/list-posts
 * Categories: press-wind/press-wind-patterns
 */
?>

<!-- wp:query {"queryId":0,"query":{"perPage":"5","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide">
  <!-- wp:post-template {"align":"wide","className":"wpp-list-posts"} -->
  <!-- wp:group {"layout":{"type":"constrained"}} -->
  <div class="wp-block-group">
    <!-- wp:post-featured-image {"isLink":true} /-->
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"style":{"spacing":{}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
  <div class="wp-block-group">
    <!-- wp:post-date /-->

    <!-- wp:post-title {"isLink":true,"fontSize":"3xlarge"} /-->

    <!-- wp:post-excerpt /-->
  </div>
  <!-- /wp:group -->
  <!-- /wp:post-template -->
</div>
<!-- /wp:query -->
