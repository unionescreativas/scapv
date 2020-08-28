import Swal from "sweetalert2";

export default {
  async consultarCiudadano({ commit }, payload) {
    try {
      let res = await this.$axios.get(`/api/ciudadanos/${payload}`);
      if (res.data.data != "no existe") {
        commit("CONSULTAR_CIUDADANO", res.data.data);
      } else {
        res = await this.$axios.get(`/api/familias/${payload}`);
        if (res.data.data != "no existe") {
          res = await this.$axios.get(`/api/ciudadanos/${res.data.data[0].ciudadano_id}`);
        }
        commit("CONSULTAR_CIUDADANO", res.data.data);
      }
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
            // SI LA ACCIÓN ES REGISTRAR SE REINICIA EL FORMULARIO
            if (method == "post") {
              commit("GUARDAR_CIUDADANO", res.data.data);
              payload.$refs.formWizard.reset();
              payload.resetFormVeeValidate(payload);
            }
          }
        });
      }
    } catch (err) {
      Swal.fire({
        html: "<h4>No se pudieron guardar los datos, consulte con el administrador!</h4>",
        icon: "error",
        allowOutsideClick: false,
        allowEscapeKey: false,
      });
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
          payload.$parent.$refs.tablaIntegrantes.reloadDataTable();
          // SI LA ACCIÓN ES REGISTRAR SE REINICIA EL FORMULARIO
          if (method == "post") {
            payload.resetFormVeeValidate(payload);
          }
        }
      });
    } catch (err) {
      let status = err.response.status;
      let errors = err.response.data.errors;
      // ERROR DEL CLIENTE
      if (status <= 499) {
        if (errors) {
          payload.$refs.observer.setErrors(err.response.data.errors);
          Swal.fire({
            html: "<h4>Por favor revise los campos en rojo!</h4>",
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
        }
        // ERROR DEL SERVIDOR
      } else {
        Swal.fire({
          html: "<h4>No se pudieron guardar los datos, consulte con el administrador!</h4>",
          icon: "error",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      }
    }
  },
};
