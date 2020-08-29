<template>
  <b-container fluid>
    <form-modal-lista :modalShow.sync="modalShow" :lista="tableRowData" />
    <tabla-listas ref="tablaListas" @getRowData="tableRowData = $event" @modalShow="modalShow = $event" />
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  layout: "LightLayout",
  head: () => ({
    title: "Listas",
  }),
  data: () => ({
    modalShow: false,
    tableRowData: {},
  }),
};
</script>

<router>
  {
    meta: {
      name: "Listas"
    }
  }
</router>
