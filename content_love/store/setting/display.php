<?php $dataRow = \dash\data::dataRow(); ?>
<div class="row">
    <div class="c-xs-12 c-sm-12 c-md-4">
		<?php require_once(root . 'content_love/store/storeDetail.php') ?>
        <nav class="items">
            <ul>
                <li>
                    <a class="f item"
                       href="<?php echo \dash\url::this() . '/backup?id=' . \dash\request::get('id'); ?>">
                        <i class="sf-database"></i>
                        <div class="key"><?php echo T_("Backup") ?></div>
                        <div class="go"></div>
                    </a>
                </li>

                <li>
                    <a class="f item" href="<?php echo \dash\url::this() . '/owner?id=' . \dash\request::get('id'); ?>">
                        <i class="sf-user-secret"></i>
                        <div class="key"><?php echo T_("Change owner") ?></div>
                        <div class="go"></div>
                    </a>
                </li>

                <li>
                    <a class="f item"
                       href="<?php echo \dash\url::here() . '/plan/datalist?business_id=' . \dash\request::get('id'); ?>">
                        <i class="sf-tree"></i>
                        <div class="key"><?php echo T_("Plan") ?></div>
                        <div class="go"></div>
                    </a>
                </li>

                <li>
                    <a class="f item"
                       href="<?php echo \dash\url::here() . '/sms/datalist?business_id=' . \dash\request::get('id'); ?>">
                        <i class="sf-envelope"></i>
                        <div class="key"><?php echo T_("SMS") ?></div>
                        <div class="go"></div>
                    </a>
                </li>

				<?php if($dataRow['status'] === 'deleted') { ?>

                    <li>
                        <div class="f item" data-confirm data-data='{"reenable": "reenable"}'>
                            <div class="key"><?php echo T_("Re enable this business") ?></div>
                            <div class="go detail nok"></div>
                        </div>
                    </li>

				<?php } //endif ?>

                <li>
                    <a class="f item"
                       href="<?php echo \dash\url::here() . '/plugin/manage?id=' . a($dataRow, 'id'); ?>">
                        <div class="key"><?php echo T_("Plugins") ?></div>
                        <div class="value ltr"><?php echo \dash\store_coding::encode(a($dataRow, 'id')); ?></div>
                    </a>
                </li>

                <li>
                    <a class="f item"
                       href="<?php echo \dash\url::kingdom() . '/' . \dash\store_coding::encode(a($dataRow, 'id')); ?>">
                        <div class="key"><?php echo T_("Go to admin") ?></div>
                        <div class="value ltr"><?php echo \dash\store_coding::encode(a($dataRow, 'id')); ?></div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="c-xs-12 c-sm-12 c-md-8">
        <form method="post" autocomplete="off">
            <input type="hidden" name="setenterprise" value="1">
            <div class="box">
                <div class="body">
                    <label for="enterprise"><?php echo T_("Chage business enterprise") ?></label>
                    <div>
                        <select class="select22" name="enterprise" id="enterprise">
                            <option value="0"><?php echo T_("None") ?></option>
                            <option value="rafiei" <?php if(\dash\data::dataRowData_enterprise() === 'rafiei') {
								echo 'selected';
							} ?>><?php echo T_("Rafiei") ?></option>
                        </select>
                    </div>
                </div>
                <footer class="txtRa">
                    <button class="btn master"><?php echo T_("Save") ?></button>
                </footer>
            </div>
        </form>
        <form method="post" autocomplete="off">
            <input type="hidden" name="set_storage" value="1">
            <div class="box">
                <div class="body">
                    <label for="storage"><?php echo T_("Chage business storage limit") ?> (storage limit)</label>
                    <div class="input">
                        <label for="storage" class="addon">MB</label>
                        <input type="number" name="storage" value="<?php echo \dash\data::dataRowData_storage() ?>"
                               id="storage">
                    </div>
                    <label for="uploadsize"><?php echo T_("Chage business upload file size limit") ?> (File
                        size)</label>
                    <div class="input">
                        <label for="uploadsize" class="addon">MB</label>
                        <input type="number" name="uploadsize"
                               value="<?php echo \dash\data::dataRowData_uploadsize() ?>" id="uploadsize">
                    </div>
                </div>
                <footer class="txtRa">
                    <button class="btn master"><?php echo T_("Save") ?></button>
                </footer>
            </div>
        </form>
        <form method="post" autocomplete="off">
            <div class="box">
                <div class="body">
                    <p><?php echo T_("You can change business subdomain") ?></p>
                    <div class="input ltr">
                        <input type="text" name="subdomain" value="<?php echo $dataRow['subdomain'] ?>" required>
                    </div>
                </div>
                <footer class="txtRa">
                    <button class="btn-danger"><?php echo T_("Change subdomian") ?></button>
                </footer>
            </div>
        </form>
    </div>
</div>