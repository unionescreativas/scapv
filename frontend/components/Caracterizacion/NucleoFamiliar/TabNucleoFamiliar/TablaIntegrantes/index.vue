<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <data-table
          ref="dataTable"
          :classes="table.classes"
          :translate="table.translate"
          :columns="table.columns"
          :url="table.url + ciudadano.id"
        >
          <div slot="filters" slot-scope="{ tableData }">
            <div class="row justify-content-between mb-2">
              <div class="col-md-3">
                <b-button variant="secondary" @click="agregarIntegrante()">
                  <i class="fa fa-user-plus"></i>
                  <span>Agregar Integrante</span>
                </b-button>
              </div>

              <div class="col-md-3">
                <input
                  name="name"
                  class="form-control"
                  v-model="tableData.search"
                  placeholder="Buscar ..."
                  autocomplete="off"
                />
              </div>
            </div>
          </div>

          <div slot="pagination" slot-scope="{ links = {}, meta = {} }">
            <nav class="row">
              <div class="col-md-6 text-left">
                <span class="text-dark">
                  Mostrando registros del {{ meta.from }} al {{ meta.to }} de un total de {{ meta.total }} registros
                </span>
              </div>

              <div class="col-md-6 text-right">
                <ul class="pagination justify-content-end" v-if="meta.total > meta.per_page">
                  <li class="page-item pagination-prev-nav" v-if="links.prev">
                    <a
                      href="javascript:void(0);"
                      role="button"
                      aria-label="Anterior"
                      class="page-link"
                      @click="table.url = links.prev"
                    >
                      <span>Anterior</span>
                    </a>
                  </li>

                  <template v-for="page in meta.last_page">
                    <li
                      :key="page"
                      v-if="(page < meta.last_page && Math.abs(page - meta.current_page) < 2) || page == 1"
                      class="page-item pagination-page-nav"
                      :class="{ active: meta.current_page === page }"
                    >
                      <a
                        href="javascript:void(0);"
                        role="button"
                        class="page-link"
                        @click="table.url = `${meta.path}?page=${page}`"
                      >
                        <span>{{ page }}</span>
                      </a>
                    </li>

                    <li
                      :key="page + 1"
                      v-if="page == 1 && Math.abs(page - meta.current_page) > 2"
                      class="page-item pagination-page-nav"
                    >
                      <a href="javascript:void(0);" role="button" class="page-link">
                        <span>&hellip;</span>
                      </a>
                    </li>

                    <li
                      :key="page"
                      v-if="page == meta.last_page && Math.abs(page - meta.current_page) > 2"
                      class="page-item pagination-page-nav"
                    >
                      <a href="javascript:void(0);" role="button" class="page-link">
                        <span>&hellip;</span>
                      </a>
                    </li>
                  </template>

                  <li class="page-item pagination-page-nav" :class="{ active: meta.current_page === meta.last_page }">
                    <a href="javascript:void(0);" role="button" class="page-link" @click="table.url = links.last">
                      <span>{{ meta.last_page }}</span>
                      <span class="sr-only">(last)</span>
                    </a>
                  </li>

                  <li class="page-item pagination-next-nav" v-if="links.next">
                    <a
                      href="javascript:void(0);"
                      role="button"
                      aria-label="Siguiente"
                      class="page-link"
                      @click="table.url = links.next"
                    >
                      <span>Siguiente</span>
                    </a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </data-table>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  props: {
    ciudadano: {
      required: true,
      type: Object,
    },
  },
  data() {
    return {
      modalShow: false,
      tableRowData: null,
      table: {
        url: `${process.env.API_URL}/api/nucleofamiliar/`,
        tableProps: { dir: "desc" },
        classes: {
          "table-container": { "table-responsive": true },
          table: { table: true, "table-hover": true, "table-bordered": true, "text-center": true },
          "t-head": { "table-header-iq-primary": true },
          th: {
            "align-middle": true,
          },
          td: {
            "align-middle": true,
          },
        },
        columns: [
          {
            label: "EDITAR",
            orderable: false,
            event: "click",
            handler: this.getRowData,
            component: () => import("./BtnEditarIntegrante.vue"),
          },
          { label: "PARENTESCO", name: "parentesco", orderable: true },
          { label: "TIPO DE DOCUMENTO", name: "tipo_documento", orderable: true },
          { label: "NUMERO DE DOCUMENTO", name: "numero_documento", orderable: true },
          { label: "# PERMISO ESPECIAL DE PERMANENCIA", name: "pep", orderable: true },
          { label: "NOMBRES", name: "nombres", orderable: true },
          { label: "APELLIDOS", name: "apellidos", orderable: true },
          { label: "FECHA DE EXPEDICION DEL DOCUMENTO", name: "fecha_expedicion", orderable: true },
          { label: "FECHA DE VENCIMIENTO DEL DOCUMENTO", name: "fecha_vencimiento", orderable: true },
          { label: "FECHA DE NACIMIENTO", name: "fecha_nacimiento", orderable: true },
          { label: "EDAD", name: "edad", orderable: true },
          { label: "GENERO", name: "genero", orderable: true },
          { label: "ESTADO CIVIL", name: "estado_civil", orderable: true },
          { label: "TELEFONO", name: "telefono", orderable: true },
          { label: "CELULAR", name: "celular", orderable: true },
          { label: "CORREO ELECTRONICO", name: "correo_electronico", orderable: true },
          { label: "ACTIVIDAD QUE REALIZA ACTUALMENTE", name: "actividad", orderable: true },
          { label: "TIENE ALGUNA DISCAPACIDAD", name: "discapacidad", orderable: true },
          { label: "TIENE SISTEMA DE SALUD", name: "salud", orderable: true },
          { label: "SE ENCUENTRA ESTUDIANDO ACTUALMENTE", name: "estudia_actualmente", orderable: true },
          { label: "NIVEL DE ESCOLARIDAD", name: "nivel_escolaridad", orderable: true },
          { label: "ACTUALMENTE SE ENCUENTRA LABORANDO", name: "trabajo", orderable: true },
          { label: "OBSERVACIONES", name: "observaciones", orderable: true },
        ],
      },
    };
  },
  methods: {
    agregarIntegrante() {
      this.$emit("getRowData", null);
      this.$emit("modalShow", true);
    },
    getRowData(data) {
      this.$emit("getRowData", data);
      this.$emit("modalShow", true);
    },
    reloadDataTable() {
      this.$refs.dataTable.getData();
    },
  },
  mounted() {
    vito.index();
  },
};
</script>
