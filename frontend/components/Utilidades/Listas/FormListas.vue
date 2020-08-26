<template>
  <ValidationObserver ref="observer" slim>
    <b-form autocomplete="off" @submit.prevent="registrarLista(_self)">
      <b-container fluid>

        <tabla-modal-listas :modalShow.sync="modalShow" @handleButtonModal="handleButtonModal" />

        <b-row class="mb-4">
          <b-col sm="1" lg="1">
            <b-button style="background-color: var(--iq-primary);" class="pr-2" @click="agregarFormulario()">
              <i class="fa fa-plus"></i>
            </b-button>
          </b-col>

          <b-col sm="3" lg="3">
            <b-button style="background-color: var(--iq-primary);" class="pr-2"
              @click="$emit('update:modalShow', modalShow = !modalShow)" title="Buscar Listas">
              <i class="fa fa-search"></i>
            </b-button>
          </b-col>
        </b-row>

        <b-container fluid>
          <b-row class="bg-white border mb-4" style="border-radius: 10px;" v-for="(form, index) of form" :key="index">
            <b-col sm="12" lg="12">
              <b-row class="bg-primary p-1">
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
                  <b-button style="background-color: var(--iq-primary);" class="pr-2" @click="removerFormulario(index)">
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

              <b-row class="bg-primary p-1">
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
        </b-container>

        <b-row class="mb-4">
          <b-col sm="1" lg="1" v-if="form.length >= 2">
            <b-button style="background-color: var(--iq-primary);" class="pr-2" @click="agregarFormulario()">
              <i class="fa fa-plus"></i>
            </b-button>
          </b-col>

          <b-col sm="3" lg="3">
            <b-button type="submit" style="background-color: var(--iq-primary);">Guardar</b-button>
          </b-col>
        </b-row>
      </b-container>
    </b-form>
  </ValidationObserver>
</template>

<script>
import { mapActions } from "vuex";

export default {
  props: ["prueba"],
  data: () => ({
    form: [{}],
    modalShow: false,
  }),
  methods: {
    agregarFormulario() {
      this.form.push({});
    },
    removerFormulario(indexRemove) {
      this.form = this.form.filter((item, index) => index !== indexRemove);
    },
    handleButtonModal(data) {
      // this.form[0] = data;
      let routeData = this.$router.resolve({path: "/utilidades/crear-listas"});
      this.$router.push({path: routeData.href, data: {foo: 1}})
      // console.log(routeData.href)
      // window.open(routeData.href, "_blank");
    },
    ...mapActions("Listas", ["registrarLista"]),
  },
};
</script>
