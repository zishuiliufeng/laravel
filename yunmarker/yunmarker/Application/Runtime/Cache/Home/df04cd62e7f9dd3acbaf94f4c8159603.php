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
    <link rel="stylesheet" href="/yunmarker/client/assets/css/right.css">
    
    <style>
    .img-demo { position: relative; display: block; height:192px; width: 200px; margin-right:10px;margin-top: 10px; float: left;cursor:pointer;}
    .img-demo cite { background: #333; -moz-opacity:.50; filter:alpha(opacity=50); opacity:.50; color: #fff; position: absolute; bottom: 0; left: 0; width: 200px; padding: 10px 0; border-top: 1px solid #999; text-align: center;}
    .img-demo img{width:100%;height:100%;}
    /* #add_classification_prompt{top: 0 ! important;margin-top: 0 ! important;} */
    /* .cropper-container{width:100% ! important;height:100% ! important;} */
    #picture_upload{
        border-radius: 2px;
        display: none;
        margin-top: 0 ! important;
        position: fixed;
        text-align: center;
        top: 0;
        transition-property: transform, opacity;
        margin-left: 10%;
        width: 80%;
        height: 100%;
        z-index: 9999;
        opacity: 1;
        transform: translate3d(0px, 0px, 0px) scale(1);
        transition-duration: 300ms;
    }
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
                <button class="am-btn am-btn-success am-topbar-btn am-btn-sm" id="add_classification">
                    <span class="am-icon-plus"></span>
                    添加分类
                </button>
            </div>
        </div>

    </header>
    <br>
    
    <div class="marker_box">
        <ul class="am-list confirm-list" id="classification_list">
        </ul>
    </div>

    <!-- 添加模拟框开始 -->
    <div class="am-modal am-modal-prompt" tabindex="-1" id="add_classification_prompt" >
        <div class="am-modal-dialog">
            <div class="am-modal-hd">添加新的分类</div><a class="am-badge am-badge-secondary am-round">分类名为必填</a>
            <div class="am-modal-bd">
                <div class="am-form-group am-form-icon" style="margin:10px">
                    <input type="text" class="am-modal-prompt-input" id="new_classification" placeholder="分类标题：♥( ˘ ³˘)">
                </div>
                <div class="img_classification"></div>
                <div class="am-form-group am-form-icon" style="margin:10px">
                    <button type="button" class="am-btn am-btn-warning am-round img_upload" >图片上传</button>
                </div>
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
    <!-- 添加模拟框结束 -->

    <!-- 添加模拟框开始 -->
    <div class="am-modal am-modal-prompt" tabindex="-1" id="edit_classification_prompt" >
        <div class="am-modal-dialog">
            <div class="am-modal-hd">修改分类</div><a class="am-badge am-badge-secondary am-round">分类名为必填</a>
            <div class="am-modal-bd">
                <div class="am-form-group am-form-icon" style="margin:10px">
                    <input type="text" class="am-modal-prompt-input" id="edit_classification" placeholder="分类标题：♥( ˘ ³˘)">
                </div>
                <div class="img_classification"></div>
                <div class="am-form-group am-form-icon" style="margin:10px">
                    <button type="button" class="am-btn am-btn-warning am-round img_upload" >图片上传</button>
                </div>
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
    <!-- 添加模拟框结束 -->
    
    <!-- 上传图片模拟框开始 -->
    <div  tabindex="-1" id="picture_upload" >
        <div class="am-modal-dialog">
            <div class="am-modal-hd">上传图片</div><a class="am-badge am-badge-secondary am-round">建议图片大小200*200</a>
                <div class="am-modal-bd">
                    <div class="htmleaf-container">
                        <!-- Content -->
                    <div class="container">
                    <div class="row">
                      <div class="col-md-9">
                        <!-- <h3 class="page-header">Demo:</h3> -->
                        <div class="img-container">
                          <img src="<?php echo ($default_img); ?>" alt="Picture">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <!-- <h3 class="page-header">Preview:</h3> -->
                        <div class="docs-preview clearfix">
                          <div class="img-preview preview-lg"></div>
                          <div class="img-preview preview-md"></div>
                          <div class="img-preview preview-sm"></div>
                          <div class="img-preview preview-xs"></div>
                        </div>

                        <!-- <h3 class="page-header">Data:</h3> -->
                        <div class="docs-data">
                          <div class="input-group">
                            <label class="input-group-addon" for="dataX">X</label>
                            <input class="form-control" id="dataX" type="text" placeholder="x">
                            <span class="input-group-addon">px</span>
                          </div>
                          <div class="input-group">
                            <label class="input-group-addon" for="dataY">Y</label>
                            <input class="form-control" id="dataY" type="text" placeholder="y">
                            <span class="input-group-addon">px</span>
                          </div>
                          <div class="input-group">
                            <label class="input-group-addon" for="dataWidth">Width</label>
                            <input class="form-control" id="dataWidth" type="text" placeholder="width">
                            <span class="input-group-addon">px</span>
                          </div>
                          <div class="input-group">
                            <label class="input-group-addon" for="dataHeight">Height</label>
                            <input class="form-control" id="dataHeight" type="text" placeholder="height">
                            <span class="input-group-addon">px</span>
                          </div>
                          <div class="input-group">
                            <label class="input-group-addon" for="dataRotate">Rotate</label>
                            <input class="form-control" id="dataRotate" type="text" placeholder="rotate">
                            <span class="input-group-addon">deg</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-9 docs-buttons">
                        <!-- <h3 class="page-header">Toolbar:</h3> -->
                        <div class="btn-group">
                          <button class="btn btn-primary" data-method="setDragMode" data-option="move" type="button" title="拖动">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                              <span class="icon icon-move"></span>
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="setDragMode" data-option="crop" type="button" title="剪切">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                              <span class="icon icon-crop"></span>
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="zoom" data-option="0.1" type="button" title="放大">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
                              <span class="icon icon-zoom-in"></span>
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="zoom" data-option="-0.1" type="button" title="缩小">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
                              <span class="icon icon-zoom-out"></span>
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button" title="左旋转">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)">
                              <span class="icon icon-rotate-left"></span>
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="rotate" data-option="45" type="button" title="右旋转">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)">
                              <span class="icon icon-rotate-right"></span>
                            </span>
                          </button>
                        </div>

                        <div class="btn-group">
                          <button class="btn btn-primary" data-method="disable" type="button" title="锁定">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;disable&quot;)">
                              <span class="icon icon-lock"></span>
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="enable" type="button" title="解锁">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;enable&quot;)">
                              <span class="icon icon-unlock"></span>
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="clear" type="button" title="清空">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;clear&quot;)">
                              <span class="icon icon-remove"></span>
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="reset" type="button" title="重置">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;reset&quot;)">
                              <span class="icon icon-refresh"></span>
                            </span>
                          </button>
                          <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                            <input class="sr-only" id="inputImage" name="file" type="file" accept="image/*">
                            <span class="docs-tooltip" data-toggle="tooltip" title="选择本地图片">
                              <span class="icon icon-upload"></span>
                            </span>
                          </label>
                          <!-- <button class="btn btn-primary" data-method="destroy" type="button" title="销毁">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;destroy&quot;)">
                              <span class="icon icon-off"></span>
                            </span>
                          </button> -->
                        </div>

                        <div class="btn-group btn-group-crop">
                          <button class="btn btn-primary" data-method="getCroppedCanvas" type="button">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
                              获取剪切图片
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }" type="button">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { &quot;width&quot;: 160, &quot;height&quot;: 90 })">
                              160 &times; 90
                            </span>
                          </button>
                          <button class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }" type="button">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { &quot;width&quot;: 320, &quot;height&quot;: 180 })">
                              320 &times; 180
                            </span>
                          </button>
                        </div>

                        <!-- Show the cropped image in modal -->
                        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <!-- <button class="close" data-dismiss="modal" type="button" aria-hidden="true">&times;</button> -->
                                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                                <h4 class="modal-title" id="getCroppedCanvasTitle">图片</h4>
                              </div>
                              <div class="modal-body"></div>
                              <div class="modal-footer">
                                <button class="btn btn-primary save_img"  type="button">保存</button>
                              </div>
                            </div>
                          </div>
                        </div><!-- /.modal -->

                      </div><!-- /.docs-buttons -->

                      <div class="col-md-3 docs-toggles">
                        <!-- <h3 class="page-header">Toggles:</h3> -->
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                          <label class="btn btn-primary active" data-method="setAspectRatio" data-option="1.7777777777777777" title="Set Aspect Ratio">
                            <input class="sr-only" id="aspestRatio1" name="aspestRatio" value="1.7777777777777777" type="radio">
                            <span class="docs-tooltip" data-toggle="tooltip" title="宽/高, 16 / 9">
                              16:9
                            </span>
                          </label>
                          <label class="btn btn-primary" data-method="setAspectRatio" data-option="1.3333333333333333" title="Set Aspect Ratio">
                            <input class="sr-only" id="aspestRatio2" name="aspestRatio" value="1.3333333333333333" type="radio">
                            <span class="docs-tooltip" data-toggle="tooltip" title="宽/高, 4 / 3">
                              4:3
                            </span>
                          </label>
                          <label class="btn btn-primary" data-method="setAspectRatio" data-option="1" title="Set Aspect Ratio">
                            <input class="sr-only" id="aspestRatio3" name="aspestRatio" value="1" type="radio">
                            <span class="docs-tooltip" data-toggle="tooltip" title="宽/高, 1 / 1">
                              1:1
                            </span>
                          </label>
                          <label class="btn btn-primary" data-method="setAspectRatio" data-option="0.6666666666666666" title="Set Aspect Ratio">
                            <input class="sr-only" id="aspestRatio4" name="aspestRatio" value="0.6666666666666666" type="radio">
                            <span class="docs-tooltip" data-toggle="tooltip" title="宽/高, 2 / 3">
                              2:3
                            </span>
                          </label>
                          <label class="btn btn-primary" data-method="setAspectRatio" data-option="NaN" title="Set Aspect Ratio">
                            <input class="sr-only" id="aspestRatio5" name="aspestRatio" value="NaN" type="radio">
                            <span class="docs-tooltip" data-toggle="tooltip" title="自由比例">
                              Free
                            </span>
                          </label>
                        </div>

                      </div><!-- /.docs-toggles -->
                    </div>
                    </div>
                    <!-- Alert -->
                </div>
            </div>
        </div>
    </div>
    <!-- 上传图片模拟框结束 -->

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
    
    <!-- 右键菜单开始 -->
    <div id="rightMenu">
    <ul class="am-list admin-sidebar-list">
        <li class="edit am-panel">修改</li>
        <li class="delete am-panel">删除</li>
    </ul>
  </div>
  <!-- 右键菜单结束 -->

    <script type='text/javascript' src='/yunmarker/client/assets/jquery/jquery.min.js'></script>
    <script src="/yunmarker/client/assets/js/amazeui.min.js"></script>
    <script type='text/javascript' src='/yunmarker/client/assets/js/right.js'></script>
    <script type='text/javascript' src='/yunmarker/client/assets/dist/cropper.js'></script>
    <script type="text/javascript">
    /**
     * 以下ajax的url接口需要根据实际情况变更
     */
    var host = window.location.host;

    var dynamicLoading = {
            css: function(path){
                if(!path || path.length === 0){
                    throw new Error('argument "path" is required !');
                }
                var head = document.getElementsByTagName('head')[0];
                var link = document.createElement('link');
                link.href = path;
                link.rel = 'stylesheet';
                link.type = 'text/css';
                head.appendChild(link);
                link.onload=link.onreadystatechange=function(){
                  if(!this.readyState||this.readyState=='loaded'||this.readyState=='complete'){
                    //alert('done');
                  }
                  link.onload=link.onreadystatechange=null;
                }
            },
            js: function(path){
                if(!path || path.length === 0){
                    throw new Error('argument "path" is required !');
                }
                var head = document.getElementsByTagName('head')[0];
                var script = document.createElement('script');
                script.src = path;
                script.type = 'text/javascript';
                head.appendChild(script);
            }
        }

    $(document).ready(function(){
        $.ajax({
            //localhost/webbookmarker/index.php/Home/BookMarker/ShowAll
            url: 'http://'+host+'/yunmarker/index.php/Home/Yun/ShowClassification',
            dataType: 'json',
            success: function(data){
                if(data){
                    var len = data.length;
                    var c = '';
                    var img = '';
                    for (var i = 0; i < len; i++) {
                        if(data[i].img != null)
                        {
                            if(data[i].img.length>0)
                            {
                                img = data[i].img;
                            }
                        }else{
                            img = '<?php echo ($default_img); ?>';
                        }
                        c += '<li classification_id='+data[i].classification_id+' class="img-demo cate"> <img src="'+img+'" alt="" /><cite>'+data[i].name+'</cite></li>';
                    }
                    $("#classification_list").append(c);
                    rightMouse('rightMenu','classification_list');
                     $('.cate').on('click',function(){
                        var classification_id = $(this).attr('classification_id');
                        if(classification_id.length>0)
                        {   
                            var url = 'http://'+host+'/yunmarker/index.php/Home/Yun/ShowAll?classification_id='+classification_id;
                            location.href = url;
                        }
                    })

                }
            } 
        })
        $('.edit').on('click',function(){
          var classification_id = '';
          classification_id = $('#rightMenu').attr('classification_id');
          var src = '';
          src = $('#rightMenu').attr('img_src');
          var classification_name = '';
          classification_name = $('#rightMenu').attr('classification_name');
          $('#edit_classification').val(classification_name);
          $(".img_classification img").remove();
          if(src!='<?php echo ($default_img); ?>')
          {
            $("<img src='"+src+"'/>").appendTo(".img_classification");
          }
          
          $('#edit_classification_prompt').css('margin-top','-125px');
          $('#edit_classification_prompt').css('top','50%');
            $('#edit_classification_prompt').modal({
                relatedTarget: this,
                onConfirm: function(e) {
                  var image_info = $('.img_classification').find('img');
                  //判断是否修改了图片
                  if(src!=image_info)
                  {
                    var image_b64 = '';
                    if(image_info.length>0)
                    {
                      var b64 = image_info.attr('src');
                      if(b64.indexOf("data:image/png;base64")>=0)
                      {
                        //删除字符串前的提示信息 "data:image/png;base64,"  
                        image_b64 = b64.substring(22); 
                      }else{
                        image_b64 = b64;
                      }
                    }
                  }else{
                    image_b64 = '';
                  }
                  //判断是否修改了名称
                 

                    $.ajax({
                        url: 'http://'+host+'/yunmarker/index.php/Home/Yun/EditClassification',
                        type: 'POST',
                        dataType: 'json',
                        cache: false,
                        data: {
                            classification_id: classification_id,
                            name: e.data,
                            image_data:image_b64,
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                location.reload();
                            } else {
                                alert("修改分类失败");
                            };
                        }
                    })
                },
                onCancel: function(e) {}
            });
        })
        //删除分类
        $('.delete').on('click',function(){
          var classification_id = '';
          classification_id = $('#rightMenu').attr('classification_id');
          if(!classification_id){
            alert('出错啦!');
            return;
          }

          $.ajax({
            url : 'http://'+host+'/yunmarker/index.php/Home/Yun/DeleteClassification',
            type : 'POST',
            dataType : 'json',
            cache : false,
            data : {
              classification_id : classification_id
            },
            success : function(o){
              if(o.status==1){
                alert(o.msg);
                location.reload();
              }else{
                alert(o.msg);
              }
            }
          })
        })
        
        $('.img_upload').on('click',function(){
            $('#picture_upload').modal();
            dynamicLoading.css('/yunmarker/client/assets/css/normalize.css');
            dynamicLoading.css('/yunmarker/client/assets/css/default.css');
            dynamicLoading.css('/yunmarker/client/assets/css/main.css');
            dynamicLoading.css('/yunmarker/client/assets/css/bootstrap.min.css');
            dynamicLoading.css('/yunmarker/client/assets/dist/cropper.css');
            //dynamicLoading.js('/yunmarker/client/assets/jquery/bootstrap.min.js');
            //dynamicLoading.js('/yunmarker/client/assets/dist/cropper.js');
            dynamicLoading.js('/yunmarker/client/assets/jquery/main.js');
            
        })



        $('#add_classification').on('click', function() {
          var has_img = $(".img_classification").find('img');
          if(has_img.length>0)
          {
            has_img.remove();
          }
          $('#add_classification_prompt').css('margin-top','-125px');
          $('#add_classification_prompt').css('top','50%');
            $('#new_classification').val('');
            $('#add_classification_prompt').modal({
                relatedTarget: this,
                onConfirm: function(e) {
                  var image_info = $('.img_classification').find('img');
                  var image_b64 = '';
                  if(image_info.length>0)
                  {
                    var b64 = image_info.attr('src');
                    if(b64.indexOf("data:image/png;base64")>=0)
                    {
                      //删除字符串前的提示信息 "data:image/png;base64,"  
                      image_b64 = b64.substring(22); 
                    }else{
                      image_b64 = b64;
                    }
                  }
                    $.ajax({
                        url: 'http://'+host+'/yunmarker/index.php/Home/Yun/NewClassification',
                        type: 'POST',
                        dataType: 'json',
                        cache: false,
                        data: {
                            name: e.data,
                            image_data:image_b64,
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                var c = '';
                                var img = '';
                                img = data.res.img;
                                if(img.length<=0)
                                {
                                    img = '<?php echo ($default_img); ?>';
                                }
                                c = '<li classification_id='+data.res.classification_id+' class="img-demo cate"> <img src="'+img+'" alt="" /><cite>'+data.res.name+'</cite></li>';
                                $("#classification_list").prepend(c);

                                $('.cate').on('click',function(){
                                    var classification_id = $(this).attr('classification_id');
                                    if(classification_id.length>0)
                                    {   
                                        var url = 'http://'+host+'/yunmarker/index.php/Home/Yun/ShowAll?classification_id='+classification_id;
                                        location.href = url;
                                    }
                                })
                            } else {
                                alert("无法添加该分类");
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
                                $("#classification_list").empty().prepend(c);
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

        
        $(".del").on("click", function() {
            var dataid = $(this).attr('data-id');
            $.ajax({
                url: 'http://'+host+'/yunmarker/index.php/Home/Yun/Del',
                type: 'GET',
                dataType: 'json',
                data: {
                    id: dataid
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

        $(".modify").on("click", function() {

            var dataid = $(this).attr('data-id');
            var dtitle = $('#' + dataid).text().trim();
            var dhref = $('#' + dataid).attr('href');

            $("#m_title").val(dtitle);
            $("#m_href").val(dhref);
            $("#m_id").val(dataid);

            $('#modify_prompt').modal({
                relatedTarget: this,
                onConfirm: function(e) {
                    $.ajax({
                        url: 'http://'+host+'/yunmarker/index.php/Home/Yun/Alter',
                        type: 'GET',
                        data: {
                            id: dataid,
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

    $('.save_img').on('click',function()
    {
      //saveImageInfo();
      var mycanvas = $('#getCroppedCanvasModal').find('canvas');
 
      var data =mycanvas[0].toDataURL("image/png");
      $(".img_classification img").remove();
      $("<img src='"+data+"'/>").appendTo(".img_classification");
      $("#getCroppedCanvasModal").modal('close');
      $("#picture_upload").modal('close');
      $('#getCroppedCanvasModal').addClass('fade');
     /*  $("#add_classification_prompt").css('top',0);
       $("#add_classification_prompt").css('margin-top',0);  */
      $('#add_classification_prompt').css('margin-top','-125px');
      $('#add_classification_prompt').css('top','30%');
      $('#edit_classification_prompt').css('margin-top','-125px');
      $('#edit_classification_prompt').css('top','10%');
    })
/*    function saveImageInfo ()   
    {  
      var ycanvas = $('#getCroppedCanvasModal').find('canvas');
 
      var data =ycanvas[0].toDataURL();

      //删除字符串前的提示信息 "data:image/png;base64,"  
      var b64 = data.substring(22);  
    
      $.ajax({ url: "http://"+host+"/yunmarker/index.php/Home/Yun/SaveImg",type:'post', data: { data: b64}, success:  
              function ()  
              {  
              //alert('OK');  
              }  
      });  
    }  */
    </script>

    
</body>
</html>