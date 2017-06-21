$(function(){

    $('.approval_iframe_url').each(function(){
        $(this).click(function(){
            $('#approval_iframe_title').text($(this).attr('approval_alter_iframe_title'));
            $('#approval_iframe').attr('src',$(this).attr('iframe_url'));
        });
    });
});
