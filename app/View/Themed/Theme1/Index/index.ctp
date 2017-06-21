<?php 
	//加载本页面专属css样式
	$this->Html->css(array('daterangepicker','fullcalendar'),array('block'=>'cssInHead','inline'=>false));
$this->Html->css(array('jqvmap','jquery.easy-pie-chart'),array("media" => "screen",'block'=>'cssInHead','inline'=>false));
//加载公共头部文件
echo $this->element('theme1/CommonHead');
echo $this->element('theme1/CommonLeft');

?>

<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title">

    工作面板
    <small>工作任务及统计</small>

</h3>

<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="#">首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="#">工作面板</a></li>

</ul>

<div id="dashboard">

    <!-- BEGIN DASHBOARD STATS -->

    <div class="row-fluid">

        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">

            <div class="dashboard-stat blue">

                <div class="visual">

                    <i class="icon-comments"></i>

                </div>

                <div class="details">

                    <div class="number">

                        11条

                    </div>

                    <div class="desc">

                        当前等待划拨工单

                    </div>

                </div>

                <a class="more" href="#">

                    详情 <i class="m-icon-swapright m-icon-white"></i>

                </a>

            </div>

        </div>

        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">

            <div class="dashboard-stat green">

                <div class="visual">

                    <i class="icon-coffee"></i>

                </div>

                <div class="details">

                    <div class="number">21条</div>

                    <div class="desc">待完成客服工单</div>

                </div>

                <a class="more" href="#">

                    详情 <i class="m-icon-swapright m-icon-white"></i>

                </a>

            </div>

        </div>

        <div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">

            <div class="dashboard-stat purple">

                <div class="visual">

                    <i class="icon-fire"></i>

                </div>

                <div class="details">

                    <div class="number">233</div>

                    <div class="desc">本月商户活跃度</div>

                </div>

                <a class="more" href="#">

                    详情 <i class="m-icon-swapright m-icon-white"></i>

                </a>

            </div>

        </div>

        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">

            <div class="dashboard-stat yellow">

                <div class="visual">

                    <i class="icon-group"></i>

                </div>

                <div class="details">

                    <div class="number">233</div>

                    <div class="desc">本月代理商活跃度</div>

                </div>

                <a class="more" href="#">

                    详情 <i class="m-icon-swapright m-icon-white"></i>

                </a>

            </div>

        </div>

    </div>

    <!-- END DASHBOARD STATS -->

    <div class="clearfix"></div>
    <div class="row-fluid">
        <div class="span6" style='width:100%'>

            <!-- BEGIN PORTLET-->

            <div class="portlet solid bordered light-grey">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-bar-chart"></i>商户交易统计</div>

                    <div class="tools">

                        <div class="btn-group pull-right" data-toggle="buttons-radio">


                        </div>

                    </div>

                </div>

                <div class="portlet-body">

                    <div id="customer_chart_container" style="width:100%;height:400px"></div>

                </div>

            </div>

            <!-- END PORTLET-->

        </div>


    </div>

    <div class="row-fluid">
        <div class="span6" style='width:100%'>

            <!-- BEGIN PORTLET-->

            <div class="portlet solid light-grey bordered">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-bullhorn"></i>商户激活统计</div>

                    <div class="tools">

                        <div class="btn-group pull-right" data-toggle="buttons-radio">


                        </div>

                    </div>

                </div>

                <div class="portlet-body">

                    <div id="active_chart_container" style="width:100%;height:400px"></div>

                </div>

            </div>

            <!-- END PORTLET-->

        </div>


    </div>

</div>

<div class="clearfix"></div>
<!-- END CONTAINER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<?php 
	//加载公共js文件
	echo $this->element('theme1/CommonJs');
?>
<!-- BEGIN PAGE LEVEL PLUGINS页面插件 -->
<?php 
	//加载本页面专属js文件
	echo $this->Html->script(array('jquery.flot','jquery.flot.resize','jquery.pulsate.min','date','daterangepicker','fullcalendar.min','jquery.easy-pie-chart','jquery.sparkline.min'));
?>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php 
	//app.js为公用js文件
	echo $this->Html->script("app");
?>
<?php
 
 echo $this->Html->script("chartjs/highcharts.js");
echo $this->Html->script("chartjs/exporting.js");
?>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    //本页面初始化
    jQuery(document).ready(function () {

        App.init(); // initlayout and core plugins

    });


    $(function () {
        $('#customer_chart_container').highcharts({
            //chart: {
            //	type: 'spline'
            //},
            title: {
                text: '商户每日交易对比折线图'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                tickInterval: 1,
                min: 1,
                max: 30,
                labels: {
                    //step: 1
                }
            },
            yAxis: {
                title: {
                    text: '交易金额'
                }
                ,
                tickInterval: 2000000,
            }
            ,
            tooltip: {
                headerFormat: '<b>{series.name}-{point.x}日</b><br>',
                pointFormat: '￥{point.y:.2f}元',
            }
            ,
            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            }
            ,
            exporting: {
                enabled: false
            }
            ,
            credits: {
                enabled: false
            }
            ,

            series: [
                {
                    name: '',
                    data: []
                },
                {
                    name: '',
                    data: []
                }
            ]
        })
        ;

        $('#active_chart_container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '商户每日新增激活对比柱状图'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                tickInterval: 1,
                min: 1,
                max: '',
                labels: {
                    //step: 1
                }
            },
            yAxis: {
                title: {
                    text: '新增激活数量'
                }
                ,
                tickInterval: 50,
            }
            ,
            tooltip: {
                headerFormat: '<b>{series.name}-{point.x}日</b><br>',
                pointFormat: '{point.y}户',
            }
            ,
            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            }
            ,
            exporting: {
                enabled: false
            }
            ,
            credits: {
                enabled: false
            }
            ,
            series: [
                {
                    name: '1',
                    data: []
                },
                {
                    name: '2',
                    data: []
                }
            ]
        })
        ;
    })
    ;

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>