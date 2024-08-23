<div class="modal fade" id="nuevo_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="nuevoModalLabel">Agregar Usuarios</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="guarda.php"  method="post">
        <div class = "mb-3">

        <label for="nombre">Nombres:</label>
        <input type="text" id="nombre" name="nombre"><br>
        <label for="nombre">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos"><br>
                
        <label for="id_type">Tipo de identificación</label>
        <select class="dark-btn" id="id_type" required  name= "tipo_identificacion">
        <option value="CC">Cédula de Ciudadanía (CC)</option>
        <option value="TI">Tarjeta de Identidad (TI)</option>
        <option value="CE">Cédula de Extranjería (CE)</option>
        <option value="P">Pasaporte</option>
        </select><br>
                                <br>
                
        <label for="cedula">Numero de identificacion:</label>
        <input type="text" id="cedula" name="cedula"><br>
                
        <label for="direccionResidencia">Dirección de Residencia:</label>
        <input type="text" id="direccionResidencia" name = "direccion"><br>
                
        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fechaNacimiento" name = "fechanac"><br>
                
        <br>
                
        <label for="email">Correo Electrónico</label>
        <input type="email" placeholder="..." id="email" required   name = "correo"><br>
                
        <label for="contrasena">Contraseña:</label>
        <div style="position: relative;">
        <input type="password" id="contraseña" name="contraseña">
        <i class="fas fa-eye eye-icon" id="eyeIcon"></i>
         </div>
         <label>Rol</label>
        <select class="dark-btn" id="user_type" name = "rol" onchange="habilitarEspecialidad(this)"   >
        <option value="Administrador">Administrador</option>
        <option value="Medico">Medico</option>
         </select><br>    <br>
       
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>Cerrar</button>
        <button type="submit" class="btn btn-primary" name = "crear"   ><i class="fa-solid fa-floppy-disk"> Guardar  </i> 


        </form>


        </div>



      </div>
    
    </div>
  </div>
</div>