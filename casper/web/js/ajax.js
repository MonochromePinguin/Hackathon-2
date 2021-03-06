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


function goToUrlByPostMethod( url, parameters )
{
    var form = document.createElement('form');

    form.setAttribute('method', 'POST');
    form.setAttribute('action', url);

    for(let key in parameters) {
        let field = document.createElement('input');

        field.setAttribute('type', 'hidden');
        field.setAttribute('name', key);

        field.setAttribute('value', parameters[key]);
        form.appendChild(field);
    }

    document.body.appendChild(form);
    form.submit();
}
