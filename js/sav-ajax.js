jQuery(document).ready(function() {

    jQuery("#edital").change(function(){
		var id_edital = jQuery("#edital option:selected").val();

		jQuery.ajax({
            type: 'POST',
            url: 'http://localhost/wp/fomento/wp-admin/admin-ajax.php',
            data: {
                action: 'buscar_consultores_ajax',
                id_edital: id_edital,
            },
            success: function(data, textStatus, XMLHttpRequest){
                jQuery("#consultor").html('');
                jQuery("#consultor").append(data);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });
    });
});