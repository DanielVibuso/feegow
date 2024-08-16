<template>
  <div class="employee-booklet-item" style="border: 1px solid; max-width:240px;;">
      <h3>Vaccine</h3>
      <ul>
        <li>name: {{ vaccine.name }}</li>
        <li>lot: {{ vaccine.lot }}</li>
        <li>lot validate: {{ vaccine.lot_validate }}</li>
        <li>shot: {{ vaccine.shot_number }}</li>
        <li>date shot: {{ vaccine.applied_at }}</li>
        <li>date next shot: {{ vaccine.next_shot }}</li>
      </ul>
  </div>
</template>

<script>
export default {
  name: 'EmployeeBookletItem',
  props: ['vaccine'],  
}
</script>

<style scoped lang="css">
 

</style>