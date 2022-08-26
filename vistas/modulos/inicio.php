<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">


     <div class="row">

         <div class="col-lg-12">

             <?php

             if($_SESSION["perfil"] =="Especial" || $_SESSION["perfil"] =="Vendedor" || $_SESSION["perfil"] =="Administrador" || $_SESSION["perfil"] =="Mercaderista"){

                 echo '<div class="box box-success">

             <div class="box-header">

             <h2>Bienvenid@ ' .$_SESSION["nombre"].'</h2>

             </div>

             </div>';

             }

             ?>

         </div>

         <?php

         if($_SESSION["perfil"] =="Administrador"){
             //comment
             include "inicio/cajas-superiores.php";
             echo " ";

         }

         ?>

        <div class="col-lg-12">

          <?php

          if($_SESSION["perfil"] =="Administrador"){
          //comment
          include "inicio/resumen-presupuesto.php";
          //include "reportes/grafico-ventas.php";
          echo " ";

          }

          ?>

        </div>

        <div class="col-lg-6">

          <?php

          if($_SESSION["perfil"] =="Administrador"){
          
            //comment
           //include "reportes/productos-mas-vendidos.php";
           echo " ";

         }

          ?>

        </div>

         <div class="col-lg-6">

          <?php

          if($_SESSION["perfil"] =="Administrador"){
          //comment
          //include "inicio/productos-recientes.php";
          echo " ";

         }

          ?>

        </div>


     </div>

  </section>
 
</div>
