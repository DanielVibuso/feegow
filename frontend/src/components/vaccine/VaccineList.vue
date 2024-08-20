<template>
  <div>
    <div style="overflow-y: scroll; height: 80vh;">
      <div class="employee-booklet">
          <VaccineItem v-for="vaccine in vaccines" :vaccine="vaccine" :key="vaccine.id" />
      </div>

      <apply-vaccine-modal :vaccineId="vaccineId" :showModal="openModal" @hide-modal="handleCloseModal"/>
    </div>
    <div class="mt-2">
        <button class="btn btn-success btn-prev" @click="getVaccines(currentPage - 1)" :disabled="!links.prev">Anterior</button>
        <button class="btn btn-success " @click="getVaccines(currentPage + 1)" :disabled="!links.next">Próxima</button>
    </div>
  </div>
</template>

<script>
import VaccineItem from './VaccineItem.vue';
import ApplyVaccineModal from '../modals/RegisterNewLotModal.vue';

export default {
    name: 'VaccineList',
    components: { VaccineItem, ApplyVaccineModal },
    data () {
    return {
      vaccineId: '',
      openModal: false,
      vaccines: [],
      meta: {},
      links: {},
      currentPage: 1,
      perPage: 15
    }
  },
  methods: {
    async getVaccines (page = 1) {     
      await this.$http.getVaccines(page, this.perPage)
        .then(response => {
          this.vaccines = response.data.data;
          this.meta = response.data.meta;
          this.links = response.data.links;
          this.currentPage = page;
          console.log(this.vaccines)
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
    this.getVaccines()
    this.$emitter.on('newLotClicked', (eventData) => {
      console.log('Abrir registro de vacina:', eventData);
      this.vaccineId = eventData.vaccineId;
      this.handleOpenModal();
    })
  }
}
</script>

<style scoped lang="css">
 

</style>