
$(document).ready( function(){

    $attractionList = $('div[data-attraction-id]');
    $inputList = $('#filterquery input');

    $watchedForm = $('#js-watched-form');
    $sendBtn = $('#sendBtn');


    function refreshHighlight()
    {
        for ( let el of $attractionList ) {
            id = el.dataset.attractionId;

            if ( id in highlightList )
                el.classList.add( 'spotted' );
            else
                el.classList.remove( 'spotted' );
        }
    }

    function reloadState( data, status )
    {
        highlightList = data.highlightList;
        refreshHighlight();
    }

    $inputList.change( function() {
        doAjaxRequest(
            null, null,
            '/map',
            $watchedForm.serialize(),
            reloadState
        )
    });

    refreshHighlight();
});
