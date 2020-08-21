function calcularEdad(fecha) {
  //  si la fecha es en formato YYYY-MM--DD --->
  fecha = new Date(fecha.split("/").join("-"));
  //  si la fecha es en formato DD-MM-YYYY --->
  // fecha=new Date(fecha.split('/').reverse().join('-'));
  var ageDifMs = Date.now() - fecha.getTime();
  var ageDate = new Date(ageDifMs);
  return Math.abs(ageDate.getUTCFullYear() - 1970);
}
let edad = calcularEdad("1996-08-22");
