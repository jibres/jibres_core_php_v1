<?php if(\dash\data::listCats() || \dash\data::randomFAQ() || \dash\data::randomArticles()) {?>

<div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' >
    <div class="input">
      <?php
      // foreach (\dash\request::get() as $key => $value)
      // {
      //   echo "<input type='hidden' name='$key' value='$value'>";
      // }
      // @TODO check @reza
      ?>

      <input type="search" name="q" placeholder='<?php echo T_("Search our knowledge base..."); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autocomplete='off'>
      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>
<?php }//endif ?>


<?php if(\dash\data::dataTable()) {?>

<div class="cbox fs12">
  <h2><?php echo T_("Search result"); ?></h2>
  <div>
    <?php foreach (\dash\data::dataTable() as $key => $value)
    {
    ?>

    <div class="msg">
      <span class="sf-info mRa10"></span>
      <a href="<?php echo \dash\url::this(). '/'. \dash\get::index($value, 'slug'); ?>"><?php echo \dash\get::index($value, 'title'); ?> <small><?php echo \dash\get::index($value, 'excerpt'); ?></small></a>
      <?php if(isset($value['parent_detail']['title'])) {?>
      <a href="<?php echo \dash\url::here(). '/'. \dash\get::index($value, 'url'); ?>" class="floatRa"><?php echo $value['parent_detail']['title'] ?></a>
      <?php } //endif ?>
    </div>
    <?php }//endfor ?>
  </div>

</div>
<?php }elseif(\dash\request::get('q')) {?>
<div class="cbox">
  <div class="mgs txtB txtC"><?php echo T_("No result found!"); ?></div>
</div>
<?php }//endif ?>


<?php if(\dash\data::listCats()) {?>

  <div class="cbox">
      <div class="f">
        <?php foreach (\dash\data::listCats() as $key => $value)
        {
        ?>

        <div class="c4 m6 s12 pA10">
          <span class="<?php if(isset($value['meta']['icon'])) { echo 'sf-'. $value['meta']['icon']; }else{ echo 'sf-info'; }?> fs20 mRa10 mT10 floatLa"></span>
          <h2 class="simple"><a href="<?php echo \dash\url::this(). '/'. \dash\get::index($value, 'slug'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a></h2>
          <p><?php echo \dash\get::index($value, 'excerpt'); ?></p>
        </div>

        <?php }//endfor ?>
      </div>
  </div>
<?php }//endif ?>


  <div class="f">
    <?php if(\dash\data::randomFAQ()) {?>

      <div class="<?php if(!\dash\data::randomArticles()) { echo 'c12'; }else{ echo 'c6'; }?> s12 pRa10">

        <div class="cbox fs12">
          <h2><?php echo T_("Frequently Asked Questions"); ?></h2>
          <div>
            <?php foreach (\dash\data::randomFAQ() as $key => $value)
            {
            ?>

            <div class="msg">
              <span class="<?php if(isset($value['meta']['icon'])) { echo 'sf-'. $value['meta']['icon']; }else{ echo 'sf-info'; }?> mRa10"></span>
              <a href="<?php echo \dash\url::this(). '/'. \dash\get::index($value, 'slug'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a>
              <a href="#" class="floatRa"><?php echo \dash\get::index($value, 'cat'); ?></a>
            </div>

            <?php } //endfor ?>
          </div>
        </div>

      </div>
    <?php }//endif ?>

    <?php if(\dash\data::randomArticles()) {?>

      <div class="<?php if(!\dash\data::randomFAQ()) { echo 'c12'; }else{ echo 'c6'; }?> s12">

        <div class="cbox fs12">
          <h2><?php echo T_("Random Articles"); ?></h2>
          <div>
            <?php foreach (\dash\data::randomArticles() as $key => $value)
            {

            ?>

            <div class="msg">
              <span class="<?php if(isset($value['meta']['icon'])) { echo 'sf-'. $value['meta']['icon']; }else{ echo 'sf-info'; }?> mRa10"></span>
              <a href="<?php echo \dash\url::this(). '/'. \dash\get::index($value, 'slug'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a>
              <?php if(isset($value['parent_detail']['title'])) {?>
              <a href="<?php echo \dash\url::here(). '/'. \dash\get::index($value, 'url'); ?>" class="floatRa"><?php echo $value['parent_detail']['title'] ?></a>
            <?php } //endif ?>
            </div>
            <?php } //endfor ?>
          </div>

        </div>

      </div>
    <?php }//endif ?>
  </div>

<div class="msg txtC info2 pTB50 fs20">
  <h3 class="txtB"><?php echo T_("Can't find what you're looking for?"); ?></h3>
  <div class="mT10"><a class="btn primary hauto" href="<?php echo \dash\url::this(); ?>/ticket"><?php echo T_("Contact the legendary support team right now."); ?></a></div>
</div>

