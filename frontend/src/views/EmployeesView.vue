<template>
  <div class="home container">    
    <div class="row">
      <div class="col-lg-6">
        <EmployeeList />
      </div>
      <div class="col-lg-6">
        <EmployeeBooklet />
      </div>
    </div>
  </div>
</template>

<script>
import EmployeeList from '@/components/employee/EmployeeList.vue'
import EmployeeBooklet from '@/components/employee/EmployeeBooklet.vue'

export default {
  name: 'HomeView',
  components: { EmployeeList, EmployeeBooklet }, 
}
</script>

<style scoped lang="sass">


</style>
