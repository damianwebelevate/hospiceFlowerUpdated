<?php
include ('shortcodes.php');

// global variables that change on calling checkTheDate()
// run checkTheDate on loading which has to be in the functions.php
$xmas = 0;
$paddys = 0;

// product id 
define('POINSETTIA_PRODUCT', 2482);
define('SHAMROCK_PRODUCT', 2476);


add_shortcode('sfhVideoEmbed', 'sfhVideoEmbedShortcode');
add_shortcode('sfhVideoOnly', 'sfhVideoOnlyEmbed');

// add theme support
add_action( 'after_setup_theme', 'sfh_add_woocommerce_support' );
function sfh_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

// enqueue styles
add_action( 'wp_enqueue_scripts', 'sfh_enqueue_styles' );
function sfh_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
	wp_enqueue_style( 'fontawesome', 'https://cdn.jsdelivr.net/fontawesome/4.7.0/css/font-awesome.min.css?ver=4.7.0');
}
// enqueue scripts
add_action( 'wp_enqueue_scripts', 'sfh_enqueue_script' );
function sfh_enqueue_script() {
	wp_register_script( 'sfh', get_stylesheet_directory_uri() .'/js/newSFH.js', array('jquery') );
	wp_enqueue_script( 'sfh' );
}

// only allow one item in the basket at a time
add_filter( 'woocommerce_add_to_cart_validation', 'sfh_only_one_in_cart', 99, 2 );
function sfh_only_one_in_cart( $passed, $added_product_id ) {
   wc_empty_cart();
   return $passed;
}
// skip straight to shopping cart
// https://hospicevirtualflowergarden.com/wp-admin/admin.php?page=wc-settings&tab=products
// dont forget to uncheck the Add to basket behaviour page
add_filter('woocommerce_add_to_cart_redirect', 'sfh_add_to_cart_redirect');
function sfh_add_to_cart_redirect() {
 global $woocommerce;
 $checkout_url = wc_get_checkout_url();
 return $checkout_url;
}

// remove the added to cart Message
add_filter( 'wc_add_to_cart_message_html', '__return_null' );

// change the return to shop link
add_filter( 'woocommerce_return_to_shop_redirect', 'sfh_returnToShopLink' );

function sfh_returnToShopLink() {
return site_url('/flower-garden/', 'https');
}

// analytics embed
add_action('wp_head', 'wpb_add_googleanalytics');
function wpb_add_googleanalytics() {
echo '<!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-162455983-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag("js", new Date());gtag("config", "UA-162455983-1");</script>';
}

// add a checkbox to the cart
add_filter('woocommerce_checkout_fields', 'filterWooCheckoutFields');
add_action('woocommerce_checkout_update_order_meta', 'actionWooCheckoutUpdateOrderMeta');
add_filter('woocommerce_email_order_meta_keys', 'filterWooEmailOrderMetaKeys');
function filterWooCheckoutFields($fields) {
    global $woocommerce;
    // add field at end of billing fields section
    $fields['billing']['sfh_mailing_subscribe'] = array(
        'type' => 'checkbox',
        'label' => 'Do you want to subscribe to our mailing list?',
        'placeholder' => 'Subscribe to mailing list',
        'required' => false,
        'class' => array(),
        'label_class' => array(),
    );
    return $fields;
}

function actionWooCheckoutUpdateOrderMeta( $order_id ) {
		global $woocommerce;
		$order = new WC_Order( $order_id );
		$recipient = $order->billing_email;
		$fName = $order->billing_first_name;
		$sName = $order->billing_last_name;
    $subscribe = isset($_POST['sfh_mailing_subscribe']) ? 'yes' : 'no';
		if($subscribe == 'yes'){
			update_post_meta($order_id, 'Subscribe to mailing list', $subscribe);
			doAdminNoticeUserNewsletter($fName, $sName, $recipient);

		}
		return $order_id;
}

