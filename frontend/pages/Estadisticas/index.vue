<template>
  <b-container fluid>
    <b-row>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>Total Núcleo Familiar</h6>
              <span class="iq-icon">
                <i class="ri-information-fill"></i>
              </span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-info mr-2">
                  <i class="ri-refund-line"></i>
                </div>
                <h2>{{ estadisticas.total_nucleo }}</h2>
              </div>
              <div class="iq-map text-info font-size-32">
                <i class="ri-bar-chart-grouped-line"></i>
              </div>
            </div>
          </template>
        </iq-card>
      </b-col>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>Cabezas de Familia</h6>
              <span class="iq-icon">
                <i class="ri-information-fill"></i>
              </span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-primary mr-2">
                  <i class="ri-inbox-fill"></i>
                </div>
                <h2>{{ estadisticas.ciudadanos }}</h2>
              </div>
              <div class="iq-map text-primary font-size-32">
                <i class="ri-bar-chart-grouped-line"></i>
              </div>
            </div>
          </template>
        </iq-card>
      </b-col>

      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>Integrantes de Familias</h6>
              <span class="iq-icon">
                <i class="ri-information-fill"></i>
              </span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-danger mr-2">
                  <i class="ri-radar-line"></i>
                </div>
                <h2>{{ estadisticas.familias }}</h2>
              </div>
              <div class="iq-map text-danger font-size-32">
                <i class="ri-bar-chart-grouped-line"></i>
              </div>
            </div>
          </template>
        </iq-card>
      </b-col>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>Pendiente Ayudas Por Cabeza De Familia</h6>
              <span class="iq-icon">
                <i class="ri-information-fill"></i>
              </span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-warning mr-2">
                  <i class="ri-price-tag-3-line"></i>
                </div>
                <h2>{{ estadisticas.pendiente_ayudas_cabeza }}</h2>
              </div>
              <div class="iq-map text-warning font-size-32">
                <i class="ri-bar-chart-grouped-line"></i>
              </div>
            </div>
          </template>
        </iq-card>
      </b-col>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>Pendiente Ayudas Por Nucleo</h6>
              <span class="iq-icon">
                <i class="ri-information-fill"></i>
              </span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-warning mr-2">
                  <i class="ri-price-tag-3-line"></i>
                </div>
                <h2>{{ estadisticas.pendiente_ayudas }}</h2>
              </div>
              <div class="iq-map text-warning font-size-32">
                <i class="ri-bar-chart-grouped-line"></i>
              </div>
            </div>
          </template>
        </iq-card>
      </b-col>

      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>Total Ayudas Entregas Por Nucleo Familiar</h6>
              <span class="iq-icon">
                <i class="ri-information-fill"></i>
              </span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-info mr-2">
                  <i class="ri-refund-line"></i>
                </div>
                <h2>{{ estadisticas.total_ayudas }}</h2>
              </div>
              <div class="iq-map text-info font-size-32">
                <i class="ri-bar-chart-grouped-line"></i>
              </div>
            </div>
          </template>
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
import { mapState, mapActions } from "vuex";

export default {
  layout: "LightLayout",
  head: () => ({
    title: "Estadísticas",
  }),
  computed: {
    ...mapState("Estadisticas", ["estadisticas"]),
  },
  methods: {
    ...mapActions("Estadisticas", ["consultarEstadisticas"]),
  },
  created() {
    this.consultarEstadisticas();
  },
  mounted() {
    vito.index();
  },
};
</script>

<router>
  {
    meta: {
      name: "Estadísticas"
    }
  }
</router>

<style>
.iq-card-body {
  flex: unset;
}
</style>
