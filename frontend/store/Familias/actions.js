import Swal from "sweetalert2";

export default {
  async consultarCiudadano({ commit }, payload) {
    let res = await this.$axios.get(`/api/ciudadanos/${payload}`);
    commit("CONSULTAR_CIUDADANO", res.data.data);
  },
};
