<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Generar venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Generar ventas</li>
    
    </ol>

  </section>

  <section class="content">

	<div class="row">
		
		<!--Formulario-->

		<div class="col-lg-5 col-xs-12">
			
			<div class="box box-success">
				
				<div class="box-header with-border"></div>

					<form role="form" method="POST">

						<div class="box-body">	
							
							<div class="box">

								<!--Input para vendedor-->
								
								<div class="form-group">
									
									<div class="input-group">
										
										<span class="input-group-addon"><i class="fa fa-user"></i></span>

										<input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="Usuario Administrador" readonly>

									</div>

								</div>

							<!--Código de venta-->

							<div class="form-group">
								
								<div class="input-group">
									
									<span class="input-group-addon"><i class="fa fa-key"></i></span>

									<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="0260-000012345" readonly>

								</div>

							</div>

							<!--Input de cliente-->

							<div class="form-group">
								
								<div class="input-group">
									
									<span class="input-group-addon"><i class="fa fa-users"></i></span>
									
									<select type="text" class="form-control" id="agregarCliente" name="agregarCliente" placeholder="Agregar Cliente" required>

										<option value="">Seleccionar cliente</option>

									</select>

									<span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>

								</div>

							</div>

							<!--Input de productos-->

							<div class="form-group row nuevoProducto">

								<!--Descripción del producto-->
								
								<div class="col-xs-6" style="padding-right: 0px">
									
									<div class="input-group">
										
										<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

										<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" placeholder="Descripción del producto" required>

									</div>

								</div>

								<!--Cantidad del producto-->

							<div class="col-xs-3">
									
								<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required>

							</div>

							<!--Precio del producto-->

							<div class="col-xs-3" style="padding-left:0px">

								<div class="input-group">

									<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
									
									<input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" placeholder="000000" readonly required>

								</div>

							</div>
	
						</div>

							<!--Boton para agregar producto-->

						<button type="button" class="btn btn-default hidden-lg">Agregar Producto</button>

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
													
													<input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>
													<span class="input-group-addon"><i class="fa fa-percent"></i></span>

												</div>

											</td>

											<td style="width: 50%">
												
												<div class="input-group">
													
													<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
													<input type="number" min="1" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" readonly required>

												</div>

											</td>

										</tr>	

									</tbody>

								</table>

							</div>

						</div>

						<hr>

						<!--Metodo de pago-->

						<div class="form-group row">
							
							<div class="col-xs-6">
								
								<div class="input-group">
							
									<select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
										
										<option value="">Seleccionar método de pago</option>
										<option value="efectivo">Efectivo</option>
										<option value="tarjetaCredito">Tarjeta de crédito</option>
										<option value="tarjetaDebito">Tarjeta de débito</option>

									</select>

								</div>

							</div>

							<div class="col-xs-6" style="padding-left: 0px">
								
								<div class="input-group">
									
									<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código de transacción" required>

									<span class="input-group-addon"><i class="fa fa-lock"></i></span>

								</div>

							</div>

					</div>

				<br>

				</div>


					<div class="box-footer">

						<button type="submit" class="btn btn-primary pull-right">Crear venta</button>

					</div>

				</form>

			</div>

		</div>

	</div>


		<!--Tabla de productos-->	

		<div class="col-lg-7 hidden-md hiddem-sm hidden-xs">
			
			<div class="box box-warning"></div>
		
				<div class="box-header with-border"></div>

					<div class="box-body">
						
						<table class="table table-bordered table-striped dt-responsive tablas">
							
							<!--Cabeza de tabla-->
							<thead>
								
								<tr>
									
									<th style="width: 10px">#</th>
									<th>Imagen</th>
									<th>Código</th>
									<th>Descripción</th>
									<th>Categoría</th>
									<th>Stock</th>
									<th>Acciones</th>

								</tr>

							</thead>
							
							<!--Cuerpo de tabla-->
							<tbody>
								
								<tr>
									
									<td>1</td>
									<td><img src="vistas/img/productos/default.png" class="img-thumbnail" width="40px"></td>
									<td>000123</td>
									<td>Lorem ipsum dolor sit amet</td>
									<td>Lorem Ipsun</td>
									<td>15</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar</button>
										</div>
									</td>

								</tr>

							</tbody>

						</table>

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