<?php
// Procesar subida de archivos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = __DIR__ . '/uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadFile = $uploadDir . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        $msg = "✅ Archivo subido con éxito: " . htmlspecialchars($_FILES['file']['name']);
    } else {
        $msg = "❌ Error al subir el archivo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vulnerable App - Upload Portal</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('https://vticloud.io/wp-content/uploads/2021/03/trend-micro-vti-cloud-partner-cover-offical.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #fff;
      position: relative;
    }
    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6); /* Overlay oscuro */
      z-index: 0;
    }
    .card {
      position: relative;
      z-index: 1;
      border-radius: 20px;
      padding: 30px;
      background: rgba(255,255,255,0.1);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.6);
      color: #fff;
    }
    .btn-primary {
      border-radius: 50px;
      background: linear-gradient(45deg, #ff416c, #ff4b2b);
      border: none;
      font-weight: bold;
      transition: transform 0.2s ease-in-out;
    }
    .btn-primary:hover {
      transform: scale(1.05);
      background: linear-gradient(45deg, #ff4b2b, #ff416c);
    }
    h2 {
      font-weight: 700;
      background: linear-gradient(90deg, #ff416c, #ff4b2b);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .msg {
      margin-top: 15px;
      font-weight: bold;
    }
    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card text-center">
          <h2 class="mb-4">🚀 Vulnerable Upload Portal</h2>
          <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 text-start">
              <label for="file" class="form-label">Selecciona un archivo para subir</label>
              <input class="form-control" type="file" name="file" id="file">
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg">⬆️ Subir Archivo</button>
            </div>
          </form>
          <?php if (!empty($msg)): ?>
            <div class="alert alert-info msg text-center mt-3"><?= $msg ?></div>
          <?php endif; ?>
          <p class="text-center mt-3 text-muted">⚠️ Esta aplicación es solo para <strong>prácticas de seguridad</strong></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
