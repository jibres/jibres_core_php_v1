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
	   <div class="val"><?php echo \dash\fit::text(\dash\data::dataRow_request_count()); ?></div>
	  </a>
	 </div>

   <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '?type='. \dash\data::dataRow_type() ?>" class="stat x70">

     <h3><?php echo T_("Type"); ?></h3>
     <div class="val"><?php echo T_(\dash\data::dataRow_type()); ?></div>
    </a>
   </div>

   <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '?q='. \dash\data::dataRow_nic_id() ?>" class="stat x70">
	   <h3><?php echo T_("IRNIC id"); ?></h3>
	   <div class="val"><?php echo \dash\data::dataRow_nic_id(); ?></div>
	  </a>
	 </div>

   <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '?q='. \dash\data::dataRow_domain() ?>" class="stat x70">
	   <h3><?php echo T_("Domain"); ?></h3>
	   <div class="val"><?php echo \dash\data::dataRow_domain(); ?></div>
	  </a>
	 </div>

  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '?user='. \dash\data::dataRow_user_id() ?>" class="stat x70">
     <h3><?php echo T_("User"); ?></h3>
     <code class="val"><?php echo \dash\data::dataRow_user_id(); ?></code>
    </a>
   </div>

   <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '?ip='. \dash\data::dataRow_ip() ?>" class="stat x70">
     <h3><?php echo T_("IP Address"); ?></h3>
     <code class="val"><?php echo \dash\data::dataRow_ip(); ?></code>
    </a>
   </div>

	 <div class="c">


    <a href="<?php echo \dash\url::that(). '?result_code='. \dash\data::dataRow_result_code() ?>" class="stat x70 <?php if(in_array(\dash\data::dataRow_result_code(), [1000, 1001, 1300, 1302])) echo 'ok'; else echo 'nok'; ?>">
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
  <header class="f align-center">
    <h3 class="c pRa10"><?php echo T_("Request"); ?></h3>
    <div class="cauto pRa10"><?php echo \dash\fit::date_human(\dash\data::dataRow_datesend()); ?> /</div>
    <div class="cauto"><?php echo \dash\fit::date_time(\dash\data::dataRow_datesend()); ?></div>
  </header>
  <samp class="fs09"><?php echo htmlspecialchars(\dash\data::dataRow_send()); ?></samp>
</div>

<div class="box">
  <header class="f align-center">
    <h3 class="c pRa10"><?php echo T_("Response"); ?></h3>
    <div class="cauto pRa10"><?php echo \dash\fit::date_human(\dash\data::dataRow_dateresponse()); ?> /</div>
    <div class="cauto"><?php echo \dash\fit::date_time(\dash\data::dataRow_dateresponse()); ?></div>
  </header>
  <samp class="fs09"><?php echo htmlspecialchars(\dash\data::dataRow_response()); ?></samp>
</div>


<?php if(\dash\data::dataRow_result()) {?>
<div class="box">
  <header class="f align-center">
    <h3 class="c pRa10"><?php echo T_("Result"); ?></h3>
    <div class="cauto pRa10"></div>
    <div class="cauto"></div>
  </header>
  <samp class="fs09"><?php echo htmlspecialchars(\dash\data::dataRow_result()); ?></samp>
</div>
<?php } //endif ?>

<p class="hide"><?php if(\dash\data::dataRow_response() && is_string(\dash\data::dataRow_response())) { echo md5(\dash\data::dataRow_response());} ?></p>
