$(function(){

    $('#save_report_but').click(function(){
        $('#state_input').val('保存并上报');
        $('#technology_check_form').submit();
    });
    $('#save_but').click(function(){
        $('#state_input').val('保存');
        $('#technology_check_form').submit();
    });

    $('#higher_funding_money').bind('input propertychange',function(){
        totalamount();
    });

    $('#hospital_funding_money').bind('input propertychange',function(){
        totalamount();
    });

    totalamount();
});

function totalamount(){
    $('#total_amount').val(Number($('#higher_funding_money').val())+Number($('#hospital_funding_money').val()));
}