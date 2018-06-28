$(document).ready


function doAjaxRequest($div, sentDatas, callback)
    {
        $feedback.css( 'display', 'block' );
        $div.css( 'hide' );

        $.post( '/ajaxHandler.php', sentDatas )
         .done( callback )

         .fail( function( jqXHR, textStatus, status ){
            showErrorMsg(
                'Échec de communication avec le serveur : erreur ' +
                jqXHR.status + ' « ' + status + '»'
            );

        } ).always( function() {
            $feedback.css( 'display', 'none' );
        } );
    }


doAjaxRequest( $renameModal, {
                action: 'rename',
                'target-path': targetPath,
                'new-name': newName,
//TODO: aren't these parameters factorisables directly into doAjaxRequest()
// instead of being rewritten every call of this function?
                'parent-prefix': parentPrefix != null ?
                                    parentPrefix + '&nbsp;&nbsp;' : '',
→ si le parent n'est pas dernier, ajouter │&nbsp; à la place ... Mais il faut d'abord
        résoudre ce problème de tri inversé ds l'appel du generator !
                'show-hidden': commonFlags.showHidden,
                'sort-by': commonFlags.sortBy,
                'inverted-list': commonFlags.invertedList
            },
            function( datas, status ) {
                if ( 0 == datas.status ) {
                    if ( datas.changedPath != '/' ) {
                        siblingPathSelector =
                            '[data-path^="' + datas.changedPath + '/"]';

                        //if changedPath refers to a directory, delete all child
//TODO: now it is always the case – we always reload the
// whole dir; but it could change one day...
                        $dataContainer.find( siblingPathSelector )
                                      .remove();
                        //and replace it with the new html content
                        $dataContainer.find( '[data-path="' + datas.changedPath + '"]' )
                                      .after( datas.newContent );

                    } else {
