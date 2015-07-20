$(document).ready(function(){
    $("#linkModal").on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var typeLink = button.data('type');
        $("#typeLink").val(typeLink);
        var title = button.data('title');
        if (title === 'edit') {
            var linkId =  button.data('link');
            var dataLink = $("#editLink" + linkId).val();
            dataLink = JSON.parse(dataLink);
            $("#titleLink").val(dataLink.title);
            $("#linkLink").val(dataLink.link);
            $("#targetLink").val(dataLink.target);
            $("#styleTypeLink").val(dataLink.styleType);
            $("#linkId").val(dataLink.id);
        } else {
            $("#linkId").val(0);
        }
    });

    $("#addLink").click(function() {
        var title = $("#titleLink").val();
        var link = $("#linkLink").val();
        var styleType = $("#styleTypeLink").val();
        var target = $("#targetLink").val();
        var typeLink = $("#typeLink").val();
        var linkId = $("#linkId").val();
        $.ajax({
            beforeSend: function(){
            },
            delay: 0,
            url: '/links/save',
            type: 'POST',
            dataType: 'json',
            data : { title : title, link : link, link_type_id : typeLink, style_type : styleType, target : target, id : linkId },
            success: function(data){
                if(data.status == true){
                    alert(data.msg);
                    window.location.reload(true);
                }else{
                    alert(data.msg);
                }
            }
        });
    });

});

function deleteLink(linkId) {
    $( "#dialog-confirm-link" ).dialog({
        resizable: false,
        height:250,
        width:350,
        modal: true,
        buttons: {
            "Delete": function() {
                $.ajax({
                    beforeSend: function(){
                    },
                    delay: 0,
                    url: '/links/delete',
                    type: 'POST',
                    dataType: 'json',
                    data : { id : linkId },
                    success: function(data){
                        if(data.status == true){
                            alert(data.msg);
                            window.location.reload(true);
                        }else{
                            alert(data.msg);
                        }
                        $( this ).dialog( "close" );
                    }
                });
            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}