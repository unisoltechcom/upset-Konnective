<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css">
<script type="text/javascript" async="" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.min.js"></script>
<!-- Facebook Pixel Code: Add To Cart-->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '329517360726100');
fbq('track', "PageView");</script>
<script>fbq('track', 'AddToCart', {value: '0.01', currency: 'CAD'})</script>
<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=329517360726100&ev=PageView&noscript=1" />
</noscript>
<!-- End Facebook Pixel Code -->
<?php

$parameter = $_SERVER['QUERY_STRING'];
$bumpamount = '0.99';
$onebook = '3.95';
$twobooks = '13.95';
$threebooks = '9.95';

$insurance = '0.00';

?>
<style>
    p {
    margin: 0 0 1px;
}
.section-square {
    background-color: #ffff99;
    border: 3px dashed #000;
    padding: 10px;
    margin-top: 5px;
}
.p2o-section-div.section-2 .row.sec-2-col {
    padding: 20px 3px;
}
.p2o-colored-div img {
    margin: 5px auto;
}

</style>
<!-- forms and payments -->
<div class="wrap p2o-colored-div">
    <div class="p2o-section-div section-1">
        <div class="section-1-2">
            <h4>Due To Limited Stock You Must Claim Your Free Book Before The Timer Runs Out</h4>
            <table style="width:20%;">
                <tr id="clockrow">
</tr>
                <tr>
                    <td>HOUR</td>
                    <td></td>
                    <td >MINUTES</td>
                    <td></td>
                    <td>SECONDS</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="p2o-section-div section-2">
        <div id="error_msg" style="color:red; font-size: 17px; font-weight: bold; margin-left: 29px;"></div>
        <div class="row sec-2-col">
            <!-- start of form -->
            <form method="post" id="chkForm">
                <input type="hidden" name="product_name" id="product_name" value="2nd Amendment Rights!">
                <input type="hidden" name="step" value="singlestep" />
                <input type="hidden" id="product" name="product1_id" value="251" />
                <input type="hidden" id="digital" name="product2_id" />
                <input type="hidden" id="cart" name="cartsource" value="8320v2"  />
                <input type="hidden" id="buy" name="purchase" value="3"  />
                <input type="hidden" name="product3_id" />
                <input type="hidden" name="affId" value="<?php if (isset($_SESSION['affId'])) {
                                                            echo $_SESSION['affId'];
                                                        } ?>" />
                                                            <input type="hidden" name="sessionId" value="<?php if (isset($_SESSION['sesid'])) {
                                                                                                            echo $_SESSION['sesid'];
                                                                                                        } ?>" />
                <input type="hidden" name="sourceValue1" value="<?php if (isset($_SESSION['c1'])) {
                                                                    echo $_SESSION['c1'];
                                                                } ?>" />
                <input type="hidden" name="sourceValue2" value="<?php if (isset($_SESSION['c2'])) {
                                                                    echo $_SESSION['c2'];
                                                                } ?>" />
                <input type="hidden" name="sourceValue3" value="<?php if (isset($_SESSION['c3'])) {
                                                                    echo $_SESSION['c3'];
                                                                } ?>" />
                <div class="col-md-6 col-left">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <img src="<?php print get_home_url();?>/wp-content/uploads/2018/03/01-2nd-Amendment-Rights-version-03-1.png" class="img-responsive"/>
                            </div>
                            <p style="font-size: 24px;"><strong>60 Day Money Back Guarantee</strong></p>

                            <p>If you're not completely satisfied with 2nd Amendment Rights! just let us know and we'll gladly refund you 100% of the shipping charge, that's how confident I am that you'll love this book!</p>
                            <br />
                        </div>
                    </div>
                    <br>
                     <div class="col-md-7">
                         <span><strong>Item</strong></span>
                     </div>
                     <div class="col-md-4" style="text-align:right;">
                         <span><strong>Price</strong></span>
                     </div>

                   <div class="col-md-11">
                        <hr>
                   </div>
                    <table>

                        <tr>
                            <td>
                                <input style="width:auto;margin-left: 10px;" name="radio" type="radio" id="1book">
                                <label style="margin-left: 10px;">1 Copy - FREE + S&amp;H</label>
                            </td>
                            <td style="text-align:right;"><label>$<?php echo $onebook; ?> S&H </label></td>
                        </tr>
                        <tr>
                            <td>
                                <input style="width:auto;margin-left: 10px;" name="radio" type="radio" id="2books">
                            <label style="margin-left: 10px;">2 Copies	- 1 FREE, 2ND COPY $10</label></td>
                            <td style="text-align:right;"><label>$<?php echo $twobooks; ?> (Incl. S&amp;H)</label></td>
                        </tr>
                        <tr class="section-square">
                            <td>
                                <input style="width:auto; margin-left: 10px;" name="radio" type="radio" id="3books" checked><label style="margin-left: 10px;"> <strong style="color:red;">BEST DEAL...</strong> <strong>NOVEMBER SPECIAL! </strong> <br>  3 COPIES <strike style="color:red;">$23.95</strike> </label>
                            </td>
                           <td style="text-align:right;"><label>$<?php echo $threebooks; ?> + FREE SHIPPING!&nbsp;</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input style="width:auto;margin-left: 10px;" name="radio" type="radio" id="4books">
                              <label style="margin-left: 10px;">4 Copies	- 1 FREE, ADD'L COPIES $10</label></td>
                            <td style="text-align:right;"><label>$<?php echo "33.95"; ?> (Incl. S&H) </label></td>
                        </tr>

                    </table>
                    <br>
                    <h4><b>Step #1: </b>Contact Information</h4>
                    <hr>
                    <table>
                        <tr>
                            <td>
                                <label>First Name:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" required name="firstName" placeholder="First Name...">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Last Name:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" required name="lastName" placeholder="Last Name..">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email Address:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input name="emailAddress" class="elInput elInput100 elAlign_left elInputBG1 elInputBR5 elInputI0 elInputIBlack elInputIRight elInputStyle1 elInputSmall required1" type="text" placeholder="Email Address..." value="<?php echo $_GET['email']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Phone Number:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" required name="phoneNumber" placeholder="Phone Number...">
                            </td>
                        </tr>
                    </table>
 <div class="col-md-12">
                               <img src="https://s3.amazonaws.com/csm/2nd+Amendment+Certificate.jpg" class="img-responsive"/>
                    </div>   
                </div>
                <div class="col-md-6 col-left ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <img src="https://s3.amazonaws.com/csm/ups-usps.jpg" class="img-responsive"/>
                            </div>
                            <div class="col-md-7">
                            <p style="font-size:24px;"><strong>UPS Express Shipped</strong></p>
                            <span><b>- FREE</b> Copy Of 2nd Amendment Rights!</span>
                            <br />
                            <span><b>- FREE</b> Acclaimed Training Series "Bug-Out Bag Essentials"</span>
                            <br />
                            <span><b>- FREE</b> 3 MORE SURPRISE BONUSES!</span>
                            <br />
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4><b>Step #2: </b>Shipping Address</h4>
                    <div class="row">



    <div class="col-md-12" style="margin-top:5px">

        <input type="text" required="" name="address1" placeholder="Street Address...">

    </div>



    <div class="col-md-12" style="margin-top:9px">

        
        <input type="text" required="" name="city" placeholder="City...">

    </div>


    <div class="col-md-8"style="margin-top:9px">

        
        <input type="text" required="" name="state" placeholder="State / Province...">

    </div>

    <div class="col-md-4"style="margin-top:9px">

       
        <input type="text" required="" name="postalCode" placeholder="Zip Code">

    </div>

    <div class="col-md-12" style="margin-top:9px">

        <select required="" name="country" style="padding: 12px 18px;
									width: 100%;
									border-radius: 5px;
									line-height: 24px;
									border: 1px solid rgba(0, 0, 0, 0.2);
                                    box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05) !important;">
            <option>Select Country</option>
            <option value="US">USA</option>
            <option value="CA">CANADA</option>
        </select>

    </div>


