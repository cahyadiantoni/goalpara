<?= view('layout/header'); ?>
<div class="box-block">
  <div class="page show" style="z-index:102">
    <div class="header white mtop" style="height: 60px;">
      <a href="<?= base_url('home') ?>">
        <button class="left icon ion-android-arrow-back" style="color: #333; padding-top: 18px"></button>
      </a>
      <span style="float: left; padding-top: 30px; margin-left: 10px; text-transform: none; font-size: 18px; font-weight: 600; font-family: Poppins"> Gate</span>
    </div>

    <div style="background-color: #43A1A7; opacity: 0.8; padding-top: 20px;">
      <div style="width: 88%; min-height: 300px; margin: 0px auto; background-color: #fff; border-radius: 10px; box-shadow: rgba(12, 10, 20, 0.1) 0px 2px 4px 0px, rgba(12, 10, 20, 0.1) 0px 2px 16px 0px">
        <input type="text" id="jnsbayar" value="1" style="display: none" />
        <input type="text" id="jnspaket" value="1" style="display: none" />

        <div class="tab-content active" id="loketform" style="width: 95%; margin: 0px auto; padding: 15px 10px; border-top: 1px #ccc solid; padding-bottom: 20px">
          <h4 style="font-family: Poppins; padding-top: 12px; margin-left: 20px;">Pilih Gate</h4>
          <div id="gate" class="list radius" style="margin-top: 30px; border-radius: 10px; border-radius: 10px; border: 2px solid #B5B5B5; background-color: #F5F5F5; margin-left: 20px; margin-right: 20px;">
            <?php foreach ($gates as $gate) :?>
                <a href="<?= base_url('gatecek') ?>/<?= $gate['id'] ?>">
                <div class="item" id="">
                  <h2 style="justify-content: center;">
                    <span style="vertical-align: top; heigh: 20px; padding-top: 5px; font-size: 18px; font-family: Poppins;"><?= $gate['name'] ?> - <span id=""><?= $gate['code']; ?></span></span>
                  </h2>
                </div>
                </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('layout/footer'); ?>