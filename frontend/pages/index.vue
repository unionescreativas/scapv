<template></template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  layout: "LightLayout",
  head: () => ({
    title: "Inicio"
  }),
  mounted() {
    vito.mainIndex();
  },
};
</script>
