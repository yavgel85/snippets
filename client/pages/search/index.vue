<template>
  <div>
    <div class="bg-white mb-16">
      <div class="container py-10 pb-16">
        <h1 class="text-4xl text-gray-700 font-medium leading-tight mb-4">
          Search
        </h1>
      </div>
    </div>

    <div class="container">
      <h1 class="text-xl text-gray-600 font-medium mb-6">
        Snippets (x)
      </h1>
    </div>
  </div>
</template>

<script>
import { AisInstantSearchSsr } from 'vue-instantsearch'

export default {
  components: {
    AisInstantSearchSsr
  },

  head() {
    return {
      title: 'Search'
    }
  },

  data () {
    return {
      instantsearch: null
    }
  },

  provide () {
    return {
      $_ais: this.$instantsearch
    }
  },

  beforeMount() {
    this.$instantsearch.hydrate(this.instantSearchState)
  },

  async asyncData({ app }) {
    const instantsearch = app.$instantsearch

    return instantsearch
      .findResultsState({
        hitsPerPage: 20
      })
      .then(() => {
        return {
          instantSearchState: instantsearch.getState()
        }
      })
  }
}
</script>
