$(document).ready(function() {
  $('#form-login').formValidation({
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
      },
      'senha': {
        validators: {
          trigger: 'focus blur keydown bind change',
          notEmpty: {
            message: 'A senha é obrigatório e não pode ser vazio.'
          },
          stringLength: {
            min: 6,
            max: 100,
            message: 'A senha deve estar entre 6 e 100 caracteres.'
          },
          regexp: {
            regexp: /^[a-zA-Z0-9_@]+$/,
            message: 'A senha pode conter apenas letras, números, underline e arroba.'
          },
          different: {
            field: 'nome_usuario',
            message: 'A senha não pode ser o seu nome.'
          }
        }
      },
    }
  });
});