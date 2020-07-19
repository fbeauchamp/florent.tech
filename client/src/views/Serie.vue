<template>
  <div class="series">
    <template v-if="loading">
      Loading
    </template>
    <template v-else>
      <h1>{{ serie.data.results[0].title }}</h1>
      <img :src="banner" style="width:100%">
      <h2>Characters</h2>
      <div class="characters">
        <CharacterSummary
          v-for="character in serie.data.results[0].characters.items"
          :key="character.id"
          :resourceURI="character.resourceURI"
          :name="character.name"
        />
      </div>
      <h2>Comics</h2>
      <Comics :serieId="serie.data.results[0].id" ></Comics>
     <footer v-html="serie.attributionHTML"/>
    </template>
  </div>
</template>

<style scoped>
  .characters {
    display: flex;
    flex-direction: row;
    overflow-x: auto;
  }
</style>

<script>

import { getSerie } from '@/providers/marvel'
import CharacterSummary from '@/components/CharacterSummary.vue'
import Comics from '@/components/Comics.vue'
export default {
  name: 'Serie',
  components: {
    CharacterSummary,
    Comics
  },
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