function filterEWooEmailOrderMetaKeys( $keys ) {
  $keys[] = 'Subscribe to mailing list';
  return $keys;
}
// displays all related products in 3 rows atm its only 6
add_filter( 'woocommerce_output_related_products_args', 'sfh_related_products_display', 20 );
  function sfh_related_products_display( $args ) {
	$args['posts_per_page'] = 6; // 6 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}


// change the default out of stock message
add_filter( 'woocommerce_get_availability', 'changeDefaultOutOfStockText', 1, 2);
function changeDefaultOutOfStockText( $availability, $_product ) {

    if ( !$_product->is_in_stock() ) {
		$availability['availability'] = __('We are sorry but the flower you are looking for is not available at this time of year.  Many thanks, St. Francis Hospice', 'woocommerce');
		return $availability;
	};
};


// redirect to custom order received page
add_action( 'woocommerce_thankyou', 'sfh_custom_redirect_after_purchase' );
function sfh_custom_redirect_after_purchase( $order_id ) {
	global $wp;
  global $woocommerce;
  $order = new WC_Order( $order_id );
	$recipient = $order->get_billing_email();
	$fName = $order->get_billing_first_name();
  $items = $order->get_items();
  $productName = '';
  $productId = '';
	$images = '';

  foreach($items as $item){
    $productName = $item->get_name();
    $productId = $item->get_product_id();
  }

  $url = returnAnImageURL($productId);
	$linkToGoTo = $url;

	sendEmailReceipt($recipient, $productId, $fName);

   if ( is_checkout() && ! empty( $wp->query_vars['order-received'] ) ) {
     wp_redirect( $linkToGoTo);
   }
	 return $order_id;
}

// returns text based on the id
function returnAnImageURL($productId){
	$returnURL = "";
	switch ($productId) {
		case 48:
		// sunflower
			$returnURL = 'https://hospicevirtualflowergarden.com/sunflower/?id='.$productId;
			break;
		case 1748:
		// camellia
			$returnURL = 'https://hospicevirtualflowergarden.com/camellia/?id='.$productId;
			break;
		case 1955:
		// daisy
			$returnURL = 'https://hospicevirtualflowergarden.com/daisy/?id='.$productId;
		break;
		case 1963:
		// gardenia
			$returnURL = 'https://hospicevirtualflowergarden.com/gardenia/?id='.$productId;
		break;
		case 1970:
		// Red Rose
			$returnURL = 'https://hospicevirtualflowergarden.com/red-rose/?id='.$productId;
		break;
		case 1975:
		// tulip
			$returnURL = 'https://hospicevirtualflowergarden.com/tulip/?id='.$productId;
		break;
		case 1981:
		// Lily
			$returnURL = 'https://hospicevirtualflowergarden.com/lily/?id='.$productId;
		break;
		case 2476:
		// Shamrock
			$returnURL = 'https://hospicevirtualflowergarden.com/shamrock/?id='.$productId;
		break;
		case 2482:
		// Poinsettia
			$returnURL = 'https://hospicevirtualflowergarden.com/poinsettia/?id='.$productId;
		break;
		default:
			// code...
			break;
	}
	return $returnURL;
}
// send an email notification if someone has signed up
function doAdminNoticeUserNewsletter($fName, $sName, $email){
	$subject = 'New Customer Sign Up - Hospice Flower Garden';
	$name = 'Hospice Virtual Flower Garden';
	$to = 'tkeatinge@sfh.ie';
	$headers = 'Content-Type: text/html; charset=UTF-8' ."\r\n";
	$headers .= "From: $name <info@hospicevirtualflowergarden.com>" ."\r\n";
	$message = '<!DOCTYPE html><html lang="en-GB"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>hospicevirtualflowergarden.com</title></head><body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="padding: 0;">
<div id="wrapper" dir="ltr" style="background-color: #ffffff; margin: 0; padding: 70px 0; width: 100%; -webkit-text-size-adjust: none;">';
	$message .= '<h1>New Newsletter Sign up: </h1>';
	$message .= "<p>From: $fName $sName </p>";
	$message .= "<p>$email</p></div></body></html>";
	wp_mail( $to, $subject, $message, $headers);

	return;
}

// new email for consumer function

function sendEmailReceipt($recipient, $productId, $fName){
	$subject = 'Donate, Share and Show you Care';
	$name = 'Hospice Virtual Flower Garden';
	$headers = 'Content-Type: text/html; charset=UTF-8' ."\r\n";
	$headers .= "From: $name <info@hospicevirtualflowergarden.com>" ."\r\n";
	$message = '<!DOCTYPE html><html lang="en-GB"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>hospicevirtualflowergarden.com</title></head><body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="padding: 0;">
<div id="wrapper" dir="ltr" style="background-color: #ffffff; margin: 0; padding: 70px 0; width: 100%; -webkit-text-size-adjust: none;">
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="backgroud-color: #fff;">
	  <tbody>
	    <tr>
	      <td align="center" valign="top">
	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border:1px solid #e5e5e5;border-bottom:none;border-radius:3px">
	  				<tbody>
	            <tr>
	              <td align="center" style="background-color:#ffffff; padding:30px">
	                <img data-imagetype="External" src="https://hospicevirtualflowergarden.com/wp-content/uploads/2020/04/logo.png" width="200">
	              </td>
	            </tr>
	            <tr>
	              <td style="background-color:#ffffff; padding:20px; text-align:center">
	                <h3 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:24px;font-weight:300;line-height:150%;margin:0;text-align:center;color:#000;">Hospice Virtual Flower Garden</h3>
	              </td>
	            </tr>
	            </tr>
	          </tbody>
	        </table>
	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border:1px solid #e5e5e5; border-top: none; border-bottom: none;" >
	          <tbody>
	            <tr>
	              <td valign="top" style="background-color:#ffffff">
	                <table border="0" cellpadding="20" cellspacing="0" width="100%">
	                  <tbody>
	                    <tr>
	                      <td valign="top" style="padding:48px 48px 32px; color: black;">
	                        <img width="600" style="min-width: 300px; max-width: 100%; height: auto;" src="https://hospicevirtualflowergarden.com/wp-content/themes/flowerGarden/viewInBrowser/viewInBrowserGenImage.php/?productId='.$productId.'&fName='.$fName.'" alt="Donate, Share and Show You Care Image">
	                      </td>
	                    </tr>
	                  </table>
	                </td>
	              </tr>
	            </tbody>
	          </table>
	          <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border:1px solid #e5e5e5;border-top:none;border-radius:3px">
	    				<tbody>
	              <tr>
	                <td align="center" style="background-color:#ffffff; padding:30px">
	                </td>
	              </tr>
	              <tr>
	                <td style="background-color:#ffffff; padding:20px; text-align:center">
	                  <p style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;font-weight:300;line-height:150%;margin:0;text-align:center;color:#000;">Copyright <sup>&copy;</sup>'.Date('Y').'<strong> St. Francis Hospice</strong></p>
	                </td>
	              </tr>
	            </tbody>
	          </table>
	        </td>
				</tr>
	  </tbody>
	</table></div></body></html> ';
	wp_mail( $recipient, $subject, $message, $headers);

	return;
}




// dynamic content publish and or display dependant on time of year
// note relys totally on a site visit
// for desplay of date/time
date_default_timezone_set('GMT+0');

// function to check if any given date ie time() is within the xmas paramaters
function checkTheXmasDate($aTimeInUnixFormat){
    $year = date('y');
    $endDateXmas = mktime('0','0','0','12','31',$year);
    $startDateXmas = mktime('0','0','0','10','24',$year);

    $isGreaterThanStartDate = $aTimeInUnixFormat >= $startDateXmas;
    $isLessThanEndDate = $aTimeInUnixFormat <= $endDateXmas;

    if($isGreaterThanStartDate && $isLessThanEndDate){
        return true;
    }else{
        return;
    }
}

// function to check if any given date ie time() is within the paddys parameters
function checkThePaddysDayDates($aTimeInUnixFormat){
    $year = date('y');
    $startDatePaddys = mktime('0','0','0','01','31',$year);
    $endDatePaddys = mktime('0','0','0','03','31',$year);

    $isGreaterThanStartDate = $aTimeInUnixFormat >= $startDatePaddys;
    $isLessThanEndDate = $aTimeInUnixFormat <= $endDatePaddys;

    if($isGreaterThanStartDate && $isLessThanEndDate){
        return true;
    }else{
        return false;
    }
}


// joins the two functions checkTheXmasDate and checkThePaddysDayDates and overrides default values
// for $xmas which is global and can be accessed site wide and for $paddys
function checkTheDate($aTimeInUnixFormat){
    $validXmasDate = checkTheXmasDate($aTimeInUnixFormat);
	$validPaddysDate = checkThePaddysDayDates($aTimeInUnixFormat);
	global $paddys;
	global $xmas;

    if($validXmasDate && !$validPaddysDate){
		$paddys = 0;
		$xmas = 1;
    }elseif(!$validXmasDate && $validPaddysDate){
		$paddys = 1;
		$xmas = 0;
    }else{
		$paddys = 0;
		$xmas = 0;
    }
}

// helper function to visually display the dates used in the code for Xmas
function returnXmasParams(){
    $year = date('y');
    $yearFromNow = $year +1;
    $endDateXmas = mktime('0','0','0','12','31',$year);
    $startDateXmas = mktime('0','0','0','10','24',$year);

    $humanStartDateXmas = date("Y-m-d h:i:sa", $startDateXmas);
    $humanEndDateXmas = date("Y-m-d h:i:sa", $endDateXmas);

    return "<h1>Christmas Period Used in functions</h1><p><strong>Start Date: </strong>".$humanStartDateXmas."</p><p><strong>End Date: </strong>".$humanEndDateXmas."</p>";
}

// helper function to visually display the dates used in the code for paddys
function returnPaddysDayParams(){
    $year = date('y');
    $startDatePaddys = mktime('0','0','0','01','31',$year);
    $endDatePaddys = mktime('0','0','0','03','31',$year);

    $humanStartDatePaddys = date("Y-m-d h:i:sa", $startDatePaddys);
    $humanEndDatePaddys = date("Y-m-d h:i:sa", $endDatePaddys);

    return "<h1>Paddys Day Period Used in functions</h1><p><strong>Start Date: </strong>".$humanStartDatePaddys."</p><p><strong>End Date: </strong>".$humanEndDatePaddys."</p>";
}

// helper function to output user guide - youre welcome
function developerNotes(){
    $string = '<hr>';
    $string .= '<p>To use the functions here we call checkTheDate() and pass in the current time as a timestamp.<p>';
	$string .= '<p> checkTheDate() calls checkTheXmasDates() and calls checkThePaddysDayDates() and returns true for Paddys day and not Xmas, Xmas and not Paddys day and neither xmas or paddys day.</p>';
	$string .= '<p>When a user visits the website checkTheDate is fired and alters the global variables set from an initial state of 0 to one depending on the returning value from the function.</p>';
	$string .= '<p>The flower_garden.php template checks for the global values and outputs the correct template part for the time periods, see below for each list.</p>';
	$string .= '<p>Global variables now mean that we can alter the content / state of the application</p>';
    $string .= '<p>See the following info for defined scheduling for both the xmas and paddys day</p>';
    $string .= returnXmasParams();
    $string .= returnPaddysDayParams();
	$string .= '<hr>';
    echo $string;
}

// a function that takes an id and a stock_status as a parameter
// see defined values above 

function changeStockStatus($productID, $status){  
    update_post_meta($productID, '_stock_status', $status);
}


// immediately call this and the flower garden will check for the relevant period and output the correct list - see flower_garden.php
checkTheDate(time());

controlProductDisplay();
// control product display
function controlProductDisplay(){
	nocache_headers();
	global $xmas;
	global $paddys;
	if(($xmas == 1) && ($paddys == 0)){
		// product id and eiter outofstock or instock
		changeStockStatus(SHAMROCK_PRODUCT, 'outofstock');
    }elseif(($xmas == 0)&&($paddys == 1)){
		changeStockStatus(PONSETTIA_PRODUCT, 'instock');
		changeStockStatus(SHAMROCK_PRODUCT, 'outofstock');
    }else{
		changeStockStatus(SHAMROCK_PRODUCT, 'outofstock');
		changeStockStatus(POINSETTIA_PRODUCT, 'outofstock');
	}
}

// use this for testing
// changeStockStatus(SHAMROCK_PRODUCT, 'instock');



?>
