<?= view('layout/header'); ?>
<div class="box-block">
  <div class="page show" style="z-index:102">
    <div class="header white mtop" style="height: 60px;">
      <a href="<?= base_url('gate') ?>">
        <button class="left icon ion-android-arrow-back" style="color: #333; padding-top: 18px"></button>
      </a>
      <span style="float: left; padding-top: 30px; margin-left: 10px; text-transform: none; font-size: 18px; font-weight: 600; font-family: Poppins"> Gate Cek</span>
    </div>

    <div style="background-color: #43A1A7; opacity: 0.8; padding-top: 20px;">
      <div style="width: 88%; min-height: 300px; margin: 0px auto; background-color: #fff; border-radius: 10px; box-shadow: rgba(12, 10, 20, 0.1) 0px 2px 4px 0px, rgba(12, 10, 20, 0.1) 0px 2px 16px 0px">
        <input type="text" id="jnsbayar" value="1" style="display: none" />
        <input type="text" id="jnspaket" value="1" style="display: none" />

        <div class="tab-content active" id="loketform" style="width: 95%; margin: 0px auto; padding: 15px 10px; border-top: 1px #ccc solid; padding-bottom: 20px">
          <div style="min-height: 10px"></div>
          <h4 style="font-family: Poppins; padding-top: 12px; margin-left: 20px;"><?= $gate['name'] ?></h4>
          <div style="display: flex; flex-direction: row;">
            <div class="" style="margin: 10px auto; padding: 10px; width: 80%; background-color: #F5F5F5; text-align: center; color: #fff; border-radius: 10px; border: 2px solid #B5B5B5;">
              <input type="hidden" id="gate_id" value="<?= $gate['id'] ?>">
              <textarea id="rfidtiket" oninput="handleInput()" onfocusout="lostFocus()" style=" font-family: Poppins; width: 100%; color: #43A1A7; font-size: 18px; font-weight: bold; padding: 0px 10px 15px; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word"></textarea>
              <div id="qrCodesContainer" style="display: flex; flex-wrap: wrap; color: #43A1A7;"></div>
            </div>
            <div class="" style="margin: 10px auto; width: 15%; background-color: #F5F5F5; text-align: center; color: #fff; border-radius: 10px; border: 2px solid #B5B5B5;">
              <div style="font-size: 22px; color: #43A1A7; padding: 15px 10px 0px; font-family: Poppins;">QR QTY</div>
              <div style="font-size: 32px; color: #43A1A7; font-family: Poppins;"><span id="rfQty" style="font-size:32px; font-weight: bold"></span></div>
            </div>
          </div>
        </div>
      </div>
      <div style="min-height: 200px"></div>
      <div style="min-height: 45px"></div>
    </div>
  </div>
</div>

<script>
  function cekGate() {
    let rfidtiketValue = document.getElementById('rfidtiket').value;
    let gateId = document.getElementById('gate_id').value;
    let requestBody = 'rfidtiket=' + encodeURIComponent(rfidtiketValue) + '&gateId=' + encodeURIComponent(gateId);
    fetch('<?= base_url('cekgate') ?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: requestBody
    })
    .then(response => response.json())
    .then(data => {
      console.log('Response from server:', data);
      if (data.success) {
        customAlert(data.message, true);
      } else {
        customAlert(data.message, false);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      customAlert('Terjadi kesalahan saat mengirim permintaan ke server.', false);
    });
  }

  function lostFocus() {
    // Handle lost focus event if needed
  }

  function customAlert(message, success) {
    swal({
      title: success ? "Sukses" : "Gagal",
      text: message,
      icon: success ? "success" : "error",
      button: "OK",
    }).then(function() {
      location.reload(); // Reload halaman setelah klik OK
    });
  }

  document.getElementById('rfidtiket').addEventListener('change', cekGate);
</script>

<?= view('layout/footer'); ?>

<script type="text/javascript">
  let isFirstScan = true; // Variabel penanda untuk pemindaian pertama kali

  let scanner = new Instascan.Scanner({ video: document.getElementById('preview0') });
  scanner.addListener('scan', function (content) {
    document.getElementById('rfidtiket').innerHTML = content;
    if (isFirstScan) {
      cekGate();
      isFirstScan = false; // Setelah pemindaian pertama kali, atur isFirstScan ke false
    }
    currentQR = content;
    console.log(content);
  });
  Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      console.error('No cameras found.');
    }
  }).catch(function (e) {
    console.error(e);
  });
</script>