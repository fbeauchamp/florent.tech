<template>
  <div class="container">
    <img :src="thumbnail">
    <div class="details">
      <h3>{{serie.title}}</h3>
      <p>
        {{serie.description}}
      </p>
        <router-link :to="link" class="link">Details</router-link>
    </div>
  </div>
</template>

<style scoped>
  .container {
    display: flex;
    flex-direction: row;
    margin:1em 0;
  }
  .details{
    flex:1;
    position: relative;
  }
  .details:hover{
    background-color:#1c2833;
  }
  .link{
    position: absolute;
    right:1em;
    bottom:1em;
  }
</style>

<script>
export default {
  props: ['serie'],
  computed: {
    link: function () {
      return '/serie/' + this.serie.id
    },
    thumbnail: function () {
      const { path, extension } = this.serie.thumbnail
      return path + '/portrait_medium.' + extension
    }
  }
}
</script>
