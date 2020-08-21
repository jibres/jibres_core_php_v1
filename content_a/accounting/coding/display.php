<div class="avand">
	<?php if(\dash\data::firstInit()) {?>

	<div class="welcome">
	  <p><?php echo T_("We make all coding list for you"); ?></p>
	  <h2><?php echo T_("Easily Import accounting coding"); ?></h2>

	  <div class="buildBtn">
	    <a class="btn xl master" data-data='{"first": "init"}' data-confirm ><?php echo T_("Import it now"); ?></a>
	  </div>
	</div>
	<?php } //endif ?>
	<div class="row">
		<div class="c-xs-12 c-sm-6">
			<?php echo \dash\data::dataTableAll(); ?>
		</div>
		<div class="c-xs-12 c-sm-6">
			<?php if(\dash\data::loadDetail()) {?>
				<div class="box">
					<header><h2><?php echo T_("Detail") ?> <?php echo T_(ucfirst(\dash\data::loadDetail_type())); ?></h2></header>
					<div class="body">
						<nav class="items long">
			              <ul>
			                <li><a class="f" href="<?php echo \dash\url::this(). '/docdetail?contain='. \dash\data::loadDetail_id(); ?>"><div class="key"><?php echo T_("Show contain document") ?></div><div class="go"></div></a></li>
			              </ul>
			            </nav>
						<table class="tbl1 v4">
							<tbody>

								<tr>
									<td class="txtB"><code class="link"><?php echo \dash\data::loadDetail_code(); ?></code></td>
									<td class="txtB"><?php echo \dash\data::loadDetail_title(); ?></td>
								</tr>


								<tr>
									<td class="collapsing"><?php echo T_("Status") ?></td>
									<td class="txtB"><?php echo T_(\dash\data::loadDetail_status()); ?></td>
								</tr>

								<tr>
									<td class="collapsing"><?php echo T_("Nature group") ?></td>
									<td class="txtB"><?php echo T_(ucfirst(\dash\data::loadDetail_naturegroup())); ?></td>
								</tr>

								<tr>
									<td class="collapsing"><?php echo T_("Balance type") ?></td>
									<td class="txtB"><?php echo T_(ucfirst(\dash\data::loadDetail_balancetype())); ?></td>
								</tr>
								<?php if(\dash\data::loadDetail_type() === 'assistant' ) {?>
									<tr>
										<td colspan="2">
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_naturecontrol()) {echo '<i class="sf-check fc-red"></i>';}else{echo '<i class="sf-times fc-green"></i>';} ?> <span><?php echo T_("naturecontrol"); ?></span></div>
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_exchangeable()) {echo '<i class="sf-check fc-red"></i>';}else{echo '<i class="sf-times fc-green"></i>';} ?> <span><?php echo T_("exchangeable"); ?></span></div>
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_followup()) {echo '<i class="sf-check fc-red"></i>';}else{echo '<i class="sf-times fc-green"></i>';} ?> <span><?php echo T_("followup"); ?></span></div>
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_currency()) {echo '<i class="sf-check fc-red"></i>';}else{echo '<i class="sf-times fc-green"></i>';} ?> <span><?php echo T_("Accounting currency"); ?></span></div>
											<div class="ibtn mT5"><?php if(\dash\data::loadDetail_detailable()) {echo '<i class="sf-check fc-red"></i>';}else{echo '<i class="sf-times fc-green"></i>';} ?> <span><?php echo T_("Detailable"); ?></span></div>
										</td>
									</tr>
								<?php } //endif ?>



							</tbody>

						</table>

					</div>
					<footer class="f">
						<?php if(\dash\get::index(\dash\data::loadDetail(), 'add_child_link')) {?>
							<div class="cauto"><a class="btn secondary outline" href="<?php echo \dash\get::index(\dash\data::loadDetail(), 'add_child_link'); ?>"><?php echo \dash\get::index(\dash\data::loadDetail(), 'add_child_text'); ?></a></div>
						<?php } //endif ?>
						<div class="c"></div>
						<div class="cauto"><a class="btn primary" href="<?php echo \dash\url::that(). '/edit?id='. \dash\data::loadDetail_id() ?>"><?php echo T_("Edit"); ?></a></div>

					</footer>
				</div>
			<?php } //endif ?>
		</div>
	</div>

</div>


