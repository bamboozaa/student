<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barcode Scanner</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
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

  #barcodeInput {
    width: 80%;
    padding: 10px;
    margin: 20px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
</style>
</head>
<body>
  <div class="scanner">
    <h2>Barcode Scanner</h2>
    <p>Scan a barcode using your device's camera.</p>
    <input type="text" id="barcodeInput" placeholder="Scanned barcode will appear here">
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const barcodeInput = document.getElementById("barcodeInput");

      Quagga.init({
        inputStream: {
          name: "Live",
          type: "LiveStream",
          constraints: {
            width: 640,
            height: 480,
            facingMode: "environment" // or "user" for front camera
          }
        },
        locator: {
          patchSize: "medium",
          halfSample: true
        },
        numOfWorkers: navigator.hardwareConcurrency || 1,
        decoder: {
          readers: ["code_128_reader"]
        },
        locate: true,
        frequency: 1,
        inputStreamConstraints: {
          video: true
        },
        debug: false,
        area: {
          top: "30%",
          right: "0%",
          left: "0%",
          bottom: "30%"
        }
      }, function (err) {
        if (err) {
          console.error(err);
          return;
        }
        Quagga.start();
        Quagga.onDetected(function (result) {
          if (result.codeResult) {
            barcodeInput.value = result.codeResult.code;
            Quagga.stop();
          }
        });
      });
    });
  </script>
</body>
</html>
