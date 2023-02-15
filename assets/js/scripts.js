// import * as Turbo from '@hotwired/turbo'

import initSearch from './algoliaSearch'
import initGithubInfos from './githubInfos'
import prefetchHover from './prefetch'

document.addEventListener('DOMContentLoaded', () => {
  initGithubInfos()
  prefetchHover(true)
  initSearch()
})
