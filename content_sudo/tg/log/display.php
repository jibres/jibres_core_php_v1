
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
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

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
        <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo a($value, 'user_id'); ?>">
          <img src="<?php echo a($value, 'avatar'); ?>" class="avatar mRa5" alt="<?php echo a($value, 'displayname'); ?>">
          <span class="font-bold s0 fs08"><?php echo a($value, 'displayname'); ?></span>
        </a>
        <div class="txtRa fs08">
          <a  title='<?php echo T_("Mobile"); ?>'><?php echo \dash\fit::number(a($value, 'mobile')); ?></a>
          <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo a($value, 'user_id'); ?>" class="badge" title='<?php echo T_("User id"); ?>'><?php echo \dash\fit::number(a($value, 'user_id')); ?></a>
        </div>
        <div class="txtRa fs08" data-tippy-placement='left' title='<?php echo T_("Telegram chatid"); ?>'>
          <a href="<?php echo \dash\url::that(); ?>?chatid=<?php echo a($value, 'chatid'); ?>"><?php echo \dash\fit::number(a($value, 'chatid')); ?></a>
        </div>
        <nav class="txtRa">
          <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo a($value, 'user_id'); ?>" title='<?php echo T_("User logs"); ?>'><i class="sf-briefcase"></i></a>
          <a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo \dash\coding::encode(a($value, 'user_id')); ?>" title='<?php echo T_("User Profile"); ?>'><i class="sf-user-md"></i></a>

        </nav>
      </td>

      <td>
        <?php if(isset($value['hook']) && $value['hook']) {?>

        <div class="mb-2">
          <a href="<?php echo \dash\url::that(); ?>?hooktext=<?php echo a($value, 'hooktext'); ?>"><?php echo a($value, 'hooktext'); ?></a>
        </div>
        <div class="f fs09">
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo a($value, 'id'); ?>#hook" class="cauto mRa5"><i class="sf-save"></i></a>
          <a href="<?php echo \dash\url::that(); ?>?hookdate=<?php echo a($value, 'hookdate'); ?>" title='<?php echo a($value, 'hookdate'); ?>' class="cauto"><?php echo a($value, 'hookdate'); ?></a>
          <div class="cauto">
            <?php if(isset($value['hookmessageid']) && $value['hookmessageid']) {?>

            <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo a($value, 'id'); ?>#hookmessageid" class="badge mLa5" title='hook messageid'><?php echo a($value, 'hookmessageid'); ?></a>

            <?php }else{ ?>

            <i class="sf-times"></i>
            <?php } //endif ?>
          </div>
        </div>

<?php }else{ ?>

        <i class="sf-times fc-yellow" title='<?php echo T_("Without hook"); ?>'></i>
<?php }//endif ?>
      </td>

      <td class="collapsing"><a href="<?php echo \dash\url::that(); ?>?step=<?php echo a($value, 'step'); ?>"><?php echo a($value, 'step'); ?></a></td>

      <td>
        <div class="ltr text-left font-bold mB5">
          <a href="<?php echo \dash\url::that(); ?>?sendmethod=<?php echo a($value, 'sendmethod'); ?>" title='<?php echo T_("Method"); ?>'><?php echo a($value, 'sendmethod'); ?></a>
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo a($value, 'id'); ?>#sendkeyboard"><?php if(isset($value['sendkeyboard']) && $value['sendkeyboard']) {?><i class="sf-thumbnails fc-green" title='<?php echo T_("With keyboard"); ?>'></i><?php }else{ ?><i class="sf-file-text text-gray-400" title='<?php echo T_("Without keyboard"); ?>'></i><?php } ?></a>
          <?php if(isset($value['sendmesageid']) && $value['sendmesageid']) {?>

          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo a($value, 'id'); ?>#sendmesageid" class="badge" title='<?php echo T_("Message id"); ?>'><?php echo a($value, 'sendmesageid'); ?></a>
        <?php } //endif ?>
        </div>
        <div class="mb-2">
          <a href="<?php echo \dash\url::that(); ?>?sendtext=<?php echo a($value, 'sendtext'); ?>"><?php echo a($value, 'sendtext'); ?></a>
        </div>
        <div class="f fs09">
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo a($value, 'id'); ?>#send" class="cauto mRa5" title='<?php echo T_("Check more detail"); ?>'><i class="sf-save"></i></a>
          <a href="<?php echo \dash\url::that(); ?>?senddate=<?php echo a($value, 'senddate'); ?>" title='<?php echo a($value, 'senddate'); ?>' class="c font-bold"><?php echo a($value, 'senddate'); ?></a>
        </div>
          <?php if(isset($value['response']) && $value['response']) {?>

        <div class="f fs09">
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo a($value, 'id'); ?>#response" class="cauto mRa5" title='<?php echo T_("Check more detail"); ?>'><i class="sf-save"></i></a>
          <a href="<?php echo \dash\url::that(); ?>?responsedate=<?php echo a($value, 'responsedate'); ?>" title='<?php echo a($value, 'responsedate'); ?>' class="c font-bold"><?php echo a($value, 'responsedate'); ?></a>
        </div>

<?php }else{ ?>

        <i class="sf-chain-broken text-red-800" title='<?php echo T_("Without response"); ?>'></i>
<?php } ?>
      </td>

      <td class="collapsing">

        <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo a($value, 'id'); ?>#meta"><?php if(isset($value['meta']) && $value['meta']) {?><i class="sf-folder fc-green"></i><?php }else{ ?><i class="sf-folder text-gray-400" title='<?php echo T_("Without meta"); ?>'></i><?php } ?></a>
      </td>

      <td class="collapsing">
        <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo a($value, 'id'); ?>" class="badge dark pA5" title='<?php echo T_("ID"); ?>'><?php echo a($value, 'id'); ?></a>
        <br>
        <a href="<?php echo \dash\url::that(); ?>?status=<?php echo a($value, 'status'); ?>"><?php echo a($value, 'status'); ?></a>
      </td>
    </tr>
<?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>


<?php function htmlFilter() {?>
<p class="f fs14 alert-info p-2 rounded">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 alert-warning p-2 rounded">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 alert-success pTB20"><?php echo T_("No record exist!"); ?></p>
<?php } //endif ?>




