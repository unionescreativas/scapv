<template>
  <div>
    <buscador-ciudadano @mostrarFormFamilias="mostrarFormFamilias" />
    <form-familias v-if="mostrar" />
  </div>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
import Swal from "sweetalert2";

export default {
  layout: "LightLayout",
  data: () => ({
    mostrar: false,
  }),
  mounted() {
    vito.index();
  },
  methods: {
    mostrarFormFamilias(value) {
      this.mostrar = value;
    },
  },
};
</script>
