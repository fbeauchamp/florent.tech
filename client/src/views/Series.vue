<template>
  <div class="series">
    <h1>List all series</h1>
    <SerieSummary v-for="serie in series" :key="serie.id" v-bind:serie="serie"></SerieSummary>
  </div>
</template>

<script>
import { marvelApiUrl } from '@/providers/conf'
import SerieSummary from '@/components/SerieSummary.vue'

export default {
  components: {
    SerieSummary
  },
  data () {
    return {
      loading: false,
      series: [],
      errors: null
    }
  },
  created () {
    // fetch the data when the view is created and the data is
    // already being observed
    this.fetchData()
  },
  methods: {
    async fetchData () {
      this.loading = true
      this.errors = null
      this.series = []
      try {
        const res = await fetch(marvelApiUrl + 'series.json')
        const json = await res.json()
        this.loading = false
        this.series = json.data.results
      } catch (e) {
        this.loading = false
        this.errors = e.message || e
      }
    }
  }

}
</script>
