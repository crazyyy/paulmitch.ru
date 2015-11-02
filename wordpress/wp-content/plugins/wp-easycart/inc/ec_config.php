<?php

wpeasycart_start_session( );

function wpeasycart_start_session( ){
    if( wpeasycart_config_is_session_started( ) === FALSE ){
        session_start( );
    }
}

function wpeasycart_config_is_session_started( ){

	if( php_sapi_name( ) !== 'cli' ){
		
		if( version_compare( phpversion( ), '5.4.0', '>=' ) ){
			return session_status( ) === PHP_SESSION_ACTIVE ? TRUE : FALSE;
		
		}else{
			return session_id() === '' ? FALSE : TRUE;
		}
		
	}
	
	return FALSE;

}

// Start up the Amazon S3 Loader
if( get_option( 'ec_option_amazon_bucket' ) != "" ){
	require WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/aws/aws-autoloader.php';
}

// Some servers do not set session path to a writable location. Fix this sometimes.
if( class_exists('memcached') ){ // Prevents activation error on servers without memcached available
	if( strtoupper(substr(PHP_OS, 0, 3)) != 'WIN' && !is_writable( session_save_path( ) ) ){ // Linux
		ini_set( 'session.save_path', '/tmp' );
	
	}else if( !is_writable( session_save_path( ) ) ){ // Windows
		ini_set( 'session.save_path', 'c:/temp' );
	}
}

// If register globals is on we need to do some custom work to fix session problems
if( ini_get( 'register_globals' ) ){
    foreach( $_SESSION as $key=>$value ){
        if( isset( $GLOBALS[$key] ) )
            unset( $GLOBALS[$key] );
    }
}

// Setup our cart id for this customer
if( !isset( $_COOKIE['ec_cart_id'] ) ){ // No Cookie, Set One
	$vals = array( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );
	$_SESSION['ec_cart_id'] = $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)];
	setcookie( "ec_cart_id", "", time( ) - 3600 );
	setcookie( "ec_cart_id", "", time( ) - 3600, "/" );
	setcookie( 'ec_cart_id', $_SESSION['ec_cart_id'], time( ) + ( 3600 * 24 * 1 ), "/" );

}else{ // Restore From User Cookie and Renew Cookie
	$ec_cart_id = $_COOKIE['ec_cart_id'];
	$_SESSION['ec_cart_id'] = $ec_cart_id;
	setcookie( "ec_cart_id", "", time( ) - 3600 );
	setcookie( "ec_cart_id", "", time( ) - 3600, "/" ); 
	setcookie( 'ec_cart_id', $ec_cart_id, time( ) + ( 3600 * 24 * 1 ), "/" );
}

// Newsletter Popup Cookie Search
if( isset( $_COOKIE['ec_newsletter_popup'] ) && !isset( $_SESSION['ec_newsletter_popup'] ) ){
	$_SESSION['ec_newsletter_popup'] = $_COOKIE['ec_newsletter_popup'];
}
	
// Language Translation Check
if( isset( $_POST['ec_language_conversion'] ) ){
	setcookie( "ec_translate_to", "", time( ) - 300, "/" ); 
	setcookie( 'ec_translate_to', htmlspecialchars( $_POST['ec_language_conversion'], ENT_QUOTES ), time( ) + ( 3600 * 24 * 30 ), "/" );
	$_SESSION['ec_translate_to'] = htmlspecialchars( $_POST['ec_language_conversion'], ENT_QUOTES );
	header('Location: '.$_SERVER['REQUEST_URI']);
	die;

}else if( isset( $_GET['eclang'] ) ){
	setcookie( "ec_translate_to", "", time( ) - 300, "/" ); 
	setcookie( 'ec_translate_to', htmlspecialchars( $_POST['eclang'], ENT_QUOTES ), time( ) + ( 3600 * 24 * 30 ), "/" );
	$_SESSION['ec_translate_to'] = htmlspecialchars( $_GET['eclang'], ENT_QUOTES );
	header('Location: '.$_SERVER['REQUEST_URI']);
	die;
}
	
// Currency Conversion Check
if( isset( $_POST['ec_currency_conversion'] ) ){
	setcookie( "ec_convert_to", "", time( ) - 300, "/" ); 
	setcookie( 'ec_convert_to', htmlspecialchars( $_POST['ec_currency_conversion'], ENT_QUOTES ), time( ) + ( 3600 * 24 * 30 ), "/" );
	$_SESSION['ec_convert_to'] = htmlspecialchars( $_POST['ec_currency_conversion'], ENT_QUOTES );
	header('Location: '.$_SERVER['REQUEST_URI']);
	die;
}

// LIVE GATEWAY CLASSES
if( get_option( 'ec_option_payment_process_method' ) != '0' || get_option( 'ec_option_use_affirm' ) ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_gateway.php' );
}

if( get_option( 'ec_option_use_affirm' ) ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_affirm.php' );
}

if( get_option( 'ec_option_payment_process_method' ) == 'authorize' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_authorize.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'beanstream' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_beanstream.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'braintree' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_braintree.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'chronopay' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_chronopay.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'eway' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_eway.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'firstdata' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_firstdata.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'goemerchant' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_goemerchant.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'migs' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_migs.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'moneris_ca' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_moneris_ca.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'moneris_us' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_moneris_us.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'paymentexpress' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_paymentexpress.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'paypal_payments_pro' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_paypal_payments_pro.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'paypal_pro' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_paypal_pro.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'paypoint' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_paypoint.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'realex' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_realex.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'sagepay' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_sagepay.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'sagepayus' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_sagepayus.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'securenet' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_securenet.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'securepay' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_securepay.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'stripe' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_stripe.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'virtualmerchant' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_virtualmerchant.php' );
}else if( get_option( 'ec_option_payment_process_method' ) == 'custom' && file_exists( WP_PLUGIN_DIR . '/wp-easycart-data/ec_customgateway.php' ) ){
	include( WP_PLUGIN_DIR . '/wp-easycart-data/ec_customgateway.php' );
}

