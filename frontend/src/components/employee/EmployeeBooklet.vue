<template>
  <div class="employee-booklet">
      <EmployeeBookletItem v-for="vaccine in vaccines" :vaccine="vaccine" :key="vaccine.id" />
  </div>
</template>

<script>
import EmployeeBookletItem from './EmployeeBookletItem.vue';

export default {
    name: 'EmployeeBooklet',
    props: ['employee'],
    components: { EmployeeBookletItem },
    data () {
    return {
      vaccines: [{id:1, name:'coronavac', lot: 'AZX345', lot_validate: '2024-08-01', shot_number: 1, applied_at: '2023-05-01', next_shot: '2027-05-06'},
                 {id:2, name:'coronavac', lot: 'AZX345', lot_validate: '2024-08-01', shot_number: 1, applied_at: '2023-05-01', next_shot: '2027-05-06'}],
    }
  },
}
</script>

<style scoped lang="css">
 

</style>