<template>
  <div class="employee-booklet">
      <VaccineItem v-for="vaccine in vaccines" :vaccine="vaccine" :key="vaccine.id" />
  </div>
</template>

<script>
import VaccineItem from './VaccineItem.vue';

export default {
    name: 'VaccineList',
    props: [],
    components: { VaccineItem },
    data () {
    return {
      vaccines: [{id:1, name:'coronavac', lot: 'AZX345', lot_validate: '2024-08-01', booster_interval: 90, applied_at: '2023-05-01', next_shot: '2027-05-06'},
                 {id:2, name:'astrazeneca', lot: 'YKI128', lot_validate: '2024-08-01', booster_interval: 120, applied_at: '2023-05-01', next_shot: '2027-05-06'}],
    }
  },
}
</script>

<style scoped lang="css">
 

</style>