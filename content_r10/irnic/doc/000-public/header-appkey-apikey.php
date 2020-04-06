<?php $myClassRand = md5(rand()); ?>

<div class="mB20" data-kerkere='.<?php echo $myClassRand; ?>' data-kerkere-icon='close'><?php echo T_("Required parameters"); ?> <?php echo T_("on header"); ?> <code>appkey</code> <i><?php echo T_("And"); ?></i> <code>apikey</code>
</div>
<div class="<?php echo $myClassRand; ?>" data-kerkere-content='hide'>

  <div class="tblBox">
    <table class="tbl1 v3">
      <thead>
        <tr>
          <th><?php echo T_("Name"); ?> <small><?php echo T_("type"); ?></small></th>
          <th><?php echo T_("Description"); ?> <small><?php echo T_("example"); ?></small></th>
          <th><?php echo T_("Constraints"); ?></th>
        </tr>
      </thead>
      <tbody>
         <tr>
          <td>
            <div class="txtB">appkey</div>
            <i>string</i>
          </td>
          <td>
            <div><?php echo T_("APP key generated on the user panel"); ?></div>
            <code><?php echo \dash\data::myAppKey(); ?></code>
          </td>
          <td>
            <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
            <?php echo T_("length"); ?> <?php echo \dash\fit::number(32); ?>
          </td>
        </tr>
        <tr>
          <td>
            <div class="txtB">apikey</div>
            <i>string</i>
          </td>
          <td>
            <div><?php echo T_("Your apikey"); ?></div>
            <code><?php echo \dash\data::myApiKey(); ?></code>
          </td>
          <td>
            <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
            <?php echo T_("length"); ?> <?php echo \dash\fit::number(32); ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
