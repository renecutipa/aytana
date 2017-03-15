<header class="navbar navbar-fixed"><!-- set fixed position by adding class "navbar-fixed-top" -->
		
		<div class="navbar-inner">
		
			<!-- logo -->
			<div class="navbar-brand">
				<a href="">
					<img src="assets/images/logo@2x.png" width="88" alt="" />
				</a>
			</div>

<script>

    var str = "";
    $.ajax({
        url : UrlBase + "board/getMenu",
        type : 'GET',
        success : function(data) {
            for (var i = 0; i < data.length; i++) {
                str += '<li class="root-level has-sub"><a title="'+data[i].title+'" href="'+data[i].alias+'">';
                str += '<i class="entypo-'+data[i].icon+'"></i>';
                str += '<span>'+data[i].name+'</span>';
                str += '</a>';
                if(data[i].submenu){
                    str += '<ul><li><a href="#"> <span>Venta de Moto</span></a></li></ul>';
                }
                str += '</li>';
            }

            $('#main-menu').html(str);
        }
    });
</script>

	<ul id="main-menu" class="navbar-nav">
	</ul>

	<ul class="nav navbar-right pull-right">
		<!-- raw links -->
				<li class="btn-success navbar-caja"><a href="#" id="caja_valor"><?php echo $caja?></a></li>
				<li class="sep"></li>
				<li>
				<a href="#" class=""><?php echo $user->username;?></a>
				</li>
				
				<li class="sep"></li>
				
				<li>
					<a href="<?php echo  base_url().'auth/logout'?>">
						Salir <i class="entypo-logout right"></i>
					</a>
				</li>
	</ul>

</div>

</header>	

