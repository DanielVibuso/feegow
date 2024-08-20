<template>
  <div class="">
  <div style="overflow-y: scroll; height: 80vh;">
    <div class="">    
      <EmployeeItem v-for="employee in employees" :employee="employee" :key="employee.id" :links="links" />
    </div>
    <apply-vaccine-modal :employeeId="employeeId" :showModal="openModal" @hide-modal="handleCloseModal"/>
  </div>
  <div class="mt-2">
      <button class="btn btn-success btn-prev" @click="getEmployees(currentPage - 1)" :disabled="!links.prev">Anterior</button>
      <button class="btn btn-success " @click="getEmployees(currentPage + 1)" :disabled="!links.next">Próxima</button>
  </div>
</div>
</template>   

<script>

import ApplyVaccineModal from '../modals/ApplyVaccineModal.vue';
import EmployeeItem from '@/components/employee/EmployeeItem.vue'


export default {
  name: 'EmployeeList',
  components: { EmployeeItem, ApplyVaccineModal },
  data () {
    return {
      employeeId: '',
      openModal: false,
      employees: [],
      meta: {},
      links: {},
      currentPage: 1,
      perPage: 15
    }
  },
  methods: {
    async getEmployees (page = 1) {     
      await this.$http.getEmployees(page, this.perPage)
        .then(response => {
          this.employees = response.data.data;
          this.meta = response.data.meta;
          this.links = response.data.links;
          this.currentPage = page;
        })
        .catch(error => {
        console.log(error)
      })     
    },
    handleOpenModal(){
      console.log('chegou no abrir modal')
      this.openModal = true
    },
    handleCloseModal(){
      this.openModal = false
      console.log('this open modal', this.openModal)
    }
  },
  mounted () {   
    this.getEmployees()
    this.$emitter.on('employeeApplyClicked', (eventData) => {
      console.log('Abrir registro de vacina:', eventData);
      this.employeeId = eventData.employeeId;
      this.handleOpenModal();
    })
  }
}
</script>

<style scoped lang="css">
  .btn-prev{
    margin-right: 2px;
  }
</style>