</div>


                    <br>
                    <div class="col-md-12 col-right" style="padding: 0px 20px 0px 0px;">
                    <h4><b>Step #3:</b> Ship My Free Book!</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <h5>Credit Card Number:</h5>
                            <input type="text" class="card-number" required name="cardNumber" placeholder="Card number" maxlength='16' pattern="\d*">
                        </div>
                        <div class="col-md-3">
                            <h5>CVC Code:</h5>
                            <input type="text" class="card-cvc" required name="cardSecurityCode" placeholder="CVC">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h5>Expiry Month:</h5>
                            <select class="card-expiry-month"  name="cardMonth" style="-webkit-appearance: menulist;">
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
                        <div class="col-md-5">
                            <h5>Expiry Year:</h5>
                            <select class="card-expiry-year"  name="cardYear" style="-webkit-appearance: menulist;">

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
                    <hr>
                    <div class="section-2-1">
                        <div class="section-2-1-1">
                            <span><img src="https://images.clickfunnels.com/old-public-templates/listhacking-sales/images/arrow-flash-small.gif"></span>
                            <span><input type="checkbox" id="digital-check" /></span>
                            <span><label>Add A Digital Copy For Just A Buck!</label></span>
                        </div>
                        <p><span>The digital version of the book sells for $47 EVERYDAY!</span>: Because we’re down to our last few books, we’re giving away the digital copy for just 99 cents! Grab one so you can print off multiple copies and hand them out to your friends! Plus, access the book from your smartphone ANYTIME, ANYWHERE (you never know when you"ll need it!) And If you ever lose your book, or lend it out, a new one is only a click away on your computer, or phone. Plus you"ll have instant access - you can read the book in under 2 minutes from now!</p>
                    </div>
                    <table>
                        <tr>
                            <td>Item</td>
                            <td>Amount</td>
                        </tr>
                        <tr id="book1" style="display: none;">
                            <td>
                                <label style="margin-left: 10px;">2nd Amendment Rights! - FREE</label>
                            </td>
                            <td style="text-align:right;">$<?php echo $onebook; ?> S&H </td>
                        </tr>
                        <tr style="display: none;" id="book2">
                            <td>
                                <label style="margin-left: 10px;">2 Copies of 2nd Amendment Rights!</label>
                            </td>
                            <td style="text-align:right;">$<?php echo $twobooks; ?></td>
                        </tr>
                        <tr id="book3">
                            <td>
                                <label style="margin-left: 10px;"> 3 Copies of 2nd Amendment Rights! - FREE SHIPPING</label>
                            </td>
                           <td style="text-align:right;">$<?php echo $threebooks; ?></td>
                        </tr>
                        <tr id="book4" style="display: none;">
                            <td>
                                <label style="margin-left: 10px;"> 4 Copies (First Copy FREE, Add'l Copies $10)</label>
                            </td>
                           <td style="text-align:right;">$<?php echo "33.95"; ?></td>
                        </tr>
                        <tr style="display: none;" id="bumpamount2">
                            <td>
                                <label>2nd Amendment Rights! (Digital)</label>
                            </td>
                            <td style="text-align:right;">$<?php echo $bumpamount; ?></td>
                        </tr>
                    </table>
                    <button class="submit-button" type="submit">
                        Please Ship My Free Books Today!
                        <span>(And send me 3 MORE FREE unadvertised bonuses!)</span>
                    </button>
                    <div class="section-2-2">
                        <!-- <img src="../securecheckout-2/img/insure_ship.png" alt="" class=""/> -->
                        <img src="https://s3.amazonaws.com/csmtest/credit_cards-stripe.png">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="https://s3.amazonaws.com/csmtest/grey-lock.png">
                            </div>
                            <div class="col-md-10">
                                <h3>Secure Payment</h3>
                                <p>
									All orders are through a very secure network.
									Your credit card information is never stored in any way.
									We respect your privacy... </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- end of form -->
            </form>
        </div>
    </div>
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
<style>#clockrow td {
    font-weight: bold;
}

.is-loading .loader-modal {
    display: flex;
}

.loader-modal {
    display: none;
    background-color: rgba(0,0,0,0.25);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    align-items: center;
    z-index: 1;
}

.loader-component {
    display: flex;
    flex-direction: column-reverse;
    justify-content: center;
    align-items: center;
    background: #fff;
    box-shadow: 0px 0px 3px rgba(0, 0, 0, .2);
    padding: 40px;
    margin: 111px;
}

.loader-component__text {
    flex: none;
    font-size: 1.3rem;
    font-family: sans-serif;
    line-height: 1.4rem;
    color: #0f1e31;
}

.loader-component__spinner {
    flex: none;
    width: 70px;
    height: 70px;
    position: relative;
    margin-right: 30px;
}

.loader-component__spinner-child {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
}

.loader-component__spinner-child:before {
    content: '';
    display: block;
    margin: 0 auto;
    width: 15%;
    height: 15%;
    background-color: #343436;
    border-radius: 100%;
    -webkit-animation: loaderAnim 1.2s infinite ease-in-out both;
    animation: loaderAnim 1.2s infinite ease-in-out both;
}

.spinner-circle2 {
    -webkit-transform: rotate(30deg);
    transform: rotate(30deg);
}

.spinner-circle3 {
    -webkit-transform: rotate(60deg);
    transform: rotate(60deg);
}

.spinner-circle4 {
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
}

.spinner-circle5 {
    -webkit-transform: rotate(120deg);
    transform: rotate(120deg);
}

.spinner-circle6 {
    -webkit-transform: rotate(150deg);
    transform: rotate(150deg);
}

.spinner-circle7 {
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
}

.spinner-circle8 {
    -webkit-transform: rotate(210deg);
    transform: rotate(210deg);
}

.spinner-circle9 {
    -webkit-transform: rotate(240deg);
    transform: rotate(240deg);
}

.spinner-circle10 {
    -webkit-transform: rotate(270deg);
    transform: rotate(270deg);
}

.spinner-circle11 {
    -webkit-transform: rotate(300deg);
    transform: rotate(300deg);
}

.spinner-circle12 {
    -webkit-transform: rotate(330deg);
    transform: rotate(330deg);
}

.spinner-circle2:before {
    -webkit-animation-delay: -1.1s;
    animation-delay: -1.1s;
}

.spinner-circle3:before {
    -webkit-animation-delay: -1s;
    animation-delay: -1s;
}

.spinner-circle4:before {
    -webkit-animation-delay: -0.9s;
    animation-delay: -0.9s;
}

.spinner-circle5:before {
    -webkit-animation-delay: -0.8s;
    animation-delay: -0.8s;
}

.spinner-circle6:before {
    -webkit-animation-delay: -0.7s;
    animation-delay: -0.7s;
}

.spinner-circle7:before {
    -webkit-animation-delay: -0.6s;
    animation-delay: -0.6s;
}

.spinner-circle8:before {
    -webkit-animation-delay: -0.5s;
    animation-delay: -0.5s;
}

.spinner-circle9:before {
    -webkit-animation-delay: -0.4s;
    animation-delay: -0.4s;
}

.spinner-circle10:before {
    -webkit-animation-delay: -0.3s;
    animation-delay: -0.3s;
}

.spinner-circle11:before {
    -webkit-animation-delay: -0.2s;
    animation-delay: -0.2s;
}

.spinner-circle12:before {
    -webkit-animation-delay: -0.1s;
    animation-delay: -0.1s;
}

@-webkit-keyframes loaderAnim {
    0%,
    100%,
    80% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }

    40% {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}

@keyframes loaderAnim {
    0%,
    100%,
    80% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }

    40% {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}</style>
<!-- loading area -->
<div class="landing-loading" id="landing-loading">
    <div class="loading-section">
        <h3>Processing...</h3>
        <i class="fa fa-spinner fa-spin"></i>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){

		$('#chkForm').submit(function(){
			console.log("submit enabled");
			 console.log("submit enabled");
                $('#loader-modal').show();


		});

	});



       (function(e,a){

           var t,r=e.getElementsByTagName("head")[0],c=e.location.protocol;

           t=e.createElement("script");t.type="text/javascript";

           t.charset="utf-8";t.async=!0;t.defer=!0;

           t.src=c+"//front.optimonk.com/public/"+a+"/js/preload.js";r.appendChild(t);

       })(document,"14547");
       	$('document').ready(function(){


	      var sec;
	      var min;
	      var hr;
	      var running = true;
	      var clock = document.getElementById("clockrow");

	      function ResetClock()
	      {
	        var form = $("#form-payment").attr('data-payment');

	        if(form == '4'){
	           sec = 59;
	           min = 1;
	           hr = 0;
	        }
	        else{
	          sec = 59;
	          min = 29;
	          hr = 0;
	        }
	      }

	      function StartCountDown()
	      {
	        sec--;
	        if(sec < 0)
	        {
	          sec = 59;
	          min--;
	          if(min < 0)
	          {
	            clearInterval(timeinterval);
	            running = false;
	          }
	        }
	        if(running)
	        {
	          clock.innerHTML = '<td> 0'+ hr + '</td>' +
	                            '<td> : </td>' +
	                            '<td>' + ((min<10) ? "0"+min:min) + '</td>' +
	                            '<td> : </td>' +
	                            '<td>' + ((sec<10) ? "0"+sec:sec) + '</td>';
	        }
	      }

	      ResetClock();
	      timeinterval = setInterval(StartCountDown, 1000);


		   $("#digital-check").click(function () {
            if ($(this).is(":checked")) {
                $("#digital").val(88);
				$("#bumpamount2").show();

            }
			else {
				$("#digital").val('');
				$("#bumpamount2").hide();
			}
            });

            $("#2books").click(function() {
                if ($(this).is(':checked')) {
                    $('#product').val(250);
                    $('#buy').val(2);
                    $('#book1').hide();
                    $('#book3').hide();
                    $('#book4').hide();
					$('#book2').show();
                    }
            });
            $("#1book").click(function() {
                if ($(this).is(':checked')) {
                    $('#product').val(87);
                    $('#buy').val(1);
                    $('#book2').hide();
                    $('#book3').hide();
                    $('#book4').hide();
					$('#book1').show();

                    }
            });

            $("#3books").click(function() {
                if ($(this).is(':checked')) {
                    $('#product').val(251);
                    $('#buy').val(3);
                    $('#book2').hide();
                    $('#book1').hide();
                    $('#book4').hide();
                    $('#book3').show();
                    }
            });
            $("#4books").click(function() {
                if ($(this).is(':checked')) {
                    $('#product').val(252);
                    $('#buy').val(4);
                    $('#book2').hide();
					$('#book1').hide();
                    $('#book3').hide();
                    $('#book4').show();
                    }
            });




		});

	<?php if (isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg'])) { ?>
		alert('<?php echo $_SESSION['error_msg']; ?>');
	<?php unset($_SESSION['error_msg']);
} ?>

   </script>
