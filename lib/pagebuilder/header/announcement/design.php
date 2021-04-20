<?php
$lineSetting = \dash\data::lineSetting();

$announcement = a($lineSetting, 'detail', 'announcement');

if(!\lib\pagebuilder\tools\tools::in('announcement')){ ?>

<section class="f" data-option='website-change-top-line'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Special Announcement");?></h3>
      <div class="body">
        <p><?php echo T_("You can show something on top of everything on your website. Special offer, some news or something else you want. This is a simple way to show something to everyone.") ?> </p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::that(). '/announcement'. \dash\request::full_get();?>"><?php echo T_("Set Special Announcement") ?></a>
    </div>
  </div>
</section>

<?php }else{ ?>

<div class="avand-sm">
  <form method="post" class="box" autocomplete="off">
    <input type="hidden" name="set_announcement" value="1">
    <div class="body">
        <div class="switch1 mB20">
          <input type="checkbox" name="status" id="status" <?php if(a($announcement, 'status')) {echo 'checked';} ?>>
          <label for="status"></label>
          <label for="status"><?php echo T_("Header Special Announcement"); ?><small></small></label>
        </div>
        <div data-response='status' <?php if(!a($announcement, 'status')) {echo 'data-response-hide';} ?>>
          <label for="text"><?php echo T_("Announcement Text"); ?></label>
          <div class="input">
            <input type="text" name="text" id="text" value="<?php echo a($announcement, 'text') ?>" maxlength="100" required>
          </div>
          <label for="url"><?php echo T_("Url"); ?></label>
          <div class="input ltr">
            <input type="text" name="url" id="url" value="<?php echo a($announcement, 'url') ?>"  >
          </div>
          <div class="switch1 mB5">
            <input type="checkbox" name="target" id="target" <?php if(a($announcement, 'target')) {echo 'checked';} ?>>
            <label for="target"></label>
            <label for="target"><?php echo T_("Open link in new tab"); ?><small></small></label>
          </div>
        </div>
    </div>
    <footer class="txtRa">
      <button class="btn primary"><?php echo T_("Save"); ?></button>
    </footer>
  </form>
</div>
<?php } ?>