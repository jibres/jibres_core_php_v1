
<form method="post" id="calcagain">
  <input type="hidden" name="calc" value="again">
</form>


<?php if(\dash\data::monthlyList()) {?>
  <div class="tblBox font-14">
    <table class="tbl1 v1">
      <thead>
        <tr>
          <th class="collapsing">#</th>
          <th class="collapsing"><?php echo T_("Year") ?></th>
          <th class=""><?php echo T_("Month") ?></th>
          <th><?php echo T_("Count business") ?></th>
          <th><?php echo T_("Count products") ?></th>
          <th><?php echo T_("Count Factors") ?></th>
          <th><?php echo T_("Count Factors Filtered") ?></th>
          <th><?php echo T_("Sum Factors") ?></th>
          <th><?php echo T_("Sum Factors Filtered") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::monthlyList() as $key => $value) {?>
          <tr>
            <td class="collapsing fc-mute"><?php echo $key + 1 ?></td>
            <td class="collapsing txtB"><?php echo a($value, 'year') ?></td>
            <td class=" txtB"><?php echo \dash\fit::number_en(a($value, 'month')) ?></td>
            <td><?php echo \dash\fit::number_en(a($value, 'count_store')) ?></td>
            <td><?php echo \dash\fit::number_en(a($value, 'count_products')) ?></td>
            <td><?php echo \dash\fit::number_en(a($value, 'count_factors')) ?></td>
            <td><?php echo \dash\fit::number_en(a($value, 'count_factors_filtered')) ?></td>
            <td><?php echo \dash\fit::number_en(a($value, 'sum_factors')) ?></td>
            <td><?php echo \dash\fit::number_en(a($value, 'sum_factors_filtered')) ?></td>
          </tr>
        <?php } //endif ?>
      </tbody>
    </table>
  </div>
<?php } //endif ?>