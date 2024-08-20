<template>
  <div>
    <b-modal ref="applyModal" title="Registrar lote" @hide="handleCloseModal" ok-only ok-title="Concluído">
      <form @submit.prevent="submitForm">
        <input type="hidden" :vaccine="vaccineId">

        <b-form-group label="Identificação do lote">
          <input type="text" v-model="lot_identify" class="form-control" required>
        </b-form-group>

        <b-form-group label="Validade do lote">
          <input type="date" v-model="expiration" class="form-control" required>
        </b-form-group>
        
        <b-button class="mt-2" type="submit" variant="primary">Registrar lote</b-button>
      </form>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: 'RegisterNewLotModal',
  props: {vaccineId:{type: String, required: false}, showModal:{type: Boolean, default: false}}, 
  data() {
    return {
      lot_identify: '',
      expiration: '',
    };
  },
  methods:{
    async submitForm() {
      await this.$http.newLot(this.vaccineId, this.lot_identify, this.expiration)
                      .then(response =>{
                      alert('lote registrado');
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
      this.$emit('hide-modal');
    },
  },
  watch:{
    showModal(newValue){
      if(newValue){
        this.handleOpenModal();
      }
    }
  }
}
</script>

<style scoped lang="css">

</style>
