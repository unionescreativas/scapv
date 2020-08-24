import Swal from "sweetalert2";

export default {
  async consultarListas({ commit }, payload) {
    try {
      let lista = payload.lista ? payload.lista : "";
      let search = payload.search ? payload.search : "";
      let res = await this.$axios.get(`/api/listas/${lista}?search=${search}`);
      commit("CONSULTAR_LISTAS", res.data.data);
    } catch (err) {
      console.log(err);
    }
  },

  async registrarLista({ commit }, payload) {
    try {
      let res = await this.$axios.post("/api/listas", payload.form);

      Swal.fire({
        html: `<h4>El registro se ha realizado con éxito!</h4>`,
        icon: "success",
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.value) {
          $nuxt.resetFormVeeValidate(payload);
        }
      });
    } catch (err) {
      if (Object.keys(err.response.data.errors).length) {
        payload.$refs.observer.setErrors(err.response.data.errors);
        Swal.fire({
          html: "<h4>Por favor revise los campos en rojo!</h4>",
          icon: "warning",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      }
    }
  },
};
