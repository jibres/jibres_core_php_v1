<div class="f">
  <div class="c5 s12 pRa10">

    <div class="cbox">
      <form method="post" autocomplete="off">
        <h2><?php echo T_("Add new fund"); ?></h2>


        <label for="title"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="title"  minlength="1" value="<?php echo \dash\data::dataRow_title(); ?>" maxlength="100">
        </div>

        <label for="desc"><?php echo T_("Description"); ?></label>
        <div class="input">
          <input type="text" name="desc" id="desc"  minlength="1" value="<?php echo \dash\data::dataRow_desc(); ?>" maxlength="100">
        </div>

        <label for="pos"><?php echo T_("Pos"); ?></label>
        <div>
          <select name="pos[]"  class="select22" data-model="tag" multiple="multiple">
            <?php if(is_array(\dash\data::posDataTable())) { foreach (\dash\data::posDataTable() as $value) {?>
              <option value="<?php echo \dash\get::index($value, 'id'); ?>" <?php if(is_array(\dash\data::dataRow_pos()) && in_array(\dash\get::index($value, 'id'), \dash\data::dataRow_pos())){echo 'selected';} ?>><?php echo T_(ucfirst(\dash\get::index($value, 'slug'))); ?> <?php if(\dash\get::index($value, 'title')) { echo ' - '. \dash\get::index($value, 'title');} ?></option>
            <?php } } //endfor //endif  ?>
          </select>
        </div>


        <?php if(\dash\data::editMode()) {?>
          <button class="btn block primary mT10"><?php echo T_("Edit"); ?></button>
        <?php }else{ ?>
          <button class="btn block success mT10"><?php echo T_("Add fund"); ?></button>
        <?php } //endif ?>
      </form>
    </div>


  </div>

  <?php if(\dash\data::dataTable()) {?>

    <div class="c s12">


      <table class="tbl1 v1 txtC cbox fs12 ">
        <thead>
          <tr class="fs09">
            <th><?php echo T_("Name"); ?></th>
            <th><?php echo T_("Description"); ?></th>
            <th><?php echo T_("Pos"); ?></th>
          </tr>
        </thead>

        <tbody>
          <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr>
              <td><a class="link" href="<?php echo \dash\url::that(). '?id='. \dash\get::index($value, 'id'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a></td>
              <td><?php echo \dash\get::index($value, 'desc'); ?></td>
              <td>
              <?php
                if(\dash\get::Index($value, 'pos') && is_array(\dash\get::Index($value, 'pos')))
                {
                  $pos = \dash\data::posDataTable();
                  foreach (\dash\get::Index($value, 'pos') as $key => $value)
                  {
                    if(array_key_exists($value, $pos))
                    {
                      echo '<div class="btn mA5">'. T_(ucfirst(\dash\get::index($pos, $value, 'slug'))). (\dash\get::index($pos, $value, 'title') ? ' - '. \dash\get::index($pos, $value, 'title'): null).'</div>';
                    }
                  }
                } //endif
              ?>
              </td>
            </tr>

          <?php } //endfor ?>

        </tbody>
      </table>




    </div>
  <?php } //endif ?>
</div>
