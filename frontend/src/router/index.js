import Vue from 'vue'
import VueRouter from 'vue-router'
const EmployeesView = () => import('@/views/EmployeesView.vue')
const VaccinesView = () => import('@/views/VaccinesView.vue')

Vue.use(VueRouter)

const routes = [
  {
    path: '/employees',
    name: 'employees',
    component: EmployeesView
  },
  {
    path: '/vaccines',
    name: 'vaccines',
    component: VaccinesView
  }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
