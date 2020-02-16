
<div class="msg pain special f align-center fs14">

  <div class="c"><span class="txtB"><?php if(\dash\url::module() === 'ticket') { echo \dash\data::page_title(); }else { echo T_("Last active tickets"); }?></span>
    <span class="badge rounded pA5-f mLa5">
      <?php
        $sidebarDetail = \dash\data::sidebarDetail();
        if(\dash\request::get('status'))
        {
          if(isset($sidebarDetail[\dash\request::get('status')]))
          {
            echo \dash\fit::number($sidebarDetail[\dash\request::get('status')]);
          }
        }
        else
        {
          echo \dash\fit::number(\dash\data::sidebarDetail_all());
        }
      ?></span></div>
  <div class="cauto os"><a href="<?php echo \dash\url::this();  echo \dash\data::accessGet(); ?>" class="btn dark sm"><?php echo T_("All Tickets"); ?></a></div>
</div>

<table class="tbl1 v1 cbox fs12" data-scroll>
  <tbody>
<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

foreach ($dataTable as $key => $value)
{
?>

    <tr class="<?php echo @$value['rowColor']; ?>">
      <td class="collapsing txtB">
        <?php if(isset($value['parent'])) {?>

        <a href="<?php echo \dash\url::this(); ?>/show?id=<?php echo @$value['parent'];  echo \dash\data::accessGetAnd(); ?>#<?php echo @$value['id'];  if(!\dash\user::id()) {?>&guest=<?php echo @$value['code'];  } //endif ?>"><span class="badge light mRa5"><?php echo \dash\fit::number(@$value['parent']); ?></span> </a>

        <?php }else{ ?>

        <a href="<?php echo \dash\url::this(); ?>/show?id=<?php echo @$value['id'];  echo \dash\data::accessGetAnd(); if(!\dash\user::id()) { echo '&guest='. @$value['id'];} ?>"><span class="badge light mRa5"><?php echo \dash\fit::number(@$value['id']); ?></span> <?php echo substr(@$value['title'], 0, 40); ?></a>
        <?php } // endif ?>

        <?php if(isset($value['tag']) && $value['tag'] && is_array($value['tag'])) {?>

        <div class="mT5 fs12">

          <?php foreach ($value['tag'] as $Tkey => $Tvalue) {?>

            <a class="badge" href="<?php echo \dash\url::this(); ?>?tag=<?php echo urlencode($Tvalue); ?>"><?php echo $Tvalue; ?></a>

          <?php } // endfor ?>

        </div>

      <?php } //endif ?>

      </td>

      <td class="s0 m0 pRa10"><a href="<?php echo \dash\url::this(); ?>/show?id=<?php echo @$value['id']; echo \dash\data::accessGetAnd(); ?><?php if(!\dash\user::id()) { echo '&guest='. @$value['code']; } ?>"><?php echo substr(strip_tags(@$value['content']), 0, 60); ?></a>
      </td>

      <?php if(\dash\data::haveSubdomain()) {?>

    <td class="collapsing fs08 s0 ltr">
      <?php if(isset($value['subdomain']) && $value['subdomain']) {?>

      <a href="<?php echo \dash\url::this(); ?>?access=all&subdomain=<?php echo $value['subdomain']; ?>"><?php echo ucfirst($value['subdomain']); ?></a>

      <?php } //endif ?>
    </td>
  <?php } //endif ?>

      <td class="collapsing s0"><?php if(isset($value['solved']) && $value['solved']) {?><div class="badge success"><?php echo T_("Solved"); ?> <i class="compact sf-check"></i></div><?php }//endif ?></td>

      <td class="collapsing s0"><?php if(isset($value['plus']) && $value['plus']) { echo \dash\fit::number($value['plus']); ?> <i class="compact sf-chat-alt-fill"></i><?php } //endif ?></td>

      <td class="collapsing fs08"><span title='<?php echo T_("Created on"). ' '. \dash\fit::date(@$value['datecreated']); ?> <?php if(isset($value['datemodified']) && $value['datemodified']) {?><br><?php echo T_("Last modified on"); ?> <?php echo \dash\fit::date($value['datemodified']); }//endif?>'><?php if(isset($value['datemodified']) && $value['datemodified']) { echo \dash\fit::date_human($value['datemodified']); } else { echo \dash\fit::date_human(@$value['datecreated']); }?></span></td>

      <td class="collapsing fs08 s0 m0"><?php if(isset($value['status']) && $value['status'] != 'awaiting') {?><i class="compact mRa5 sf-spin-alt fc-green"></i><?php }else{ ?><i class="compact mRa5 sf-asterisk spiny fc-red"></i><?php }  echo T_(ucfirst(@$value['status']));  ?></td>

      <?php if(\dash\data::accessMode() !== 'mine') {?>

      <td class="collapsing fs08 txtRa s0">
        <a href="<?php echo \dash\url::this(); ?>?user=<?php echo @$value['user_id']; ?><?php echo \dash\data::accessGetAnd(); ?>">
        <span class="txtB s0"><?php echo @$value['displayname']; ?></span>
        <img src="<?php echo @$value['avatar']; ?>" class="avatar mLa10" alt="<?php echo @$value['displayname']; if(isset($value['displayname']) && $value['displayname']) {?>"  title="<?php echo $value['displayname']; ?>" <?php } //endif ?>>
        </a>
      </td>

    <?php }//endif ?>

    <td class="collapsing fs08 s0" title2='<?php echo T_("Active in this ticket"); ?>'>
      <?php if(isset($value['user_in_ticket_detail']) && is_array($value['user_in_ticket_detail'])) {?>
        <?php  foreach ($value['user_in_ticket_detail'] as $myvalue)  {?>
          <img src="<?php echo @$myvalue['avatar']; ?>" class="avatar mRa5" alt="<?php echo @$myvalue['displayname']; ?>" <?php if(isset($myvalue['displayname']) && $value['displayname']) {?> title="<?php echo $myvalue['displayname']; ?>" <?php } //endif ?>>
        <?php } //endfor ?>
      <?php } //endif ?>
      </td>
    </tr>

<?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>

