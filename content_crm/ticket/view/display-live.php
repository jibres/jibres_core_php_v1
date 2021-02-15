<?php
$live =
[
  'module'     => 'ticket',
  'id'         => \dash\request::get('id'),
  'lastid'     => a(\dash\data::conversation(), 0, 'livelastid'),
  'urlcurrent' => \dash\url::current(),
];

$liveMode = urlencode(json_encode($live));

?>
<div class='hide' data-smile-live='<?php echo $liveMode; ?>'></div>
<?php

$customer_mode = \dash\temp::get('customer_mode');

foreach (\dash\data::conversation() as $key => $value)
{
  $userText = false;
  if(\dash\data::dataRow_user_id() == a($value, 'user_id'))
  {
    $userText = true;
  }
  if(a($value, 'type') === 'answer')
  {
    $userText = false;
  }
  // show user text on another side
  $otherSide = $userText;

  if($customer_mode)
  {
    if($userText)
    {
      $otherSide = false;
    }
    else
    {
      $otherSide = true;
    }
  }

?>
 <div class="messageLine row align-start<?php if($otherSide) {echo " f-row-reverse";}?>"<?php if(a($value, 'dbluser')) { echo " data-line-multi"; } else {echo " data-line-1";} ?>>
  <div class="c-xs-12 c-auto">
    <?php if(a($value, 'dbluser')) {?>
      <div class="profileAvatar"></div>
    <?php }else{ ?>
    <img class="profileAvatar" src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="<?php if($userText && $customer_mode) { echo T_("You"); }else{ echo  a($value, 'displayname');} ?>">
  <?php } //endif ?>
  </div>
  <div class="c-xs-12 c<?php if($otherSide) {echo " txtRa";} ?>">
    <div class="messageBox"<?php if(a($value, 'type') === 'note') {echo' data-note';} if($userText){ echo ' data-user'; } else {echo ' data-admin data-color=blue';} ?>>
      <div class="message"><?php echo nl2br(a($value, 'content')); ?></div>
<?php if(a($value, 'branch')) {?>
        <div class="msg minimal info2"><?php echo T_("This message answered in new ticket") ?><a class="btn link" href="<?php echo \dash\url::this(). '/view?id='. $value['branch'] ?>"><?php echo T_("See ticket") ?></a></div>
<?php } //endif ?>

      <footer class="row<?php if($otherSide) {echo " f-row-reverse";} ?>">
        <div class="c-auto">
          <?php if(!$userText && !$customer_mode) {?>
          <i class="sf-check<?php if(a($value, 'see')) {echo ' seen';} ?>" title="<?php echo T_("Seen") ?>"></i>
        <?php } //endif ?>
        </div>
<?php
       if(a($value, 'type') === 'note')
       {
        echo '<div class="c-auto fc-mute">'. T_("Note"). '</div>';
       }
?>
        <div class="c"></div>
<?php if(!$customer_mode) {?>
        <div class="c-auto"><a href="<?php echo \dash\url::this(). '/edit?id='. a($value, 'id') ?>"><?php echo T_("Edit") ?></a></div>
<?php } //endif ?>
<?php if(!$customer_mode) {?>
<?php if($userText && $key > 0 && !a($value, 'branch') && a($value, 'type') != 'note') {?>
        <div class="c-auto">
          <div data-title="<?php echo T_("Add this message in new ticket and answer to it?") ?>" data-confirm data-data='{"newbranch":"1", "branch": "<?php echo a($value, 'id') ?>"}'><?php echo T_("Answer in new ticket"); ?></div>
        </div>
<?php }//endif ?>
<?php } //endif ?>
        <div class="c-auto os ltr">
          <time datetime="<?php echo a($value, 'datecreated'); ?>"><?php echo \dash\fit::date(a($value, 'datecreated')); ?></time>
          <time datetime="<?php echo a($value, 'datecreated'); ?>"><?php echo \dash\fit::time(a($value, 'datecreated')); ?></time>
        </div>
      </footer>
    </div>
<?php if(a($value, 'file')) {?>
  <div>
<?php if(a($value, 'filedetail', 'type') === 'image') {?>
    <a class="attachment" target="_blank" href="<?php echo a($value, 'file') ?>" data-fancybox="ticketAttachment">
      <img src="<?php echo \dash\fit::img(a($value, 'file'), 460); ?>" alt="attachment">
    </a>
<?php } else { ?>
    <a class="attachment btn dark" target="_blank" href="<?php echo a($value, 'file') ?>"><i class="sf-attach mRa10"></i> <?php echo T_("Show Attachment") ?></a>
<?php }//endif ?>
  </div>
<?php }//endif ?>

  </div>
 </div>
<?php } ?>