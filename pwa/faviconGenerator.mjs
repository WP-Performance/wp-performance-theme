import { sep } from 'path'
import fs from 'fs'
import { favicons } from 'favicons'

// find theme dir name
export function getThemDir() {
  const _path = process.cwd().split(sep)
  return _path[_path.length - 1]
}

const source = './assets/media/logo-square.svg'

const configuration = {
  path: `/wp-content/themes/${getThemDir()}/pwa/dist`,
  appId: 'wp-performance',
  appName: 'WP Performance',
  appShortName: 'WP Performance',
  appDescription: 'Améliorer la performance des sites WordPress',
  background: '#fff',
  theme_color: 'rgb(190, 24, 93)',
  lang: 'fr',
  appleStatusBarStyle: 'default', // Style for Apple status bar: "black-translucent", "default", "black". `string`
  display: 'standalone', // Preferred display mode: "fullscreen", "standalone", "minimal-ui". `string`
  orientation: 'any', // Default orientation: "any", "natural", "portrait" or "landscape". `string`
  scope: '/',
  start_url: '/',
  preferRelatedApplications: false,
  pixel_art: false,
  loadManifestWithCredentials: false,
  manifestMaskable: false,
  icons: {
    coast: false,
    yandex: false,
    windows: false,
  },
  shortcuts: [],
  output: {
    images: true,
    files: true,
    html: true,
  },
}

try {
  const response = await favicons(source, configuration)
  if (response.files.length > 0) {
    const manifest = response.files[0].contents
    fs.writeFileSync('./pwa/dist/manifest.webmanifest', manifest)
  }

  // create images
  response.images.map((image) => {
    fs.writeFileSync(`./pwa/dist/${image.name}`, image.contents)
  })

  // head generated
  const head = response.html
  // remove manifest file
  // const manifestIndex = head.findIndex((e) => e.includes('manifest'))
  // if (manifestIndex) {
  //   head.splice(manifestIndex, 1)
  // }

  fs.writeFileSync(
    './inc/pwa_head.php',
    `<?php
    add_action('wp_head', function () {
    echo '${head.join('')}';
    });
  `,
  )
} catch (error) {
  console.log(error.message)
}
