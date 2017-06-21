<?php
    echo $this->Html->css(array('common','font-style','weui.min','weui-font'));
echo $this->element('theme1/wechatHead');
?>
<style>
    .weui-input{
        color: grey;
    }
    .for_take_way{

    }
    .tipsdiv{width:70%;height: 5rem; position: fixed;line-height: 5.2rem;
        left: 15%; top: 50%; z-index: 99999;
        margin-top: -2.5rem;background-color: rgba(0,0,0,0.6);
        color: #f7f7f7;font-size: 18px; text-align: center;
    }
    .b_radius{
        overflow: hidden;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
    }
    .popbg {background-color: #000;
        width: 100%;height: 100%;
        left:0;
        top:0;/*FF IE7*/
        filter:alpha(opacity=50);/*IE*/
        opacity:0.5;/*FF*/
        z-index:99;
        position:fixed!important;/*FF IE7*/
        position:absolute;/*IE6*/
    }
    .tipsdiv2{width:70%;height: 5rem; position: fixed;line-height: 5.2rem;
        left: 15%; top: 50%; z-index: 9999;
        margin-top: -2.5rem;background-color: rgba(0,0,0,0.6);
        color: #f7f7f7;font-size: 18px; text-align: center;
    }
    .b_radius2{
        overflow: hidden;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
    }
    .popbg2 {background-color: #000;
        width: 100%;height: 100%;
        left:0;
        top:0;/*FF IE7*/
        filter:alpha(opacity=50);/*IE*/
        opacity:0.5;/*FF*/
        z-index:99;
        position:fixed!important;/*FF IE7*/
        position:absolute;/*IE6*/
    }
    .img_span{
        position: absolute;
        background-color: orange;
        height: 55px;
        padding-top: 15px;
        width: 22%;
        border-radius: 5px;
        text-align: center;
        font-size: 15px;
        color: black;
    }
    #icon-uploading2 i {
        line-height: 1.7em;
        font-size: 2.8em;
    }
