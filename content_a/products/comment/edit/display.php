
<form class="f" method='post' autocomplete="off">
  <div class="c8 s12 pRa10">
    <div class="cbox">
      <textarea class="txt" rows="10" name="content"><?php echo \dash\data::dataRow_content(); ?></textarea>
    </div>
    <div class="cbox">
      <div class="input">
        <label for="author"><?php echo T_("Author"); ?></label>
        <input type="text" name="author" value="<?php echo \dash\data::dataRow_author(); ?>">
      </div>
      <div class="input">
        <label for="mobile"><?php echo T_("Mobile"); ?></label>
        <input type="tel" name="mobile" value="<?php echo \dash\data::dataRow_mobile(); ?>">
      </div>
      <div class="input">
        <label for="email"><?php echo T_("Email"); ?></label>
        <input type="text" name="email" value="<?php echo \dash\data::dataRow_email(); ?>">
      </div>
      <div class="input">
        <label for="website"><?php echo T_("Website"); ?></label>
        <input type="text" name="website" value="<?php echo \dash\data::dataRow_url(); ?>">
      </div>
    </div>
  </div>
  <div class="c4 s12">

    <div class="cbox">

     <div class="msg"><?php echo T_("Submitted on"); ?> <b><?php echo \dash\fit::date_human(\dash\data::dataRow_datecreated()); ?></b></div>
     <div class="msg"><?php echo T_("Updated on"); ?> <b><?php echo \dash\fit::date_human(\dash\data::dataRow_datemodified()); ?></b></div>
     <div class="msg">
      <?php echo T_("Current status"); ?> <b> <?php echo T_(ucfirst(\dash\data::dataRow_status())); ?> </b>
     </div>
     <?php if(\dash\data::dataRow_post_id()) {?>

     <div class="msg"><a href="<?php echo \dash\url::kingdom(); ?>/n/<?php echo \dash\data::dataRow_post_id() ?>"><?php echo \dash\data::dataRowPost_title(); ?></a></div>
     <?php } //endif ?>

     <div>
       <label><?php echo T_("Status"); ?></label>
       <div class="radio1 green">
        <input type="radio" id="r-approved" name="status" value="approved" <?php if(\dash\data::dataRow_status() === 'approved') { echo 'checked'; } ?>>
        <label for="r-approved"><?php echo T_("Approve"); ?></label>
       </div>
       <div class="radio1">
        <input type="radio" id="r-awaiting" name="status" value="awaiting" <?php if(\dash\data::dataRow_status() === 'awaiting') { echo 'checked'; } ?>>
        <label for="r-awaiting"><?php echo T_("Awaiting"); ?></label>
       </div>
       <div class="radio1">
        <input type="radio" id="r-unapproved" name="status" value="unapproved" <?php if(\dash\data::dataRow_status() === 'unapproved') { echo 'checked'; } ?>>
        <label for="r-unapproved"><?php echo T_("Unapprove"); ?></label>
       </div>
       <div class="radio1 red">
        <input type="radio" id="r-trash" name="status" value="deleted" <?php if(\dash\data::dataRow_status() === 'deleted') { echo 'checked'; } ?>>
        <label for="r-trash"><?php echo T_("Trash"); ?></label>
       </div>
       <div class="radio1 red">
        <input type="radio" id="r-spam" name="status" value="spam" <?php if(\dash\data::dataRow_status() === 'spam') { echo 'checked'; } ?>>
        <label for="r-spam"><?php echo T_("Spam"); ?></label>
       </div>
     </div>

     <button class="btn block primary mT25"><?php echo T_("Update"); ?></button>
    </div>


  </div>
</form>

