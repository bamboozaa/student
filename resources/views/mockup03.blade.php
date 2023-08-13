<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barcode Scanner</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }

  .scanner {
    text-align: center;
  }

  #cameraPreview {
    width: 80%;
    max-width: 400px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
</style>
</head>
<body>
  <div class="scanner">
    <h2>Barcode Scanner</h2>
    <p>Scan a barcode using your device's camera.</p>
    <video id="cameraPreview" autoplay playsinline></video>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", async function() {
      try {
        const cameraPreview = document.getElementById("cameraPreview");
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        cameraPreview.srcObject = stream;
      } catch (error) {
        console.error(error);
      }
    });
  </script>
</body>
</html>
