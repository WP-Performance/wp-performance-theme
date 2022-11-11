const $fetch = async (url) => {
  let data = null
  try {
    const response = await fetch(url)
    data = await response.json()
  } catch (e) {
    throw e
  }
  return data
}

const createAnchor = ({ href, text, className = [] }) => {
  const a = document.createElement('a')
  a.href = href
  a.target = '_blank'
  a.textContent = text
  className.forEach((c) => a.classList.add(c))
  return a
}

const initGithubInfos = async () => {
  const gitHubInfos = document.querySelectorAll('.gm-github-infos')
  if (gitHubInfos) {
    const data = await $fetch(
      'https://api.github.com/repos/WP-Performance/press-wind',
    )
    if (data) {
      for (let i = 0; gitHubInfos.length > i; i++) {
        gitHubInfos[i].querySelector('p:first-child').innerHTML = ''
        const a = createAnchor({
          href: data.html_url,
          text: `${data.stargazers_count} Stars`,
          className: ['gm-star'],
        })
        gitHubInfos[i].querySelector('p').append(a)
      }
    }

    const dataZip = await $fetch(
      'https://api.github.com/repos/WP-Performance/press-wind/tags',
    )
    if (dataZip && dataZip.length > 0) {
      const [d] = dataZip
      for (let z = 0; gitHubInfos.length > z; z++) {
        const a = createAnchor({
          href: d.zipball_url,
          text: `Télécharger la dernière version (${d.name})`,
          className: ['gm-zip'],
        })
        gitHubInfos[z].querySelector('p').append(a)
      }
    }
  }
}

export default initGithubInfos
