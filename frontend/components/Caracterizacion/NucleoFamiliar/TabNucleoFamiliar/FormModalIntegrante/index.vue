<template>
  <b-modal v-model="toggleModal" size="lg" modal-class="container-fluid">
    <template v-slot:modal-header="{ close }">
      <h3 class="text-center w-100" v-if="!integrante">Agregar Integrante de Familia</h3>
      <h3 class="text-center w-100" v-else>Actualizar Integrante de Familia</h3>
      <b-button-close title="Cerrar" @click="close()">
        <i style="font-size: 50px;" class="text-danger ri-close-line"></i>
      </b-button-close>
    </template>

    <ValidationObserver ref="observer">
      <b-form autocomplete="off" class="mt-4">
        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="parentesco" v-slot="{ errors }">
              <b-form-group label="PARENTESCO: *">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.parentescos"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.parentesco"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("parentesco", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="tipo_documento" v-slot="{ errors }">
              <b-form-group label="TIPO DE DOCUMENTO: *">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.tipos_documentos"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.tipo_documento"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("tipo documento", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="numero_documento" v-slot="{ errors }">
              <b-form-group label="NUMERO DE DOCUMENTO: *">
                <b-form-input type="text" placeholder="INGRESE NUMERO DE DOCUMENTO" v-model="form.numero_documento" />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("numero documento", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="pep" v-slot="{ errors }">
              <b-form-group label="# PERMISO ESPECIAL DE PERMANENCIA:">
                <b-form-input type="text" placeholder="INGRESE # PERMISO ESPECIAL DE PERMANENCIA" v-model="form.pep" />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("pep", "") }}</div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="nombres" v-slot="{ errors }">
              <b-form-group label="NOMBRES: *">
                <b-form-input type="text" placeholder="INGRESE NOMBRES" v-model="form.nombres" />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("nombres", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="apellidos" v-slot="{ errors }">
              <b-form-group label="APELLIDOS: *">
                <b-form-input type="text" placeholder="INGRESE APELLIDOS" v-model="form.apellidos" />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("apellidos", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="fecha_expedicion" v-slot="{ errors }">
              <b-form-group label="FECHA DE EXPEDICION DEL DOCUMENTO: *">
                <b-form-input
                  type="date"
                  placeholder="INGRESE FECHA DE EXPEDICION DEL DOCUMENTO"
                  v-model="form.fecha_expedicion"
                />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("fecha expedicion", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="fecha_vencimiento" v-slot="{ errors }">
              <b-form-group label="FECHA DE VENCIMIENTO DEL DOCUMENTO: *">
                <b-form-input
                  type="date"
                  placeholder="INGRESE FECHA DE VENCIMIENTO DEL DOCUMENTO"
                  v-model="form.fecha_vencimiento"
                />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("fecha vencimiento", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="fecha_nacimiento" v-slot="{ errors }">
              <b-form-group label="FECHA DE NACIMIENTO: *">
                <b-form-input
                  type="date"
                  placeholder="INGRESE FECHA DE NACIMIENTO"
                  v-model="form.fecha_nacimiento"
                  @change="calcularEdad"
                />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("fecha nacimiento", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="edad" v-slot="{ errors }">
              <b-form-group label="EDAD: *">
                <b-form-input type="text" ref="inputEdad" v-model="form.edad" readonly />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("edad", "") }}</div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="genero" v-slot="{ errors }">
              <b-form-group label="GÉNERO: *">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.generos"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.genero"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("genero", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="estado_civil" v-slot="{ errors }">
              <b-form-group label="ESTADO CIVIL:">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.estados_civiles"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.estado_civil"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("estado_civil", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="telefono" v-slot="{ errors }">
              <b-form-group label="TELÉFONO:">
                <b-form-input type="text" placeholder="INGRESE TELÉFONO" v-model="form.telefono" />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("telefono", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="celular" v-slot="{ errors }">
              <b-form-group label="CELULAR:">
                <b-form-input type="text" placeholder="INGRESE CELULAR" v-model="form.celular" />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("celular", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="correo_electronico" v-slot="{ errors }">
              <b-form-group label="CORREO ELECTRÓNICO:">
                <b-form-input type="text" placeholder="INGRESE CORREO ELECTRÓNICO" v-model="form.correo_electronico" />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("correo electronico", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="actividad" v-slot="{ errors }">
              <b-form-group label="ACTIVIDAD QUE REALIZA ACTUALMENTE:">
                <b-form-input type="text" placeholder="INGRESE ACTIVIDAD" v-model="form.actividad" />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("actividad", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="discapacidad" v-slot="{ errors }">
              <b-form-group label="TIENE ALGUNA DISCAPACIDAD:">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.respuestas"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.discapacidad"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("discapacidad", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="salud" v-slot="{ errors }">
              <b-form-group label="TIENE SISTEMA DE SALUD:">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.respuestas"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.salud"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("salud", "") }}</div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="estudia_actualmente" v-slot="{ errors }">
              <b-form-group label="SE ENCUENTRA ESTUDIANDO ACTUALMENTE:">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.respuestas"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.estudia_actualmente"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("estudia_actualmente", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="nivel_escolaridad" v-slot="{ errors }">
              <b-form-group label="NIVEL DE ESCOLARIDAD:">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.niveles_escolares"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.nivel_escolaridad"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("nivel_escolaridad", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="tipo_profesion" v-slot="{ errors }">
              <b-form-group label="PROFESIONAL EN ?:">
                <b-form-input type="text" placeholder="INGRESE PROFESIONAL EN ?" v-model="form.tipo_profesion" />
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("tipo_profesion", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="comunidad_lgtbi" v-slot="{ errors }">
              <b-form-group label="POBLACIÓN LGTBI:">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.respuestas"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.comunidad_lgtbi"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("comunidad_lgtbi", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <b-row>
          <b-col sm="6" lg="6">
            <ValidationProvider name="comunidad_etnica" v-slot="{ errors }">
              <b-form-group label="PERTENECE ALGUNA COMUNIDAD ETNICA ?:">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.respuestas"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.comunidad_etnica"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("comunidad_etnica", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>

          <b-col sm="6" lg="6">
            <ValidationProvider name="trabajo" v-slot="{ errors }">
              <b-form-group label="ACTUALMENTE SE ENCUENTRA LABORANDO:">
                <v-select
                  placeholder="Seleccione ..."
                  :options="options.respuestas"
                  label="valor_campo_1"
                  :reduce="(option) => option.codigo_campo"
                  v-model="form.trabajo"
                >
                  <template slot="no-options">
                    <span>Escriba para buscar ...</span>
                  </template>
                </v-select>
                <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                  {{ errors[0].replace("trabajo", "") }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </b-col>
        </b-row>

        <ValidationProvider name="tipo_empleo" v-slot="{ errors }">
          <b-form-group label="TIPO DE EMPLEO:">
            <v-select
              placeholder="Seleccione ..."
              :options="options.tipos_empleos"
              label="valor_campo_1"
              :reduce="(option) => option.codigo_campo"
              v-model="form.tipo_empleo"
            >
              <template slot="no-options">
                <span>Escriba para buscar ...</span>
              </template>
            </v-select>
            <div style="color: var(--iq-danger-light);" v-if="errors[0]">
              {{ errors[0].replace("tipo_empleo", "") }}
            </div>
          </b-form-group>
        </ValidationProvider>

        <ValidationProvider name="observaciones" v-slot="{ errors }">
          <b-form-group label="OBSERVACIONES:">
            <b-form-textarea type="textarea" rows="5" placeholder="INGRESE OBSERVACIONES" v-model="form.observaciones" />
            <div style="color: var(--iq-danger-light);" v-if="errors[0]">
              {{ errors[0].replace("observaciones", "") }}
            </div>
          </b-form-group>
        </ValidationProvider>
      </b-form>
    </ValidationObserver>

    <template v-slot:modal-footer>
      <b-row>
        <b-col sm="2" lg="2">
          <b-button style="background-color: var(--iq-primary);" @click="guardarIntegranteFamilia(_self)">
            <span>Guardar</span>
          </b-button>
        </b-col>
      </b-row>
    </template>
  </b-modal>
</template>

<script>
import { mapActions } from "vuex";
import { calcularEdad } from "~/plugins/general/scripts";

export default {
  props: {
    modalShow: {
      required: true,
      type: Boolean,
      default: false,
    },
    options: {
      required: true,
    },
    ciudadano: {
      required: true,
      type: Object,
    },
    integrante: {
      type: Object,
      default: () => {},
    },
  },
  data: () => ({
    form: {},
  }),
  watch: {
    modalShow() {
      this.form = {
        ciudadano_id: this.ciudadano.id,
        ...this.integrante,
      };
    },
  },
  computed: {
    toggleModal: {
      set(value) {
        this.$emit("update:modalShow", value);
      },
      get() {
        return this.modalShow;
      },
    },
  },
  methods: {
    ...mapActions("Familias", ["guardarIntegranteFamilia"]),
    calcularEdad(fecha) {
      let edad = calcularEdad(fecha);
      this.$refs.inputEdad._data.localValue = edad;
      this.form.edad = edad;
    },
  },
};
</script>
