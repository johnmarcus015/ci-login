$(document).ready(function() {
  $('#form-esqueceu-senha').formValidation({
    framework: 'bootstrap',
    icon: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      'email': {
        trigger: 'focus blur keydown bind change',
        validators: {
          notEmpty: {
            message: 'O email é obrigatório e não pode ser vazio.'
          },
          stringLength: {
            min: 10,
            max: 100,
            message: 'O email deve estar entre 10 e 100 caracteres.'
          },
          emailAddress: {
            message: 'O email digitado não é válido.'
          }
        }
      }
    }
  });
});