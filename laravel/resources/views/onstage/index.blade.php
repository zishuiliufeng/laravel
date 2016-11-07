@extends('onstage.layouts')

@section('title', '首页')

@section('sidebar')
    @@parent
    <div class="left-sidebar am-topbar-inverse" id="left-sidebar">
    </div>
	<script>
		var template = Handlebars.compile('@{{>menu}}');
		var url = 'index/sidebar';
		$.ajax({
			url : url,
			type : 'POST',
			dataType : 'json',
			cache : false,
			data : {},
			success : function(res){
				
				if(res.status==1)
				{
					var content = new Array();
					$.each(res.data,function(i,o){
						var title = i;
						var subMenu = new Array();
						$.each(o,function(m,k){
							subMenu.push({
								"title" : k.permissions_name,
								"className" : "menu_subMenu "+k.permissions_code,
								"link" : "javascript:void(0)"
							})
						});
						content.push({
						    "title" : title,
						    "subMenu" : subMenu,
						    "className" : "menu_title ",
						    "link" : "javascript:void(0)"
						})
					})
					
					data = {
					      menu: {
					        "id": "left_list",
					        "className": "menu_list",
					        "theme": "basic",
					        "content": content,
					      }
					    },
				    html = template(data.menu);

					$('#left-sidebar').append(html);

					$('.am-parent .menu_title').bind('click',function(){
						var active = $(this).attr('class');
						if(active.indexOf('active_menu')<0)
						{
							//点击其它大选项时
							$('.menu_title').removeClass('active_menu');
							$(this).addClass('active_menu');
							$('.am-menu-sub').css('display','none');
							$(this).next('.am-menu-sub').css('display','block');
						}else{
							//点击一个大选项，切换显隐
							$(this).next('.am-menu-sub').toggle();
						}
					})
				}	
			} 
		})
	</script>
    <p>This is appended to the master sidebar.</p>
   
   
@endsection

@section('content')
    <p>This is my body content. laravel test !</p>
@endsection