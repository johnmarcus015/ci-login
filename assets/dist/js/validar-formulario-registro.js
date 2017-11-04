$(document).ready(function() {
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
    $('#captcha_operacao').html([randomNumber(1, 50), '+', randomNumber(1, 50), '='].join(' '));
    $('#form-registro').formValidation({
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
            },
            'nome_usuario': {
                validators: {
                		trigger: 'focus blur keydown bind change',
                    notEmpty: {
                        message: 'O nome é obrigatório e não pode ser vazio.'
                    },
                    stringLength: {
                        min: 6,
                        max: 100,
                        message: 'O nome deve estar entre 6 e 100 caracteres.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'O nome pode conter apenas letras e espaço.'
                    }
                }
            },
            'genero': {
                validators: {
                		trigger: 'focus blur keydown bind change',
                    notEmpty: {
                        message: 'O gênero é obrigatório e não pode ser vazio.'
                    }
                }
            },
            'telefone': {
                validators: {
                		trigger: 'focus blur keydown bind change',
                    notEmpty: {
                        message: 'O celular é obrigatório e não pode ser vazio.'
                    },
                    stringLength: {
                        min: 15,
                        max: 15,
                        message: 'O celular deve conter 15 caracteres como mín e max.'
                    },
                    regexp: {
                        regexp: /^[0-9 ()-]+$/,
                        message: 'O celular pode conter apenas letras e espaço.'
                    }
                }
            },
            'captcha_operacao': {
                validators: {
                		trigger: 'focus blur keydown bind change',
                    callback: {
                        message: 'Resposta incorreta!',
                        callback: function(value, validator, $field) {
                            var items = $('#captcha_operacao').html().split(' '),
                                sum = parseInt(items[0]) + parseInt(items[2]);
                            return value == sum;
                        }
                    }
                }
            },
            'termos_e_condicoes': {
                validators: {
                    notEmpty: {
                        message: 'Você precisa aceitar os termos e condições'
                    }
                }
            }
        }
    }).find('#telefone').mask('(99) 99999-9999');
    //$("#telefone").mask("(99) 99999-9999",{placeholder:"(__) _____-____"});
});