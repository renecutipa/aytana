<header class="navbar navbar-fixed"><!-- set fixed position by adding class "navbar-fixed-top" -->
		
		<div class="navbar-inner">
		
			<!-- logo -->
			<div class="navbar-brand">
				<a href="">
					<img src="assets/images/logo@2x.png" width="88" alt="" />
				</a>
			</div>




	<ul id="main-menu" class="navbar-nav">
		<!-- add class "multiple-expanded" to allow multiple submenus to open -->
		<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
		<!-- Search Bar -->

		<li class="active opened active"><a href="principal"> <i
				class="entypo-gauge"></i> <span>Panel de Control</span>
		</a></li>
		<li><a href="producto"> <i class="entypo-tag"></i> <span>Productos</span>
		</a></li>
		<li><a href="ingreso"> <i class="entypo-clipboard"></i>
				<span>Ingresos</span>
		</a></li>
		<li><a href="venta"> <i class="entypo-basket"></i> <span>Ventas</span>
		</a></li>
		<li><a href="reporte"> <i class="entypo-chart-pie"></i> <span>Reportes</span>

		</a></li>
		<li><a href="catalogo"> <i class="entypo-cog"></i> <span>Cat&aacute;logo</span>
		</a></li>
		<li><a href="catalogo"> <i class="entypo-cog"></i> <span>Motos</span>
		</a>
			<ul>
				<li><a href="#"> <span>Venta de Moto</span></a></li>
				<li><a href="#"> <span>Guias de Remisi&oacute;n</span></a></li>
				<li><a href="#"> <span>Capas de Fibra</span></a></li>
			</ul>
		</li>
		<li><a href="javascript:void(0)"> <i class="entypo-tools"></i> <span>Configuraci&oacute;n</span>
		</a>
			<ul>
				<li><a href="#"> <span>Usuarios</span></a></li>
				<li><a href="#"> <span>Marcas</span></a></li>
				<li><a href="#"> <span>Modelos</span></a></li>
				<li><a href="#"> <span>Categorias</span></a></li>
			</ul>
		</li>
	</ul>

	<ul class="nav navbar-right pull-right">
		<!-- raw links -->
				<li class="btn-success navbar-caja"><a href="#">2,540.00</a></li>
				<li class="sep"></li>
				<li>
				<a href="#" class=""><?php echo $user['username'];?></a>
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

