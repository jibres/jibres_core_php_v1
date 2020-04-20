  <div class="f justify-center">
    <div class="c8 m9 s12">


      <section class="box domainQuickBuy">
        <h3><a href="<?php echo \dash\url::here() ?>/domain"><?php echo T_("Discover the perfect domain now"); ?></a></h3>
        <p><?php echo "Every website start with a great domain name"; ?></p>
        <form method="get" action='<?php echo \dash\url::current() ?>' autocomplete='off'>
          <div class="input ltr">
            <input type="search" name="q" autocomplete="off" maxlength="65" value="<?php echo \dash\data::getDomain(); ?>" placeholder='<?php echo T_('Enter your idea for domain name') ?>' autofocus>
            <button class="addon btn warn"><?php echo T_("Search"); ?></button>
          </div>
        </form>
      </section>
    </div>
  </div>

<?php
if(\dash\data::getDomain())
{
  if(\dash\data::domain_ir())
  {
    foreach (\dash\data::domain_ir() as $key => $value)
    {
      if(isset($value['tld']) && $value['tld'] === 'ir')
      {
        require('domain-search-result-ir.php');
      }
    }
  }
  if(\dash\data::domain_ir_other())
  {
    echo '<div class="f result ltr" data-ir-others>';
    foreach (\dash\data::domain_ir_other() as $key => $value)
    {
      if(isset($value['tld']))
      {
        if($value['tld'] === 'ایران')
        {
          // do not show
        }
        elseif(strpos($value['tld'], '.ir'))
        {
          require('domain-search-result-ir-others.php');
          // show in stat
        }
      }
    }
    echo '</div">';
  }
}
?>
<?php if(\dash\data::domainSuggestion()) {?>
  <section class="f">
    <?php foreach (\dash\data::domainSuggestion() as $key => $value) {?>
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'domain'); ?>" class="stat">
       <h3><?php echo T_("Suggestion for you");?></h3>
       <div class="val"><?php echo \dash\get::index($value, 'domain'); ?></div>
      </a>
     </div>
   <?php }//endfor ?>
    </section>
<?php } // endif ?>