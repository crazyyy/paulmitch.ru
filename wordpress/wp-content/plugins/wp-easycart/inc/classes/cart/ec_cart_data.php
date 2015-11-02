<?php

class ec_cart_data{
	
	protected $mysqli;										// ec_db structure
	public $ec_cart_id;									// VARCHAR 255
	
	public $cart_data;										// Object from DB
	
	function __construct( $ec_cart_id ){
		
		$this->mysqli = new ec_db( );
		$this->ec_cart_id = $ec_cart_id;
		
		$this->cart_data = $this->mysqli->get_cart_data( $ec_cart_id );
		
	}
	
	public function save_session_to_db( ){
			
		/* RUN SQL */
		$this->mysqli->save_cart_data( $this->ec_cart_id, $this->cart_data );
		
	}
	
	public function restore_session_from_db( ){
		
		$this->cart_data = $this->mysqli->get_cart_data( $this->ec_cart_id );
		if( $this->cart_data->estimate_shipping_zip != "" )
			$_SESSION['ec_temp_zipcode'] = $this->cart_data->estimate_shipping_zip;
		else if( isset( $_SESSION['ec_temp_zipcode'] ) )
			unset( $_SESSION['ec_temp_zipcode'] );
		
		if( $this->cart_data->is_guest != "" )
			$_SESSION['ec_is_guest'] = $this->cart_data->is_guest;
		else if( isset( $_SESSION['ec_is_guest'] ) )
			unset( $_SESSION['ec_is_guest'] );
		
		if( $this->cart_data->guest_key != "" )
			$_SESSION['ec_guest_key'] = $this->cart_data->guest_key;
		else if( isset( $_SESSION['ec_guest_key'] ) )
			unset( $_SESSION['ec_guest_key'] );
		
		if( $this->cart_data->shipping_method != "" )
			$_SESSION['ec_shipping_method'] = $this->cart_data->shipping_method;
		else if( isset( $_SESSION['ec_shipping_method'] ) )
			unset( $_SESSION['ec_shipping_method'] );
		
		if( $this->cart_data->expedited_shipping != "" )
			$_SESSION['ec_ship_express'] = $this->cart_data->expedited_shipping;
		else if( isset( $_SESSION['ec_ship_express'] ) )
			unset( $_SESSION['ec_ship_express'] );
		
		if( $this->cart_data->shipping_selector != "" )
			$_SESSION['ec_shipping_selector'] = $this->cart_data->shipping_selector;
		else if( isset( $_SESSION['ec_shipping_selector'] ) )
			unset( $_SESSION['ec_shipping_selector'] );
		
		if( $this->cart_data->order_notes != "" )
			$_SESSION['ec_order_notes'] = $this->cart_data->order_notes;
		else if( isset( $_SESSION['ec_order_notes'] ) )
			unset( $_SESSION['ec_order_notes'] );
		
		if( $this->cart_data->user_id != "" )
			$_SESSION['ec_user_id'] = $this->cart_data->user_id;
		else if( isset( $_SESSION['ec_user_id'] ) )
			unset( $_SESSION['ec_user_id'] );
			
		if( $this->cart_data->email != "" )
			$_SESSION['ec_email'] = $this->cart_data->email;
		else if( isset( $_SESSION['ec_email'] ) )
			unset( $_SESSION['ec_email'] );
		
		// V2 Design Backwards Compatibility
		if( $this->cart_data->email == "guest" )
			$_SESSION['ec_password'] = "guest";
		else if( isset( $_SESSION['ec_password'] ) )
			unset( $_SESSION['ec_password'] );
		
	}
	
	public function clear_db_session( ){
		
		$this->mysqli->remove_cart_data( $ec_cart_id );
		
	}
	
	public function checkout_session_complete( ){
		
		// Save carry over variables
		$is_guest = $this->cart_data->is_guest;
		$guest_key = $this->cart_data->guest_key;
		$user_id = $this->cart_data->user_id;
		$email = $this->cart_data->email;
		
		// Remove this cart data
		$this->mysqli->remove_cart_data( $this->ec_cart_id );
		unset( $this->ec_cart_id );
		
		// Reset this class
		unset( $this->cart_data );
		$this->generate_new_cart_id( );
		
		$this->cart_data = new stdClass( );
		$this->cart_data->is_guest = $is_guest;
		$this->cart_data->guest_key = $guest_key;
		$this->cart_data->user_id = $user_id;
		$this->cart_data->email = $email;
		
		// Save back to DB
		$this->save_session_to_db( );
		
	}
	
	public function generate_new_cart_id( ){
		
		setcookie('ec_cart_id', "", time( ) - 3600 ); 
		setcookie('ec_cart_id', "", time( ) - 3600, "/" ); 
		unset( $_SESSION['ec_cart_id'] );
		
		$vals = array( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );
		$this->ec_cart_id = $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)] . $vals[rand(0, 25)];
		
		setcookie( 'ec_cart_id', $this->ec_cart_id, time( ) + ( 3600 * 24 * 1 ), "/" );
		
	}
	
}

?>