
	<?php if(\dash\data::firstInit()) {?>

	<div class="welcome">
	  <p><?php echo T_("We make all coding list for you"); ?></p>
	  <h2><?php echo T_("Easily Import accounting coding"); ?></h2>

	  <div class="buildBtn">
	    <a class="btn xl master" data-data='{"first": "init"}' data-confirm ><?php echo T_("Import it now"); ?></a>
	  </div>
	</div>
	<?php } //endif ?>

        <?php $myData = \dash\data::myDataCount(); ?>
  <section class="f">
    <div class="c">
      <a href="<?php echo \dash\url::current(); ?>" class="stat x70 <?php if(!\dash\request::get('type')) { echo 'active';} ?>">
        <h3><?php echo T_("All");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'all'));?></div>
      </a>
    </div>

    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=group'; ?>" class="stat x70 <?php if(\dash\request::get('type') === 'group') { echo 'active';} ?>">
        <h3><?php echo T_("Group");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'group'));?></div>
      </a>
    </div>
    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=total'; ?>" class="stat x70 <?php if(\dash\request::get('type') === 'total') { echo 'active';} ?>">
        <h3><?php echo T_("Accounting total");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'total'));?></div>
      </a>
    </div>
    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=assistant'; ?>" class="stat x70 <?php if(\dash\request::get('type') === 'assistant') { echo 'active';} ?>">
        <h3><?php echo T_("Accounting assistant");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'assistant'));?></div>
      </a>
    </div>

    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=details'; ?>" class="stat x70 <?php if(\dash\request::get('type') === 'details') { echo 'active';} ?>">
        <h3><?php echo T_("Accounting details");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'details'));?></div>
      </a>
    </div>
  </section>
	 <div class="cbox fs12">
    <form method="get" action='<?php echo \dash\url::current(); ?>' >
    	<?php if(\dash\request::get('type')) {?><input type="hidden" name="type" value="<?php echo \dash\request::get('type') ?>"><?php } //endif ?>
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
        <button class="addon btn "><?php echo T_("Search"); ?></button>
      </div>
    </form>
  </div>

	<div class="row">
		<div class="c-xs-12 c-sm-6">
			<?php echo \dash\data::dataTableAll(); ?>
		</div>
		<div class="c-xs-12 c-sm-6">
			<?php if(\dash\data::loadDetail()) {?>
				<?php htmlLoadDetailCoding(); ?>
			<?php }else{ ?>
				<?php htmlListCoding(); ?>
			<?php  }//endif ?>
		</div>
	</div>

<?php function htmlListCoding() {?>
	<div class="tblBox">

 <table class="tbl1 v4 font-12 minimal">
    <thead>
      <tr>

        <th class="collapsing"><?php echo T_("code") ?></th>
        <th class="collapsing"><?php echo T_("Title") ?></th>
        <th class="collapsing"><?php echo T_("Natuer group") ?></th>
        <th class="collapsing"><?php echo T_("Balance type") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>


          <td class="collapsing"><span class="txtB"><?php echo \dash\fit::text(a($value, 'code')) ?></span></td>
          <td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>"><?php echo a($value, 'title') ?></a></td>
          <td class="collapsing"><?php echo T_(ucfirst(a($value, 'naturegroup'))); ?></td>
          <td class="collapsing"><?php echo T_(ucfirst(a($value, 'balancetype'))); ?></td>
        </tr>
        <tr class="hide">
          <td colspan="4">
          	<?php if(false) {?>
              <div class="badge light"><?php if(\dash\data::loadDetail_naturecontrol()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("naturecontrol"); ?></span></div>
          <?php } //endif ?>
              <div class="badge light"><?php if(\dash\data::loadDetail_exchangeable()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("exchangeable"); ?></span></div>
              <div class="badge light"><?php if(\dash\data::loadDetail_followup()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("followup"); ?></span></div>
              <div class="badge light"><?php if(\dash\data::loadDetail_currency()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("Accounting currency"); ?></span></div>
              <div class="badge light"><?php if(\dash\data::loadDetail_detailable()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("Detailable"); ?></span></div>
          </td>

        </tr>
      <?php } //endif ?>
    </tbody>
  </table>


	</div>


  <?php \dash\utility\pagination::html(); ?>
<?php } //endif ?>

<?php function htmlLoadDetailCoding() {?>
	<div class="box">
					<header><h2><?php echo T_("Detail") ?> <?php echo T_(ucfirst(\dash\data::loadDetail_type())); ?></h2></header>
					<div class="body">
						<nav class="items long">
			              <ul>
			              	<?php if(\dash\data::dataRow_type() === 'details') { $detail_url = '/detail';}else{$detail_url = null;} ?>
			                <li><a class="f" href="<?php echo \dash\url::this(). '/turnover'.$detail_url .'?contain='. \dash\data::loadDetail_id(); ?>"><div class="key"><?php echo T_("Show contain document") ?></div><div class="go"></div></a></li>
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
						<?php if(a(\dash\data::loadDetail(), 'add_child_link')) {?>
							<div class="cauto"><a class="btn secondary outline" href="<?php echo a(\dash\data::loadDetail(), 'add_child_link'); ?>"><?php echo a(\dash\data::loadDetail(), 'add_child_text'); ?></a></div>
						<?php } //endif ?>
						<div class="c"></div>
						<div class="cauto"><a class="btn primary" href="<?php echo \dash\url::that(). '/edit?id='. \dash\data::loadDetail_id() ?>"><?php echo T_("Edit"); ?></a></div>

					</footer>
				</div>
<?php } //end function ?>