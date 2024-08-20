<template>
  <div class="container">
    <div class="row justify-content-center align-items-center full-width">
      <form class="col-md-7 col-xs-12 col-sm-12" @submit.prevent="handleSubmit">
        <p class="col-12 text-center h4">
          {{ isUpdate ? 'Editar Vacina' : 'Criar Vacina' }}
        </p>
        <div class="col-md-4 col-sm-6 col-xs-10">
          <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" v-model="$v.form.name.$model" />
            <span v-if="!$v.form.name.$pending && !$v.form.name.$model && !$v.form.name.$error">
              Nome é obrigatório
            </span>
          </div>
          <div class="form-group">
            <label for="middle_name">Dias necessários para o reforço</label>
            <input type="text" class="form-control" id="booster_interval" v-model="$v.form.booster_interval.$model" />
            <span v-if="!$v.form.booster_interval.$pending && !$v.form.booster_interval.$model && !$v.form.booster_interval.$error">
              Tempo de reforço é obrigatório
            </span>
          </div>
          
          <button type="submit" class="btn btn-primary btn-block">
            Salvar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
  
  <script>

import { required, numeric } from 'vuelidate/lib/validators';

export default {
  name: 'VaccineFormView',
  validations: {
    form: {
      name: { required },
      booster_interval: { required, numeric },
    }
  },
  data() {
    return {
      form: {
        name: '',
        booster_interval: '',
      },
      isUpdate: false
    };
  },
  methods: {
    async handleSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }

      try {
        if (this.isUpdate) {
          await this.$http.updateVaccine(this.$route.params.id, this.form)
            .then(response => {
              if (response.status == 200) {
                alert('Vacina atualizado');
              } else if (response.status == 422) {
                alert('Algo deu errado: ' + response.message);
              }
            })
            .catch(error => {
              console.log(error);
              alert('Algo deu errado: ' + error.message);
            });
        } else {
          await this.$http.createVaccine(this.form)
            .then(response => {
              if (response.status == 200) {
                alert('Vacina criado com sucesso');
              } else if (response.status == 422) {
                alert('Algo deu errado: ' + response.message);
              }
            })
            .catch(error => {
              console.log(error);
              alert('Algo deu errado: ' + error.message);
            });
        }
        this.$router.push('/vaccines'); // Redireciona após salvar
      } catch (error) {
        alert('Erro ao salvar');
      }
    },
    async handleShowVaccine(id) {
      try {
        const response = await this.$http.getVaccine(id);
        this.form = response.data.data;
        console.log(response.data);
      } catch (error) {
        console.error('Erro ao carregar', error);
        alert('Ocorreu um erro ao carregar.');
      }
    }
  },
  mounted() {
    this.isUpdate = !!this.$route.params.id;
    if (this.isUpdate) {
      this.handleShowVaccine(this.$route.params.id);
    }
  }
};
  </script>
  
  <style scoped>
  .container {
    margin-top: 50px;
  }
  </style>