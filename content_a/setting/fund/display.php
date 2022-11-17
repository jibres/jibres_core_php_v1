<div class="f">
  <div class="c5 s12 pRa10">

    <div class="box">
      <form method="post" autocomplete="off" class="pad">
        <?php if(\dash\data::editMode()) {?>
          <h2><?php echo T_("Edit fund"); ?></h2>
        <?php }else{ ?>
          <h2><?php echo T_("Add new fund"); ?></h2>
        <?php } //endif ?>


        <label for="title"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="title"  minlength="1" value="<?php echo \dash\data::dataRow_title(); ?>" maxlength="100">
        </div>

        <label for="desc"><?php echo T_("Description"); ?></label>
        <div class="input">
          <input type="text" name="desc" id="desc"  minlength="1" value="<?php echo \dash\data::dataRow_desc(); ?>" maxlength="100">
        </div>

        <label for="pos"><?php echo T_("Pos"); ?></label>
        <?php if(\dash\data::posDataTable() && is_array(\dash\data::posDataTable())) {?>
        <div>
          <select name="pos[]"  class="select22" data-model="tag" multiple="multiple">
            <?php foreach (\dash\data::posDataTable() as $value) {?>
              <option value="<?php echo a($value, 'id'); ?>" <?php if(is_array(\dash\data::dataRow_pos()) && in_array(a($value, 'id'), \dash\data::dataRow_pos())){echo 'selected';} ?>><?php echo T_(ucfirst(a($value, 'slug'))); ?> <?php if(a($value, 'title')) { echo ' - '. a($value, 'title');} ?></option>
            <?php } //endfor //endif  ?>
          </select>
        </div>
      <?php }else{ ?>
        <div class="alert-warning"><a href="<?php echo \dash\url::this(). '/pcpos'; ?>" class="link-primary"><?php echo T_("Add new pos") ?></a></div>
      <?php } //endif ?>


        <?php if(\dash\data::editMode()) {?>
          <div class="f">
            <div class="c"><button class="btn block primary mt-2"><?php echo T_("Edit"); ?></button></div>
            <div class="cauto mLa5"><div data-confirm data-data='{"remove": "remove"}' class="btn-danger mt-2"><?php echo T_("Remove"); ?></div></div>
          </div>

        <?php }else{ ?>
          <button class="btn block success mt-2"><?php echo T_("Add fund"); ?></button>
        <?php } //endif ?>
      </form>
    </div>


  </div>

  <?php if(\dash\data::dataTable()) {?>

    <div class="c s12">


      <table class="tbl1 v1 text-center cbox fs12 ">
        <thead>
          <tr class="text-sm">
            <th><?php echo T_("Name"); ?></th>
            <th><?php echo T_("Description"); ?></th>
            <th><?php echo T_("Pos"); ?></th>
          </tr>
        </thead>

        <tbody>
          <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr>
              <td><a class="link-primary" href="<?php echo \dash\url::that(). '?id='. a($value, 'id'); ?>"><?php echo a($value, 'title'); ?></a></td>
              <td><?php echo a($value, 'desc'); ?></td>
              <td>
              <?php
                if(a($value, 'pos') && is_array(a($value, 'pos')))
                {
                  $pos = \dash\data::posDataTable();
                  foreach (a($value, 'pos') as $key => $value)
                  {
                    if(array_key_exists($value, $pos))
                    {
                      echo '<div class="btn mA5">'. T_(ucfirst(a($pos, $value, 'slug'))). (a($pos, $value, 'title') ? ' - '. a($pos, $value, 'title'): null).'</div>';
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
