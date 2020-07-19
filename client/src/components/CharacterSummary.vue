<template>
  <div class="container" v-if="loading">
    <div class="details" >
      <h3>{{name}}</h3>
    </div>
  </div>
  <div class="container" v-else>
    <img :src="thumbnail">
    <div class="details" >
      <a :href="wiki" v-if="wiki" target="_blank" rel="noopener noreferrer nofollow">
        <h3 class="name">{{name}}</h3>
      </a>
        <h3 class="name" v-else>{{name}}</h3>

    </div>
  </div>
</template>

<style scoped>
.container{
  position: relative;
  margin:0.5em;
}
.name{
  position: absolute;
  left:0;
  right:0;
  bottom:0;
  white-space: nowrap;
  background-color: rgba(255,255,255,0.5);
  text-align: center;
}
</style>

<script>
import { getCharacter } from '@/providers/marvel'
export default {
  name: 'Character',
  data () {
    return {
      loading: false,
      character: {},
      errors: null
    }
  },
  computed: {
    thumbnail: function () {
      if (this.loading) {
        return null
      }
      const { path, extension } = this.character.data.results[0]?.thumbnail
      return path + '/portrait_medium.' + extension
    },
    wiki: function () {
      if (this.loading) {
        return null
      }
      const { url } = this.character.data.results[0]?.urls.find(({ type }) => type === 'wiki')
      return url
    }
  },
  props: ['resourceURI', 'name'],
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
      const id = this.$props.resourceURI?.split('/').pop()
      console.log(id, this.$props)
      if (!id) {
        this.errors = new Error('No character id')
        return
      }
      this.loading = true
      this.errors = null
      this.series = []
      try {
        this.character = await getCharacter(id)
        console.log(this.character)
        this.loading = false
      } catch (e) {
        this.loading = false
        this.errors = e.message || e
      }
    }
  }
}
</script>
