<?php
$error = isset($_GET['error']) ? $_GET['error'] : 'unknown_error';
$error_messages = [
    'login_failed' => 'Contraseña o Usuario Incorrectos',
    'subscription_failed' => 'No se pudo completar la suscripción.',
    'invalid_input' => 'Datos ingresados no válidos.',
    'missing_fields' => 'Por favor, complete todos los campos.',
    'invalid_request' => 'Solicitud no válida.',
    'unknown_error' => 'Ha ocurrido un error desconocido.'
];
$error_message = isset($error_messages[$error]) ? $error_messages[$error] : $error_messages['unknown_error'];
if ($error === 'login_failed') {
    echo "No se pudo iniciar sesión debido a usuario y contraseña incorrectos. Verifique que el usuario y la contraseña ingresada hayan sido ingresados de manera correcta.";
} elseif ($error === 'subscription_failed') {
    echo "No se pudo completar la suscripción. Intente nuevamente más tarde.";
} elseif ($error === 'invalid_input') {
    echo "Los datos ingresados no son válidos. Por favor, verifique la información e intente nuevamente.";
} elseif ($error === 'missing_fields') {
    echo "Por favor, complete todos los campos obligatorios e intente nuevamente.";
} elseif ($error === 'invalid_request') {
    echo "Solicitud no válida. Por favor, intente nuevamente.";
} else {
    echo "Ha ocurrido un error desconocido. Por favor, intente nuevamente.";
}

?>