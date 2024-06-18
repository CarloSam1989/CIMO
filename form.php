<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal con Bootstrap</title>
  <link rel="icon" type="image/x-icon" href="img/logocimo.ico">
  <link rel="stylesheet" href="css/foirmulaio.css">
  <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  

<!-- Botón modal registro-->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Abrir Registro
</button>

<!-- Modal registro -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Persona</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí va tu formulario -->
        <form>
          <div class="form-group">
            <label for="nombre">Nombres</label>
            <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre">
          </div>
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico">
          </div>
          <div class="form-group">
            <label for="phone">Telefono</label>
            <input type="phone" class="form-control" id="phone" placeholder="Ingresa tu numero telefonico">
          </div>
          <!-- Select para elegir una opción -->
          <div class="form-group">
            <label for="opcion">Elige la seccion:</label>
            <select class="form-control" id="opcion">
              <option value="opcion1">Carrusel</option>
              <option value="opcion2">Noticias</option>
              <option value="opcion3">Suscripciones</option>
              <!-- Agrega más opciones según sea necesario -->
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Registrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Boton modal suscripcion -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSuscripcion">
  Suscripciones
</button>

<!-- Modal suscripcion-->
<div class="modal fade" id="modalSuscripcion" tabindex="-1" role="dialog" aria-labelledby="modalRegistroLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegistroLabel">Formulario de Suscripción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí va tu formulario de suscripción -->
        <form>
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Suscribir</button>
      </div>
    </div>
  </div>
</div>

<!-- Botón modal Noticias -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNoticias">
  Noticias
</button>

<!-- Modal de noticias -->
<div class="modal fade" id="modalNoticias" tabindex="-1" role="dialog" aria-labelledby="modalNoticiasLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalNoticiasLabel">Formulario Noticias</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form id="newsForm">
              <div class="form-group">
                <label for="tituloNoticia">Título de la noticia</label>
                <input type="text" class="form-control" id="tituloNoticia" placeholder="Ingrese título">
              </div>
              <div class="form-group">
                <label for="newsContent">Ultimas Noticias:</label>
                <textarea class="form-control" id="newsContent" rows="10" maxlength="10"></textarea>
              </div>
              <div class="form-group">
                <label for="newsImage">Subir imagen de la noticia:</label>
                <button class="open-file">
                  <span class="file-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 71 67">
                      <path
                        stroke-width="5"
                        stroke="black"
                        d="M41.7322 11.7678L42.4645 12.5H43.5H68.5V64.5H2.5V2.5H32.4645L41.7322 11.7678Z"
                      ></path>
                    </svg>
                    <span class="file-front"></span>
                  </span>
                  Open file
                  <input type="file" class="form-control-file" id="uploadImage" style="display: none;">
                </button>                           
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="saveAndClose()">Guardar</button>
          </div>
          
      </div>
  </div>
</div>
<script src="js/form.js"></script>
<!-- JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>