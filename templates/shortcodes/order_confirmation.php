<?php
$Konnektive = new Konnektive();
if (filter_has_var(INPUT_GET, 'orderId')):
    $orderId = filter_input(INPUT_GET, 'orderId');
    $response = $Konnektive->queryOrder($orderId);
    if (is_object($response)):
        $orderDetails = $response->data[0];
    else:
        die('Sorry, there was a problem with the order ID speicifed');
    endif;
else:
    die('Err: Order ID is required');
endif;

$date = date_create($orderDetails->dateCreated);
$orderDate = date_format($date, "F j, Y");
?>
<div class="st-confirmation-wrap confirmation-container container wrap p8-overide text-center">
    <h1>Thank You, Your Order Is Complete</h1>

    <h3 class="header-highlight text-center">Choose Your First FREE Bonus</h3><br>
    <div id='Qjp4zv5m' style="text-align:center; background-color:#fff"></div>
    <script type='text/javascript' src='https://tpn134.com/res/carry/v2/?v=overrideEmail&is=https%3A%2F%2Ftpn134.com%2Faslt%2FSkin%2FLoader%3Floadinfo%3DScyZJPKDfbfCFZRMrLQBjdyoirBkKK8Sor10Wx%252F79bE%253D'></script>
    

    <div class="receipt-container">
        <h3 class='header-highlight text-center mt-5'><i class="fa fa-check" aria-hidden="true"></i> Your Order Receipt:</h3>
        <!--  RECEIPT REGION -->
        <div class="order-details mt-3">
            <div class="row">
                <div class="col-md-12" >
                    <h3>
                        Order #: <?= $orderDetails->orderId; ?> <br />
                        Date Ordered: <?= $orderDate; ?> <br />
                    </h3>
                </div>
                <div class="col-md-12">
                    <p class="text-left">If you are not happy about our product for any reason, you can cancel at any time. Just send us an email and we will process your refund right away without any hassle...</p>
                </div>
                <div class="col-md-12 order-summary">
                    <div class="product-details">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">Product</div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">Price</div>
                        </div>
                        <?php foreach ($orderDetails->items as $item) : ?>
                            <div class="row">
                                <div class="col-md-8 col-sm-8 text-left"><?= $item->name; ?></div>
                                <div class="col-md-4 col-sm-4 text-right">$<?= $item->price; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div> 
                    <div class="order-total">   
                        <div class="row">
                            <div class="col-md-6  col-sm-6 col-xs-6 bold text-left" >Subtotal: </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right" >$<?= $orderDetails->price; ?></div>

                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">Shipping: </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">$<?= $orderDetails->baseShipping; ?></div>

                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">Total:</div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">$<?= $orderDetails->price + $orderDetails->baseShipping; ?></div>

                        </div>  
                    </div>
                </div>
                <div class="col-sm-12 ">
                    <div class="row shipping-details">
                        <div class="col-sm-12">
                            <h3> SHIPPING INFORMATION </h3>
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-6 text-left" >First Name:</div>

                        <div class="col-md-4 col-sm-4 col-xs-6 text-left" ><?= $orderDetails->shipFirstName; ?></div>

                        <div class="col-md-8 col-sm-8 col-xs-6 text-left" >Last Name:</div>

                        <div class="col-md-4 col-sm-4 col-xs-6 text-left" ><?= $orderDetails->shipLastName; ?></div>

                        <div class="col-md-8 col-sm-8 col-xs-6 text-left" >Address:</div>

                        <div class="col-md-4 col-sm-4 col-xs-6 text-left" ><?= $orderDetails->shipAddress1; ?></div>

                        <div class="col-md-8 col-sm-8 col-xs-6 text-left" >City:</div>

                        <div class="col-md-4 col-sm-4 col-xs-6 text-left" ><?= $orderDetails->shipCity; ?></div>

                        <div class="col-md-8 col-sm-8 col-xs-6 text-left" >State:</div>

                        <div class="col-md-4 col-sm-4 col-xs-6 text-left" ><?= $orderDetails->shipState; ?></div>

                        <div class="col-md-8 col-sm-8 col-xs-6 text-left" >Zip Code:</div>

                        <div class="col-md-4 col-sm-4 col-xs-6 text-left" ><?= $orderDetails->shipPostalCode; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="thanks-notice text-left mt-5">

            <p>Thank you for your order!</p>

            <p>Your order has been successfully processed. You will receive an email as soon as your order ships in the next 2-3 business days with a tracking number. Please keep an eye on your email and make sure to check your spam box if you don't see it. </p>

            <p>You will receive an order confirmation from: support@tacandsurvival.com </p>

            <p>Please look out for this email, it contains important information regarding your order. If you do not see it please check your spam folder, sometimes things get mislabeled. I'll be sending you more important information so please make sure to add <a href="mailto:support@tacandsurvival.com"> support@tacandsurvival.com</a> to your address book/whitelist to ensure you receive them all.</p>

            <p>If you're having trouble finding the email please feel free to contact support via the link below</p>

            <p>You will see this charge on your credit card under our parent company: <b>TACTICAL 888-919-3614</b></p>

            <p>If you have any questions at all please feel free to click the Support button below and we'd be happy to assist you.</p>

        </div>

    </div>

    <h3 class="header-highlight"><i class="fa fa-lock" aria-hidden="true"></i> Our Guarantee:</h3>
    <div class="pt-5">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="https://s3.amazonaws.com/csmtest/new_assets/seal1.png">
            </div>
            <div class="col-md-9 no-question-guarantee">
                <h3 style="">No Questions Asked Guarantee</h3>
                <p class="text-left">If you are not happy about our product for any reason, you can cancel at any time. Just send us an email and we will process your refund right away without any hassle...</p>
            </div>

        </div>

    </div>

    <div class="any-questions">           
        <div class="row">
            <div class="col-md-12 text-center">
                <h4><strong>Got a question? Ask us!</strong></h4>
                <a class="btn btn-primary btn-block btn-lg" href="https://aliveaftercrisis.zendesk.com/hc/en-us/requests/new" target="_blank">Get Support</a>
            </div>
        </div>
    </div>
</div>

</div>