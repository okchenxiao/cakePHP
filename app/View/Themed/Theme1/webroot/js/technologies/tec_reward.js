$(function(){
     $('#create_reward_form_sub').click(function(){
        var form_url  = $('#create_reward_form').get(0).action;
        var form_data = $('#create_reward_form').serialize();
        $.ajax({
            url : form_url,
            type: 'POST',
            data: form_data,
            dataType: 'json',
            success:function(data){
                if( data ){
                    alert(data.msg);
                }
            },
            error:function(){

            }
        });
     });
     $edit_reward = function (reward_data){
        var 
     }
});