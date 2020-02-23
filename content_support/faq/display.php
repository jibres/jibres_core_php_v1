<?php
if(\dash\data::postTag() && is_array(\dash\data::postTag()))
{
?>


<div class="cbox">

  <?php
  if(\dash\data::categoryDetail())
  {
    echo '<h2>'. T_("Category").' <b>'. \dash\data::categoryDetail_title().'</b></h2>';
  }
  ?>



  <div>
    <?php foreach (\dash\data::postTag() as $key => $value)
    {
    ?>

    <div class="msg">
      <span class="sf-info mRa10"></span>
      <a href="<?php echo \dash\url::kingdom(); ?>/support/<?php echo \dash\get::index($value, 'url'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a>
      <a href="<?php echo \dash\url::kingdom(); ?>/support/<?php echo \dash\get::index($value, 'url'); ?>" class="floatRa"><?php echo \dash\get::index($value, 'type'); ?></a>
    </div>
    <?php }//endfor ?>
  </div>
</div>


<?php
} //endif
?>