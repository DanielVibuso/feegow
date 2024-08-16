<template>
  <div class="menu">
    <div class="menu-items container">
      <nav>
        <ul>
          <li><router-link to="/employees">Employees</router-link></li>
          <li><router-link to="/vaccines">Vaccines</router-link></li>
        </ul>
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