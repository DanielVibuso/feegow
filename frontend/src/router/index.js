import Vue from 'vue'
import VueRouter from 'vue-router'
const EmployeesView = () => import('@/views/EmployeesView.vue')
const EmployeeFormView = () => import('@/views/EmployeeFormView.vue')
const VaccinesView = () => import('@/views/VaccinesView.vue')
const VaccineFormView = () => import('@/views/VaccineFormView.vue')

Vue.use(VueRouter)

const routes = [
  {
    path: '/employees',
    name: 'employees',
    component: EmployeesView
  },
  { 
    path: 'employee-form/:id?', 
    name: 'employee-form', 
    component: EmployeeFormView
  },
  {
    path: '/vaccines',
    name: 'vaccines',
    component: VaccinesView
  },
  { 
    path: 'vaccine-form/:id?', 
    name: 'vaccine-form', 
    component: VaccineFormView
  },

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
