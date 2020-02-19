
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
  <form method="get" action='<?php echo \dash\url::this(); ?>' data-action>
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
        <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo @$value['user_id']; ?>">
          <img src="<?php echo @$value['avatar']; ?>" class="avatar mRa5" alt="<?php echo @$value['displayname']; ?>">
          <span class="txtB s0 fs08"><?php echo @$value['displayname']; ?></span>
        </a>
        <div class="txtRa fs08">
          <a  title='<?php echo T_("Mobile"); ?>'><?php echo \dash\fit::number(@$value['mobile']); ?></a>
          <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo @$value['user_id']; ?>" class="badge" title='<?php echo T_("User id"); ?>'><?php echo \dash\fit::number(@$value['user_id']); ?></a>
        </div>
        <div class="txtRa fs08" data-tippy-placement='left' title='<?php echo T_("Telegram chatid"); ?>'>
          <a href="<?php echo \dash\url::that(); ?>?chatid=<?php echo @$value['chatid']; ?>"><?php echo \dash\fit::number(@$value['chatid']); ?></a>
        </div>
        <nav class="txtRa">
          <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo @$value['user_id']; ?>" title='<?php echo T_("User logs"); ?>'><i class="sf-briefcase"></i></a>
          <a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo \dash\coding::encode(@$value['user_id']); ?>" title='<?php echo T_("User Profile"); ?>'><i class="sf-user-md"></i></a>

        </nav>
      </td>

      <td>
        <?php if(isset($value['hook']) && $value['hook']) {?>

        <div class="mB10">
          <a href="<?php echo \dash\url::that(); ?>?hooktext=<?php echo @$value['hooktext']; ?>"><?php echo @$value['hooktext']; ?></a>
        </div>
        <div class="f fs09">
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo @$value['id']; ?>#hook" class="cauto mRa5"><i class="sf-save-1"></i></a>
          <a href="<?php echo \dash\url::that(); ?>?hookdate=<?php echo @$value['hookdate']; ?>" title='<?php echo @$value['hookdate']; ?>' class="cauto"><?php echo @$value['hookdate']; ?></a>
          <div class="cauto">
            <?php if(isset($value['hookmessageid']) && $value['hookmessageid']) {?>

            <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo @$value['id']; ?>#hookmessageid" class="badge mLa5" title='hook messageid'><?php echo @$value['hookmessageid']; ?></a>

            <?php }else{ ?>

            <i class="sf-times"></i>
            <?php } //endif ?>
          </div>
        </div>

<?php }else{ ?>

        <i class="sf-times fc-yellow" title='<?php echo T_("Without hook"); ?>'></i>
<?php }//endif ?>
      </td>

      <td class="collapsing"><a href="<?php echo \dash\url::that(); ?>?step=<?php echo @$value['step']; ?>"><?php echo @$value['step']; ?></a></td>

      <td>
        <div class="ltr txtL txtB mB5">
          <a href="<?php echo \dash\url::that(); ?>?sendmethod=<?php echo @$value['sendmethod']; ?>" title='<?php echo T_("Method"); ?>'><?php echo @$value['sendmethod']; ?></a>
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo @$value['id']; ?>#sendkeyboard"><?php if(isset($value['sendkeyboard']) && $value['sendkeyboard']) {?><i class="sf-thumbnails fc-green" title='<?php echo T_("With keyboard"); ?>'></i><?php }else{ ?><i class="sf-file-text fc-mute" title='<?php echo T_("Without keyboard"); ?>'></i><?php } ?></a>
          <?php if(isset($value['sendmesageid']) && $value['sendmesageid']) {?>

          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo @$value['id']; ?>#sendmesageid" class="badge" title='<?php echo T_("Message id"); ?>'><?php echo @$value['sendmesageid']; ?></a>
        <?php } //endif ?>
        </div>
        <div class="mB10">
          <a href="<?php echo \dash\url::that(); ?>?sendtext=<?php echo @$value['sendtext']; ?>"><?php echo @$value['sendtext']; ?></a>
        </div>
        <div class="f fs09">
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo @$value['id']; ?>#send" class="cauto mRa5" title='<?php echo T_("Check more detail"); ?>'><i class="sf-save-1"></i></a>
          <a href="<?php echo \dash\url::that(); ?>?senddate=<?php echo @$value['senddate']; ?>" title='<?php echo @$value['senddate']; ?>' class="c txtB"><?php echo @$value['senddate']; ?></a>
        </div>
          <?php if(isset($value['response']) && $value['response']) {?>

        <div class="f fs09">
          <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo @$value['id']; ?>#response" class="cauto mRa5" title='<?php echo T_("Check more detail"); ?>'><i class="sf-save-1"></i></a>
          <a href="<?php echo \dash\url::that(); ?>?responsedate=<?php echo @$value['responsedate']; ?>" title='<?php echo @$value['responsedate']; ?>' class="c txtB"><?php echo @$value['responsedate']; ?></a>
        </div>

<?php }else{ ?>

        <i class="sf-chain-broken fc-red" title='<?php echo T_("Without response"); ?>'></i>
<?php } ?>
      </td>

      <td class="collapsing">

        <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo @$value['id']; ?>#meta"><?php if(isset($value['meta']) && $value['meta']) {?><i class="sf-folder-1 fc-green"></i><?php }else{ ?><i class="sf-folder fc-mute" title='<?php echo T_("Without meta"); ?>'></i><?php } ?></a>
      </td>

      <td class="collapsing">
        <a href="<?php echo \dash\url::this(); ?>/logshow?id=<?php echo @$value['id']; ?>" class="badge dark pA5" title='<?php echo T_("ID"); ?>'><?php echo @$value['id']; ?></a>
        <br>
        <a href="<?php echo \dash\url::that(); ?>?status=<?php echo @$value['status']; ?>"><?php echo @$value['status']; ?></a>
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




