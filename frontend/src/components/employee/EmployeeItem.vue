<template>
    <ul class="employee-item list-group mt-2">
        <li class="list-group-item">Nome: {{ employee.name + ' ' + employee.middle_name + ' ' + employee.last_name }}</li>
        <li class="list-group-item">CPF: {{ employee.cpf }}</li>
        <li class="list-group-item">Comorbidade: {{ employee.comorbidity }}</li>
        <li class="list-group-item">Nascimento: {{ employee.birth_date }}</li>
        <li class="list-group-item">
          <button class="btn btn-primary btn-sm btn-vaccine" @click="sendNotification">Ver vacinas</button>
          <button class="btn btn-primary btn-sm btn-employee" @click="handleViewEdit(employee.id)">Editar funcionário</button>
        </li>
    </ul>
</template>

<script>
export default {
  name: 'EmployeeItem',
  props: ['employee'],  
  methods:{
    sendNotification() {
      this.$emitter.emit('employeeViewVaccinesClicked', {employeeId: this.employee.id});
    },
    handleViewEdit(employeeId){
      this.$router.push({ name: 'employee-form', params: { id: employeeId } })
    }
  }
}
</script>


<style lang="css" scoped>
  .btn-employee{
    margin-left:2px;
  }
</style>