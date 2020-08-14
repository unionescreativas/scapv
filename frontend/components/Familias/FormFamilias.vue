<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12" lg="12">
        <div class="iq-card">
          <ValidationObserver server tag="form" ref="observer" autocomplete="off">
            <form-wizard ref="formWizard" title="Por favor Completar todos los Campos" subtitle="" back-button-text="Atrás"
              next-button-text="Siguiente" finish-button-text="Finalizar" :start-index.sync="stepIndex">
              <tab-content title="Datos Personales" icon="fa fa-search">
                <template v-if="stepIndex == 0">
                  <ValidationProvider name="tipo_documento" v-slot="{ errors }">
                    <b-form-group label="TIPO DE DOCUMENTO: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('tipos_documentos', $event)"
                        :options="options.tipos_documentos" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.tipo_documento">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">
                        {{ errors[0].replace("tipo_documento", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="numero_documento" v-slot="{ errors }">
                    <b-form-group label="NUMERO DE DOCUMENTO: *">
                      <b-form-input type="text" placeholder="INGRESE NUMERO DE DOCUMENTO" v-model="form.numero_documento" />
                      <div class="text-danger" v-if="errors[0]">
                        {{ errors[0].replace("numero_documento", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="pep" v-slot="{ errors }">
                    <b-form-group label="# PERMISO ESPECIAL DE PERMANENCIA">
                      <b-form-input type="text" placeholder="INGRESE # PERMISO ESPECIAL DE PERMANENCIA" v-model="form.pep" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("pep", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="nombres" v-slot="{ errors }">
                    <b-form-group label="NOMBRES: *">
                      <b-form-input type="text" placeholder="INGRESE NOMBRES" v-model="form.nombres" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("nombres", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="apellidos" v-slot="{ errors }">
                    <b-form-group label="APELLIDOS: *">
                      <b-form-input type="text" placeholder="INGRESE APELLIDOS" v-model="form.apellidos" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("apellidos", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_expedicion" v-slot="{ errors }">
                    <b-form-group label="FECHA DE EXPEDICION DEL DOCUMENTO: *">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE EXPEDICION DEL DOCUMENTO"
                        v-model="form.fecha_expedicion" />
                      <div class="text-danger" v-if="errors[0]">
                        {{ errors[0].replace("fecha_expedicion", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_vencimiento" v-slot="{ errors }">
                    <b-form-group label="FECHA DE VENCIMIENTO DEL DOCUMENTO">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE VENCIMIENTO DEL DOCUMENTO"
                        v-model="form.fecha_vencimiento" />
                      <div class="text-danger" v-if="errors[0]">
                        {{ errors[0].replace("fecha_vencimiento", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_nacimiento" v-slot="{ errors }">
                    <b-form-group label="FECHA DE NACIMIENTO: *">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE NACIMIENTO" v-model="form.fecha_nacimiento" />
                      <div class="text-danger" v-if="errors[0]">
                        {{ errors[0].replace("fecha_nacimiento", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="edad" v-slot="{ errors }">
                    <b-form-group label="EDAD: *">
                      <b-form-input type="text" placeholder="INGRESE EDAD" v-model="form.edad" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("edad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="genero" v-slot="{ errors }">
                    <b-form-group label="GÉNERO: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('generos', $event)"
                        :options="options.generos" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.genero">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("genero", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="estado_civil" v-slot="{ errors }">
                    <b-form-group label="ESTADO CIVIL: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('estados_civiles', $event)"
                        :options="options.estados_civiles" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.estado_civil">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("estado_civil", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="telefono" v-slot="{ errors }">
                    <b-form-group label="TELEFONO: *">
                      <b-form-input type="text" placeholder="INGRESE TELEFONO" v-model="form.telefono" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("telefono", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="celular" v-slot="{ errors }">
                    <b-form-group label="CELULAR: *">
                      <b-form-input type="text" placeholder="INGRESE CELULAR" v-model="form.celular" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("celular", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="correo_electronico" v-slot="{ errors }">
                    <b-form-group label="CORREO ELECTRONICO: *">
                      <b-form-input type="email" placeholder="INGRESE CORREO ELECTRONICO" v-model="form.correo_electronico" />
                      <div class="text-danger" v-if="errors[0]">
                        {{ errors[0].replace("correo_electronico", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="departamento" v-slot="{ errors }">
                    <b-form-group label="DEPARTAMENTO DE RESIDENCIA: *">
                      <b-form-input type="text" placeholder="INGRESE DEPARTAMENTO DE RESIDENCIA" v-model="form.departamento" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("departamento", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="ciudad" v-slot="{ errors }">
                    <b-form-group label="CIUDAD DE RESIDENCIA: *">
                      <b-form-input type="text" placeholder="INGRESE CIUDAD DE RESIDENCIA" v-model="form.ciudad" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("ciudad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="barrrio" v-slot="{ errors }">
                    <b-form-group label="BARRIO DE RESIDENCIA: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('barrios', $event)"
                        :options="options.barrios" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.barrrio">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("barrrio", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="comuna" v-slot="{ errors }">
                    <b-form-group label="COMUNA DE RESIDENCIA: *">
                      <b-form-input type="text" placeholder="INGRESE COMUNA DE RESIDENCIA" v-model="form.comuna" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("comuna", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="dirrecion" v-slot="{ errors }">
                    <b-form-group label="DIRECCIÓN DE RESIDENCIA: *">
                      <b-form-input type="text" placeholder="INGRESE DIRECCIÓN DE RESIDENCIA" v-model="form.dirrecion" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("dirrecion", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>
                </template>
              </tab-content>

              <tab-content title="Información Adicional" icon="fa fa-info">
                <template v-if="stepIndex == 1">
                  <ValidationProvider name="actividad" v-slot="{ errors }">
                    <b-form-group label="ACTIVIDAD: *">
                      <b-form-input type="text" placeholder="INGRESE ACTIVIDAD" v-model="form.actividad" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("actividad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="ciudad_origen" v-slot="{ errors }">
                    <b-form-group label="CIUDAD DE ORIGEN: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('ciudades_origen', $event)"
                        :options="options.ciudades_origen" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.ciudad_origen">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("ciudad_origen", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="pais_origen" v-slot="{ errors }">
                    <b-form-group label="PAIS DE ORIGEN: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('paises_origen', $event)"
                        :options="options.paises_origen" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.pais_origen">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("pais_origen", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_llegada" v-slot="{ errors }">
                    <b-form-group label="FECHA DE LLEGADA AL PAIS: *">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE LLEGADA AL PAIS" v-model="form.fecha_llegada" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("fecha_llegada", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="intencion_ciudad" v-slot="{ errors }">
                    <b-form-group label="INTENCIÓN DE ESTAR EN LA CIUDAD: *">
                      <b-form-input type="date" placeholder="INGRESE INTENCIÓN DE ESTAR EN LA CIUDAD"
                        v-model="form.intencion_ciudad" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("intencion_ciudad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="respuesta_intencion" v-slot="{ errors }">
                    <b-form-group label="RESPUESTA INTENCIÓN: *">
                      <b-form-input type="date" placeholder="INGRESE RESPUESTA INTENCIÓN"
                        v-model="form.respuesta_intencion" />
                      <div class="text-danger" v-if="errors[0]">
                        {{ errors[0].replace("respuesta_intencion", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="discapacidad" v-slot="{ errors }">
                    <b-form-group label="TIENE ALGUNA DISCAPACIDAD: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('respuestas', $event)"
                        :options="options.respuestas" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.discapacidad">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("discapacidad", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="salud" v-slot="{ errors }">
                    <b-form-group label="TIENE SISTEMA DE SALUD: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('respuestas', $event)"
                        :options="options.respuestas" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.salud">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("salud", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="estudia_actualmente" v-slot="{ errors }">
                    <b-form-group label="SE ENCUENTRA ESTUDIANDO ACTUALMENTE: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('respuestas', $event)"
                        :options="options.respuestas" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.estudia_actualmente">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">
                        {{ errors[0].replace("estudia_actualmente", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="nivel_escolaridad" v-slot="{ errors }">
                    <b-form-group label="NIVEL DE ESCOLARIDAD: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('niveles_escolares', $event)"
                        :options="options.niveles_escolares" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.nivel_escolar">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">
                        {{ errors[0].replace("nivel_escolaridad", "") }}
                      </div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="tipo_profesion" v-slot="{ errors }">
                    <b-form-group label="PROFESIONAL EN ?: *">
                      <b-form-input type="text" placeholder="INGRESE PROFESIONAL EN ?" v-model="form.tipo_profesion" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("tipo_profesion", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="comunidad_lgtbi" v-slot="{ errors }">
                    <b-form-group label="POBLACIÓN LGTBI: *">
                      <b-form-input type="text" placeholder="INGRESE POBLACIÓN LGTBI" v-model="form.comunidad_lgtbi" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("comunidad_lgtbi", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="comunidad_etnica" v-slot="{ errors }">
                    <b-form-group label="PERTENECE ALGUNA COMUNA ETNICA ?: *">
                      <b-form-input type="text" placeholder="INGRESE PERTENECE ALGUNA COMUNA ETNICA ?"
                        v-model="form.comunidad_etnica" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("comunidad_etnica", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="trabajo" v-slot="{ errors }">
                    <b-form-group label="ACTUALMENTE SE ENCUENTRA LABORANDO: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('respuestas', $event)"
                        :options="options.respuestas" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.trabajo">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("trabajo", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="tipo_empleo" v-slot="{ errors }">
                    <b-form-group label="TIPO DE EMPLEO: *">
                      <v-select placeholder="Seleccione ..." @search="consultarListas('tipos_empleos', $event)"
                        :options="options.tipos_empleos" label="valor_campo_1" :reduce="option => option.codigo_campo"
                        v-model="form.tipo_empleo">
                        <template slot="no-options">
                          <span>Escriba para buscar ...</span>
                        </template>
                      </v-select>
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("tipo_empleo", "") }}</div>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="observaciones" v-slot="{ errors }">
                    <b-form-group label="OBSERVACIONES: *">
                      <b-form-textarea type="textarea" placeholder="INGRESE OBSERVACIONES" v-model="form.observaciones" />
                      <div class="text-danger" v-if="errors[0]">{{ errors[0].replace("observaciones", "") }}</div>
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
                  <b-button v-if="props.activeTabIndex > 0 || props.isLastStep" @click="props.prevTab()"
                    :style="props.fillButtonStyle">Atrás</b-button>
                </div>
                <div class="wizard-footer-right">
                  <b-button v-if="!props.isLastStep" @click="guardarCiudadano(_self)" class="wizard-footer-right"
                    :style="props.fillButtonStyle">Siguiente</b-button>
                  <b-button v-if="props.isLastStep" @click="guardarCiudadano(_self)"
                    class="wicozard-footer-right finish-button" :style="props.fillButtonStyle">Finalizar</b-button>
                </div>
              </template>
            </form-wizard>
          </ValidationObserver>
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

export default {
  components: {
    FormWizard,
    TabContent,
  },
  data: () => ({
    form: {},
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
      tipos_empleos: []
    },
  }),
  computed: {
    ...mapState("Listas", ["lista"]),
    ...mapState("Familias", ["ciudadano"]),
  },
  methods: {
    consultarListas(option, search) {
      this.$store.dispatch("Listas/consultarListas", option).then(() => {
        this.options[option] = this.lista;
      });
    },
    ...mapActions("Familias", ["guardarCiudadano"]),
  },
  mounted(){
    // this.$store.dispatch("Familias/consultarCiudadano", "1151959229");
    if (this.ciudadano && this.ciudadano != "no existe") {
      this.form = { ...this.ciudadano[0] };
    }
  }
};
</script>
