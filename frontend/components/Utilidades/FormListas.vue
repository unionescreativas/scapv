<template>
  <b-container fluid>
    <b-row class="mb-4">
      <b-col sm="1" lg="1">
        <b-button variant="dark" class="pr-2" @click="agregarFormulario()">
          <i class="fa fa-plus"></i>
        </b-button>
      </b-col>
    </b-row>

    <b-row>
      <b-col sm="12" lg="12">
        <ValidationObserver ref="observer" slim>
          <b-form autocomplete="off">
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
                      <b-button variant="dark" class="pr-2" @click="removerFormulario(index)">
                        <i class="fa fa-minus"></i>
                      </b-button>
                    </b-col>
                  </b-row>

                  <b-row class="mt-3">
                    <b-col sm="4" lg="4">
                      <b-form-group>
                        <b-form-input placeholder="INGRESE NOMBRE LISTA" v-model="form.nombre_lista" />
                      </b-form-group>
                    </b-col>

                    <b-col sm="4" lg="4">
                      <b-form-group>
                        <b-form-input placeholder="INGRESE CÓDIGO CAMPO" v-model="form.codigo_campo" />
                      </b-form-group>
                    </b-col>

                    <b-col sm="4" lg="4">
                      <b-form-group>
                        <b-form-input placeholder="INGRESE VALOR CAMPO 1" v-model="form.valor_campo_1" />
                      </b-form-group>
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
          </b-form>
        </ValidationObserver>
      </b-col>
    </b-row>

    <b-row class="mb-4" v-if="form.length >= 2">
      <b-col sm="1" lg="1">
        <b-button variant="dark" class="pr-2" @click="agregarFormulario()">
          <i class="fa fa-plus"></i>
        </b-button>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data: () => ({
    form: [{}],
  }),
  methods: {
    agregarFormulario(){
      this.form.push({});
    },
    removerFormulario(indexRemove){
      this.form = this.form.filter((item, index) => index !== indexRemove);
    }
  }
};
</script>
