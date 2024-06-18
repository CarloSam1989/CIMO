<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="img/logocimo.ico">
    <link rel="stylesheet" href="css/error.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
            </div>
        </nav>
    </header>

    <main>
        <div class="center-content">
            <div class="card">
                <div class="header">
                  <div class="image">
                    <svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                      <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                  </div>
                  <div class="content">
                     <span class="title">Error! <br>Contraseña o Usuario Incorrectos</span>
                     <p class="message">No se pudo iniciar sesión debido a usuario y contraseña son incorrectos. 
                        Verifique que el usuario y la contraseña ingresada hayan sido ingresados de manera correcta.</p>
                  </div>
                   <div class="actions">
                     <button id="login" class="desactivate" type="button" onclick="redirectLogin()">Volver al login</button>
                  </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/error.js"></script>

</body>
</html>