<template>
  <div>
    <b-button @click="showModal" variant="primary">Cargar Ayuda</b-button>
    <b-modal
      ref="modalCrear"
      v-model="show"
      size="xl"
      title="Modulo Crear Ayuda"
      ok-title="Save Changes"
      cancel-title="Cerrar"
    >
      <p>Por favor Ingresar Numero de Documento</p>
      <b-form>
        <b-row>
          <b-col>
            <b-form-group label="Ayuda" label-for="exampleInputNumber1">
              <b-form-select plain v-model="ayuda" :options="consultaListas" size="lg">
                <template v-slot:first>
                  <b-form-select-option :value="null">SELECCIONAR REGISTRO</b-form-select-option>
                </template>
              </b-form-select>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label="Documento de Identificación" label-for="exampleInputNumber1">
              <b-form-input v-model="numeroDocumento" type="text" value="1"></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row v-if="consulta">
          <b-col>
            <b-form-group label="Cabeza de Familia" label-for="exampleInputNumber1">
              <b-form-input v-model="nombre" type="text"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label="Fecha Expedición" label-for="exampleInputNumber1">
              <b-form-input v-model="fecha_expedicion" type="text"> </b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col>
            <b-form-group label="Cantidad" label-for="exampleInputNumber1">
              <b-form-input v-model="cantidad" type="number" value="1"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label="Consultar" label-for="exampleInputNumber1">
              <b-button @click="consultarCiudadano" variant="success" class="mb-3 mr-1"
                ><i class="ri-search-fill"></i
              ></b-button>
            </b-form-group>
          </b-col>
        </b-row>
      </b-form>
      <b-row v-if="validarCargarAyuda">
        <b-col>
          <b-form>
            <b-form-group label="Fecha Entrega" label-for="exampleInputNumber1">
              <b-form-input v-model="fecha_entrega" type="date"></b-form-input>
            </b-form-group>
          </b-form>
        </b-col>
        <b-col>
          <b-form-group label="Guardar" label-for="exampleInputNumber1">
            <b-button @click="GuardarDatos" variant="info" class="mb-3 mr-1"
              ><i class="ri-save-fill"></i>Guardar Datos</b-button
            >
          </b-form-group>
        </b-col>
      </b-row>
      <h4 v-text="unidades"></h4>
      <div v-show="consulta">
        <documentos :modulo="modulo" :moduloid="modulo_id" subida_automatica></documentos>
      </div>
      <div v-if="consulta">
        <TablaCrearAyuda :ciudadano="ciudadano" :estado="actualizarRegistro" />
        <TablaNucleoAyuda :ciudadano="ciudadano" :estado="actualizarRegistro" />
      </div>
      <template v-slot:modal-footer>
        <div class="w-100">
          <p class="float-left">Crear Ayudas</p>
          <b-button variant="primary" size="sm" class="float-right" @click="LimpiarDatos">
            Cerrar
          </b-button>
        </div>
      </template>
    </b-modal>
  </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
  data() {
    return {
      show: false,
      validacionCiudadano: false,
      actualizarRegistro: false,
      modulo_id: "",
      modulo: "ayudas",
      unidades: "",
      consulta: false,
      ciudadano: "",
      numeroDocumento: "",
      cantidad: 1,
      fecha_entrega: "",
      ayuda: "",
      consultaListas: [],
      validarCargarAyuda: false,
      fecha_expedicion: "",
      nombre: "",
    };
  },
  mounted() {
    this.consultarListaAyudas();
  },
  methods: {
    async consultarListaAyudas() {
      let listas = {};
      let consulta;
      let res = await this.$axios.get(`/api/listas/ayudas`);
      consulta = res.data.data;
      consulta.forEach((item, index) => {
        listas = {
          value: consulta[index].id,
          text: consulta[index].valor_campo_1.toUpperCase(),
        };
        this.consultaListas.push(listas);
        // formData.append("file[" + index + "]", item.file);
      });
    },
    async consultarCiudadano() {
      try {
        this.consulta = false;
        this.validarCargarAyuda = false;
        let res = await this.$axios.get(`/api/ciudadanos/${this.numeroDocumento}`);
        if (res.data.data != "no existe") {
          this.ciudadano = res.data.data[0].id;
          this.modulo_id = res.data.data[0].id;
          this.fecha_expedicion = res.data.data[0].fecha_expedicion;
          this.nombre = res.data.data[0].nombres + " " + res.data.data[0].apellidos;
          this.consulta = true;
          this.validacionCiudadano = true;
        } else {
          res = await this.$axios.get(`/api/familias/${this.numeroDocumento}`);
          if (res.data.data != "no existe") {
            this.validacionCiudadano = true;
            res = await this.$axios.get(`/api/ciudadanos/${res.data.data[0].ciudadano_id}`);
            this.ciudadano = res.data.data[0].id;
            this.modulo_id = res.data.data[0].id;
            this.fecha_expedicion = res.data.data[0].fecha_expedicion;
            this.nombre = res.data.data[0].nombres;
            this.consulta = true;
            Swal.fire({
              html: `<h4>El Ciudadano es Integrante de Familia del Nucleo Familiar de: ${this.nombre}!</h4>`,
              icon: "warning",
              allowOutsideClick: false,
              allowEscapeKey: false,
            });
          } else {
            this.LimpiarDatos();
            Swal.fire({
              html: `<h4>No existen Ciudadanos CON ESTOS DATOS!</h4>`,
              icon: "warning",
              allowOutsideClick: false,
              allowEscapeKey: false,
            });
          }
        }
      } catch (error) {
        console.error(error);
      }
      if (this.validacionCiudadano) {
        this.ConsultarDisponibles();
      }
    },
    async GuardarDatos() {
      this.validarCargarAyuda = false;
      await this.ConsultarDisponibles();
      try {
        if (this.validarCargarAyuda) {
          if (this.fecha_entrega == "") {
            Swal.fire({
              html: `<h4>Debe Ingresar la Fecha de Entrega!</h4>`,
              icon: "warning",
              allowOutsideClick: false,
              allowEscapeKey: false,
            });
          } else {
            let res = await this.$axios
              .post(`/api/ayudas`, {
                lista_id: this.ayuda,
                ciudadano_id: this.modulo_id,
                cantidad_entregada: this.cantidad,
                fecha_entrega: this.fecha_entrega,
              })
              .then(function (response) {
                console.log(response);
                Swal.fire({
                  html: `<h4>El registro ha sido Creado con éxito!</h4>`,
                  icon: "success",
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                });
              })
              .catch(function (error) {
                console.log(error);
              });
            this.actualizarRegistro = true;
            this.LimpiarDatos();
          }
        }
      } catch (error) {
        console.error(error);
      }
    },
    async ConsultarDisponibles() {
      let consultaAyudas;
      if (this.validacionCiudadano) {
        consultaAyudas = await this.$axios.post(`/api/consultandounidades`, {
          lista_id: this.ayuda,
          ciudadano_id: this.modulo_id,
          cantidad_entregada: this.cantidad,
          fecha_entrega: this.fecha_entrega,
        });
        if (consultaAyudas.data.validacion) {
          this.validarCargarAyuda = true;
        } else {
          Swal.fire({
            html: `<h4>Ya existe un registro de ayudas para este Nucleo Familiar el día : ${consultaAyudas.data.data.fecha_entrega} !</h4>`,
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
        }
        console.log(consultaAyudas);
        this.unidades = consultaAyudas.data.unidades;
      }
    },
    showModal() {
      this.$refs["modalCrear"].show();
      this.LimpiarDatos();
    },
    LimpiarDatos() {
      this.show = false;
      this.modulo_id = "";
      this.modulo = "ayudas";
      this.unidades = "";
      this.consulta = false;
      this.ciudadano = "";
      this.numeroDocumento = "";
      this.cantidad = 1;
      this.fecha_entrega = "";
      this.ayuda = "";
      this.validarCargarAyuda = false;
      this.fecha_expedicion = "";
      this.nombre = "";
      this.validacionCiudadano = false;
    },
  },
};
</script>

<style lang="scss" scoped></style>
