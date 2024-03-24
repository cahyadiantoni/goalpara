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
              <!-- <div style="font-size: 14px; color: #fff; padding: 15px 10px 0px">QR Number - Qty : <span id="rfQty" style="font-size: 18px; font-weight: bold"></span></div> -->
              <textarea id="rfidtiket" oninput="handleInput()" onfocusout="lostFocus()" style=" font-family: Poppins; width: 100%; color: #43A1A7; font-size: 18px; font-weight: bold; padding: 0px 10px 15px; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word"></textarea>
              <div id="qrCodesContainer" style="display: flex; flex-wrap: wrap; color: #43A1A7;"></div>
              <!--<textarea id="rfidtiket" style="backgroud-color: #fff width:100%;color:#fff;font-size:14px;font-weight:bold;padding:0px 10px 15px;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"></textarea>-->
            </div>
            <div class="" style="margin: 10px auto; width: 15%; background-color: #F5F5F5; text-align: center; color: #fff; border-radius: 10px; border: 2px solid #B5B5B5;">
              <div style="font-size: 22px; color: #43A1A7; padding: 15px 10px 0px; font-family: Poppins;">QR QTY</div>
              <div style="font-size: 32px; color: #43A1A7; font-family: Poppins;"><span id="rfQty" style="font-size:32px; font-weight: bold"></span></div>

              <!--<textarea id="rfidtiket" style="backgroud-color: #fff width:100%;color:#fff;font-size:14px;font-weight:bold;padding:0px 10px 15px;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"></textarea>-->
            </div>
          </div>
          <div style="text-align: center; width: 100%">
            <!-- <button onclick="ScanQrTiket();" style="padding: 10px 12px">
              <i class="material-icons" style="font-size: 24px; padding-right: 10px; color: #000">photo_camera</i><span style="vertical-align: 5px; padding-top: 35px; text-transform: none; font-weight: bold; font-size: 12px"></span>
            </button> -->
          </div>
          <div class="input-group" style="flex-wrap: nowrap !important; display: none">
            <span class="input-group-addon">
              <i class="material-icons" style="font-size: 20px">calculate</i>
            </span>
            <div class="form-group label-floating" style="width: 80%">
              <label class="control-label" style="color: #000">Qty <small>(required)</small></label>
              <input id="qty" type="number" class="form-control" onkeyup="RefreshHarga()" style="color: #0a2880 !important; font-size: 18px; font-weight: normal; text-align: right" />
            </div>
          </div>

          <div id="keranjang" class="list radius" style="margin-top: 30px; border-radius: 10px; border-radius: 10px; border: 2px solid #B5B5B5; background-color: #F5F5F5; margin-left: 20px; margin-right: 20px;">
            <?php foreach ($wahanas as $wahana) :
              if ($wahana['id'] == 1 || $wahana['id'] == 3) {
            ?>
                <div class="item" id="item_<?= $wahana['id'] ?>">
                  <div id="aharga_<?= $wahana['id'] ?>" style="display:none;"><?= $wahana['harga'] ?></div>
                  <h2 style="justify-content: center;">
                    <i class="material-icons" style="font-size: 28px; margin-right: 10px; color: #333">cancel</i><span style="vertical-align: top; heigh: 20px; padding-top: 5px; font-size: 18px; font-family: Poppins;"><?= $wahana['name'] ?> - <span id="kategori"><?= $wahana['kategori']; ?></span> - <span id="kapasitas"><?= $wahana['kapasitas']; ?></span> orang - <span id="hargaTkt"><?= number_format($wahana['harga'], 0, ',', '.'); ?></span></span>
                  </h2>
                  <div class="right" style="width: 100px">
                    <button onclick="decrement()"><i class="material-icons" style="font-size: 32px; margin-left: -12px; color: #43A1A7;">add_circle</i></button>
                    <h2 id="counting_<?= $wahana['id'] ?>" style="min-height: 20px; font-size: 14px; min-width: 25px; text-align: center">1</h2>
                    <button onclick="increment()"><i class="material-icons" style="font-size: 32px; margin-left: -12px; color: #43A1A7;">add_circle</i></button>
                  </div>
                </div>
            <?php
              }
            endforeach; ?>
          </div>

          <div style="width: 100%; text-align: center; padding-top: 24px;">
            <button type="button" style="color:#fff; font-family: Poppins; background-color: #43A1A7; padding-left: 18px; padding-right: 18px; border-radius: 32px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Tambah Wahana
            </button>
          </div>

          <h4 style="font-family: Poppins; padding-top: 32px; margin-left: 20px;">Detail Pesanan</h4>
          <div class="" style="justify-content: center; padding: 20px; margin: 20px; background-color: #F5F5F5; text-align: center; color: #fff; border-radius: 10px; border: 2px solid #B5B5B5;">
            <div style="display: flex; flex-direction: row; justify-content: center;">
              <div style="height: 240px; width: 280px; background-color: #43A1A7; border-radius: 12px; text-align: center; display: flex; flex-direction: column; justify-content: center;">
                <h5 style="font-family: Poppins; vertical-align: middle;">Total Bayar</h5>
                <h2 id="ttlThis" type="number" style="font-family: Poppins;"></h2>
                <div id="totalHarga" style="display:none;"></div>
              </div>
              <div style="margin: 20px;"></div>
              <div style="height: 240px; width: 50%; display: flex; flex-direction: column; justify-content: center;">
                <div class="list" style="border: 0px; margin-bottom: 10px; width:83%; font-family: Poppins; background-color: white;  border-radius: 32px; border: 1px solid #B5B5B5;">
                  <div style="padding: 18px 25px">
                    <div class="left">
                      <i class="material-icons" style="font-size: 24px; color: #43A1A7;">account_balance_wallet</i>
                    </div>
                    <div style="font-size: 18px; color: #000; text-align: left;">Payment Type</div>
                    <div class="right">
                      <select id="paymentType" style="font-size: 18px;">
                        <option value="Tunai">Tunai</option>
                        <option value="Kartu Debit">Kartu Debit</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                        <option value="QRIS">QRIS</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="list" style="border: 0px; width:83%; margin-bottom: 10px; font-family: Poppins; background-color: white;  border-radius: 32px; border: 1px solid #B5B5B5;">
                  <div style="padding: 10px 25px">
                    <div class="form-group label-floating" style="width: 80%;  display: flex; justify-content: center;">
                      <i class="material-icons" style="font-size: 24px; color: #43A1A7; margin-right: 10px;">phone</i>
                      <input id="phone" type="number" name="phone" placeholder="No. Telepon" style="height: 90%;font-size: 18px; font-family: Poppins; border: none; outline: none; background: transparent;" require>
                    </div>
                  </div>
                </div>
                <div class="list" style="border: 0px; width:83%; font-family: Poppins; background-color: white;  border-radius: 32px; border: 1px solid #B5B5B5;">
                  <div style="padding: 10px 25px">
                    <div class="form-group label-floating" style="width: 80%;  display: flex; justify-content: center;">
                      <i class="material-icons" style="font-size: 24px; color: #43A1A7; margin-right: 10px;">monetization_on</i>
                      <input id="refno" type="number" name="number" placeholder="Ref. Number" style="height: 90%;font-size: 18px; font-family: Poppins; border: none; outline: none; background: transparent;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="input-group" style="flex-wrap: nowrap !important">
            <span class="input-group-addon">
              <i class="material-icons" style="font-size: 20px">monetization_on</i>
            </span>
            <div class="form-group label-floating" style="width: 80%">
              <label class="control-label" style="color: #000">Total bayar </label>
              <label id="ttlThis" type="number" class="form-control" style="color: #0a2880 !important; font-size: 20px; text-align: right; font-weight: bold"></label>
            </div>
            <div id="totalHarga" style="display:none;"></div>
          </div> -->

          <!-- <div class="list radius white" style="border: 0px; margin-bottom: 10px; width:83%">
            <div class="paytype" style="padding: 5px 15px">
              <div class="left">
                <i class="material-icons" style="font-size: 20px">account_balance</i>
              </div>
              <div style="border-bottom: 1px #ccc solid; font-size: 14px; color: #000; padding-bottom: 15px; width: 100%">Payment Type</div>
              <div class="right" style="padding-bottom: 15px">
                <select id="paymentType" style="font-size: 24px;">
                  <option value="Tunai">Tunai</option>
                  <option value="Kartu Debit">Kartu Debit</option>
                  <option value="Kartu Kredit">Kartu Kredit</option>
                  <option value="QRIS">QRIS</option>
                </select>
              </div>
            </div>
          </div> -->

          <!-- <div class="input-group" style="flex-wrap: nowrap !important">
            <span class="input-group-addon">
              <i class="material-icons" style="font-size: 20px">monetization_on</i>
            </span>
            <div class="form-group label-floating" style="width: 80%">
              <label class="control-label" style="color: #000">Ref.Number </label>
              <input id="refno" type="number" class="form-control" style="color: #0a2880 !important; font-weight: bold" />
            </div>
          </div>
          <div class="input-group" style="flex-wrap: nowrap !important; margin-top: 20px">
            <span class="input-group-addon">
              <i class="material-icons" style="font-size: 18px">phone_android</i>
            </span>
            <div class="form-group label-floating" style="width: 80%">
              <label class="control-label" style="color: #000">Phone <small>(required)</small></label>
              <input id="phone" type="number" class="form-control" style="color: #0a2880 !important; font-weight: bold" />
            </div>
          </div> -->

          <div id="loader" class="loader" style="display: none; margin: 10px auto; width: 40px; height: 40px"></div>
          <div onClick="submitThis();" style="margin: 20px auto; width: 50%; margin-top: 80px; padding: 16px; background-color: #0FE471; color: #fff; border-radius: 32px; text-align: center; font-weight: 500; font-size: 18px; font-family: Poppins;">Submit</div>
        </div>
      </div>
      <div style="min-height: 200px"></div>
      <div style="min-height: 45px"></div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-family: Poppins;">Pilihan Wahana</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th class="text-center" style="font-family: Poppins;">Nama Tiket</th>
              <th class="text-center" style="font-family: Poppins;">Kategori</th>
              <th class="text-center" style="font-family: Poppins;">Kapasitas</th>
              <th class="text-center" style="font-family: Poppins;">Harga</th>
              <th class="text-center" style="font-family: Poppins;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($wahanas as $wahana) :
              if ($wahana['id'] != 1 && $wahana['id'] != 2 && $wahana['id'] != 3) {
            ?>
                <tr id="row_<?= $wahana['id']; ?>">
                  <td class="align-middle text-center" style="font-family: Poppins;"><?= $wahana['name']; ?></td>
                  <td class="align-middle text-center" style="font-family: Poppins;"><?= $wahana['kategori']; ?></td>
                  <td class="align-middle text-center" style="font-family: Poppins;"><?= $wahana['kapasitas']; ?></td>
                  <td class="align-middle text-center" style="font-family: Poppins;"><?= $wahana['harga']; ?></td>
                  <td class="align-middle text-center" style="font-family: Poppins;">
                    <button onclick="addWahanaThis('<?= $wahana['id']; ?>' , '<?= $wahana['name']; ?>' , '<?= $wahana['harga']; ?>' , '<?= $wahana['kategori']; ?>' , '<?= $wahana['kapasitas']; ?>' )" class="btn btn-primary" style="background-color: #43A1A7;">Pilih</button>
                  </td>
                </tr>
            <?php
              }
            endforeach; ?>
          </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-family: Poppins;">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  function handleInput() {
    // Mendapatkan nilai dari textarea
    var inputText = document.getElementById("rfidtiket").value;

    // Memisahkan teks menjadi potongan kode QR menggunakan koma atau spasi sebagai pemisah
    var qrCodes = inputText.split(/[\s,]+/);

    // Membersihkan kontainer sebelum menambahkan QR codes baru
    document.getElementById("qrCodesContainer").innerHTML = '';

    // Membuat dan menambahkan div untuk setiap potongan kode QR
    qrCodes.forEach(qrCode => {
      // Menghilangkan spasi awal dan akhir dari potongan kode QR
      qrCode = qrCode.trim();

      // Membuat div untuk chip QR
      if (qrCode) {
        var qrDiv = document.createElement("div");
        qrDiv.textContent = qrCode;
        qrDiv.style.margin = "5px";
        qrDiv.style.padding = "7px";
        qrDiv.style.paddingRight = "14px";
        qrDiv.style.paddingLeft = "14px";
        qrDiv.style.border = "1px solid #43A1A7";
        qrDiv.style.borderRadius = "5px";
        qrDiv.style.background = "#5CBBC1";
        qrDiv.style.color = "#fff";
        qrDiv.style.borderRadius = "16px";
        qrDiv.style.fontSize = "16px";


        // Membuat tombol hapus untuk setiap chip QR
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "x";
        deleteButton.style.backgroundColor = "#f44336";
        deleteButton.style.color = "#fff";
        deleteButton.style.border = "none";
        deleteButton.style.borderRadius = "50%";
        deleteButton.style.cursor = "pointer";
        deleteButton.style.marginLeft = "5px";
        deleteButton.onclick = function() {
          // Menghapus chip QR beserta karakter di dalamnya
          qrDiv.remove();
          // Mendapatkan nilai dari textarea dan menghapus kode QR yang sesuai dengan tombol hapus yang ditekan
          var updatedText = document.getElementById("rfidtiket").value.replace(qrCode, '').trim();
          document.getElementById("rfidtiket").value = updatedText;
          // Memanggil kembali handleInput() untuk memperbarui tampilan chip QR
          handleInput();
        };

        // Menambahkan tombol hapus ke dalam div chip QR
        qrDiv.appendChild(deleteButton);

        // Menambahkan div chip QR beserta tombol hapus ke dalam kontainer
        document.getElementById("qrCodesContainer").appendChild(qrDiv);
      }
    });
  }


  function lostFocus() {
    // Menambahkan pemisah terakhir jika tidak ada spasi terakhir pada textarea
    var inputText = document.getElementById("rfidtiket").value;
    if (inputText.trim() && inputText.charAt(inputText.length - 1) !== ",") {
      document.getElementById("rfidtiket").value += ",";
    }
  }

  function addWahanaThis(tiket_id, nama, harga, kategori, kapasitas) {
    var cst = '<div class="item" id="item_' + tiket_id + '">';
    cst += '<div id="aharga_' + tiket_id + '" style="display:none;">' + harga + '</div>';
    cst += '';
    cst += '<h2 style="font-size:14px;"><i onclick="removeWahanaThis(' + "'" + 'item_' + tiket_id + "','" + tiket_id + "'" + ');" class="material-icons" style="font-size:28px;margin-right:10px;color:red;">cancel</i><span id="ket_' + tiket_id + '" style="vertical-align: top;heigh:20px;padding-top:5px;font-size: 18px; font-family: Poppins;">' + nama + '</span>';
    cst += '<span style="vertical-align: top;padding-top:5px;heigh:20px; font-size: 18px; font-family: Poppins;"> - </span>';
    cst += '<span style="vertical-align: top;padding-top:5px;heigh:20px; font-size: 18px; font-family: Poppins;" id="kategori_' + tiket_id + '" >' + kategori + '</span>';
    cst += '<span style="vertical-align: top;padding-top:5px;heigh:20px; font-size: 18px; font-family: Poppins;"> - </span>';
    cst += '<span style="vertical-align: top;padding-top:5px;heigh:20px; font-size: 18px; font-family: Poppins;" id="kapasitas_' + tiket_id + '" >' + kapasitas + '</span>';
    cst += '<span style="vertical-align: top;padding-top:5px;heigh:20px; font-size: 18px; font-family: Poppins;"> orang - </span>';
    cst += '<span style="vertical-align: top;padding-top:5px;heigh:20px; font-size: 18px; font-family: Poppins;" id="harga_' + tiket_id + '" >' + parseFloat(harga).toLocaleString('id-ID') + '</span></h2>';
    cst += '<div class="right" style="width:100px;">';
    cst += '<button onclick="decrementThis(' + "'" + tiket_id + "'" + ')" ><i class="material-icons" style="font-size:32px;margin-left:-12px; color: #43A1A7;">add_circle</i></button>';
    cst += '<h2 id="counting_' + tiket_id + '" style="min-height:20px;font-size:14px;min-width:25px;text-align:center;">1</h2>';
    cst += '<button onclick="incrementThis(' + "'" + tiket_id + "'" + ')" ><i class="material-icons" style="font-size:32px;margin-left:-12px; color: #43A1A7;">add_circle</i></button> ';
    cst += '</div>';
    cst += '</div>';
    $(cst).appendTo('#keranjang');

    // Hapus baris dari tabel modal
    var rowToRemove = document.getElementById('row_' + tiket_id);
    if (rowToRemove) {
      rowToRemove.remove();
    }

    RefreshTotal();
  }

  function incrementThis(tiket_id) {
    var countingElement = document.getElementById('counting_' + tiket_id);
    var currentCount = parseInt(countingElement.innerText);
    countingElement.innerText = currentCount + 1;

    RefreshTotal();
  }

  function decrementThis(tiket_id) {
    var countingElement = document.getElementById('counting_' + tiket_id);
    var currentCount = parseInt(countingElement.innerText);
    if (currentCount > 1) {
      countingElement.innerText = currentCount - 1;
    }

    RefreshTotal();
  }

  function removeWahanaThis(item_id, tiket_id) {
    // Kembalikan item ke dalam tabel modal
    var nama = document.getElementById('ket_' + tiket_id).innerText;
    var harga = document.getElementById('aharga_' + tiket_id).innerText;
    var kategori = document.getElementById('kategori_' + tiket_id).innerText;
    var kapasitas = document.getElementById('kapasitas_' + tiket_id).innerText;

    var newRow = document.createElement('tr');
    newRow.id = 'row_' + tiket_id;
    newRow.innerHTML = `
      <td class="align-middle text-center">${nama}</td>
      <td class="align-middle text-center">${kategori}</td>
      <td class="align-middle text-center">${kapasitas}</td>
      <td class="align-middle text-center">${harga}</td>
      <td class="align-middle text-center">
        <button onclick="addWahanaThis('${tiket_id}', '${nama}', '${harga}');" class="btn btn-primary">Pilih</button>
      </td>
    `;

    var modalTableBody = document.querySelector('#exampleModal table tbody');
    var firstRow = modalTableBody.querySelector('tr');
    modalTableBody.insertBefore(newRow, firstRow);

    // Hapus item dari #keranjang
    var itemToRemove = document.getElementById(item_id);
    if (itemToRemove) {
      itemToRemove.remove();
    }

    RefreshTotal();
  }

  document.addEventListener("DOMContentLoaded", function() {
    RefreshTotal(); // Jalankan RefreshTotal saat halaman telah dimuat
  });

  function RefreshTotal() {
    var totalBayar = 0;
    $('.item').each(function() {
      var item_id = $(this).attr('id').split('_')[1];
      var harga = $('#aharga_' + item_id).text();
      var jumlah = $('#counting_' + item_id).text();
      totalBayar += parseInt(harga) * parseInt(jumlah);
    });

    $('#ttlThis').text(parseFloat(totalBayar).toLocaleString('id-ID'));
    $('#totalHarga').text(totalBayar);
  }

  function submitThis() {
    var rfidtiket = $('#rfidtiket').val(); // Ambil nilai dari textarea
    var totalBayar = $('#totalHarga').text(); // Ambil total bayar dari div totalHarga
    var paymentType = $('#paymentType').val(); // Ambil jenis pembayaran dari select paymentType
    var refno = $('#refno').val(); // Ambil nomor referensi dari input refno
    var phone = $('#phone').val(); // Ambil nomor telepon dari input phone

    var wahana = [];
    $('.item').each(function() {
      var item_id = $(this).attr('id').split('_')[1];
      var harga = $('#aharga_' + item_id).text();
      var jumlah = $('#counting_' + item_id).text();
      wahana.push({
        item_id: item_id,
        harga: harga,
        jumlah: jumlah
      });
    });

    // Objek data yang akan dikirim melalui POST
    var postData = {
      rfidtiket: rfidtiket,
      totalBayar: totalBayar,
      paymentType: paymentType,
      refno: refno,
      phone: phone,
      wahana: wahana // Array wahana yang telah dibuat sebelumnya
    };

    // Kirim data ke endpoint submitTransaksi dengan metode POST
    $.post("<?= base_url('submitTransaksi') ?>", postData)
      .done(function(response) {
        // Handle respons dari server jika diperlukan
        console.log(response);
        customAlert('Transaksi berhasil dikirim!');
      })
      .fail(function(error) {
        // Handle kesalahan jika ada
        console.error(error);
        alert('Terjadi kesalahan saat mengirim transaksi.');
      });
  }

  function customAlert(message) {
    swal({
      title: "Transaksi Sukses",
      text: message,
      icon: "success",
      button: "OK",
    }).then(function() {
      location.reload(); // Reload halaman setelah klik OK
    });
  }
</script>

<?= view('layout/footer'); ?>

<script type="text/javascript">
  let scanner = new Instascan.Scanner({ video: document.getElementById('preview0') });
  scanner.addListener('scan', function (content) {
    document.getElementById('rfidtiket').innerHTML = content;
    // cekSaldo();
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