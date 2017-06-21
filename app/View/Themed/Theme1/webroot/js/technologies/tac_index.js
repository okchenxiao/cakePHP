$(function(){
    $('#pass_btn').click(function(){
        $('#state_input').val('审批');
    });
    $('#turn_down_btn').click(function(){
        $('#state_input').val('驳回');
    });

    if( $('#state_input').val() != '' ){
        $('#pass_btn').hide();
        $('#turn_down_btn').hide();
    }else{
        $('#change_btn').hide();
    }


});