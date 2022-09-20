<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 c-xl-3 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-lg-8 c-xl-9">
        <?php require_once (root. 'content_a/form/formTitle.php'); ?>
        <form method="post" autocomplete="off">
            <div class="avand-lg">
                <section class="box">
                    <header><h2><?php echo T_("Remove tag"); ?></h2></header>
                    <div class="body">
                        <div class="alert2">
							<?php echo T_(":val forms by this tag founded", ['val' => \dash\fit::number(\dash\data::tagDataRow_count())]) ?>
                            <br>
                            <a class="link-primary"
                               href="<?php echo \dash\url::here(); ?>/forms?tagid=<?php echo \dash\data::tagDataRow_id(); ?>"><?php echo T_("Show forms by this tag"); ?></a>
                        </div>

                        <p>
							<?php echo T_("You can remove this tag from all form or change it to another tag"); ?>
                        </p>

                        <div class="row mb-2">
                            <div class="c-xs-12 c-sm-6">
                                <div class="radio3">
                                    <input type="radio" name="wd" value="wde" id="wde">
                                    <label for="wde"><?php echo T_("Remove this tag from all forms") ?></label>
                                </div>
                            </div>
                            <div class="c-xs-12 c-sm-6">
                                <div class="radio3">
                                    <input type="radio" name="wd" value="wdn" id="wdn">
                                    <label for="wdn"><?php echo T_("Selecte new tag") ?></label>
                                </div>
                            </div>
                        </div>

                        <div data-response='wd' data-response-where='wdn' data-response-hide>

                            <div class="mb-2">
                                <label for='tag'><?php echo T_("New Tag"); ?></label>
                                <select name="tagid" id="tag" class="select22" data-model="tag"
                                        data-placeholder="<?php echo T_("Select one tag") ?>">
									<?php if(\dash\request::get('tagid')) { ?>
                                        <option value="0"><?php echo T_("None") ?></option>
									<?php } else { ?>
                                        <option value="" readonly></option>
									<?php } //endif ?>
									<?php foreach (\dash\data::listTag() as $key => $value) { ?>
										<?php if($value['id'] === \dash\request::get('id')) {
											continue;
										} ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option>
									<?php } //endfor ?>
                                </select>
                            </div>

                        </div>


                    </div>
                    <footer class="txtRa">
                        <button class="btn-danger"><?php echo T_("Save change and remove tag") ?></button>
                    </footer>
                </section>
            </div>


        </form>
    </div>
</div>