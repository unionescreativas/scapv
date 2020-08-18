import Swal from "sweetalert2";

export default {
  async consultarListas({ commit }, payload) {
    try {
      let lista = payload.lista ? payload.lista : "";
      let search = payload.search ? payload.search : "";
      let res = await this.$axios.get(`/api/listas/${lista}?search=${search}`);
      commit("CONSULTAR_LISTAS", res.data.data);
    } catch (error) {
      console.log(error);
    }
  },
};