</style>
<div id="bd-wrapper">
    <form id="apply">
    <div class="account_form">
        <ul class="input_group" style="height: 40px;border: none;background: #f2f2f2;text-align: center;">
            <span style="font-size: 15px;height: 40px;line-height: 40px;color: grey">产品类型</span>
            <li class="input input_id" style="width: 72%;float: right;border-left: 1px solid gainsboro">
                <select name="type_id" id="type_id" style="height: 40px;width: 100%;border: none;background: #f2f2f2;">
                    <?php foreach($types as $key=>$val):?>
                        <option value="<?php echo $val['ApplyType']['id'];?>" data-price="<?php echo $val['ApplyType']['price'];?>"><?php echo $val['ApplyType']['name'];?></option>
                    <?php endforeach;?>
                </select>
            </li>
        </ul>
        <ul class="input_group" style="height: 40px;border: none;background: #f2f2f2;text-align: center;">
            <span style="font-size: 15px;height: 40px;line-height: 40px;color: grey">台数</span>
            <li class="input input_id" style="width: 72%;float: right;border-left: 1px solid gainsboro">
                <input type="number" name="num" id="num" style="height: 40px;font-size: 15px;" class="weui-input" placeholder="请输入台数,不小于5!" >
            </li>
        </ul>
        <ul class="input_group" style="height: 40px;border: none;background: #f2f2f2;text-align: center;">
            <span style="font-size: 15px;height: 40px;line-height: 40px;color: grey">提货方式</span>
            <li class="input input_id" style="width: 72%;float: right;border-left: 1px solid gainsboro">
                <select name="take_way" id="take_way" style="height: 40px;width: 100%;border: none;background: #f2f2f2;">
                    <option value="自提" >自提</option>
                    <option value="邮寄" >邮寄</option>
                </select>
            </li>
        </ul>
        <span class="for_take_way" style="color: green;display: none;line-height: 25px;"><img style="margin-left: 0px;width: 20px;" src="/img/warning.png"><span style="font-size: 13px;padding-left: 3px;">机具数量小于10台邮费为顺丰到付,大于等于10台包邮!</span></span>
        <ul class="input_group for_take_way" style="display: none;height: 40px;border: none;background: #f2f2f2;text-align: center;">
            <span style="font-size: 15px;height: 40px;line-height: 40px;color: grey">收件人</span>
            <li class="input input_id" style="width: 72%;float: right;border-left: 1px solid gainsboro">
                <input type="text" id="take_name" name="take_name" style="height: 40px;font-size: 15px;" class="weui-input" placeholder="请输入收件人姓名" >
            </li>
        </ul>
        <ul class="input_group for_take_way" style="display: none;height: 40px;border: none;background: #f2f2f2;text-align: center;">
            <span style="font-size: 15px;height: 40px;line-height: 40px;color: grey">联系电话</span>
            <li class="input input_id" style="width: 72%;float: right;border-left: 1px solid gainsboro">
                <input type="number" id="take_phone" name="take_phone" style="height: 40px;font-size: 15px;" class="weui-input" placeholder="请输入收件人电话" >
            </li>
        </ul>
        <ul class="input_group for_take_way" style="display: none;height: 40px;border: none;background: #f2f2f2;text-align: center;">
            <span style="font-size: 15px;height: 40px;line-height: 40px;color: grey">收件地址</span>
            <li class="input input_id" style="width: 75%;float: right;border-left: 1px solid gainsboro;padding: 0 0 0 10px;">
                <input type="text" id="address" name="address" style="width: 84%;display: inline-block;height: 40px;font-size: 15px;" class="weui-input" placeholder="点击右边图标获取当前位置" >
                <img id="my_local" src="/img/local.png" style="height: 39px">
            </li>
        </ul>
        <ul class="input_group" style="height: 40px;border: none;background: #f2f2f2;text-align: center;">
            <span style="font-size: 15px;height: 40px;line-height: 40px;color: grey">押金总额</span>
            <li class="input input_id" style="width: 72%;float: right;border-left: 1px solid gainsboro">
                <input type="number" id="total_price" name="total_price" style="height: 40px;font-size: 15px;" class="weui-input" readOnly="true" value="0">
            </li>
        </ul>
        <ul class="input_group" style="height: 40px;border: none;background: #f2f2f2;text-align: center;">
            <span style="font-size: 15px;height: 40px;line-height: 40px;color: grey">押金支付</span>
            <li class="input input_id" style="width: 72%;float: right;border-left: 1px solid gainsboro">
                <select name="pay_type" id="pay_type" style="height: 40px;width: 100%;border: none;background: #f2f2f2;">
                    <option value="线下支付" >线下支付</option>
                </select>
            </li>
        </ul>
        <div style="position: relative;">
            <div id="img-upload" style="height: 70px;display: inline-block;width: 29%">
                <!--<i class="icon-upload-alt"></i>-->
                <span class="img_span">上传<br/>支付凭证</span>
                <input type="file" name="project_img" style="width: 75px;height: 70px;margin-top: 0;"  class="default" id="upload-file" />

            </div>
            <div id="img-list" style="display: inline-block;width: 70%;">

            </div>
        </div>
        <ul class="input_group" style="height: 84px;border: none;background: #f2f2f2;text-align: center;">
            <span style="font-size: 15px;height: 84px;line-height: 84px;color: grey">备注</span>
            <li class="input input_id" style="width: 72%;float: right;border-left: 1px solid gainsboro">
                <textarea name="remark" id="remark" style="width: 100%;padding: 5px 0;border: none;background: #f2f2f2;resize:none;height: 78px"></textarea>
            </li>
        </ul>
        <div id="sources">

        </div>
        <div style="position: relative;">
            <div id="img-upload2" style="height: 70px;display: inline-block;width: 29%">
                <span class="img_span">上传<br/>其他附件</span>
                <input type="file" style="width: 75px;height: 70px;margin-top: 0;" name="project_img" class="default" id="upload-file2" />
            </div>
            <div id="img-list2" style="display: inline-block;width: 70%;">

            </div>
        </div><br/>
        <span id="error-span" style="color: red"></span>
        <span id="success-span" style="color: #1aad19"></span>
        <div class="uploadImgArea" style="display: none"></div>
    </div>
    <div class="mod_btns"><a onclick="uploadAllImages()" href="javascript:;" class="pay-btn weui-btn weui-btn_primary bangding" id="sub-btn" data-tag="submit" style="font-size: 20px;">提交申请</a></div>
    </form>
</div>
<?php
    echo $this->Html->script('jquery-1.11.3.min');
