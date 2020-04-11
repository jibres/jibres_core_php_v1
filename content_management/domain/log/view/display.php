<div class="f">
   	<div class="c">
    <a class="dcard x1">
     <div class="statistic">
      <div class="value"><?php echo \dash\fit::text(\dash\data::dataRow_id()); ?></div>
      <div class="label"><?php echo T_("ID"); ?></div>
     </div>
    </a>
   </div>
	<div class="c">
	<a class="dcard x1">
     <div class="statistic">
      <div class="value"><?php echo \dash\fit::text(\dash\data::dataRow_result_code()); ?></div>
      <div class="label"><?php echo T_("Result code"); ?></div>
     </div>
    </a>
   </div>

   	<div class="c">
    <a class="dcard x1">
     <div class="statistic">
      <div class="value"><?php echo \dash\data::dataRow_type(); ?></div>
      <div class="label"><?php echo T_("Type"); ?></div>
     </div>
    </a>
   </div>

    <?php if(\dash\data::dataRow_nic_id()) {?>
    	<div class="c">
    	<a class="dcard x1">
	     <div class="statistic">
	      <div class="value"><?php echo \dash\data::dataRow_nic_id(); ?></div>
	      <div class="label"><?php echo T_("IRNIC id"); ?></div>
	     </div>
	    </a>
	   </div>
    <?php } //endif ?>

    <?php if(\dash\data::dataRow_domain()) {?>
    	<div class="c">
    	<a class="dcard x1">
	     <div class="statistic">
	      <div class="value"><?php echo \dash\data::dataRow_domain(); ?></div>
	      <div class="label"><?php echo T_("Domain"); ?></div>
	     </div>
	    </a>
	   </div>
    <?php } //endif ?>

    <?php if(\dash\data::dataRow_request_count() > 1) {?>
    	<div class="c">
    	<a class="dcard x1">
	     <div class="statistic">
	      <div class="value"><?php echo \dash\data::dataRow_request_count(); ?></div>
	      <div class="label"><?php echo T_("Count request"); ?></div>
	     </div>
	    </a>
	   </div>
    <?php } //endif ?>
</div>
<div class="cbox">

<div class="f align-center">
	<div class="c s12 msg secondary txtB "><?php echo T_("Cliend ID"); ?>: <br><code><?php echo \dash\data::dataRow_client_id(); ?></code></div>
	<div class="c s12 msg secondary txtB mLa5"><?php echo T_("Server ID"); ?>: <br><code><?php echo \dash\data::dataRow_server_id(); ?></code></div>
</div>


<div class="f align-center">

	<div class="c s12 msg primary2 txtB "><?php echo T_("Date Send"); ?>: <br>
		<code><?php echo \dash\data::dataRow_datesend(); ?></code><br>
		<?php echo \dash\fit::date_time(\dash\data::dataRow_datesend()); ?><br>
		<?php echo \dash\fit::date_human(\dash\data::dataRow_datesend()); ?>
	</div>

	<div class="c s12 msg primary2 txtB mLa5"><?php echo T_("Date Response"); ?>: <br>
		<code><?php echo \dash\data::dataRow_dateresponse(); ?></code><br>
		<?php echo \dash\fit::date_time(\dash\data::dataRow_dateresponse()); ?><br>
		<?php echo \dash\fit::date_human(\dash\data::dataRow_dateresponse()); ?>
	</div>

</div>

<h3>Send</h3>
<samp><?php echo htmlspecialchars(\dash\data::dataRow_send()); ?></samp>
<h3>Response</h3>
<samp><?php echo htmlspecialchars(\dash\data::dataRow_response()); ?></samp>

<?php if(\dash\data::dataRow_result()) {?>
<h3>Result</h3>
<samp><?php echo htmlspecialchars(\dash\data::dataRow_result()); ?></samp>
<?php } //endif ?>

</div>