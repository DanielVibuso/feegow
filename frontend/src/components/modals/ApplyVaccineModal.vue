<template>
  <div>
    <b-modal ref="applyModal" title="Aplicar Vacina" @hide="handleCloseModal" ok-only ok-title="Concluído">
      <form @submit.prevent="submitForm">
        <input type="hidden" :employee="employeeId">

        <b-form-group label="Selecione o Lote">
          <b-form-select v-model="selectedLot" :options="lotOptions" required></b-form-select>
        </b-form-group>

        <b-form-group label="Data de Aplicação">
          <input type="date" v-model="appliedAt" class="form-control" required>
        </b-form-group>
        
        <b-button class="mt-2" type="submit" variant="primary">Aplicar Vacina</b-button>
      </form>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: 'ApplyVaccineModal',
  props: {employeeId:{type: String, required: false}, showModal:{type: Boolean, default: false}}, 
  data() {
    return {
      lots: [],
      selectedLot: null,
      lotOptions: [],
      appliedAt: ''
    };
  },
  methods:{
    async submitForm() {
      await this.$http.attachVaccine(this.employeeId, this.selectedLot, this.appliedAt)
                      .then(response =>{
                      alert('Aplicação registrada');
                      console.log(response)
        })
        .catch(error => {
          alert('algo deu errado, confira os logs do sistema')
        console.log(error)
      });
    },
    handleOpenModal(){
      this.$refs['applyModal'].show()
    },
    handleCloseModal() {
      console.log('metodo closeModal de dentro do modal')
      this.$emit('hide-modal');
    },
    async getLots(){
      await this.$http.getLots(1, 1000)
        .then(response => {
          this.lots = response.data.data;
          this.lotOptions = this.lots.map(lot => ({
          value: lot.id,
          text: `${lot.vaccine} - ${lot.lot_identify}`
        }));
          console.log(this.lots)
        })
        .catch(error => {
        console.log(error)
      })     
    }
  },
  watch:{
    showModal(newValue){
      if(newValue){
        this.getLots()
        this.handleOpenModal();
      }
    }
  }
}
</script>

<style scoped lang="css">

</style>
