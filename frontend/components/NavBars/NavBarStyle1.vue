<template>
  <!-- TOP Nav Bar -->
  <div class="iq-top-navbar">
    <div class="iq-navbar-custom" :class="horizontal ? 'd-flex align-items-center justify-content-between' : ''">
      <div class="iq-sidebar-logo">
        <div class="top-logo">
          <nuxt-link :to="homeURL">
            <img :src="logo" class="img-fluid" alt="logo" />
            <span>SCAPV</span>
          </nuxt-link>
        </div>
      </div>
      <div class="iq-menu-horizontal" v-if="horizontal">
        <div class="iq-sidebar-menu">
          <ListStyle1 :items="items" class="d-flex" />
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light p-0">
        <div class="navbar-left col-6">
          <ul id="topbar-data-icon" class="d-flex p-0 topbar-menu-icon">
            <li v-for="(item, index) in bookmark" :key="index">
              <nuxt-link :to="item.link" class="nav-link" style="color: var(--iq-primary);">
                <i :class="`${item.icon}`"></i>
              </nuxt-link>
            </li>
          </ul>
          <div class="iq-search-bar">
            <vue-bootstrap-typeahead
              backgroundVariant="white"
              textVariant="dark"
              v-model="numero_documento"
              :data="ciudadanos"
              :placeholder="$t('nav.globalSearchPlaceholder')"
            >
              <template slot="append">
                <b-button class="text-primary" variant="light" @click="consultarCiudadano(numero_documento)">
                  <i class="fa fa-search"></i>
                </b-button>
              </template>
              <template slot="suggestion" slot-scope="{ htmlText }">
                <div class="d-flex align-items-center">
                  <span v-html="htmlText"></span>
                </div>
              </template>
            </vue-bootstrap-typeahead>
          </div>
        </div>
        <b-navbar-toggle target="nav-collapse">
          <i class="ri-menu-3-line"></i>
        </b-navbar-toggle>
        <div class="iq-menu-bt align-self-center">
          <div class="wrapper-menu" @click="miniSidebar">
            <div class="main-circle">
              <i class="ri-arrow-left-s-line"></i>
            </div>
            <div class="hover-circle">
              <i class="ri-arrow-right-s-line"></i>
            </div>
          </div>
        </div>
        <b-collapse id="nav-collapse" is-nav>
          <slot name="responsiveRight" />
        </b-collapse>
        <slot name="right" />
      </nav>
    </div>
  </div>
  <!-- TOP Nav Bar END -->
</template>
<script>
import { mapState, mapGetters } from "vuex";
import VueBootstrapTypeahead from "vue-bootstrap-typeahead";
import Swal from "sweetalert2";
import verticalMenu from "~/plugins/FackApi/json/VerticalMenu";

export default {
  name: "NavBarStyle1",
  props: {
    homeURL: {
      type: Object,
      default: () => ({ path: "/" }),
    },
    title: { type: String, default: "Dashboard" },
    logo: {
      type: String,
      default: require("~/assets/images/logo.png"),
    },
    horizontal: { type: Boolean, default: false },
    items: { type: Array },
  },
  components: {
    VueBootstrapTypeahead,
  },
  data: () => ({
    sidebar: verticalMenu,
    numero_documento: "",
    ciudadanos: [],
  }),
  computed: {
    ...mapState("Familias", ["ciudadano"]),
    ...mapGetters({
      bookmark: "Setting/bookmarkState",
    }),
  },
  methods: {
    miniSidebar() {
      this.$emit("toggle");
    },
    consultarCiudadano(numero_documento) {
      this.$store.dispatch("Familias/consultarCiudadano", numero_documento).then(() => {
        if (this.ciudadano != "no existe") {
          this.$router.push("/familias/perfil");
          this.numero_documento = "";
          this.$children[6].inputValue = "";
        } else {
          Swal.fire({
            html: "<h5>Esta persona no se encuentra registrada</h5>",
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
        }
      });
    },
  },
  async mounted() {
    let res = await this.$axios.get("/api/ciudadanos/");
    let data = res.data.data;
    let ciudadanos = data.map((ciudadano) => ciudadano.numero_documento);
    this.ciudadanos = ciudadanos;
  },
};
</script>
