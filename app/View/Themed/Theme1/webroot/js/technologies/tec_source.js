//选择项目负责人
var director_user_setting = {
    async: {
        enable: true,
        url: getUrl
    },
    view: {
        selectedMulti: false
    },
    edit: {
        enable: true,
        showRemoveBtn: false,
        showRenameBtn: false
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    callback: {
        beforeClick: beforeClick
    }
};
//选择项目参与人员
var participants_setting = {
    async: {
        enable: true,
        url: getUrl
    },
    view: {
        selectedMulti: false
    },
    check: {
        enable: true
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    callback: {
        onCheck: onCheck
    }
};

var zNodes =[];
function getUrl(treeId, treeNode){
    var parma = $('#director_user_list').attr('url');
    if( typeof(treeNode) != 'undefined' ){
        parma = treeNode.getSubsetUrl + '/' + treeNode.id;
    }
    return parma;
}

function beforeClick(treeId, treeNode) {

    if( !treeNode.isParent ){
        $('#director_user_name').val(treeNode.name);
        $('#director_user_id').val(treeNode.id);
        $('#director_user_tel').val(treeNode.tel);
    }
    return !treeNode.isCur;
}
function onCheck(treeId, treeNode){
    var participants_user_name = Array();
    var participants_user_id = Array();
    $.each($.fn.zTree.getZTreeObj("participants_list").getCheckedNodes(true), function(i,obj){
        if( !obj.isParent ){
            participants_user_name.push(obj.name);
            participants_user_id.push(obj.id);
        }
    });
    $("#participants_user_name").val(participants_user_name.join("、"));
    $("#participants_user_id").val(participants_user_id.join(","));

}


$(document).ready(function(){
    $.fn.zTree.init($("#director_user_list"), director_user_setting, zNodes);
    $.fn.zTree.init($("#participants_list"), participants_setting, zNodes);

    var date = new Date();
    $("#item_number").val('C'+date.pattern("yyyyMMddHmmss"));

    //提交添加项目来源的form表单
    $("#save_report").click(function(){
        $('#state_input').val('SAVE_REPORT');
    });
    $("#save").click(function(){
        $('#state_input').val('SAVE');
    });
});


Date.prototype.pattern = function (fmt) {
    var o = {
        "M+" : this.getMonth() + 1, //月份
        "d+" : this.getDate(), //日
        "h+" : this.getHours() % 12 == 0 ? 12 : this.getHours() % 12, //小时
        "H+" : this.getHours(), //小时
        "m+" : this.getMinutes(), //分
        "s+" : this.getSeconds(), //秒
        "q+" : Math.floor((this.getMonth() + 3) / 3), //季度
        "S" : this.getMilliseconds() //毫秒
    };
    var week = {
        "0" : "/u65e5",
        "1" : "/u4e00",
        "2" : "/u4e8c",
        "3" : "/u4e09",
        "4" : "/u56db",
        "5" : "/u4e94",
        "6" : "/u516d"
    };
    if (/(y+)/.test(fmt)) {
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    if (/(E+)/.test(fmt)) {
        fmt = fmt.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? "/u661f/u671f" : "/u5468") : "") + week[this.getDay() + ""]);
    }
    for (var k in o) {
        if (new RegExp("(" + k + ")").test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        }
    }
    return fmt;
}