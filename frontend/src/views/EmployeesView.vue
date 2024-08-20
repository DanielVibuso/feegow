<template>
  <div class="container">    
    <div class="row mt-3">
      <div class="col-6">
        <EmployeeList />
      </div>
      <div class="col-6">
        <EmployeeBooklet></EmployeeBooklet>
      </div>
    </div>
  </div>
</template>

<script>
import EmployeeBooklet from '@/components/employee/EmployeeBooklet.vue';
import EmployeeList from '@/components/employee/EmployeeList.vue'

export default {
  name: 'HomeView',
  components: { EmployeeList, EmployeeBooklet }, 
}
</script>

<style scoped lang="css">
</style> 