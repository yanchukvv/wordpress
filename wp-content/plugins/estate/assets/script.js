jQuery( document ).ready( function( $ ) {
    $( document ).on( 'tinymce-editor-setup', function( e, ed ) {
        ed.on( 'NodeChange', function( e ) {
            $( '#' + field_editor.key ).html( wp.editor.getContent( field_editor.key ) );
        } );
    } );
} );