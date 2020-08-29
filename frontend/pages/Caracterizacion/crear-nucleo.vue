<template>
  <div>
    <buscador-ciudadano @numero_documento="numero_documento = $event" />
    <nucleo-familiar v-if="numero_documento" :numero_documento="numero_documento" />
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
};
</script>

<router>
  {
    meta: {
      name: "Crear Núcleo"
    }
  }
</router>
