export default {
  CONSULTAR_LISTAS(state, payload) {
    state.listas = payload;
  },
  GUARDAR_LISTA(state, payload) {
    state.lista = payload;
  },
  INACTIVAR_LISTA(state, payload) {
    state.estadoLista = payload;
  },
};
