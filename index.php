<?php
// index.php PHP 5.4.31 - Generador de contraseñas seguras para SOAP

function pick_random_char($str) {
    $len  = strlen($str);
    $byte = openssl_random_pseudo_bytes(1);
    $ord  = ord($byte);
    return $str[$ord % $len];
}

// Genera contraseña segura evitando caracteres problemáticos para SOAP
function generate_password($length) {
    $length = max(4, min(20, (int)$length));

    $lower   = 'abcdefghijklmnopqrstuvwxyz';
    $upper   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits  = '0123456789';

    // Caracteres especiales seguros para uso en XML/SOAP (sin &, <, >, ", ')
    $special = '!#$%()*+-=.,_:;';

    $all     = $lower . $upper . $digits . $special;

    $chars = array(
        pick_random_char($lower),
        pick_random_char($upper),
        pick_random_char($digits),
        pick_random_char($special),
    );

    for ($i = 4; $i < $length; $i++) {
        $chars[] = pick_random_char($all);
    }

    shuffle($chars);
    return implode('', $chars);
}

if (isset($_GET['action']) && $_GET['action'] === 'generate') {
    $len = isset($_GET['length']) ? $_GET['length'] : 14;
    header('Content-Type: application/json');
    echo json_encode(array('password' => generate_password($len)));
    exit;
}
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Generador de Contraseñas SOAP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    body { background: #121212; color: #f1f1f1; }
    .card { background: #1e1e1e; border: none; }
    .btn-generate { width: 100%; }
    .password-display {
      font-family: 'Courier New', monospace;
      font-size: 1.25rem;
      background: #2a2a2a;
      border: none;
      color: #0f0;
      text-align: center;
    }
  </style>
</head>
<body class="d-flex vh-100 align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4 shadow-lg animate__animated animate__fadeInDown">
          <h3 class="card-title text-center mb-4">Generador de Contraseñas SOAP</h3>
          <div class="mb-3 d-flex align-items-center">
            <label for="lengthSelect" class="form-label me-2">Longitud:</label>
            <select id="lengthSelect" class="form-select w-auto">
              <?php for ($i = 1; $i <= 20; $i++): ?>
                <option value="<?= $i ?>" <?= $i === 14 ? 'selected' : '' ?>><?= $i ?></option>
              <?php endfor ?>
            </select>
          </div>
          <div class="mb-3">
            <input type="text" id="password" class="form-control password-display animate__animated" readonly placeholder="— Génial —">
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
  <script>
    $(function(){
      var toast = new bootstrap.Toast($('#toastCopy'));

      $('#generateBtn').on('click', function(){
        var len = $('#lengthSelect').val();
        $(this).prop('disabled', true).removeClass('animate__pulse');
        $('#password').removeClass('animate__fadeIn').addClass('animate__fadeOut');
        $.getJSON('?action=generate&length=' + len, function(data){
          $('#password')
            .val(data.password)
            .removeClass('animate__fadeOut')
            .addClass('animate__fadeIn');
          $('#copyBtn').prop('disabled', false);
        }).always(function(){
          $('#generateBtn').prop('disabled', false).addClass('animate__pulse');
        });
      });

      $('#copyBtn').on('click', function(){
        var txt = $('#password').val();
        if (navigator.clipboard && window.isSecureContext) {
          navigator.clipboard.writeText(txt).then(()=> toast.show(), ()=> fallbackCopy(txt));
        } else {
          fallbackCopy(txt);
        }
      });

      function fallbackCopy(text) {
        var ta = $('<textarea>').appendTo('body').val(text).select();
        document.execCommand('copy');
        ta.remove();
        toast.show();
      }
    });
  </script>
</body>
</html>
