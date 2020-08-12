import Swal from "sweetalert2";

export default {
  async consultarEstadisticas({ commit }, payload) {
    try {
      let res = await this.$axios.get("/api/datosgenerales");
      commit("CONSULTAR_ESTADISTICAS", res.data.data);
    } catch (error) {
      console.log(error);
    }
  },
};
