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
  props: {
    form: {
      required: true,
      type: Object,
    },
    options: {
      required: true,
    },
    ciudadano: {
      required: true,
      type: Object,
    },
  },
  data: () => ({
    modalShow: false,
    tableRowData: {},
  }),
};
</script>
