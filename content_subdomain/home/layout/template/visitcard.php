
 <link rel="stylesheet"       href="<?php echo \dash\url::cdn(). '/css/subdomain.css'; ?>"/>

<?php
if (!\dash\data::externalShop())
{
?>
<div class="cn">
  <a href="<?php echo \dash\url::sitelang(); ?>" id='ermileBadge' class="f" target="_blank" title='<?php echo T_("Sell and Enjoy"); ?>' data-tippy-inertia="true" data-tippy-animation="perspective" data-tippy-duration="[600, 300]">
   <div class="cauto pRa10">
    <img src="<?php echo \dash\url::icon(); ?>" alt='<?php echo T_('Jibres'); ?>' class="cauto">
   </div>
   <div class="c">
    <h2><?php echo T_('Jibres'); ?></h2>
    <h3><?php echo \dash\data::service_slogan(); ?></h3>
   </div>
  </a>


<?php
$store = \dash\data::store();

?>

  <div class="cbox txtC">
   <h1><a href="<?php echo \dash\url::here(); ?>"><?php echo \dash\get::index($store, 'store_data', 'title'); ?></a></h1>
   <h2><?php echo \dash\get::index($store, 'store_data', 'desc'); ?></h2>

   <?php if(isset($store['store_data']['address']) && $store['store_data']['address']) {?>

   <address class="mB20">
    <div class="street-address fs08 mB10"><?php echo $store['store_data']['address']; ?></div>
    <div class="tel ltr fs09"><?php echo T_("Tel"); ?> <a href="tel:<?php echo $store['store_data']['phone']; ?>"><?php echo \dash\fit::text(\dash\get::index($store, 'store_data', 'phone')); ?></a></div>
   </address>

<?php } //endif ?>


<?php if(\dash\user::id()) {?>

    <?php if(\dash\permission::check('contentA')) {?>
      <a href="<?php echo \dash\url::sitelang(). '/'. \dash\store_coding::encode(); ?>/a"  class="btn block primary"><?php echo T_("Store Panel"); ?></a>
    <?php } // endif ?>

<?php }else{ ?>

    <a href="<?php echo \dash\url::base(); ?>/enter" data-action class="btn block info"><?php echo T_("Enter"); ?></a>
<?php } //endif ?>
  </div>
</div>
<?php
}
?>
 <div id="nodes"></div>




<script src="<?php echo \dash\url::cdn(); ?>/js/particles/particles1.min.js"></script>


