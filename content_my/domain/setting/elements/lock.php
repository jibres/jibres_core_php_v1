<section class="f" data-option='domain-lock'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Domain Transfer Lock");?></h3>
      <div class="body">
        <p><?php echo T_("In this section, you specify the default status of the comment");?></p><?php //echo lastModified('defaultcomment'); ?>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn secondary" href="<?php echo \dash\url::that(). '/transfer?domain='. \dash\request::get('domain') ?>"><?php echo T_("Manage Lock domain") ?></a>
      </div>
  </div>
</section>
