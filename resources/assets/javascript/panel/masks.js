/* Generated Wed Apr 27 2016 13:53:18 GMT-0300 (Hora oficial do Brasil) */
$(document).ready(function(){
    'use strict';

    //TELEFONE
    var nineDigitsMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        nineDigitsOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(nineDigitsMaskBehavior.apply({}, arguments), options);
            },
            placeholder: '(__) ____-____',
            clearIfNotMatch: true
        };

    $('.mask-telephone').mask(nineDigitsMaskBehavior, nineDigitsOptions);

    //CPF
    $('.mask-cpf').mask('000.000.000-00', {
        placeholder: '___.___.___-__',
        clearIfNotMatch: true
    });

    //CPF
    $('.mask-cnpj').mask('00.000.000/0000-00', {
        placeholder: '__.___.___/____-__',
        clearIfNotMatch: true
    });

    //CEP
    $('.mask-cep').mask('00.000-000', {
        placeholder: '__.___-___',
        clearIfNotMatch: true
    });

    //URL
    $('.mask-url').mask('httpW://XYY', {
        //clearIfNotMatch: true,
        translation: {
            W: {pattern: /s/, optional: true},
            X: {pattern: /[a-z]/},
            Y: {pattern: /./, recursive: true}
        }
    });

    //NÚMERO
    $('.mask-number:not(.accept-negative-value)').mask('########################0', {
        clearIfNotMatch: true,
        recursive: true
    });
    $('.mask-number.accept-negative-value').maskMoney({
        thousands: '',
        decimal: '',
        allowNegative: true,
        allowZero: true,
        precision: 0
    });

    //DATA
    $('.mask-date:not(.no-placeholder)').mask('00/00/0000', {
        placeholder: '__/__/____',
        clearIfNotMatch: true
    });
    $('.mask-date.no-placeholder').mask('00/00/0000', {
        placeholder: '',
        clearIfNotMatch: true
    });
    $('.mask-time:not(.no-placeholder)').mask('00:00:00', {
        placeholder: '__:__:__',
        clearIfNotMatch: true
    });
    $('.mask-time.no-placeholder').mask('00:00:00', {
        placeholder: '',
        clearIfNotMatch: true
    });
    $('.mask-date-time:not(.no-placeholder), .mask-datetime:not(.no-placeholder)').mask('00/00/0000 00:00:00', {
        placeholder: '__/__/____ __:__:__',
        clearIfNotMatch: true
    });
    $('.mask-date-time.no-placeholder, .mask-datetime.no-placeholder').mask('00/00/0000 00:00:00', {
        placeholder: '',
        clearIfNotMatch: true
    });

    //DINHEIRO
    $('.mask-money, .mask-currency').each(function () {
        var input = $(this);

        var config = {
            thousands: '.',
            decimal: ','
        };

        if (input.hasClass('accept-negative-value')) {
            config.allowNegative = true;
        }

        if (input.hasClass('accept-zero-value')) {
            config.allowZero = true;
        }

        input.maskMoney(config);
    });

    //FLOAT
    $('.mask-float:not(.accept-negative-value)').mask('##0.000', { reverse: true });

    $('.mask-float.accept-negative-value').maskMoney({
        thousands: '',
        decimal: '.',
        allowNegative: true,
        precision: 3
    });

    //DOUBLE
    $('.mask-double:not(.accept-negative-value)').mask('##0.00', { reverse: true });

    $('.mask-double.accept-negative-value').maskMoney({
        thousands: '',
        decimal: '.',
        allowNegative: true,
        precision: 2
    });

    //IP
    $('.mask-ip-address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/, optional: true
            }
        }
    });

    //PORCENTO
    $('.mask-percent').mask('##0,00%', { reverse: true });

    //HEXACOLOR
    $('.mask-hexacolor').mask('HCCCDDD', {
        translation: {
            'H': {
                pattern: '#'
            },
            'C': {
                pattern: /[0-9a-zA-Z]/
            },
            'D': {
                pattern: /[0-9a-zA-Z]/, optional: true
            }
        }
    });
});