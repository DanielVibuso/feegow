<template>
  <ul class="employee-item list-group mt-2">
        <li class="list-group-item">Nome: {{ vaccine.name }}</li>
        <li v-if="vaccine.booster_interval > 0" class="list-group-item">intervalo reforço: {{ vaccine.booster_interval }}</li>
        <li v-else class="list-group-item">intervalo reforço: dose única</li>
        <li class="list-group-item">
          <button class="btn btn-primary btn-sm btn-lot" @click="sendNotification">Ver lotes</button>
          <button class="btn btn-primary btn-sm btn-vaccine" @click="handleViewEdit(vaccine.id)">Editar vacina</button>
        </li>
    </ul>
</template>

<script>
export default {
  name: 'VaccineItem',
  props: ['vaccine'],  
  methods:{
    sendNotification() {
      this.$emitter.emit('vaccinesViewLotsClicked', {vaccineId: this.vaccine.id});
    },
    handleViewEdit(vaccineId){
      this.$router.push({ name: 'vaccine-form', params: { id: vaccineId } })
    }
  } 
}
</script>

<style lang="css" scoped>
  .btn-vaccine{
    margin-left:2px;
  }
</style>