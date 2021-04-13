<?php
$trn_status = (isset($_SESSION['trn_status'])) ? filter_var($_SESSION['trn_status']) : NULL;
if ($trn_status === "0")
    $post_data = (isset($_SESSION['post_data'])) ? filter_var_array($_SESSION['post_data']) : NULL;

$display_message = (isset($_SESSION['display_message'])) ? filter_var($_SESSION['display_message']) : NULL;
if ($trn_status === "0" && $display_message == 1):
    ?>
    <script>
        $error_msg = "<?php echo (isset($_SESSION['trn_error_message']))? '[' . $_SESSION['trn_error_message'] . ']' : ''; ?>";
        swal({
            title: "Transaction Declined ",
            text: "Sorry, your payment was declined. Please review your payment method or please try a different card. " + $error_msg,
            //icon: "error",
            button: "OK"
        });
    </script>
    <?php
    unset($_SESSION['display_message'], $_SESSION['trn_error_message']);
endif;
?>

<?php
$bumpamount = '0.99';
$onebook = '3.95';
$twobooks = '9.95';
$threebooks = '9.95';

$insurance = '0.00';
?>

<!-- start of form -->
<div class="container st-checkout-shortcode-container">
    <form method="post" id="chkForm">
        <?php 
        global $post;
        $page_variation = !empty(get_post_meta($post->ID, 'st_page_variation')) ? get_post_meta($post->ID, 'st_page_variation') : ''; // This will output page variation that is defined page edit section in WordPress dashboard 
        $product_id1 = !empty(get_post_meta($post->ID, 'st_page_product_id_1')) ? get_post_meta($post->ID, 'st_page_product_id_1') : ''; // This will output page product id 1 that is defined page edit section in WordPress dashboard 
        $page_id = get_queried_object_id();
        $current_page =  get_post_field( 'post_name', $page_id );
        ?>
        <input type="hidden" name="product_name" id="product_name" value="2nd Amendment Rights!">
        <input type="hidden" name="step" value="checkout" />
        <input type="hidden" id="product" name="product1_id" value="231" />
        <input type="hidden" id="product1" name="orderdetails" value="<?= is_array($product_id1) ? $product_id1[0] : $product_id1;   ?>" />
        <input type="hidden" id="current_page" name="current_page" value="<?= $current_page; ?>" />
        <input type="hidden" id="digital" name="product2_id" />
        <input type="hidden" id="cart" name="cartsource" value="8320v1"  /><!-- !!!NEEDS CLARIFICATION FROM MIKE!!! -->
        <input type="hidden" name="var" value="<?= is_array($page_variation) ? $page_variation[0] : '';   ?>" />
        <input type="hidden" id="buy" name="purchase" value="3"/>
        <input type="hidden" name="product3_id" />
        <input type="hidden" name="affId" value="<?= (isset($_SESSION['affId'])) ? $_SESSION['affId'] : ''; ?>" />
        <input type="hidden" name="sourceValue1" value="<?= (isset($_SESSION['c1'])) ? $_SESSION['c1'] : ''; ?>" />
        <input type="hidden" name="sourceValue2" value="<?= (isset($_SESSION['c2'])) ? $_SESSION['c2'] : ''; ?>" />
        <input type="hidden" name="sourceValue3" value="<?= (isset($_SESSION['c3'])) ? $_SESSION['c3'] : ''; ?>" />

        <div class="row">
            <div class="col-md-6 col-sm-12 pr-4">
                <div class="st-table order-summary-table">
                    <table>
                        <thead>
                            <tr>
                                <th align="left">Item</th>
                                <th align="right">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input name="radio" type="radio" id="1book"><label >2nd Amendment Rights! - FREE</label>
                                </td>
                                <td><label>$<?php echo $onebook; ?> S&H </label></td>
                            </tr>
                            <tr>
                                <td>
                                    <input  name="radio" type="radio" id="2books"><label >2 Copies of 2nd Amendment Rights! - FREE</label>
                                </td>
                                <td><label>$<?php echo $twobooks; ?> S&H </label></td>
                            </tr>
                            <tr class="section-square">
                                <td>
                                    <input  name="radio" type="radio" id="3books" checked><label> <strong>BEST DEAL!</strong> <br>  3 Copies of 2nd Amendment Rights! - FREE</label>
                                </td>
                                <td><label>$<?php echo $threebooks; ?> S&H </label></td>
                            </tr>
                            <tr>
                                <td>
                                    <input  name="radio" type="radio" id="4books">
                                    <label >4 Copies	- 1 FREE, ADD'L COPIES $10</label>
                                </td>
                                <td><label>$<?php echo "33.95"; ?> (Incl. S&H) </label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="user-deatils">
                    <h4><b>Step #1: </b>Contact Information</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-12 col-form-label">First name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="fname" required  name="firstName" placeholder="First Name..." value="<?php echo ($trn_status == 0 && isset($post_data['firstName'])) ? $post_data['firstName'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-12 col-form-label">Last Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="lname" required  name="lastName" placeholder="Last Name.."  value="<?php echo ($trn_status == 0 && isset($post_data['lastName'])) ? $post_data['lastName'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-12 col-form-label">Email Address</label>
                        <div class="col-sm-12">
                            <input id="email" required name="emailAddress" class="elInput elInput100 elAlign_left elInputBG1 elInputBR5 elInputI0 elInputIBlack elInputIRight elInputStyle1 elInputSmall required1 form-control" type="email" placeholder="Email Address..." value="<?php echo (isset($post_data['emailAddress'])) ? $post_data['emailAddress'] : filter_input(INPUT_GET, 'email'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Phone Number</label>
                        <div class="col-sm-12">
                            <input id="phone" type="text" required name="phoneNumber" class="form-control" placeholder="Phone Number..." value="<?php echo ($trn_status == 0 && isset($post_data['phoneNumber'])) ? $post_data['phoneNumber'] : ''; ?>">
                        </div>
                    </div>
                </div>
                <div class="mb-guarantee">
                    <img class="d-block mx-auto" src="<?php echo plugins_url('funnel-settings'); ?>/assets/images/2nd-Amendment-Certificate.jpg'; ?>" alt="Money Back Guarantee certificate" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12 pl-4">
                <div class="shipping-details">
                    <h4><b>Step #2: </b>Shipping Address</h4>
                    <div class="form-group row">
                        <!-- <label for="street" class="col-sm-3 col-form-label">Street Address</label> -->
                        <div class="col-sm-12">
                            <input id="street" class="form-control" type="text" required="" name="address1" placeholder="Street Address..." value="<?php echo ($trn_status == 0 && isset($post_data['address1'])) ? $post_data['address1'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- <label for="city" class="col-sm-3 col-form-label">City</label> -->
                        <div class="col-sm-12">
                            <input id="city" type="text" class="form-control" required="" name="city" placeholder="City..." value="<?php echo ($trn_status == 0 && isset($post_data['city'])) ? $post_data['city'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- <label for="state" class="col-sm-3 col-form-label">State / Province</label> -->
                        <div class="col-sm-8">
                            <input id="state" class="form-control" type="text" required="" name="state" placeholder="State / Province..." value="<?php echo ($trn_status == 0 && isset($post_data['state'])) ? $post_data['state'] : ''; ?>">
                        </div>
                        <div class="col-sm-4">
                            <input id="postalcode" class="form-control" type="text" required="" name="postalCode" placeholder="Zip Code" value="<?php echo ($trn_status == 0 && isset($post_data['postalCode'])) ? $post_data['postalCode'] : ''; ?>">
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <!-- <label for="country" class="col-sm-3 col-form-label">country</label> -->
                        <div class="col-sm-12">
                            <select required name="country" class="form-control" id="country">
                                <option value="">Select Country</option>
                                <option value="US" <?php echo ($trn_status == 0 && isset($post_data['country']) && $post_data['country'] == 'US') ? 'selected="selected"' : ''; ?>>USA</option>
                                <option value="CA" <?php echo ($trn_status == 0 && isset($post_data['country']) && $post_data['country'] == 'CA') ? 'selected="selected"' : ''; ?>>CANADA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="process-checkout mt-3">
                    <h4><b>Step #3:</b> Ship My Free Book!</h4>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <div class="row">
                                <label for="cardnumber" class="col-sm-12 col-form-label">Card Number</label>
                                <div class="col-sm-12">
                                    <input id="cardnumber" type="text" class="card-number form-control" required name="cardNumber" placeholder="Card number" maxlength='16' pattern="\d*">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group row">
                                <label for="cardcvc" class="col-sm-12 col-form-label">CVC Code</label>
                                <div class="col-sm-12">
                                    <input id="cardcvc" type="text" class="card-cvc form-control" required name="cardSecurityCode" placeholder="CVC">
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <div class="row">
                                <label for="expires" class="col-sm-12 col-form-label">Expiry Month</label>
                                <div class="col-sm-12">
                                    <select id="expires" class="card-expiry-month form-control"  name="cardMonth" style="-webkit-appearance: menulist;">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="row">
                                <label for="exyear" class="col-sm-12 col-form-label">Expiry Month</label>
                                <div class="col-sm-12">
                                    <select id="exyear" class="card-expiry-year form-control"  name="cardYear" style="-webkit-appearance: menulist;">
                                        <option value='2018'>2018</option>
                                        <option value='2019'>2019</option>
                                        <option value='2020'>2020</option>
                                        <option value='2021'>2021</option>
                                        <option value='2022'>2022</option>
                                        <option value='2023'>2023</option>
                                        <option value='2024'>2024</option>
                                        <option value='2025'>2025</option>
                                        <option value='2026'>2026</option>
                                        <option value='2027'>2027</option>
                                        <option value='2028'>2028</option>
                                        <option value='2029'>2029</option>
                                        <option value='2030'>2030</option>
                                        <option value='2031'>2031</option>
                                        <option value='2032'>2032</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="digital-copy-wrap mt-4">
                    <div class="digital-copy mt-2">
                        <div class="dc-block">
                            <span><img src="<?php echo plugins_url('funnel-settings'); ?>/assets/images/arrow-flash-small.webp"></span>
                            <span><input type="checkbox" id="digital-check" /></span>
                            <span><label>Add A Digital Copy For Just A Buck!</label></span>
                        </div>
                        <p><span>The digital version of the book sells for $47 EVERYDAY!</span>: Because we’re down to our last few books, we’re giving away the digital copy for just 99 cents! Grab one so you can print off multiple copies and hand them out to your friends! Plus, access the book from your smartphone ANYTIME, ANYWHERE (you never know when you"ll need it!) And If you ever lose your book, or lend it out, a new one is only a click away on your computer, or phone. Plus you"ll have instant access - you can read the book in under 2 minutes from now!</p>
                    </div>
                </div>
                <div class=" st-table order-addons-summary mt-3">
                    <table>
                        <thead> 
                            <tr>
                                <th>Item</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="book1" style="display: none;">
                                <td>
                                    <label >2nd Amendment Rights! - FREE</label>
                                </td>
                                <td>$<?php echo $onebook; ?> S&H </td>
                            </tr>
                            <tr style="display: none;" id="book2">
                                <td>
                                    <label >2 Copies of 2nd Amendment Rights! - FREE</label>
                                </td>
                                <td>$<?php echo $twobooks; ?> S&H </td>
                            </tr>
                            <tr id="book3">
                                <td>
                                    <label > 3 Copies of 2nd Amendment Rights! - FREE</label>
                                </td>
                                <td>$<?php echo $threebooks; ?> S&H </td>
                            </tr>
                            <tr id="book4" style="display: none;">
                                <td>
                                    <label > 4 Copies (First Copy FREE, Add'l Copies $10)</label>
                                </td>
                                <td>$<?php echo "33.95"; ?></td>
                            </tr>
                            <tr style="display: none;" id="bumpamount2">
                                <td>
                                    <label>2nd Amendment Rights! (Digital)</label>
                                </td>
                                <td>$<?php echo $bumpamount; ?></td>
                            </tr>
                        <tbody>
                    </table>
                </div>
                <div class="checkout mt-3">
                    <button class="submit-button d-block w-100" type="submit">Please Ship My Free Books Today! <span> (And send me 3 MORE FREE unadvertised bonuses!) </span></button>
                </div>
                <div class="secure-payment mt-4">
                    <div class="row">
                        <div class="col-md-12 pay-method">
                            <img src="<?php echo plugins_url('funnel-settings'); ?>/assets/images/credit_cards-stripe.png" class="d-block mx-auto" alt="Payment Methods">
                        </div>
                        <div class="col-md-2">
                            <img class="d-block mx-auto" src="<?php echo plugins_url('funnel-settings'); ?>/assets/images/grey-lock.png" alt="secure Payment" >
                        </div>
                        <div class="col-md-10 secure-payment-details">
                            <h3>Secure Payment</h3>
                            <p>
                                All orders are through a very secure network.
                                Your credit card information is never stored in any way.
                                We respect your privacy... 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="loader-modal" class="loader-modal">
    <div class="loader-component">
        <div class="loader-component__spinner">
            <div class='spinner-circle1 loader-component__spinner-child'></div>
            <div class='spinner-circle2 loader-component__spinner-child'></div>
            <div class='spinner-circle3 loader-component__spinner-child'></div>
            <div class='spinner-circle4 loader-component__spinner-child'></div>
            <div class='spinner-circle5 loader-component__spinner-child'></div>
            <div class='spinner-circle6 loader-component__spinner-child'></div>
            <div class='spinner-circle7 loader-component__spinner-child'></div>
            <div class='spinner-circle8 loader-component__spinner-child'></div>
            <div class='spinner-circle9 loader-component__spinner-child'></div>
            <div class='spinner-circle10 loader-component__spinner-child'></div>
            <div class='spinner-circle11 loader-component__spinner-child'></div>
            <div class='spinner-circle12 loader-component__spinner-child'></div>
        </div>
        <div class="loader-component__text">
            <h1>Please wait…We are processing your order...</h1>
        </div>
    </div>
</div>
<!-- loading area -->
<div class="landing-loading" id="landing-loading">
    <div class="loading-section">
        <h3>Processing...</h3>
        <i class="fa fa-spinner fa-spin"></i>
    </div>
</div>

<script type="text/javascript">
<?php if (isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg'])) { ?>
        alert('<?php echo $_SESSION['error_msg']; ?>');
    <?php
    unset($_SESSION['error_msg']);
}
?>
</script>
