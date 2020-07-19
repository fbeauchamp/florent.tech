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
        <paginate
          v-model="currentPage"
          :page-count="series.data.count"
          :click-handler="updatePage"
          :prevText="'Prev'"
          :nextText="'Next'"
          container-class="pagination"
          page-class="page-item">
        </paginate>
        <small>Results {{(currentPage - 1) * pageSize}} to {{currentPage * pageSize}} (total: {{series.data.total}}) </small>
        <SerieSummary v-for="serie in series.data.results" :key="serie.id" v-bind:serie="serie"></SerieSummary>
      </template>
    </template>
    <footer v-html="series.attributionHTML"/>
  </section>
</template>
<style>
  .pagination {
    display:flex;
    flex-direction: row;
    justify-content: center;
  }
  .pagination > li {
    list-style: none;
    padding: 0.25em;
  }
  .page-item.active {
    background-color: black;
    color: white;
  }
  .page-item.disabled {
    background-color: white;
    color: gray;
  }
</style>

<script>
import { getSeries } from '@/providers/marvel'
import SerieSummary from '@/components/SerieSummary.vue'
import MarvelApiError from '@/components/MarvelApiError.vue'
import Paginate from 'vuejs-paginate'

export default {
  components: {
    SerieSummary,
    MarvelApiError,
    Paginate
  },
  data () {
    return {
      loading: false,
      series: [],
      errors: null,
      currentPage: 1,
      pageSize: 20
    }
  },
  created () {
    this.fetchData()
  },
  watch: {
    currentPage: 'fetchData' // no need to debounce this
  },
  methods: {
    async fetchData () {
      this.loading = true
      this.errors = null
      this.series = []
      try {
        this.series = await getSeries({
          offset: (this.currentPage - 1) * this.pageSize,
          limit: this.pageSize
        })
        this.loading = false
      } catch (e) {
        this.loading = false
        this.errors = e.message || e
      }
    },
    updatePage (newPageNumber) {
      this.currentPage = newPageNumber
    }

  }

}
</script>
