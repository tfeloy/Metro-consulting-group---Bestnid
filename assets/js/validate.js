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
      dia: {
        range: [1, 31],
        required: true
      },
      mes: {
        range: [1, 12],
        required: true
      },
      ano: {
        range: [1910, 2015],
        required: true
      },
      sexo: {
        required: true
      },
      nro_tarjeta: {
        digits: true,
        minlength: 16,
        maxlength: 16,
        required: true
      }
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
}); // end document.ready

$(document).ready(function(){
  var count = 4;
  $('#registeradmin-form').validate(
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
      dia: {
        range: [1, 31],
        required: true
      },
      mes: {
        range: [1, 12],
        required: true
      },
      ano: {
        range: [1910, 2015],
        required: true
      },
      sexo: {
        required: true
      },
      nro_tarjeta: {
        digits: true,
        minlength: 16,
        maxlength: 16,
        required: false
      }
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
}); // end document.ready

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
      dia: {
        range: [1, 31],
        required: true
      },
      mes: {
        range: [1, 12],
        required: true
      },
      ano: {
        range: [1910, 2015],
        required: true
      },
      sexo: {
        required: true
      },
      nro_tarjeta: {
        digits: true,
        minlength: 16,
        maxlength: 16,
        required: true
      }
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
}); // end document.ready

$(document).ready(function(){
  var count = 4;
  $('#subastar-form').validate(
  {
    rules: {
      titulo: {
        minlength: 3,
        required: true
      },
      categoria: {
        required: true
      },
      descripcion: {
        minlength: 5,
        required: true
      },
      dias: {
        required: true
      }
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
}); // end document.ready

$(document).ready(function(){
  $('#pregunta-form').validate(
  {
    rules: {
      pregunta: {
        minlength: 5,
        required: true
      }
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
}); // end document.ready

$(document).ready(function(){
  $('#ofertar-form').validate(
  {
    rules: {
      necesidad: {
        minlength: 5,
        required: true
      },
      precio: {
        number: true,
        min: 1,
        required: true
      }
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
}); // end document.ready

$(document).ready(function(){
  var count = 4;
  $('#editsubastar-form').validate(
  {
    rules: {
      titulo: {
        minlength: 3,
        required: true
      },
      categoria: {
        required: true
      },
      descripcion: {
        minlength: 5,
        required: true
      }
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
}); // end document.ready

$(document).ready(function(){
  $('#editarMonto-form').validate(
  {
    rules: {
      precio: {
        number: true,
        min: 1,
        required: true
      }
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
}); // end document.ready

$(document).ready(function(){
    var count = 4;
  $('#responderConsulta-form').validate(
  {
    rules: {
      respuesta: {
        required: true
      }
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
}); // end document.ready