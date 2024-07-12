const VARIATION_NAME = "wp-performance/related-post";

wp.blocks.registerBlockVariation("core/query", {
	name: VARIATION_NAME,
	title: "Related Post",
	description: "Display a related posts",
	icon: "admin-post",
	category: "wp-performance",
	isActive: ({ namespace, query }) => {
		return namespace === VARIATION_NAME && query.postType === "post";
	},
	attributes: {
		namespace: VARIATION_NAME,
	},
});
