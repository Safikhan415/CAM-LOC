<?php
// Delete all photos if ?delete=all is set
if (isset($_GET['delete']) && $_GET['delete'] === 'all') {
    foreach (glob("logs/*.png") as $file) {
        unlink($file);
    }
    header("Location: photo_viewer.php");
    exit;
}

$folder = "logs/";
$images = glob($folder . "*.png");

usort($images, function($a, $b) {
    return filemtime($b) - filemtime($a); // newest first
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📸 Termux Pro Photo Viewer</title>
  <style>
    body {
      background-color: #121212;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 20px;
    }

    h1 {
      color: #00ffff;
    }

    .delete-button {
      margin-bottom: 20px;
    }

    .delete-button form {
      display: inline-block;
    }

    .delete-button button {
      padding: 10px 20px;
      background-color: #ff3333;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1em;
      cursor: pointer;
    }

    .gallery {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    .card {
      background: #1f1f1f;
      padding: 10px;
      border-radius: 10px;
      width: 200px;
      box-shadow: 0 0 10px #00ffff44;
    }

    .card img {
      width: 100%;
      border-radius: 8px;
    }

    .filename {
      font-size: 0.85em;
      color: #aaa;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <h1>📷 Captured Photos (Termux Pro)</h1>

  <div class="delete-button">
    <form method="get">
      <button type="submit" name="delete" value="all">🗑️ Delete All Captured Photos</button>
    </form>
  </div>

  <div class="gallery">
    <?php if (empty($images)): ?>
      <p>No images captured yet.</p>
    <?php else: ?>
      <?php foreach ($images as $img): ?>
        <div class="card">
          <img src="<?= $img ?>" alt="captured image">
          <div class="filename"><?= basename($img) ?></div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</body>
</html>
