<template>
  <div>
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <img src="/logo-feegow.svg" width="60" height="60" class="d-inline-block align-top" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <router-link class="nav-link" to="/employees">Funcionários</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'employee-form' }">Criar Funcionario</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/vaccines">Vacinas</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'vaccine-form' }">Criar Vacina</router-link>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MenuLayout',
}
</script>

<style scoped lang="css">

</style>