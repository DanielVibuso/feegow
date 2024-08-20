<template>
  <div class="employee-booklet row">
      <EmployeeBookletItem @click="getShots(employee)" v-for="shot in shots" :shot="shot" :key="shot.id" />
  </div>
</template>

<script>
import EmployeeBookletItem from './EmployeeBookletItem.vue';

export default {
 name: 'EmployeeBooklet',
 components: { EmployeeBookletItem },
  data () {
    return {
      employeeId: '',
      shots: [],
      meta: {},
      links: {},
      currentPage: 1,
      perPage: 15
    }
  },
  mounted() {
    this.$emitter.on('employeeViewVaccinesClicked', (eventData) => {
      console.log('Employee clicked:', eventData);
      this.employeeId = eventData.employeeId;
      this.getShots();

    });
  },
  methods: {
    async getShots (page = 1) {   
      await this.$http.getShots(page, this.perPage, this.employeeId)
        .then(response => {

          this.shots = response.data.data;
          this.meta = response.data.meta;
          this.links = response.data.links;
          this.currentPage = page;
          console.log(this.shots)
        })
        .catch(error => {
        console.log(error)
      })     
  }
 }
}
</script>

<style scoped lang="css">
  
  .employee-item{
    cursor: pointer;
    border: 1px solid;
  }

</style>