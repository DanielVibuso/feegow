<template>
  <div class="employee-booklet-item col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <h3>Vacina</h3>
      <ul>
        <li>Nome: {{ shot.vaccine }}</li>
        <li>lote: {{ shot.lot_identify }}</li>
        <li>Data apĺicação: {{ formatDateBrazilian(shot.applied_at) }} </li>
        <li>proxima dose: {{ formatDateBrazilian(shot.next_shot) || 'dose única'  }}</li>
        <li v-if="shot.next_shot">dose: {{ shot.shot_number }}</li>
      </ul>
  </div>
</template>

<script>
export default {
  name: 'EmployeeBookletItem',
  props: ['shot'],  
}
</script>

<style scoped lang="css">
  .employee-booklet-item {
    border: 1px solid;
  }

</style>