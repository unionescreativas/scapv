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
          Swal.fire({
            html: `<h4>El Ciudadano es Integrante de Familia del Nucleo Familiar de: ${res.data.data[0].nombres} ${res.data.data[0].apellidos}!</h4>`,
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
        }
        commit("CONSULTAR_CIUDADANO", res.data.data);
      }
    } catch (error) {
      console.error(error);
    }
  },

  async consultarCiudadanos({ commit }) {
    try {
      let res = await this.$axios.get("/api/ciudadanos");
      commit("CONSULTAR_CIUDADANOS", res.data.data);
    } catch (error) {
      console.error(error);
    }
  },

  async validarPestana({ dispatch }, payload) {
    try {
      let res = await this.$axios.post("/api/ciudadanosvalidar", payload.form);
      let errors = _.pick(res.data.data.errors, _.keys(payload.$refs.observer.fields));

      if (!Object.keys(errors).length) {
        if (!payload.$refs.formWizard.isLastStep) {
          if (payload.formChanged) {
            payload.formChanged = false;
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
            }).then((result) => {
              if (result.value) {
                dispatch("guardarCiudadano", payload);
              } else {
                payload.$refs.formWizard.nextTab();
              }
            });
          } else {
            payload.$refs.formWizard.nextTab();
          }
        } else {
          dispatch("guardarCiudadano", payload);
        }
      } else {
        payload.$refs.observer.setErrors(errors);
        Swal.fire({
          html: "<h4>Por favor revise los campos en rojo!</h4>",
          icon: "warning",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      }
    } catch (err) {
      console.error(err);
    }
  },

  async guardarCiudadano({ commit }, payload) {
    try {
      let url = "/api/ciudadanos";
      let method = "post";
      let data = payload.form;
      let mensajeGuardar = "El registro se ha realizado con éxito!";
      let ultimaPestana = payload.$refs.formWizard.isLastStep;

      if (data.id) {
        url = `/api/ciudadanos/${data.id}`;
        method = "put";
        mensajeGuardar = "El registro se ha actualizado con éxito!";
      }

      let res = await this.$axios({ method, url, data });
      commit("GUARDAR_CIUDADANO", [res.data.data]);

      Swal.fire({
        html: `<h4>${mensajeGuardar}</h4>`,
        icon: "success",
        allowOutsideClick: false,
        allowEscapeKey: false,
      }).then((result) => {
        if (result.value) {
          // SI LA ACCIÓN ES REGISTRAR
          if (method == "post") {
            // SI ES EL ÚLTIMO PASO (PESTAÑA)
            if (ultimaPestana) {
              // SE REINICIA EL FORMULARIO Y SE DEVUELVE A LA PRIMER PESTAÑA
              payload.resetFormVeeValidate(payload);
              payload.$refs.formWizard.reset();
            } else {
              // SI NO ES EL ÚLTIMO PASO (PESTAÑA), SE CARGA EL CIUDADANO AL FORMULARIO
              payload.form = { ...res.data.data };
              // LOS CAMBIOS DEL FORMULARIO PASAN A SER FALSE
              payload.$nextTick(() => {
                payload.formChanged = false;
              });
            }
          }
        }
      });
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