?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
    //索引
    var num=1;
    //图片提交的表单
    var imgForm = $('#apply');
    //图片显示区域
    var imgArea = imgForm.find("#img-list");
    var imgArea2 = imgForm.find("#img-list2");
    //图片上传区域
    var uploadImgArea = imgForm.find(".uploadImgArea");
    //默认图片大小
    var maxsize = 100 * 1024;//100kb
    var maxWidth=800;
    var maxHeight=600;
    //    用于压缩图片的canvas
    var canvas = document.createElement("canvas");
    var ctx = canvas.getContext('2d');
    //    瓦片canvas
    var tCanvas = document.createElement("canvas");
    var tctx = tCanvas.getContext("2d");
    //触发选择控件
    var fileChoose = $("#upload-file");
    var fileChoose2 = $("#upload-file2");
    //触发选择控件的onchange事件  支付凭证
    fileChoose.change(function() {
        $('#error-span').text('');
        var el ='<div id="icon-uploading">'+
                '<i class="icon-spinner icon-spin"></i>'+
                '</div>';
        imgArea.append(el);
        //判断是否选择文件
        if (!this.files.length) {
            $('#icon-uploading').remove();
            return false;
        }
        //已上传数量
        var img_list = $('#img-list').find('img');
        if(img_list.length >= 1){
            $('#error-span').text('押金支付凭证图片只能上传1张！');
            $('#icon-uploading').remove();
            return false;
        }
        var files = Array.prototype.slice.call(this.files);
        //判断选择文件数量
        if (files.length > 1) {
            $('#error-span').text('押金支付凭证图片只能上传1张！');
            $('#icon-uploading').remove();
            return false;
        }
        var file = files[0];
        //格式校验
        if (!/\/(?:jpeg|png|gif)/i.test(file.type)) {
            $('#error-span').text('图片格式不支持！');
            $('#icon-uploading').remove();
            return false;
        }
        //获取图片大小如果需要显示可以加载
        var size = file.size / 1024 > 1024 ? (~~(10 * file.size / 1024 / 1024))
        / 10 + "MB"
                : ~~(file.size / 1024) + "KB";
        //获取图片路径
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function() {
            var result = this.result;
            var rand_str='one'+num;
            num++;
            var showImg ='<div class="img-item">'+
                            '<span class="btn-img-remove">'+
                            '<i class="icon-remove-sign"></i></span>'+
                            '<img class="pay_order_img" input-class="'+rand_str+'" src="'+ result +'">'+
                            '</div>';
            var inputFile = "<input type='file' name='one' class='"+rand_str+"' accept='image/*' value='"+result+"'>";
            $('#icon-uploading').remove();
            $(showImg).appendTo(imgArea);
            $(inputFile).appendTo(uploadImgArea);
        };
    });
    //附件上传
    fileChoose2.change(function() {
        $('#error-span').text('');
        var el ='<div id="icon-uploading2">'+
                '<i class="icon-spinner icon-spin"></i>'+
                '</div>';
        imgArea2.append(el);
        //判断是否选择文件
        if (!this.files.length) {
            $('#icon-uploading2').remove();
            return false;
        }
        //已上传数量
        var img_list = $('#img-list2').find('img');
        if(img_list.length >= 4){
            $('#error-span').text('附件图片上传不能超过4张！');
            $('#icon-uploading2').remove();
            return false;
        }
        var files = Array.prototype.slice.call(this.files);
        //判断选择文件数量
        if (files.length > 1) {
            $('#error-span').text('最多同时只可上传1张图片！');
            $('#icon-uploading2').remove();
            return false;
        }
        var file = files[0];
        //格式校验
        if (!/\/(?:jpeg|png|gif)/i.test(file.type)) {
            $('#error-span').text('图片格式不支持！');
            $('#icon-uploading2').remove();
            return false;
        }
        //获取图片大小如果需要显示可以加载
        var size = file.size / 1024 > 1024 ? (~~(10 * file.size / 1024 / 1024))
        / 10 + "MB"
                : ~~(file.size / 1024) + "KB";
        //获取图片路径
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function() {
            var result = this.result;
            var rand_str='more'+num;
            num++;
            var showImg ='<div class="img-item">'+
                            '<span class="btn-img-remove">'+
                            '<i class="icon-remove-sign"></i></span>'+
                            '<img class="pay_order_img" input-class="'+rand_str+'" src="'+ result +'">'+
                            '</div>';
            var inputFile = "<input type='file' name='more[]' class='"+rand_str+"' accept='image/*' value='"+result+"'>";
            $('#icon-uploading2').remove();
            $(showImg).appendTo(imgArea2);
            $(inputFile).appendTo(uploadImgArea);
        };
    });

    //表单的提交事件
    function uploadAllImages() {
        $('#error-span').text('');
        var datas=load_datas();
        if(datas==false){
            return false;
        }
        var formdata = new FormData();
        formdata.append("datas",JSON.stringify(datas));
        alert_loading('申请提交中...');
        uploadImgArea.find("input").each(function(i,element){
            var basestr=$(this).attr("value");
            var img_name=$(element).attr('name');
            var img = new Image();
            img.src = basestr;
            var format = (basestr.split(",")[0]).split(";")[0];
            format=format.substring(5,format.length);
            formdata.append("formatType",format);
            var filePixels=(img.height*img.width);
            //如果文件的像素大于限定的像素，那么就压缩还有gif
            if(filePixels>(maxHeight*maxWidth)){
                basestr=compress(img,format);
            }else if( basestr.length > maxsize){
                basestr=compress(img,format);
            }
            var text = window.atob(basestr.split(",")[1]);
            var buffer = new Uint8Array(text.length);
            for (var i = 0; i < text.length; i++) {
                buffer[i] = text.charCodeAt(i);
            }
            var blob = getBlob([buffer], format);
            formdata.append("img"+i,blob);
            if(img_name=='one'){
                formdata.append("one","img"+i);
            }
        });
        $.ajax({
            url : '/ApplyMachines/ajax_create',
            type : 'POST', //GET
            cache : false,
            data : formdata,
            processData : false, // 不处理发送的数据，因为data值是Formdata对象，不需要对数据做处理
            contentType : false, // 不设置Content-type请求头
            success : function(data, textStatus, jqXHR) {
                if(data==1){
                    $(".tipsdiv2").remove();
                    alert_tips('申请提交成功!');
                    setTimeout(function(){
                        location.reload();
                    },2000);
                }else{
                    $(".tipsdiv2").remove();
                    $(".popbg2").remove();
                    $('#error-span').text('申请失败.请核对输入信息是否完整!');
                }
            },
            error : function(xhr, textStatus) {
                $(".tipsdiv2").remove();
                $('#error-span').text('申请失败.请核对输入信息是否完整!');
            }
        });
        return false;
    }
    /**
     * 获取blob对象的兼容性写法
     * @param buffer
     * @param format
     * @returns {*}
     */
    function getBlob(buffer, format) {
        try {
            return new Blob(buffer, {
                type : format
            });
        } catch (e) {
            var bb = new (window.BlobBuilder || window.WebKitBlobBuilder || window.MSBlobBuilder);
            buffer.forEach(function(buf) {
                bb.append(buf);
            });
            return bb.getBlob(format);
        }
    }
    //使用canvas对大图片进行压缩
    function compress(img,formatType) {
        var initSize = img.src.length;
        var width = img.width;
        var height = img.height;
        //如果图片大于80万像素，计算压缩比并将大小压至80万以下
        var ratio;
        if ((ratio = width * height / 800000) > 1) {
            ratio = Math.sqrt(ratio);
            width /= ratio;
            height /= ratio;
        } else {
            ratio = 1;
        }
        canvas.width = width;
        canvas.height = height;
        //铺底色
        ctx.fillStyle = "#fff";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(img, 0, 0, width, height);
        //进行压缩
        var ndata = canvas.toDataURL(formatType, 0.8);
        tCanvas.width = tCanvas.height = canvas.width = canvas.height = 0;
        return ndata;
    }
    //获得数据
    function load_datas(){
        var data={};
        data.type_id = $('#type_id').val();
        data.num = $('#num').val();
        data.take_way = $('#take_way').val();
        data.total_price = $('#total_price').val();
        data.pay_type = $('#pay_type').val();
        data.remark = $('#remark').val();
        var reg_phone=/^(13\d|14[579]|15\d|17[01235678]|18\d)\d{8}$/i;
        var reg_num=/^\+?[1-9][0-9]*$/;
        if(data.type_id == ''||data.take_way==''||data.total_price==''||data.pay_type==''){
            $('#error-span').text('请确认所有项都填写完整!');
            return false;
        }
        if(data.num == ''||data.num == 'NaN'||data.num < 5||!reg_num.test(data.num)){
            $('#error-span').text('台数必须为不得小于5的整数!');
            return false;
        }
        if(data.pay_type=='线下支付'){
            var order_img=$('#img-list .pay_order_img').length;
            if(order_img==0){
                $('#error-span').text('请确认已上传支付凭证!');
                return false;
            }
        }
        if(data.take_way=='邮寄'){
            data.address=$('#address').val();
            data.take_name=$('#take_name').val();
            data.take_phone=$('#take_phone').val();
            if(data.take_phone.length != 11 || data.take_phone == ''||!reg_phone.test(data.take_phone)){
                $('#error-span').text('请填写正确的电话号码!');
                return false;
            }
            if(data.address==''||data.take_name==''){
                $('#error-span').text('请确认收件人和地址填写完整!');
                return false;
            }
        }
        return data;
    }

    //点击删除支付凭证图片
    $('#img-list').delegate('.icon-remove-sign', 'click', function(){
        var path=$(this).parent().next('.pay_order_img').attr('input-class');
        $(this).closest('.img-item').remove();
        $('.'+path).remove();
    });
    //点击删除附件图片
    $('#img-list2').delegate('.icon-remove-sign', 'click', function(){
        var path=$(this).parent().next('.sources_img').attr('input-class');
        $(this).closest('.img-item').remove();
        $('.'+path).remove();
    });
    //根据提货方式是否显示收货地址输入
    $('#take_way').change(function(){
        var now=$(this).val();
        if(now=='邮寄'){
            $('.for_take_way').css('display','block');
        }else{
            $('.for_take_way').css('display','none');
        }
    });
    //根据台数计算金额
    $('#num').blur(function(){
        $('#error-span').text('');
        var num=$(this).val();
        var reg_num=/^\+?[1-9][0-9]*$/;
        if(num == ''||num == 'NaN'||num < 5||!reg_num.test(num)){
            $('#error-span').text('台数必须为不得小于5的整数!');
            return false;
        }
        var price=$('#type_id option:selected').attr('data-price');
        var total=parseInt(num) * parseInt(price);
        $('#total_price').val(total);
    });
    //产品改变事件同时重算金额
    $('#type_id').change(function(){
        var price=$('#type_id option:selected').attr('data-price');
        var num=$('#num').val();
        var reg_num=/^\+?[1-9][0-9]*$/;
        if(!reg_num.test(num)){
            $('#total_price').val('0');
        }else{
            $('#error-span').text('');
            if(num == ''||num == 'NaN'||num < 5||!reg_num.test(num)){
                $('#error-span').text('台数必须为不得小于5的整数!');
                return false;
            }
            var total=parseInt(num) * parseInt(price);
            $('#total_price').val(total);
        }
    });

    //提示窗
    function alert_tips(content){
        var arr = [];
        arr.push('<div class="tipsdiv b_radius">'+content+'</div>');
        arr.push('<div class="popbg"></div>');
        var is_tips = $(".tipsdiv").length;
        if(is_tips == 0){
            $("body").append(arr.join(""));
        }
//        setTimeout(function(){
//            $(".tipsdiv").remove();
//        },4000);
    }

    //加载中
    function alert_loading(content){
        var arr = [];
        arr.push('<div class="tipsdiv2 b_radius2">'+content+'</div>');
        arr.push('<div class="popbg2"></div>');
        var is_tips = $(".tipsdiv2").length;
        if(is_tips == 0){
            $("body").append(arr.join(""));
        }
    }
    wx.config(<?php echo $js_local; ?>);
    $('#my_local').click(function(){
        wx.ready(function(){
            wx.getLocation({
                type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180
                    $.getJSON('/ApplyMachines/my_local',{x:latitude,y:longitude},function(res){
                        if(res.status==0){
                            alert_tips(res.msg);
                            setTimeout(function(){
                                $(".tipsdiv").remove();
                            },2000);
                        }else{
                            $('#address').val(res.msg);
                        }
                    });
                }
            });
        });
    });
</script>