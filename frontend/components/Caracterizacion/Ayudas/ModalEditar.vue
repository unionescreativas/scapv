<template>
  <div>
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
        <b-col> </b-col>
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
        <b-form-group label="Actualizar" label-for="exampleInputNumber1">
          <b-button @click="ActualizarDatos" variant="info" class="mb-3 mr-1"
            ><i class="ri-save-fill"></i>Actualizar Datos</b-button
          >
        </b-form-group>
      </b-col>
    </b-row>
    <h4 v-text="unidades"></h4>
    <documentos :modulo="modulo" :moduloid="modulo_id"></documentos>
    <div v-if="consulta">
      <TablaCrearAyuda :ciudadano="ciudadano" :estado="actualizarRegistro" />
      <TablaNucleoAyuda :ciudadano="ciudadano" :estado="actualizarRegistro" />
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
  props: ["idEditar"],
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
      cantidad: 0,
      fecha_entrega: "",
      ayuda: "",
      consultaListas: [],
      validarCargarAyuda: false,
      fecha_expedicion: "",
      nombre: "",
    };
  },
  mounted() {
    this.consultarRegistroEditar();
    this.consultarListaAyudas();
    // console.log("idEditar" + this.idEditar.id);
  },
  methods: {
    async consultarRegistroEditar() {
      try {
        let consulta;
        let consultaCiudadano;
        this.modulo_id = this.idEditar.ciudadano_id;
        this.ciudadano = this.idEditar.ciudadano_id;
        this.ayuda = this.idEditar.lista_id;
        this.cantidad = this.idEditar.cantidad_entregada;
        this.fecha_entrega = this.idEditar.fecha_entrega;
        let ciudadano = await this.$axios.get(`/api/ciudadanos/${this.idEditar.ciudadano_id}`);
        consultaCiudadano = ciudadano.data.data[0];
        this.fecha_expedicion = consultaCiudadano.fecha_expedicion;
        this.nombre = consultaCiudadano.nombres + " " + consultaCiudadano.apellidos;
        this.numeroDocumento = consultaCiudadano.numero_documento;
        this.validarCargarAyuda = true;
        this.consulta = true;
      } catch (error) {
        console.log(error);
      }
    },
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
      console.log(res);
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
    async ActualizarDatos() {
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
              .put(`/api/ayudas/${this.idEditar.id}`, {
                lista_id: this.ayuda,
                ciudadano_id: this.modulo_id,
                cantidad_entregada: this.cantidad,
                fecha_entrega: this.fecha_entrega,
              })
              .then(function (response) {
                console.log(response);
                if (response.data.data == "sin stock") {
                  Swal.fire({
                    html: `<h4>Sin Stock Disponible!</h4>`,
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
            this.actualizarRegistro = true;
            this.LimpiarDatos();
          }
        }
        this.$emit("refrescar", true);
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
