$(document).ready(function(){
  var count = 4;
 $('#register-form').validate(
 {
  rules: {
    nombre: {
      minlength: 3,
      required: true
    },
    apellido: {
      minlength: 3,
      required: true
    },
    username: {
      minlength: 3,
      required: true
    },
    email: {
      email: true,
      required: true
    },
    password: {
      minlength: 3,
      required: true
    },
    telefono: {
      digits: true,
      minlength: 3,
      required: true
    },
    fecha_nac: {
      date: true,
      required: true
    },
    sexo: {
      required: true
    },
    nro_tarjeta: {
      digits: true,
      minlength: 3,
      required: true
    }
  },
  highlight: function(element) {
    $(element).closest('.control-group').removeClass('success').addClass('error');
  },
  success: function(element) {
    element
    .closest('.control-group').removeClass('error');
  }
 });
}); // end document.ready