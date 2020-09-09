export default {
  SUBIR_DOCUMENTOS(state, payload) {
    state.documentos = [...state.documentos, ...payload];
  },
  CONSULTAR_DOCUMENTOS(state, payload) {
    state.documentos = payload;
  },
  EDITAR_DOCUMENTO(state, { payload, newName }) {
    state.documentos.find((documento) => documento.id === payload.id)["name"] = newName;
  },
  ELIMINAR_DOCUMENTO(state, payload) {
    state.documentos = state.documentos.filter((documento) => documento.id !== payload.id);
  },
};
