import algoliasearch from 'algoliasearch/lite'
import { createInstantSearch } from 'vue-instantsearch'
import { history } from 'instantsearch.js/es/lib/routers'

export default async ({ app }, inject) => {
  let key = await app.$axios.$get('keys/algolia')

  const searchClient = algoliasearch(
    'IOIMP7A6Q8',
    key.data
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
