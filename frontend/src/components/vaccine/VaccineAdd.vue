<template>
    <form @submit.prevent="createItem">
      <input v-model="name" placeholder="name" required />
      <input v-model="lot" placeholder="lot" required />
      <input v-model="validate" placeholder="validate" required />
      <input v-model="boost_interval" placeholder="boost interval" required />
      <button type="submit">Create</button>
    </form>
  </template>
  
  <script>
  
  export default {
    data() {
      return {
        name: '',
        lot: '',
        validate: '',
        boost_interval: ''
      };
    },
    methods: {
      async createVaccine() {
      await this.$http.createVaccine({name: this.name, lot: this.name, validate: this.validate, boost_interval: this.boost_interval})
      .then(response => {
        this.name = ''
        this.lot = ''
        this.validate = ''
        this.boost_interval = ''
        this.$emit('item-created');
        console.log(response.data)       
      })
      .catch(error => {
        console.log(error)
      })     
    },
    }
  };
  </script>