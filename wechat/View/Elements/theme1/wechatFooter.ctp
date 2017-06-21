<!-- footer -->
<!--div class="active sel-menu-ui" id="sel-menu" data-state="">
    <span style="background-color: #5865ed;" class="agent-article"><i class="icon-flag"></i> 代理政策</span>
    <span style="background-color: #d64a5f;" class="about-us"><i class="icon-book"></i> 关于我们</span>
    <span style="background-color: #48d848;" class="head_message"><i class="icon-comments-alt"></i> 在线留言</span>
    <?php if(!empty($about)):?>
    <span style="background-color: #cd48d8;"><i class="icon-phone"></i> <a href="tel:<?php echo $about['Article']['tel']?>" style="color: white;line-height: 1.3;font-weight: 400;">400电话<a/></span>
    <?php endif?>
</div>
    <div class="footer">
        <p class="footer-menu" id="work-order">
            <a href="" class='menu-link'>
                <i class="icon-tasks"></i>
                <span id="work-order">工单</span>
            </a>
        </p>
        
        <p class="footer-menu" id="my-zone" data-url="/wechat/index/my_agents">
            <a href="#" class='menu-link'>
                <i class="icon-user"></i>
                <span id="my-zone">我的代理</span>
            </a>
        </p>

        <p class="footer-menu" id="about-us" data-url="1">
            <a href="#" class='menu-link'>
                <i class="icon-book"></i>
                <span id="about-us">关于我们</span>
            </a>
        </p>
    </div-->
</body>
<script type="text/javascript">
    $(function(){
        $('#about-us').bind('click', function(){
            var state = $('#sel-menu').data('state');
            if(state == 1){
                $('#sel-menu').addClass('active');
                $('#sel-menu').data('state', 2);
            }else{
                $('#sel-menu').removeClass('active');
                $('#sel-menu').data('state', 1);
            }
        });
        $('.head_message').bind('click', function(){
            location.href = "/wechat/aboutus/get_msg_list";
        });

        $('.agent-article').bind('click', function(){
            location.href = "/wechat/aboutus/agent_article";
        });

        $('.about-us').bind('click', function(){
            location.href = "/wechat/aboutus/index";
        });

        $('.footer-menu').bind('click', function(){
            $(this).children().children().addClass('icon-color');
            $(this).siblings().children().children().removeClass('icon-color');
            if($(this).data('url') != 1){
                location.href = $(this).data('url');
            }
           
        });
    });
    
</script>
</html>