<?php
//Load Wordpress Connection Data
define( 'WP_USE_THEMES', false );
require( '../../../../../wp-load.php' );

$mysqli = new ec_db_admin( );

$response_string = print_r( $_POST, true );
$mysqli->insert_response( $order_id, 0, "SagePay PayNow South Africa", $response_string );

$data = $_POST;
$order_id = $data['Extra3'];
$transaction_id = $data['RequestTrace'];

$pieces = explode( "_", $order_id );
$order_id = $pieces[0];
$order_key = esc_attr( $sessionid );
$data_string = '';
$data_array = array( );

foreach( $data as $key => $val ){
	$data_string .= $key . '=' . urlencode( $val ) . '&';
	$data_array [$key] = $val;
}

$data_string = substr( $data_string, 0, - 1 );

// Get Order
$order_row = $mysqli->get_order_row_admin( $order_id );

if( $order_row->orderstatus_id != "10" ){ // Order Has Not Been Processed
	
	if( $data['Amount'] == $order_row->grand_total ){ // Make Sure Transaction Matches DB Value
		
		if( $data['TransactionAccepted'] == "true" ){ // Transaction Has Been Accepted
			
			$mysqli->update_order_status( $order_id, "10" );
			do_action( 'wpeasycart_order_paid', $orderid );
			
			// send email
			$order_display = new ec_orderdisplay( $order_row, true, true );
			$order_display->send_email_receipt( );
			$order_display->send_gift_cards( );
	
			// Quickbooks Hook
			if( file_exists( WP_PLUGIN_DIR . "/" . EC_QB_PLUGIN_DIRECTORY . "/ec_quickbooks.php" ) ){
				$quickbooks = new ec_quickbooks( );
				$quickbooks->add_order( $order_id );
			}
			
		}else if( $data['Reason'] == "Denied" ){
			$mysqli->update_order_status( $order_id, "7" );
			
		}else{ // Transaction Not accepted, log it
			
			$mysqli->insert_response( $order_id, 0, "SagePay PayNow South Africa", "Warning: Transaction not accepted, but also not denied." );
			
		}
		
	}else{ // Values do not match
		
		$mysqli->insert_response( $order_id, 0, "SagePay PayNow South Africa", "Error: Transaction total does not match that in the order table." );
			
	}
	
}

?>