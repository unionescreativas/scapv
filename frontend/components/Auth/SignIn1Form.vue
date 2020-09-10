<template>
  <ValidationObserver ref="observer">
    <b-form autocomplete="off" class="mt-4" @submit.prevent="login(_self)">
      <ValidationProvider name="email" v-slot="{ errors }">
        <b-form-group id="email" label="Correo Electrónico" label-for="email">
          <b-form-input
            type="text"
            class="form-control mb-0"
            id="email"
            v-model="form.email"
            placeholder="Ingresa tú Correo"
          />
          <div style="color: var(--iq-danger-light);" v-if="errors[0]">
            {{ errors[0].replace("email", "") }}
          </div>
        </b-form-group>
      </ValidationProvider>

      <ValidationProvider name="password" v-slot="{ errors }">
        <b-form-group id="password" label="Contraseña" label-for="password">
          <b-form-input
            type="password"
            class="form-control mb-0"
            id="password"
            v-model="form.password"
            placeholder="Ingresa tú Contraseña"
          />
          <div style="color: var(--iq-danger-light);" v-if="errors[0]">
            {{ errors[0].replace("password", "") }}
          </div>
        </b-form-group>
      </ValidationProvider>
      <div class="d-inline-block w-100">
        <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
          <input type="checkbox" class="custom-control-input" id="remember-me" />
          <label class="custom-control-label" for="remember-me">Recuérdame</label>
        </div>
        <button type="submit" class="btn btn-primary float-right">
          Inicia Sesión
        </button>
      </div>
      <div class="sign-info">
        <span class="dark-color d-inline-block line-height-2">
          Aún no tienes una cuenta?
          <nuxt-link to="/auth/iniciar-sesion" class="iq-waves-effect pr-4">
            Regístrate
          </nuxt-link>
        </span>
        <social-login-form></social-login-form>
      </div>
    </b-form>
  </ValidationObserver>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "SignIn1Form",
  head() {
    return {
      title: "Iniciar Sesión",
    };
  },
  props: {
    email: {
      type: String,
      required: true,
    },
    password: {
      type: String,
      required: true,
    },
  },
  data: () => ({
    form: {},
  }),
  methods: {
    ...mapActions(["login"]),
  },
  mounted() {
    this.form.email = this.$props.email;
    this.form.password = this.$props.password;
  },
};
</script>