// THIRD PARTY GATEWAYS
if( get_option( 'ec_option_payment_third_party' ) != '0' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_third_party.php' );
}

if( get_option( 'ec_option_payment_third_party' ) == 'dwolla_thirdparty' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_dwolla_thirdparty.php' );
}else if( get_option( 'ec_option_payment_third_party' ) == 'paymentexpress_thirdparty' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_paymentexpress_thirdparty.php' );
}else if( get_option( 'ec_option_payment_third_party' ) == 'paypal' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_paypal.php' );
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_ipnlistener.php' );
}else if( get_option( 'ec_option_payment_third_party' ) == 'sagepay_paynow_za' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_sagepay_paynow_za.php' );
}else if( get_option( 'ec_option_payment_third_party' ) == 'paypal_advanced' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_paypal_advanced.php' );
}else if( get_option( 'ec_option_payment_third_party' ) == 'nets' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_nets.php' );
}else if( get_option( 'ec_option_payment_third_party' ) == 'realex_thirdparty' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_realex_thirdparty.php' );
}else if( get_option( 'ec_option_payment_third_party' ) == 'skrill' ){
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/gateway/ec_skrill.php' );
}

// INCLUDE SHIPPER CLASSES
$use_auspost = false; $use_dhl = false; $use_fedex = false; $use_ups = false; $use_usps = false; $use_canadapost = false;
if( get_option( 'ec_option_is_installed' ) ){
	global $wpdb;
	$rates = $wpdb->get_results( "SELECT shippingrate_id, is_ups_based, is_usps_based, is_fedex_based, is_auspost_based, is_dhl_based, is_canadapost_based FROM ec_shippingrate" );
	$shipping_method = $wpdb->get_var( "SELECT shipping_method FROM ec_setting WHERE setting_id = 1" );
}else{
	$rates = array( );
	$shipping_method = "";
}

foreach( $rates as $rate ){
	if( $rate->is_auspost_based )
		$use_auspost = true;
	else if( $rate->is_dhl_based )
		$use_dhl = true;
	else if( $rate->is_fedex_based )
		$use_fedex = true;
	else if( $rate->is_ups_based )
		$use_ups = true;
	else if( $rate->is_usps_based )
		$use_usps = true;
	else if( $rate->is_canadapost_based )
		$use_canadapost = true;
}

if( $shipping_method == 'live' && $use_auspost )
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_auspost.php' );
if( $shipping_method == 'live' && $use_dhl )
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_dhl.php' );
if( $shipping_method == 'live' && $use_fedex )
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_fedex.php' );
if( $shipping_method == 'fraktjakt' )
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_fraktjakt.php' );
if( $shipping_method == 'live' )
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_live_shipping.php' );
if( $shipping_method == 'live' )
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_shipper.php' );
if( $shipping_method == 'live' && $use_ups )
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_ups.php' );
if( $shipping_method == 'live' && $use_usps )
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_usps.php' );
if( $shipping_method == 'live' && $use_canadapost )
	include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_canadapost.php' );

// INCLUDE CORE CLASSES
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/class-tgm-plugin-activation.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_address.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_credit_card.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_currency.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_googleanalytics.php' ); 
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_db.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_db_admin.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_discount.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_language.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_license.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_manufacturer.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_menu.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_menuitem.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_optionimage.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_optionitem.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_optionset.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_order.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_order_totals.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_payment.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_product.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_productlist.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_promotion.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_promotion_item.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_rating.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_review.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_scriptaction.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_selectedoptions.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_setting.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_shipping.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_subscription.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_tax.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_taxcloud.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_user.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_validation.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_wpoption.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_wpoptionset.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/core/ec_wpstyle.php' );

// INCLUDE ACCOUNT CLASSES
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/account/ec_accountpage.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/account/ec_orderdetail.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/account/ec_orderdisplay.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/account/ec_orderlist.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/account/ec_subscription_list.php' );

// INCLUDE CART CLASSES
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/cart/ec_cart.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/cart/ec_cart_data.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/cart/ec_cartitem.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/cart/ec_cartpage.php' );

// INCLUDE STORE CLASSES
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_featuredproducts.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_filter.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_giftcard.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_paging.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_perpage.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_prodimages.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_prodimageset.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_prodmenu.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_prodoptions.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_social_media.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/store/ec_storepage.php' );

//INCLUDE WIDGET CLASSES
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_breadcrumbwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_cartwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_categorywidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_colorwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_currencywidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_donationwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_groupwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_languagewidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_loginwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_manufacturerwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_menuwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_newsletterwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_pricepointwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_productwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_searchwidget.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/widget/ec_specialswidget.php' );

//ADMIN HOOK INCLUDES
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/admin/admin_init.php' );
include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/admin/admin_ajax_functions.php' );

if( get_option( 'ec_option_is_installed' ) ){
	$GLOBALS['ec_cart_data'] = new ec_cart_data( $_SESSION['ec_cart_id'] );
	$GLOBALS['ec_cart_data']->restore_session_from_db( );
	$GLOBALS['ec_setting'] = new ec_setting( );
	$GLOBALS['language'] = new ec_language( );
	$GLOBALS['currency'] = new ec_currency( );
	$GLOBALS['ec_user'] = new ec_user( "" );
}

?>