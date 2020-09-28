
<div class="f justify-center align-center mT100">
	<div class="c3">
		<div class="text">
		 <p><?php echo \dash\data::autoredirect_title(); ?></p>
		</div>

		<form method="<?php echo \dash\data::autoredirect_method(); ?>" data-action action="<?php echo \dash\data::autoredirect_url(); ?>" id='payformsubmit'>
			<?php
			if(is_array(\dash\data::autoredirect_args()))
			{
				foreach (\dash\data::autoredirect_args() as $key => $value)
				{
					echo '<input type="hidden" name="'. $key. '" value="'. $value. '">';
				}
			}
			?>


			<button type="submit" class="btn block primary mT25">
				<?php if(\dash\data::autoredirect_button()) { echo \dash\data::autoredirect_button(); } else { echo T_("Go");} ?>
			</button>
		</form>
	</div>

</div>
