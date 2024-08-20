<template>
  <div class="vaccine-lot-item col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <h3>Lote</h3>
      <ul  class="list-group">
        <li class="list-group-item">Identificação: {{ lot.lot_identify }}</li>
        <li class="list-group-item">data de validade: {{ formatDateBrazilian(lot.expiration) }}</li>
      </ul>
  </div>
</template>

<script>
export default {
  name: 'VaccineLotItem',
  props: ['lot'],  
}
</script>

<style scoped lang="css">
  .vaccine-lot-item {
    border: 1px solid;
  }

</style>