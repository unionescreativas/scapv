<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12" lg="12">
        <div class="iq-card">
          <form-wizard title="Por favor Completar todos los Campos" subtitle="" back-button-text="Atrás"
            next-button-text="Siguiente" finish-button-text="Finalizar" @on-complete="onComplete()">
            <tab-content title="Datos Personales" icon="fa fa-search">
              <ValidationObserver ref="observer" v-slot="{ handleSubmit }" slim>
                <b-form autocomplete="off" @submit.prevent="handleSubmit(() => registrarForm(_self))">
                  <ValidationProvider name="tipo_documento" v-slot="{ errors }">
                    <b-form-group label="TIPO DE DOCUMENTO">
                      <b-form-input type="text" placeholder="INGRESE TIPO DE DOCUMENTO" v-model="form.tipo_documento" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("tipo_documento", "") }}
                      </p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="numero_documento" v-slot="{ errors }">
                    <b-form-group label="NUMERO DE DOCUMENTO">
                      <b-form-input type="text" placeholder="INGRESE NUMERO DE DOCUMENTO" v-model="form.numero_documento" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("numero_documento", "") }}
                      </p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="pep" v-slot="{ errors }">
                    <b-form-group label="# PERMISO ESPECIAL DE PERMANENCIA">
                      <b-form-input type="text" placeholder="INGRESE # PERMISO ESPECIAL DE PERMANENCIA" v-model="form.pep" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("pep", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="nombres" v-slot="{ errors }">
                    <b-form-group label="NOMBRES">
                      <b-form-input type="text" placeholder="INGRESE NOMBRES" v-model="form.nombres" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("nombres", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="apellidos" v-slot="{ errors }">
                    <b-form-group label="APELLIDOS">
                      <b-form-input type="text" placeholder="INGRESE APELLIDOS" v-model="form.apellidos" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("apellidos", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_expedicion" v-slot="{ errors }">
                    <b-form-group label="FECHA DE EXPEDICION DEL DOCUMENTO">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE EXPEDICION DEL DOCUMENTO"
                        v-model="form.fecha_expedicion" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("fecha_expedicion", "") }}
                      </p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_vencimiento" v-slot="{ errors }">
                    <b-form-group label="FECHA DE VENCIMIENTO DEL DOCUMENTO">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE VENCIMIENTO DEL DOCUMENTO"
                        v-model="form.fecha_vencimiento" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">
                        {{ errors[0].replace("fecha_vencimiento", "") }}
                      </p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="fecha_nacimiento" v-slot="{ errors }">
                    <b-form-group label="FECHA DE NACIMIENTO">
                      <b-form-input type="date" placeholder="INGRESE FECHA DE NACIMIENTO" v-model="form.fecha_nacimiento" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("fecha_nacimiento", "") }}
                      </p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="edad" v-slot="{ errors }">
                    <b-form-group label="EDAD">
                      <b-form-input type="text" placeholder="INGRESE EDAD" v-model="form.edad" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("edad", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="genero" v-slot="{ errors }">
                    <b-form-group label="GENERO">
                      <b-form-select plain v-model="form.genero" :options="null" class="mb-3"><template v-slot:first>
                          <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                        </template></b-form-select>
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("genero", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="estado_civil" v-slot="{ errors }">
                    <b-form-group label="ESTADO CIVIL">
                      <b-form-select plain v-model="form.estado_civil" :options="null" class="mb-3"><template v-slot:first>
                          <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                        </template></b-form-select>
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("estado_civil", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="telefono" v-slot="{ errors }">
                    <b-form-group label="TELEFONO">
                      <b-form-input type="text" placeholder="INGRESE TELEFONO" v-model="form.telefono" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("telefono", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="celular" v-slot="{ errors }">
                    <b-form-group label="CELULAR">
                      <b-form-input type="text" placeholder="INGRESE CELULAR" v-model="form.celular" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("celular", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="correo_electronico" v-slot="{ errors }">
                    <b-form-group label="CORREO ELECTRONICO">
                      <b-form-input type="email" placeholder="INGRESE CORREO ELECTRONICO"
                        v-model="form.correo_electronico" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">
                        {{ errors[0].replace("correo_electronico", "") }}
                      </p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="departamento" v-slot="{ errors }">
                    <b-form-group label="DEPARTAMENTO DE RESIDENCIA">
                      <b-form-input type="text" placeholder="INGRESE DEPARTAMENTO DE RESIDENCIA"
                        v-model="form.departamento" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("departamento", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="ciudad" v-slot="{ errors }">
                    <b-form-group label="CIUDAD DE RESIDENCIA">
                      <b-form-input type="text" placeholder="INGRESE CIUDAD DE RESIDENCIA" v-model="form.ciudad" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("ciudad", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="barrrio" v-slot="{ errors }">
                    <b-form-group label="BARRIO DE RESIDENCIA">
                      <b-form-select plain v-model="form.barrrio" :options="null" class="mb-3"><template v-slot:first>
                          <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                        </template></b-form-select>
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("barrrio", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="comuna" v-slot="{ errors }">
                    <b-form-group label="COMUNA DE RESIDENCIA">
                      <b-form-input type="text" placeholder="INGRESE COMUNA DE RESIDENCIA" v-model="form.comuna" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("comuna", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>

                  <ValidationProvider name="dirrecion" v-slot="{ errors }">
                    <b-form-group label="DIRRECION DE RESIDENCIA">
                      <b-form-input type="text" placeholder="INGRESE DIRRECION DE RESIDENCIA" v-model="form.dirrecion" />
                      <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("dirrecion", "") }}</p>
                    </b-form-group>
                  </ValidationProvider>
                </b-form>
              </ValidationObserver>
            </tab-content>

            <tab-content title="Información Adicional" icon="fa fa-info">
              <ValidationProvider name="actividad" v-slot="{ errors }">
                <b-form-group label="ACTIVIDAD">
                  <b-form-input type="text" placeholder="INGRESE ACTIVIDAD" v-model="form.actividad" />
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("actividad", "") }}</p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="ciudad_origen" v-slot="{ errors }">
                <b-form-group label="CIUDAD DE ORIGEN">
                  <b-form-input type="text" placeholder="INGRESE CIUDAD DE ORIGEN" v-model="form.ciudad_origen" />
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("ciudad_origen", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="pais_origen" v-slot="{ errors }">
                <b-form-group label="PAIS DE ORIGEN">
                  <b-form-select plain v-model="form.pais_origen" :options="null" class="mb-3"><template v-slot:first>
                      <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                    </template></b-form-select>
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("pais_origen", "") }}</p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="fecha_llegada" v-slot="{ errors }">
                <b-form-group label="FECHA DE LLEGADA AL PAIS">
                  <b-form-input type="date" placeholder="INGRESE FECHA DE LLEGADA AL PAIS" v-model="form.fecha_llegada" />
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("fecha_llegada", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="intencion_ciudad" v-slot="{ errors }">
                <b-form-group label="FECHA DE LLEGADA AL PAIS">
                  <b-form-input type="date" placeholder="INGRESE FECHA DE LLEGADA AL PAIS" v-model="form.intencion_ciudad" />
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("intencion_ciudad", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="respuesta_intencion" v-slot="{ errors }">
                <b-form-group label="FECHA DE LLEGADA AL PAIS">
                  <b-form-input type="date" placeholder="INGRESE FECHA DE LLEGADA AL PAIS"
                    v-model="form.respuesta_intencion" />
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">
                    {{ errors[0].replace("respuesta_intencion", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="discapacidad" v-slot="{ errors }">
                <b-form-group label="TIENE ALGUNA DISCAPACIDAD">
                  <b-form-select plain v-model="form.discapacidad" :options="null" class="mb-3"><template v-slot:first>
                      <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                    </template></b-form-select>
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("discapacidad", "") }}</p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="salud" v-slot="{ errors }">
                <b-form-group label="TIENE SISTEMA DE SALUD">
                  <b-form-select plain v-model="form.salud" :options="null" class="mb-3"><template v-slot:first>
                      <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                    </template></b-form-select>
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("salud", "") }}</p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="estudia_actualmente" v-slot="{ errors }">
                <b-form-group label="SE ENCUENTRA ESTUDIANDO ACTUALMENTE">
                  <b-form-select plain v-model="form.estudia_actualmente" :options="null" class="mb-3">
                    <template v-slot:first>
                      <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                    </template></b-form-select>
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">
                    {{ errors[0].replace("estudia_actualmente", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="nivel_escolaridad" v-slot="{ errors }">
                <b-form-group label="NIVEL DE ESCOLARIDAD">
                  <b-form-select plain v-model="form.nivel_escolaridad" :options="null" class="mb-3"><template v-slot:first>
                      <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                    </template></b-form-select>
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">
                    {{ errors[0].replace("nivel_escolaridad", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="tipo_profesion" v-slot="{ errors }">
                <b-form-group label="PROFESIONAL EN ?">
                  <b-form-input type="text" placeholder="INGRESE PROFESIONAL EN ?" v-model="form.tipo_profesion" />
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("tipo_profesion", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="comunidad_lgtbi" v-slot="{ errors }">
                <b-form-group label="POBLACIÓN LGTBI">
                  <b-form-input type="text" placeholder="INGRESE POBLACIÓN LGTBI" v-model="form.comunidad_lgtbi" />
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("comunidad_lgtbi", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="comunidad_etnica" v-slot="{ errors }">
                <b-form-group label="PERTENECE ALGUNA COMUNA ETNICA ?">
                  <b-form-input type="text" placeholder="INGRESE PERTENECE ALGUNA COMUNA ETNICA ?"
                    v-model="form.comunidad_etnica" />
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("comunidad_etnica", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="trabajo" v-slot="{ errors }">
                <b-form-group label="ACTUALMENTE SE ENCUENTRA LABORANDO">
                  <b-form-select plain v-model="form.trabajo" :options="null" class="mb-3"><template v-slot:first>
                      <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                    </template></b-form-select>
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("trabajo", "") }}</p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="tipo_empleo" v-slot="{ errors }">
                <b-form-group label="TIPO DE EMPLEO">
                  <b-form-select plain v-model="form.tipo_empleo" :options="null" class="mb-3"><template v-slot:first>
                      <b-form-select-option :value="null">Seleccione un registro</b-form-select-option>
                    </template></b-form-select>
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("tipo_empleo", "") }}</p>
                </b-form-group>
              </ValidationProvider>

              <ValidationProvider name="observaciones" v-slot="{ errors }">
                <b-form-group label="OBSERVACIONES">
                  <b-form-textarea type="textarea" placeholder="INGRESE OBSERVACIONES" v-model="form.observaciones" />
                  <p class="text-red-500 text-sm italic" v-if="errors[0]">{{ errors[0].replace("observaciones", "") }}
                  </p>
                </b-form-group>
              </ValidationProvider>
            </tab-content>
            <tab-content title="Núcleo Familiar" icon="fas fa-user-friends">
              Yuhuuu! This seems pretty damn simple
            </tab-content>
            <tab-content title="Finalizar" icon="fa fa-check">
              Yuhuuu! This seems pretty damn simple
            </tab-content>
          </form-wizard>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";

export default {
  components: {
    FormWizard,
    TabContent,
  },
  data: () => ({
    form: {},
  }),
  methods: {
    onComplete: function () {
      alert('Yay. Done!');
    }
  }
};
</script>
