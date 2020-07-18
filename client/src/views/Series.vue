<template>
  <section class="series">
    <h1>Series</h1>
    <template v-if="loading">
      Chargement en cours
    </template>
    <template v-else>
      <template v-if="errors">
        Something's gone wrong during series loading : {{errors}}
      </template>
      <template v-else>
        <small>Results {{series.data.offset+1}} to {{series.data.offset+series.data.count}} </small>
        <SerieSummary v-for="serie in series.data.results" :key="serie.id" v-bind:serie="serie"></SerieSummary>
      </template>
    </template>
  </section>
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
        this.series = await res.json()
        this.loading = false
      } catch (e) {
        this.loading = false
        this.errors = e.message || e
      }
    }
  }

}
</script>
