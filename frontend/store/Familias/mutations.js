export default {
  CONSULTAR_CIUDADANO(state, payload) {
    state.ciudadano = payload;
  },
  CONSULTAR_CIUDADANOS(state, payload) {
    state.ciudadanos = payload;
  },
  GUARDAR_CIUDADANO(state, payload) {
    state.ciudadano = payload;
  },
  GUARDAR_INTEGRANTE_FAMILIA(state, payload) {
    state.integrante = payload;
  },
};
