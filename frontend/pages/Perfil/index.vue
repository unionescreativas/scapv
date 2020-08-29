<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <iq-card body-class=" profile-page p-0">
          <template v-slot:body>
            <div class="profile-header">
              <div class="cover-container">
                <!-- <action-user /> -->
                <ul class="header-nav d-flex flex-wrap justify-end p-0 m-0">
                  <li>
                    <nuxt-link :to="urlEditar">
                      <i class="ri-pencil-line"></i>
                    </nuxt-link>
                  </li>
                  <li>
                    <b-link href="javascript:void(0);">
                      <i class="ri-settings-4-line"></i>
                    </b-link>
                  </li>
                </ul>
              </div>

              <div class="profile-info mt-5 p-4">
                <b-row>
                  <b-col cols="6">
                    <div class="user-detail pl-5">
                      <div class="d-flex flex-wrap align-items-center">
                        <div class="profile-img pr-4">
                          <b-img v-bind:src="user.profile" alt="profile-img" fluid class="avatar-130" />
                        </div>
                      </div>
                    </div>
                  </b-col>

                  <b-col cols="12">
                    <tab-nav :pills="true" id="pills-tab" class="profile-feed-items d-flex justify-content-end">
                      <tab-nav-items
                        :active="true"
                        id="pills-feed-tab"
                        href="#informacion-personal"
                        role="tab"
                        :ariaSelected="true"
                        title="Información Personal"
                      />
                      <tab-nav-items
                        :active="false"
                        id="pills-activity-tab"
                        href="#otra-informacion"
                        role="tab"
                        :ariaSelected="false"
                        title="Otra Información"
                      />
                      <tab-nav-items
                        :active="false"
                        id="pills-activity-tab"
                        href="#nivel-riesgo"
                        role="tab"
                        :ariaSelected="false"
                        title="Nivel de Riesgo"
                      />
                      <tab-nav-items
                        :active="false"
                        id="pills-activity-tab"
                        href="#maps"
                        role="tab"
                        :ariaSelected="false"
                        title="Georeferenciacion"
                      />
                      <tab-nav-items
                        :active="false"
                        id="pills-activity-tab"
                        href="#docs"
                        role="tab"
                        :ariaSelected="false"
                        title="Docs"
                      />
                    </tab-nav>
                  </b-col>
                </b-row>
                <b-row>
                  <b-col md="12" sm="12">
                    <div class="user-detail pl-5">
                      <div class="d-flex flex-wrap align-items-center">
                        <div class="profile-detail d-flex align-items-center">
                          <h3 v-text="ciudadano.nombre_completo"></h3>
                          <p v-text="ciudadano.pais_origen" class="m-0 pl-3"></p>
                        </div>
                      </div>
                    </div>
                  </b-col>
                </b-row>
              </div>
            </div>
          </template>
        </iq-card>
      </b-col>
    </b-row>

    <b-row>
      <b-col sm="12">
        <tab-content>
          <tab-content-item :active="true" id="informacion-personal" aria-labelled-by="informacion-personal">
            <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title">Información Personal</h4>
              </template>
              <template v-slot:body>
                <div>
                  <b-form>
                    <b-row>
                      <b-col>
                        <b-form-group label="TIPO DE DOCUMENTO" label-for="exampleInputText2">
                          <b-form-input type="text" :value="ciudadano.tipo_documento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="NUMERO DE DOCUMENTO" label-for="exampleInputText3">
                          <b-form-input type="text" :value="ciudadano.numero_documento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="# PERMISO ESPECIAL DE PERMANENCIA" label-for="exampleInputText4">
                          <b-form-input type="text" :value="ciudadano.pep" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="NOMBRES" label-for="exampleInputText5">
                          <b-form-input type="text" :value="ciudadano.nombres" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="APELLIDOS" label-for="exampleInputText6">
                          <b-form-input type="text" :value="ciudadano.apellidos" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="FECHA DE EXPEDICION DEL DOCUMENTO" label-for="exampleInputText7">
                          <b-form-input type="text" :value="ciudadano.fecha_expedicion" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="FECHA DE VENCIMIENTO DEL DOCUMENTO" label-for="exampleInputText8">
                          <b-form-input type="text" :value="ciudadano.fecha_vencimiento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="FECHA DE NACIMIENTO" label-for="exampleInputText9">
                          <b-form-input type="text" :value="ciudadano.fecha_nacimiento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="EDAD" label-for="exampleInputText10">
                          <b-form-input type="text" :value="ciudadano.edad" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="GENERO" label-for="exampleInputText11">
                          <b-form-input type="text" :value="ciudadano.genero" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="ESTADO CIVIL" label-for="exampleInputText12">
                          <b-form-input type="text" :value="ciudadano.estado_civil" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="TELEFONO" label-for="exampleInputText13">
                          <b-form-input type="text" :value="ciudadano.telefono" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="CELULAR" label-for="exampleInputText14">
                          <b-form-input type="text" :value="ciudadano.celular" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="CORREO ELECTRONICO" label-for="exampleInputText15">
                          <b-form-input type="text" :value="ciudadano.correo_electronico" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="DEPARTAMENTO DE RESIDENCIA" label-for="exampleInputText16">
                          <b-form-input type="text" :value="ciudadano.departamento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="CIUDAD DE RESIDENCIA" label-for="exampleInputText17">
                          <b-form-input type="text" :value="ciudadano.ciudad" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="BARRIO DE RESIDENCIA" label-for="exampleInputText18">
                          <b-form-input type="text" :value="ciudadano.barrrio" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="COMUNA DE RESIDENCIA" label-for="exampleInputText19">
                          <b-form-input type="text" :value="ciudadano.comuna" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="DIRRECION DE RESIDENCIA" label-for="exampleInputText20">
                          <b-form-input type="text" :value="ciudadano.direccion" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                  </b-form>
                </div>
              </template>
            </iq-card>
          </tab-content-item>

          <tab-content-item :active="false" id="otra-informacion" aria-labelled-by="otra-informacion">
            <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title">Otra Información</h4>
              </template>
              <template v-slot:body>
                <div>
                  <b-row>
                    <b-col>
                      <b-form-group label="ACTIVIDAD" label-for="exampleInputText23">
                        <b-form-input type="text" :value="ciudadano.actividad" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="CIUDAD DE ORIGEN" label-for="exampleInputText24">
                        <b-form-input type="text" :value="ciudadano.ciudad_origen" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="PAIS DE ORIGEN" label-for="exampleInputText25">
                        <b-form-input type="text" :value="ciudadano.pais_origen" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="FECHA DE LLEGADA AL PAIS" label-for="exampleInputText26">
                        <b-form-input type="text" :value="ciudadano.fecha_llegada" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="FECHA DE LLEGADA AL PAIS" label-for="exampleInputText27">
                        <b-form-input type="text" :value="ciudadano.intencion_ciudad" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="FECHA DE LLEGADA AL PAIS" label-for="exampleInputText28">
                        <b-form-input type="text" :value="ciudadano.respuesta_intencion" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="TIENE ALGUNA DISCAPACIDAD" label-for="exampleInputText29">
                        <b-form-input type="text" :value="ciudadano.discapacidad" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="TIENE SISTEMA DE SALUD" label-for="exampleInputText30">
                        <b-form-input type="text" :value="ciudadano.salud" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="SE ENCUENTRA ESTUDIANDO ACTUALMENTE" label-for="exampleInputText31">
                        <b-form-input type="text" :value="ciudadano.estudia_actualmente" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="NIVEL DE ESCOLARIDAD" label-for="exampleInputText32">
                        <b-form-input type="text" :value="ciudadano.nivel_escolaridad" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="PROFESIONAL EN ?" label-for="exampleInputText33">
                        <b-form-input type="text" :value="ciudadano.tipo_profesion" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="POBLACIÓN LGTBI" label-for="exampleInputText34">
                        <b-form-input type="text" :value="ciudadano.comunidad_lgtbi" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="PERTENECE ALGUNA COMUNIDAD ETNICA ?" label-for="exampleInputText35">
                        <b-form-input type="text" :value="ciudadano.comunidad_etnica" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="ACTUALMENTE SE ENCUENTRA LABORANDO" label-for="exampleInputText36">
                        <b-form-input type="text" :value="ciudadano.trabajo" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="TIPO DE EMPLEO" label-for="exampleInputText37">
                        <b-form-input type="text" :value="ciudadano.tipo_empleo" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="OBSERVACIONES" label-for="exampleInputText38">
                        <b-form-input type="text" :value="ciudadano.observaciones" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                </div>
              </template>
            </iq-card>
          </tab-content-item>
          <tab-content-item :active="false" id="nivel-riesgo" aria-labelled-by="otra-informacion">
            <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title">Nivel de Riesgo</h4>
              </template>
              <template v-slot:body>
                <div>
                  <b-row>
                    <b-col cols="4">
                      <vue-speedometer
                        :minValue="0"
                        :maxValue="100"
                        :customSegmentStops="[0, 33, 66, 100]"
                        :segmentColors="['#ffdf7e', '#b8daff', '#ed969e']"
                        :value="40"
                      />
                      <h2>NIVEL DE RIESGO: MEDIO</h2>
                      <h4>40%</h4>
                    </b-col>
                    <b-col cols="8">
                      <b-table hover :items="items"></b-table>
                    </b-col>
                  </b-row>
                </div>
              </template>
            </iq-card>
          </tab-content-item>
          <tab-content-item :active="false" id="maps" aria-labelled-by="otra-informacion">
            <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title">Georeferenciacion</h4>
              </template>
              <template v-slot:body>
                <div>
                  <gmap-map
                    v-for="(m, i) in markers"
                    :key="i"
                    :center="m.position"
                    :zoom="15"
                    style="width: 100%; height: 500px;"
                  >
                    <gmap-info-window
                      :options="infoOptions"
                      :position="infoWindowPos"
                      :opened="infoWinOpen"
                      @closeclick="infoWinOpen = false"
                    ></gmap-info-window>
                    <gmap-marker :position="m.position" :clickable="true" @click="toggleInfoWindow(m, i)"></gmap-marker>
                  </gmap-map>
                </div>
              </template>
            </iq-card>
          </tab-content-item>
          <tab-content-item :active="false" id="docs" aria-labelled-by="otra-informacion">
            <iq-card>
              <documentos :modulo="modulo" :moduloid="modulo_id"></documentos>
            </iq-card>
          </tab-content-item>
        </tab-content>
      </b-col>
      <familias />
      <ayudas />
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  layout: "LightLayout",
  name: "Perfil",
  data: () => ({
    // Modulo Documentos-------------------->
    modulo_id: "",
    modulo: "documentos",
    // Modulo Documentos-------------------->
    urlEditar: "",
    user: {
      profile: require("~/assets/images/user/avatar.png"),
    },
    // Mapas-------------------->
    infoWindowPos: null,
    infoWinOpen: false,
    currentMidx: null,
    infoOptions: {
      content: "",
      pixelOffset: {
        width: 0,
        height: -35,
      },
    },
    markers: [
      {
        position: {
          lat: 0,
          lng: 0,
        },
        infoText: "",
      },
    ],
    // Mapas-------------------->
    // Calificacion de riesgo-------------------->
    items: [
      {
        nivel: "BAJO",
        definicion:
          "Actualmente no se ha identificado ningún factor relevante de vulnerabilidad. El riesgo de daños de la persona parece bajo y manejable por medio de los factores de resiliencia actuales.",
        _rowVariant: "warning",
      },
      {
        nivel: "MEDIO",
        definicion:
          "Se podría desarrollar una vulnerabilidad importante si no se adoptan medidas de apoyo preventivas. Se recomienda una supervisión frecuente de la condición de vulnerabilidad.",
        _rowVariant: "primary",
      },
      {
        nivel: "ALTO",
        definicion:
          "Resulta evidente una vulnerabilidad importante. Se recomienda una evaluación de seguimiento y el desarrollo de un plan de atención. Se debe hacer referencia a la descripción que el entrevistador hace del riesgo de daños identificado y de la necesidad inmediata de apoyo",
        _rowVariant: "danger",
      },
      // Calificacion de riesgo-------------------->
    ],
  }),
  computed: {
    ciudadano() {
      let ciudadano = this.$store.state.Familias.ciudadano;
      let ciudadanoDatos = {};

      if (ciudadano && ciudadano != "no existe") {
        ciudadanoDatos = {
          ...ciudadano[0],
          nombres: _.startCase(_.camelCase(ciudadano[0].nombres)),
          apellidos: _.startCase(_.camelCase(ciudadano[0].apellidos)),
          nombre_completo: _.startCase(_.camelCase(`${ciudadano[0].nombres} ${ciudadano[0].apellidos}`)),
          pais_origen: _.startCase(_.camelCase(ciudadano[0].pais_origen)),
        };
      }

      this.modulo_id = ciudadanoDatos.id;
      this.markers[0].position.lat = Object.values(ciudadanoDatos).length ? ciudadanoDatos.lat : 0;
      this.markers[0].position.lng = Object.values(ciudadanoDatos).length ? ciudadanoDatos.let : 0;
      this.markers[0].infoText = Object.values(ciudadanoDatos).length
        ? `Dirreción : ${ciudadanoDatos.direccion} , Comuna : ${ciudadanoDatos.comuna} `
        : "";

      return ciudadanoDatos;
    },
  },
  methods: {
    toggleInfoWindow: function (marker, idx) {
      this.infoWindowPos = marker.position;
      this.infoOptions.content = marker.infoText;
      if (this.currentMidx == idx) {
        this.infoWinOpen = !this.infoWinOpen;
      } else {
        this.infoWinOpen = true;
        this.currentMidx = idx;
      }
    },
  },
};
</script>
