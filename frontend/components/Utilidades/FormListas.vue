<template>
  <div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between ">
      <div class="iq-header-title">
        <h4 class="card-title">Crear Listas</h4>
      </div>
    </div>
    <div class="card-body iq-card-body">
      <ValidationObserver ref="observer" slim>
        <b-form autocomplete="off">
          <b-container fluid>
            <b-row>
              <b-col sm="12" lg="12">
                <b-row>
                  <b-col sm="12" lg="12">
                    <b-form-group label="NOMBRE LISTA: *">
                      <b-form-input placeholder="INGRESE NOMBRE LISTA"></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>

                <b-row class="bg-primary">
                  <b-col sm="12" lg="12">
                    <b-row>
                      <b-col sm="2" lg="2">
                        <label class="text-white">CÓDIGO LISTA</label>
                      </b-col>

                      <b-col sm="3" lg="3">
                        <label class="text-white">VALOR CAMPO 1</label>
                      </b-col>

                      <b-col sm="3" lg="3">
                        <label class="text-white">VALOR CAMPO 2</label>
                      </b-col>

                      <b-col sm="3" lg="3">
                        <label class="text-white">VALOR CAMPO 3</label>
                      </b-col>

                      <b-col sm="3" lg="3">
                        <label class="text-white">VALOR CAMPO 4</label>
                      </b-col>
                    </b-row>
                  </b-col>
                </b-row>

                <b-row>
                  <b-col sm="3" lg="3">
                    <b-form-group label="CÓDIGO LISTA: *">
                      <b-form-input placeholder="INGRESE CÓDIGO LISTA"></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>
              </b-col>
            </b-row>
          </b-container>
        </b-form>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
export default {};
</script>
