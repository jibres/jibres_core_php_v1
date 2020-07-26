  <div class="f justify-center">
    <div class="c8 m9 s12">


      <section class="box domainQuickBuy">
        <h3><a href="<?php echo \dash\url::here() ?>/domain"><?php echo T_("Discover the perfect domain now"); ?></a></h3>
        <p><?php echo T_("Every website start with a great domain name"); ?></p>
        <form method="get" action='<?php echo \dash\url::current() ?>' autocomplete='off'>
          <div class="input">
            <input type="search" name="q" autocomplete="off" maxlength="65" value="<?php echo \dash\data::getDomain(); ?>" placeholder='<?php echo T_('Enter your idea for domain name') ?>' autofocus>
            <button class="addon btn warn"><?php echo T_("Search"); ?></button>
          </div>
        </form>
      </section>
        <?php if(\dash\data::InvalidDomain()) {?>
          <div class="msg warn fs14">
            <?php echo T_("Please enter a valid domain") ?>
          </div>
        <?php } //endif ?>
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
  if(\dash\data::domain_ir_stat())
  {
    echo '<ul class="items" data-ir-others>';
    foreach (\dash\data::domain_ir_stat() as $key => $value)
    {
      if(isset($value['tld']))
      {
        require('domain-search-result-ir-others.php');
      }
    }
    echo '</ul>';
  }
}
?>

<?php if(\dash\data::domainSuggestion()) {?>
  <ul class="items">
    <?php foreach (\dash\data::domainSuggestion() as $key => $value) {?>
     <li class="f">
      <a href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'domain'); ?>" class="f">
       <div class="key"><?php echo T_("Suggestion for you");?></div>
       <div class="value"><?php echo \dash\get::index($value, 'domain'); ?></div>
      </a>
     </li>
   <?php }//endfor ?>
  </ul>
<?php } // endif ?>


<?php if(\dash\data::domainSuggestion()) {?>
  <section class="f">
    <?php foreach (\dash\data::domainSuggestion() as $key => $value) {?>
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'domain'); ?>" class="stat x70">
       <h3><?php echo T_("Suggestion for you");?></h3>
       <div class="val"><?php echo \dash\get::index($value, 'domain'); ?></div>
      </a>
     </div>
   <?php }//endfor ?>
    </section>
<?php } // endif ?>

<?php if(\dash\data::domainSuggestion4()) {?>
  <section class="f">
    <?php foreach (\dash\data::domainSuggestion4() as $key => $value) {?>
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'domain'); ?>" class="stat x50">
       <h3><?php echo T_("Suggestion for you");?></h3>
       <div class="val"><?php echo \dash\get::index($value, 'domain'); ?></div>
      </a>
     </div>
   <?php }//endfor ?>
    </section>
<?php } // endif ?>