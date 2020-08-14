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
  async guardarCiudadano({ commit }, payload) {
    try {
      let url = "/api/ciudadanos";
      let mensaje = "El registro se ha realizado con éxito!";

      if (payload.ciudadano && payload.ciudadano != "no existe") {
        url = `/api/ciudadanos/${payload.ciudadano[0].id}`;
        mensaje = "El registro se ha actualizado con éxito!";
      }

      let res = await this.$axios.post("/api/ciudadanos", payload.form);

      Swal.fire({
        html: "<h4>El registro se ha realizado con éxito!</h4>",
        icon: "success",
        allowOutsideClick: false,
        allowEscapeKey: false,
      }).then((result) => {
        if (result.value) {
          $nuxt.resetFormVeeValidate(payload);
        }
      });
    } catch (a) {
      let res = {
        response: {
          data: {
            errors: {
              "tipo_documento": ["The tipo_documento field is required."], "numero_documento": ["The numero_documento field is required."],
              "pep": ["The pep field is required."], "nombres": ["The nombres field is required."],
              "apellidos": ["The apellidos field is required."], "fecha_expedicion": ["The fecha_expedicion field is required."],
              "fecha_vencimiento": ["The fecha_vencimiento field is required."], "fecha_nacimiento": ["The fecha_nacimiento field is required."],
              "edad": ["The edad field is required."], "genero": ["The genero field is required."],
              "estado_civil": ["The estado_civil field is required."], "telefono": ["The telefono field is required."],
              "celular": ["The celular field is required."], "correo_electronico": ["The correo_electronico field is required."],
              "departamento": ["The departamento field is required."], "ciudad": ["The ciudad field is required."],
              "barrrio": ["The barrrio field is required."], "comuna": ["The comuna field is required."],
              "dirrecion": ["The dirrecion field is required."], "actividad": ["The actividad field is required."],
              "ciudad_origen": ["The ciudad_origen field is required."], "pais_origen": ["The pais_origen field is required."],
              "fecha_llegada": ["The fecha_llegada field is required."], "intencion_ciudad": ["The intencion_ciudad field is required."],
              "respuesta_intencion": ["The respuesta_intencion field is required."], "fecha_llegada": ["The fecha_llegada field is required."],
              "discapacidad": ["The discapacidad field is required."], "salud": ["The salud field is required."],
              "estudia_actualmente": ["The estudia_actualmente field is required."], "nivel_escolaridad": ["The nivel_escolaridad field is required."],
              "tipo_profesion": ["The tipo_profesion field is required."], "comunidad_lgtbi": ["The comunidad_lgtbi field is required."],
              "comunidad_etnica": ["The comunidad_etnica field is required."], "trabajo": ["The trabajo field is required."],
              "tipo_empleo": ["The tipo_empleo field is required."], "observaciones": ["The observaciones field is required."],
            }
          }
        }
      };

      let errors = _.pick(res.response.data.errors, _.keys(payload.$refs.observer.fields));

      if (Object.keys(errors).length) {
        payload.$refs.observer.setErrors(errors);

        Swal.fire({
          html: "<h4>Por favor revise los campos obligatorios!</h4>",
          icon: "warning",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      } else {
        if (!payload.$refs.formWizard.isLastStep) {
          payload.$refs.formWizard.nextTab();
        }
      }
    }
  },
};
