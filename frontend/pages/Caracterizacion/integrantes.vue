<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Integrantes</h4>
          </template>
          <template v-slot:headerAction>
            <a class="text-primary float-right" v-b-toggle.collapse-1 role="button">
              <i class="ri-code-s-slash-line" />
            </a>
          </template>
          <template v-slot:body>
            <data-table :columns="columns" :url="ruta" />
          </template>
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
import tablas from "~/components/Caracterizacion/Tablas.vue";

export default {
  name: "ciudadanos",
  layout: "LightLayout",
  data() {
    return {
      ruta: `${process.env.API_URL}api/familias`,
      columns: [
        {
          label: "CONSULTAR",
          name: "",
          orderable: false,
          classes: {
            btn: true,
            "btn-primary": true,
            "btn-sm": true,
          },
          event: "click",
          handler: this.displayRow,
          component: tablas,
        },
        {
          label: "CEDULA CIUDADANO",
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
        { label: "PARENTESCO", name: "parentesco", orderable: true },
        { label: "TIPO DE DOCUMENTO", name: "tipo_documento", orderable: true },
        {
          label: "NUMERO DE DOCUMENTO",
          name: "numero_documento",
          orderable: true,
        },
        {
          label: "# PERMISO ESPECIAL DE PERMANENCIA",
          name: "pep",
          orderable: true,
        },
        { label: "NOMBRES", name: "nombres", orderable: true },
        { label: "APELLIDOS", name: "apellidos", orderable: true },
        {
          label: "FECHA DE EXPEDICION DEL DOCUMENTO",
          name: "fecha_expedicion",
          orderable: true,
        },
        {
          label: "FECHA DE VENCIMIENTO DEL DOCUMENTO",
          name: "fecha_vencimiento",
          orderable: true,
        },
        {
          label: "FECHA DE NACIMIENTO",
          name: "fecha_nacimiento",
          orderable: true,
        },
        { label: "EDAD", name: "edad", orderable: true },
        { label: "GENERO", name: "genero", orderable: true },
        { label: "ESTADO CIVIL", name: "estado_civil", orderable: true },
        { label: "TELEFONO", name: "telefono", orderable: true },
        { label: "CELULAR", name: "celular", orderable: true },
        {
          label: "CORREO ELECTRONICO",
          name: "correo_electronico",
          orderable: true,
        },
        {
          label: "DEPARTAMENTO DE RESIDENCIA",
          name: "departamento",
          orderable: true,
        },
        { label: "CIUDAD DE RESIDENCIA", name: "ciudad", orderable: true },
        { label: "BARRIO DE RESIDENCIA", name: "barrrio", orderable: true },
        { label: "COMUNA DE RESIDENCIA", name: "comuna", orderable: true },
        {
          label: "DIRRECION DE RESIDENCIA",
          name: "dirrecion",
          orderable: true,
        },
        { label: "ACTIVIDAD", name: "actividad", orderable: true },
        { label: "CIUDAD DE ORIGEN", name: "ciudad_origen", orderable: true },
        { label: "PAIS DE ORIGEN", name: "pais_origen", orderable: true },
        {
          label: "FECHA DE LLEGADA AL PAIS",
          name: "fecha_llegada",
          orderable: true,
        },
        {
          label: "FECHA DE LLEGADA AL PAIS",
          name: "intencion_ciudad",
          orderable: true,
        },
        {
          label: "FECHA DE LLEGADA AL PAIS",
          name: "respuesta_intencion",
          orderable: true,
        },
        {
          label: "TIENE ALGUNA DISCAPACIDAD",
          name: "discapacidad",
          orderable: true,
        },
        { label: "TIENE SISTEMA DE SALUD", name: "salud", orderable: true },
        {
          label: "SE ENCUENTRA ESTUDIANDO ACTUALMENTE",
          name: "estudia_actualmente",
          orderable: true,
        },
        {
          label: "NIVEL DE ESCOLARIDAD",
          name: "nivel_escolaridad",
          orderable: true,
        },
        { label: "PROFESIONAL EN ?", name: "tipo_profesion", orderable: true },
        { label: "POBLACIÓN LGTBI", name: "comunidad_lgtbi", orderable: true },
        {
          label: "PERTENECE ALGUNA COMUNA ETNICA ?",
          name: "comunidad_etnica",
          orderable: true,
        },
        {
          label: "ACTUALMENTE SE ENCUENTRA LABORANDO",
          name: "trabajo",
          orderable: true,
        },
        { label: "TIPO DE EMPLEO", name: "tipo_empleo", orderable: true },
        { label: "OBSERVACIONES", name: "observaciones", orderable: true },
      ],
    };
  },
  methods: {
    displayRow(data) {
      let ruta = `/Familias/perfil/${data.id}`;
      $nuxt.$router.push(ruta);
    },
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
