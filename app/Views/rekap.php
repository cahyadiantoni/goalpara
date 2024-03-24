<?= view('layout/header'); ?>
<div class="box-block">
  <div class="page show" style="z-index:102">
    <div class="header white mtop" style="height: 60px;">
      <a href="<?= base_url('home') ?>">
        <button class="left icon ion-android-arrow-back" style="color: #333; padding-top: 18px"></button>
      </a>
      <span style="float: left; padding-top: 30px; margin-left: 10px; text-transform: none; font-size: 18px; font-weight: 600; font-family: Poppins"> Rekapitulasi</span>
    </div>

    <div style="background-color: #43A1A7; opacity: 0.8; padding-top: 20px;">
      <div style="width: 88%; min-height: 300px; margin: 0px auto; background-color: #fff; border-radius: 10px; box-shadow: rgba(12, 10, 20, 0.1) 0px 2px 4px 0px, rgba(12, 10, 20, 0.1) 0px 2px 16px 0px">
        <input type="text" id="jnsbayar" value="1" style="display: none" />
        <input type="text" id="jnspaket" value="1" style="display: none" />

        <div class="tab-content active" id="loketform" style="width: 95%; margin: 0px auto; padding: 15px 10px; border-top: 1px #ccc solid; padding-bottom: 20px">
          <h4 style="font-family: Poppins; padding-top: 32px; margin-left: 20px;">Rekap</h4>
            <div style="display: flex; flex-direction: row; justify-content: center;">
            <table class="display nowrap" style="width:100%" id="saldoTable">
                <thead>
                    <tr>
                    <th class="text-center" style="font-family: Poppins;">Tiket</th>
                    <th class="text-center" style="font-family: Poppins;">Total</th>
                    <th class="text-center" style="font-family: Poppins;">Tipe Pembayaran</th>
                    <th class="text-center" style="font-family: Poppins;">Nomor Ref</th>
                    <th class="text-center" style="font-family: Poppins;">Nomor HP</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($transactions as $trans) :?>
                        <tr id="row_<?= $trans['id']; ?>">
                        <td class="align-middle text-center" style="font-family: Poppins;"><?= $trans['tiket']; ?></td>
                        <td class="align-middle text-center" style="font-family: Poppins;"><?= number_format($trans['total'], 0, ',', '.'); ?></td>
                        <td class="align-middle text-center" style="font-family: Poppins;"><?= $trans['payment_type']; ?></td>
                        <td class="align-middle text-center" style="font-family: Poppins;"><?= $trans['ref_number']; ?></td>
                        <td class="align-middle text-center" style="font-family: Poppins;"><?= $trans['phone']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
      </div>
      <div style="min-height: 200px"></div>
      <div style="min-height: 45px"></div>
    </div>
  </div>
</div>
<?= view('layout/footer'); ?>
<!-- data tables -->	
<script>
$(document).ready(function() {
        $('#saldoTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>