<template>
  <b-container fluid>
    <form-modal-integrante
      :modalShow.sync="modalShow"
      :options="options"
      :ciudadano="ciudadano"
      :integrante="tableRowData"
    />
    <tabla-integrantes
      ref="tablaIntegrantes"
      :ciudadano="ciudadano"
      @getRowData="tableRowData = $event"
      @modalShow="modalShow = $event"
    />
  </b-container>
</template>

<script>
export default {
  props: ["forms", "options", "ciudadano"],
  data: () => ({
    modalShow: false,
    tableRowData: {},
  }),
};
</script>
