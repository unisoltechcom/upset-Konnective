<form id="add_sale" action="" method="post">
    <input name="step" type="hidden" value="additional_sale" />
    <input name="current_page" type="hidden" value="<?php echo $current_page; ?>" />
    <input name="pageType" type="hidden" value="upsellPage<?php echo $step_count + 1?>" />
    <input name="ongoing" type="hidden" value="<?php echo filter_input(INPUT_GET, 'pageType'); ?>" <!-- For earnware only -->
    <input name="var" type="hidden" value="<?php echo $funnel_meta['page_variation'];?>" />
    <input name="orderdetails" type="hidden" value="<?php echo $funnel_meta['product_id1'];?>" />
</form>	

<form id="skip_sale" action="" method="post">
    <input name="step" type="hidden" value="skip_sale" />
    <input name="current_page" type="hidden" value="<?php echo $current_page; ?>" />
    <input name="pageType" type="hidden" value="upsellPage<?php echo $step_count + 1?>" />
    <input name="ongoing" type="hidden" value="<?php echo filter_input(INPUT_GET, 'pageType'); ?>" <!-- For earnware only -->
    <input name="var" type="hidden" value="<?php echo $funnel_meta['page_variation'];?>" />
    <input name="orderdetails" type="hidden" value="<?php echo $funnel_meta['product_id1'];?>" />
</form>	