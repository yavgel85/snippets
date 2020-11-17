<template>
  <AisInstantSearchSsr>
    <div class="bg-white mb-16">
      <div class="container py-10 pb-16">
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-4xl text-gray-700 font-medium leading-tight mb-4">
            Search
          </h1>

          <client-only>
            <AisPoweredBy />
          </client-only>
        </div>


        <AisSearchBox
          placeholder="Search snippets"
          :class-names="{
            'ais-SearchBox': 'w-full',
            'ais-SearchBox-input': 'w-full border-2 border-gray-400 rounded-lg block p-4 text-lg',
            'ais-SearchBox-submit': 'hidden',
            'ais-SearchBox-submitIcon': 'hidden',
            'ais-SearchBox-reset': 'hidden',
          }"
        />
      </div>
    </div>

    <div class="container">
      <AisStateResults>
        <div slot-scope="{ query }">
          <template v-if="query.length">
            <AisStats>
              <h1
                class="text-xl text-gray-600 font-medium mb-6"
                slot-scope="{ nbHits }"
              >
                Snippets ({{ nbHits }})
              </h1>
            </AisStats>

            <AisHits>
              <div slot="item" slot-scope="{ item }">
                <SearchSnippetCard
                  :snippet="item.data"
                />
              </div>
            </AisHits>
          </template>
        </div>
      </AisStateResults>
    </div>
  </AisInstantSearchSsr>
</template>

<script>
import SearchSnippetCard from "~/pages/search/components/SearchSnippetCard";
import {
  AisInstantSearchSsr,
  AisHits,
  AisSearchBox,
  AisPoweredBy,
  AisStats,
  AisStateResults,
} from 'vue-instantsearch'

export default {
  components: {
    SearchSnippetCard,
    AisInstantSearchSsr,
    AisHits,
    AisSearchBox,
    AisPoweredBy,
    AisStats,
    AisStateResults,
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
