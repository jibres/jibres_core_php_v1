<?php $storeData = \lib\store::detail(); ?>

<div class="avand-md impact zero">
    <form method="post" autocomplete="off" id='aThirdParty' data-patch>
        <div class="box">
            <div class="mx-auto">
                <div>

                    <img class="" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/torob-logo.svg" alt='torob'>
                </div>
            </div>
            <div class="body">
                <div class="alert2">
					<?php echo T_("The horseradish search engine has been launched with the aim of providing and comparing prices transparently. This search engine has collected millions of products from thousands of reputable Iranian online stores to help users find the best price between different stores in the shortest time. It also helps reputable online stores to access a wide range of online users without the need for technical knowledge.") ?>
                </div>

                <div class="switch1">
                    <input type="checkbox" name="torob_api"
                           id="istatus" <?php if(a($storeData, 'store_data', 'torob_api')) {
						echo 'checked';
					}; ?>>
                    <label for="istatus"></label>
                    <label for="istatus"><?php echo T_("Active torob api page") ?></label>
                </div>

                <div data-response='torob_api'
                     data-response-effect='slide' <?php if(!a($storeData, 'store_data', 'torob_api')) {
					echo 'data-response-hide';
				}; ?>>


					<?php $torob_link = \lib\store::url() . '/api/torob/' . md5(\lib\store::url('raw')); ?>
                    <div class="alert-info"><?php echo T_("By sending the following link to Torb support, your site prices are updated twice a day by this search engine") ?></div>
                    <pre class="ltr text-left" data-copy="<?php echo $torob_link ?>"><?php echo $torob_link ?></pre>

                </div>

            </div>

        </div>
    </form>
</div>


