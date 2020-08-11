import Swal from "sweetalert2";

export default {
  async consultarEstadisticas({ commit }, payload) {
    let estadisticas = null;
    let res = await this.$axios.get("/api/datosgenerales");
    console.log(res);
    // commit("ASIGNAR_CIUDADANO", estadisticas);
  },
};
