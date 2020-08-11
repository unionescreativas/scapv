import Swal from "sweetalert2";

export default {
  async consultarEstadisticas({ commit }, payload) {
    let res = await this.$axios.get("/api/datosgenerales");
    commit("CONSULTAR_ESTADISTICAS", res.data.data);
  },
};
