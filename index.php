<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'password_service.php';

$appVersion = get_app_version();
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Generador de Contraseñas SOAP <?= htmlspecialchars($appVersion, ENT_QUOTES, 'UTF-8') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="d-flex vh-100 align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4 shadow-lg animate__animated animate__fadeInDown">
          <h3 class="card-title text-center mb-4">Generador de Contraseñas SOAP</h3>
          <p class="text-center text-secondary mb-4">Version <span id="appVersion"><?= htmlspecialchars($appVersion, ENT_QUOTES, 'UTF-8') ?></span></p>
          <div class="mb-3 d-flex align-items-center">
            <label for="lengthSelect" class="form-label me-2">Longitud:</label>
            <select id="lengthSelect" class="form-select w-auto">
              <?php for ($i = 1; $i <= 20; $i++): ?>
                <option value="<?= $i ?>" <?= $i === 14 ? 'selected' : '' ?>><?= $i ?></option>
              <?php endfor ?>
            </select>
          </div>
          <div class="mb-3">
            <input type="text" id="password" class="form-control password-display animate__animated" readonly placeholder="Genera una password">
          </div>
          <div class="d-grid gap-2 mb-3">
            <button id="generateBtn" class="btn btn-primary btn-generate animate__animated animate__pulse animate__infinite">
              Generar
            </button>
            <button id="copyBtn" class="btn btn-success btn-generate" disabled>
              Copiar al portapapeles
            </button>
          </div>
          <div id="toastContainer" class="position-fixed top-0 start-0 p-3" style="z-index: 11;">
            <div id="toastCopy" class="toast align-items-center text-bg-success border-0" role="alert"
                 aria-live="assertive" aria-atomic="true">
              <div class="d-flex">
                <div class="toast-body">¡Contraseña copiada!</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/js/app.js"></script>
</body>
</html>
