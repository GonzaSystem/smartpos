<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Compras

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Factura de compra</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear-venta">

          <button class="btn btn-primary">

            Agregar Compra

          </button>

        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">

          <span>

              <i class="fa fa-calendar"> Rango de fecha</i>

          </span>

          <i class="fa fa-caret-down"></i>

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Número de factura</th>
           <th>Tipo de comprobante</th>
           <th>Vendedor</th>
           <th>Forma de pago</th>
           <th>Subtotal</th>
           <th>Total      </th>
           <th>CAE</th>
           <th>Vencimiento CAE</th>
           <th>Fecha</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

          <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorCompras::ctrRangoFechaCompras($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {

           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["codigo"].'</td>

                  <td>'.$value["tipo_factura"].'</td>';


                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>'.$value["metodo_pago"].'</td>

                  <td>$ '.number_format($value["neto"],2).'</td>

                  <td>$ '.number_format($value["total"],2).'</td>

                  <td>'.$value["cae"].'</td>

                  <td>'.$value["vencimiento_cae"].'</td>

                  <td>'.$value["fecha"].'</td>

                  <td>

                    <div class="btn-group">

                      <button class="btn btn-info btnImprimirFacturaCompra" codigoVenta="'.$value["codigo"].'">

                        <i class="fa fa-print"></i>

                      </button>';

                    echo '</div>

                  </td>

                </tr>';
            }

        ?>


        </tbody>

       </table>


      </div>

    </div>

  </section>

</div>
