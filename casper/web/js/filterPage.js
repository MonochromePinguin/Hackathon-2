//GLOBAL VARIABLES ARE EVILS. BUT WE'RE IN HACKATHON...
currentAudience = null;
currentCategory = null;


function reloadState( datas, status )
{
    currentState = datas.newState;

    if ( null != datas.audience )
        currentAudience = datas.audience;

    if ( null != datas.category )
        currentCategory = datas.category;

    if ('GO' == currentState )
    {
        goToUrlByPostMethod(
            '/map',
            {
                'category': currentCategory,
                'audience': currentAudience
            }
        );
    }

    $('body').css('background-image', 'url("' + datas.newBackground + '")');
    $('#fenetre').html(datas.newContent);

    $('.js-watched').change( function() {
        handleRadioBtnChoice( this );
    });
}


function handleRadioBtnChoice(element) {
    if ($(element).is(':checked'))
    {
        let request = {
            'ajaxFlag': 1,
            'currentState': currentState,
            'choosen': element.dataset.choice
        };

        doAjaxRequest(
            null,null,
            '/filtre',
            request,
            reloadState
        );
    }
}

$(document).ready( function() {

    $('.js-watched').change( function() {
        handleRadioBtnChoice( this );
    });

}
);
