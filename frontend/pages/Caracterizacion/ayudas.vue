<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Ayudas</h4>
            <ModalCrear @refrescar="refrescar" />
            <b-modal
              ref="modalEditar"
              v-model="show"
              size="xl"
              title="Modulo Editar Ayuda"
              ok-title="Save Changes"
              cancel-title="Cerrar"
            >
              <ModalEditar :idEditar="idEditar" @refrescar="refrescar" />
              <template v-slot:modal-footer>
                <div class="w-100">
                  <p class="float-left">Editar Ayudas</p>
                  <b-button variant="primary" size="sm" class="float-right" @click="LimpiarDatos">
                    Cerrar
                  </b-button>
                </div>
              </template>
            </b-modal>
          </template>
          <template v-slot:headerAction>
            <a class="text-primary float-right" v-b-toggle.collapse-1 role="button">
              <i class="ri-code-s-slash-line" />
            </a>
          </template>
          <template v-slot:body>
            <data-table
              ref="ayudas"
              :classes="table.classes"
              :translate="table.translate"
              :columns="table.columns"
              :url="table.url"
            >
              <div slot="filters" slot-scope="{ tableData }">
                <div class="row justify-content-end mb-2">
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
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  layout: "LightLayout",
  data() {
    return {
      show: false,
      editar: false,
      idEditar: "",
      table: {
        url: `${process.env.API_URL}/api/ayudas/`,
        tableProps: { dir: "desc" },
        classes: {
          "table-container": { "table-responsive": true },
          table: { table: true, "table-hover": true, "table-bordered": true, "text-center": true },
          "t-head": { "table-header-iq-primary": true },
          th: {
            "align-middle": true,
          },
        },
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
            component: () => import("~/components/Caracterizacion/Tablas.vue"),
          },
          { label: "AYUDA", name: "lista.valor_campo_1", orderable: true },
          { label: "DOCUMENTO CIUDADANO", name: "ciudadano.numero_documento", orderable: true },
          { label: "NOMBRE CIUDADANO", name: "ciudadano.nombres", orderable: true },
          { label: "APELLIDO CIUDADANO", name: "ciudadano.apellidos", orderable: true },
          { label: "CANTIDAD ENTREGADA", name: "cantidad_entregada", orderable: true },
          { label: "FECHA ENTREGA", name: "fecha_entrega", orderable: true },
        ],
      },
    };
  },
  methods: {
    refrescar(value) {
      this.$refs["modalEditar"].hide();
      this.$refs.ayudas.getData();
    },
    LimpiarDatos() {
      this.$refs["modalEditar"].hide();
    },
    displayRow(data) {
      this.$refs["modalEditar"].show();
      console.log(data);
      this.idEditar = data;
      // let ruta = `/perfil/${data.id}`;
      // this.$router.push(ruta);
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
