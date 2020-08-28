<?php if(\dash\data::noChart()) {?>
  <div class="msg warn txtC txtB fs14"><?php echo T_("Can not drow chart for this item!") ?></div>
<?php }else{ ?>

<?php $myData = \dash\data::reportDetail(); ?>

   <section class="f">
     <div class="c s12 pRa10">
      <a class="stat">
       <h3><?php echo T_("Count all answer");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'count_answer_all'));?></div>
      </a>
     </div>
     <div class="c s6 pRa10">
      <a class="stat">
       <h3><?php echo T_("Answer to this item");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'count_answer_item'));?></div>
      </a>
     </div>
     <div class="c s6">
      <a class="stat">
       <h3><?php echo T_("Count not answer");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'count_not_answer'));?></div>
      </a>
     </div>

     <div class="c s6">
      <a class="stat">
       <h3><?php echo T_("Percent answer");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'percent_answer'));?></div>
      </a>
     </div>
    </section>




<div class="msg info2 txtB font-14"><?php echo \dash\data::itemDetail_title() ?></div>
<div id="chartdivpie" class="box chart x400" data-abc='a/form_pie'></div>
<?php if(\dash\get::index($myData, 'data_table')) {?>

<div class="tblBox font-12">
	<table class="tbl1 v6">
		<thead>
			<tr>
				<th><?php echo T_("Choice") ?></th>
				<th><?php echo T_("Frequency") ?></th>
				<th><?php echo T_("Percent frequency") ?></th>
			</tr>
		</thead>
		<tbody class="font-14">
			<?php foreach ($myData['data_table'] as $key => $value) {?>
				<tr>
					<td><?php echo \dash\get::index($value, 'name') ?></td>
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'count')) ?></td>
					<td><?php echo \dash\fit::text(\dash\get::index($value, 'percent')) ?></td>
				</tr>
			<?php } //endfor ?>
		</tbody>
		<tfoot>
			<tr>
				<td><?php echo T_("Sum") ?></td>
				<td><?php echo \dash\fit::number(array_sum(array_column($myData['data_table'], 'count'))) ?></td>
				<td><?php echo \dash\fit::number(array_sum(array_column($myData['data_table'], 'percent'))) ?></td>
			</tr>
		</tfoot>
	</table>
</div>

<?php } //endif ?>



<div class="hide">

  <div id="charttitle"><?php echo T_("Answer"); ?></div>
  <div id="chartitemtitle"></div>
  <div id="chartdata"><?php echo \dash\data::reportDetail_chart(); ?></div>
</div>

<?php } //endif ?>