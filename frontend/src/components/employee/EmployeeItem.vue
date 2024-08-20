<template>
  <div>
    <ul class="employee-item list-group mt-2">
        <li class="list-group-item">Nome: {{ employee.name + ' ' + employee.middle_name + ' ' + employee.last_name }}</li>
        <li class="list-group-item">CPF: {{ employee.cpf }}</li>
        <li class="list-group-item">Comorbidade: {{ employee.comorbidity == 1 ? 'Sim' : 'Não'  }}</li>
        <li class="list-group-item">Nascimento: {{ formatDateBrazilian(employee.birth_date) }}</li>
        <li class="list-group-item">
          <button class="btn btn-primary btn-sm me-2 btn-vaccine" @click="sendNotification">Ver vacinas</button>
          <button class="btn btn-primary btn-sm me-2 btn-register-lot" @click="sendNotificationOpenModal">Registrar aplicação</button>
          <button class="btn btn-primary btn-sm btn-employee" @click="handleViewEdit(employee.id)">Editar funcionário</button>
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
        handleApplyModal() {
          this.openModal = true;
        }
    },
}
</script>


<style lang="css" scoped>

</style>