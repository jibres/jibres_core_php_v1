

<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>

<div class="f">
 <div class="cauto s12 pA5">

 </div>
 <div class="c s12 pA5">

 	<table class="tbl1 v1 fs12">
 		<thead>
 			<tr>
 				<th colspan="4"><?php echo T_("User ticket"); ?></th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php foreach (\dash\data::dataTable() as $key => $value) {?>


 			<tr>
 				<td><a class="badge light" href="<?php echo \dash\url::kingdom(); ?>/support/ticket/show?id=<?php echo $value['id']; ?>"><?php echo \dash\fit::number($value['id']); ?></a></td>

 				<td><a class="" href="<?php echo \dash\url::kingdom(); ?>/support/ticket/show?id=<?php echo $value['id']; ?>"><?php echo substr($value['content'], 0, 60); ?></a></td>
 				<td class="collapsing s0"><?php if(isset($value['solved']) && $value['solved']) {?><div class="badge success"><?php echo T_("Solved"); ?> <i class="compact sf-check"></i></div><?php } ?></td>


 				<td><?php echo T_($value['status']); ?></td>
 			</tr>
 			<?php } ?>
 		</tbody>

 	</table>

 </div>
</div>


