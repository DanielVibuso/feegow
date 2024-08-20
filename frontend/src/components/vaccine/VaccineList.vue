<template>
  <div>
    <div class="employee-booklet">
        <VaccineItem v-for="vaccine in vaccines" :vaccine="vaccine" :key="vaccine.id" />
    </div>

    <div class="mt-2">
        <button class="btn btn-success btn-prev" @click="getVaccines(currentPage - 1)" :disabled="!links.prev">Anterior</button>
        <button class="btn btn-success " @click="getVaccines(currentPage + 1)" :disabled="!links.next">Próxima</button>
    </div>
  </div>
</template>

<script>
import VaccineItem from './VaccineItem.vue';

export default {
    name: 'VaccineList',
    components: { VaccineItem },
    data () {
    return {
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
  },
  mounted () {   
    this.getVaccines()
  }
}
</script>

<style scoped lang="css">
 

</style>