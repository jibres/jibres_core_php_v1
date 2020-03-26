<div class="f justify-center">
<div class="c6 s12">
	<div class="cbox">
	 <div class="msg f"><?php echo T_("Cancel request") ?><div data-confirm data-data='{"status" : "cancel"}' class="cauto os btn danger"><?php echo T_("Set status on Cancel"); ?></div></div>
	 <div class="msg f"><?php echo T_("Set on queue request") ?><div data-confirm data-data='{"status" : "queue"}' class="cauto os btn success"><?php echo T_("Set status on Cancel"); ?></div></div>
	 <div class="msg f"><?php echo T_("id") ?> <span class="cauto os"><?php echo \dash\data::dataRow_id(); ?></span></div>
	 <div class="msg f"><?php echo T_("store_id") ?> <span class="cauto os"><?php echo \dash\data::dataRow_store_id(); ?></span></div>
	 <div class="msg f"><?php echo T_("user_id") ?> <span class="cauto os"><?php echo \dash\data::dataRow_user_id(); ?></span></div>
	 <div class="msg f"><?php echo T_("version") ?> <span class="cauto os"><?php echo \dash\data::dataRow_version(); ?></span></div>
	 <div class="msg f"><?php echo T_("build") ?> <span class="cauto os"><?php echo \dash\data::dataRow_build(); ?></span></div>
	 <div class="msg f"><?php echo T_("status") ?> <span class="cauto os"><?php echo \dash\data::dataRow_status(); ?></span></div>
	 <div class="msg f"><?php echo T_("daterequest") ?> <span class="cauto os"><?php echo \dash\fit::date_time(\dash\data::dataRow_daterequest()); ?></span></div>
	 <div class="msg f"><?php echo T_("datequeue") ?> <span class="cauto os"><?php echo \dash\fit::date_time(\dash\data::dataRow_datequeue()); ?></span></div>
	 <div class="msg f"><?php echo T_("datedone") ?> <span class="cauto os"><?php echo \dash\fit::date_time(\dash\data::dataRow_datedone()); ?></span></div>
	 <div class="msg f"><?php echo T_("datedownload") ?> <span class="cauto os"><?php echo \dash\fit::date_time(\dash\data::dataRow_datedownload()); ?></span></div>
	 <div class="msg f"><?php echo T_("datemodified") ?> <span class="cauto os"><?php echo \dash\fit::date_time(\dash\data::dataRow_datemodified()); ?></span></div>
	 <div class="msg f"><?php echo T_("file") ?> <span class="cauto os"><?php echo \dash\data::dataRow_file(); ?></span></div>
	 <div class="msg f"><?php echo T_("meta") ?> <span class="cauto os"><?php echo \dash\data::dataRow_meta(); ?></span></div>
	 <div class="msg f"><?php echo T_("versiontitle") ?> <span class="cauto os"><?php echo \dash\data::dataRow_versiontitle(); ?></span></div>
	 <div class="msg f"><?php echo T_("versionnumber") ?> <span class="cauto os"><?php echo \dash\data::dataRow_versionnumber(); ?></span></div>
	 <div class="msg f"><?php echo T_("packagename") ?> <code class="cauto os"><?php echo \dash\data::dataRow_packagename(); ?></code></div>
	 <div class="msg f"><?php echo T_("keystore") ?> <code class="cauto os"><?php echo \dash\data::dataRow_keystore(); ?></code></div>
	 <div class="msg f"><?php echo T_("path") ?> <code class="cauto os"><?php echo \dash\data::dataRow_path(); ?></code></div>


	</div>
	</div>

</div>