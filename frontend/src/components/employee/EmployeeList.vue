<template>
  <div class="d-flex flex-column user-list">    
    <EmployeeItem v-for="employee in employees" :employee="employee" :key="employee.id" />
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
    }
  },
  methods: {
    async getEmployees () {     
      await this.$http.getEmployees()
      .then(response => {
        this.employees = [{id: 1, name: 'Daniel', birthDate: '1995-05-03'}]
        console.log(response.data)       
      })
      .catch(error => {
        console.log(error)
      })     
    },
    searchUsers () {
      if (this.searchField.trim() === "") {
        this.followingUsers = this.originalFollowingUsers
        return
      }
      
      let obj = this.originalFollowingUsers.filter(item => {
        let arr = item.name.trim().toLowerCase().split(' ')        
        return arr.includes(this.searchField.trim().toLowerCase()) || item.name.trim().toLowerCase() === this.searchField.trim().toLowerCase()
      })      
      this.followingUsers = obj     
    }
  },
  mounted () {   
    this.getEmployees()
  }
}
</script>

<style scoped lang="css">

       
</style>