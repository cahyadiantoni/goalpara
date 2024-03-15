<?= view('layout/header'); ?>
<div class="box-block">
  <div class="page show" style="z-index:102">
    <div class="header white mtop" style="height: 60px">
    <a href="<?=base_url('home')?>">
      <button class="left icon ion-android-arrow-back" style="color: #333; padding-top: 18px"></button>
    </a>
      <span style="float: left; padding-top: 30px; text-transform: none; font-size: 16px; font-family: 'Open Sans', sans-serif"> New Ticket</span>
    </div>
  
    <div style="background-color: #3db379; opacity: 0.8; padding-top: 20px">
      <div style="width: 93%; min-height: 300px; margin: 0px auto; background-color: #fff; border-radius: 10px; box-shadow: rgba(12, 10, 20, 0.1) 0px 2px 4px 0px, rgba(12, 10, 20, 0.1) 0px 2px 16px 0px">
        <input type="text" id="jnsbayar" value="1" style="display: none" />
        <input type="text" id="jnspaket" value="1" style="display: none" />
  
        <div class="tab-content active" id="loketform" style="width: 95%; margin: 0px auto; padding: 15px 10px; border-top: 1px #ccc solid; padding-bottom: 20px">
          <div style="min-height: 10px"></div>
          <div class="" style="margin: 10px auto; width: 90%; background-color: #259e73; text-align: center; color: #fff; border-radius: 10px">
            <div style="font-size: 14px; color: #fff; padding: 15px 10px 0px">QR Number - Qty : <span id="rfQty" style="font-size: 18px; font-weight: bold"></span></div>
            <textarea
              id="rfidtiket"
              onfocusout="lostFocus()"
              style="width: 100%; color: #fff; font-size: 14px; font-weight: bold; padding: 0px 10px 15px; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word"
            ></textarea>
            <!--<textarea id="rfidtiket" style="backgroud-color: #fff width:100%;color:#fff;font-size:14px;font-weight:bold;padding:0px 10px 15px;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"></textarea>-->
          </div>
          <div style="text-align: center; width: 100%">
            <button onclick="ScanQrTiket();" style="padding: 10px 12px">
              <i class="material-icons" style="font-size: 24px; padding-right: 10px; color: #000">photo_camera</i><span style="vertical-align: 5px; padding-top: 35px; text-transform: none; font-weight: bold; font-size: 12px"></span>
            </button>
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
  
          <div id="keranjang" class="list radius white">
            <div class="item">
              <h2>
                <i class="material-icons" style="font-size: 28px; margin-right: 10px; color: #333">disabled_by_default</i
                ><span style="vertical-align: top; heigh: 20px; padding-top: 5px; font-size: 12px">Tiket Masuk - <span id="hrgtiket"></span></span>
              </h2>
              <div class="right" style="width: 80px">
                <button onclick="decrement()" class="buttonNbr" style="text-align: center"><i class="material-icons" style="font-size: 20px; margin-left: -10px">arrow_left</i></button>
                <h2 id="counting" style="min-height: 20px; font-size: 14px; min-width: 25px; text-align: center">1</h2>
                <button onclick="increment()" class="buttonNbr" style="text-align: center"><i class="material-icons" style="font-size: 20px; margin-left: -10px">arrow_right</i></button>
              </div>
            </div>
          </div>
          <div style="width: 100%; text-align: center">
            <i class="material-icons" onclick="openWahana(1);" style="font-size: 38px; margin-left: 10px">add</i>
          </div>
  
          <div class="input-group" style="flex-wrap: nowrap !important">
            <span class="input-group-addon">
              <i class="material-icons" style="font-size: 20px">monetization_on</i>
            </span>
            <div class="form-group label-floating" style="width: 80%">
              <label class="control-label" style="color: #000">Total bayar </label>
              <label id="ttl" type="number" class="form-control" style="color: #0a2880 !important; font-size: 20px; text-align: right; font-weight: bold"></label>
            </div>
          </div>
          <!--
         <div class="list radius white" style="border:0px;margin-bottom:10px;">
          <div class="item" style="padding:5px 15px;" onclick="openPage('paket');">
          <div class="left">
          <i class="material-icons" style="font-size:20px;">account_balance</i>
          </div>
          <div style="border-bottom:1px #ccc solid;font-size:14px;color:#000;padding-bottom:15px;width:100%;">Paket</div>
          <div class="right" style="padding-bottom:15px;">
          <span id="ketpaket" style="padding-right:10px;font-size:14px;color:#bf071c;">Reguler</span> <i class="icon ion-ios-arrow-right" ></i>
          </div>
          </div>
        </div>	
    -->
  
          <div class="list radius white" style="border: 0px; margin-bottom: 10px">
            <div class="item" style="padding: 5px 15px" onclick="openPage('paytype');">
              <div class="left">
                <i class="material-icons" style="font-size: 20px">account_balance</i>
              </div>
              <div style="border-bottom: 1px #ccc solid; font-size: 14px; color: #000; padding-bottom: 15px; width: 100%">Payment Type</div>
              <div class="right" style="padding-bottom: 15px"><span id="ketbayar" style="padding-right: 10px; font-size: 14px; color: #bf071c">Tunai</span> <i class="icon ion-ios-arrow-right"></i></div>
            </div>
          </div>
  
          <div class="input-group" style="flex-wrap: nowrap !important">
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
          </div>
          <div id="loader" class="loader" style="display: none; margin: 10px auto; width: 40px; height: 40px"></div>
          <div onClick="rekamData();" style="margin: 20px auto; width: 55%; padding: 7px; background-color: #259e73; color: #fff; border-radius: 18px; height: 35px; text-align: center; font-weight: bold">Submit</div>
        </div>
      </div>
      <div style="min-height: 200px"></div>
      <div style="min-height: 45px"></div>
    </div>
  </div>
</div>
<?= view('layout/footer');?>

