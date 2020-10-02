<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <div>
          <gmap-map :center="center" :zoom="15" style="width: 100%; height: 500px;">
            <gmap-info-window
              :options="infoOptions"
              :position="infoWindowPos"
              :opened="infoWinOpen"
              @closeclick="infoWinOpen = false"
            ></gmap-info-window>
            <gmap-marker
              :icon="m.icon"
              :key="i"
              v-for="(m, i) in markers"
              :position="m.position"
              :clickable="true"
              @click="toggleInfoWindow(m, i)"
            ></gmap-marker>
          </gmap-map>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
export default {
  layout: "LightLayout",
  data() {
    return {
      // Mapas-------------------->
      center: {
        lat: 47.376332,
        lng: 8.547511,
      },
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
      markers: [],
      // Mapas-------------------->
    };
  },
  methods: {
    async consultarDatos() {
      let iconBase = "http://maps.google.com/mapfiles/kml/shapes/";
      let icons = {
        pendiente: {
          icon: iconBase + "caution.png",
        },
        entregado: {
          icon: iconBase + "ranger_station.png",
        },
      };
      try {
        let consulta;
        let listas = {};
        let res = await this.$axios.get(`/api/ciudadanos?length=all`);
        consulta = res.data.data;
        // console.log(consulta);
        let tipodeicono;
        consulta.forEach((item, index) => {
          if (consulta[index].lat > 0) {
            this.center.lat = consulta[index].lat;
            this.center.lng = consulta[index].let;
            // console.log(consulta[index].ayudas.length);
            if (consulta[index].ayudas.length > 0) {
              tipodeicono = icons.entregado.icon;
            } else {
              tipodeicono = icons.pendiente.icon;
            }
            listas = {
              position: {
                lat: consulta[index].lat,
                lng: consulta[index].let,
              },
              icon: tipodeicono,
              infoText: `<div id="bodyContent">
              <p><b>Familia</b> : ${consulta[index].nombres} ${consulta[index].apellidos} </p>
              <p><b>Documento</b> : ${consulta[index].numero_documento} </p>
              <p><b>Dirreción</b>  : ${consulta[index].direccion}  </p>
              <p><b>Pais de Origen</b>  : ${consulta[index].pais_origen} </p>
              <p>Ir a <a  target="_blank" href="https://www.google.com/maps/place/${consulta[index].lat} +  ${consulta[index].let}">
               Ubicación </a>  </p>
               </div> `,
            };
            this.markers.push(listas);
          }
        });
        // if(consulta)
      } catch (err) {
        console.log(err);
      }
    },
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
  mounted() {
    this.consultarDatos();
    vito.mainIndex();
  },
};
</script>

<style lang="scss" scoped></style>
