<template>
  <b-container fluid>
    <b-row>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>Ciudadanos</h6>
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
              <h6>Familias</h6>
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
              <h6>Pendiente a Ayudas</h6>
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
              <h6>Total Ayudas</h6>
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

      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>Total Núcleo</h6>
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
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
import { mapState, mapActions } from "vuex";

export default {
  name: "Estadisticas",
  layout: "LightLayout",
  data: () => ({
    estadisticas: {}
  }),
  methods: {
    // ...mapActions("Estadisticas", ["consultarEstadisticas"]),
  },
  computed: {
    // ...mapState("Estadisticas", ["estadisticas"]),
  },
  mounted() {
    vito.index();
    // this.consultarEstadisticas();
    this.$axios.get("/api/datosgenerales").then((response) => {
      this.estadisticas = response.data.data;
    });
  },
};
</script>

<style>
.iq-card-body {
  flex: unset;
}
</style>
