<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

        echo '<li class="active">

            <a href="inicio">

                <i class="fa fa-home"></i>
                <span>Inicio</span>

            </a>

        </li>';

        if($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Administrador") {
            echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Promotoría</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

                        <a href="cadenas">
        
                            <i class="fa fa-building"></i>
                            <span>Cadenas</span>
        
                        </a>
        
                    </li>
                    
                    <li>
        
                        <a href="tiendas">
        
                            <i class="fa fa-shopping-bag"></i>
                            <span>Tiendas</span>
        
                        </a>
        
                    </li>
                    <li>

                        <a href="presupuesto">
        
                            <i class="fa fa-money"></i>
                            <span>Presupuesto</span>
        
                        </a>
        
                    </li>
                    
                    <li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>
					</ul>';


            echo '</ul>

			</li>';
        }




        if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Mercaderista" ) {
            echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Mercaderistas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">

                    <li>

                        <a href="presupuesto-mercaderista">
        
                            <i class="fa fa-money"></i>
                            <span>Presupuesto</span>
        
                        </a>
        
                    </li>
                    
                    <li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas-mercaderistas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta-mercaderistas">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>
					</ul>';


            echo '</ul>

			</li>';
        }




        if($_SESSION["perfil"] == "Administrador"){

            echo '

		 	<li>

		 		<a href="sell-out">

		 			<i class="fa fa-check-circle"></i>
		 			<span>Sell Out</span>

		 		</a>

		 	</li>';

        }






        if($_SESSION["perfil"] == "Administrador" ) {
            echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Parametrización</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

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
        
                    </li>
                    
                    <li>

                        <a href="usuarios">
        
                            <i class="fa fa-user"></i>
                            <span>Usuarios</span>
        
                        </a>
        
                    </li>
					</ul>';


            echo '</ul>

			</li>';
        }





		?>

		</ul>

	 </section>

</aside>