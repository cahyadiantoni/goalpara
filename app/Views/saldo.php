<?= view('layout/header'); ?>
<div class="box-block">
  <div class="page show" style="z-index:102">
    <div class="header white mtop" style="height: 60px;">
      <a href="<?= base_url('home') ?>">
        <button class="left icon ion-android-arrow-back" style="color: #333; padding-top: 18px"></button>
      </a>
      <span style="float: left; padding-top: 30px; margin-left: 10px; text-transform: none; font-size: 18px; font-weight: 600; font-family: Poppins"> Tiket Baru</span>
    </div>

    <div style="background-color: #43A1A7; opacity: 0.8; padding-top: 20px;">
      <div style="width: 88%; min-height: 300px; margin: 0px auto; background-color: #fff; border-radius: 10px; box-shadow: rgba(12, 10, 20, 0.1) 0px 2px 4px 0px, rgba(12, 10, 20, 0.1) 0px 2px 16px 0px">
        <input type="text" id="jnsbayar" value="1" style="display: none" />
        <input type="text" id="jnspaket" value="1" style="display: none" />

        <div class="tab-content active" id="loketform" style="width: 95%; margin: 0px auto; padding: 15px 10px; border-top: 1px #ccc solid; padding-bottom: 20px">
          <div style="min-height: 10px"></div>
          <h4 style="font-family: Poppins; padding-top: 12px; margin-left: 20px;">Input QR Code</h4>
          <div style="display: flex; flex-direction: row;">
            <div class="" style="margin: 10px auto; padding: 10px; width: 80%; background-color: #F5F5F5; text-align: center; color: #fff; border-radius: 10px; border: 2px solid #B5B5B5;">
              <textarea id="rfidtiket" oninput="handleInput()" onfocusout="lostFocus()" style=" font-family: Poppins; width: 100%; color: #43A1A7; font-size: 18px; font-weight: bold; padding: 0px 10px 15px; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word"></textarea>
              <div id="qrCodesContainer" style="display: flex; flex-wrap: wrap; color: #43A1A7;"></div>
            </div>
            <div class="" style="margin: 10px auto; width: 15%; background-color: #F5F5F5; text-align: center; color: #fff; border-radius: 10px; border: 2px solid #B5B5B5;">
              <div style="font-size: 22px; color: #43A1A7; padding: 15px 10px 0px; font-family: Poppins;">QR QTY</div>
              <div style="font-size: 32px; color: #43A1A7; font-family: Poppins;"><span id="rfQty" style="font-size:32px; font-weight: bold"></span></div>
            </div>
          </div>

          <h4 style="font-family: Poppins; padding-top: 32px; margin-left: 20px;">Saldo Anda</h4>
          <div class="" style="justify-content: center; padding: 20px; margin: 20px; background-color: #F5F5F5; text-align: center; color: #fff; border-radius: 10px; border: 2px solid #B5B5B5;">
            <div style="display: flex; flex-direction: row; justify-content: center;">
            <table class="table" id="saldoTable">
                <thead>
                    <tr>
                    <th class="text-center" style="font-family: Poppins;">Nama Tiket</th>
                    <th class="text-center" style="font-family: Poppins;">Kategori</th>
                    <th class="text-center" style="font-family: Poppins;">Kapasitas</th>
                    <th class="text-center" style="font-family: Poppins;">Jumlah</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                </table>
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
  function cekSaldo() {
    let rfidtiketValue = document.getElementById('rfidtiket').value;
    fetch('<?= base_url('cek_saldo') ?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'rfidtiket=' + encodeURIComponent(rfidtiketValue)
    })
    .then(response => response.json())
    .then(data => {
      console.log('Response from server:', data); // Tambahkan baris ini untuk melihat respons dari server

      let tableBody = document.querySelector('#saldoTable tbody');

      if (Array.isArray(data) && data.length > 0) {
        data.forEach(row => {
          tableBody.innerHTML += `
            <tr>
              <td class="align-middle text-center" style="font-family: Poppins;">${row.name}</td>
              <td class="align-middle text-center" style="font-family: Poppins;">${row.kategori}</td>
              <td class="align-middle text-center" style="font-family: Poppins;">${row.kapasitas}</td>
              <td class="align-middle text-center" style="font-family: Poppins;">${row.amount}</td>
            </tr>
          `;
        });
      } else {
        // Tampilkan pesan atau data kosong jika tidak ada data
        tableBody.innerHTML = `
          <tr>
            <td class="align-middle text-center" colspan="4" style="font-family: Poppins;">Saldo Anda Kosong</td>
          </tr>
        `;
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }

  function lostFocus() {
    // Handle lost focus event if needed
  }

  document.getElementById('rfidtiket').addEventListener('change', cekSaldo);
</script>



<?= view('layout/footer'); ?>