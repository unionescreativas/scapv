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
                  ref="VueBootstrapTypeahead"
                  backgroundVariant="white"
                  textVariant="dark"
                  v-model="numero_documento"
                  :data="ciudadanos"
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
import { mapState, mapActions, mapGetters } from "vuex";
import VueBootstrapTypeahead from "vue-bootstrap-typeahead";
import Swal from "sweetalert2";

export default {
  components: {
    VueBootstrapTypeahead,
  },
  data: () => ({
    numero_documento: "",
  }),
  computed: {
    ...mapGetters({
      ciudadano: "Familias/ciudadano",
      ciudadanos: "Familias/documentosCiudadanos",
    }),
  },
  methods: {
    ...mapActions("Familias", ["consultarCiudadanos"]),
    consultarCiudadano(numero_documento) {
      this.$emit("numero_documento", null);
      if (numero_documento) {
        this.$store.dispatch("Familias/consultarCiudadano", numero_documento).then(() => {
          if (Object.values(this.ciudadano).length) {
            Swal.fire({
              title: "Registrado!",
              text: "Ya te encuentras registrado, deseas editar tus datos personales?",
              icon: "info",
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Si",
              cancelButtonColor: "#d33",
              cancelButtonText: "No",
              showCancelButton: true,
              allowOutsideClick: false,
              allowEscapeKey: false,
            }).then((result) => {
              if (result.value) {
                this.$emit("numero_documento", numero_documento);
              }
            });
          } else {
            this.$emit("numero_documento", numero_documento);
          }
        });
      }
    },
  },
  created() {
    this.consultarCiudadanos();
  },
};
</script>
