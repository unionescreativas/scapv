export default {
  SUBIR_DOCUMENTOS(state, payload) {
    state.documentos = [...state.documentos, ...payload];
  },
  CONSULTAR_DOCUMENTOS(state, payload) {
    state.documentos = payload;
  },
  ELIMINAR_DOCUMENTO(state, payload) {
    state.documentos = state.documentos.filter((documento) => documento.id !== payload.id);
  },
};
