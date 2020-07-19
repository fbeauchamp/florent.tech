<template>
  <div class="container">
    <paginate
        v-model="currentPage"
        :prevText="'Prev'"
        :nextText="'Next'"
        :page-count="comics.data.count"
        container-class="pagination"
        page-class="page-item">
      </paginate>
      <table>
      <tbody>
        <ComicSummary v-for="comic in comics.data.results" :key="comic.id" :comic="comic"/>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
</style>

<script>
import Paginate from 'vuejs-paginate'
import ComicSummary from './ComicSummary'
import { getComics } from '@/providers/marvel'
export default {
  props: ['serieId'],
  components: {
    Paginate,
    ComicSummary
  },
  data () {
    return {
      loading: true,
      comics: [],
      errors: null,
      currentPage: 1,
      pageSize: 20
    }
  },
  created () {
    this.fetchData()
  },
  watch: {
    currentPage: 'fetchData'
  },
  methods: {
    async fetchData () {
      this.loading = true
      this.errors = null
      this.series = []
      console.log(this.$props)
      try {
        const params = {
          offset: (this.currentPage - 1) * this.pageSize,
          limit: this.pageSize
        }
        this.comics = await getComics(this.$props.serieId, params)
        this.loading = false
      } catch (e) {
        this.loading = false
        this.errors = e.message || e
      }
    }
  }
}
</script>
