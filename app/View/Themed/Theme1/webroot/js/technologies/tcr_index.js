function fund_del(thisNode,params){

    if( typeof(params) == 'object' ){

        $.ajax({
            url:params.remove_url,
            type:'post',
            dataType:'json',
            data:{fees_detail_id:params.id},
            success:function(data){
                if(data){
                    $(thisNode).closest('tr').remove();
                }else{
                    alert('删除失败');
                }
            },
            error:function(){
                alert('删除失败,请重试!');
            }
        });

    }else{

        $(thisNode).closest('tr').remove();
        
    }

}

function add_input(fees_detail_id){

    var fund_type_val = $('.fund_type_input').val();
    var fund_cost_val = $('.fund_cost_input').val();


    var fund_type_input_td = $('<td>');
    var fund_cost_input_td = $('<td>');

    var fund_del_btn_td = $('<td>');

    var fund_type_input = $('<input>').addClass('span3')
                                      .attr(
                                            {
                                                type:'text',
                                                name:function(){return fees_detail_id=='undefined'?$('.fund_type_input').attr('name').replace('[0]','['+$('.fund_tab tbody tr').length+']'):$('.fund_type_input').attr('name').replace('[0]','['+fees_detail_id+']');}
                                            }
                                        )
                                      .val(fund_type_val);

    var fund_cost_input = $('<input>').addClass('span2')
                                      .attr({
                                                type:'text',
                                                name:function(){return fees_detail_id=='undefined'?$('.fund_cost_input').attr('name').replace('[0]','['+$('.fund_tab tbody tr').length+']'):$('.fund_cost_input').attr('name').replace('[0]','['+fees_detail_id+']');}

                                            })
                                      .val(fund_cost_val);
    var fund_id_input = $('<input>').attr({
                                    type:'hidden',
                                    name:function(){return fees_detail_id=='undefined'?$('.fund_id').attr('name').replace('[0]','['+$('.fund_tab tbody tr').length+']'):$('.fund_id').attr('name').replace('[0]','['+fees_detail_id+']');}
                                })
                            .val(fees_detail_id);

    var fund_del_btn = $('<button>').addClass('btn span2')
                                    .attr(
                                        {
                                            'type':'button',
                                            'onclick':'return fund_del(this)'
                                        })
                                    .html('<i class="halflings-icon white minus-sign"></i> 删除');

    if(fees_detail_id !='undefined'){
        fund_id_input.appendTo(fund_cost_input_td);
    }

    fund_type_input.appendTo(fund_type_input_td);
    fund_cost_input.appendTo(fund_cost_input_td);
    fund_del_btn.appendTo(fund_del_btn_td);




    var tr = $('<tr>');

    fund_type_input_td.appendTo(tr);
    fund_cost_input_td.appendTo(tr);
    fund_del_btn_td.appendTo(tr);



    $('.fund_tab tbody').prepend(tr);


    $('.fund_type_input').val(null);
    $('.fund_cost_input').val(null);
}

$(function(){
    $(".fund_add_btn").click(function(){
        var fees_detail_id = $(this).attr('fees_detail_id');
        if( $(this).attr('url') == 'undefined'){
            add_input();
        }else{
            $.ajax({
                url:$(this).attr('url'),
                type:'post',
                dataType:'json',
                data:{
                    usage_fees:$('.fund_type_input').val(),
                    fees:$('.fund_cost_input').val(),
                    contract_id: fees_detail_id
                },
                success:function(data){
                    if(data.stata){
                        add_input(data.fees_detail_id);
                    }else{
                        alert('添加失败!');
                    }

                },
                error:function(){
                    alert('添加失败,请重试!');
                }

            });
        }

    });


});