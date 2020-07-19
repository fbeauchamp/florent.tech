import Vue from 'vue'
import VueRouter from 'vue-router'
import About from '../views/About.vue'
import Series from '../views/Series.vue'
import Serie from '../views/Serie.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Series',
    component: Series
  },
  {
    path: '/series',
    name: 'Series',
    component: Series
  },
  {
    path: '/serie/:id',
    name: 'Serie',
    component: Serie
  },
  {
    path: '/about',
    name: 'About',
    component: About
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
