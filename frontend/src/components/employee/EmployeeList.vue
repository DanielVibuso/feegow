<template>
  <div>
  <div style="overflow-y: scroll; height: 80vh;">
    <div class="">    
      <EmployeeItem v-for="employee in employees" :employee="employee" :key="employee.id" :links="links" />
    </div>
  </div>
  <div class="mt-2">
      <button class="btn btn-success btn-prev" @click="getEmployees(currentPage - 1)" :disabled="!links.prev">Anterior</button>
      <button class="btn btn-success " @click="getEmployees(currentPage + 1)" :disabled="!links.next">Próxima</button>
  </div>
</div>
</template>   

<script>
import EmployeeItem from '@/components/employee/EmployeeItem.vue'


export default {
  name: 'EmployeeList',
  components: { EmployeeItem },
  data () {
    return {
      employees: [],
      meta: {},
      links: {},
      currentPage: 1,
      perPage: 15
    }
  },
  methods: {
    async getEmployees (page = 1) {     
      await this.$http.getEmployees(page, this.perPage)
        .then(response => {
          this.employees = response.data.data;
          this.meta = response.data.meta;
          this.links = response.data.links;
          this.currentPage = page;
        })
        .catch(error => {
        console.log(error)
      })     
    },
  },
  mounted () {   
    this.getEmployees()
  }
}
</script>

<style scoped lang="css">
  .btn-prev{
    margin-right: 2px;
  }
</style>