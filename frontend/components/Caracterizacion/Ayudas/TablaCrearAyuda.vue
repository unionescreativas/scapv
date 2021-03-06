<template>
  <b-container fluid>
    <b-row class="mt-5">
      <b-col sm="12">
        <h4>Ayudas Cargadas</h4>
        <data-table
          ref="ListaAyudas"
          :classes="table.classes"
          :translate="table.translate"
          :columns="table.columns"
          :url="table.url"
        >
          <div slot="filters" slot-scope="{ tableData }">
            <div class="row justify-content-between mb-2">
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
  props: ["ciudadano", "estado"],
  data() {
    return {
      modalShow: false,
      table: {
        url: `${process.env.API_URL}/api/ayudas/${this.ciudadano}`,
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
            label: "OPCIONES",
            orderable: false,
            event: "click",
            handler: this.getRowData,
            // component: () => import("./BotonEditar.vue"),
          },
          { label: "CEDULA CIUDADANO", name: "ciudadano.numero_documento", orderable: true },
          { label: "NOMBRE CIUDADANO", name: "ciudadano.nombres", orderable: true },
          { label: "APELLIDO CIUDADANO", name: "ciudadano.apellidos", orderable: true },
          { label: "AYUDA", name: "lista.valor_campo_1", orderable: true },
          { label: "CANTIDAD", name: "cantidad_entregada", orderable: true },
          { label: "FECHA ENTREGA", name: "fecha_entrega", orderable: true },
          { label: "USUARIO CREACIÓN", name: "usuario_creacion.name", orderable: true },
          { label: "USUARIO ACTUALZIACIÓN", name: "usuario_actualizacion.name", orderable: true },
        ],
      },
    };
  },
  watch: {
    estado(value) {
      this.$refs.ListaAyudas.getData();
    },
  },
  methods: {
    getRowData(data) {
      this.$emit("handleButtonModal", data);
    },
  },
  mounted() {
    vito.index();
  },
};
</script>
