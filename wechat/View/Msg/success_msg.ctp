<!DOCTYPE html>
<html>
<head>
    <title>信息</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=$this->Html->css('jquery.mobile-1.4.5.min');?>
    <?=$this->Html->script(array('jquery-1.11.3.min','jquery.mobile-1.4.5.min'));?>
</head>
<body>
    <div data-role="page">
        <div data-role="main" class="ui-content">
            <div style="margin:50px auto;width:160px;height:160px;border-radius:50%;background-color:rgba(0,0,0,.3);background-repeat:no-repeat;background-size:120px; background-position:center; background-image:url('data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22iso-8859-1%22%3F%3E%3C!DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%20%20width%3D%2214px%22%20height%3D%2214px%22%20viewBox%3D%220%200%2014%2014%22%20style%3D%22enable-background%3Anew%200%200%2014%2014%3B%22%20xml%3Aspace%3D%22preserve%22%3E%3Cpolygon%20style%3D%22fill%3A%23FFFFFF%3B%22%20points%3D%2214%2C4%2011%2C1%205.003%2C6.997%203%2C5%200%2C8%204.966%2C13%204.983%2C12.982%205%2C13%20%22%2F%3E%3C%2Fsvg%3E')">
            </div>
            <h3 style="text-align:center;"><?=$msg;?></h3>

            <?php
                if( is_array($url) ):
            ?>
            <a href="<?=$this->Html->url($url)?>" class="ui-btn" data-role="none" data-ajax="false">确定</a>
            <?php
                else:
            ?>
            <a href="<?=$url;?>" class="ui-btn" data-role="none" data-ajax="false">确定</a>
            <?php
                endif;
            ?>
            <a href="javascript:WeixinJSBridge.call('closeWindow');" class="ui-btn">关闭</a>


        </div>
    </div>
</body>
</html>