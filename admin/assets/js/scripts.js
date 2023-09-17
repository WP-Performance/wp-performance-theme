wp.domReady(() => {
  // unregister round button style
  // wp.blocks.unregisterBlockStyle('core/button', 'rounded')

  // sometime unregister don't work without that
  window._wpLoadBlockEditor.then(() => {
    console.log('Gutenberg ready !')

    wp.blocks.unregisterBlockStyle('core/image', ['default', 'rounded'])
  })
})
