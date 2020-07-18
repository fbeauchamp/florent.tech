<template>
  <section class="series">
    <h1>Series</h1>
    <template v-if="loading">
      Loading
    </template>
    <template v-else>
      <MarvelApiError v-if="errors">
        {{errors}}
      </MarvelApiError>
      <template v-else>
        <small>Results {{series.data.offset+1}} to {{series.data.offset+series.data.count}} </small>
        <SerieSummary v-for="serie in series.data.results" :key="serie.id" v-bind:serie="serie"></SerieSummary>
      </template>
    </template>
    <footer v-html="series.attributionHTML"/>
  </section>
</template>

<script>
import { getSeries } from '@/providers/marvel'
import SerieSummary from '@/components/SerieSummary.vue'
import MarvelApiError from '@/components/MarvelApiError.vue'

export default {
  components: {
    SerieSummary,
    MarvelApiError
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
        this.series = await getSeries()
        this.loading = false
      } catch (e) {
        this.loading = false
        this.errors = e.message || e
      }
    }
  }

}
</script>
