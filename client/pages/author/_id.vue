<template>
  <div>
    <div class="bg-white mb-16">
      <div class="container py-10 pb-16">
        <h1 class="text-4xl text-gray-700 font-medium leading-tight mb-4">
          {{ user.name }}
        </h1>

        <div class="text-gray-600">
          Member since {{ joined }}
        </div>
      </div>
    </div>

    <div class="container">
      <h1 class="text-xl text-gray-600 font-medium mb-6">
        Public snippets ({{ snippets.length }})
      </h1>

      <SnippetCard
        v-for="snippet in snippets"
        :key="snippet.uuid"
        :snippet="snippet"
      />
    </div>
  </div>
</template>

<script>
import SnippetCard from "~/components/snippets/SnippetCard";
import moment from 'moment'

export default {
  components: {
    SnippetCard
  },

  head() {
    return {
      title: `Snippets by ${this.user.name}`
    }
  },

  data() {
    return {
      user: null,
      snippets: [],
    }
  },

  computed: {
    joined () {
      return moment(this.user.joined, 'YYYY-MM-DD HH:mm::ss').format('Do MMMM YYYY')
    }
  },

  async asyncData({ app, params }) {
    let user = await app.$axios.$get(`users/${params.id}`)
    let snippets = await app.$axios.$get(`users/${params.id}/snippets`)

    return {
      user: user.data,
      snippets: snippets.data,
    }
  }
}
</script>
