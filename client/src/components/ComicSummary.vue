<template>
  <tr>
    <td>
      <img :src="thumbnail">
    </td>
    <td>
      {{comic.title}}
    </td>
  </tr>
</template>

<style scoped>
  .container {
    display: flex;
    flex-direction: row
  }
  .details{
    flex:1
  }
</style>

<script>
export default {
  props: ['comic'],
  computed: {
    thumbnail: function () {
      console.log(this.$props)
      const { path, extension } = this.$props.comic.images[0]
      return path + '/portrait_medium.' + extension
    }
  }
}
</script>
