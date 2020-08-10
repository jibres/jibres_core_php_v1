<div class="avand">
	<div class="row">
		<div class="c-xs-12 c-sm-6">
			<?php echo \dash\data::dataTableAll(); ?>
		</div>
		<div class="c-xs-12 c-sm-6">
			<?php if(\dash\data::loadDetail()) {?>
				<div class="box">
					<header><h2><?php echo T_("Detail") ?> <?php echo T_(ucfirst(\dash\data::loadDetail_type())); ?></h2></header>
					<div class="body">
						<table class="tbl1 v4">
							<tbody>

								<tr>
									<td class="txtB"><code class="link"><?php echo \dash\data::loadDetail_code(); ?></code></td>
									<td class="txtB"><?php echo \dash\data::loadDetail_title(); ?></td>
								</tr>

								<tr>
									<td class="collapsing"><?php echo T_("Class") ?></td>
									<td class="txtB"><?php echo T_(\dash\data::loadDetail_class()); ?></td>
								</tr>

								<tr>
									<td class="collapsing"><?php echo T_("Topic") ?></td>
									<td class="txtB"><?php echo T_(\dash\data::loadDetail_topic()); ?></td>
								</tr>

								<tr>
									<td class="collapsing"><?php echo T_("Status") ?></td>
									<td class="txtB"><?php echo T_(\dash\data::loadDetail_status()); ?></td>
								</tr>

								<tr>
									<td class="collapsing"><?php echo T_("Nature") ?></td>
									<td class="txtB"><?php echo T_(ucfirst(\dash\data::loadDetail_nature())); ?></td>
								</tr>
								<?php if(\dash\data::loadDetail_type() === 'assistant' ) {?>
									<tr>
										<td colspan="2">
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_naturecontrol()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("naturecontrol"); ?></span></div>
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_exchangeable()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("exchangeable"); ?></span></div>
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_followup()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("followup"); ?></span></div>
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_currency()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("Accounting currency"); ?></span></div>
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_detailable()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("Detailable"); ?></span></div>
										</td>
									</tr>
								<?php } //endif ?>



							</tbody>

						</table>

					</div>
					<footer class="f">
						<div class="cauto"><a class="btn secondary outline" href="<?php echo \dash\url::that(). '/edit?id='. \dash\data::loadDetail_id() ?>"><?php echo T_("Add child"); ?></a></div>
						<div class="c"></div>
						<div class="cauto"><a class="btn primary" href="<?php echo \dash\url::that(). '/edit?id='. \dash\data::loadDetail_id() ?>"><?php echo T_("Edit"); ?></a></div>

					</footer>
				</div>
			<?php } //endif ?>
		</div>
	</div>

</div>


