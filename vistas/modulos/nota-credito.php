<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Generar Nota de Crédito

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Nota de crédito</li>

    </ol>

  </section>

  <section class="content">

	<div class="row">

		<!--Formulario-->

		<div class="col-lg-5 col-xs-12">

			<div class="box box-primary">

				<div class="box-header with-border"></div>

					<form role="form" method="POST" class="formularioVenta">

						<div class="box-body">

							<div class="box">

								<!--Input para vendedor-->

								<div class="form-group">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-user"></i></span>

										<input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

										<input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

									</div>

								</div>

							<!--Código de venta-->

							<div class="form-group">

								<div class="input-group">

									<!--<span class="input-group-addon"><i class="fa fa-key"></i></span>-->

								<?php

										$item = null;
										$valor = null;

										$ventas = ControladorNotaCreditoVentas::ctrMostrarNotaCreditoVentas($item, $valor);


										if(!$ventas){

											echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="100000001" readonly>';

										}else{

											foreach ($ventas as $key => $value) {

											}

										$codigo = $value["codigo"] + 1;

							echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
										}

									 ?>

								</div>

							</div>

							<!--Input de cliente-->

							<div class="form-group">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-users"></i></span>

									<select type="text" class="form-control" id="seleccionarCliente" name="seleccionarCliente" placeholder="Agregar Cliente" required>

										<option value="">Seleccionar cliente</option>

										<?php

											$item = null;
											$valor = null;

											$categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

											foreach ($categorias as $key => $value) {

												echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

											}

										 ?>

									</select>

									<span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>

								</div>

							</div>

              <!--Input de comprobante-->
              <div>

              <table class="table">

                <thead>

                  <tr>
                    <th>Comprobante</th>
                    <th>Concepto</th>
                  </tr>

                </thead>

                <tbody>

                  <tr>

                    <td>

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-file"></i></span>

                  <select type="text" class="form-control" id="seleccionarTipoComprobante" name="seleccionarTipoComprobante" placeholder="Comprobante" required>

                    <option value="">Tipo de comprobante</option>
                    <option value="3">Nota de crédito A</option>
                    <option value="8">Nota de crédito B</option>
                    <option value="13">Nota de crédito C</option>

                  </select>

                </div>

              </div>

            </td>

            <td>

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-wrench"></i></span>

                  <select type="text" class="form-control" id="seleccionarConcepto" name="seleccionarConcepto" placeholder="Concepto" required>

                    <option value="">Concepto</option>
                    <option value="1">Productos</option>
                    <option value="2">Servicios</option>
                    <option value="3">Productos y Servicios</option>


                  </select>

                </div>

              </div>

            </td>

            </tr>

            <tr>

              <thead>

                <tr>
                  <th>Documento</th>
                  <th>Número de documento</th>
                </tr>

              </thead>

              <td>

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span>

                    <select type="text" class="form-control" id="seleccionarTipoDocumento" name="seleccionarTipoDocumento" placeholder="TipoDocumento" required>

                      <option value="">Tipo de documento</option>
                      <option value="80">CUIT</option>
                      <option value="96">DNI</option>
                      <option value="99">Consumidor Final</option>


                    </select>

                  </div>

                </div>

              </td>

              <td>

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span>

                    <input type="text" class="form-control" id="seleccionarNumeroDocumento" name="seleccionarNumeroDocumento" placeholder="Documento" required>


                  </div>

                </div>

              </td>

            </tr>

          </tbody>

            </table>

            </div>

							<!--Input de productos-->

							<div class="form-group row nuevoProducto">



						</div>

							<input type="hidden" id="listaProductos" name="listaProductos">

							<!--Boton para agregar producto-->

						<button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar Producto</button>

							<hr>

						<div class="row">

							<!--Impuestos y totales-->

							<div class="col-xs-8 pull-right">

								<table class="table">

									<thead>

										<tr>
											<th>Impuestos</th>
											<th>Total</th>
										</tr>

									</thead>

									<tbody>

										<tr>

											<td style="width: 50%">

												<div class="input-group">


													<select type="float" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>

                            <option value="">Impuesto</option>
                            <option value="0.0">No Gravado</option>
                            <option value="0.00">Exento</option>
                            <option value="0.000">0%</option>
                            <option value="10.5">10.5%</option>
                            <option value="21">21%</option>
                            <option value="27">27%</option>

                          </select>

													<input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

													<input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

													<span class="input-group-addon"><i class="fa fa-percent"></i></span>

												</div>

											</td>

											<td style="width: 50%">

												<div class="input-group">

													<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
													<input type="text" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0.00" readonly required>

													<input type="hidden" name="totalVenta" id="totalVenta">

												</div>

											</td>

										</tr>

									</tbody>

								</table>

							</div>

						</div>

						<hr>

						<!--Concepto-->

						<div class="form-group row">

							<div class="col-xs-12">

								<div class="input-group col-xs-8 col-md-8 col-lg-8">

									<input type="text" class="form-control" id="conceptoNotaCredito" name="conceptoNotaCredito" placeholder="Concepto" required>

								</div>

							</div>

					</div>

				<br>

				</div>


					<div class="box-footer">

						<button type="submit" class="btn btn-primary pull-right">Crear venta</button>

					</div>

				</form>

				<?php


					$generaVenta = new ControladorNotaCreditoVentas();
          $generaVenta -> ctrCrearNotaCreditoVenta();
        
			  
				 ?>

			</div>

		</div>

	</div>


		<!--Tabla de productos-->

		<div class="col-lg-7 hidden-md hiddem-sm hidden-xs">

			<div class="box box-question">

				<div class="box-header with-border"></div>

					<div class="box-body">

						<table class="table table-bordered table-striped dt-responsive tablaVentas">

							<!--Cabeza de tabla-->
							<thead>

								<tr>

									<th style="width: 10px">#</th>
									<th>Imagen</th>
									<th>Código</th>
									<th>Descripción</th>
									<th>Stock</th>
									<th>Acciones</th>

								</tr>

							</thead>

						</table>

					</div>

				</div>

			  </div>

		   </div>

 	</section>

</div>



<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

             <!-- ENTRADA PARA EL DOCUMENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" min="0" class="form-control input-lg" name="nuevoDocumento" placeholder="Ingresar DNI / CUIT" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA DIRECCION -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

             <!-- ENTRADA PARA EL TELEFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" required>

              </div>

            </div>

             <!-- ENTRADA PARA FECHA DE NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

              </div>

            </div>

             <!-- ENTRADA PARA EL MAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="mail" class="form-control input-lg" name="nuevoMail" placeholder="Ingresar email">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();


       ?>

    </div>

  </div>

</div>
