$(document).ready(function(){
    $("#memberModal").on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);// trả về kết quả khi click chuột
        var title = button.data('title'); // tạo biến gán bằng dữ liệu của button có tên dữ liệu là title
        if (title === 'edit') {
            var userId =  button.data('member');
            $("#userId").val(userId);
            var tms_username = $("#tms_username" + userId).html();
            $("#tms_username").val(tms_username);
            var full_name = $("#1" + userId).html();
            $("#full_name").val(full_name);
            var office_id = $("#office_id" + userId).val();
            $("#office_id").val(office_id);
            var email = $("#email" + userId).html();
            $("#email").val(email);
            var skype = $("#skype" + userId).html();
            $("#skype").val(skype);
            var phone = $("#phone" + userId).html();
            $("#phone").val(phone);
            var address = $("#3" + userId).html();
            $("#address").val(address);
            var style = $("#style" + userId).val();
            $("#style").val(style);
            $('div.invalid-msg').html('');
        } else {
            $("#userId").val(0);
        }
    });

       

    // Đưa form về mặc định khi add new task
    $("#memberModal").on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var title = button.data('title'); 
        if (title === 'add_user') {
            $("#tms_username").val("");
            $("#office_id").val(0);
            $("#style").val(0);
            $("#full_name").val("");
            $("#email").val("");
            $("#skype").val("");
            $("#phone").val("");
            $("#address").val("");
            $('div.invalid-msg').html('');
        }
    });



    $("#addUser").click(function() {
        
        
 
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var tms_username = $.trim($("#tms_username").val());
        var full_name = $.trim($("#full_name").val());
        var email = $.trim($("#email").val());
        var phone = $.trim($("#phone").val());
        var office_id = $.trim($("#office_id").val());
        var skype = $.trim($("#skype").val());
        var address = $.trim($("#address").val());
        var style = $.trim($("#style").val());
        var userId = $.trim($("#userId").val());

        // Validate bằng jquery trên Client
        var checkPass = 1;
        var dem = 0;
         $('.inputText').each(function (){
                dem++;   
                if($.trim($(this).val()) == ''){
                    
                    checkPass = 0;
                    $(this).parent().parent().next('div.invalid-msg').html('<em>Vui lòng không được để trống</em>').css('color','red'); 
                    
                }else{
                        $(this).parent().parent().next('div.invalid-msg').html('');
                        if (dem == 3)
                        {
                            if (!filter.test(email)){
                                $(this).parent().parent().next('div.invalid-msg').html('<em>Vui lòng nhập đúng định dạng email</em>').css('color','red');
                                checkPass = 0; 
                            }else{
                                $(this).parent().parent().next('div.invalid-msg').html('');
                                }
                        }       
                                 
                    } 
        });    

        $('.alo1').each(function (){
                if($(this).val() == 0) {
                    
                    checkPass = 0;
                    $(this).parent().parent().next('div.invalid-msg').html('<em>Vui lòng chọn</em>').css('color','red'); 
                }else{
                        $(this).parent().parent().next('div.invalid-msg').html('');
                       
                    }       
                                 
        });   

         // Post form bằng ajax
        if (checkPass)
        {
            $.ajax({
                beforeSend: function(){
                },
                delay: 0,
                url: '/users/save',
                type: 'POST',
                dataType: 'json',
                data : { tms_username : tms_username, full_name : full_name, email : email, phone : phone, office_id : office_id, skype : skype, address : address, style : style, id : userId },
                success: function(data){
                    if(data.status == true){
                        $("#list_user").load(location.href + " #list_user");
                        document.getElementById("myButton_user").click();
                        $('div.msg_user').html('(' + data.msg + ')').css('color','green').fadeIn('fast').fadeOut(5000);
                    }else{
                        $('div.msg').html(data.msg).css('color','red');               
                    }

                }
            });
        }
        

    });

});


function deleteUser(userId) {
    $( "#dialog-confirm-user" ).dialog({
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
                            $("#list_user").load(location.href + " #list_user");
                            $('div.msg_user').html('(' + data.msg + ')').css('color','green').fadeIn('fast').fadeOut(5000);
                        }else{
                            alert(data.msg);
                        }
                        $('#dialog-confirm-user').dialog( "close" );
                    }
                });
            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}