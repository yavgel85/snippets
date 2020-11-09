import { orderBy as _orderBy } from 'lodash'
import hotkeys from 'hotkeys-js'

export default {
  computed: {
    orderStepsAsc () {
      return _orderBy (
        this.steps, 'order', 'asc'
      )
    },

    orderStepsDesc () {
      return _orderBy (
        this.steps, 'order', 'desc'
      )
    },

    firstStep () {
      return this.orderStepsAsc[0]
    },

    nextStep () {
      return this.orderStepsAsc.find(
        (s) => s.order > this.currentStep.order
      ) || null
    },

    previousStep () {
      return this.orderStepsDesc.find(
        (s) => s.order < this.currentStep.order
      ) || null
    },

    currentStep () {
      return this.orderStepsAsc.find(
        (s) => s.uuid === this.$route.query.step
      ) || this.firstStep
    },

    currentStepIndex () {
      return this.orderStepsAsc.map(
        (s) => s.uuid
      ).indexOf(this.currentStep.uuid)
    }
  },

  mounted() {
    this.registerKeyboardShortcuts()
  },

  methods: {
    goToStep (step) {
      this.$router.push({
        query: {
          step: step.uuid
        }
      })
    },

    registerKeyboardShortcuts () {
      hotkeys('ctrl+shift+left, ctrl+shift+right', (event, handler) => {
        switch (handler.key) {
          case 'ctrl+shift+left':
            if (this.previousStep) {
              this.goToStep(this.previousStep)
            }
            break;
          case 'ctrl+shift+right':
            if (this.nextStep) {
              this.goToStep(this.nextStep)
            }
            break;
        }
      })
    }
  }
}
