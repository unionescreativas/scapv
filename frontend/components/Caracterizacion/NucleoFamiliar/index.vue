<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12" lg="12">
        <div class="iq-card">
          <ValidationObserver tag="form" ref="observer" autocomplete="off">
            <form-wizard
              ref="formWizard"
              title="Por favor Completar todos los Campos"
              subtitle
              back-button-text="Atrás"
              next-button-text="Siguiente"
              finish-button-text="Finalizar"
              color="#083696"
              :start-index.sync="stepIndex"
            >
              <tab-content title="Datos Personales" icon="fa fa-search">
                <template v-if="stepIndex == 0">
                  <tab-datos-personales :form="form" :options="options" />
                </template>
              </tab-content>

              <tab-content title="Información Adicional" icon="fa fa-info">
                <template v-if="stepIndex == 1">
                  <tab-informacion-adicional :form="form" :options="options" />
                </template>
              </tab-content>

              <tab-content title="Núcleo Familiar" icon="fas fa-user-friends">
                <template v-if="stepIndex == 2">
                  <tab-nucleo-familiar :form="form" :options="options" :ciudadano="ciudadano" />
                </template>
              </tab-content>

              <tab-content title="Finalizar" icon="fa fa-check">
                <documentos :modulo="modulo" :moduloid="ciudadano.id"></documentos>
              </tab-content>

              <template slot="footer" slot-scope="props">
                <div class="wizard-footer-left">
                  <b-button
                    v-if="props.activeTabIndex > 0 || props.isLastStep"
                    @click="prevTab()"
                    :style="props.fillButtonStyle"
                    >Atrás</b-button
                  >
                </div>
                <div class="wizard-footer-right">
                  <b-button
                    v-if="!props.isLastStep"
                    @click="validate(() => guardarCiudadano(_self))"
                    class="wizard-footer-right"
                    :style="props.fillButtonStyle"
                    >Siguiente</b-button
                  >
                  <b-button
                    v-if="props.isLastStep"
                    @click="validate(() => guardarCiudadano(_self))"
                    class="wicozard-footer-right finish-button"
                    :style="props.fillButtonStyle"
                    >Finalizar</b-button
                  >
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
import { mapActions, mapGetters } from "vuex";
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import Swal from "sweetalert2";

export default {
  props: {
    numero_documento: {
      type: String,
      required: true,
    },
  },
  components: { FormWizard, TabContent },
  data: () => ({
    modulo: "documentos",
    form: {},
    formChanged: false,
    stepIndex: 0,
    options: {
      tipos_documentos: [],
      generos: [],
      estados_civiles: [],
      departamentos: [],
      ciudades_residencia: [],
      barrios: [],
      ciudades_origen: [],
      paises_origen: [],
      respuestas: [],
      niveles_escolares: [],
      tipos_empleos: [],
      parentescos: [],
    },
  }),
  computed: {
    ...mapGetters("Familias", ["ciudadano"]),
  },
  watch: {
    form: {
      handler(val, oldVal) {
        if (Object.values(oldVal).length) {
          this.formChanged = true;
        }
      },
      deep: true,
    },
  },
  methods: {
    ...mapActions("Familias", ["guardarCiudadano"]),
    async validate(cb) {
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
            return cb();
          } else {
            if (!this.$refs.formWizard.isLastStep) {
              this.$refs.formWizard.nextTab();
            } else {
              return cb();
            }
          }
        }
      } catch (err) {
        console.error(err);
      }
    },
    prevTab() {
      this.formChanged = false;
      this.$refs.formWizard.prevTab();
    },
  },
  created() {
    this.form = {
      numero_documento: this.numero_documento,
      ...this.ciudadano,
    };

    Object.keys(this.options).forEach((option) => {
      this.$axios.get(`/api/listas/${option}`).then((res) => (this.options[option] = res.data.data));
    });
  },
};
</script>
