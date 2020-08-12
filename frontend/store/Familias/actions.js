import Swal from "sweetalert2";

export default {
  async consultarCiudadano({ commit }, payload) {
    try {
      let res = await this.$axios.get(`/api/ciudadanos/${payload}`);
      commit("CONSULTAR_CIUDADANO", res.data.data);
    } catch (error) {
      console.log(error);
    }
  },
  async guardarCiudadano({ commit }, payload) {
    try {
      let url = "/api/ciudadanos";
      let mensaje = "El registro se ha realizado con éxito!";

      if (payload.ciudadano != "no existe") {
        url = `/api/ciudadanos/${payload.ciudadano[0].id}`;
        mensaje = "El registro se ha actualizado con éxito!";
      }
      
      let res = await this.$axios.post("/api/ciudadanos", payload.form);
      Swal.fire({
        title: "el registro se ha realizado con éxito!",
        icon: "success",
        allowOutsideClick: false,
        allowEscapeKey: false,
      }).then((result) => {
        if (result.value) {
          // $nuxt.resetFormVeeValidate(payload);
        }
      });
    } catch (error) {
      console.log(error.response.data)
      // payload.$refs.observer.setErrors(err.response.data.errors);
    }
  },
};
