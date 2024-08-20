<template>
  <div class="home container">    
    <div class="row">
      <div class="col-lg-6">
        <VaccineList />
      </div>
      <div class="col-lg-6">
        <VaccineLot />
      </div>
    </div>
  </div>
</template>

<script>
import VaccineList from '@/components/vaccine/VaccineList.vue'
import VaccineLot from '@/components/vaccine/VaccineLot.vue';

export default {
  name: 'VacinnesView',
  components: { VaccineList, VaccineLot }, 
}
</script>

<style scoped lang="css">


</style>
