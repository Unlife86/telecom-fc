$(function() {
    $('#modalButton').click(function() {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });

    /*$('#tournamentsearch-id_league').change(function() {
        $('#tournamentsearch-id_group option:first').attr('selected','selected');
     });*/
});
$(document).ready(function() {
    $(document).on('change', '#tournamentsearch-id_league', function( event ) {
        $('#tournamentsearch-id_group option:first').attr('selected','selected');
       // alert('hi');
    });
    if ($('*').is('#news-full_text')) {
        CKEDITOR.replace( 'news-full_text' );
    }
    /*$('#modalButton').click(function(e) {
        e.stopPropagation();
        $('#modalAjax .modal-body').load($(this).attr('value'), function( response, status, xhr ) {
            if ( status == "success" ) {
                $('#modalAjax').modal('toggle');
            }
        });
    });*/
    $('#modalAjax').on('show.bs.modal', function (e) {
        $(this).find('.modal-body').load($('#modalButton').attr('value'));
    })
    $('#modalAjax').on('hidden.bs.modal', function (e) {
        // do something...
    })
});
