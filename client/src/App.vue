<template>
  <div id="app">
    <div id="nav">
      <router-link to="/series">Series list</router-link> |
      <router-link to="/about">About</router-link>
    </div>
    <router-view/>
  </div>
</template>

<style>
body {
  background-color:#2c3e50;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: white;
  max-width:600px;
  margin:0 auto;
}

#nav {
  padding: 30px;
}
a{
  color: white;
}
#nav a {
  font-weight: bold;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
footer {
  margin: 2em;
  text-align: center
}
</style>
