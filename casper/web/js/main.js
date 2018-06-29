currentCategory = null;
currentSensation = null;


//TODO: replace it with a TRUE error-showing function
function showErrorMsg( msg )
{
    console.log(msg);
}


function doAjaxRequest($feedback, $div, url, sentDatas, callback)
{
    if ( null != $feedback )
        $feedback.css( 'display', 'block' );
    if ( null != $div )
        $div.css( 'hide' );

    $.post( url, sentDatas )
     .done( callback )

     .fail( function( jqXHR, textStatus, status ){
         showErrorMsg(
             'Erreur de communication avec le serveur : ' +
             jqXHR.status + ' « ' + status + '»'
         );
     } )

     .always( function() {
        if ( null != $feedback )
            $feedback.css( 'display', 'none' );
    } );
}


function reloadState( datas, status )
{
    currentState = datas.newState;

    if ('GO' == currentState )
    {
        $('#to-the-map').get(0).click();
    }

    if ( null != datas.category )
        currentCategory = datas.category;

    if ( null != datas.sensation )
        currentSensation = datas.sensation;

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
