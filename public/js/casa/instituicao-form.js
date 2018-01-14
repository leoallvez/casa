$(function() {		
        $('#adm_id').change(function() {

            if($('#adm_id').val() != $('#old_adm_id').val()) {		
                $('#delete_adm').show();	
                $('input[name=inativar_old_adm]').attr('checked', false);	
            } else {		
                $('#delete_adm').hide();
                $('input[name=inativar_old_adm]').attr('checked', false);	
            }		
        });		
    });	

    $( document ).ready(function() {		
	    $('#delete_adm').hide();	
    });
    
    