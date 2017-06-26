function validateCharacter(value, element) {
  value = value.toLowerCase();
  if(value.indexOf('#') != -1){ return false; }
  else if(value.indexOf('!') != -1){ return false; }
  else if(value.indexOf('$') != -1){ return false; }
  else if(value.indexOf('%') != -1){ return false; }
  else if(value.indexOf('/') != -1){ return false; }
  else if(value.indexOf('(') != -1){ return false; }
  else if(value.indexOf(')') != -1){ return false; }
  else if(value.indexOf('=') != -1){ return false; }
  else if(value.indexOf('?') != -1){ return false; }
  else if(value.indexOf('¡') != -1){ return false; }
  else if(value.indexOf('¿') != -1){ return false; }
  else if(value.indexOf("'") != -1){ return false; }
  else if(value.indexOf('´') != -1){ return false; }
  else if(value.indexOf('*') != -1){ return false; }
  else if(value.indexOf('[') != -1){ return false; }
  else if(value.indexOf(']') != -1){ return false; }
  else if(value.indexOf('{') != -1){ return false; }
  else if(value.indexOf('}') != -1){ return false; }
  else if(value.indexOf('+') != -1){ return false; }
  else if(value.indexOf('"') != -1){ return false; }
  else if(value.indexOf('_') != -1){ return false; }
  else if(value.indexOf('|') != -1){ return false; }
  else if(value.indexOf('°') != -1){ return false; }
  else if(value.indexOf('&') != -1){ return false; }
  else{ return true; }
}

$.validator.addMethod("character", validateCharacter);

function validateFecha(value, element)
{

  var fechaPartes = value.split('.');

  anio = fechaPartes[2];

  var fecha = new Date();
  var strDate = fecha.getDate() + "." + (fecha.getMonth()+1) + "." + fecha.getFullYear();

  var fechaPartesHoy = strDate.split('.');

  anioHoy= fechaPartesHoy[2]-12;

  if(anio > anioHoy)
  {
      $("span#fecha2").attr("class","glyphicon glyphicon-ok-sign hidden");

      return false;  
  }
  else
  {
      $("span#fecha2").attr("class","glyphicon glyphicon-ok-sign show");

      return true;
  }  

  console.log(anioHoy);

}

$.validator.addMethod("valiDate", validateFecha);