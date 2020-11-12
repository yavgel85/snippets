<template>
  <div>
    <div class="bg-white mb-16">
      <div class="container py-10 pb-16">
        <div class="w-10/12">
          <h1 class="text-4xl text-gray-700 font-medium leading-tight mb-4">
            {{ snippet.title || 'Untitled snippet' }}
          </h1>

          <div class="text-gray-600">
            Created by
            <nuxt-link
              :to="{  }"
            >
              {{ snippet.author.data.name }}
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <h1 class="text-xl text-gray-600 font-medium mb-6">
        {{ currentStepIndex + 1 }}/{{ steps.length }}. {{ currentStep.title }}
      </h1>

      <div class="flex flex-wrap lg:flex-no-wrap">
        <div class="w-full lg:w-8/12 lg:mr-16 flex flex-wrap lg:flex-no-wrap justify-between items-start mb-8">
          <div class="order-first mr-2">
            <StepNavigationButton
              :step="previousStep"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="fill-current text-white h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
            </StepNavigationButton>
          </div>

          <div class="bg-white p-8 rounded-lg text-gray-600 w-full lg:mr-2">
            <StepMarkdown
              :value="currentStep.body"
            />
          </div>

          <div class="flex flex-row lg:flex-col order-first lg:order-last">
            <StepNavigationButton
              :step="nextStep"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="fill-current text-white h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </StepNavigationButton>

            <nuxt-link
              v-if="snippet.user.data.owner"
              :to="{
                name: 'snippets-id-edit',
                params: {
                  id: snippet.uuid
                },
                query: {
                  step: currentStep.uuid
                }
              }"
              class="block mb-2 p-3 bg-blue-500 rounded-lg order-first lg:order-last mr-2 lg:mr-0"
              title="Edit step"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-white h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
            </nuxt-link>
          </div>
        </div>

        <div class="w-full lg:w-4/12">
          <div class="mb-8">
            <h1 class="text-xl text-gray-600 font-medium mb-6">
              Steps
            </h1>

            <StepList
              :steps="orderStepsAsc"
              :currentStep="currentStep"
            />
          </div>

          <div class="text-gray-500 text-small">
            Use <div class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm">Ctrl</div> + <div class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm">Shift</div> + <div class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm">Left</div> or <div class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm">Right</div> on your keyboard to navigate between steps.
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import StepList from './components/StepList'
  import StepNavigationButton from './components/StepNavigationButton'
  import StepMarkdown from '@/components/snippets/StepMarkdown'

  import browseSnippet from "~/mixins/snippets/browseSnippet";

  export default {
    head() {
      return {
        title: `${this.snippet.title || 'Untitled snippet'}`
      }
    },

    components: {
      StepList,
      StepNavigationButton,
      StepMarkdown,
    },

    data () {
      return {
        snippet: null,
        steps: [],
      }
    },

    mixins: [
      browseSnippet
    ],

    async asyncData({ app, params }) {
      let snippet = await app.$axios.$get(`snippets/${params.id}`)

      return {
        snippet: snippet.data,
        steps: snippet.data.steps.data,
      }
    }
  }
</script>
