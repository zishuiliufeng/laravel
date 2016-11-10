<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>云书签</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="/yunmarker/client/assets/css/amazeui.flat.css">
    <style>
    .marker_box {
        padding-left: 50px;
        padding-right: 50px;
    }
    .confirm-list i{
        position: absolute;
        right: 10px;
        top: 15px;
        color: #888;
        width: 60px;
        text-align: center;
        cursor: pointer;

    }
    

    .del {
        margin-right: 10px;
        color: gray
    }

    .modify {
        margin-right: 10px;
        color: gray
    }
  </style>
</head>
<body>
    <header class="am-topbar am-topbar-fixed-top">
        <div style="margin:0 50px 0 50px">
            <h1 class="am-topbar-brand">
                <a href="#"><i class="am-icon-bookmark"></i> 云书签</a>
            </h1>
            <div class="am-topbar-right">
                <button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm" id="back">
                    <span class="am-icon-undo"></span>
                    返回
                </button>
            </div>
            <div class="am-topbar-right">
                <button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm" id="search">
                    <span class="am-icon-search"></span>
                    查找
                </button>
            </div>
            <div class="am-topbar-right">
                <button class="am-btn am-btn-success am-topbar-btn am-btn-sm" id="add" classification_id="<?php echo ($classification_id); ?>">
                    <span class="am-icon-plus"></span>
                    添加书签
                </button>
            </div>
        </div>

    </header>
    <br>
    
    <div class="marker_box">
        <ul class="am-list confirm-list" id="marker_list">
            <?php if(is_array($marker)): $i = 0; $__LIST__ = $marker;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mk): $mod = ($i % 2 );++$i;?><li><a  id="<?php echo ($mk["marker_id"]); ?>" style="font-size: 15px" href="<?php echo ($mk["href"]); ?>" target="_blank"><img class="am-radius" src="<?php echo ($mk["icon"]); ?>" width="16px" height="16px"/> <?php echo ($mk["title"]); ?></a><i><a class="modify" data-marker_id="<?php echo ($mk["marker_id"]); ?>"><span class="am-icon-pencil"></span></a> <a class="del" data-marker_id="<?php echo ($mk["marker_id"]); ?>"><span class="am-icon-times"></span></a></i>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>  
        </ul>
    </div>

    <!-- 添加模拟框开始 -->
    <div class="am-modal am-modal-prompt" tabindex="-1" id="add_prompt" >
        <div class="am-modal-dialog">
            <div class="am-modal-hd">添加新的书签</div><a class="am-badge am-badge-secondary am-round">地址栏为必填，若标题栏不填，由程序去获取网页的标题</a>
            <div class="am-modal-bd">
                <div class="am-form-group am-form-icon" style="margin:10px">
                    <input type="text" class="am-modal-prompt-input" id="add_title" placeholder="标题：♥( ˘ ³˘)"></div>
                <div class="am-form-group am-form-icon" style="margin:10px">
                    <input type="text" class="am-modal-prompt-input" id="add_address" placeholder="地址：( ˘ ³˘)♥"></div>

            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
    <!-- 添加模拟框结束 -->

    <!-- 查找模拟框开始 -->
    <div class="am-modal am-modal-prompt" tabindex="-1" id="search_prompt">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">查找书签</div><a class="am-badge am-badge-secondary am-round">支持模糊查询标题</a>
            <div class="am-modal-bd">
                <div class="am-form-group am-form-icon" style="margin:10px">
                    <input type="text" class="am-modal-prompt-input" placeholder="标题：( ˘ ³˘)♥"></div>

            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
    <!-- 查找模拟框结束 -->

    <!-- 删除模拟框开始 -->
    <div class="am-modal am-modal-confirm" tabindex="-1" id="del_confirm">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">亲 ♥，确定要删除这条记录吗？</div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>
    <!-- 删除模拟框结束 -->

    <!-- 修改模拟框开始 -->
    <div class="am-modal am-modal-prompt" tabindex="-1" id="modify_prompt">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">修改书签
            <div class="am-modal-bd">
                <div class="am-form-group am-form-icon" style="margin:10px">
                    <input type="text" class="am-modal-prompt-input" id="m_title"></div>
                <div class="am-form-group am-form-icon" style="margin:10px">
                    <input type="text" class="am-modal-prompt-input" id="m_href"></div>

                    <input type="hidden" class="am-modal-prompt-input" id="m_id"></div>

            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
    <!-- 修改模拟框结束 -->

    <!--[if lt IE 9]>
    <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="/js/polyfill/rem.min.js"></script>
    <script src="/js/polyfill/respond.min.js"></script>
    <script src="/js/amazeui.legacy.js"></script>
    <![endif]-->

    <!--[if (gte IE 9)|!(IE)]>
    <!-->
    <!--<![endif]-->


    <script type='text/javascript' src='/yunmarker/client/assets/jquery/jquery.js'></script>
    <script src="/yunmarker/client/assets/js/amazeui.min.js"></script>
    <script type="text/javascript">
    /**
     * 以下ajax的url接口需要根据实际情况变更
     */
    var host = window.location.host;

    $(document).ready(function(){
       /* $.ajax({
            //localhost/webbookmarker/index.php/Home/BookMarker/ShowAll
            url: 'http://'+host+'/webbookmarker/index.php/Home/BookMarker/ShowAll',
            dataType: 'json',
            success: function(data){
                if(data){
                    var len = data.length;
                    var c = '';
                    for (var i = 0; i < len; i++) {
                        c += '<li><a  id="' + data[i].id + '" style="font-size: 15px" href="' + data[i].href +
                            '" target="_blank"><img class="am-radius" src="' + data[i].icon + '" width="16px" height="16px"/> ' + data[i].title + '</a><i><a class="modify" data-id="' + data[i].id + '"><span class="am-icon-pencil"></span></a> <a class="del" data-id="' + data[i].id + '"><span class="am-icon-times"></span></a></i></li>';
                    }
                    $("#marker_list").append(c);
                }
            } 
        })*/


        $('#add').on('click', function() {
            $('#add_title').val('');
            $('#add_address').val('');
            classification_id = $(this).attr('classification_id');
            $('#add_prompt').modal({
                relatedTarget: this,
                onConfirm: function(e) {
                    $.ajax({
                        url: 'http://'+host+'/yunmarker/index.php/Home/Yun/Add',
                        type: 'GET',
                        dataType: 'json',
                        cache: false,
                        data: {
                            title: e.data[0],
                            url: e.data[1],
                            classification_id: classification_id,
                        },
                        success: function(data) {
                            if (data.code == 1) {
                                var c = '';
                                c = '<li><a id="'+data.content.marker_id+'" href="' + data.content.href +
                                    '" target="_blank"><img class="am-radius" src="' + data.content.icon + '" width="16px" height="16px"/> ' + data.content.title + '</a><i><a class="modify" data-marker_id="' + data.content.marker_id + '"><span class="am-icon-pencil"></span></a> <a class="del" data-marker_id="' + data.content.marker_id + '"><span class="am-icon-times"></span></a></i></li>'
                                $("#marker_list").prepend(c);
                            } else {
                                alert("无法添加该书签");
                            };
                        }
                    })
                },
                onCancel: function(e) {}
            });
        });

        $('#search').on('click', function() {
            $('#search_prompt').modal({
                relatedTarget: this,
                onConfirm: function(e) {
                    $.ajax({
                        url: 'http://'+host+'/yunmarker/index.php/Home/Yun/Search',
                        type: 'GET',
                        dataType: 'json',
                        cache: false,
                        data: {
                            keyworld: e.data
                        },
                        success: function(data) {
                            if (data.code == 1) {
                                var len = data.content.length;
                                var c = '';
                                for(var i = 0; i < len; i++) {
                                    c += '<li><a id="'+data.content[i].marker_id+'" href="' + data.content[i].href +
                                    '" target="_blank"><img class="am-radius" src="' + data.content[i].icon + '" width="16px" height="16px"/> ' + data.content[i].title + '</a><i><a class="modify" data-marker_id="' + data.content[i].marker_id + '"><span class="am-icon-pencil"></span></a> <a class="del" data-marker_id="' + data.content[i].marker_id + '"><span class="am-icon-times"></span></a></i></li>'    
                                }
                                $("#marker_list").empty().prepend(c);
                            } else {
                                alert("没找到相关的书签");
                            };
                        }
                    })
                },
                onCancel: function(e) {}
            });
        });

        $('#back').on('click', function() {
            var url = 'http://'+host+'/yunmarker/index.php/Home/Yun';
            location.href = url;
        })

        
        $(".del").live("click", function() {
            var marker_id = $(this).attr('data-marker_id');
            $.ajax({
                url: 'http://'+host+'/yunmarker/index.php/Home/Yun/Del',
                type: 'GET',
                dataType: 'json',
                data: {
                    marker_id: marker_id
                },
                success: function(data) {
                    if (data.code == 1) {
                        location.reload(true); 
                    } else {
                        alert("删除书签失败");
                    }
                }
            })
        })

        $(".modify").live("click", function() {

            var marker_id = $(this).attr('data-marker_id');
            var dtitle = $('#' + marker_id).text().trim();
            var dhref = $('#' + marker_id).attr('href');
            console.log(marker_id,dtitle,dhref);
            $("#m_title").val(dtitle);
            $("#m_href").val(dhref);
            $("#m_id").val(marker_id);

            $('#modify_prompt').modal({
                relatedTarget: this,
                onConfirm: function(e) {
                    $.ajax({
                        url: 'http://'+host+'/yunmarker/index.php/Home/Yun/Alter',
                        type: 'GET',
                        data: {
                            marker_id: marker_id,
                            title: e.data[0],
                            href: e.data[1]
                        },
                        success: function(data) {
                            location.reload(true);
                        }
                    })
                },
                onCancel: function(e) {}
            });
        })

    })
    </script>

    
</body>
</html>