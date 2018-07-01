$(document).ready( function() {

    var currentAudience = null,
        currentCategory = null;

    function reloadState( data, status )
    {
        currentState = data.newState;

        if ( null != data.audience )
            currentAudience = data.audience;

        if ( null != data.category )
            currentCategory = data.category;

        if ('GO' == currentState )
        {
            goToUrlByPostMethod(
                '/map',
                {
// THIS IS **UGLY** SIMULATION OF POST DATA!
//TODO: make this workaround unnecessary by reworking goToUrlByPostMethod()
                    'filterquery[audiences][0]': currentAudience,
                    'filterquery[categories][0]': currentCategory
                }
            );
        }

        $('body').css('background-image', 'url("' + data.newBackground + '")');
        $('#fenetre').html(data.newContent);

        $('.js-watched').change( function() {
            handleRadioBtnChoice( this );
        });
    }


    function handleRadioBtnChoice(element) {
        if ($(element).is(':checked'))
        {
            let request = {
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


    $('.js-watched').change( function() {
        handleRadioBtnChoice( this );
    });

});
