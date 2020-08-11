<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12" lg="12">
        <div class="iq-card pb-4">
          <div class="iq-card-header">
            <div class="iq-header-title mt-3">
              <h4 class="card-title">CARACTERIZACIÓN POBLACIÓN MIGRANTES</h4>
            </div>
          </div>
          <div class="iq-search-bar">
            <b-row>
              <b-col sm="8" lg="8">
                <vue-bootstrap-typeahead
                  backgroundVariant="white"
                  textVariant="dark"
                  v-model="numero_documento"
                  :data="data"
                  placeholder="Por favor ingrese su número de documento"
                  prepend="Número de documento: *"
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
              </b-col>
            </b-row>
          </div>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapState } from "vuex";
import VueBootstrapTypeahead from "vue-bootstrap-typeahead";
import Swal from "sweetalert2";

export default {
  components: {
    VueBootstrapTypeahead,
  },
  data: () => ({
    numero_documento: "",
    data: ["1107516836", "1151959229", "1135678956", "1135785905", "1167596907"],
  }),
  computed: {
    ...mapState("Familias", ["ciudadano"]),
  },
  methods: {
    limpiarDatos() {
      this.numero_documento = "";
      // SE ACCEDE AL COMPONENTE: VueBootstrapTypeahead
      // Y SE REINICIA EL VALOR DEL INPUT SEARCH
      this.$children[0].inputValue = "";
      this.$emit("mostrarFormFamilias", false);
    },
    consultarCiudadano(numero_documento) {
      this.$store.dispatch("Familias/consultarCiudadano", numero_documento).then(() => {
        if (this.ciudadano != "no existe") {
          Swal.fire({
            title: "Registrado!",
            text: "Ya te encuentras registrado, se cargarán tus datos personales",
            icon: "info",
            allowOutsideClick: false,
            allowEscapeKey: false,
          }).then((result) => {
            if (result.value) {
              this.$emit("mostrarFormFamilias", true);
            }
          });
        } else {
          this.$emit("mostrarFormFamilias", true);
        }
      });
      this.$emit("mostrarFormFamilias", false);
    },
  },
};
</script>
