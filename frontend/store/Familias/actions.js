import Swal from "sweetalert2";

export default {
  consultarCiudadano({ commit }, payload) {
    let ciudadano = null;

    if (payload.numero_documento == "1151959229") {
      ciudadano = { numero_documento: "1151959229", fecha_expedicion: "2012-01-28" };
    }

    commit("ASIGNAR_CIUDADANO", ciudadano);
  },
};
