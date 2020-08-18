<template>
  <form-listas />
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  layout: "LightLayout",
  head: () => ({
    title: "Crear Listas",
  }),
  mounted() {
    vito.index();
  },
};
</script>
