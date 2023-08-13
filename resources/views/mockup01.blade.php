<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barcode Scanner Mockup</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
  }

  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }

  .scanner {
    border: 2px solid #333;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  .barcode-input {
    width: 80%;
    padding: 10px;
    margin: 20px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .scan-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }
</style>
</head>
<body>
  <div class="container">
    <div class="scanner">
      <h2>Barcode Scanner</h2>
      <p>Scan a barcode using your device's camera.</p>
      <input type="text" class="barcode-input" placeholder="Enter barcode manually">
      <button class="scan-button">Scan Barcode</button>
    </div>
  </div>
</body>
</html>
