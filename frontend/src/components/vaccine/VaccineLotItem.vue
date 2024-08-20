<template>
  <div class="vaccine-lot-item col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <h3>Lote</h3>
      <ul>
        <li>Identificação: {{ lot.lot_identify }}</li>
        <li>data de validade: {{ lot.expiration }}</li>
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