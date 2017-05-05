$(document).ready(function(){
    'use strict';

    var $bannerConfigInputsContainer = $('#bannerConfigInputsContainer');
    var $bannerPlaceId = $('#banner_place_id');
    var $showBannerMap = $('#showBannerMap');
    var $bannerImageInputs = $('#bannerImageInputs');
    var $bannerHtmlInputs = $('#bannerHtmlInputs');

    //Mostra/Esconde o tipo de banner
    var toggleAcceptedTypes = function (accepted) {
        $('.enabled-banner-type').hide();
        var hasCheckedType = null;
        $.each(accepted, function (index, elem) {
            var type = $('.enabled-banner-type.' + elem);

            hasCheckedType = !hasCheckedType ? type.find('input').prop('checked') : true;

            type.show();
        });

        if (!hasCheckedType) {
            $('.enabled-banner-type').first().find('input').iCheck('check');
        }
    };

    //Localização
    $bannerPlaceId.on('change', function () {
        var selected = $bannerPlaceId.find('option[value="' + $(this).val() + '"]');

        if ($(this).val() !== '') {
            $showBannerMap.attr('href', selected.data('map-image'));
            $showBannerMap.show();

            var acceptedTypes = selected.data('accepted-types').split(',');
            setTimeout(function () {
                toggleAcceptedTypes(acceptedTypes);
            }, 250);

            $bannerConfigInputsContainer.show();
        } else {
            $bannerConfigInputsContainer.hide();
            $showBannerMap.hide();
        }
    }).trigger('change');

    //Ao alterar o tipo de banner
    $('.enabled-banner-type input').on('change', function () {
        var input = $(this);

        if (input.prop('checked')) {
            //Tipo permitidos
            switch (input.val()) {
                case 'image':
                case 'gif':
                    $bannerImageInputs.show();
                    $bannerHtmlInputs.hide();
                    break;
                case 'html':
                    $bannerHtmlInputs.show();
                    $bannerImageInputs.hide();
                    break;

                default:
                    notification('warning', 'O tipo de banner marcado é inválido.', input);

                    break;
            }
        }
    }).trigger('change');
});