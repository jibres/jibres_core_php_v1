
<?php


if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlTable();
    htmlFilter();

  }
  else
  {
    htmlSearchBox();
    htmlTable();
  }
}
else
{
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlFilterNoResult();


  }
  else
  {
    htmlStartAddNew();

  }

}
?>





<?php function htmlSearchBox() {?>
<div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' >
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus autocomplete='off'>

      <?php if(\dash\request::get('type')) {?>

      <input type="hidden" name="type" value="<?php echo \dash\request::get('type'); ?>">

      <?php } // endif ?>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>
<?php } //endfunction ?>





<?php function htmlTable() {?>

<?php
$sortLink = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

?>

<table class="tbl1 v3 cbox fs12">
  <thead>
    <tr>
      <th><?php echo T_("User Detail"); ?></th>
      <th><?php echo T_("Hook"); ?></th>
      <th><?php echo T_("Step"); ?></th>
      <th><?php echo T_("Sended message"); ?></th>
      <th><?php echo T_("Meta"); ?></th>
      <th><?php echo T_("ID"); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($dataTable as $key => $value) {?>
    <tr>
      <td class="collapsing">
        <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo \dash\get::index($value, 'user_id'); ?>">
          <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" class="avatar mRa5" alt="<?php echo \dash\get::index($value, 'displayname'); ?>">
          <span class="txtB s0 fs08"><?php echo \dash\get::index($value, 'displayname'); ?></span>
        </a>
        <div class="txtRa fs08">
          <a  title='<?php echo T_("Mobile"); ?>'><?php echo \dash\fit::number(\dash\get::index($value, 'mobile')); ?></a>
          <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo \dash\get::index($value, 'user_id'); ?>" class="badge" title='<?php echo T_("User id"); ?>'><?php echo \dash\fit::number(\dash\get::index($value, 'user_id')); ?></a>
        </div>
        <div class="txtRa fs08" data-tippy-placement='left' title='<?php echo T_("Telegram chatid"); ?>'>
          <a href="<?php echo \dash\url::that(); ?>?chatid=<?php echo \dash\get::index($value, 'chatid'); ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'chatid')); ?></a>
        </div>
        <nav class="txtRa">
          <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo \dash\get::index($value, 'user_id'); ?>" title='<?php echo T_("User logs"); ?>'><i class="sf-briefcase"></i></a>
          <a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo \dash\coding::encode(\dash\get::index($value, 'user_id')); ?>" title='<?php echo T_("User Profile"); ?>'><i class="sf-user-md"></i></a>

        </nav>
      </td>

      <td>
        <?php if(isset($value['hook']) && $value['hook']) {?>

        <div class="mB10">
          <a href="<?php echo \dash\url::that(); ?>?hooktext=<?php echo \dash\get::index($value, 'hooktext'); ?>"><?php echo \dash\get::index($value, 'hooktext'); ?></a>
        </div>
        <div class="f fs09">
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo \dash\get::index($value, 'id'); ?>#hook" class="cauto mRa5"><i class="sf-save-1"></i></a>
          <a href="<?php echo \dash\url::that(); ?>?hookdate=<?php echo \dash\get::index($value, 'hookdate'); ?>" title='<?php echo \dash\get::index($value, 'hookdate'); ?>' class="cauto"><?php echo \dash\get::index($value, 'hookdate'); ?></a>
          <div class="cauto">
            <?php if(isset($value['hookmessageid']) && $value['hookmessageid']) {?>

            <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo \dash\get::index($value, 'id'); ?>#hookmessageid" class="badge mLa5" title='hook messageid'><?php echo \dash\get::index($value, 'hookmessageid'); ?></a>

            <?php }else{ ?>

            <i class="sf-times"></i>
            <?php } //endif ?>
          </div>
        </div>

<?php }else{ ?>

        <i class="sf-times fc-yellow" title='<?php echo T_("Without hook"); ?>'></i>
<?php }//endif ?>
      </td>

      <td class="collapsing"><a href="<?php echo \dash\url::that(); ?>?step=<?php echo \dash\get::index($value, 'step'); ?>"><?php echo \dash\get::index($value, 'step'); ?></a></td>

      <td>
        <div class="ltr txtL txtB mB5">
          <a href="<?php echo \dash\url::that(); ?>?sendmethod=<?php echo \dash\get::index($value, 'sendmethod'); ?>" title='<?php echo T_("Method"); ?>'><?php echo \dash\get::index($value, 'sendmethod'); ?></a>
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo \dash\get::index($value, 'id'); ?>#sendkeyboard"><?php if(isset($value['sendkeyboard']) && $value['sendkeyboard']) {?><i class="sf-thumbnails fc-green" title='<?php echo T_("With keyboard"); ?>'></i><?php }else{ ?><i class="sf-file-text fc-mute" title='<?php echo T_("Without keyboard"); ?>'></i><?php } ?></a>
          <?php if(isset($value['sendmesageid']) && $value['sendmesageid']) {?>

          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo \dash\get::index($value, 'id'); ?>#sendmesageid" class="badge" title='<?php echo T_("Message id"); ?>'><?php echo \dash\get::index($value, 'sendmesageid'); ?></a>
        <?php } //endif ?>
        </div>
        <div class="mB10">
          <a href="<?php echo \dash\url::that(); ?>?sendtext=<?php echo \dash\get::index($value, 'sendtext'); ?>"><?php echo \dash\get::index($value, 'sendtext'); ?></a>
        </div>
        <div class="f fs09">
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo \dash\get::index($value, 'id'); ?>#send" class="cauto mRa5" title='<?php echo T_("Check more detail"); ?>'><i class="sf-save-1"></i></a>
          <a href="<?php echo \dash\url::that(); ?>?senddate=<?php echo \dash\get::index($value, 'senddate'); ?>" title='<?php echo \dash\get::index($value, 'senddate'); ?>' class="c txtB"><?php echo \dash\get::index($value, 'senddate'); ?></a>
        </div>
          <?php if(isset($value['response']) && $value['response']) {?>

        <div class="f fs09">
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo \dash\get::index($value, 'id'); ?>#response" class="cauto mRa5" title='<?php echo T_("Check more detail"); ?>'><i class="sf-save-1"></i></a>
          <a href="<?php echo \dash\url::that(); ?>?responsedate=<?php echo \dash\get::index($value, 'responsedate'); ?>" title='<?php echo \dash\get::index($value, 'responsedate'); ?>' class="c txtB"><?php echo \dash\get::index($value, 'responsedate'); ?></a>
        </div>

<?php }else{ ?>

        <i class="sf-chain-broken fc-red" title='<?php echo T_("Without response"); ?>'></i>
<?php } ?>
      </td>

      <td class="collapsing">

        <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo \dash\get::index($value, 'id'); ?>#meta"><?php if(isset($value['meta']) && $value['meta']) {?><i class="sf-folder-1 fc-green"></i><?php }else{ ?><i class="sf-folder fc-mute" title='<?php echo T_("Without meta"); ?>'></i><?php } ?></a>
      </td>

      <td class="collapsing">
        <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo \dash\get::index($value, 'id'); ?>" class="badge dark pA5" title='<?php echo T_("ID"); ?>'><?php echo \dash\get::index($value, 'id'); ?></a>
        <br>
        <a href="<?php echo \dash\url::that(); ?>?status=<?php echo \dash\get::index($value, 'status'); ?>"><?php echo \dash\get::index($value, 'status'); ?></a>
      </td>
    </tr>
<?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("No record exist!"); ?></p>
<?php } //endif ?>




