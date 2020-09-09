import Swal from "sweetalert2";

export default {
  archivosSeleccionados({}, { payload, fileRecords }) {
    payload.fileRecordsForUpload = [...payload.fileRecordsForUpload, ...fileRecords.filter((file) => !file.error)];
  },

  async subirDocumentos({ commit }, payload) {
    let formData = new FormData();
    let mensajeGuardar = "El documento se ha subido con éxito!";
    let mensajeError = "No se pudo subir el documento, consulte con el administrador!";

    formData.append("modulo_id", payload.moduloid);
    formData.append("modulo", payload.modulo);
    payload.fileRecordsForUpload.forEach(({ file }, index) => formData.append(`file[${index}]`, file, file.newName));

    if (payload.fileRecordsForUpload.length > 1) {
      mensajeGuardar = "Los documentos se han subido con éxito!";
      mensajeError = "No se pudo subir los documentos, consulte con el administrador!";
    }

    try {
      let res = await this.$axios.post("/api/documentos", formData, {
        header: { "Content-type": "multipart/form-data" },
      });
      let documentos = res.data.data.map((data) => ({
        ...data,
        name: data.nombre_carga,
        lastModified: data.updated_at,
        size: data.tamano,
        type: data.aplicacion,
        url: `${process.env.API_URL}/storage${data.url_descarga}`,
      }));

      commit("SUBIR_DOCUMENTOS", documentos);

      Swal.fire({
        html: `<h4>${mensajeGuardar}</h4>`,
        icon: "success",
        allowOutsideClick: false,
        allowEscapeKey: false,
      }).then((result) => {
        if (result.value) {
          payload.fileRecordsForUpload = [];
        }
      });
    } catch (err) {
      let status = err.response.status;
      // ERROR DEL CLIENTE
      if (status <= 499) {
        // ERROR DEL SERVIDOR
      } else {
        Swal.fire({
          html: `<h4>${mensajeError}</h4>`,
          icon: "error",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      }
    }
  },

  async consultarDocumentos({ commit }, payload) {
    try {
      let res = await this.$axios.get(`/api/documentos?modulo_id=${payload.moduloid}&modulo=${payload.modulo}`);
      let documentos = res.data.data.map((data) => ({
        ...data,
        name: data.nombre_carga,
        lastModified: data.updated_at,
        size: data.tamano,
        type: data.aplicacion,
        url: `${process.env.API_URL}/storage${data.url_descarga}`,
      }));
      commit("CONSULTAR_DOCUMENTOS", documentos);
    } catch (error) {
      console.error(error);
    }
  },

  antesDeEditar({ commit, dispatch }, { payload, fileRecord }) {
    let fileRecordForUpload = payload.fileRecordsForUpload.some((file) => file.urlResized === fileRecord.urlResized);
    if (fileRecord.inputValue) {
      if (fileRecord.inputValue != fileRecord.name(true)) {
        if (fileRecordForUpload) {
          let newName = `${fileRecord.inputValue}.${fileRecord.ext()}`;
          payload.fileRecordsForUpload.forEach((file, index) =>
            file.urlResized === fileRecord.urlResized ? (payload.fileRecordsForUpload[index].file.newName = newName) : null
          );
        } else {
          payload.fileRecords.forEach((file) => (file.url === fileRecord.urlValue ? (fileRecord.id = file.id) : null));
          dispatch("editarDocumento", fileRecord);
        }
      }
    }
  },

  editarDocumento({ commit }, payload) {
    try {
      Swal.fire({
        html: "<h4>Está seguro(a) que desea editar el nombre del documento?</h4>",
        icon: "warning",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Si",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
      }).then(async (result) => {
        if (result.value) {
          let newName = `${payload.inputValue}.${payload.ext()}`;
          let res = await this.$axios.put(`/api/documentos/${payload.id}`, { nombre_carga: newName });
          commit("EDITAR_DOCUMENTO", { payload, newName });

          Swal.fire({
            html: `<h4>el documento se ha editado con éxito!</h4>`,
            icon: "success",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
        } else {
          payload.inputValue = payload.name(true);
        }
      });
    } catch (err) {
      let status = err.response.status;
      // ERROR DEL CLIENTE
      if (status <= 499) {
        // ERROR DEL SERVIDOR
      } else {
        Swal.fire({
          html: "<h4>No se pudo editar el documento, consulte con el administrador!</h4>",
          icon: "error",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      }
    }
  },

  antesDeEliminar({ dispatch }, { payload, fileRecord }) {
    let searchFileForUpload = payload.fileRecordsForUpload.some((file) => file.urlResized === fileRecord.urlResized);
    if (searchFileForUpload) {
      payload.fileRecordsForUpload = payload.fileRecordsForUpload.filter(
        (file) => file.urlResized !== fileRecord.urlResized
      );
      payload.fileRecords = payload.fileRecords.filter((file) => file.urlResized !== fileRecord.urlResized);
    } else {
      payload.fileRecords.forEach((file) => (file.url === fileRecord.urlValue ? (fileRecord.id = file.id) : null));
      dispatch("eliminarDocumento", fileRecord);
    }
  },

  eliminarDocumento({ commit }, payload) {
    try {
      Swal.fire({
        html: "<h4>Está seguro(a) que desea eliminar el documento?</h4>",
        icon: "warning",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Si",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
      }).then(async (result) => {
        if (result.value) {
          let res = await this.$axios.delete(`/api/documentos/${payload.id}`);
          commit("ELIMINAR_DOCUMENTO", payload);

          Swal.fire({
            html: `<h4>el documento se ha eliminado con éxito!</h4>`,
            icon: "success",
            allowOutsideClick: false,
            allowEscapeKey: false,
          });
        }
      });
    } catch (err) {
      let status = err.response.status;
      // ERROR DEL CLIENTE
      if (status <= 499) {
        // ERROR DEL SERVIDOR
      } else {
        Swal.fire({
          html: "<h4>No se pudo eliminar el documento, consulte con el administrador!</h4>",
          icon: "error",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      }
    }
  },
};
