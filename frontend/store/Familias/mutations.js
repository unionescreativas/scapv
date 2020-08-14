export default {
  CONSULTAR_CIUDADANO(state, payload) {
    state.ciudadano = payload;
  },
  CONSULTAR_CIUDADANOS(state, payload) {
    state.ciudadanos = payload;
  },
  GUARDAR_CIUDADANO(state, payload) {
    state.ciudadanos = payload;
  },
};
