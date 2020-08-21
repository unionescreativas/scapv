<template>
  <div>
    <buscador-ciudadano @obtener_numero_documento="obtener_numero_documento" />
    <form-nucleo v-if="numero_documento" :numero_documento="numero_documento" />
  </div>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
import Swal from "sweetalert2";

export default {
  layout: "LightLayout",
  head: () => ({
    title: "Crear Núcleo",
  }),
  data: () => ({
    numero_documento: "",
  }),
  mounted() {
    vito.index();
  },
  methods: {
    obtener_numero_documento(value) {
      this.numero_documento = value;
    },
  },
};
</script>

<router>
  {
    meta: {
      name: "Crear Núcleo"
    }
  }
</router>
