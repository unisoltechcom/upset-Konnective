<?php
global $post;
$page_variation = !empty(get_post_meta($post->ID, 'st_page_variation')) ? get_post_meta($post->ID, 'st_page_variation') : ''; // This will output page variation that is defined in homepage page edit section in WordPress dashboard
?>
<form name="optin-form" method="POST" action="">
    <input type="hidden" name="step" value="opt-in" />
    <input type="hidden" name="var" value="<?= is_array($page_variation) ? $page_variation[0] : ''; //i.e. 8320LV1   ?>" />
    <input type="hidden" name="sourceValue1" value="<?= isset($_SESSION['c1']) ? $_SESSION['c1'] : ''; ?>" />
    <input type="hidden" name="sourceValue2" value="<?= isset($_SESSION['c2']) ? $_SESSION['c2'] : ''; ?>" />
    <input type="hidden" name="sourceValue3" value="<?= isset($_SESSION['c3']) ? $_SESSION['c3'] : ''; ?>" />
    <input type="hidden" name="affId" value="<?= isset($_SESSION['affId']) ? $_SESSION['affId'] : ''; ?>">    

    <input size="1" type="email" name="email" id="form-field-email" class="elementor-field elementor-size-sm  elementor-field-textual opt-in-email" placeholder="Enter Your Email Here.." required="required" aria-required="true">

    <button class="elementor-button elementor-size-md opt-in-submit" type="submit">Next Enter Your Shipping Address</button>
</form>