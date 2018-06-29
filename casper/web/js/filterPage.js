//GLOBAL VARIABLES ARE EVILS. BUT WE'RE IN HACKATHON...
currentCategory = null;
currentSensation = null;


function reloadState( datas, status )
{
    currentState = datas.newState;

    if ( null != datas.category )
        currentCategory = datas.category;

    if ( null != datas.sensation )
        currentSensation = datas.sensation;

    if ('GO' == currentState )
    {
        goToUrlByPostMethod(
            '/map',
            {
                'category': currentCategory,
                'sensation': currentSensation
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

        if ( null != currentCategory )
            request.category = currentCategory;
        if ( null != currentSensation )
            request.sensation = currentSensation;

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
