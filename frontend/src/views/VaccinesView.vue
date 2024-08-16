<template>
  <div class="home container">    
    <div class="row">
      <div class="col-lg-6">
        <VaccineList />
      </div>
      <div class="col-lg-6">
        <VaccineItem />
      </div>
    </div>
  </div>
</template>

<script>
import VaccineList from '@/components/vaccine/VaccineList.vue'
import VaccineItem from '@/components/vaccine/VaccineItem.vue'

export default {
  name: 'VacinnesView',
  components: { VaccineList, VaccineItem }, 
}
</script>

<style scoped lang="sass">


</style>
