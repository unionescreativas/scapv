export default {
  ciudadano: ({ ciudadano }) => (ciudadano && ciudadano != "no existe" ? ciudadano[0] : {}),
  documentosCiudadanos: ({ ciudadanos }) => ciudadanos.map((ciudadano) => ciudadano.numero_documento),
};
