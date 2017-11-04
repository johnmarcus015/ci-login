$(document).ready(function() {
  $('#form-redefinicao-senha').formValidation({
    framework: 'bootstrap',
    icon: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
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
      'confirmacao_senha': {
        validators: {
          trigger: 'focus blur keydown bind change',
          notEmpty: {
            message: 'A confirmação de senha é obrigatório e não pode ser vazio.'
          },
          stringLength: {
            min: 6,
            max: 100,
            message: 'A confirmação de senha deve estar entre 6 e 100 caracteres.'
          },
          regexp: {
            regexp: /^[a-zA-Z0-9_@]+$/,
            message: 'A confirmação de senha pode conter apenas letras, números, underline e arroba.'
          },
          different: {
            field: 'nome_usuario',
            message: 'A confirmação de senha não pode ser o seu nome.'
          },
          identical: {
            field: 'senha',
            message: 'A confirmação de senha não coincide com a senha.'
          }
        }
      }
    }
  });
});