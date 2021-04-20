<?php
$lineSetting = \dash\data::lineSetting();

if(!\lib\pagebuilder\tools\tools::in('text'))
{
?>

<section class="f" data-option='website-footer-main-txt'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Footer text");?></h3>
      <div class="body">
        <p><?php  echo T_("Main Text for footer"); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action">
      <a  href="<?php echo \dash\url::that(). '/text'. \dash\request::full_get();?>" class="btn primary"><?php echo T_("Customize footer text") ?></a>
    </div>
  </form>
</section>

<?php }else{ ?>

<div class="avand-lg">
  <form method="post" class="box" autocomplete="off" id="form1">
    <div class="body">
      <textarea class="txt" data-editor rows="10" name="html" placeholder="<?php echo T_("Type here...") ?>" id="text"><?php echo \dash\data::lineSetting_text(); ?></textarea>
    </div>
  </form>
</div>
<?php } //endif ?>