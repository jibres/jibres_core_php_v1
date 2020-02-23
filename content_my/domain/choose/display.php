<div class="cbox">

  <form class="domainSearchBox" action='<?php echo \dash\url::current() ?>' method='get' autocomplete='off'>
   <h4 class="txtC"><?php echo T_('Discover the perfect domain now'); ?></h4>
  <div class="input ltr">
   <input type="text" name="q" id='domainFirstSearch' maxlength='63' value="<?php echo \dash\request::get('q'); ?>" autocomplete='off'>
   <button class="addon btn primary"><?php echo T_('Search'); ?></button>
  </div>
 </form>
<?php require_once (root. 'content/domains/search/domainSearchResult.php'); ?>
</div>

