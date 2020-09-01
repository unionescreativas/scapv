<template>
  <b-modal v-model="toggleModal" size="xl" modal-class="container-fluid">
    <template v-slot:modal-header="{ close }">
      <h3 class="text-center w-100" v-if="!lista">Agregar Lista</h3>
      <h3 class="text-center w-100" v-else>Actualizar Lista</h3>
      <b-button-close title="Cerrar" @click="close()">
        <i style="font-size: 50px;" class="text-danger ri-close-line"></i>
      </b-button-close>
    </template>

    <ValidationObserver ref="observer" slim>
      <b-row>
        <b-col sm="1" lg="1">
          <b-button style="background-color: var(--iq-primary);" class="pr-2" @click="agregarFormulario()">
            <i class="fa fa-plus"></i>
          </b-button>
        </b-col>
      </b-row>

      <b-form autocomplete="off">
        <b-container fluid>
          <b-row :class="index > 0 ? 'border-top' : null" style="border-color: var(--iq-secondary-light) !important;" v-for="(form, index) of form" :key="index">
            <b-col sm="12" lg="12">
              <b-row class="bg-light border my-3" style="border-radius: 10px;">
                <b-col sm="12" lg="12">
                  <b-row class="p-1" style="background-color: var(--iq-primary);">
                    <b-col sm="4" lg="4">
                      <label class="text-white">NOMBRE LISTA: *</label>
                    </b-col>

                    <b-col sm="4" lg="4">
                      <label class="text-white">CÓDIGO CAMPO: *</label>
                    </b-col>

                    <b-col sm="3" lg="3">
                      <label class="text-white">VALOR CAMPO 1: *</label>
                    </b-col>

                    <b-col sm="1" lg="1" v-if="index >= 1">
                      <b-button variant="danger" class="pr-2" @click="removerFormulario(index)">
                        <i class="fa fa-minus"></i>
                      </b-button>
                    </b-col>
                  </b-row>

                  <b-row class="mt-3">
                    <b-col sm="4" lg="4">
                      <ValidationProvider :name="`${index}.nombre_lista`" v-slot="{ errors }">
                        <b-form-group>
                          <b-form-input placeholder="INGRESE NOMBRE LISTA" v-model="form.nombre_lista" />
                          <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                            {{ errors[0].replace(`${index}.nombre_lista`, "") }}
                          </div>
                        </b-form-group>
                      </ValidationProvider>
                    </b-col>

                    <b-col sm="4" lg="4">
                      <ValidationProvider :name="`${index}.codigo_campo`" v-slot="{ errors }">
                        <b-form-group>
                          <b-form-input placeholder="INGRESE CÓDIGO CAMPO" v-model="form.codigo_campo" />
                          <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                            {{ errors[0].replace(`${index}.codigo_campo`, "") }}
                          </div>
                        </b-form-group>
                      </ValidationProvider>
                    </b-col>

                    <b-col sm="4" lg="4">
                      <ValidationProvider :name="`${index}.valor_campo_1`" v-slot="{ errors }">
                        <b-form-group>
                          <b-form-input placeholder="INGRESE VALOR CAMPO 1" v-model="form.valor_campo_1" />
                          <div style="color: var(--iq-danger-light);" v-if="errors[0]">
                            {{ errors[0].replace(`${index}.valor_campo_1`, "") }}
                          </div>
                        </b-form-group>
                      </ValidationProvider>
                    </b-col>
                  </b-row>

                  <b-row class="p-1" style="background-color: var(--iq-primary);">
                    <b-col sm="4" lg="4">
                      <label class="text-white">VALOR CAMPO 2</label>
                    </b-col>

                    <b-col sm="4" lg="4">
                      <label class="text-white">VALOR CAMPO 3</label>
                    </b-col>

                    <b-col sm="4" lg="4">
                      <label class="text-white">VALOR CAMPO 4</label>
                    </b-col>
                  </b-row>

                  <b-row class="mt-3">
                    <b-col sm="4" lg="4">
                      <b-form-group>
                        <b-form-input placeholder="INGRESE VALOR CAMPO 2" v-model="form.valor_campo_2" />
                      </b-form-group>
                    </b-col>

                    <b-col sm="4" lg="4">
                      <b-form-group>
                        <b-form-input placeholder="INGRESE VALOR CAMPO 3" v-model="form.valor_campo_3" />
                      </b-form-group>
                    </b-col>

                    <b-col sm="4" lg="4">
                      <b-form-group>
                        <b-form-input placeholder="INGRESE VALOR CAMPO 4" v-model="form.valor_campo_4" />
                      </b-form-group>
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>
            </b-col>
          </b-row>
        </b-container>
      </b-form>

      <b-row class="mb-4">
        <b-col sm="1" lg="1" v-if="form.length >= 2">
          <b-button style="background-color: var(--iq-primary);" class="pr-2" @click="agregarFormulario()">
            <i class="fa fa-plus"></i>
          </b-button>
        </b-col>
      </b-row>
    </ValidationObserver>

    <template v-slot:modal-footer>
      <b-row>
        <b-col sm="2" lg="2">
          <b-button style="background-color: var(--iq-primary);" @click="guardarLista(_self)">
            <span>Guardar</span>
          </b-button>
        </b-col>
      </b-row>
    </template>
  </b-modal>
</template>

<script>
import { mapActions } from "vuex";

export default {
  props: {
    modalShow: {
      required: true,
      type: Boolean,
      default: false,
    },
    lista: {
      type: Object,
      default: () => {},
    },
    reloadDataTable: {
      type: Function,
    },
  },
  data: () => ({
    form: [{}],
  }),
  watch: {
    modalShow(value) {
      this.form[0] = {
        ...this.lista,
      };
      if (!value) {
        this.form = [{}];
      }
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
    agregarFormulario() {
      this.form.push({});
    },
    removerFormulario(indexRemove) {
      this.form = this.form.filter((item, index) => index !== indexRemove);
    },
    ...mapActions("Listas", ["guardarLista"]),
  },
};
</script>
