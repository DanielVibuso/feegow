<template>
  <div class="employee-booklet-item" style="border: 1px solid; max-width:240px;;">
      <h3>Vaccine</h3>
      <ul>
        <li>name: {{ vaccine.name }}</li>
        <li>lot: {{ vaccine.lot }}</li>
        <li>lot validate: {{ vaccine.lot_validate }}</li>
        <li>Booster interval: {{ vaccine.booster_interval }} </li>
      </ul>
  </div>
</template>

<script>
export default {
  name: 'VaccineItem',
  props: ['vaccine'],  
}
</script>

<style scoped lang="css">
 

</style>