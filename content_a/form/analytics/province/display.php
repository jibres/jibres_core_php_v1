<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>
<div class="avand-md">


  <form method="post" >
      <input type="hidden" name="addtagtoall" value="addtagtoall">
      <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Result count group by province");?></h2></header>
      <div class="body">
        <?php foreach (\dash\data::provinceResult() as $key => $value) {?>
            <div class="msg">
              <div class="f">
                <div class="cauto"><?php echo \dash\get::index($value, 'name') ?></div>
                <div class="c"></div>
                <div class="cauto"><?php echo \dash\fit::number(\dash\get::index($value, 'count')) ?></div>
                <div class="c2"></div>
                <div class="cauto"> <a class="btn link" href="<?php echo \dash\url::that(). '/table'. \dash\request::full_get(['province' => $key]) ?>"><?php echo T_("List") ?></a></div>
                <div class="cauto"> <a class="btn link" href="<?php echo \dash\url::that(). '/setting'.\dash\request::full_get(['province' => $key, 'export' => 'export']) ?>"><?php echo T_("Export") ?></a></div>
              </div>
            </div>

        <?php } //endfor ?>

      </div>
  </div>
    </form>


</div>