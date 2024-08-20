<template>
  <div>
    <ul class="employee-item list-group mt-2">
        <li class="list-group-item">Nome: {{ employee.name + ' ' + employee.middle_name + ' ' + employee.last_name }} 
          <i v-if="employee.comorbidity == 1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-heart-fill" viewBox="0 0 16 16">
            <path d="M2 15.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2zM8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
          </svg>
          </i>
        </li>
        <li class="list-group-item">CPF: {{ employee.cpf }}</li>
        <li class="list-group-item">Comorbidade: {{ employee.comorbidity == 1 ? 'Sim' : 'Não'  }}</li>
        <li class="list-group-item">Nascimento: {{ formatDateBrazilian(employee.birth_date) }}</li>
        <li class="list-group-item">
          <button class="btn btn-primary btn-sm me-2 btn-vaccine" @click="sendNotification">Ver vacinas</button>
          <button class="btn btn-primary btn-sm me-2 btn-register-lot" @click="sendNotificationOpenModal">Registrar aplicação</button>
          <button class="btn btn-primary btn-sm me-2 btn-employee" @click="handleViewEdit(employee.id)">Editar funcionário</button>
          <button class="btn btn-primary btn-sm btn-employee" @click="handleDeleteEmployee(employee.id)">Excluir funcionário</button>
        </li>
    </ul>
  </div>
</template>

<script>

export default {
    name: 'EmployeeItem',
    props: ['employee'],
    data () {
      return {
        openModal: false
      }
    },
    methods: {
        sendNotification() {
            this.$emitter.emit('employeeViewVaccinesClicked', { employeeId: this.employee.id });
        },
        sendNotificationOpenModal() {
            this.$emitter.emit('employeeApplyClicked', { employeeId: this.employee.id });
        },
        handleViewEdit(employeeId) {
            this.$router.push({ name: 'employee-form', params: { id: employeeId } });
        },
        async handleDeleteEmployee(employeeId) {
            await this.$http.deleteEmployee(employeeId).then(response => {
            alert('funcionário excluído')
          console.log(response)
          this.$router.push({ path: this.$route.path, query: { reload: new Date().getTime() } }); // Redireciona após deletar
        }).catch(error => {
          alert("Algo deu errado")
          console.log(error)
        });
        },
        handleApplyModal() {
          this.openModal = true;
        }
    },
}
</script>


<style lang="css" scoped>

</style>