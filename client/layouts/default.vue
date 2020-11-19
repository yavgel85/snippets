<template>
  <div>
    <TheNavigation />
    <Nuxt />
    <TheFooter />
  </div>
</template>

<script>
  import TheNavigation from '@/components/global/TheNavigation'
  import TheFooter from '@/components/global/TheFooter'

  export default {
    components: {
      TheNavigation,
      TheFooter
    }
  }
</script>
