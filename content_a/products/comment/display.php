
<?php
pageSteps();

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
  <form method="get" action='<?php echo \dash\url::that(); ?>' >
    <div class="input">
      <input type="hidden" name="id" value="<?php echo \dash\request::get('id'); ?>">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

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
  <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr>
        <th data-sort="<?php echo \dash\get::index($sortLink, 'author', 'order') ; ?>"><a href="<?php echo \dash\get::index($sortLink, 'author', 'link') ; ?>"><?php echo T_("Author"); ?></a></th>
        <th data-sort="<?php echo \dash\get::index($sortLink, 'content', 'order') ; ?>"><a href="<?php echo \dash\get::index($sortLink, 'content', 'link') ; ?>"><?php echo T_("Comment"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'status', 'order') ; ?>"><a href="<?php echo \dash\get::index($sortLink, 'status', 'link') ; ?>"><?php echo T_("Status"); ?></a></th>
        <th class="m0 s0" data-sort="<?php echo \dash\get::index($sortLink, 'datecreated', 'order') ; ?>"><a href="<?php echo \dash\get::index($sortLink, 'datecreated', 'link') ; ?>"><?php echo T_("Date"); ?></a></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

<?php
  $statusClass = '';
  if(isset($value['status']))
  {
    switch ($value['status'])
    {
      case 'deleted' : $statusClass    = 'negative'; break;
      case 'awaiting' : $statusClass   = 'active'; break;
      case 'unapproved' : $statusClass = 'warning'; break;
    }
  }
?>



      <tr class="<?php echo $statusClass; ?> <?php echo \dash\get::index($value, 'status'); ?>">
        <td class="collapsing sauto">
          <?php if(isset($value['avatar']) && $value['avatar']) {?>
            <img src="<?php echo $value['avatar']; ?>" class="avatar">
          <?php } //endif ?>


          <?php if(isset($value['user_id']) && $value['user_id']) {?>

          <a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo $value['user_id']; ?>">
            <span class="sf-user fc-mute"></span>
            <?php if(isset($value['displayname']) && $value['displayname']) { echo $value['displayname']; } else {?><small class='fc-mute'><?php echo T_("Without name"); ?></small><?php } //endif ?>
          </a>

          <?php }else{ ?>


            <span class="sf-chain-broken fc-mute"></span>
            <?php if(isset($value['displayname']) && $value['displayname']) { echo $value['displayname']; } else {?><small class='fc-mute'><?php echo T_("Without name"); ?></small><?php } //endif ?>

          <?php } //endif ?>

        </td>

        <td>

          <?php if(isset($value['post_title']) && $value['post_title']) {?>

          <div class="badge light"><a href="<?php echo \dash\url::kingdom(); ?>/n/<?php echo \dash\get::index($value, 'post_id'); ?>"><?php echo $value['post_title']; ?></a></div>

          <?php } //endfi ?>

          <p><?php echo \dash\get::index($value, 'content'); ?></p>

          <div class="rowAction floatRa">
            <a class="mRa5 fc-green" href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"id":"<?php echo \dash\get::index($value, 'id'); ?>", "status":"approved"}'><?php echo T_("Approve"); ?></a>
            <a class="mRa5 fc-blue" href="<?php echo \dash\url::that(); ?>/answer?id=<?php echo \dash\request::get('id'); ?>&cid=<?php echo \dash\get::index($value, 'id'); ?>"><?php echo T_("Answer"); ?></a>
            <a class="mRa5 fc-mute" href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo \dash\request::get('id'); ?>&cid=<?php echo \dash\get::index($value, 'id'); ?>"><?php echo T_("Edit"); ?></a>
            <a class="mRa5 fc-black" href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"id":"<?php echo \dash\get::index($value, 'id'); ?>", "status":"unapproved"}'><?php echo T_("Unapprove"); ?></a>
            <a class="mRa5 fc-red" href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"id":"<?php echo \dash\get::index($value, 'id'); ?>", "status":"deleted"}'><?php echo T_("Trash"); ?></a>
            <a class="mRa5 fc-red" href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"id":"<?php echo \dash\get::index($value, 'id'); ?>", "status":"spam"}'><?php echo T_("Spam"); ?></a>
          </div>
        </td>
        <td class="collapsing s0" ><?php echo T_(ucfirst(\dash\get::index($value, 'status'))); ?></td>
        <td class="collapsing s0 m0" ><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>
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





