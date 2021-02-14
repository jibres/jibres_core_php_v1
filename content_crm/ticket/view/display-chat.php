<section class="chat" data-xhr='ticket-chat'>
<?php
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
 <div class="messageLine row align-start<?php if($otherSide) {echo " f-row-reverse";} ?>">
  <div class="c-auto">
    <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="<?php if($userText && $customer_mode) { echo T_("You"); }else{ echo  a($value, 'displayname');} ?>">
  </div>
  <div class="c<?php if($otherSide) {echo " txtRa";} ?>">
    <div class="messageBox">
      <div class="message"><?php echo nl2br(a($value, 'content')); ?></div>
      <footer class="row<?php if($otherSide) {echo " f-row-reverse";} ?>"">
        <div class="c-auto">
          <i class="sf-check<?php if(a($value, 'see')) {echo ' seen';} ?>" title="<?php echo T_("Seen") ?>"></i>
        </div>
        <div class="c"></div>
        <div class="c-auto os ltr">
          <time datetime="<?php echo a($value, 'datecreated'); ?>"><?php echo \dash\fit::date(a($value, 'datecreated')); ?></time>
          <time datetime="<?php echo a($value, 'datecreated'); ?>"><?php echo \dash\fit::time(a($value, 'datecreated')); ?></time>
        </div>
      </footer>
    </div>
  </div>
 </div>

<?php } ?>

</section>






<hr class="mT50">
<hr>
<hr>










<section class="chat" data-xhr='ticket-chat'>
<?php
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
  <div class="box">
    <div class="pad">
      <div class="row">
        <div class="c-auto">
          <div class="txtB">
            <img class="avatar" src="<?php echo a($value, 'avatar') ?>">
            <?php if($userText && $customer_mode) { echo T_("You"); }else{ echo  a($value, 'displayname');} ?>
          </div>
        </div>
        <div class="c"></div>
        <div class="c-auto">
          <?php if(a($value, 'see') && !$customer_mode) { ?><span class="sf-eye fc-green" title="<?php echo T_("Seen by customer") ?>"></span><?php }//endif ?>
        </div>
        <div class="cauto">
          <div class="fc-mute"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        </div>
      </div>



      <?php
        echo '<div class="mTB10 ';
       if($userText)
       {
        echo 'fc-fb ';
       }
       if(a($value, 'type') === 'note')
       {
        echo 'msg minimal ';
       }
       echo '">';
       if(a($value, 'type') === 'note')
       {
        echo '<div class="txtB fc-mute">'. T_("Note"). '</div>';
       }
       echo nl2br(a($value, 'content'));
       echo '</div>';
      ?>
      <?php if(a($value, 'file')) {?> <a target="_blank" href="<?php echo a($value, 'file') ?>" class="btn link"><i class="sf-attach"></i> <?php echo T_("Show Attachment") ?></a><?php }//endif ?>
      <?php if(a($value, 'branch')) {?>
        <div class="msg minimal info2"><?php echo T_("This message answered in new ticket") ?><a class="btn link" href="<?php echo \dash\url::this(). '/view?id='. $value['branch'] ?>"><?php echo T_("See ticket") ?></a></div>
      <?php } //endif ?>
    </div>
    <?php if(!$customer_mode) {?>
    <footer class="f">
      <?php if($userText && $key > 0 && !a($value, 'branch') && a($value, 'type') != 'note') {?>
        <div class="cauto mLR10">
          <div class="link sm fc-fb" data-title="<?php echo T_("Add this message in new ticket and answer to it?") ?>" data-confirm data-data='{"newbranch":"1", "branch": "<?php echo a($value, 'id') ?>"}'><?php echo T_("Answer in new ticket"); ?>
          </div>
        </div>
      <?php }//endif ?>
      <div class="c"></div>
      <div class="cauto"><a href="<?php echo \dash\url::this(). '/edit?id='. a($value, 'id') ?>" class="link sm"><?php echo T_("Edit") ?></a></div>
    </footer>
  <?php } //endif ?>
  </div>

<?php } ?>

</section>




