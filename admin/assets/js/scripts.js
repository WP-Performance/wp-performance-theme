wp.domReady(() => {
	// unregister round button style
	// wp.blocks.unregisterBlockStyle('core/button', 'rounded')

	// sometime unregister don't work without that
	window._wpLoadBlockEditor.then(() => {
		console.log("Gutenberg ready !");

		wp.blocks.unregisterBlockStyle("core/image", ["default", "rounded"]);
	});

	wp.blocks.registerBlockVariation("core/group", {
		name: "group-grid",
		title: wp.i18n.__("Grid", "themeslug"),
		icon: "grid-view",
		description: wp.i18n.__("Arrange blocks in a grid.", "themeslug"),
		attributes: {
			layout: {
				type: "grid",
			},
		},
		scope: ["block", "inserter", "transform"],
		isActive: (blockAttributes) => blockAttributes.layout?.type === "grid",
	});
});