<?php function pageSteps() {?>
  <div class="f">

    <div class="c">
    <a class="dcard <?php if(!\dash\request::get('status') ) { echo 'active';} ?>" href='<?php echo \dash\url::that(). '?id='. \dash\request::get('id'); ?>' data-shortkey="49ctrlshift" >
     <div class="statistic">
      <div class="value"><?php echo \dash\fit::number(\dash\data::commentCounter_all()); ?></div>
      <div class="label"><i class="sf-list"></i> <?php echo T_("All"); ?> </div>
     </div>
    </a>
   </div>

   <div class="c">
    <a class="dcard <?php if(\dash\request::get('status') === 'awaiting') { echo 'active';} ?>" href='<?php echo \dash\url::that(). '?id='. \dash\request::get('id'); ?>&status=awaiting' data-shortkey="49ctrlshift" >
     <div class="statistic blue">
      <div class="value"><?php echo \dash\fit::number(\dash\data::commentCounter_awaiting()); ?></div>
      <div class="label"><i class="sf-load-a"></i> <?php echo T_("Awaiting"); ?> </div>
     </div>
    </a>
   </div>

   <div class="c">
    <a class="dcard <?php if(\dash\request::get('status') === 'approved') { echo 'active';} ?>" href='<?php echo \dash\url::that(). '?id='. \dash\request::get('id'); ?>&status=approved' data-shortkey="50ctrlshift" >
     <div class="statistic green">
      <div class="value"><?php echo \dash\fit::number(\dash\data::commentCounter_approved()); ?></div>
      <div class="label"><i class="sf-check"></i> <?php echo T_("Approve"); ?></div>
     </div>
    </a>
   </div>

   <div class="c">
    <a class="dcard <?php if(\dash\request::get('status') === 'unapproved') { echo 'active';} ?>" href='<?php echo \dash\url::that(). '?id='. \dash\request::get('id'); ?>&status=unapproved' data-shortkey="51ctrlshift" >
     <div class="statistic">
      <div class="value"><?php echo \dash\fit::number(\dash\data::commentCounter_unapproved()); ?></div>
      <div class="label"><i class="sf-times"></i> <?php echo T_("Unapprove"); ?></div>
     </div>
    </a>
   </div>

    <div class="c">
    <a class="dcard <?php if(\dash\request::get('status') === 'deleted') { echo 'active';} ?>" href='<?php echo \dash\url::that(). '?id='. \dash\request::get('id'); ?>&status=deleted' data-shortkey="51ctrlshift" >
     <div class="statistic">
      <div class="value"><?php echo \dash\fit::number(\dash\data::commentCounter_deleted()); ?></div>
      <div class="label"><i class="sf-trash"></i> <?php echo T_("Deleted"); ?></div>
     </div>
    </a>
   </div>

    <div class="c">
    <a class="dcard <?php if(\dash\request::get('status') === 'spam') { echo 'active';} ?>" href='<?php echo \dash\url::that(). '?id='. \dash\request::get('id'); ?>&status=spam' data-shortkey="51ctrlshift" >
     <div class="statistic red">
      <div class="value"><?php echo \dash\fit::number(\dash\data::commentCounter_spam()); ?></div>
      <div class="label"><i class="sf-bug"></i> <?php echo T_("Spam"); ?></div>
     </div>
    </a>
   </div>



  </div>
<?php } //endif ?>


