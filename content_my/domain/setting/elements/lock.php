

<section class="f" data-option='domain-lock'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Domain Transfer Lock");?></h3>
      <div class="body">
        <p><?php echo T_("In this section, you specify the default status of the comment");?></p><?php //echo lastModified('defaultcomment'); ?>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_defaultcomment" value="1">
      <div class="action">
        <div class="switch1">
          <input id="idefaultcomment" type="checkbox" name="defaultcomment" <?php if(\dash\data::cmsSettingSaved_defaultcomment() == 'open') { echo 'checked'; } ?>>
          <label for="idefaultcomment"></label>
        </div>
      </div>
  </form>
</section>
