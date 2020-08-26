import Swal from "sweetalert2";

export default {
  async consultarCiudadano({ commit }, payload) {
    try {
      let res = await this.$axios.get(`/api/ciudadanos/${payload}`);
      commit("CONSULTAR_CIUDADANO", res.data.data);
    } catch (error) {
      console.error(error);
    }
  },

  async consultarCiudadanos({ commit }) {
    try {
      let res = await this.$axios.get("/api/ciudadanos/");
      commit("CONSULTAR_CIUDADANOS", res.data.data);
    } catch (error) {
      console.error(error);
    }
  },

  async guardarCiudadano({ commit, dispatch }, payload) {
    try {
      let url = "/api/ciudadanos";
      let method = "post";
      let data = payload.form;
      let mensajeGuardar = "El registro se ha realizado con éxito!";

      if (data.id) {
        url = `/api/ciudadanos/${data.id}`;
        method = "put";
        mensajeGuardar = "El registro se ha actualizado con éxito!";
      }

      if (!payload.$refs.formWizard.isLastStep) {
        Swal.fire({
          html: "<h4>Desea guardar los cambios hasta aquí?</h4>",
          icon: "info",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Si",
          cancelButtonColor: "#d33",
          cancelButtonText: "No",
          showCancelButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
        }).then(async (result) => {
          if (result.value) {
            let res = await this.$axios({ method, url, data });

            Swal.fire({
              html: `<h4>${mensajeGuardar}</h4>`,
              icon: "success",
              allowOutsideClick: false,
              allowEscapeKey: false,
            }).then((result) => {
              if (result.value) {
                commit("GUARDAR_CIUDADANO", res.data.data);
              }
            });
          } else {
            payload.$refs.formWizard.nextTab();
          }
        });
      } else {
        let res = await this.$axios({ method, url, data });

        Swal.fire({
          html: `<h4>${mensajeGuardar}</h4>`,
          icon: "success",
          allowOutsideClick: false,
          allowEscapeKey: false,
        }).then((result) => {
          if (result.value) {
            if (method == "post") {
              commit("GUARDAR_CIUDADANO", res.data.data);
              $nuxt.resetFormVeeValidate(payload);
              payload.$refs.formWizard.reset();
            }
          }
        });
      }
    } catch (err) {
      console.error(err);
    }
  },

  async guardarIntegranteFamilia({ commit }, payload) {
    try {
      let url = "/api/familias";
      let method = "post";
      let data = payload.form;
      let mensajeGuardar = "El registro se ha realizado con éxito!";

      if (data.id) {
        url = `/api/familias/${data.id}`;
        method = "put";
        mensajeGuardar = "El registro se ha actualizado con éxito!";
      }

      let res = await this.$axios({ method, url, data });

      Swal.fire({
        html: `<h4>${mensajeGuardar}</h4>`,
        icon: "success",
        allowOutsideClick: false,
        allowEscapeKey: false,
      }).then((result) => {
        if (result.value) {
          commit("GUARDAR_INTEGRANTE_FAMILIA", res.data.data);
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
