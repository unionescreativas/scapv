import Swal from "sweetalert2";

export default {
  async consultarListas({ commit }, payload) {
    try {
      let res = await this.$axios.get(`/api/listas/${payload}`);
      commit("CONSULTAR_LISTAS", res.data.data);
    } catch (error) {
      console.log(error);
    }
  },
};
