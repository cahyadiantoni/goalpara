<script type="text/javascript" src="<?= base_url() ?>assets/mobileui/mobileui.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/index.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery-1.11.3.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dcalendar.picker1.js"></script>
    <!-- Vendor js -->
    <script src="<?= base_url() ?>assets/js/vendor.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/js/chartist.init.js"></script>-->
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/js/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/jquery.bootstrap.js" type="text/javascript"></script>
    <!-- Calendar -->
    <script src="<?= base_url() ?>assets/js/calendar/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/js/calendar/moment.min.js"></script>
    <script script src="<?= base_url() ?>assets/js/calendar/fullcalendar.min.js"></script>
    <!--  Plugin for the Wizard -->
    <script src="<?= base_url() ?>assets/js/material-bootstrap-wizard.js"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
    <script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>		
    <!-- KNOB JS -->
    <script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview0') });
    scanner.addListener('scan', function (content) {
      document.getElementById('rfidtiket').innerHTML = content;
      cekSaldo();
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
  </body>
</html>  