
<div class="f">

   <div class="c6">
    <a class="dcard <?php if(\dash\url::child() === 'add') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/add'>
     <div class="statistic sm">
      <div class="value"><i class="sf-plus-circle fc-green"></i></div>
      <div class="label"><?php echo T_("Plus charge account"); ?></div>
     </div>
    </a>
   </div>

   <div class="c6">
    <a class="dcard <?php if(\dash\url::child() === 'minus') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/minus'>
     <div class="statistic sm">
      <div class="value"><i class="sf-minus-circle fc-red"></i></div>
      <div class="label"><?php echo T_("Minus charge account"); ?></div>
     </div>
    </a>
   </div>

</div>

<div class="f justify-center">

	<div class="cbox justify-center c6">
		<h2><?php echo T_("Plus charge account"); ?></h2>

		 <form method="post"  autocomplete="off">

		 	<div class="input">
				<label for="title" ><?php echo T_("Title"); ?></label>
				<input type="text" name="title"  id="title" placeholder='<?php echo T_("Title"); ?> *' required >
			</div>



			<div class="input">
				<label for="type" ><?php echo T_("type"); ?></label>
				<select name="type"  id="type" class="select">
					<option value=""><?php echo T_("Please select one item"); ?></option>
					<option value="money"><?php echo T_("Money"); ?></option>
					<option value="gift"><?php echo T_("Gift"); ?></option>
					<option value="transfer"><?php echo T_("Transfer"); ?></option>
					<option value="prize"><?php echo T_("Prize"); ?></option>
				</select>
			</div>


			<div class="input">
				<label for="unit" ><?php echo T_("Unit"); ?></label>
				<select name="unit"  id="unit" class="select">
					<option value=""><?php echo T_("Please select one item"); ?></option>
					<option value="toman" selected=""><?php echo \lib\currency::unit(); ?></option>
					<option value="dollar"><?php echo T_("$"); ?></option>
				</select>
			</div>


			<div class="input">
				<label for="mobile" ><?php echo T_("Mobile"); ?></label>
				<input type="text" name="mobile"  id="mobile" placeholder='<?php echo T_("Mobile"); ?> *' required value="<?php echo \dash\request::get('mobile'); ?>">
			</div>



			<label for="amount"><?php echo T_("Price"); ?> <small class="fc-red">* <?php echo T_("Require"); ?></small></label>
			<div class="input">
			  <input type="number" name="amount" id="amount" placeholder='<?php echo T_("Price of transaction"); ?> | <?php echo \lib\currency::unit(); ?> * ' <?php \dash\layout\autofocus::html() ?>  required max='999999999' min="0" pattern=".{1,150}" title='<?php echo T_("Enter a valid amount"); ?>' data-response-realtime>
			</div>

			<?php if(\dash\language::current() === 'fa') {?>

			<div class="msg info2 txtB" data-response='amount' data-response-call='wordifyResponse'></div>
			<?php } ?>

			<div class="input">
				<label for="desc" ><?php echo T_("Description"); ?></label>
				<input type="text" name="desc"  id="desc" placeholder='<?php echo T_("Description"); ?>'>
			</div>

			<button type="submit"  class="btn danger mT15 block"><?php echo T_("Minus"); ?></button>

		</form>

	</div>
</div>