  <div class="f">
   <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo T_("Request ID"); ?></h3>
      <div class="val"><?php echo \dash\fit::text(\dash\data::dataRow_id()); ?></div>
    </a>
   </div>

   <div class="c pRa10">
    <a class="stat x70">
	   <h3><?php echo T_("Count request"); ?></h3>
	   <div class="val"><?php echo \dash\data::dataRow_request_count(); ?></div>
	  </a>
	 </div>

   <div class="c pRa10">
    <a class="stat x70">
     <h3><?php echo T_("Type"); ?></h3>
     <div class="val"><?php echo \dash\data::dataRow_type(); ?></div>
    </a>
   </div>

   <div class="c pRa10">
    <a class="stat x70">
	   <h3><?php echo T_("IRNIC id"); ?></h3>
	   <div class="val"><?php echo \dash\data::dataRow_nic_id(); ?></div>
	  </a>
	 </div>

   <div class="c pRa10">
    <a class="stat x70">
	   <h3><?php echo T_("Domain"); ?></h3>
	   <div class="val"><?php echo \dash\data::dataRow_domain(); ?></div>
	  </a>
	 </div>

	 <div class="c">
    <a class="stat x70 <?php if(in_array(\dash\data::dataRow_result_code(), [1000, 1001, 1300, 1302])) echo 'ok'; else echo 'nok'; ?>">
     <h3><?php echo T_("Result code"); ?></h3>
     <div class="val"><?php echo \dash\fit::text(\dash\data::dataRow_result_code()); ?></div>
    </a>
   </div>
  </div>

  <div class="f hide">
   <div class="c pRa10">
    <a class="stat x50">
      <h3><?php echo T_("Cliend ID"); ?></h3>
      <code class="val"><?php echo \dash\data::dataRow_client_id(); ?></code>
    </a>
   </div>

   <div class="c pRa10">
    <a class="stat x50">
     <h3><?php echo T_("Server ID"); ?></h3>
      <code class="val"><?php echo \dash\data::dataRow_server_id(); ?></code>
    </a>
   </div>
 </div>






<div class="box">
  <header><h3><?php echo T_("Request"); ?></h3></header>
  <samp class="fs09"><?php echo htmlspecialchars(\dash\data::dataRow_send()); ?></samp>
</div>

<div class="box">
  <header><h3><?php echo T_("Response"); ?></h3></header>
  <samp class="fs09"><?php echo htmlspecialchars(\dash\data::dataRow_response()); ?></samp>
</div>


<?php if(\dash\data::dataRow_result()) {?>
<div class="box">
  <header><h3><?php echo T_("Result"); ?></h3></header>
  <samp class="fs09"><?php echo htmlspecialchars(\dash\data::dataRow_result()); ?></samp>
</div>
<?php } //endif ?>
