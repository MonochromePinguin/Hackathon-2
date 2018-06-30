
$(document).ready( function(){

    $attractionList = $('div[data-attraction-id]');
    $sendBtn = $('#sendBtn');

    function refreshHighlightList()
    {
        for ( let el of $attractionList ) {
            id = el.dataset.attractionId;

            if ( id in highlightList )
                el.classList.add( 'spotted' );
            else
                console.log( '.....;' );
                el.classList.remove( 'spotted' );
        }
    }

/*    $('#filterquery input').change( function() {
        doAjaxRequest(
            null,null,
            '/map',
            { test: "test"},
        )

    });*/

    refreshHighlightList();
});
