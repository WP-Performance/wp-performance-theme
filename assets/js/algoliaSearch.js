import algoliasearch from 'algoliasearch/lite'
import instantsearch from 'instantsearch.js'
import { searchBox, hits, refinementList } from 'instantsearch.js/es/widgets'

const initSearch = () => {
  const search = instantsearch({
    indexName: ALGOLIA_APP_INDEX,
    numberLocale: 'fr',
    searchClient: algoliasearch(ALGOLIA_APP_ID, ALGOLIA_APP_PUBLIC),
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

export default initSearch
