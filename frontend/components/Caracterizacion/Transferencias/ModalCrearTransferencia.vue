<template>
  <div>
    <b-button @click="showModal" variant="primary"> <i class="fas fa-plus-circle"></i> Cargar Transferencia</b-button>
    <b-modal
      ref="modalCrearTransferncia"
      size="xl"
      title="Modulo Crear Transferencia"
      ok-title="Save Changes"
      cancel-title="Cerrar"
    >
      <form-wizard
        v-if="wizard"
        ref="formWizard"
        title="Por favor Completar todos los Campos"
        subtitle
        back-button-text="Atrás"
        next-button-text="Siguiente"
        finish-button-text=""
        color="#083696"
        @on-complete="onComplete"
      >
        <tab-content title="Cabeza de Familia" icon="fa fa-search">
          <b-row>
            <b-col>
              <b-form-group label="Documento de Identificación Cabeza de Familia" label-for="exampleInputNumber1">
                <b-form-input v-model="numeroDocumentoC" type="text" value="1"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group label="Consultar" label-for="exampleInputNumber1">
                <b-button @click="consultarCiudadanoC" variant="success" class="mb-3 mr-1"
                  ><i class="ri-search-fill"></i
                ></b-button>
              </b-form-group>
            </b-col>
          </b-row>
          <div v-if="consultaC">
            <TablaCabezaTransferencia :ciudadanoC="ciudadanoC" />
            <TablaNucleoAyuda :ciudadano="ciudadanoC" estado="true" />
          </div>
        </tab-content>
        <tab-content title="Integrante de Familia" icon="fa fa-group">
          <b-row>
            <b-col>
              <b-form-group label="Documento de Identificación Integrante De Familia" label-for="exampleInputNumber1">
                <b-form-input v-model="numeroDocumentoF" type="text" value="1"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group label="Consultar" label-for="exampleInputNumber1">
                <b-button @click="consultarCiudadanoF" variant="danger" class="mb-3 mr-1"
                  ><i class="ri-search-fill"></i
                ></b-button>
              </b-form-group>
            </b-col>
          </b-row>
          <div v-if="consultaF">
            <TablaCabezaTransferencia :ciudadanoC="ciudadanoF" />
            <TablaNucleoAyuda :ciudadano="ciudadanoF" estado="true" />
          </div>
        </tab-content>
        <tab-content title="Verificar Datos" icon="fa fa-check">
          <h4 v-text="validacion"></h4>
          <b-row>
            <b-col>
              <b-form-group label="Parentesco" label-for="exampleInputNumber1">
                <b-form-select plain v-model="parentesco" :options="consultaListas" size="lg">
                  <template v-slot:first>
                    <b-form-select-option :value="null">SELECCIONAR REGISTRO</b-form-select-option>
                  </template>
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group label="Consultar" label-for="exampleInputNumber1">
                <b-button @click="guardarTransferencia" variant="primary" class="mb-3 mr-1"
                  ><i class="fas fa-expand-arrows-alt"></i> Confirmar Transferencia</b-button
                >
              </b-form-group>
            </b-col>
          </b-row>
        </tab-content>
      </form-wizard>
      <template v-slot:modal-footer>
        <div class="w-100">
          <p class="float-left">Editar Transferencia</p>
          <b-button variant="primary" size="sm" class="float-right" @click="LimpiarDatos">
            Cerrar
          </b-button>
        </div>
      </template>
    </b-modal>
  </div>
</template>

