<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12" lg="12">
        <div class="iq-card">
          <ValidationObserver tag="form" ref="observer" autocomplete="off">
            <form-wizard ref="formWizard" title="Por favor Completar todos los Campos" subtitle="" back-button-text="Atrás"
              next-button-text="Siguiente" finish-button-text="Finalizar" color="#083696" :start-index.sync="stepIndex">
              <tab-content title="Datos Personales" icon="fa fa-search">
                <template v-if="stepIndex == 0">
                  <ValidationProvider name="tipo_documento" v-slot="{ errors }">
                    <b-form-group label="TIPO DE DOCUMENTO: *">
                      <v-select placeholder="Seleccione ..." :options="options.tipos_documentos" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.tipo_documento">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                        {{ errors[0].replace("tipo documento", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="numero_documento" v-slot="{ errors }">
                    <b-form-group label="NUMERO DE DOCUMENTO: *">
                      <b-form-input type="text" placeholder="INGRESE NUMERO DE DOCUMENTO" v-model="form.numero_documento" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                        {{ errors[0].replace("numero_documento", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="pep" v-slot="{ errors }">
                    <b-form-group label="# PERMISO ESPECIAL DE PERMANENCIA">
                      <b-form-input type="text" placeholder="INGRESE # PERMISO ESPECIAL DE PERMANENCIA" v-model="form.pep" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                        {{ errors[0].replace("pep", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="nombres" v-slot="{ errors }">
                    <b-form-group label="NOMBRES: *">
                      <b-form-input type="text" placeholder="INGRESE NOMBRES" v-model="form.nombres" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("nombres", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="apellidos" v-slot="{ errors }">
                    <b-form-group label="APELLIDOS: *">
                      <b-form-input type="text" placeholder="INGRESE APELLIDOS" v-model="form.apellidos" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("apellidos", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_expedicion" v-slot="{ errors }">
                    <b-form-group label="FECHA DE EXPEDICION DEL DOCUMENTO: *">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE EXPEDICION DEL DOCUMENTO"
                        v-model="form.fecha_expedicion" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                        {{ errors[0].replace("fecha expedicion", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_vencimiento" v-slot="{ errors }">
                    <b-form-group label="FECHA DE VENCIMIENTO DEL DOCUMENTO: *">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE VENCIMIENTO DEL DOCUMENTO"
                        v-model="form.fecha_vencimiento" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                        {{ errors[0].replace("fecha_vencimiento", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_nacimiento" v-slot="{ errors }">
                    <b-form-group label="FECHA DE NACIMIENTO: *">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE NACIMIENTO" v-model="form.fecha_nacimiento"
                        @change="calcularEdad" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                        {{ errors[0].replace("fecha nacimiento", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="edad" v-slot="{ errors }">
                    <b-form-group label="EDAD: *">
                      <b-form-input type="text" v-model="form.edad" readonly />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("edad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="genero" v-slot="{ errors }">
                    <b-form-group label="GÉNERO: *">
                      <v-select placeholder="Seleccione ..." :options="options.generos" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.genero">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("genero", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="estado_civil" v-slot="{ errors }">
                    <b-form-group label="ESTADO CIVIL">
                      <v-select placeholder="Seleccione ..." :options="options.estados_civiles" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.estado_civil">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("estado_civil", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="telefono" v-slot="{ errors }">
                    <b-form-group label="TELÉFONO">
                      <b-form-input type="text" placeholder="INGRESE TELÉFONO" v-model="form.telefono" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("telefono", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="celular" v-slot="{ errors }">
                    <b-form-group label="CELULAR">
                      <b-form-input type="text" placeholder="INGRESE CELULAR" v-model="form.celular" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("celular", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="correo_electronico" v-slot="{ errors }">
                    <b-form-group label="CORREO ELECTRÓNICO">
                      <b-form-input type="text" placeholder="INGRESE CORREO ELECTRÓNICO" v-model="form.correo_electronico" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("correo_electronico", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="departamento" v-slot="{ errors }">
                    <b-form-group label="DEPARTAMENTO DE RESIDENCIA: *">
                      <b-form-input type="text" placeholder="INGRESE DEPARTAMENTO DE RESIDENCIA"
                        v-model="form.departamento" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("departamento", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="ciudad" v-slot="{ errors }">
                    <b-form-group label="CIUDAD DE RESIDENCIA">
                      <v-select placeholder="Seleccione ..." :options="options.ciudades_origen" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.ciudad">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("ciudad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="barrio" v-slot="{ errors }">
                    <b-form-group label="BARRIO DE RESIDENCIA: *">
                      <v-select ref="vSelect" placeholder="Seleccione ..." :options="options.barrios" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.barrio" @input="autocompletarComuna">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("barrio", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="comuna" v-slot="{ errors }">
                    <b-form-group label="COMUNA DE RESIDENCIA: *">
                      <b-form-input type="text" id="comuna" placeholder="INGRESE COMUNA DE RESIDENCIA"
                        v-model="form.comuna" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("comuna", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="direccion" v-slot="{ errors }">
                    <b-form-group label="DIRECCIÓN DE RESIDENCIA: *">
                      <b-form-input type="text" placeholder="INGRESE DIRECCIÓN DE RESIDENCIA" v-model="form.direccion" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("direccion", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>
                </template>
              </tab-content>

              <tab-content title="Información Adicional" icon="fa fa-info">
                <template v-if="stepIndex == 1">
                  <ValidationProvider name="actividad" v-slot="{ errors }">
                    <b-form-group label="ACTIVIDAD">
                      <b-form-input type="text" placeholder="INGRESE ACTIVIDAD" v-model="form.actividad" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("actividad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="ciudad_origen" v-slot="{ errors }">
                    <b-form-group label="CIUDAD DE ORIGEN">
                      <v-select placeholder="Seleccione ..." :options="options.ciudades_origen" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.ciudad_origen">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("ciudad_origen", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="pais_origen" v-slot="{ errors }">
                    <b-form-group label="PAIS DE ORIGEN">
                      <v-select placeholder="Seleccione ..." :options="options.paises_origen" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.pais_origen">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("pais_origen", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_llegada" v-slot="{ errors }">
                    <b-form-group label="FECHA DE LLEGADA AL PAIS">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE LLEGADA AL PAIS"
                        v-model="form.fecha_llegada" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("fecha_llegada", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="intencion_ciudad" v-slot="{ errors }">
                    <b-form-group label="INTENCIÓN DE ESTAR EN LA CIUDAD">
                      <b-form-input type="text" placeholder="INGRESE INTENCIÓN DE ESTAR EN LA CIUDAD"
                        v-model="form.intencion_ciudad" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("intencion_ciudad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="respuesta_intencion" v-slot="{ errors }">
                    <b-form-group label="RESPUESTA INTENCIÓN">
                      <b-form-input type="date" placeholder="INGRESE RESPUESTA INTENCIÓN"
                        v-model="form.respuesta_intencion" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                        {{ errors[0].replace("respuesta_intencion", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="discapacidad" v-slot="{ errors }">
                    <b-form-group label="TIENE ALGUNA DISCAPACIDAD">
                      <v-select placeholder="Seleccione ..." :options="options.respuestas" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.discapacidad">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("discapacidad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="salud" v-slot="{ errors }">
                    <b-form-group label="TIENE SISTEMA DE SALUD">
                      <v-select placeholder="Seleccione ..." :options="options.respuestas" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.salud">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("salud", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="estudia_actualmente" v-slot="{ errors }">
                    <b-form-group label="SE ENCUENTRA ESTUDIANDO ACTUALMENTE">
                      <v-select placeholder="Seleccione ..." :options="options.respuestas" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.estudia_actualmente">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                        {{ errors[0].replace("estudia_actualmente", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="nivel_escolaridad" v-slot="{ errors }">
                    <b-form-group label="NIVEL DE ESCOLARIDAD">
                      <v-select placeholder="Seleccione ..." :options="options.niveles_escolares" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.nivel_escolaridad">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                        {{ errors[0].replace("nivel_escolaridad", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="tipo_profesion" v-slot="{ errors }">
                    <b-form-group label="PROFESIONAL EN ?">
                      <b-form-input type="text" placeholder="INGRESE PROFESIONAL EN ?" v-model="form.tipo_profesion" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("tipo_profesion", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="comunidad_lgtbi" v-slot="{ errors }">
                    <b-form-group label="POBLACIÓN LGTBI">
                      <b-form-input type="text" placeholder="INGRESE POBLACIÓN LGTBI" v-model="form.comunidad_lgtbi" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("comunidad_lgtbi", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="comunidad_etnica" v-slot="{ errors }">
                    <b-form-group label="PERTENECE ALGUNA COMUNA ETNICA ?">
                      <b-form-input type="text" placeholder="INGRESE PERTENECE ALGUNA COMUNA ETNICA ?"
                        v-model="form.comunidad_etnica" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("comunidad_etnica", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="trabajo" v-slot="{ errors }">
                    <b-form-group label="ACTUALMENTE SE ENCUENTRA LABORANDO">
                      <v-select placeholder="Seleccione ..." :options="options.respuestas" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.trabajo">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("trabajo", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="tipo_empleo" v-slot="{ errors }">
                    <b-form-group label="TIPO DE EMPLEO">
                      <v-select placeholder="Seleccione ..." :options="options.tipos_empleos" label="valor_campo_1"
                        :reduce="(option) => option.codigo_campo" v-model="form.tipo_empleo">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("tipo_empleo", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="observaciones" v-slot="{ errors }">
                    <b-form-group label="OBSERVACIONES">
                      <b-form-textarea type="textarea" rows="5" placeholder="INGRESE OBSERVACIONES"
                        v-model="form.observaciones" />
                      <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("observaciones", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>
                </template>
              </tab-content>

              <!-- <tab-content title="Núcleo Familiar" icon="fas fa-user-friends">
                Yuhuuu! This seems pretty damn simple
              </tab-content> -->

              <!-- <tab-content title="Finalizar" icon="fa fa-check">
                Yuhuuu! This seems pretty damn simple
              </tab-content> -->

              <template slot="footer" slot-scope="props">
                <div class="wizard-footer-left">
                  <b-button v-if="props.activeTabIndex > 0 || props.isLastStep" @click="prevTab()"
                    :style="props.fillButtonStyle">Atrás</b-button>
                </div>
                <div class="wizard-footer-right">
                  <b-button v-if="!props.isLastStep" @click="validate(() => guardarCiudadano(_self))"
                    class="wizard-footer-right" :style="props.fillButtonStyle">Siguiente</b-button>
                  <b-button v-if="props.isLastStep" @click="validate(() => guardarCiudadano(_self))"
                    class="wicozard-footer-right finish-button" :style="props.fillButtonStyle">Finalizar</b-button>
                </div>
              </template>
            </form-wizard>
          </ValidationObserver>
          EDAD - {{form.edad}}
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapState, mapActions } from "vuex";
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import Swal from "sweetalert2";
import { calcularEdad } from "~/plugins/general/scripts";

export default {
  props: {
    numero_documento: {
      type: String,
      required: true
    }
  },
  components: {
    FormWizard,
    TabContent,
  },
  data: () => ({
    form: {},
    formChanged: false,
    stepIndex: 0,
    options: {
      tipos_documentos: [],
      generos: [],
      estados_civiles: [],
      barrios: [],
      ciudades_origen: [],
      paises_origen: [],
      respuestas: [],
      niveles_escolares: [],
      tipos_empleos: [],
    },
  }),
  watch: {
    form: {
      handler(val, oldVal) {
        if (Object.values(oldVal).length) {
          this.formChanged = true;
        }
      },
      deep: true
    }
  },
  computed: {
    ...mapState("Familias", ["ciudadano"]),
  },
  methods: {
    ...mapActions("Familias", ["guardarCiudadano"]),
    autocompletarComuna(value) {
      // let barrio = this.options.barrios.find((option) => option.codigo_campo == value);
      // let comuna = barrio.valor_campo_2;
      // this.form.comuna = comuna;
    },
    // autocompletarComuna() {
    //   let comuna = this.$refs.vSelect.selectedValue[0].valor_campo_2;
    //   this.form.comuna = comuna;
    // },
    calcularEdad(fecha){
      let edad = calcularEdad(fecha);
      console.log(edad)
      this.form.edad = edad;
    },
    async validate(func) {
      try {
        let res = await this.$axios.post("/api/ciudadanosvalidar", this.form);
        let errors = _.pick(res.data.data.errors, _.keys(this.$refs.observer.fields));

        if (Object.keys(errors).length) {
          this.$refs.observer.setErrors(errors);
          Swal.fire({
            html: "<h4>Por favor revise los campos en rojo!</h4>",
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
        } else {
          if (this.formChanged) {
            this.formChanged = false;
            return func();
          } else {
            if (!this.$refs.formWizard.isLastStep) {
              this.$refs.formWizard.nextTab();
            } else {
              return func();
            }
          }
        }
      } catch (err) {
        console.error(err);
      }
    },
    prevTab(){
      this.formChanged = false;
      this.$refs.formWizard.prevTab();
    }
  },
  created(){
    this.form = {
      numero_documento: this.numero_documento,
      ...(this.ciudadano && this.ciudadano != "no existe" ? this.ciudadano[0] : null)
    }

    Object.keys(this.options).forEach((option) => {
      this.$axios.get(`/api/listas/${option}`).then((res) => this.options[option] = res.data.data);
    });
  }
};
</script>
