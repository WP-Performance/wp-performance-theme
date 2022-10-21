let hasDebug = false

const logger = (message) => {
  if (hasDebug) {
    console.log(
      `%c 🚀 ${message}`,
      'color: blue; background: #F5F5DC;padding: 3px 6px; border-radius: 4px;',
    )
  }
}

const prefetched = []
// test prefetch page link on hover
const prefetchHover = (debug = false) => {
  hasDebug = debug
  const hasAdminBar = document.body.classList.contains('admin-bar')
  const host = window.location.hostname
  const anchorTagElements = document.getElementsByTagName('a')

  ;[...anchorTagElements].forEach((anchor) => {
    if (
      (anchor.host === host || anchor.href.startsWith('/')) &&
      anchor.href !== '' &&
      anchor.href
    ) {
      anchor.addEventListener('mouseover', (event) => {
        const href = event.target.href
        const inPrefetch = prefetched.includes(href)
        if (inPrefetch) {
          logger(`${href} already prefetched`)
        }
        // create prefetch link in head
        if (href && !inPrefetch) {
          const link = document.createElement('link')
          link.rel = 'prefetch'
          link.href = href
          document.head.appendChild(link)
          prefetched.push(href)

          logger(`add prefetch for ${href}`)
        }
      })
    }
  })
}

export default prefetchHover
