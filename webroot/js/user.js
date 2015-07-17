$(document).ready(function(){
    $("#memberModal").on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var title = button.data('title');
        if (title === 'edit') {
            var userId =  button.data('member');
            $("#userId").val(userId);
            var full_name = $("#fullname" + userId).html();
            $("#fullname").val(full_name);
            var email = $("#email" + userId).html();
            $("#email").val(email);
            var office_id = $("#office" + userId).html();
            $("#office_id").val(office_id);
            var skype = $("#skype" + userId).html();
            $("#skype").val(skype);
            var phone = $("#phone" + userId).html();
            $("#phone").val(phone);
            var username = $("#username" + userId).val();
            $("#username").val(username);
            var address = $("#address" + userId).val();
            $("#address").val(address);
            var style = $("#style" + userId).val();
            $("#style").val(style);
        } else {
            $("#userId").val(0);
        }
    });

    $("#addUser").click(function() {
        var username = $("#username").val();
        var fullname = $("#fullname").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var office_id = $("#office_id").val();
        var skype = $("#skype").val();
        var address = $("#address").val();
        var style = $("#style").val();
        var userId = $("#userId").val();
        $.ajax({
            beforeSend: function(){
            },
            delay: 0,
            url: '/users/save',
            type: 'POST',
            dataType: 'json',
            data : { tms_username : username, full_name : fullname, email : email, phone : phone, office_id : office_id, skype : skype, address : address, style : style, id : userId },
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

function deleteUser(userId) {
    $( "#dialog-confirm" ).dialog({
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
                    url: '/users/delete',
                    type: 'POST',
                    dataType: 'json',
                    data : { id : userId },
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