/* Generated Wed Apr 27 2016 13:53:18 GMT-0300 (Hora oficial do Brasil) */
$(document).ready(function(){
    'use strict';

    //VALIDAÇÃO DE FORMULÁRIOS Semantic UI
    //Tradução das validações
    var validationTranslate = {
        empty                : '{name} deve ser preenchido',
        checked              : '{name} deve ser marcado',
        email                : '{name} deve conter um e-mail válido',
        url                  : '{name} deve conter uma url válida',
        regExp               : '{name} não está formatado corretamente',
        integer              : '{name} deve conter um número inteiro',
        decimal              : '{name} deve conter um número decimal',
        number               : '{name} deve conter um número',
        is                   : '{name} deve conter "{ruleValue}"',
        isExactly            : '{name} deve conter exatamente "{ruleValue}"',
        not                  : '{name} não pode conter "{ruleValue}"',
        notExactly           : '{name} não pode conter exatamente "{ruleValue}"',
        contain              : '{name} não contém "{ruleValue}"',
        containExactly       : '{name} não contém exatamente "{ruleValue}"',
        doesntContain        : '{name} deve conter "{ruleValue}"',
        doesntContainExactly : '{name} deve conter exatamente "{ruleValue}"',
        minLength            : '{name} deve conter pelo menos {ruleValue} caracteres',
        length               : '{name} deve conter {ruleValue} caracteres',
        exactLength          : '{name} deve conter exatamente {ruleValue} caracteres',
        maxLength            : '{name} não pode conter mais que {ruleValue} caracteres',
        match                : '{name} deve combinar com o campo {ruleValue}',
        different            : '{name} deve conter um valor diferente do campo {ruleValue}',
        creditCard           : '{name} deve conter um número de cartão de crédito válido',
        minCount             : '{name} deve ter pelo menos {ruleValue} opções',
        exactCount           : '{name} deve ter exatamente {ruleValue} opções',
        maxCount             : '{name} deve ter {ruleValue} ou menos opções'
    };
    //Usa meta attributos para setar validação
    $(".has-validation").each(function() {
        var form = $(this);
        var errorsInline = form.hasClass("errors-inline") ? true : false;

        var fields = {};

        form.find("[data-rule]").each(function() {
            var input = $(this);
            var inputIdentifier = input.attr("id");
            inputIdentifier = (inputIdentifier === undefined || inputIdentifier == "") ? input.attr("name") : inputIdentifier;

            if (inputIdentifier !== undefined && inputIdentifier != "") {
                var rules = [];
                var types = input.data("rule");
                var optional = input.data("rule-optional");
                var depends = input.data("rule-depends");
                var prompts = input.data("rule-prompt");
                prompts = (prompts === undefined) ? "" : prompts;

                var arrTypes = types.split('||');
                var arrPrompts = prompts.split('||');

                $.each(arrTypes, function(index, type) {
                    var prompt = arrPrompts[index];

                    var attrRule = {};

                    attrRule.type = type;

                    if (prompt !== undefined) {
                        attrRule.prompt = prompt;
                    }

                    rules.push(attrRule);
                });

                fields[inputIdentifier] = {
                    identifier  : inputIdentifier,
                    rules: rules
                };

                //Depends
                if (depends !== undefined && depends !== '') {
                    fields[inputIdentifier].depends = depends;
                }

                //Optional
                if (optional == true) {
                    fields[inputIdentifier].optional = true;
                }
            }
        });

        //Plugin
        form.form({
            on: 'submit',
            inline: errorsInline,
            fields: fields,
            prompt: validationTranslate,
            onFailure: function () {
                //Rola página até página de erro
                $('html, body').animate({
                    scrollTop: (form.offset().top - 50)
                }, 300);

                return false;
            }
        });
    });
});