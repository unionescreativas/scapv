<template>
  <div>
    <h1 class="text-center mb-0">Iniciar Sesión</h1>
    <p>Ingrese su dirección de correo electrónico y contraseña para acceder.</p>
    <tab-content id="pills-tabContent-1" class="mt-0">
      <tab-content-item :active="true" id="pills-jwt-fill" aria-labelled-by="pills-jwt-tab-fill">
        <SignIn1Form email="" password="" />
      </tab-content-item>
    </tab-content>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  layout: "AuthLayouts/LightAuthLayout",
};
</script>
