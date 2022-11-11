// import * as Turbo from '@hotwired/turbo'

import initGithubInfos from './githubInfos'
import prefetchHover from './prefetch'

document.addEventListener('DOMContentLoaded', () => {
  initGithubInfos()
  prefetchHover(true)
})
