
const initSearch = async () => {
  const { instantMeiliSearch } = await import('@meilisearch/instant-meilisearch')
  const {default: instantsearch} = await import('instantsearch.js')
  const { searchBox, hits, refinementList } = await import('instantsearch.js/es/widgets')

  const search = instantsearch({
    indexName: MEILISEARCH_APP_INDEX,
    numberLocale: 'fr',
    searchClient: instantMeiliSearch(MEILISEARCH_URL, MEILISEARCH_KEY_PUBLIC),
    searchFunction(helper) {
      // Ensure we only trigger a search when there's a query
      if (helper.state.query && helper.state.query !== '') {
        document.getElementById('hits').removeAttribute('hidden')
        helper.search()
      } else {
        document.getElementById('hits').setAttribute('hidden', true)
      }
    },
  })

  search.addWidgets([
    searchBox({
      container: '#searchbox',
    }),
    refinementList({
      container: '#tag-list',
      attribute: 'tags',
      limit: 5,
      showMore: true,
    }),
    hits({
      container: '#hits',
      templates: {
        item: `
      <article>
        <a href="{{ url }}">
          <strong>
            {{#helpers.highlight}}
              { "attribute": "title", "highlightedTagName": "mark" }
            {{/helpers.highlight}}
          </strong>
        </a>
        {{#content}}
          <p>{{#helpers.highlight}}{ "attribute": "excerpt", "highlightedTagName": "mark" }{{/helpers.highlight}}</p>
        {{/content}}
      </article>
    `,
      },
    }),
  ])

  search.start()
}


const searchboxContainer = document.getElementById('searchbox');

if(searchboxContainer) {
  initSearch()
}


// export default initSearch
