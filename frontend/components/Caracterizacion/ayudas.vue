<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Ayudas</h4>
          </template>
          <template v-slot:headerAction>
            <a class="text-primary float-right" v-b-toggle.collapse-1 role="button">
              <i class="ri-code-s-slash-line" />
            </a>
          </template>
          <template v-slot:body>
            <data-table
              :columns="columns"
              :url="ruta"
            ></data-table>
          </template>
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
export default {
  name: "ayudas",
  layout: "LightLayout",
  data() {
    return {
      ruta: `${process.env.API_URL}/api/ayudas/60400e2b-5df7-4eaa-a728-5f8f1359f0e8`,
      columns: [
        { label: "AYUDA", name: "lista.valor_campo_1", orderable: true },
        {
          label: "DOCUMENTO CIUDADANO",
          name: "ciudadano.numero_documento",
          orderable: true,
        },
        {
          label: "NOMBRE CIUDADANO",
          name: "ciudadano.nombres",
          orderable: true,
        },
        {
          label: "APELLIDO CIUDADANO",
          name: "ciudadano.apellidos",
          orderable: true,
        },
        {
          label: "CANTIDAD ENTREGADA",
          name: "cantidad_entregada",
          orderable: true,
        },
        { label: "FECHA ENTREGA", name: "fecha_entrega", orderable: true },
      ],
    };
  },
  methods: {},
  mounted() {
    vito.index();
  },
};
</script>

<style>
.iq-card-body {
  flex: unset;
}
</style>
