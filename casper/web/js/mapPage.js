
$(document).ready( function(){

    let $attractionList = $('div[data-attraction-id]');
    let $inputList = $('#filterquery input');

    let $watchedForm = $('#js-watched-form');


    function refreshHighlight()
    {
        for ( let el of $attractionList ) {
            id = el.dataset.attractionId;
console.log(' élém  n°' + id )
            if ( highlightIdList.includes(id) )
                el.classList.add( 'spotted' );
            else
                el.classList.remove( 'spotted' );
        }
    }

    function reloadState( data, status )
    {
        highlightIdList = data.highlightIdList;
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
