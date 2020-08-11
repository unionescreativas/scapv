<template>
  <b-container fluid>
    <b-row>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>{{ $t("dashboard1.card1") }}</h6>
              <span class="iq-icon"><i class="ri-information-fill"></i></span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-primary mr-2"><i class="ri-inbox-fill"></i></div>
                <h2>352</h2>
              </div>
              <div class="iq-map text-primary font-size-32"><i class="ri-bar-chart-grouped-line"></i></div>
            </div>
          </template>
        </iq-card>
      </b-col>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>{{ $t("dashboard1.card2") }}</h6>
              <span class="iq-icon"><i class="ri-information-fill"></i></span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-danger mr-2"><i class="ri-radar-line"></i></div>
                <h2>$37k</h2>
              </div>
              <div class="iq-map text-danger font-size-32"><i class="ri-bar-chart-grouped-line"></i></div>
            </div>
          </template>
        </iq-card>
      </b-col>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>{{ $t("dashboard1.card3") }}</h6>
              <span class="iq-icon"><i class="ri-information-fill"></i></span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-warning mr-2"><i class="ri-price-tag-3-line"></i></div>
                <h2>32%</h2>
              </div>
              <div class="iq-map text-warning font-size-32"><i class="ri-bar-chart-grouped-line"></i></div>
            </div>
          </template>
        </iq-card>
      </b-col>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6>{{ $t("dashboard1.card4") }}</h6>
              <span class="iq-icon"><i class="ri-information-fill"></i></span>
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-info mr-2"><i class="ri-refund-line"></i></div>
                <h2>27h</h2>
              </div>
              <div class="iq-map text-info font-size-32"><i class="ri-bar-chart-grouped-line"></i></div>
            </div>
          </template>
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  name: "Estadisticas",
  layout: "LightLayout",
  mounted() {
    vito.index();
  },
  data: () => ({}),
};
</script>

<style>
.iq-card-body {
  flex: unset;
}
</style>
