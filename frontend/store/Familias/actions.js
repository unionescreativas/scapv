import Swal from "sweetalert2";

export default {
  consultarCiudadano({ commit }, payload) {
    let ciudadano = null;

    if (payload == "1151959229") {
      ciudadano = { numero_documento: payload };
    }
    
    commit("ASIGNAR_CIUDADANO", ciudadano);
  },
};
