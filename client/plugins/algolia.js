import algoliasearch from 'algoliasearch/lite'
import { createInstantSearch } from 'vue-instantsearch'
import { history } from 'instantsearch.js/es/lib/routers'

export default ({ app }, inject) => {
  const searchClient = algoliasearch(
    'IOIMP7A6Q8',
    'c5f52838a6c3cfc97ae36ee183117ea3'
  )

  const { instantsearch } = createInstantSearch({
    searchClient,
    indexName: 'snippets',
    routing: {
      router: history()
    }
  })

  inject('instantsearch', instantsearch)
}