<script>
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import Swal from "sweetalert2";
export default {
  data() {
    return {
      consultaListas: [],
      arrayCiudadanoC: [],
      numeroDocumentoC: "",
      ciudadanoC: "",
      consultaC: false,
      arrayCiudadanoF: [],
      numeroDocumentoF: "",
      ciudadanoF: "",
      consultaF: false,
      validacion: "",
      parentesco: "",
      wizard: false,
    };
  },
  components: { FormWizard, TabContent },
  methods: {
    async consultarListaAyudas() {
      let listas = {};
      let consulta;
      let res = await this.$axios.get(`/api/listas/parentescos`);
      consulta = res.data.data;
      consulta.forEach((item, index) => {
        listas = {
          value: consulta[index].codigo_campo,
          text: consulta[index].valor_campo_1.toUpperCase(),
        };
        this.consultaListas.push(listas);
        // formData.append("file[" + index + "]", item.file);
      });
      console.log(res);
    },
    showModal() {
      this.wizard = false;
      this.LimpiarDatos();
      this.$refs["modalCrearTransferncia"].show();
      this.wizard = true;
    },
    onComplete: function () {
      this.LimpiarDatos();
      // alert("Yay. Done!");
    },
    async consultarCiudadanoC() {
      try {
        this.consultaC = false;
        let res = await this.$axios.get(`/api/ciudadanos/${this.numeroDocumentoC}`);
        if (res.data.data != "no existe") {
          console.log(res.data.data);
          this.arrayCiudadanoC = res.data.data[0];
          this.ciudadanoC = res.data.data[0].id;
          this.consultaC = true;
        } else {
          Swal.fire({
            html: `<h4>No existen Ciudadanos CON ESTOS DATOS!</h4>`,
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
          this.consultaC = false;
        }
      } catch (error) {
        console.error(error);
      }
    },
    async consultarCiudadanoF() {
      try {
        this.consultaF = false;
        let res = await this.$axios.get(`/api/ciudadanos/${this.numeroDocumentoF}`);
        if (res.data.data != "no existe") {
          console.log(res.data.data);
          this.arrayCiudadanoF = res.data.data[0];
          this.ciudadanoF = res.data.data[0].id;
          this.consultaF = true;
        } else {
          Swal.fire({
            html: `<h4>No existen Ciudadanos CON ESTOS DATOS!</h4>`,
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
          this.consultaF = false;
        }
      } catch (error) {
        console.error(error);
      }
      this.validacion = `Estas moviendo el nucleo de familia :
      ${this.arrayCiudadanoF.nombres} ${this.arrayCiudadanoF.apellidos} Documento : ${this.arrayCiudadanoF.numero_documento}
      , al grupo de familia de : ${this.arrayCiudadanoC.nombres} ${this.arrayCiudadanoC.apellidos} Documento : ${this.arrayCiudadanoC.numero_documento}`;
    },
    async guardarTransferencia() {
      try {
        if (this.parentesco == "") {
          Swal.fire({
            html: `<h4>Debe Ingresar el Parentesco!</h4>`,
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
        } else {
          let res = await this.$axios
            .post(`/api/transferencias`, {
              ciudadano_id: this.ciudadanoC,
              familia_id: this.ciudadanoF,
              parentesco: this.parentesco,
            })
            .then(function (response) {
              console.log(response);
              if (response.data.data == "sin stock") {
                Swal.fire({
                  html: `<h4>Error!</h4>`,
                  icon: "warning",
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                });
              } else {
                Swal.fire({
                  html: `<h4>El registro ha sido Creado con éxito!</h4>`,
                  icon: "success",
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                });
              }
            })
            .catch(function (error) {
              console.log(error);
            });
          this.LimpiarDatos();
        }
        this.$emit("refrescar", true);
      } catch (err) {}
    },
    LimpiarDatos() {
      this.arrayCiudadanoC = [];
      this.numeroDocumentoC = "";
      this.ciudadanoC = "";
      this.consultaC = false;
      this.arrayCiudadanoF = [];
      this.numeroDocumentoF = "";
      this.ciudadanoF = "";
      this.consultaF = false;
      this.validacion = "";
      this.parentesco = "";
      this.$refs["modalCrearTransferncia"].hide();
    },
  },
  mounted() {
    this.consultarListaAyudas();
  },
};
</script>

<style lang="scss" scoped></style>
