<?php require_once('before_header.php'); ?>
<div id='jHeader100' class="avand" data-circleEffect>
  <div class="action f align-center">
    <div class="cauto pRa10">
      <a class="logo" href="">
        <img src="<?php echo \lib\filepath::fix(\dash\get::index(\dash\data::website(), 'header_customized', 'header_logo')) ?>" alt="">
      </a>
    </div>
    <div class="c">
    </div>
    <div class="cauto pRa20">
      <a class="search" href=""></a>
    </div>
    <div class="cauto pRa20">
      <a class="cart" href="" data-count="۲">سبد خرید</a>
    </div>
    <div class="cauto">
      <a class="enter" href="">ورود به حساب کاربری</a>
    </div>
  </div>

<?php \lib\app\website\menu\generate::menu('header_menu_1'); ?>

</div>
