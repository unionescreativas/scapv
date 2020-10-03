<template>
  <b-row>
    <b-col sm="12">
      <iq-card>
        <template v-slot:body>
          <data-table
            ref="dataTable"
            :classes="table.classes"
            :translate="table.translate"
            :columns="table.columns"
            :url="table.url"
          >
            <div slot="filters" slot-scope="{ tableData }">
              <div class="row justify-content-between mb-4">
                <div class="col-md-3">
                  <b-button variant="secondary" @click="agregarLista()">
                    <i class="fa fa-user-plus"></i>
                    <span>Agregar Lista</span>
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
        </template>
      </iq-card>
    </b-col>
  </b-row>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      table: {
        url: `${process.env.API_URL}/api/listas`,
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
            component: () => import("./BtnEditarLista.vue"),
          },
          {
            label: "INACTIVAR",
            orderable: false,
            event: "click",
            handler: this.inactivarLista,
            component: () => import("./BtnInactivarLista.vue"),
          },

          { label: "NOMBRE LISTA", name: "nombre_lista", orderable: true },
          { label: "CÓDIGO CAMPO", name: "codigo_campo", orderable: true },
          { label: "VALOR CAMPO 1", name: "valor_campo_1", orderable: true },
          { label: "VALOR CAMPO 2", name: "valor_campo_2", orderable: true },
          { label: "VALOR CAMPO 3", name: "valor_campo_3", orderable: true },
          { label: "VALOR CAMPO 4", name: "valor_campo_4", orderable: true },
        ],
      },
    };
  },
  methods: {
    agregarLista() {
      this.$emit("getRowData", null);
      this.$emit("modalShow", true);
    },
    getRowData(data) {
      this.$emit("getRowData", data);
      this.$emit("modalShow", true);
    },
    inactivarLista(data) {
      Swal.fire({
        html: "<h4>Está seguro(a) que desea inactivar el registro?</h4>",
        icon: "warning",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Si",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
      }).then((result) => {
        if (result.value) {
          this.$store.dispatch("Listas/inactivarLista", { ...this, id_lista: data.id });
        }
      });
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
