export default {
  CONSULTAR_CIUDADANO(state, payload) {
    state.ciudadano = payload;
  },
  GUARDAR_CIUDADANO(state, payload) {
    state.ciudadanos = payload;
  },
};
