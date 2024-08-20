<template>
  <div class="container">
    <div class="row justify-content-center align-items-center full-width">
      <form class="col-md-7 col-xs-12 col-sm-12" @submit.prevent="handleSubmit">
        <p class="col-12 text-center h4">
          {{ isUpdate ? 'Editar Funcionário' : 'Criar Funcionário' }}
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
            <label for="middle_name">Nome do meio</label>
            <input type="text" class="form-control" id="middle_name" v-model="$v.form.middle_name.$model" />
            <span v-if="!$v.form.middle_name.$pending && !$v.form.middle_name.$model && !$v.form.middle_name.$error">
              Nome do meio é obrigatório
            </span>
          </div>
          <div class="form-group">
            <label for="last_name">Último nome</label>
            <input type="text" class="form-control" id="last_name" v-model="$v.form.last_name.$model" />
            <span v-if="!$v.form.last_name.$pending && !$v.form.last_name.$model && !$v.form.last_name.$error">
              Último nome é obrigatório
            </span>
          </div>
          <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" v-model="$v.form.cpf.$model" />
            <span v-if="!$v.form.cpf.$pending && !$v.form.cpf.$model && !$v.form.cpf.$error">
              {{ $v.form.cpf.$error }}
            </span>
          </div>
          <div class="form-group">
            <label for="birth_date">Data de nascimento</label>
            <input type="text" class="form-control" id="birth_date" v-model="$v.form.birth_date.$model" />
            <span v-if="!$v.form.birth_date.$pending && !$v.form.birth_date.$model && !$v.form.birth_date.$error">
              Data de nascimento é obrigatória
            </span>
          </div>
          <div class="form-group">
            <label for="comorbidity">Comorbidade</label>
            <select name="comorbidity" id="comorbidity" v-model="$v.form.comorbidity.$model">
              <option value="0">Não</option>
              <option value="1">Sim</option>
            </select>
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

import { required } from 'vuelidate/lib/validators';

export default {
  name: 'EmployeeFormView',
  validations: {
    form: {
      name: { required },
      middle_name: { required },
      last_name: { required },
      cpf: { required },
      birth_date: { required },
      comorbidity: { required }
    }
  },
  data() {
    return {
      form: {
        name: '',
        middle_name: '',
        last_name: '',
        cpf: '',
        birth_date: '',
        comorbidity: 0,
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
          await this.$http.updateEmployee(this.$route.params.id, this.form)
            .then(response => {
              if (response.status == 200) {
                alert('Funcionário atualizado');
              } else if (response.status == 422) {
                alert('Algo deu errado: ' + response.message);
              }
            })
            .catch(error => {
              console.log(error);
              alert('Algo deu errado: ' + error.message);
            });
        } else {
          await this.$http.createEmployee(this.form)
            .then(response => {
              if (response.status == 200) {
                alert('Funcionário criado com sucesso');
              } else if (response.status == 422) {
                alert('Algo deu errado: ' + response.message);
              }
            })
            .catch(error => {
              console.log(error);
              alert('Algo deu errado: ' + error.message);
            });
        }
        this.$router.push('/employees'); // Redireciona após salvar
      } catch (error) {
        alert('Erro ao salvar');
      }
    },
    async handleShowEmployee(id) {
      try {
        const response = await this.$http.getEmployee(id);
        this.form = response.data.data;
        console.log(response.data);
      } catch (error) {
        console.error('Erro ao carregar:', error);
        alert('Ocorreu um erro ao carregar.');
      }
    }
  },
  mounted() {
    this.isUpdate = !!this.$route.params.id;
    if (this.isUpdate) {
      this.handleShowEmployee(this.$route.params.id);
    }
  }
};
  </script>
  
  <style scoped>
  .container {
    margin-top: 50px;
  }
  </style>