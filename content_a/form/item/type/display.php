<?php
	$value = \dash\data::itemDetail();
?>
<div class="avand-md">
  <form method="post" autocomplete="off" id="form1" data-patch>
    <div class="box">
      <header><h2><?php echo T_("Edit item type") ?></h2></header>
      <div class="body">

        <?php $i =0; $first = true; foreach (\dash\data::itemType() as $type_key => $type_value) { $i++;?>
          <div class="msg minimal info2" data-kerkere='.showList<?php echo $i; ?>'><?php echo \dash\get::index($type_value, 'title'); ?></div>
          <div class="showList<?php echo $i; ?>" <?php if($first) { $first = false;}else{ ?> data-kerkere-content='hide2' <?php } //endif ?>>

            <div class="row">
              <?php if(isset($type_value['list']) && is_array($type_value['list'])) { foreach ($type_value['list'] as $k => $v) {?>

                <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
                  <div class="radio4">
                    <input  id="<?php echo $v['key'] ?>" type="radio" name="type" value="<?php echo $v['key'] ?>"   <?php if(\dash\get::index($value, 'type') === $v['key']) {echo 'checked';} ?>>
                    <label for="<?php echo $v['key'] ?>">
                      <div>
                        <div class="title"><?php echo $v['title']; ?></div>
                      </div>
                    </label>
                  </div>
                </div>
              <?php } /*endfor*/  } //endif?>
            </div>
          </div>
        <?php } //endfor ?>
      </div>
    </div>
  </form>
</div>