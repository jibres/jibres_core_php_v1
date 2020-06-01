<div class="f">
  <div class="c5 s12 pRa10">

    <div class="cbox">
     <form method="post" autocomplete="off">
      <h2><?php echo T_("Add new fund"); ?></h2>


      <label for="title"><?php echo T_("Title"); ?></label>
      <div class="input">
        <input type="text" name="title" id="title"  minlength="1" maxlength="100">
      </div>

      <label for="desc"><?php echo T_("Description"); ?></label>
      <div class="input">
        <input type="text" name="desc" id="desc"  minlength="1" maxlength="100">
      </div>



      <button class="btn block primary mT10"><?php echo T_("Add fund"); ?></button>
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
        </tr>
      </thead>

      <tbody>
        <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
          <td><a class="link" href="<?php echo \dash\url::that(). '?id='. \dash\get::index($value, 'id'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a></td>
          <td><?php echo \dash\get::index($value, 'desc'); ?></td>
        </tr>

        <?php } //endfor ?>

      </tbody>
    </table>




  </div>
  <?php } //endif ?>
</div>
