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

  async guardarLista({ commit }, payload) {
    try {
      let url = "/api/listas";
      let method = "post";
      let data = payload.form;
      let mensajeGuardar = "El registro se ha realizado con éxito!";

      if (data[0].id) {
        url = `/api/listas/${data[0].id}`;
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
          commit("GUARDAR_LISTA", res.data.data);
          payload.$parent.$refs.tablaListas.reloadDataTable();
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

  async inactivarLista({ commit, state }, payload) {
    try {
      let res = await this.$axios.put(`api/listas/${payload.id_lista}/inactivar`);
      commit("INACTIVAR_LISTA", false);

      if (!state.estadoLista) {
        Swal.fire({
          html: "<h4>El registro se ha inactivado con éxito!</h4>",
          icon: "success",
          allowOutsideClick: false,
          allowEscapeKey: false,
        }).then((result) => {
          if (result.value) {
            payload.reloadDataTable();
          }
        });
      }
    } catch (err) {
      let status = err.response.status;
      // ERROR DEL CLIENTE
      if (status <= 499) {
        // ERROR DEL SERVIDOR
      } else {
        Swal.fire({
          html: "<h4>No se pudo inactivar el registro, consulte con el administrador!</h4>",
          icon: "error",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      }
    }
  },
};
