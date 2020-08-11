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
            <data-table :columns="columns" :url="ruta"></data-table>
          </template>
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>


<script>
import { vito } from "~/plugins/config/pluginInit";
import tablas from "~/components/Caracterizacion/tablas.vue";
export default {
  name: "ayudas",
  layout: "LightLayout",
  data() {
    return {
      ruta: `${process.env.API_URL}/api/transferencias`,
      columns: [
        {
          label: "CIUDADANO DOCUMENTO",
          name: "ciudadano.numero_documento",
          orderable: true,
        },
        {
          label: "CIUDADANO NOMBRES",
          name: "ciudadano.nombres",
          orderable: true,
        },
        {
          label: "CIUDADANO APELLIDOS",
          name: "ciudadano.apellidos",
          orderable: true,
        },
         {
          label: "NUEVO INTEGRANTE DOCUMENTO",
          name: "familia.numero_documento",
          orderable: true,
        },
        {
          label: "NUEVO INTEGRANTE NOMBRES",
          name: "familia.nombres",
          orderable: true,
        },
        {
          label: "NUEVO INTEGRANTE APELLIDOS",
          name: "familia.apellidos",
          orderable: true,
        },
        { label: "PARENTESCO", name: "parentesco", orderable: true },
      ],
    };
  },
  methods: {
    displayRow(data) {
      let ruta = `/Familias/perfil/${data.id}`;
      $nuxt.$router.push(ruta);
      // alert(`You clicked row ${data.id}`);
    },
  },
  components: {
    tablas,
  },
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
