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
                          <b-img
                            v-bind:src="user.profile"
                            alt="profile-img"
                            fluid
                            class="avatar-130"
                          />
                        </div>
                      </div>
                    </div>
                  </b-col>

                  <b-col cols="12">
                    <tab-nav
                      :pills="true"
                      id="pills-tab"
                      class="profile-feed-items d-flex justify-content-end"
                    >
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
                    </tab-nav>
                  </b-col>
                </b-row>
                <b-row>
                  <b-col md="12" sm="12">
                    <div class="user-detail pl-5">
                      <div class="d-flex flex-wrap align-items-center">
                        <div class="profile-detail d-flex align-items-center">
                          <h3 v-text="nombres+''+apellidos"></h3>
                          <p v-text="pais_origen" class="m-0 pl-3"></p>
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
          <tab-content-item
            :active="true"
            id="informacion-personal"
            aria-labelled-by="informacion-personal"
          >
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
                          <b-form-input type="text" :value="tipo_documento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="NUMERO DE DOCUMENTO" label-for="exampleInputText3">
                          <b-form-input type="text" :value="numero_documento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group
                          label="# PERMISO ESPECIAL DE PERMANENCIA"
                          label-for="exampleInputText4"
                        >
                          <b-form-input type="text" :value="pep" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="NOMBRES" label-for="exampleInputText5">
                          <b-form-input type="text" :value="nombres" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="APELLIDOS" label-for="exampleInputText6">
                          <b-form-input type="text" :value="apellidos" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group
                          label="FECHA DE EXPEDICION DEL DOCUMENTO"
                          label-for="exampleInputText7"
                        >
                          <b-form-input type="text" :value="fecha_expedicion" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group
                          label="FECHA DE VENCIMIENTO DEL DOCUMENTO"
                          label-for="exampleInputText8"
                        >
                          <b-form-input type="text" :value="fecha_vencimiento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="FECHA DE NACIMIENTO" label-for="exampleInputText9">
                          <b-form-input type="text" :value="fecha_nacimiento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="EDAD" label-for="exampleInputText10">
                          <b-form-input type="text" :value="edad" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="GENERO" label-for="exampleInputText11">
                          <b-form-input type="text" :value="genero" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="ESTADO CIVIL" label-for="exampleInputText12">
                          <b-form-input type="text" :value="estado_civil" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="TELEFONO" label-for="exampleInputText13">
                          <b-form-input type="text" :value="telefono" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="CELULAR" label-for="exampleInputText14">
                          <b-form-input type="text" :value="celular" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="CORREO ELECTRONICO" label-for="exampleInputText15">
                          <b-form-input type="text" :value="correo_electronico" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group
                          label="DEPARTAMENTO DE RESIDENCIA"
                          label-for="exampleInputText16"
                        >
                          <b-form-input type="text" :value="departamento" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="CIUDAD DE RESIDENCIA" label-for="exampleInputText17">
                          <b-form-input type="text" :value="ciudad" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group label="BARRIO DE RESIDENCIA" label-for="exampleInputText18">
                          <b-form-input type="text" :value="barrrio" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col>
                        <b-form-group label="COMUNA DE RESIDENCIA" label-for="exampleInputText19">
                          <b-form-input type="text" :value="comuna" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row>
                      <b-col>
                        <b-form-group
                          label="DIRRECION DE RESIDENCIA"
                          label-for="exampleInputText20"
                        >
                          <b-form-input type="text" :value="dirrecion" disabled></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                  </b-form>
                </div>
              </template>
            </iq-card>
          </tab-content-item>

          <tab-content-item
            :active="false"
            id="otra-informacion"
            aria-labelled-by="otra-informacion"
          >
            <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title">Otra Información</h4>
              </template>
              <template v-slot:body>
                <div>
                  <b-row>
                    <b-col>
                      <b-form-group label="ACTIVIDAD" label-for="exampleInputText23">
                        <b-form-input type="text" :value="actividad" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="CIUDAD DE ORIGEN" label-for="exampleInputText24">
                        <b-form-input type="text" :value="ciudad_origen" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="PAIS DE ORIGEN" label-for="exampleInputText25">
                        <b-form-input type="text" :value="pais_origen" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="FECHA DE LLEGADA AL PAIS" label-for="exampleInputText26">
                        <b-form-input type="text" :value="fecha_llegada" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="FECHA DE LLEGADA AL PAIS" label-for="exampleInputText27">
                        <b-form-input type="text" :value="intencion_ciudad" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="FECHA DE LLEGADA AL PAIS" label-for="exampleInputText28">
                        <b-form-input type="text" :value="respuesta_intencion" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group
                        label="TIENE ALGUNA DISCAPACIDAD"
                        label-for="exampleInputText29"
                      >
                        <b-form-input type="text" :value="discapacidad" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="TIENE SISTEMA DE SALUD" label-for="exampleInputText30">
                        <b-form-input type="text" :value="salud" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group
                        label="SE ENCUENTRA ESTUDIANDO ACTUALMENTE"
                        label-for="exampleInputText31"
                      >
                        <b-form-input type="text" :value="estudia_actualmente" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="NIVEL DE ESCOLARIDAD" label-for="exampleInputText32">
                        <b-form-input type="text" :value="nivel_escolaridad" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="PROFESIONAL EN ?" label-for="exampleInputText33">
                        <b-form-input type="text" :value="tipo_profesion" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="POBLACIÓN LGTBI" label-for="exampleInputText34">
                        <b-form-input type="text" :value="comunidad_lgtbi" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group
                        label="PERTENECE ALGUNA COMUNA ETNICA ?"
                        label-for="exampleInputText35"
                      >
                        <b-form-input type="text" :value="comunidad_etnica" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group
                        label="ACTUALMENTE SE ENCUENTRA LABORANDO"
                        label-for="exampleInputText36"
                      >
                        <b-form-input type="text" :value="trabajo" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-row>
                    <b-col>
                      <b-form-group label="TIPO DE EMPLEO" label-for="exampleInputText37">
                        <b-form-input type="text" :value="tipo_empleo" disabled></b-form-input>
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <b-form-group label="OBSERVACIONES" label-for="exampleInputText38">
                        <b-form-input type="text" :value="observaciones" disabled></b-form-input>
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
                        :customSegmentStops="[0, 33,66, 100]"
                        :segmentColors="['#ffdf7e', '#b8daff','#ed969e']"
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
                  <gmap-map :center="center" :zoom="15" style="width: 100%; height: 500px">
                    <gmap-info-window
                      :options="infoOptions"
                      :position="infoWindowPos"
                      :opened="infoWinOpen"
                      @closeclick="infoWinOpen=false"
                    ></gmap-info-window>
                    <gmap-marker
                      :key="i"
                      v-for="(m,i) in markers"
                      :position="m.position"
                      :clickable="true"
                      @click="toggleInfoWindow(m,i)"
                    ></gmap-marker>
                  </gmap-map>
                </div>
              </template>
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
  data: () => ({
    urlEditar: "",
    user: {
      profile: require("~/assets/images/user/avatar.png"),
      name: "Nik Jone",
      role: " - Web designer",
      about: "Lorem ipsum dolor sit amet, contur adipiscing elit.",
      email: "nikjone@demoo.com",
      phone: "001 2351 256 12",
      location: "USA",
      careated_date: "07 Jan 2020",
    },
    center: {
      lat: 3.4329038000000005,
      lng: -76.4729033,
    },
    infoWindowPos: null,
    infoWinOpen: false,
    currentMidx: null,
    infoOptions: {
      content: "",
      //optional: offset infowindow so it visually sits nicely on top of our marker
      pixelOffset: {
        width: 0,
        height: -35,
      },
    },
    markers: [
      {
        position: {
          lat: 3.4329038000000005,
          lng: -76.4729033,
        },
        infoText: "",
      },
    ],
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
    ],

    // Datos Ciudadano--------------------------------------->
    id: "",
    tipo_documento: "",
    numero_documento: "",
    pep: "",
    nombres: "",
    apellidos: "",
    fecha_expedicion: "",
    fecha_vencimiento: "",
    fecha_nacimiento: "",
    edad: "",
    genero: "",
    estado_civil: "",
    telefono: "",
    celular: "",
    correo_electronico: "",
    departamento: "",
    ciudad: "",
    barrrio: "",
    comuna: "",
    dirrecion: "",
    lat: "",
    let: "",
    actividad: "",
    ciudad_origen: "",
    pais_origen: "",
    fecha_llegada: "",
    intencion_ciudad: "",
    respuesta_intencion: "",
    discapacidad: "",
    salud: "",
    estudia_actualmente: "",
    nivel_escolaridad: "",
    tipo_profesion: "",
    comunidad_lgtbi: "",
    comunidad_etnica: "",
    trabajo: "",
    tipo_empleo: "",
    observaciones: "",
  }),
  computed: {
    ciudadano() {
      return this.$store.state.Familias.ciudadano;
    },
  },
  methods: {
    consultaCiudadano() {
      this.id = this.ciudadano[0].id;
      this.urlEditar = "/actualizar/" + this.ciudadano[0].id;
      this.tipo_documento = this.ciudadano[0].tipo_documento;
      this.numero_documento = this.ciudadano[0].numero_documento;
      this.pep = this.ciudadano[0].pep;
      this.nombres = this.ciudadano[0].nombres.replace(/\b[a-z]/g, (c) =>
        c.toUpperCase()
      );
      this.apellidos = this.ciudadano[0].apellidos;
      this.fecha_expedicion = this.ciudadano[0].fecha_expedicion;
      this.fecha_vencimiento = this.ciudadano[0].fecha_vencimiento;
      this.fecha_nacimiento = this.ciudadano[0].fecha_nacimiento;
      this.edad = this.ciudadano[0].edad;
      this.genero = this.ciudadano[0].genero;
      this.estado_civil = this.ciudadano[0].estado_civil;
      this.telefono = this.ciudadano[0].telefono;
      this.celular = this.ciudadano[0].celular;
      this.correo_electronico = this.ciudadano[0].correo_electronico;
      this.departamento = this.ciudadano[0].departamento;
      this.ciudad = this.ciudadano[0].ciudad;
      this.barrrio = this.ciudadano[0].barrrio;
      this.comuna = this.ciudadano[0].comuna;
      this.dirrecion = this.ciudadano[0].dirrecion;
      this.actividad = this.ciudadano[0].actividad;
      this.ciudad_origen = this.ciudadano[0].ciudad_origen;
      this.pais_origen = this.ciudadano[0].pais_origen.replace(
        /\b[a-z]/g,
        (c) => c.toUpperCase()
      );
      this.fecha_llegada = this.ciudadano[0].fecha_llegada;
      this.intencion_ciudad = this.ciudadano[0].intencion_ciudad;
      this.respuesta_intencion = this.ciudadano[0].respuesta_intencion;
      this.discapacidad = this.ciudadano[0].discapacidad;
      this.salud = this.ciudadano[0].salud;
      this.estudia_actualmente = this.ciudadano[0].estudia_actualmente;
      this.nivel_escolaridad = this.ciudadano[0].nivel_escolaridad;
      this.tipo_profesion = this.ciudadano[0].tipo_profesion;
      this.comunidad_lgtbi = this.ciudadano[0].comunidad_lgtbi;
      this.comunidad_etnica = this.ciudadano[0].comunidad_etnica;
      this.trabajo = this.ciudadano[0].trabajo;
      this.tipo_empleo = this.ciudadano[0].tipo_empleo;
      this.observaciones = this.ciudadano[0].observaciones;
      this.markers[0].infoText = `Dirreción : ${this.ciudadano[0].dirrecion} , Comuna : ${this.ciudadano[0].comuna} `;
    },
    toggleInfoWindow: function (marker, idx) {
      this.infoWindowPos = marker.position;
      this.infoOptions.content = marker.infoText;

      //check if its the same marker that was selected if yes toggle
      if (this.currentMidx == idx) {
        this.infoWinOpen = !this.infoWinOpen;
      }
      //if different marker set infowindow to open and reset current marker index
      else {
        this.infoWinOpen = true;
        this.currentMidx = idx;
      }
    },
  },
  mounted() {
    console.log(this.ciudadano);
    if (this.ciudadano) {
      vito.index();
      this.consultaCiudadano();
    } else {
      $nuxt.$router.push("/estadisticas");
    }
  },
};
</script>
