<template>
  <div class="employee-item">
      <h5>Employee: {{ employee.name }}</h5>
  </div>
</template>

<script>
export default {
  name: 'EmployeeItem',
  props: ['employee'],  
}
</script>

<style scoped lang="css">
 

</style>