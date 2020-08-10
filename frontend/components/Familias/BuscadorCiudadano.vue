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
            <b-form autocomplete="off" ref="form">
              <b-row>
                <b-col sm="8" lg="8">
                  <vue-bootstrap-typeahead
                    backgroundVariant="white"
                    textVariant="dark"
                    v-model="form.numero_documento"
                    :data="data"
                    placeholder="Por favor ingrese su número de documento"
                    prepend="Número de documento: *"
                  >
                    <template slot="append">
                      <b-button class="text-primary" variant="light" @click="consultarCiudadano(form)">
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

              <b-row class="mt-3" v-if="mostrarFechaExpedicion">
                <b-col sm="8" lg="8">
                  <b-form-group label="FECHA DE EXPEDICION DEL DOCUMENTO: *" label-for="fecha_expedicion">
                    <b-form-input type="date" id="fecha_expedicion" v-model="form.fecha_expedicion" />
                  </b-form-group>

                  <b-button @click="actualizarDatos()">
                    <i class="fa fa-sync"></i>
                    <span>Actualizar Datos</span>
                  </b-button>

                  <b-button class="text-primary" variant="light" @click="limpiarDatos()">
                    <i class="fa fa-trash"></i>
                    <span>Limpiar Datos</span>
                  </b-button>
                </b-col>
              </b-row>
            </b-form>
          </div>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapState, mapActions } from "vuex";
import VueBootstrapTypeahead from "vue-bootstrap-typeahead";
import Swal from "sweetalert2";

export default {
  components: {
    VueBootstrapTypeahead,
  },
  data: () => ({
    form: {
      numero_documento: "",
      fecha_expedicion: "",
    },
    mostrarFechaExpedicion: false,
    data: ["1107516836", "1151959229", "1135678956", "1135785905", "1167596907"],
  }),
  watch: {
    ciudadano(value) {
      this.mostrarFechaExpedicion = false;
      this.$emit("mostrarFormFamilias", false);

      if (value) {
        Swal.fire({
          title: "Registrado!",
          text: "Ya te encuentras registrado, para actualizar tus datos personales, debes ingresar tu fecha de expedición",
          icon: "info",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });

        this.mostrarFechaExpedicion = true;
      } else {
        this.$emit("mostrarFormFamilias", true);
      }
    },
  },
  computed: {
    ...mapState("Familias", ["ciudadano"]),
  },
  methods: {
    limpiarDatos() {
      this.form.numero_documento = "";
      this.form.fecha_expedicion = "";
      this.$refs.form.reset();
      // SE ACCEDE AL COMPONENTE: VueBootstrapTypeahead
      // Y SE REINICIA EL VALOR DEL INPUT SEARCH
      this.$children[0].inputValue = "";
      this.mostrarFechaExpedicion = false;
      this.$emit("mostrarFormFamilias", false);
    },
    actualizarDatos() {
      let mostrarFormFamilias = false;

      if (this.form.fecha_expedicion) {
        if (this.form.fecha_expedicion == this.ciudadano.fecha_expedicion) {
          mostrarFormFamilias = true;
        } else {
          Swal.fire({
            html: "<h5>La fecha de expedición no corresponde con el número de documento digitado</h5>",
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
        }
      } else {
        Swal.fire({
          html: "<h5>Debe ingresar la fecha de expedición</h5>",
          icon: "warning",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      }

      this.$emit("mostrarFormFamilias", mostrarFormFamilias);
    },
    ...mapActions("Familias", ["consultarCiudadano"]),
  },
};
</script>
