<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Demo"){

			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';}

			if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Supervisor" || $_SESSION["perfil"] == "Demo"){

			echo'<li>

				<a href="categorias">

					<i class="fa fa-th"></i>
					<span>Categorías</span>

				</a>

			</li>

			<li>

				<a href="productos">

					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>

			</li>';}

			if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Supervisor" || $_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Demo"){

			echo'<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-archive"></i>

					<span>Administrar ventas</span>

					<span class="pull-right-container">

						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">

					<li>

						<a href="ventas">

							<i class="fa fa-circle-o"></i>
							<span>Administrar Facturas</span>

						</a>

					</li>

					<li>

						<a href="nota-credito-ventas">

							<i class="fa fa-circle-o"></i>
							<span>Administrar N.C.</span>

						</a>

					</li>

					<li>

					<a href="nota-debito-ventas">

					<i class="fa fa-circle-o"></i>
					<span>Administrar N.D.</span>

					</a>

					</li>

					</li>

					</ul>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-usd"></i>

					<span>Ventas</span>

					<span class="pull-right-container">

						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					<li>

						<a href="crear-venta">

							<i class="fa fa-circle-o"></i>
							<span>Factura de venta</span>

						</a>

					</li>

					<li>

					<a href="nota-credito">

					<i class="fa fa-circle-o"></i>
					<span>Nota de crédito</span>

					</a>

					</li>

					<li>

					<a href="nota-debito">

					<i class="fa fa-circle-o"></i>
					<span>Nota de débito</span>

					</a>

					</li>';}

					if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Demo"){

					echo'<li>

						<a href="reportes">

							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>

						</a>

					</li>';} ?>

				</ul>

			</li>

		</ul>

	 </section>

</aside>
