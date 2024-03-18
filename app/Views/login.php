<?= view('layout/header'); ?>

<div class="MacbookAir1" style="width: 100%; height: 832px; padding-top: 30px; padding-bottom: 97px; padding-left: 415px; padding-right: 414.67px; background: #5CBBC1; flex-direction: column; justify-content: flex-start; align-items: center; gap: 28px; display: inline-flex">
    <img class="Image1" style="width: 306px; height: 86px" src="<?= base_url() ?>assets/img/logo.png" />
    <form action="<?= base_url('login') ?>" method="post" class="Group14" style="width: 450.33px; height: 500px; position: relative">
        <div class="Rectangle2" style="width: 450.33px; height: 538px; left: 0; right: 0; margin-left: auto; margin-right: auto; top: 0px; position: absolute; background: white; box-shadow: 0px 4px 30px 4px rgba(0, 0, 0, 0.22); border-radius: 35px"></div>
        <img class="MaleUser" style="width: 132.56px; height: 132px; left: 158.89px; top: 36px; position: absolute" src="<?= base_url() ?>assets/img/ic_avatar.png" />

        <div class="Group13" style="width: 341.38px; height: 64.48px; left: 54.48px; top: 370px; position: absolute">
            <div class="Rectangle5" style="width: 341.38px; height: 64.48px; left: 0px; top: 0px; position: absolute; background: #5CBBC1; border-radius: 38px"></div>
            <button type="submit" class="Login" style="width: 67.19px; height: 42px; left: 141.64px; top: 15px; position: absolute; color: white; font-size: 26px; font-family: Poppins; font-weight: 600;">Login</button>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="Group11" style="width: 341.54px; height: 58.71px; left: 54.48px; top: 193px; position: absolute; border: 2px solid #AEAEAE; border-radius: 38px;">
            <div class="Rectangle5"></div>
            <input type="text" name="username" placeholder="Username" class="Username" style="width: 90%; height: 90%; position: absolute; left: 5%; top: 5%; color: #AEAEAE; font-size: 18px; font-family: Poppins; font-weight: 500; border: none; outline: none; background: transparent;">
        </div>
        <div class="Group12" style="width: 341.38px; height: 58.68px; left: 54.48px; top: 277px; position: absolute; border: 2px solid #AEAEAE; border-radius: 38px;">
            <div class="Rectangle5"></div>
            <input type="password" name="password" placeholder="Password" class="Password" style="width: 90%; height: 90%; position: absolute; left: 5%; top: 5%; color: #AEAEAE; font-size: 18px; font-family: Poppins; font-weight: 600; border: none; outline: none; background: transparent;">
        </div>
    </form>
</div>

<?= view('layout/footer'); ?>