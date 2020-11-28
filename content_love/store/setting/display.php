<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand-md">
  <div class="box">
    <div class="body">
      <div class="tblBox">
      	<table class="tbl1 v4">
      		<tbody>
      			<tr>
      				<td><?php echo T_("ID") ?></td>
      				<td><?php echo $dataRow['id'] ?></td>
      			</tr>

 				<tr>
      				<td><?php echo T_("subdomain") ?></td>
      				<td><?php echo $dataRow['subdomain'] ?></td>
      			</tr>

      			<tr>
      				<td><?php echo T_("Fuel") ?></td>
      				<td><?php echo $dataRow['fuel'] ?></td>
      			</tr>

      			<tr>
      				<td><?php echo T_("IP") ?></td>
      				<td><?php echo $dataRow['ip'] ?></td>
      			</tr>

      			<tr>
      				<td><?php echo T_("datecreated") ?></td>
      				<td><?php echo \dash\fit::date_time($dataRow['datecreated']) ?></td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </div>
  </div>

  <form method="post" autocomplete="off">
	  <div class="box">
	  	<div class="body">
	  		<p><?php echo T_("You can change business subdomain") ?></p>
	  		<div class="input ltr">
	  			<input type="text" name="subdomain" value="<?php echo $dataRow['subdomain'] ?>" required>
	  		</div>
	  	</div>
	  	<footer class="txtRa">
	  		<button class="btn danger"><?php echo T_("Change subdomian") ?></button>
	  	</footer>
	  </div>
  </form>
</div>