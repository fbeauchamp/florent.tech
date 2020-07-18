<template>
  <div class="series">
    <template v-if="loading">
      Loading
    </template>
    <template v-else>
      <h1>{{ serie.title }}</h1>
      <img :src="banner">
      <h2>Characters</h2>
      <div class="characters">
        <div class="character"  v-for="character in serie.data.results[0].characters.items" :key="character.id">
          <h4>{{character.name}}</h4>
        </div>
      </div>
      <h2>Comics</h2>
      <table>
        <tbody>
          <tr  v-for="comic in serie.data.results[0].comics.items" :key="comic.id">
            <td>
              {{comic.name}}
            </td>
          </tr>
        </tbody>
      </table>
     <footer v-html="serie.attributionHTML"/>
    </template>
  </div>
</template>

<style scoped>
  .characters {
    display: flex;
    flex-direction: row;
    justify-content: center;
  }
  .character {
    flex: 120 0 0
  }
</style>

<script>

import { getSerie } from '@/providers/marvel'
/* https://router.vuejs.org/guide/essentials/dynamic-matching.html#reacting-to-params-changes */
export default {
  name: 'Serie',
  data () {
    return {
      loading: false,
      serie: {},
      errors: null
    }
  },
  computed: {
    banner: function () {
      const { path, extension } = this.serie.data.results[0]?.thumbnail ?? {}
      return path + '/landscape_incredible.' + extension
    }
  },
  created () {
    // fetch the data when the view is created and the data is
    // already being observed
    this.fetchData()
  },
  watch: {
    $route: 'fetchData'
  },
  methods: {
    async fetchData () {
      this.loading = true
      this.errors = null
      this.series = []
      try {
        this.serie = await getSerie(this.$route.params.id)
        this.loading = false
      } catch (e) {
        this.loading = false
        this.errors = e.message || e
      }
    }
  }
}
</script>
