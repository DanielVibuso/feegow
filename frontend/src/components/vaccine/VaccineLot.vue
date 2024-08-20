<template>
  <div class="vaccine-lot row">
      <VaccineLotItem @click="getLots(vaccineId)" v-for="lot in lots" :lot="lot" :key="lot.id" />
  </div>
</template>

<script>
import VaccineLotItem from './VaccineLotItem.vue';

export default {
 name: 'VaccineLot',
 components: { VaccineLotItem },
  data () {
    return {
      vaccineId: '',
      lots: [],
      meta: {},
      links: {},
      currentPage: 1,
      perPage: 15
    }
  },
  mounted() {
    this.$emitter.on('vaccinesViewLotsClicked', (eventData) => {
      console.log('Vaccine clicked:', eventData);
      this.vaccineId = eventData.vaccineId;
      this.getLots();

    });
  },
  methods: {
    async getLots (page = 1) {   
      await this.$http.getLots(page, this.perPage, this.vaccineId)
        .then(response => {

          this.lots = response.data.data;
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


</style>