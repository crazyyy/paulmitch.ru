<?php

class ec_db{
	
	protected $mysqli;  // holds your mysqli connection
	protected $orderdetail_sql;
	function __construct(){
		global $wpdb;
		$this->mysqli =& $wpdb;
		
		$this->orderdetail_sql = "SELECT 
				ec_orderdetail.orderdetail_id, 
				ec_orderdetail.order_id, 
				ec_orderdetail.product_id, 
				ec_product.list_id, 
				ec_orderdetail.title, 
				ec_orderdetail.model_number, 
				ec_orderdetail.order_date, 
				ec_orderdetail.unit_price, 
				ec_orderdetail.total_price, 
				ec_orderdetail.quantity, 
				ec_orderdetail.image1, 
				ec_orderdetail.optionitem_name_1, 
				ec_orderdetail.optionitem_name_2, 
				ec_orderdetail.optionitem_name_3, 
				ec_orderdetail.optionitem_name_4, 
				ec_orderdetail.optionitem_name_5,
				ec_orderdetail.optionitem_label_1, 
				ec_orderdetail.optionitem_label_2, 
				ec_orderdetail.optionitem_label_3, 
				ec_orderdetail.optionitem_label_4, 
				ec_orderdetail.optionitem_label_5,
				ec_orderdetail.optionitem_price_1, 
				ec_orderdetail.optionitem_price_2, 
				ec_orderdetail.optionitem_price_3, 
				ec_orderdetail.optionitem_price_4, 
				ec_orderdetail.optionitem_price_5,
				ec_orderdetail.use_advanced_optionset,
				ec_orderdetail.giftcard_id, 
				ec_orderdetail.gift_card_message, 
				ec_orderdetail.gift_card_from_name, 
				ec_orderdetail.gift_card_to_name,
				ec_orderdetail.gift_card_email,
				ec_orderdetail.is_download, 
				ec_orderdetail.is_giftcard, 
				ec_orderdetail.is_taxable,
				ec_orderdetail.is_shippable, 
				ec_download.download_file_name, 
				ec_orderdetail.download_key,
				ec_orderdetail.maximum_downloads_allowed,
				ec_orderdetail.download_timelimit_seconds,
				ec_download.is_amazon_download,
				ec_download.amazon_key,
				
				ec_orderdetail.include_code,
				ec_orderdetail.subscription_signup_fee,
				
				ec_orderdetail.is_deconetwork,
				ec_orderdetail.deconetwork_id,
				ec_orderdetail.deconetwork_name,
				ec_orderdetail.deconetwork_product_code,
				ec_orderdetail.deconetwork_options,
				ec_orderdetail.deconetwork_color_code,
				ec_orderdetail.deconetwork_product_id,
				ec_orderdetail.deconetwork_image_link,
				
				";
		
		if( isset( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ) ){
			for( $i=0; $i<count( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ); $i++ ){
				$arr = $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'][$i][0]( array( ), array( ) );
				for( $j=0; $j<count( $arr ); $j++ ){
					$this->orderdetail_sql .= "ec_orderdetail." . $arr[$j] . ", ";
				}
			}
		}
			
		$this->orderdetail_sql .=	"
				
				GROUP_CONCAT(DISTINCT CONCAT_WS('***', ec_customfield.field_name, ec_customfield.field_label, ec_customfielddata.data) ORDER BY ec_customfield.field_name ASC SEPARATOR '---') as customfield_data
				
				FROM ec_orderdetail
				
				LEFT JOIN ec_product
				ON ec_product.product_id = ec_orderdetail.product_id
				
				LEFT JOIN ec_download
				ON ec_download.download_id = ec_orderdetail.download_key
				
				LEFT JOIN ec_customfield
				ON ec_customfield.table_name = 'ec_orderdetail'
				
				LEFT JOIN ec_customfielddata
				ON ec_customfielddata.customfield_id = ec_customfield.customfield_id AND ec_customfielddata.table_id = ec_orderdetail.orderdetail_id, 
				
				ec_order, ec_user
				
				WHERE 
				ec_user.user_id = %s AND
				ec_order.order_id = ec_orderdetail.order_id AND 
				ec_user.user_id = ec_order.user_id AND 
				ec_orderdetail.order_id = %d
				
				GROUP BY
				ec_orderdetail.orderdetail_id";
				
		$this->orderdetail_guest_sql = "SELECT 
				ec_orderdetail.orderdetail_id, 
				ec_orderdetail.order_id, 
				ec_orderdetail.product_id,
				ec_product.list_id, 
				ec_orderdetail.title, 
				ec_orderdetail.model_number, 
				ec_orderdetail.order_date, 
				ec_orderdetail.unit_price, 
				ec_orderdetail.total_price, 
				ec_orderdetail.quantity, 
				ec_orderdetail.image1, 
				ec_orderdetail.optionitem_name_1, 
				ec_orderdetail.optionitem_name_2, 
				ec_orderdetail.optionitem_name_3, 
				ec_orderdetail.optionitem_name_4, 
				ec_orderdetail.optionitem_name_5,
				ec_orderdetail.optionitem_label_1, 
				ec_orderdetail.optionitem_label_2, 
				ec_orderdetail.optionitem_label_3, 
				ec_orderdetail.optionitem_label_4, 
				ec_orderdetail.optionitem_label_5,
				ec_orderdetail.optionitem_price_1, 
				ec_orderdetail.optionitem_price_2, 
				ec_orderdetail.optionitem_price_3, 
				ec_orderdetail.optionitem_price_4, 
				ec_orderdetail.optionitem_price_5,
				ec_orderdetail.use_advanced_optionset,
				ec_orderdetail.giftcard_id, 
				ec_orderdetail.gift_card_message, 
				ec_orderdetail.gift_card_from_name, 
				ec_orderdetail.gift_card_to_name,
				ec_orderdetail.gift_card_email,
				ec_orderdetail.is_download, 
				ec_orderdetail.is_giftcard, 
				ec_orderdetail.is_taxable, 
				ec_orderdetail.is_shippable, 
				ec_download.download_file_name, 
				ec_orderdetail.download_key,
				ec_orderdetail.maximum_downloads_allowed,
				ec_orderdetail.download_timelimit_seconds,
				ec_download.is_amazon_download,
				ec_download.amazon_key,
				
				ec_orderdetail.is_deconetwork,
				ec_orderdetail.deconetwork_id,
				ec_orderdetail.deconetwork_name,
				ec_orderdetail.deconetwork_product_code,
				ec_orderdetail.deconetwork_options,
				ec_orderdetail.deconetwork_color_code,
				ec_orderdetail.deconetwork_product_id,
				ec_orderdetail.deconetwork_image_link,
				
				ec_orderdetail.include_code,
				ec_orderdetail.subscription_signup_fee,
				
				";
		
		if( isset( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ) ){
			for( $i=0; $i<count( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ); $i++ ){
				$arr = $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'][$i][0]( array( ), array( ) );
				for( $j=0; $j<count( $arr ); $j++ ){
					$this->orderdetail_guest_sql .= "ec_orderdetail." . $arr[$j] . ", ";
				}
			}
		}
				
		$this->orderdetail_guest_sql .=	"
				
				GROUP_CONCAT(DISTINCT CONCAT_WS('***', ec_customfield.field_name, ec_customfield.field_label, ec_customfielddata.data) ORDER BY ec_customfield.field_name ASC SEPARATOR '---') as customfield_data
				
				FROM ec_orderdetail
				
				LEFT JOIN ec_product
				ON ec_product.product_id = ec_orderdetail.product_id
				
				LEFT JOIN ec_download
				ON ec_download.download_id = ec_orderdetail.download_key
				
				LEFT JOIN ec_customfield
				ON ec_customfield.table_name = 'ec_orderdetail'
				
				LEFT JOIN ec_customfielddata
				ON ec_customfielddata.customfield_id = ec_customfield.customfield_id AND ec_customfielddata.table_id = ec_orderdetail.orderdetail_id, 
				
				ec_order 
				
				WHERE 
				ec_order.order_id = ec_orderdetail.order_id AND 
				ec_order.guest_key = %s AND
				ec_order.guest_key != '' AND
				ec_orderdetail.order_id = %d
				
				GROUP BY
				ec_orderdetail.orderdetail_id";
	}
	
	public function get_breadcrumb_data( $model_number, $menuid, $submenuid, $subsubmenuid ){
		$sql_menu0 = $this->mysqli->prepare( "SELECT ec_product.title, ec_product.model_number FROM ec_product WHERE ec_product.model_number = '%s'", $model_number );
		$sql_menu1 = $this->mysqli->prepare( "SELECT ec_product.title, ec_product.model_number, ec_menulevel1.menulevel1_id, ec_menulevel1.name as menulevel1_name FROM ec_product, ec_menulevel1 WHERE ec_product.model_number = '%s' AND ec_menulevel1.menulevel1_id = %d", $model_number, $menuid );
		$sql_menu2 = $this->mysqli->prepare( "SELECT ec_product.title, ec_product.model_number, ec_menulevel1.menulevel1_id, ec_menulevel2.menulevel2_id, ec_menulevel1.name as menulevel1_name, ec_menulevel2.name as menulevel2_name FROM ec_product, ec_menulevel2 LEFT JOIN ec_menulevel1 ON ec_menulevel1.menulevel1_id = ec_menulevel2.menulevel1_id WHERE ec_product.model_number = '%s' AND ec_menulevel2.menulevel2_id = %d", $model_number, $submenuid );
		$sql_menu3 = $this->mysqli->prepare( "SELECT ec_product.title, ec_product.model_number, ec_menulevel1.menulevel1_id, ec_menulevel2.menulevel2_id, ec_menulevel3.menulevel3_id, ec_menulevel1.name as menulevel1_name, ec_menulevel2.name as menulevel2_name, ec_menulevel3.name as menulevel3_name FROM ec_product, ec_menulevel3 LEFT JOIN ec_menulevel2 ON ec_menulevel2.menulevel2_id = ec_menulevel3.menulevel2_id LEFT JOIN ec_menulevel1 ON ec_menulevel1.menulevel1_id = ec_menulevel2.menulevel1_id WHERE ec_product.model_number = '%s' AND ec_menulevel3.menulevel3_id = %d", $model_number, $subsubmenuid );
		
		if( $subsubmenuid != 0 )
			$sql = $sql_menu3;
		else if( $submenuid != 0 )
			$sql = $sql_menu2;
		else if( $menuid != 0 )
			$sql = $sql_menu1;
		else
			$sql = $sql_menu0;
		
		return $this->mysqli->get_row( $sql );	
	}
	
	public function get_review_list( ){
		$sql = "SELECT
				ec_review.product_id,
				ec_review.rating, 
				ec_review.title,
				ec_review.description,
				ec_review.date_submitted,
				ec_user.first_name,
				ec_user.last_name
				
				FROM ec_review
				
				LEFT JOIN ec_user ON ec_review.user_id = ec_user.user_id
				
				WHERE ec_review.approved = 1
				
				ORDER BY ec_review.date_submitted DESC";
				
		return $this->mysqli->get_results( $sql );
	}
	
	public function get_pricetier_list( ){
		$sql = "SELECT
				ec_pricetier.product_id,
				ec_pricetier.price,
				ec_pricetier.quantity
				
				FROM ec_pricetier
				
				ORDER BY ec_pricetier.quantity ASC";
		
		return $this->mysqli->get_results( $sql );
	}
	
	public function get_option_list( ){
		$sql = "SELECT
				ec_option.option_id,
				ec_option.option_name,
				ec_option.option_label
				
				FROM ec_option
				
				ORDER BY 
				ec_option.option_id";
				
		return $this->mysqli->get_results( $sql );
	}
	
	public function get_optionitem_list( ){
		$sql = "SELECT 
				optionitem.option_id,
				optionitem.optionitem_id, 
				optionitem.optionitem_name, 
				optionitem.optionitem_price, 
				optionitem.optionitem_price_onetime,
				optionitem.optionitem_price_override,
				optionitem.optionitem_price_multiplier,
				optionitem.optionitem_price_per_character,
				optionitem.optionitem_weight, 
				optionitem.optionitem_weight_onetime,
				optionitem.optionitem_weight_override,
				optionitem.optionitem_weight_multiplier,
				optionitem.optionitem_icon,
				optionitem.optionitem_initially_selected,
				
				ec_option.option_label,
				ec_option.option_name
				
				FROM ec_optionitem as optionitem
				LEFT JOIN ec_option ON ( ec_option.option_id = optionitem.option_id )
				
				ORDER BY
				optionitem.option_id, 
				optionitem.optionitem_order";
				
		return $this->mysqli->get_results( $sql );
	}
	
	public function get_optionitem_image_list( ){
		$sql = "SELECT 
				optionitemimage.optionitemimage_id,
				optionitemimage.optionitem_id, 
				optionitemimage.product_id, 
				optionitemimage.image1, 
				optionitemimage.image2, 
				optionitemimage.image3, 
				optionitemimage.image4, 
				optionitemimage.image5,
				optionitem.optionitem_order
				
				FROM ec_optionitemimage as optionitemimage, ec_optionitem as optionitem

				WHERE optionitem.optionitem_id = optionitemimage.optionitem_id
				
                GROUP BY optionitemimage.optionitemimage_id
				
				ORDER BY
				optionitemimage.product_id,
				optionitem.optionitem_order";
				
		return $this->mysqli->get_results( $sql );
	}
	
	public function get_product_list( $where_query, $order_query, $limit_query, $session_id ){
		
		$this->mysqli->query( "SET SQL_BIG_SELECTS=1" );
		
		$sql1 = "SELECT product.product_id
				
				FROM ec_product as product 
				
				LEFT JOIN ec_manufacturer as manufacturer ON manufacturer.manufacturer_id = product.manufacturer_id
				
				LEFT JOIN ec_categoryitem ON ec_categoryitem.product_id = product.product_id 

				LEFT JOIN ec_menulevel1 ON ( ec_menulevel1.menulevel1_id = product.menulevel1_id_1 OR ec_menulevel1.menulevel1_id = product.menulevel2_id_1 OR ec_menulevel1.menulevel1_id = product.menulevel3_id_1 )
				
				LEFT JOIN ec_menulevel2 ON ( ec_menulevel2.menulevel2_id = product.menulevel1_id_2 OR ec_menulevel2.menulevel2_id = product.menulevel2_id_2 OR ec_menulevel2.menulevel2_id = product.menulevel3_id_2 )
				
				LEFT JOIN ec_menulevel3 ON ( ec_menulevel3.menulevel3_id = product.menulevel1_id_3 OR ec_menulevel3.menulevel3_id = product.menulevel2_id_3 OR ec_menulevel3.menulevel3_id = product.menulevel3_id_3 )
				
				";
		
		if( isset( $_GET['ec_optionitem_id'] ) ){
			
			$sql1 .= $this->mysqli->prepare( "JOIN ec_optionitemquantity ON ( ec_optionitemquantity.product_id = product.product_id AND ( ec_optionitemquantity.optionitem_id_1 = %d OR ec_optionitemquantity.optionitem_id_2 = %d OR ec_optionitemquantity.optionitem_id_3 = %d OR ec_optionitemquantity.optionitem_id_4 = %d OR ec_optionitemquantity.optionitem_id_5 = %d ) AND ec_optionitemquantity.quantity > 0 )
			
			", $_GET['ec_optionitem_id'], $_GET['ec_optionitem_id'], $_GET['ec_optionitem_id'], $_GET['ec_optionitem_id'], $_GET['ec_optionitem_id'] );
			
		}
		
		$sql2 = "SELECT
		
					product.*,
					
					manufacturer.name as manufacturer_name,
					
					ec_product_google_attributes.attribute_value as google_attributes,
					
					AVG( ec_review.rating ) as review_average
					
					FROM ec_product AS product 
					
					LEFT JOIN ec_manufacturer AS manufacturer ON manufacturer.manufacturer_id = product.manufacturer_id
					
					LEFT JOIN ec_product_google_attributes ON ec_product_google_attributes.product_id = product.product_id
					
					LEFT JOIN ec_categoryitem ON ec_categoryitem.product_id = product.product_id 
					
					LEFT JOIN ec_menulevel1 ON ( ec_menulevel1.menulevel1_id = product.menulevel1_id_1 OR ec_menulevel1.menulevel1_id = product.menulevel2_id_1 OR ec_menulevel1.menulevel1_id = product.menulevel3_id_1 )
					
					LEFT JOIN ec_menulevel2 ON ( ec_menulevel2.menulevel2_id = product.menulevel1_id_2 OR ec_menulevel2.menulevel2_id = product.menulevel2_id_2 OR ec_menulevel2.menulevel2_id = product.menulevel3_id_2 )
					
					LEFT JOIN ec_menulevel3 ON ( ec_menulevel3.menulevel3_id = product.menulevel1_id_3 OR ec_menulevel3.menulevel3_id = product.menulevel2_id_3 OR ec_menulevel3.menulevel3_id = product.menulevel3_id_3 )
					
					LEFT JOIN ec_review ON ( ec_review.product_id = product.product_id AND ec_review.approved = 1 )
				
				";
				
		if( isset( $_GET['ec_optionitem_id'] ) ){
			
			$sql2 .= $this->mysqli->prepare( "JOIN ec_optionitemquantity ON ( ec_optionitemquantity.product_id = product.product_id AND ( ec_optionitemquantity.optionitem_id_1 = %d OR ec_optionitemquantity.optionitem_id_2 = %d OR ec_optionitemquantity.optionitem_id_3 = %d OR ec_optionitemquantity.optionitem_id_4 = %d OR ec_optionitemquantity.optionitem_id_5 = %d ) AND ec_optionitemquantity.quantity > 0 )
			
			", $_GET['ec_optionitem_id'], $_GET['ec_optionitem_id'], $_GET['ec_optionitem_id'], $_GET['ec_optionitem_id'], $_GET['ec_optionitem_id'] );
			
		}
				
		$group_query = " GROUP BY product.product_id ";
				
		$result = $this->mysqli->get_results( $sql1 . $where_query . $group_query );
		$result_count = count($result);
		
		$result2 = $this->mysqli->get_results( $sql2 . $where_query . $group_query . $order_query . $limit_query );
		
		//Process the Result
		$option_list = $this->get_option_list( );
		$review_list = $this->get_review_list( );
		$pricetier_list = $this->get_pricetier_list( );
		$optionitem_list = $this->get_optionitem_list( );
		$optionitem_image_list = $this->get_optionitem_image_list( );
		$product_list = array();
		
		foreach($result2 as $row){
			
			$option1 = ""; $option2 = ""; $option3 = ""; $option4 = ""; $option5 = "";
			$option1_data = array( ); $option2_data = array( ); $option3_data = array( ); $option4_data = array( ); $option5_data = array( );
			$optionitem1_data = array( ); $optionitem2_data = array( ); $optionitem3_data = array( ); $optionitem4_data = array( ); $optionitem5_data = array( );
				
			// Loop through for option data if options used.
			if( $row->option_id_1 || $row->option_id_2 || $row->option_id_3 || $row->option_id_4 || $row->option_id_5 ){
				
				foreach( $option_list as $option ){
					if( $row->option_id_1 == $option->option_id ){
						$option1_data = array( $option->option_id, $option->option_name, $option->option_label );
					}
					
					if( $row->option_id_2 == $option->option_id ){
						$option2_data = array( $option->option_id, $option->option_name, $option->option_label );
					}
					
					if( $row->option_id_3 == $option->option_id ){
						$option3_data = array( $option->option_id, $option->option_name, $option->option_label );
					}
					
					if( $row->option_id_4 == $option->option_id ){
						$option4_data = array( $option->option_id, $option->option_name, $option->option_label );
					}
					
					if( $row->option_id_5 == $option->option_id ){
						$option5_data = array( $option->option_id, $option->option_name, $option->option_label );
					}
				}
			}
			
			// Loop through and get option items if needed
			if( $row->option_id_1 || $row->option_id_2 || $row->option_id_3 || $row->option_id_4 || $row->option_id_5 ){
				
				foreach( $optionitem_list as $optionitem ){
					
					if( $row->option_id_1 == $optionitem->option_id ){
						$optionitem1_data[] = $optionitem;
					}
					
					if( $row->option_id_2 == $optionitem->option_id ){
						$optionitem2_data[] = $optionitem;
					}
					
					if( $row->option_id_3 == $optionitem->option_id ){
						$optionitem3_data[] = $optionitem;
					}
					
					if( $row->option_id_4 == $optionitem->option_id ){
						$optionitem4_data[] = $optionitem;
					}
					
					if( $row->option_id_5 == $optionitem->option_id ){
						$optionitem5_data[] = $optionitem;
					}
				
				}
			}
			
			// Finalize the option data here
			if( $row->option_id_1 && count( $option1_data ) >= 3 )
				$option1 = array( $option1_data[0], $option1_data[1], $option1_data[2], $optionitem1_data);
			
			if( $row->option_id_2 && count( $option2_data ) >= 3 )
				$option2 = array( $option2_data[0], $option2_data[1], $option2_data[2], $optionitem2_data);
			
			if( $row->option_id_3 && count( $option3_data ) >= 3 )
				$option3 = array( $option3_data[0], $option3_data[1], $option3_data[2], $optionitem3_data);
			
			if( $row->option_id_4 && count( $option4_data ) >= 3 )
				$option4 = array( $option4_data[0], $option4_data[1], $option4_data[2], $optionitem4_data);
			
			if( $row->option_id_5 && count( $option5_data ) >= 3 )
				$option5 = array( $option5_data[0], $option5_data[1], $option5_data[2], $optionitem5_data);
			
			// Get option item images if needed
			$optionitemimage_data = array();
			if( $row->use_optionitem_images ){
				
				foreach( $optionitem_image_list as $optionitem_image ){
					
					if( $optionitem_image->product_id == $row->product_id )
						$optionitemimage_data[] = $optionitem_image;
				
				}
			}
			
			// Get the review data for the product
			$review_data = array( );
			foreach( $review_list as $review ){
				if( $review->product_id == $row->product_id ){
					$review_data[] = $review->rating;
				}
			}
			
			// Get the review average
			if( count( $review_data ) > 0 ){
				$review_average = array_sum( $review_data ) / count( $review_data );
			}else{
				$review_average = 0;
			}
			
			// Get the price tier data
			$pricetier_data = array( );
			foreach( $pricetier_list as $pricetier ){
				if( $pricetier->product_id == $row->product_id ){
					$pricetier_data[] = array( $pricetier->price, $pricetier->quantity );
				}
			}
			
			//Setup Return Array
			$temp_product = array(
						"product_count" => $result_count,
						"product_id" => $row->product_id,
						"model_number" => $row->model_number,
						"post_id" => $row->post_id,
						"activate_in_store" => $row->activate_in_store,
						"manufacturer_id" => $row->manufacturer_id, 
						"manufacturer_name" => $row->manufacturer_name, 
						"title" => $row->title, 
						"description" => $row->description, 
						"short_description" => $row->short_description, 
						"seo_description" => $row->seo_description, 
						"seo_keywords" => $row->seo_keywords, 
						"price" => $row->price, 
						"list_price" => $row->list_price, 
						"vat_rate" => $row->vat_rate,
						"handling_price" => $row->handling_price,
						"handling_price_each" => $row->handling_price_each,
						"stock_quantity" => $row->stock_quantity,
						"min_purchase_quantity" => $row->min_purchase_quantity,
						"max_purchase_quantity" => $row->max_purchase_quantity,
						"weight" => $row->weight,  
						"width" => $row->width,  
						"height" => $row->height,  
						"length" => $row->length, 
						"use_optionitem_quantity_tracking" => $row->use_optionitem_quantity_tracking, 
						"use_specifications" => $row->use_specifications, 
						"specifications" => $row->specifications, 
						"use_customer_reviews" => $row->use_customer_reviews, 
						"show_on_startup" => $row->show_on_startup,
						"show_stock_quantity" => $row->show_stock_quantity, 
						"is_special" => $row->is_special, 
						"is_taxable" => $row->is_taxable, 
						"is_shippable" => $row->is_shippable, 
						"is_giftcard" => $row->is_giftcard, 
						"is_download" => $row->is_download,
						"is_donation" => $row->is_donation,
						"is_subscription_item" => $row->is_subscription_item,
						"is_deconetwork" => $row->is_deconetwork,
						"allow_backorders" => $row->allow_backorders,
						"backorder_fill_date" => $row->backorder_fill_date,
						
						"include_code" => $row->include_code,
						
						"download_file_name" => $row->download_file_name,
						
						"subscription_bill_length" => $row->subscription_bill_length,
						"subscription_bill_period" => $row->subscription_bill_period,
						"subscription_bill_duration" => $row->subscription_bill_duration,
						"trial_period_days" => $row->trial_period_days,
						"stripe_plan_added" => $row->stripe_plan_added,
						"subscription_signup_fee" => $row->subscription_signup_fee,
						"subscription_unique_id" => $row->subscription_unique_id,
						"subscription_prorate" => $row->subscription_prorate,
						
						"option1" => $option1, 
						"option2" => $option2, 
						"option3" => $option3, 
						"option4" => $option4, 
						"option5" => $option5, 
						
						"use_advanced_optionset" => $row->use_advanced_optionset,
						"use_optionitem_images" => $row->use_optionitem_images, 
						
						"image1" => $row->image1, 
						"image2" => $row->image2, 
						"image3" => $row->image3, 
						"image4" => $row->image4, 
						"image5" => $row->image5, 
						
						"optionitemimage_data" => $optionitemimage_data,
						
						"featured_product_id_1" => $row->featured_product_id_1, 
						"featured_product_id_2" => $row->featured_product_id_2, 
						"featured_product_id_3" => $row->featured_product_id_3, 
						"featured_product_id_4" => $row->featured_product_id_4,
						
						"catalog_mode" => $row->catalog_mode,
						"catalog_mode_phrase" => $row->catalog_mode_phrase,
						"inquiry_mode" => $row->inquiry_mode,
						"inquiry_url" => $row->inquiry_url,
				
						"deconetwork_mode" => $row->deconetwork_mode,
						"deconetwork_product_id" => $row->deconetwork_product_id,
						"deconetwork_size_id" => $row->deconetwork_size_id,
						"deconetwork_color_id" => $row->deconetwork_color_id,
						"deconetwork_design_id" => $row->deconetwork_design_id,
						
						"review_data" => $review_data,
						"review_average" => $review_average,
						"views" => $row->views,
						"pricetier_data" => $pricetier_data,
						"google_attributes" => $row->google_attributes,
						
						"display_type" => $row->display_type,
						"image_hover_type" => $row->image_hover_type,
						"image_effect_type" => $row->image_effect_type,
						"tag_type" => $row->tag_type,
						"tag_bg_color" => $row->tag_bg_color,
						"tag_text_color" => $row->tag_text_color,
						"tag_text" => $row->tag_text
			);
			
			$product_list[] = $temp_product;
			
		}
		
		//Return Array
		return $product_list;
		
	}
	
	public function clean_search( $string ){
		return $this->mysqli->prepare( '%s', $string );		
	}
	
	public function get_tempcart_product_quantity( $session_id, $product_id ){
		
		$sql = "SELECT SUM(tempcart.quantity) as quantity FROM ec_tempcart as tempcart WHERE tempcart.session_id = '%s' AND tempcart.product_id = %d";
		$result = $this->mysqli->get_row( $this->mysqli->prepare( $sql, $session_id, $product_id ) );
		return $result->quantity;
			
	}
	
	public function get_quantity_data( $product_id, $optionset1, $optionset2, $optionset3, $optionset4, $optionset5 ){
		
		$sql = 	"SELECT oiq.optionitem_id_1, oiq.optionitem_id_2, oiq.optionitem_id_3, oiq.optionitem_id_4, oiq.optionitem_id_5, COALESCE(SUM(oiq.quantity)) as quantity ";
		$sql .= "FROM ec_optionitemquantity as oiq ";
		$sql .= "LEFT JOIN ec_optionitem as oi1 ON oiq.optionitem_id_1 = oi1.optionitem_id ";
		$sql .= "LEFT JOIN ec_optionitem as oi2 ON oiq.optionitem_id_2 = oi2.optionitem_id ";
		$sql .= "LEFT JOIN ec_optionitem as oi3 ON oiq.optionitem_id_3 = oi3.optionitem_id ";
		$sql .= "LEFT JOIN ec_optionitem as oi4 ON oiq.optionitem_id_4 = oi4.optionitem_id ";
		$sql .= "LEFT JOIN ec_optionitem as oi5 ON oiq.optionitem_id_5 = oi5.optionitem_id ";	
		$sql .=	"WHERE oiq.product_id = %d AND quantity > 0 ";
		$sql .= "GROUP BY oiq.optionitem_id_1, oiq.optionitem_id_2, oiq.optionitem_id_3, oiq.optionitem_id_4, oiq.optionitem_id_5 ";
		$sql .= "ORDER BY oi1.optionitem_order, oi2.optionitem_order, oi3.optionitem_order, oi4.optionitem_order, oi5.optionitem_order";			
		
		$result = $this->mysqli->get_results($this->mysqli->prepare($sql, $product_id));
		
		$quantity_array = array();
		
		foreach($result as $row){
			array_push($quantity_array, array($row->optionitem_id_1, $row->optionitem_id_2, $row->optionitem_id_3, $row->optionitem_id_4, $row->optionitem_id_5, $row->quantity));
		}
		
		$return_array = array();
		
		for($a=0; $a<count($optionset1->optionset); $a++){
			$quantity = $this->get_level_1_quantity($quantity_array, $optionset1->optionset[$a]->optionitem_id);
			$arr = array(array(), $quantity);
			
			//Option 2 Loop
			for($b=0; $b<count($optionset2->optionset); $b++){
				$quantity = $this->get_level_2_quantity($quantity_array, $optionset1->optionset[$a]->optionitem_id, $optionset2->optionset[$b]->optionitem_id);
				array_push($arr[0], array(array(), $quantity));
				
				//Option 3 Loop
				for($c=0; $c<count($optionset3->optionset); $c++){
					$quantity = $this->get_level_3_quantity($quantity_array, $optionset1->optionset[$a]->optionitem_id, $optionset2->optionset[$b]->optionitem_id, $optionset3->optionset[$c]->optionitem_id);
					array_push($arr[0][$b][0], array(array(), $quantity));
					
					//Option 4 Loop
					for($d=0; $d<count($optionset4->optionset); $d++){
						$quantity = $this->get_level_4_quantity($quantity_array, $optionset1->optionset[$a]->optionitem_id, $optionset2->optionset[$b]->optionitem_id, $optionset3->optionset[$c]->optionitem_id, $optionset4->optionset[$d]->optionitem_id);
						array_push($arr[0][$b][0][$c][0], array(array(), $quantity));
						
						//Option 5 Loop
						for($e=0; $e<count($optionset5->optionset); $e++){
							$quantity = $this->get_level_5_quantity($quantity_array, $optionset1->optionset[$a]->optionitem_id, $optionset2->optionset[$b]->optionitem_id, $optionset3->optionset[$c]->optionitem_id, $optionset4->optionset[$d]->optionitem_id, $optionset5->optionset[$e]->optionitem_id);
							array_push($arr[0][$b][0][$c][0][$d][0], array(array(), $quantity));
						
						}//close e loop
					}//close d loop
				}//close c loop
			}//close b loop
			
			//push array for level 1
			array_push($return_array, $arr);
		}
		
		return $return_array;
		
	}
	
	private function get_level_1_quantity(&$values, $opt1){
		$quant = 0;
		for($i=0; $i<count($values); $i++){
			if($values[$i][0] == $opt1){
				$quant = $quant + $values[$i][5];
			}
		}
		return $quant;
	}
	
	private function get_level_2_quantity(&$values, $opt1, $opt2){
		$quant = 0;
		for($i=0; $i<count($values); $i++){
			if($values[$i][0] == $opt1 && $values[$i][1] == $opt2){
				$quant = $quant + $values[$i][5];
			}
		}
		return $quant;
	}
	
	private function get_level_3_quantity(&$values, $opt1, $opt2, $opt3){
		$quant = 0;
		for($i=0; $i<count($values); $i++){
			if($values[$i][0] == $opt1 && $values[$i][1] == $opt2 && $values[$i][2] == $opt3){
				$quant = $quant + $values[$i][5];
			}
		}
		return $quant;
	}
	
	private function get_level_4_quantity(&$values, $opt1, $opt2, $opt3, $opt4){
		$quant = 0;
		for($i=0; $i<count($values); $i++){
			if($values[$i][0] == $opt1 && $values[$i][1] == $opt2 && $values[$i][2] == $opt3 && $values[$i][3] == $opt4){
				$quant = $quant + $values[$i][5];
			}
		}
		return $quant;
	}
	
	private function get_level_5_quantity(&$values, $opt1, $opt2, $opt3, $opt4, $opt5){
		$quant = 0;
		for($i=0; $i<count($values); $i++){
			if($values[$i][0] == $opt1 && $values[$i][1] == $opt2 && $values[$i][2] == $opt3 && $values[$i][3] == $opt4 && $values[$i][4] == $opt5){
				$quant = $quant + $values[$i][5];
			}
		}
		return $quant;
	}
	
	public function get_perpage( $perpage ){
		$sql = "SELECT ec_perpage.perpage FROM ec_perpage WHERE ec_perpage.perpage = %d";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $perpage ) );
	}
	
	public function get_perpage_values(){
		$vals = $this->mysqli->get_results( "SELECT perpage.perpage FROM ec_perpage as perpage ORDER BY perpage.perpage ASC" );
		$array = array( );
		foreach( $vals as $val ){
			$array[] = $val->perpage;	
		}
		return $array;
	}
	
	public function get_manufacturers( $level, $menuid, $manufacturer_id, $category_id ){
		
		if( $category_id ){
			$sql = $this->mysqli->prepare( "SELECT manufacturer_id, name, (SELECT COUNT( ec_product.product_id )FROM ec_product, ec_categoryitem WHERE ec_product.activate_in_store = 1 AND ec_product.manufacturer_id = ec_manufacturer.manufacturer_id AND ec_product.product_id = ec_categoryitem.product_id AND ec_categoryitem.category_id = %d ) as product_count FROM ec_manufacturer ORDER BY name ASC", $category_id );
			
		}else if( $level > 0 ){
			$sql = $this->mysqli->prepare( "SELECT manufacturer_id, name, (SELECT COUNT( ec_product.product_id )FROM ec_product WHERE ec_product.activate_in_store = 1 AND ec_product.manufacturer_id = ec_manufacturer.manufacturer_id AND ( ec_product.menulevel1_id_%d = %d OR ec_product.menulevel2_id_%d = %d OR ec_product.menulevel3_id_%d = %d ) ) as product_count FROM ec_manufacturer ORDER BY name ASC", $level, $menuid, $level, $menuid, $level, $menuid );
		
		}else{
			$sql = "SELECT manufacturer_id, name, (SELECT COUNT( ec_product.product_id )FROM ec_product WHERE ec_product.activate_in_store = 1 AND ec_product.show_on_startup = 1 AND ec_product.manufacturer_id = ec_manufacturer.manufacturer_id) as product_count FROM ec_manufacturer ORDER BY name ASC";
		
		}
		
		return $this->mysqli->get_results( $sql );	
	
	}
	
	public function get_groups( ){
		
		return $this->mysqli->get_results( "SELECT ec_category.category_id, ec_category.category_name, ec_category.post_id FROM ec_category ORDER BY ec_category.category_name ASC" );	
	}
	
	public function get_pricepoint_row( $pricepoint_id ){
		$sql = "SELECT 
					ec_pricepoint.pricepoint_id, 
					ec_pricepoint.is_less_than, 
					ec_pricepoint.is_greater_than, 
					ec_pricepoint.low_point, 
					ec_pricepoint.high_point, 
					(
						SELECT COUNT( ec_product.product_id ) 
						FROM ec_product 
						WHERE 
						ec_product.activate_in_store = 1 AND 
						ec_product.show_on_startup = 1 AND 
						ec_product.price < ec_pricepoint.high_point
					) as product_count_below,
					(
						SELECT COUNT( ec_product.product_id )
						FROM ec_product 
						WHERE 
						ec_product.activate_in_store = 1 AND 
						ec_product.show_on_startup = 1 AND 
						ec_product.price > ec_pricepoint.low_point
					) as product_count_above,
					(
						SELECT COUNT( ec_product.product_id )
						FROM ec_product 
						WHERE 
						ec_product.activate_in_store = 1 AND 
						ec_product.show_on_startup = 1 AND 
						ec_product.price <= ec_pricepoint.high_point AND 
						ec_product.price >= ec_pricepoint.low_point
					) as product_count_between
					 FROM ec_pricepoint 
					 WHERE ec_pricepoint.pricepoint_id = %d
					 ORDER BY ec_pricepoint.order ASC";
					 
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $pricepoint_id ) );
	}
	
	public function get_pricepoints( $level, $menuid, $manufacturerid, $category_id ){
		if( $manufacturerid )
			$man_sql = $this->mysqli->prepare( " AND ec_product.manufacturer_id = %d", $manufacturerid );
		else
			$man_sql = "";
			
		if( $category_id ){
			$cat_from_sql = ", ec_categoryitem ";
			$cat_sql = $this->mysqli->prepare( " AND ec_product.product_id = ec_categoryitem.product_id AND ec_categoryitem.category_id = %d", $category_id );
		}else{
			$cat_from_sql = " ";
			$cat_sql = "";
		}
		
		$show_on_startup = "";
		if( $menuid == 0 && $category_id == 0 )
			$show_on_startup = "ec_product.show_on_startup = 1 AND ";
		
		if( $level == 0 )
			$sql = "SELECT 
					ec_pricepoint.pricepoint_id, 
					ec_pricepoint.is_less_than, 
					ec_pricepoint.is_greater_than, 
					ec_pricepoint.low_point, 
					ec_pricepoint.high_point, 
					(
						SELECT COUNT( ec_product.product_id ) 
						FROM ec_product" . $cat_from_sql . "
						WHERE 
						ec_product.activate_in_store = 1 AND 
						".$show_on_startup."
						ec_product.price < ec_pricepoint.high_point
						" . $man_sql . "
						" . $cat_sql . "
					) as product_count_below,
					(
						SELECT COUNT( ec_product.product_id )
						FROM ec_product" . $cat_from_sql . "
						WHERE 
						ec_product.activate_in_store = 1 AND 
						".$show_on_startup."
						ec_product.price > ec_pricepoint.low_point
						" . $man_sql . "
						" . $cat_sql . "
					) as product_count_above,
					(
						SELECT COUNT( ec_product.product_id )
						FROM ec_product" . $cat_from_sql . "
						WHERE 
						ec_product.activate_in_store = 1 AND 
						".$show_on_startup."
						ec_product.price <= ec_pricepoint.high_point AND 
						ec_product.price >= ec_pricepoint.low_point
						" . $man_sql . "
						" . $cat_sql . "
					) as product_count_between
					 FROM ec_pricepoint 
					 ORDER BY ec_pricepoint.order ASC";
		else
			$sql = $this->mysqli->prepare( "SELECT 
					ec_pricepoint.pricepoint_id, 
					ec_pricepoint.is_less_than, 
					ec_pricepoint.is_greater_than, 
					ec_pricepoint.low_point, 
					ec_pricepoint.high_point, 
					(
						SELECT COUNT( ec_product.product_id ) 
						FROM ec_product" . $cat_from_sql . "
						WHERE 
						ec_product.activate_in_store = 1 AND 
						ec_product.price < ec_pricepoint.high_point AND
						( ec_product.menulevel1_id_%d = %d OR ec_product.menulevel2_id_%d = %d OR ec_product.menulevel3_id_%d = %d )
						" . $man_sql . "
						" . $cat_sql . "
					) as product_count_below,
					(
						SELECT COUNT( ec_product.product_id )
						FROM ec_product" . $cat_from_sql . "
						WHERE 
						ec_product.activate_in_store = 1 AND 
						ec_product.price > ec_pricepoint.low_point AND
						( ec_product.menulevel1_id_%d = %d OR ec_product.menulevel2_id_%d = %d OR ec_product.menulevel3_id_%d = %d )
						" . $man_sql . "
						" . $cat_sql . "
					) as product_count_above,
					(
						SELECT COUNT( ec_product.product_id )
						FROM ec_product" . $cat_from_sql . "
						WHERE 
						ec_product.activate_in_store = 1 AND 
						ec_product.price <= ec_pricepoint.high_point AND 
						ec_product.price >= ec_pricepoint.low_point AND
						( ec_product.menulevel1_id_%d = %d OR ec_product.menulevel2_id_%d = %d OR ec_product.menulevel3_id_%d = %d )
						" . $man_sql . "
						" . $cat_sql . "
					) as product_count_between
					 FROM ec_pricepoint 
					 ORDER BY ec_pricepoint.order ASC", $level, $menuid, $level, $menuid, $level, $menuid, $level, $menuid, $level, $menuid, $level, $menuid, $level, $menuid, $level, $menuid, $level, $menuid );
					 
		
		return $this->mysqli->get_results( $sql );	
	}
	
	public function get_menuname( $menu_id, $menu_level ){
		if( $menu_level == 1 )
			return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT name FROM ec_menulevel1 WHERE menulevel1_id = %d", $menu_id ) );
		else if( $menu_level == 2 )
			return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT name FROM ec_menulevel2 WHERE menulevel2_id = %d", $menu_id ) );
		else if( $menu_level == 3 )
			return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT name FROM ec_menulevel3 WHERE menulevel3_id = %d", $menu_id ) );
	}
	
	public function get_menulevel1_id( $menulevel1_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT ec_menulevel1.menulevel1_id FROM ec_menulevel1 WHERE ec_menulevel1.menulevel1_id = %d", $menulevel1_id ) );
	}
	
	public function get_menulevel2_id( $menulevel2_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT ec_menulevel2.menulevel2_id FROM ec_menulevel2 WHERE ec_menulevel2.menulevel2_id = %d", $menulevel2_id ) );
	}
	
	public function get_menulevel3_id( $menulevel3_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT ec_menulevel3.menulevel3_id FROM ec_menulevel3 WHERE ec_menulevel3.menulevel3_id = %d", $menulevel3_id ) );
	}
	
	public function get_menulevel1_id_from_menulevel2( $menulevel2_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT ec_menulevel2.menulevel1_id FROM ec_menulevel2 WHERE ec_menulevel2.menulevel2_id = %d", $menulevel2_id ) );
	}
	
	
	public function get_menulevel2_id_from_menulevel3( $menulevel3_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT ec_menulevel3.menulevel2_id FROM ec_menulevel3 WHERE ec_menulevel3.menulevel3_id = %d", $menulevel3_id ) );
	}
	
	public function get_customer_reviews( $product_id ){
		return $this->mysqli->get_results( "SELECT ec_review.review_id, ec_review.rating, ec_review.title, ec_review.description, ec_review.approved, DATE_FORMAT(ec_review.date_submitted, '%W, %M %e, %Y') as review_date, ec_user.first_name, ec_user.last_name " . $this->mysqli->prepare( "FROM ec_review LEFT JOIN ec_user ON ec_user.user_id = ec_review.user_id WHERE product_id = %d AND approved = 1 ORDER BY date_submitted DESC", $product_id ) );
	}
	
	public function get_temp_cart( $session_id ){
		$sql = "SELECT 
				product.product_id,
				product.model_number,
				product.post_id,
				product.manufacturer_id,
				product.price,
				product.handling_price,
				product.handling_price_each,
				product.vat_rate,
				product.title,
				product.description,
				product.image1,
				product.weight,
				product.width,
				product.height,
				product.length,
				product.is_giftcard,
				product.is_download,
				product.is_donation,
				product.is_taxable,
				product.is_shippable,
				product.download_file_name,
				product.use_optionitem_quantity_tracking,
				product.show_stock_quantity,
				product.maximum_downloads_allowed,
				product.download_timelimit_seconds,
				product.use_advanced_optionset,
				product.is_amazon_download,
				product.amazon_key,
				product.include_code,
				product.min_purchase_quantity,
				product.max_purchase_quantity,
				product.subscription_signup_fee,
				product.subscription_prorate,
				product.TIC,
				
				product.allow_backorders,
				product.backorder_fill_date,
				product.stock_quantity,
				
				tempcart.tempcart_id as cartitem_id,
				tempcart.quantity,
				tempcart.grid_quantity,
				optionitemimage.image1 as optionitemimage_image1,
				
				CONCAT_WS('***', optionitem1.optionitem_name, optionitem1.optionitem_price, option1.option_name, optionitem1.optionitem_id, optionitem1.optionitem_model_number) as optionitem1_data,
				CONCAT_WS('***', optionitem2.optionitem_name, optionitem2.optionitem_price, option2.option_name, optionitem2.optionitem_id, optionitem2.optionitem_model_number) as optionitem2_data,
				CONCAT_WS('***', optionitem3.optionitem_name, optionitem3.optionitem_price, option3.option_name, optionitem3.optionitem_id, optionitem3.optionitem_model_number) as optionitem3_data,
				CONCAT_WS('***', optionitem4.optionitem_name, optionitem4.optionitem_price, option4.option_name, optionitem4.optionitem_id, optionitem4.optionitem_model_number) as optionitem4_data,
				CONCAT_WS('***', optionitem5.optionitem_name, optionitem5.optionitem_price, option5.option_name, optionitem5.optionitem_id, optionitem5.optionitem_model_number) as optionitem5_data,
				 
				tempcart.gift_card_message, 
				tempcart.gift_card_to_name, 
				tempcart.gift_card_email, 
				tempcart.gift_card_from_name,
				
				tempcart.is_deconetwork,
				tempcart.deconetwork_id,
				tempcart.deconetwork_name,
				tempcart.deconetwork_product_code,
				tempcart.deconetwork_options,
				tempcart.deconetwork_edit_link,
				tempcart.deconetwork_color_code,
				tempcart.deconetwork_product_id,
				tempcart.deconetwork_image_link,
				tempcart.deconetwork_discount,
				tempcart.deconetwork_tax,
				tempcart.deconetwork_total,
				tempcart.deconetwork_version,
				
				tempcart.donation_price,
				";
		
		if( isset( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ) ){
			for( $i=0; $i<count( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ); $i++ ){
				$arr = $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'][$i][0]( array( ), array( ) );
				for( $j=0; $j<count( $arr ); $j++ ){
					$sql .= "tempcart." . $arr[$j] . ", ";
				}
			}
		}
				
		$sql .=	"
				( 
					SELECT GROUP_CONCAT( CONCAT_WS('***', ec_pricetier.price, ec_pricetier.quantity) SEPARATOR '---' ) 
					FROM ec_pricetier 
					WHERE ec_pricetier.`product_id` = tempcart.product_id 
					ORDER BY ec_pricetier.quantity ASC 
				) as pricetier_data
				
				FROM 
				ec_tempcart as tempcart
				
				LEFT JOIN ec_product as product
				ON product.product_id = tempcart.product_id
				
				LEFT JOIN ec_optionitem as optionitem1
				ON optionitem1.optionitem_id = tempcart.optionitem_id_1
				
				LEFT JOIN ec_optionitemimage as optionitemimage
				ON (optionitemimage.product_id = product.product_id AND optionitemimage.optionitem_id = optionitem1.optionitem_id)
				
				LEFT JOIN ec_option as option1
				ON option1.option_id = optionitem1.option_id
				
				LEFT JOIN ec_optionitem as optionitem2
				ON optionitem2.optionitem_id = tempcart.optionitem_id_2
				
				LEFT JOIN ec_option as option2
				ON option2.option_id = optionitem2.option_id
				
				LEFT JOIN ec_optionitem as optionitem3
				ON optionitem3.optionitem_id = tempcart.optionitem_id_3
				
				LEFT JOIN ec_option as option3
				ON option3.option_id = optionitem3.option_id
				
				LEFT JOIN ec_optionitem as optionitem4
				ON optionitem4.optionitem_id = tempcart.optionitem_id_4
				
				LEFT JOIN ec_option as option4
				ON option4.option_id = optionitem4.option_id
				
				LEFT JOIN ec_optionitem as optionitem5
				ON optionitem5.optionitem_id = tempcart.optionitem_id_5
				
				LEFT JOIN ec_option as option5
				ON option5.option_id = optionitem5.option_id
				
				WHERE 
				tempcart.session_id = '%s'
				
				ORDER BY
				product.title ASC
				";
				
		$cart_array = $this->mysqli->get_results( $this->mysqli->prepare( $sql, $session_id ) );
		$cart = array();
		foreach($cart_array as $row){
			array_push($cart, new ec_cartitem( $row ) );
		}
		return $cart;
	}
	
	public function get_cart_data( $session_id ){
		
		$cart_data = $this->mysqli->get_row( $this->mysqli->prepare( "SELECT ec_tempcart_data.* FROM ec_tempcart_data WHERE ec_tempcart_data.session_id = %s", $session_id ) );
		if( $cart_data ){
			return $cart_data;
		}else{
			$this->mysqli->query( $this->mysqli->prepare( "INSERT INTO ec_tempcart_data( ec_tempcart_data.session_id ) VALUES( %s )", $session_id ) );
			$cart_data = $this->mysqli->get_row( $this->mysqli->prepare( "SELECT ec_tempcart_data.* FROM ec_tempcart_data WHERE ec_tempcart_data.session_id = %s", $session_id ) );
			return $cart_data;
		}
	}
	
	public function save_cart_data( $ec_cart_id, $cart_data ){
		
		$this->remove_cart_data( $ec_cart_id );
			
		$sql = "INSERT INTO ec_tempcart_data( session_id";
		$sql_values = " VALUES(%s";
		$insert_vals = array( $ec_cart_id );
		
		foreach( $cart_data as $key => $value ){
			
			if( $key != "session_id" && $key != "tempcart_data_id" ){
			
				$sql .= ", " . $key;
				$sql_values .= ", %s";
				$insert_vals[] = $value;
				
			}
			
		}
		
		$sql .= ")";
		$sql_values .= ")";
		
		$this->mysqli->query( $this->mysqli->prepare( $sql . $sql_values, $insert_vals ) );
		
	}
	
	public function remove_cart_data( $session_id ){
		
		$this->mysqli->query( $this->mysqli->prepare( "DELETE FROM ec_tempcart_data WHERE ec_tempcart_data.session_id = %s", $session_id ) );
	
	}
	
	public function remove_user_data( $user_id ){
		
		$this->mysqli->query( $this->mysqli->prepare( "DELETE FROM ec_tempcart_data WHERE ec_tempcart_data.user_id = %s", $user_id ) );
	
	}
	
	// IN: the Product ID
	// OUT: Product array (
	public function get_cart_product( $productid ){
			
	}
	
	public function get_menu_items(){
		$sql = "SELECT menulevel1.name as menu1_name, menulevel1.menulevel1_id, menulevel1.post_id as menulevel1_post_id, menulevel2.name as menu2_name, menulevel2.menulevel2_id, menulevel2.post_id as menulevel2_post_id, menulevel3.name as menu3_name, menulevel3.menulevel3_id, menulevel3.post_id as menulevel3_post_id FROM ec_menulevel1 as menulevel1 LEFT JOIN ec_menulevel2 as menulevel2 ON menulevel2.menulevel1_id = menulevel1.menulevel1_id LEFT JOIN ec_menulevel3 as menulevel3 ON menulevel3.menulevel2_id = menulevel2.menulevel2_id ORDER BY menulevel1.order, menulevel1.menulevel1_id, menulevel2.order, menulevel2.menulevel2_id, menulevel3.order, menulevel3.menulevel3_id";
		$result = $this->mysqli->get_results($sql);
		return $result;
	}
	
	public function get_menulevel1_items( ){
		$sql = "SELECT menulevel1.name as menu1_name, menulevel1.menulevel1_id, menulevel1.post_id as menulevel1_post_id FROM ec_menulevel1 as menulevel1 ORDER BY menulevel1.order";
		return $this->mysqli->get_results($sql);
	}
	
	public function get_menulevel2_items( ){
		$sql = "SELECT menulevel2.menulevel1_id, menulevel2.name as menu2_name, menulevel2.menulevel2_id, menulevel2.post_id as menulevel2_post_id FROM ec_menulevel2 as menulevel2 ORDER BY menulevel2.order";
		return $this->mysqli->get_results($sql);
	}
	
	public function get_menulevel3_items( ){
		$sql = "SELECT menulevel3.menulevel2_id, menulevel3.name as menu3_name, menulevel3.menulevel3_id, menulevel3.post_id as menulevel3_post_id FROM ec_menulevel3 as menulevel3 ORDER BY menulevel3.order";
		return $this->mysqli->get_results($sql);
	}
	
	public function submit_customer_review( $product_id, $rating, $title, $description, $user_id = 0 ){
		return $this->mysqli->insert( 	'ec_review', 
										array( 	'product_id' => $product_id, 
												'user_id' => $user_id, 
												'rating' => $rating, 
												'title' => $title, 
												'description' => $description 
										), 
										array( '%d', '%d', '%d', '%s', '%s' )
									);
	}
	
	public function get_category_items( &$level, $menu_id, $submenu_id, $subsubmenu_id ){
		$sql_level0 = "SELECT 
						ec_menulevel1.name as menu_name, 
						ec_menulevel1.menulevel1_id as menu_id,
						ec_menulevel1.post_id as post_id,
						( 	SELECT count( ec_product.product_id ) 
							FROM ec_product 
							WHERE 
							ec_product.activate_in_store = 1 AND 
							(
								ec_menulevel1.menulevel1_id = ec_product.menulevel1_id_1 OR
								ec_menulevel1.menulevel1_id = ec_product.menulevel2_id_1 OR
								ec_menulevel1.menulevel1_id = ec_product.menulevel3_id_1
							)
						) as product_count
						
						FROM 
						ec_menulevel1
						 
						ORDER BY 
						ec_menulevel1.order"; 
						
		$sql_level1 = "SELECT 
						ec_menulevel2.name as menu_name, 
						ec_menulevel2.menulevel2_id as menu_id, 
						ec_menulevel2.post_id as post_id,
						( 	SELECT count( ec_product.product_id ) 
							FROM ec_product 
							WHERE 
							ec_product.activate_in_store = 1 AND 
							(
								ec_menulevel2.menulevel2_id = ec_product.menulevel1_id_2 OR
								ec_menulevel2.menulevel2_id = ec_product.menulevel2_id_2 OR
								ec_menulevel2.menulevel2_id = ec_product.menulevel3_id_2
							)
						) as product_count
						
						FROM ec_menulevel2 
						
						WHERE ec_menulevel2.menulevel1_id = %d 
						
						ORDER BY ec_menulevel2.order";
						
		$sql_level2 = "SELECT 
						ec_menulevel3.name as menu_name, 
						ec_menulevel3.menulevel3_id as menu_id, 
						ec_menulevel3.post_id as post_id,
						( 	SELECT count( ec_product.product_id ) 
							FROM ec_product 
							WHERE 
							ec_product.activate_in_store = 1 AND 
							(
								ec_menulevel3.menulevel3_id = ec_product.menulevel1_id_3 OR
								ec_menulevel3.menulevel3_id = ec_product.menulevel2_id_3 OR
								ec_menulevel3.menulevel3_id = ec_product.menulevel3_id_3
							)
						) as product_count
						
						FROM ec_menulevel3 
						
						WHERE ec_menulevel3.menulevel2_id = %d 
						
						ORDER BY ec_menulevel3.order";
		
		$sql_get_menuid = "SELECT ec_menulevel2.menulevel1_id FROM ec_menulevel2 WHERE ec_menulevel2.menulevel2_id = %d";
		$sql_get_submenuid = "SELECT ec_menulevel3.menulevel2_id FROM ec_menulevel3 WHERE ec_menulevel3.menulevel3_id = %d";
		
		if( $level == 0 ){
			return $this->mysqli->get_results( $sql_level0 );
		
		}else if( $level == 1 ){
			$results = $this->mysqli->get_results( $this->mysqli->prepare( $sql_level1, $menu_id ) );
			if( count( $results ) > 0 )
				return $results;
			else{
				$level = 0;
				return $this->mysqli->get_results( $sql_level0 );
			}
				
		}else if( $level == 2 ){ 
			$results = $this->mysqli->get_results( $this->mysqli->prepare( $sql_level2, $submenu_id ) );
			if( count( $results ) > 0 )
				return $results;
			else{
				$level = 1;
				$menu_id = $this->mysqli->get_var( $this->mysqli->prepare( $sql_get_menuid, $submenu_id ) );
				return $this->mysqli->get_results( $this->mysqli->prepare( $sql_level1, $menu_id ) );
			}
			
		}else if( $level == 3 ){
			$level = 2;
			$submenu_id = $this->mysqli->get_var( $this->mysqli->prepare( $sql_get_submenuid, $subsubmenu_id ) );
			$results = $this->mysqli->get_results( $this->mysqli->prepare( $sql_level2, $submenu_id ) );
			
			if( count( $results ) > 0 )
				return $results;
			else{
				$level = 1;
				$menuid = $this->mysqli->get_var( $this->mysqli->prepare( $sql_get_menuid, $submenu_id ) );
				return $this->mysqli->get_results(  $this->mysqli->prepare( $sql_level1, $menu_id ) );
			}
		}
	}
	
	public function get_promotions( ){
		return $this->mysqli->get_results( "SELECT 
											ec_promotion.promotion_id, ec_promotion.type as promotion_type, ec_promotion.name as promotion_name,
											ec_promotion.start_date, ec_promotion.end_date, 
											ec_promotion.product_id_1, ec_promotion.product_id_2, ec_promotion.product_id_3, 
											ec_promotion.manufacturer_id_1, ec_promotion.manufacturer_id_2, ec_promotion.manufacturer_id_3, 
											ec_promotion.category_id_1, ec_promotion.category_id_2, ec_promotion.category_id_3, 
											ec_promotion.price1, ec_promotion.price2, ec_promotion.price3, 
											ec_promotion.percentage1, ec_promotion.percentage2, ec_promotion.percentage3, 
											ec_promotion.number1, ec_promotion.number2, ec_promotion.number3, 
											ec_promotion.limit as product_limit,
											NOW() as currdate
											
											FROM ec_promotion 
											HAVING ec_promotion.start_date <= currdate AND ec_promotion.end_date >= currdate" );
	}
	
	public function has_category_match( $category_id, $product_id ){
		$count = $this->mysqli->get_var( $this->mysqli->prepare( "SELECT COUNT( categoryitem_id ) FROM ec_categoryitem WHERE category_id = %d AND product_id = %d", $category_id, $product_id ) );
		if( $count > 0 )
			return true;
		else
			return false;
	}
	
	public function add_to_cart( $product_id, $session_id, $quantity, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3, $optionitem_id_4, $optionitem_id_5, $gift_card_message="", $gift_card_to_name="", $gift_card_from_name="", $donation_price=0.00, $use_advanced_optionset=false, $return_tempcart=1, $gift_card_email="" ){
		
		// Get the limit on this product
		$product_sql = "SELECT stock_quantity, use_optionitem_quantity_tracking, show_stock_quantity, allow_backorders, max_purchase_quantity, min_purchase_quantity FROM ec_product WHERE product_id = %d";
		$optionitem_sql = "SELECT quantity FROM ec_optionitemquantity WHERE product_id = %d AND optionitem_id_1 = %d AND optionitem_id_2 = %d AND optionitem_id_3 = %d AND optionitem_id_4 = %d AND optionitem_id_5 = %d";
		$tempcart_optionitem_sql = "SELECT quantity FROM ec_tempcart WHERE session_id = '%s' AND product_id = %d AND optionitem_id_1 = %d AND optionitem_id_2 = %d AND optionitem_id_3 = %d AND optionitem_id_4 = %d AND optionitem_id_5 = %d";
		
		$tempcart_sql = "SELECT SUM(quantity) as quantity FROM ec_tempcart WHERE session_id = '%s' AND product_id = %d";
		
		$stock_quantity = 99999999999; // very large limit... nearly infinite really
		
		//Get this product stock quantity and use_optionitem_quantity tracking
		$product = $this->mysqli->get_row( $this->mysqli->prepare( $product_sql, $product_id ) );
		//Get this tempcart item quantity
		$tempcart_optionitem = $this->mysqli->get_row( $this->mysqli->prepare( $tempcart_optionitem_sql, $session_id, $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3, $optionitem_id_4, $optionitem_id_5 ) );
		//Get this tempcart total quantity
		$tempcart = $this->mysqli->get_row( $this->mysqli->prepare( $tempcart_sql, $session_id, $product_id ) );
		
		$optionitem_quantity = $this->mysqli->get_row( $this->mysqli->prepare( $optionitem_sql, $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3, $optionitem_id_4, $optionitem_id_5 ) );
		
		if( $product->use_optionitem_quantity_tracking == 1 ){
			$stock_quantity = $optionitem_quantity->quantity;
		}else if( isset( $product->show_stock_quantity ) && $product->show_stock_quantity == 1 ){
			$stock_quantity = $product->stock_quantity;
		}else{
			$stock_quantity = 1000000;
		}
		
		if( $stock_quantity <= 0 && $product->allow_backorders )
			$stock_quantity = 1000000;
		
		if( $gift_card_message != "" || $gift_card_from_name != "" || $gift_card_from_name != "" || $gift_card_email != "" ){
			// Do nothing, use quantity entered.
			
		// OPTION ITEM QUANTITY TRACKING AND ENTERED QUANITTY GOES OVER ITEM LIMIT
		// IF    1. Using advanced option items
		//		 2. using basic quantity tracking
		//       2. quantity in cart + new quantity is greater than the amount in stock
		// THEN     use max for that option item set
		}else if( $use_advanced_optionset && isset( $product->show_stock_quantity ) && $quantity + $tempcart->quantity > $stock_quantity ){
			$quantity = $stock_quantity - $tempcart->quantity;
			if( $quantity == 0 ){
				return 0;
			}
			
		// OPTION ITEM QUANTITY TRACKING AND ENTERED QUANITTY GOES OVER ITEM LIMIT
		// IF    1. using advanced option items
		//       2. quantity must not be exceding stock quantity OR we are not tracking it for this product
		// THEN     use the actual quantity value
		}else if( $use_advanced_optionset ){
			// Do nothing to the quantity value
			
		//Get the quantity for the new tempcart item (insert or update)
		// OPTION ITEM QUANTITY TRACKING AND ENTERED QUANITTY GOES OVER ITEM LIMIT
		// IF    1. using option item quantity tracking
		//       2. quantity + item in cart with same options quantity > amount available for this option
		// THEN     use max for that option item set
		}else if( $product->use_optionitem_quantity_tracking == 1 && isset( $tempcart_optionitem ) && $quantity + $tempcart_optionitem->quantity > $stock_quantity ){
			$quantity = $stock_quantity;
		
		// OPTION ITEM QUANTITY TRACKING AND AMOUNT ENTERED IS TOO MUCH
		// IF    1. using option item quanitty tracking
		//       2. item with theme options is not in the cart yet
		// THEN     use the quantity entered by the user
		}else if( $product->use_optionitem_quantity_tracking == 1 && $quantity > $stock_quantity ){
			$quantity = $stock_quantity;
		
		
		// OIQT + Valid Quantity -- Add the quantities up for updating the item
		}else if( $product->use_optionitem_quantity_tracking == 1 && isset( $tempcart_optionitem )  ){
			$quantity = $quantity + $tempcart_optionitem->quantity;
		
		// OIQT + Valid quantity and none in cart, use value entered
		}else if( $product->use_optionitem_quantity_tracking == 1 ){
			
		// BASIC QUANTITY TRACKING and THIS OPTION CHOICE IS IN CART and ENTERED QUANTITY + ALL QUANITY OF SAME PROD IDS MORE THAN QUANTITY IN STOCK
		// IF    1. using general quantity tracking
		//       2. quantity + the quantity of all items with same product id > amount available
		// THEN     use the total in stock - the total in cart so far
		}else if( isset( $product->show_stock_quantity ) && isset( $tempcart_optionitem ) && $quantity + $tempcart->quantity > $stock_quantity ){			
			$quantity = $stock_quantity - $tempcart->quantity + $tempcart_optionitem->quantity;
		
		// BASIC QUANTITY TRACKING and THIS OPTION CHOICE IS NOT IN CART and ENTERED QUANTITY + ALL QUANITY OF SAME PROD IDS MORE THAN QUANTITY IN STOCK
		// IF    1. using general quantity tracking
		//       2. quantity + the quantity of all items with same product id > amount available
		// THEN     use the total in stock - the total in cart so far
		}else if( isset( $product->show_stock_quantity ) && $quantity + $tempcart->quantity > $stock_quantity ){			
			$quantity = $stock_quantity - $tempcart->quantity;
		
		// BASIC QUANTITY TRACKING and THIS OPTION CHOICE IS IN CART
		// IF    1. using general quantity tracking
		//       2. quantity + the quantity of all items with same product id > amount available
		// THEN     use the total in stock - the total in cart so far
		}else if( isset( $product->show_stock_quantity ) && isset( $tempcart_optionitem ) ){			
			$quantity = $quantity + $tempcart_optionitem->quantity;	
		
		// BASIC QUANTITY TRACKING and THIS OPTION CHOICE IS NOT IN CART
		// IF    1. using general quantity tracking
		//       2. quantity + the quantity of all items with same product id > amount available
		// THEN     use the total in stock - the total in cart so far
		}else if( isset( $product->show_stock_quantity ) ){			
			// USE QUANTITY ENTERED
		
		// NO QUANITTY TRACKING
		// THEN     use the quantity entered + the quantity for this option item in cart
		}else{																		
			if( isset( $tempcart_optionitem ) )
				$quantity = $quantity + $tempcart_optionitem->quantity;
		}
		
		// First check for an item with the same option items IF NOT a gift card
		$sql = "SELECT COUNT(tempcart_id) AS total_rows FROM ec_tempcart WHERE session_id = '%s' AND product_id = %d AND optionitem_id_1 = %d AND optionitem_id_2 = %d AND optionitem_id_3 = %d AND optionitem_id_4 = %d AND optionitem_id_5 = %d";
		$insert = $this->mysqli->get_var( $this->mysqli->prepare( $sql, $session_id, $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3, $optionitem_id_4, $optionitem_id_5 ) );
		
		if( $use_advanced_optionset || $gift_card_message != "" || $gift_card_from_name != "" || $gift_card_to_name != "" || ( $insert == 0 && $quantity > 0 ) ){
			
			if( $quantity < $product->min_purchase_quantity && $product->min_purchase_quantity != 0 )
				$quantity = $product->min_purchase_quantity;
				
			if( $quantity > $product->max_purchase_quantity && $product->max_purchase_quantity != 0 )
				$quantity = $product->max_purchase_quantity;
				
			$this->mysqli->insert( 'ec_tempcart', 
										array( 	'product_id' 					=> $product_id,
												'session_id' 					=> $session_id, 
												'quantity'						=> $quantity, 
												'optionitem_id_1' 				=> $optionitem_id_1, 
												'optionitem_id_2' 				=> $optionitem_id_2, 
												'optionitem_id_3'				=> $optionitem_id_3, 
												'optionitem_id_4' 				=> $optionitem_id_4, 
												'optionitem_id_5' 				=> $optionitem_id_5, 
												'gift_card_message' 			=> $gift_card_message, 
												'gift_card_from_name' 			=> $gift_card_from_name, 
												'gift_card_to_name' 			=> $gift_card_to_name,
												'gift_card_email' 				=> $gift_card_email,
												'donation_price'				=> $donation_price
										), 
										array( '%d', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s' )
									);							
		}else if($insert != 0){
			
			if( $quantity < $product->min_purchase_quantity && $product->min_purchase_quantity != 0 )
				$quantity = $product->min_purchase_quantity;
				
			if( $quantity > $product->max_purchase_quantity && $product->max_purchase_quantity != 0 )
				$quantity = $product->max_purchase_quantity;
				
			$this->mysqli->update(	'ec_tempcart', 
										array(	'quantity'						=> $quantity ),
										array( 	'product_id' 					=> $product_id,
												'session_id' 					=> $session_id, 
												'optionitem_id_1' 				=> $optionitem_id_1, 
												'optionitem_id_2' 				=> $optionitem_id_2, 
												'optionitem_id_3'				=> $optionitem_id_3, 
												'optionitem_id_4' 				=> $optionitem_id_4, 
												'optionitem_id_5' 				=> $optionitem_id_5
										), 
										array( '%d', '%d', '%s', '%d', '%d', '%d', '%d', '%d' )
								  );	
		}
		
		if( $return_tempcart )
			return $this->get_temp_cart( $session_id );
		else
			return $this->mysqli->insert_id;
	}
	
	public function update_cartitem( $tempcart_id, $session_id, $quantity ){
		
		if( $quantity <= 0 ){ // If someone tries to update to 0 or less, just remove it from the cart
			
			$this->delete_cartitem( $tempcart_id, $session_id );
			
		}else{
		
			$tempcart_item_sql = "SELECT product_id, optionitem_id_1, optionitem_id_2, optionitem_id_3, optionitem_id_4, optionitem_id_5 FROM ec_tempcart WHERE tempcart_id = %d";
			$tempcart_item = $this->mysqli->get_row( $this->mysqli->prepare( $tempcart_item_sql, $tempcart_id ) );
			$product_id = $tempcart_item->product_id;
			$optionitem_id_1 = $tempcart_item->optionitem_id_1;
			$optionitem_id_2 = $tempcart_item->optionitem_id_2;
			$optionitem_id_3 = $tempcart_item->optionitem_id_3;
			$optionitem_id_4 = $tempcart_item->optionitem_id_4;
			$optionitem_id_5 = $tempcart_item->optionitem_id_5;
			
			// Get the limit on this product
			$product_sql = "SELECT show_stock_quantity, stock_quantity, use_optionitem_quantity_tracking, min_purchase_quantity, max_purchase_quantity FROM ec_product WHERE product_id = %d";
			$optionitem_sql = "SELECT quantity FROM ec_optionitemquantity WHERE product_id = %d AND optionitem_id_1 = %d AND optionitem_id_2 = %d AND optionitem_id_3 = %d AND optionitem_id_4 = %d AND optionitem_id_5 = %d";
			$tempcart_optionitem_sql = "SELECT quantity FROM ec_tempcart WHERE tempcart_id = %d";
			$tempcart_sql = "SELECT SUM(quantity) as quantity FROM ec_tempcart WHERE session_id = '%s' AND product_id = %d";
			
			$stock_quantity = 99999999999; // very large limit... nearly infinite really
			
			//Get this product stock quantity and use_optionitem_quantity tracking
			$product = $this->mysqli->get_row( $this->mysqli->prepare( $product_sql, $product_id ) );
			
			//Get this tempcart item quantity
			$tempcart_optionitem = $this->mysqli->get_row( $this->mysqli->prepare( $tempcart_optionitem_sql, $tempcart_id ) );
			
			//Get this tempcart total quantity
			$tempcart = $this->mysqli->get_row( $this->mysqli->prepare( $tempcart_sql, $session_id, $product_id ) );
			
			//Get the maximum for this option item
			$optionitem_quantity = $this->mysqli->get_row( $this->mysqli->prepare( $optionitem_sql, $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3, $optionitem_id_4, $optionitem_id_5 ) );
			
			if( $product->use_optionitem_quantity_tracking == 1 ){
				$stock_quantity = $optionitem_quantity->quantity;
			}else if( $product->show_stock_quantity == 1 ){
				$stock_quantity = $product->stock_quantity;
			}else{
				$stock_quantity = 1000000;
			}
			
			if( $product->use_optionitem_quantity_tracking == 1 ){
				if( $quantity > $stock_quantity ){			
					$quantity = $stock_quantity;
				}
				
			}else if( $product->show_stock_quantity == 1 && $tempcart->quantity + $quantity - $tempcart_optionitem->quantity > $stock_quantity ){			
				$quantity = $stock_quantity - ( $tempcart->quantity - $tempcart_optionitem->quantity );
			
			}else if( $product->show_stock_quantity == 1 && $quantity > $stock_quantity ){			
				$quantity = $stock_quantity;
			
			}
			
			// Don't allow less than the minimum
			if( $product->min_purchase_quantity > 0 && $quantity < $product->min_purchase_quantity ){
				$quantity = $product->min_purchase_quantity;
			}
			
			// Don't allow more than the maximum
			if( $product->max_purchase_quantity > 0 && $quantity > $product->max_purchase_quantity ){
				$quantity = $product->max_purchase_quantity;
			}
			
			// Don't allow negative quantities!
			if( $quantity < 0 )
				$quantity = 0;
			
			$sql = "UPDATE ec_tempcart SET quantity = %d WHERE tempcart_id = %d AND session_id = %s";
			$this->mysqli->query( $this->mysqli->prepare( $sql, $quantity, $tempcart_id, $session_id ) );
		
		}
							
	}
	
	public function delete_cartitem( $tempcart_id, $session_id ){
		$sql = "DELETE FROM ec_tempcart WHERE ec_tempcart.tempcart_id = '%s' AND ec_tempcart.session_id = '%s'";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $tempcart_id, $session_id ) );
		$this->mysqli->query( $this->mysqli->prepare( "DELETE FROM ec_tempcart_optionitem WHERE ec_tempcart_optionitem.tempcart_id = %d", $tempcart_id ) );
		
		$sql = "SELECT 

				SUM( ec_tempcart.quantity ) as quantity,
				
				SUM( 
					( ec_product.price + 
					  IFNULL(optionitem1.optionitem_price, 0) + 
					  IFNULL(optionitem2.optionitem_price, 0) + 
					  IFNULL(optionitem3.optionitem_price, 0) + 
					  IFNULL(optionitem4.optionitem_price, 0) + 
					  IFNULL(optionitem5.optionitem_price, 0) 
					) * ec_tempcart.quantity
				) as total_price 
				
				FROM 
				ec_tempcart 
				
				LEFT JOIN ec_product 
				ON ec_product.product_id = ec_tempcart.product_id 
				
				LEFT JOIN ec_optionitem as `optionitem1`
				ON optionitem1.`optionitem_id` = ec_tempcart.`optionitem_id_1`
				
				LEFT JOIN ec_optionitem as `optionitem2`
				ON optionitem2.`optionitem_id` = ec_tempcart.`optionitem_id_2`
				
				LEFT JOIN ec_optionitem as `optionitem3`
				ON optionitem3.`optionitem_id` = ec_tempcart.`optionitem_id_3`
				
				LEFT JOIN ec_optionitem as `optionitem4`
				ON optionitem4.`optionitem_id` = ec_tempcart.`optionitem_id_4`
				
				LEFT JOIN ec_optionitem as `optionitem5`
				ON optionitem5.`optionitem_id` = ec_tempcart.`optionitem_id_5`
				
				WHERE session_id = '%s'";
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $session_id ) );
	}
	
	public function get_shipping_data( ){
		$sql = "SELECT ec_shippingrate.shippingrate_id, ec_shippingrate.zone_id, ec_shippingrate.is_price_based, ec_shippingrate.is_weight_based, ec_shippingrate.is_method_based, ec_shippingrate.is_quantity_based, ec_shippingrate.is_percentage_based, ec_shippingrate.is_ups_based, ec_shippingrate.is_usps_based, ec_shippingrate.is_fedex_based, ec_shippingrate.is_auspost_based, ec_shippingrate.is_dhl_based, ec_shippingrate.is_canadapost_based, ec_shippingrate.trigger_rate, ec_shippingrate.shipping_rate, ec_shippingrate.shipping_label, ec_shippingrate.shipping_order, ec_shippingrate.shipping_code, ec_shippingrate.shipping_override_rate, ec_shippingrate.free_shipping_at FROM ec_shippingrate ORDER BY ec_shippingrate.is_price_based DESC, ec_shippingrate.is_weight_based DESC, ec_shippingrate.is_method_based DESC, ec_shippingrate.is_quantity_based DESC, ec_shippingrate.trigger_rate DESC, ec_shippingrate.trigger_rate DESC, ec_shippingrate.zone_id DESC, ec_shippingrate.shipping_order";
		return $this->mysqli->get_results( $sql );
		
	}
	
	public function redeem_coupon_code( $couponcode ){
		$sql = "SELECT 
				ec_promocode.promocode_id,
				ec_promocode.is_dollar_based, 
				ec_promocode.is_percentage_based, 
				ec_promocode.is_shipping_based, 
				ec_promocode.is_free_item_based, 
				ec_promocode.is_for_me_based, 
				ec_promocode.by_manufacturer_id, 
				ec_promocode.by_product_id, 
				ec_promocode.by_all_products, 
				ec_promocode.promo_dollar, 
				ec_promocode.promo_percentage, 
				ec_promocode.promo_shipping, 
				ec_promocode.promo_free_item, 
				ec_promocode.promo_for_me, 
				ec_promocode.manufacturer_id, 
				ec_promocode.product_id, 
				ec_promocode.message,
				ec_promocode.max_redemptions,
				ec_promocode.times_redeemed,
				IF( ec_promocode.expiration_date < NOW( ), 1, 0 ) as coupon_expired
				
				FROM 
				ec_promocode 
				
				WHERE 
				ec_promocode.promocode_id = '%s'";
				
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $couponcode ) );	
	}
	
	public function redeem_gift_card( $giftcardcode ){
		$sql = "SELECT 
				ec_giftcard.amount, 
				ec_giftcard.message 
				
				FROM 
				ec_giftcard
				
				WHERE 
				ec_giftcard.giftcard_id = '%s'";
				
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $giftcardcode ) );	
	}
	
	public function update_giftcard_total( $giftcard_code, $giftcard_discount ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_giftcard SET amount = amount - '%s' WHERE giftcard_id = '%s'", $giftcard_discount, $giftcard_code ) );
	}
	
	public function get_taxrates( ){
		$sql = "SELECT taxrate_id, tax_by_state, tax_by_country, tax_by_duty, tax_by_vat, tax_by_single_vat, tax_by_all, state_rate, country_rate, duty_rate, vat_rate, vat_added, vat_included, all_rate, state_code, country_code,vat_country_code, duty_exempt_country_code FROM ec_taxrate ORDER BY tax_by_vat, tax_by_single_vat, tax_by_duty, tax_by_all, tax_by_country, tax_by_state";
		return $this->mysqli->get_results( $sql );
	}
	
	public function get_registration_code( ){
		$sql = "SELECT ec_setting.reg_code FROM ec_setting WHERE ec_setting.setting_id = 1";
		return $this->mysqli->get_var( $sql );
	}
	
	public function install( $install_sql_array ){
		if( !$this->mysqli->get_var( "show tables like 'ec_product'" ) ){
		
			foreach( $install_sql_array as $stmt ){
				if( strlen( $stmt ) > 3 ){
					$this->mysqli->query( $stmt );
				}
			}
		
		}
		return true;
	} 
	
	public function upgrade( $upgrade_sql_array ){
		foreach( $upgrade_sql_array as $stmt ){
			if( strlen( $stmt ) > 3 ){
				$this->mysqli->query( $stmt );
			}
		}
		return true;
	} 
	
	public function uninstall( $install_sql_array ){
		foreach( $install_sql_array as $stmt ){
			if( strlen( $stmt ) > 3 ){
				$this->mysqli->query( $stmt );
			}
		}
		return true;
	} 
	
	public function update_url( $site_url ){
		//First check if tables exists
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_setting SET site_url = '%s'", $site_url ) );
	}
	
	public function get_shipping_method_name( $ship_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT shipping_label FROM ec_shippingrate WHERE shippingrate_id = '%s'", $ship_id ) );	
	}
	
	public function insert_order( $cart, $user, $shipping, $tax, $discount, $order_totals, $payment, $payment_type, $orderstatus_id, $order_notes, $order_gateway ){
		
		// Get Payment Method to Save
		if( $payment_type == "manual_bill" )
			$payment_type = $GLOBALS['language']->get_text( "account_order_details", "account_order_details_payment_method_manual" );
		else if( $payment_type == "third_party" )
			$payment_type = get_option( 'ec_option_payment_third_party' );
			
		if( $payment_type != "manual_bill" && $payment_type != "third_party" )
			$credit_card_last_four = substr( $payment->credit_card->card_number, -4 );
		else
			$credit_card_last_four = "";
		
		// Get Shipping Method to Save
		$shipping_method = "";
		if( !get_option( 'ec_option_use_shipping' ) || $cart->shipping_subtotal <= 0 ){
        	$shipping_method = "";
        }else if( $shipping->shipping_method == "fraktjakt" ){
			$shipping_method = $shipping->get_selected_shipping_method( );
			
		}else if( $GLOBALS['ec_cart_data']->cart_data->shipping_method != "" && $GLOBALS['ec_cart_data']->cart_data->shipping_method != "standard" )
			$shipping_method = $this->get_shipping_method_name( $GLOBALS['ec_cart_data']->cart_data->shipping_method );
		
		else if( ( $shipping->shipping_method == "price" || $shipping->shipping_method == "weight" ) && $GLOBALS['ec_cart_data']->cart_data->expedited_shipping != "" )
			$shipping_method = $GLOBALS['language']->get_text( "cart_estimate_shipping", "cart_estimate_shipping_express" );
		
		else
			$shipping_method = $GLOBALS['language']->get_text( "cart_estimate_shipping", "cart_estimate_shipping_standard" );
		
		// Gift Card and Coupon Code
		$coupon_code = $GLOBALS['ec_cart_data']->cart_data->coupon_code;
		$gift_card = $GLOBALS['ec_cart_data']->cart_data->giftcard;
			
		$expedited_shipping = 0;
		if($GLOBALS['ec_cart_data']->cart_data->expedited_shipping != "" )
			$expedited_shipping = $GLOBALS['ec_cart_data']->cart_data->expedited_shipping;
		
		$guest_key = $GLOBALS['ec_cart_data']->cart_data->guest_key;
		
		$agreed_to_terms = 0;
		if( isset( $_POST['ec_terms_agree'] ) && $_POST['ec_terms_agree'] == '1' )
			$agreed_to_terms = 1;
		
		$this->mysqli->insert(  'ec_order', 
								array( 	'user_id' 						=> $user->user_id, 
										'last_updated' 					=> date( 'Y-m-d H:i:s' ),
										'orderstatus_id'				=> $orderstatus_id,
										'order_weight' 					=> $cart->weight,
										'sub_total'						=> $order_totals->sub_total,
										
										'tax_total'						=> $order_totals->tax_total,
										'shipping_total'				=> $order_totals->shipping_total,
										'duty_total'					=> $order_totals->duty_total,
										'discount_total'				=> $order_totals->discount_total,
										'vat_total'						=> $order_totals->vat_total,
										'vat_total'						=> $order_totals->vat_total,
										'gst_total'						=> $order_totals->gst_total,
										'pst_total'						=> $order_totals->pst_total,
										'hst_total'						=> $order_totals->hst_total,
										
										'gst_rate'						=> $tax->gst_rate,
										'pst_rate'						=> $tax->pst_rate,
										'hst_rate'						=> $tax->hst_rate,
										
										'grand_total' 					=> $order_totals->grand_total,
										'promo_code'					=> $coupon_code,
										'giftcard_id'					=> $gift_card,
										'use_expedited_shipping'		=> $expedited_shipping,
										'shipping_method'				=> $shipping_method,
										
										'user_email'					=> $user->email,
										'user_level'					=> $user->user_level,
										'billing_first_name'			=> $user->billing->first_name,
										'billing_last_name'				=> $user->billing->last_name,
										'billing_company_name'			=> $user->billing->company_name,
										'billing_address_line_1'		=> $user->billing->address_line_1,
										
										'billing_address_line_2'		=> $user->billing->address_line_2,
										'billing_city'					=> $user->billing->city,
										'billing_state'					=> $user->billing->state,
										'billing_country'				=> $user->billing->country,
										'billing_zip'					=> $user->billing->zip,
										
										'billing_phone'					=> $user->billing->phone,
										'shipping_first_name'			=> $user->shipping->first_name,
										'shipping_last_name'			=> $user->shipping->last_name,
										'shipping_company_name'			=> $user->shipping->company_name,
										'shipping_address_line_1'		=> $user->shipping->address_line_1,
										'shipping_address_line_2'		=> $user->shipping->address_line_2,
										
										'shipping_city'					=> $user->shipping->city,
										'shipping_state'				=> $user->shipping->state,
										'shipping_country'				=> $user->shipping->country,
										'shipping_zip'					=> $user->shipping->zip,
										'shipping_phone'				=> $user->shipping->phone,
										
										'payment_method'				=> $payment_type,
										'order_customer_notes'			=> $order_notes,
										'creditcard_digits'				=> $credit_card_last_four,
										'order_gateway'					=> $order_gateway,
										
										'guest_key'						=> $guest_key,
										'agreed_to_terms'				=> $agreed_to_terms,
										'order_ip_address'				=> $_SERVER['REMOTE_ADDR']
								), 
								array( 	'%d', '%s', '%d', '%s', '%s', 
										'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', 
										'%s', '%s', '%s', 
										'%s', '%s', '%s', '%s', '%s', 
										'%s', '%s', '%s', '%s', '%s', '%s', 
										'%s', '%s', '%s', '%s', '%s', 
										'%s', '%s', '%s', '%s', '%s', '%s', 
										'%s', '%s', '%s', '%s', '%s', 
										'%s', '%s', '%s', '%s', 
										'%s', '%d', '%s'
								)
							);	
									
		$order_id = $this->mysqli->insert_id;
		
		// If coupon used, update usage numbers
		if( $coupon_code != "" ){
			$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_promocode SET times_redeemed = times_redeemed + 1 WHERE ec_promocode.promocode_id = %s", $coupon_code ) );
		}
		
		return $order_id;
		
	}
	
	public function update_order_status( $order_id, $orderstatus_id ){
		return $this->mysqli->update(  'ec_order',
									array( 'orderstatus_id' 	=> $orderstatus_id ),
									array( 'order_id'			=> $order_id ),
									array( '%d', '%d' )
								  );
								
	}
	
	public function get_order_id_from_temp_id( $temp_order_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT order_id FROM ec_order WHERE temp_order_id = '%s'", $temp_order_id ) );	
	}
	
	public function get_response_from_order_id( $order_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT is_error FROM ec_response WHERE order_id = '%s'", $order_id ) );
	}
	
	public function update_reponse_order_id( $order_id, $temp_order_id, $processor ){
		if( get_option( 'ec_option_enable_gateway_log' ) ){
			if( $processor == "Skrill" ){
				$this->mysqli->update( 'ec_response',
									array( 'order_id'		=> $order_id ),
									array( 'skrill_transaction_id'	=> $temp_order_id ),
									array( '%s', '%s' )
								  );
			}
		}
	}
	
	public function remove_order( $order_id ){
		$this->mysqli->query( $this->mysqli->prepare( "DELETE FROM ec_order WHERE order_id = %d", $order_id ) );
		
		$coupon_code = $GLOBALS['ec_cart_data']->cart_data->coupon_code;
		
		// If coupon used, update usage numbers
		if( $coupon_code != "" ){
			$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_promocode SET times_redeemed = times_redeemed - 1 WHERE ec_promocode.promocode_id = %s", $coupon_code ) );
		}
	}
	
	public function insert_address( $first_name, $last_name, $address_line_1, $address_line_2, $city, $state, $zip, $country, $phone, $company_name = "" ){
		$this->mysqli->insert(	'ec_address',
								array(	"first_name"		=> $first_name,
										"last_name"			=> $last_name,
										"address_line_1"	=> $address_line_1,
										"address_line_2"	=> $address_line_2,
										"city"				=> $city,
										"state"				=> $state,
										"zip"				=> $zip,
										"country"			=> $country,
										"phone"				=> $phone,
										"company_name"		=> $company_name
									  ),
								array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
							  );
		
		return $this->mysqli->insert_id;	
	}
	
	public function update_address( $address_id, $first_name, $last_name, $address_line_1, $address_line_2, $city, $state, $zip, $country, $phone, $company_name ){
		
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_address SET first_name = %s, last_name = %s, address_line_1 = %s, address_line_2 = %s, city = %s, state = %s, zip = %s, country = %s, phone = %s, company_name = %s WHERE address_id = %d", $first_name, $last_name, $address_line_1, $address_line_2, $city, $state, $zip, $country, $phone, $company_name, $address_id ) );	
	
	}
	
	public function insert_user( $email, $password, $first_name, $last_name, $billing_id, $shipping_id, $user_level, $is_subscriber, $user_notes = "" ){
		if( $is_subscriber )
			$this->insert_subscriber( $email, $first_name, $last_name );
		else
			$this->remove_subscriber( $email );
		
		$this->mysqli->insert(	'ec_user',
								array(	"email"							=> $email,
										"password"						=> $password,
										"first_name"					=> $first_name,
										"last_name"						=> $last_name,
										"default_billing_address_id"	=> $billing_id,
										"default_shipping_address_id"	=> $shipping_id,
										"user_level"					=> $user_level,
										"is_subscriber"					=> $is_subscriber,
										"user_notes"					=> $user_notes
									  ),
								array( '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%d', '%s' )
							  );
		
		return $this->mysqli->insert_id;
	}
	
	public function insert_subscriber( $email, $first_name, $last_name ){
		$this->mysqli->insert( 'ec_subscriber',
								array(	"email"			=> $email,
										"first_name"	=> $first_name,
										"last_name"		=> $last_name ),
								array( '%s', '%s', '%s' )
							);
	}
	
	public function remove_subscriber( $email ){
		$this->mysqli->query( $this->mysqli->prepare( "DELETE FROM ec_subscriber WHERE email = '%s'", $email ) );
	}
	
	public function update_address_user_id( $address_id, $user_id ){
		$this->mysqli->update(	'ec_address',
								array(	"user_id"	=> $user_id ),
								array(	"address_id"	=> $address_id),
								array(	'%s', '%s' )
							  );	
	}
	
	public function insert_order_detail( $order_id, $giftcard_id, $download_key, $cart_item ){
		
		if( $cart_item->image1_optionitem )	$image1 = $cart_item->image1_optionitem;
		else								$image1 = $cart_item->image1;
		
		$insert_array = array(	'order_id'						=> $order_id,
								'product_id'					=> $cart_item->product_id,
								'title'							=> $cart_item->title,
								'model_number'					=> $cart_item->orderdetails_model_number,
								'unit_price'					=> $cart_item->unit_price,
								
								'total_price'					=> $cart_item->total_price,
								'quantity'						=> $cart_item->quantity,
								'image1'						=> $image1,
								
								'optionitem_name_1'				=> $cart_item->optionitem1_name,
								'optionitem_name_2'				=> $cart_item->optionitem2_name,
								'optionitem_name_3'				=> $cart_item->optionitem3_name,
								'optionitem_name_4'				=> $cart_item->optionitem4_name,
								'optionitem_name_5'				=> $cart_item->optionitem5_name,
								
								'optionitem_label_1'			=> $cart_item->optionitem1_label,
								'optionitem_label_2'			=> $cart_item->optionitem2_label,
								'optionitem_label_3'			=> $cart_item->optionitem3_label,
								'optionitem_label_4'			=> $cart_item->optionitem4_label,
								'optionitem_label_5'			=> $cart_item->optionitem5_label,
								
								'optionitem_price_1'			=> $cart_item->optionitem1_price,
								'optionitem_price_2'			=> $cart_item->optionitem2_price,
								'optionitem_price_3'			=> $cart_item->optionitem3_price,
								'optionitem_price_4'			=> $cart_item->optionitem4_price,
								'optionitem_price_5'			=> $cart_item->optionitem5_price,
								
								'use_advanced_optionset'		=> $cart_item->use_advanced_optionset,
								'giftcard_id'					=> $giftcard_id,
								'gift_card_message'				=> $cart_item->gift_card_message,
								
								'gift_card_from_name'			=> $cart_item->gift_card_from_name,
								'gift_card_to_name'				=> $cart_item->gift_card_to_name,
								'gift_card_email'				=> $cart_item->gift_card_email,
								'is_download'					=> $cart_item->is_download,
								'is_giftcard'					=> $cart_item->is_giftcard,
								
								'is_taxable'					=> $cart_item->is_taxable,
								'is_shippable'					=> $cart_item->is_shippable,
								'download_file_name'			=> $cart_item->download_file_name,
								'download_key'					=> $download_key,
								'maximum_downloads_allowed'		=> $cart_item->maximum_downloads_allowed,
								'download_timelimit_seconds'	=> $cart_item->download_timelimit_seconds,
								
								'is_amazon_download'			=> $cart_item->is_amazon_download,
								'amazon_key'					=> $cart_item->amazon_key,
								
								'is_deconetwork'				=> $cart_item->is_deconetwork,
								'deconetwork_id'				=> $cart_item->deconetwork_id,
								'deconetwork_name'				=> $cart_item->deconetwork_name,
								'deconetwork_product_code'		=> $cart_item->deconetwork_product_code,
								'deconetwork_options'			=> $cart_item->deconetwork_options,
								'deconetwork_color_code'		=> $cart_item->deconetwork_color_code,
								'deconetwork_product_id'		=> $cart_item->deconetwork_product_id,
								'deconetwork_image_link'		=> $cart_item->deconetwork_image_link,
								
								'include_code'					=> $cart_item->include_code,
								'subscription_signup_fee'		=> $cart_item->subscription_signup_fee );
								
										
		$percent_array = array( '%d', '%d', '%s', '%s', '%s',
								'%s', '%d', '%s', 
								'%s', '%s', '%s', '%s', '%s', 
								'%s', '%s', '%s', '%s', '%s', 
								'%s', '%s', '%s', '%s', '%s',
								'%d', '%s', '%s',
								'%s', '%s', '%s', '%d', '%d', 
								'%d', '%d', '%s', '%s', '%d', '%d', 
								'%d', '%s',
								'%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
								'%d', '%s' );
								
		if( isset( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ) ){
			for( $i=0; $i<count( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ); $i++ ){
				$arr = $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'][$i][0]( array( ), array( ) );
				for( $j=0; $j<count( $arr ); $j++ ){
					$insert_array[ $arr[$j] ] = $cart_item->custom_vars[$arr[$j]];
					array_push( $percent_array, '%s' );
				}
			}
		}
		
		$this->mysqli->insert(	'ec_orderdetail',
								$insert_array,
								$percent_array
							  );
							  
		$orderdetail_id = $this->mysqli->insert_id;
		
		// If using advanced option sets, insert the order values
		if( $cart_item->use_advanced_optionset ){
			foreach( $cart_item->advanced_options as $advanced_option ){
				$this->insert_order_option( $orderdetail_id, $cart_item->cartitem_id, $advanced_option );
			}
		}
		
		// If including a code, apply one here
		if( $cart_item->include_code ){
			$codes = $this->mysqli->get_results( $this->mysqli->prepare( "SELECT ec_code.code_id FROM ec_code WHERE ec_code.product_id = %d AND orderdetail_id = 0", $cart_item->product_id ) );
			for( $i=0; $i<$cart_item->quantity; $i++ ){
				$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_code SET ec_code.orderdetail_id = %d WHERE ec_code.code_id = %d AND ec_code.product_id = %d", $orderdetail_id, $codes[$i]->code_id, $cart_item->product_id ) );
			}
		}
		
		return $orderdetail_id;
	}
	
	public function insert_order_option( $orderdetail_id, $tempcart_id, $advanced_option ){
		$sql = "INSERT INTO ec_order_option(orderdetail_id, option_name, optionitem_name, option_type, option_value, option_price_change, optionitem_allow_download, option_label) VALUES(%d, %s, %s, %s, %s, %s, %d, %s)";
		// Set the display text for an option item price adjustment
		$optionitem_price = ""; 
		if( $advanced_option->optionitem_price > 0 ){ 
			$optionitem_price = " (+" . $GLOBALS['currency']->get_currency_display( $advanced_option->optionitem_price ) . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ")"; 
		}else if( $advanced_option->optionitem_price < 0 ){ 
			$optionitem_price = " (" . $GLOBALS['currency']->get_currency_display( $advanced_option->optionitem_price ) . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ")"; 
		}else if( $advanced_option->optionitem_price_onetime > 0 ){ 
			$optionitem_price = " (+" . $GLOBALS['currency']->get_currency_display( $advanced_option->optionitem_price_onetime ) . ")"; 
		}else if( $advanced_option->optionitem_price_onetime < 0 ){ 
			$optionitem_price = " (" . $GLOBALS['currency']->get_currency_display( $advanced_option->optionitem_price_onetime ) . ")"; 
		}else if( $advanced_option->optionitem_price_override >= 0 ){ 
			$optionitem_price = " (" . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . " " . $GLOBALS['currency']->get_currency_display( $advanced_option->optionitem_price_override ) . ")"; 
		}
		
		$option_value = $advanced_option->optionitem_value;
		if( $advanced_option->option_type == "file" )
			$option_value = $tempcart_id . "/" . $option_value;
		else if( $advanced_option->option_type == "dimensions1" || $advanced_option->option_type == "dimensions2" ){
			$dimensions = json_decode( $advanced_option->optionitem_value ); 
			if( count( $dimensions ) == 2 ){ 
				$option_value = $dimensions[0]; if( !get_option( 'ec_option_enable_metric_unit_display' ) ){ $option_value .= "\""; } $option_value .= " x " . $dimensions[1]; if( !get_option( 'ec_option_enable_metric_unit_display' ) ){ $option_value .= "\""; }; 
			}else if( count( $dimensions ) == 4 ){ 
				$option_value = $dimensions[0] . " " . $dimensions[1]; if( !get_option( 'ec_option_enable_metric_unit_display' ) ){ $option_value .= "\""; } $option_value .= $dimensions[2] . " " . $dimensions[3]; if( !get_option( 'ec_option_enable_metric_unit_display' ) ){ $option_value .= "\""; }
			}
		}
		
		$this->mysqli->query( $this->mysqli->prepare( $sql, $orderdetail_id, $advanced_option->option_name, $advanced_option->optionitem_name, $advanced_option->option_type, $option_value, $optionitem_price, $advanced_option->optionitem_allow_download, $advanced_option->option_label ) );
	}
	
	public function insert_response( $order_id, $is_error, $processor, $response_text ){
		if( get_option( 'ec_option_enable_gateway_log' ) ){
			$this->mysqli->insert( 	'ec_response',
								array( 	'order_id' => $order_id,
										'is_error' => $is_error,
										'processor' => $processor,
										'response_text' => $response_text
									 ),
								array( '%d', '%d', '%s', '%s' ) );
		}
	}
	
	public function insert_new_giftcard( $amount, $message ){
		$chars = array( "A", "B", "C", "D", "E", "F" );
		$giftcard_id = $chars[rand( 0, 5 )] . $chars[rand( 0, 5 )] . $chars[rand( 0, 5 )] . $chars[rand( 0, 5 )] . $chars[rand( 0, 5 )] . $chars[rand( 0, 5 )] . rand( 0, 9 ) . rand( 0, 9 ) . rand( 0, 9 ) . rand( 0, 9 ) . rand( 0, 9 ) . rand( 0, 9 );
		
		$this->mysqli->insert( 'ec_giftcard', array( 'giftcard_id' => $giftcard_id, 'amount' => $amount, 'message' => $message ), array( '%s', '%s', '%s' ) );
		return $giftcard_id;
	}
	
	public function insert_new_download( $order_id, $download_file_name, $product_id, $is_amazon_download, $amazon_key ){
		$download_id = uniqid( md5( rand( ) ) );
		
		$this->mysqli->insert( 	'ec_download', 
								array( 	'download_id'			=> $download_id, 
										'order_id' 				=> $order_id, 
										'download_file_name' 	=> $download_file_name,
										'product_id'			=> $product_id,
										'is_amazon_download'	=> $is_amazon_download,
										'amazon_key'			=> $amazon_key
									), 
								array( 	'%s', '%d', '%s', '%d', '%d', '%s' ) );
		return $download_id;
	}
	
	public function get_download( $download_id ){
		return $this->mysqli->get_row( $this->mysqli->prepare( "SELECT download_id, date_created, UNIX_TIMESTAMP(date_created) AS date_created_timestamp, download_count, order_id, product_id, download_file_name FROM ec_download WHERE download_id = '%s'", $download_id ) );	
	}
	
	public function update_quantity_value( $quantity, $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3, $optionitem_id_4, $optionitem_id_5 ){
		$sql = "UPDATE ec_optionitemquantity SET ec_optionitemquantity.quantity = ec_optionitemquantity.quantity - %d WHERE ec_optionitemquantity.product_id = %d AND ec_optionitemquantity.optionitem_id_1 = %d AND ec_optionitemquantity.optionitem_id_2 = %d AND ec_optionitemquantity.optionitem_id_3 = %d AND ec_optionitemquantity.optionitem_id_4 = %d AND ec_optionitemquantity.optionitem_id_5 = %d";
		
		$this->mysqli->query( $this->mysqli->prepare( $sql, $quantity, $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3, $optionitem_id_4, $optionitem_id_5 ) );
	}
	
	public function update_download_count( $download_id, $download_count ){
		$this->mysqli->update(	'ec_download',
								array(	'download_count'	=> $download_count ),
								array(	'download_id'		=> $download_id ),
								array(	'%d', '$s' )
							);
	}
	
	public function update_product_stock( $product_id, $quantity ){
		
		$stock_quantity = $this->mysqli->get_var( $this->mysqli->prepare( "SELECT stock_quantity FROM ec_product WHERE product_id = %d", $product_id ) );
		
		$this->mysqli->update( 	'ec_product',
								array( 'stock_quantity' => $stock_quantity - $quantity ),
								array( 'product_id' => $product_id ),
								array( '%d', '%d' )
							  );
	}
	
	public function clear_tempcart( $session_id ){
		$tempcart_ids = $this->mysqli->get_results( $this->mysqli->prepare( "SELECT ec_tempcart.tempcart_id FROM ec_tempcart WHERE ec_tempcart.session_id = %s", $session_id ) );
		foreach( $tempcart_ids as $tempcart_id ){
			$this->mysqli->query( $this->mysqli->prepare( "DELETE FROM ec_tempcart_optionitem WHERE ec_tempcart_optionitem.tempcart_id = %d", $tempcart_id->tempcart_id ) );
		}
		
		$sql = "DELETE FROM ec_tempcart WHERE session_id = %s";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $session_id ) );
	}
	
	public function get_order_list( $user_id ){
		$sql = "SELECT 
				ec_order.order_id, 
				ec_order.order_date,  
				ec_order.orderstatus_id,
				ec_orderstatus.order_status, 
				ec_order.order_weight, 
				ec_orderstatus.is_approved,
				
				ec_order.sub_total,
				ec_order.shipping_total,
				ec_order.tax_total, 
				ec_order.duty_total, 
				ec_order.vat_total, 
				ec_order.discount_total,
				ec_order.grand_total,  
				ec_order.refund_total,
				
				ec_order.gst_total,
				ec_order.gst_rate,
				ec_order.pst_total,
				ec_order.pst_rate,
				ec_order.hst_total,
				ec_order.hst_rate,
				
				ec_order.promo_code, 
				ec_order.giftcard_id, 
				
				ec_order.use_expedited_shipping, 
				ec_order.shipping_method, 
				ec_order.shipping_carrier, 
				ec_order.tracking_number, 
				
				ec_order.user_email, 
				ec_order.user_level, 
				
				ec_order.billing_first_name, 
				ec_order.billing_last_name, 
				ec_order.billing_company_name, 
				ec_order.billing_address_line_1, 
				ec_order.billing_address_line_2, 
				ec_order.billing_city, 
				ec_order.billing_state, 
				ec_order.billing_zip, 
				ec_order.billing_country,
				billing_country.name_cnt as billing_country_name, 
				ec_order.billing_phone, 
				
				ec_order.shipping_first_name, 
				ec_order.shipping_last_name, 
				ec_order.shipping_company_name, 
				ec_order.shipping_address_line_1, 
				ec_order.shipping_address_line_2, 
				ec_order.shipping_city, 
				ec_order.shipping_state, 
				ec_order.shipping_zip, 
				ec_order.shipping_country,
				shipping_country.name_cnt as shipping_country_name,
				ec_order.shipping_phone, 
				
				ec_order.payment_method, 
				
				ec_order.paypal_email_id, 
				ec_order.paypal_payer_id,
				
				ec_order.order_customer_notes,
				ec_order.creditcard_digits,
				
				ec_order.fraktjakt_order_id,
				ec_order.fraktjakt_shipment_id,
				ec_order.subscription_id
				
				FROM 
				ec_order
				LEFT JOIN ec_country as billing_country ON ( ec_order.billing_country = billing_country.iso2_cnt )
				LEFT JOIN ec_country as shipping_country ON ( ec_order.shipping_country = shipping_country.iso2_cnt )
				LEFT JOIN ec_orderstatus ON ec_order.orderstatus_id = ec_orderstatus.status_id, 
				ec_user
				
				WHERE 
				ec_order.user_id = %d AND 
				ec_user.user_id = ec_order.user_id
				
				ORDER BY 
				ec_order.order_date DESC";
				
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $user_id ) );
	}
	
	public function get_guest_order_row( $order_id, $guest_key ){
		$sql = "SELECT 
				ec_order.order_id, 
				ec_order.txn_id,
				ec_order.edit_sequence,
				ec_order.order_date,  
				ec_order.orderstatus_id,
				ec_orderstatus.order_status, 
				ec_order.order_weight, 
				ec_orderstatus.is_approved,
				
				ec_order.user_id,
				ec_user.list_id,
				
				ec_order.sub_total,
				ec_order.shipping_total,
				ec_order.tax_total,
				ec_order.vat_total,
				ec_order.duty_total,
				ec_order.discount_total,
				ec_order.grand_total, 
				ec_order.refund_total,
				
				ec_order.gst_total,
				ec_order.gst_rate,
				ec_order.pst_total,
				ec_order.pst_rate,
				ec_order.hst_total,
				ec_order.hst_rate,
				
				ec_order.promo_code, 
				ec_order.giftcard_id, 
				
				ec_order.use_expedited_shipping, 
				ec_order.shipping_method, 
				ec_order.shipping_carrier, 
				ec_order.tracking_number, 
				
				ec_order.user_email, 
				ec_order.user_level, 
				
				ec_order.billing_first_name, 
				ec_order.billing_last_name, 
				ec_order.billing_company_name, 
				ec_order.billing_address_line_1, 
				ec_order.billing_address_line_2, 
				ec_order.billing_city, 
				ec_order.billing_state, 
				ec_order.billing_zip, 
				ec_order.billing_country,
				bill_country.name_cnt as billing_country_name, 
				ec_order.billing_phone, 
				
				ec_order.shipping_first_name, 
				ec_order.shipping_last_name, 
				ec_order.shipping_company_name, 
				ec_order.shipping_address_line_1, 
				ec_order.shipping_address_line_2, 
				ec_order.shipping_city, 
				ec_order.shipping_state, 
				ec_order.shipping_zip, 
				ec_order.shipping_country, 
				ship_country.name_cnt as shipping_country_name,
				ec_order.shipping_phone, 
				
				ec_order.payment_method, 
				
				ec_order.paypal_email_id, 
				ec_order.paypal_payer_id,
				
				ec_order.order_customer_notes,
				ec_order.creditcard_digits,
				
				ec_order.fraktjakt_order_id,
				ec_order.fraktjakt_shipment_id,
				ec_order.subscription_id,
				
				GROUP_CONCAT(DISTINCT CONCAT_WS('***', ec_customfield.field_name, ec_customfield.field_label, ec_customfielddata.data) ORDER BY ec_customfield.field_name ASC SEPARATOR '---') as customfield_data
				
				FROM 
				ec_order
				
				LEFT JOIN ec_country as bill_country ON
				bill_country.iso2_cnt = ec_order.billing_country
				
				LEFT JOIN ec_country as ship_country ON
				ship_country.iso2_cnt = ec_order.shipping_country
				
				LEFT JOIN ec_orderstatus ON
				ec_order.orderstatus_id = ec_orderstatus.status_id
				
				LEFT JOIN ec_user ON
				ec_user.user_id = ec_order.user_id
				
				LEFT JOIN ec_customfield
				ON ec_customfield.table_name = 'ec_order'
				
				LEFT JOIN ec_customfielddata
				ON ec_customfielddata.customfield_id = ec_customfield.customfield_id AND ec_customfielddata.table_id = ec_order.order_id
				
				WHERE 
				
				ec_order.order_id = %d AND
				ec_order.guest_key = %s AND 
				ec_order.guest_key != ''
				
				GROUP BY
				ec_order.order_id";
				
				return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $order_id, $guest_key ) );
	}
	
	public function get_order_row( $order_id, $user_id ){
		
		$sql = "SELECT 
			ec_order.order_id, 
			ec_order.txn_id,
			ec_order.edit_sequence,
			ec_order.order_date,  
			ec_order.orderstatus_id,
			ec_orderstatus.order_status, 
			ec_order.order_weight, 
			ec_orderstatus.is_approved,
			
			ec_order.user_id,
			ec_user.list_id,
			
			ec_order.sub_total,
			ec_order.shipping_total,
			ec_order.tax_total,
			ec_order.vat_total,
			ec_order.duty_total,
			ec_order.discount_total,
			ec_order.grand_total, 
			ec_order.refund_total,
				
			ec_order.gst_total,
			ec_order.gst_rate,
			ec_order.pst_total,
			ec_order.pst_rate,
			ec_order.hst_total,
			ec_order.hst_rate,
			
			ec_order.promo_code, 
			ec_order.giftcard_id, 
			
			ec_order.use_expedited_shipping, 
			ec_order.shipping_method, 
			ec_order.shipping_carrier, 
			ec_order.tracking_number, 
			
			ec_order.user_email, 
			ec_order.user_level, 
			
			ec_order.billing_first_name, 
			ec_order.billing_last_name, 
			ec_order.billing_company_name, 
			ec_order.billing_address_line_1, 
			ec_order.billing_address_line_2, 
			ec_order.billing_city, 
			ec_order.billing_state, 
			ec_order.billing_zip, 
			ec_order.billing_country, 
			bill_country.name_cnt as billing_country_name, 
			ec_order.billing_phone, 
			
			ec_order.shipping_first_name, 
			ec_order.shipping_last_name, 
			ec_order.shipping_company_name, 
			ec_order.shipping_address_line_1, 
			ec_order.shipping_address_line_2, 
			ec_order.shipping_city, 
			ec_order.shipping_state, 
			ec_order.shipping_zip, 
			ec_order.shipping_country,
			ship_country.name_cnt as shipping_country_name, 
			ec_order.shipping_phone, 
			
			ec_order.payment_method, 
			
			ec_order.paypal_email_id, 
			ec_order.paypal_payer_id,
			
			ec_order.order_customer_notes,
			ec_order.creditcard_digits,
			
			ec_order.fraktjakt_order_id,
			ec_order.fraktjakt_shipment_id,
			ec_order.subscription_id,
			
			GROUP_CONCAT(DISTINCT CONCAT_WS('***', ec_customfield.field_name, ec_customfield.field_label, ec_customfielddata.data) ORDER BY ec_customfield.field_name ASC SEPARATOR '---') as customfield_data 
			
			FROM 
			ec_order
			
			LEFT JOIN ec_country as bill_country ON
			bill_country.iso2_cnt = ec_order.billing_country
			
			LEFT JOIN ec_country as ship_country ON
			ship_country.iso2_cnt = ec_order.shipping_country
			
			LEFT JOIN ec_orderstatus ON
			ec_order.orderstatus_id = ec_orderstatus.status_id
			
			LEFT JOIN ec_customfield
			ON ec_customfield.table_name = 'ec_order'
			
			LEFT JOIN ec_customfielddata
			ON ec_customfielddata.customfield_id = ec_customfield.customfield_id AND ec_customfielddata.table_id = ec_order.order_id, 
			
			ec_user
			
			WHERE ec_user.user_id = '%s' AND ec_user.user_id = ec_order.user_id AND ec_order.order_id = %d
			
			GROUP BY ec_order.order_id";
			
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $user_id, $order_id ) );
	
	}
	
	public function get_guest_order_details( $order_id, $guest_key ){
		return $this->mysqli->get_results( $this->mysqli->prepare( $this->orderdetail_guest_sql, $guest_key, $order_id ) );
	}
	
	public function get_order_details( $order_id, $user_id ){
		return $this->mysqli->get_results( $this->mysqli->prepare( $this->orderdetail_sql, $user_id, $order_id ) );
	}
	
	public function get_orderdetail_row( $order_id, $orderdetail_id, $user_id ){
		$row_sql = "SELECT 
				ec_orderdetail.orderdetail_id, 
				ec_orderdetail.order_id, 
				ec_orderdetail.product_id, 
				ec_orderdetail.title, 
				ec_orderdetail.model_number, 
				ec_orderdetail.order_date, 
				ec_orderdetail.unit_price, 
				ec_orderdetail.total_price, 
				ec_orderdetail.quantity, 
				ec_orderdetail.image1, 
				ec_orderdetail.optionitem_name_1, 
				ec_orderdetail.optionitem_name_2, 
				ec_orderdetail.optionitem_name_3, 
				ec_orderdetail.optionitem_name_4, 
				ec_orderdetail.optionitem_name_5,
				ec_orderdetail.optionitem_label_1, 
				ec_orderdetail.optionitem_label_2, 
				ec_orderdetail.optionitem_label_3, 
				ec_orderdetail.optionitem_label_4, 
				ec_orderdetail.optionitem_label_5,
				ec_orderdetail.optionitem_price_1, 
				ec_orderdetail.optionitem_price_2, 
				ec_orderdetail.optionitem_price_3, 
				ec_orderdetail.optionitem_price_4, 
				ec_orderdetail.optionitem_price_5,
				ec_orderdetail.giftcard_id, 
				ec_orderdetail.gift_card_message, 
				ec_orderdetail.gift_card_from_name, 
				ec_orderdetail.gift_card_to_name,
				ec_orderdetail.is_download, 
				ec_orderdetail.is_giftcard, 
				ec_orderdetail.is_taxable, 
				ec_orderdetail.is_shippable, 
				ec_orderdetail.include_code,
				ec_download.download_file_name, 
				ec_orderdetail.download_key,
				ec_orderdetail.maximum_downloads_allowed,
				ec_orderdetail.download_timelimit_seconds,
				ec_download.is_amazon_download,
				ec_download.amazon_key,
				
				";
		
		if( isset( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ) ){
			for( $i=0; $i<count( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ); $i++ ){
				$arr = $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'][$i][0]( array( ), array( ) );
				for( $j=0; $j<count( $arr ); $j++ ){
					$row_sql .= "ec_orderdetail." . $arr[$j] . ", ";
				}
			}
		}
			
		$row_sql .=	"
				
				GROUP_CONCAT(DISTINCT CONCAT_WS('***', ec_customfield.field_name, ec_customfield.field_label, ec_customfielddata.data) ORDER BY ec_customfield.field_name ASC SEPARATOR '---') as customfield_data
				
				FROM ec_orderdetail
				
				LEFT JOIN ec_download
				ON ec_download.download_id = ec_orderdetail.download_key
				
				LEFT JOIN ec_customfield
				ON ec_customfield.table_name = 'ec_orderdetail'
				
				LEFT JOIN ec_customfielddata
				ON ec_customfielddata.customfield_id = ec_customfield.customfield_id AND ec_customfielddata.table_id = ec_orderdetail.orderdetail_id, 
				
				ec_order, ec_user
				
				WHERE 
				ec_user.user_id = %d AND 
				ec_order.order_id = ec_orderdetail.order_id AND 
				ec_user.user_id = ec_order.user_id AND 
				ec_orderdetail.order_id = %d AND 
				ec_orderdetail.orderdetail_id = %d
				
				GROUP BY
				ec_orderdetail.orderdetail_id";
		
		return $this->mysqli->get_row( $this->mysqli->prepare( $row_sql, $user_id, $order_id, $orderdetail_id ) );
	}
	
	public function get_orderdetail_row_guest( $order_id, $orderdetail_id ){
		$row_sql = "SELECT 
				ec_orderdetail.orderdetail_id, 
				ec_orderdetail.order_id, 
				ec_orderdetail.product_id, 
				ec_orderdetail.title, 
				ec_orderdetail.model_number, 
				ec_orderdetail.order_date, 
				ec_orderdetail.unit_price, 
				ec_orderdetail.total_price, 
				ec_orderdetail.quantity, 
				ec_orderdetail.image1, 
				ec_orderdetail.optionitem_name_1, 
				ec_orderdetail.optionitem_name_2, 
				ec_orderdetail.optionitem_name_3, 
				ec_orderdetail.optionitem_name_4, 
				ec_orderdetail.optionitem_name_5,
				ec_orderdetail.optionitem_label_1, 
				ec_orderdetail.optionitem_label_2, 
				ec_orderdetail.optionitem_label_3, 
				ec_orderdetail.optionitem_label_4, 
				ec_orderdetail.optionitem_label_5,
				ec_orderdetail.optionitem_price_1, 
				ec_orderdetail.optionitem_price_2, 
				ec_orderdetail.optionitem_price_3, 
				ec_orderdetail.optionitem_price_4, 
				ec_orderdetail.optionitem_price_5,
				ec_orderdetail.giftcard_id, 
				ec_orderdetail.gift_card_message, 
				ec_orderdetail.gift_card_from_name, 
				ec_orderdetail.gift_card_to_name,
				ec_orderdetail.is_download, 
				ec_orderdetail.is_giftcard, 
				ec_orderdetail.is_taxable, 
				ec_orderdetail.is_shippable, 
				ec_orderdetail.download_file_name, 
				ec_orderdetail.download_key,
				ec_orderdetail.maximum_downloads_allowed,
				ec_orderdetail.download_timelimit_seconds,
				
				";
		
		if( isset( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ) ){
			for( $i=0; $i<count( $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'] ); $i++ ){
				$arr = $GLOBALS['ec_hooks']['ec_extra_cartitem_vars'][$i][0]( array( ), array( ) );
				for( $j=0; $j<count( $arr ); $j++ ){
					$row_sql .= "ec_orderdetail." . $arr[$j] . ", ";
				}
			}
		}
			
		$row_sql .=	"
				
				GROUP_CONCAT(DISTINCT CONCAT_WS('***', ec_customfield.field_name, ec_customfield.field_label, ec_customfielddata.data) ORDER BY ec_customfield.field_name ASC SEPARATOR '---') as customfield_data
				
				FROM ec_orderdetail
				
				LEFT JOIN ec_customfield
				ON ec_customfield.table_name = 'ec_orderdetail'
				
				LEFT JOIN ec_customfielddata
				ON ec_customfielddata.customfield_id = ec_customfield.customfield_id AND ec_customfielddata.table_id = ec_orderdetail.orderdetail_id, 
				
				ec_order
				
				WHERE 
				ec_order.order_id = ec_orderdetail.order_id AND
				ec_orderdetail.order_id = %d AND 
				ec_orderdetail.orderdetail_id = %d
				
				GROUP BY
				ec_orderdetail.orderdetail_id";
		
		return $this->mysqli->get_row( $this->mysqli->prepare( $row_sql, $order_id, $orderdetail_id ) );
	}
	
	public function get_user( $user_id, $email ){
		$sql = "SELECT 
				ec_user.user_id,
				ec_user.first_name, 
				ec_user.last_name,
				ec_user.user_level, 
				ec_user.default_billing_address_id,
				ec_user.default_shipping_address_id,
				ec_user.is_subscriber,
				ec_user.realauth_registered,
				ec_user.stripe_customer_id,
				ec_user.default_card_type, 
				ec_user.default_card_last4,
				ec_user.exclude_tax,
				ec_user.exclude_shipping,
				
				billing.first_name as billing_first_name, 
				billing.last_name as billing_last_name, 
				billing.address_line_1 as billing_address_line_1, 
				billing.address_line_2 as billing_address_line_2, 
				billing.city as billing_city, 
				billing.state as billing_state, 
				billing.zip as billing_zip, 
				billing.country as billing_country, 
				billing.phone as billing_phone, 
				billing.company_name as billing_company_name, 
				
				shipping.first_name as shipping_first_name, 
				shipping.last_name as shipping_last_name, 
				shipping.address_line_1 as shipping_address_line_1, 
				shipping.address_line_2 as shipping_address_line_2, 
				shipping.city as shipping_city, 
				shipping.state as shipping_state, 
				shipping.zip as shipping_zip, 
				shipping.country as shipping_country, 
				shipping.phone as shipping_phone,
				shipping.company_name as shipping_company_name,
				
				GROUP_CONCAT(DISTINCT CONCAT_WS('***', ec_customfield.field_name, ec_customfield.field_label, ec_customfielddata.data) ORDER BY ec_customfield.field_name ASC SEPARATOR '---') as customfield_data
				
				FROM 
				ec_user 
				
				LEFT JOIN ec_address as billing 
				ON ec_user.default_billing_address_id = billing.address_id 
				
				LEFT JOIN ec_address as shipping 
				ON ec_user.default_shipping_address_id = shipping.address_id 
				
				LEFT JOIN ec_customfield
				ON ec_customfield.table_name = 'ec_user'
				
				LEFT JOIN ec_customfielddata
				ON ec_customfielddata.customfield_id = ec_customfield.customfield_id AND ec_customfielddata.table_id = ec_user.user_id
				
				WHERE 
				ec_user.user_id = %s AND
				ec_user.email = %s
				
				GROUP BY
				ec_user.user_id";
		
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $user_id, $email ) );
		
	}
	
	public function get_user_login( $email, $password ){
		$sql = "SELECT 
				ec_user.user_id,
				ec_user.first_name, 
				ec_user.last_name,
				ec_user.user_level, 
				ec_user.default_billing_address_id,
				ec_user.default_shipping_address_id,
				ec_user.is_subscriber,
				ec_user.realauth_registered,
				ec_user.stripe_customer_id,
				ec_user.default_card_type, 
				ec_user.default_card_last4,
				ec_user.exclude_tax,
				ec_user.exclude_shipping,
				
				billing.first_name as billing_first_name, 
				billing.last_name as billing_last_name, 
				billing.address_line_1 as billing_address_line_1, 
				billing.address_line_2 as billing_address_line_2, 
				billing.city as billing_city, 
				billing.state as billing_state, 
				billing.zip as billing_zip, 
				billing.country as billing_country, 
				billing.phone as billing_phone, 
				billing.company_name as billing_company_name, 
				
				shipping.first_name as shipping_first_name, 
				shipping.last_name as shipping_last_name, 
				shipping.address_line_1 as shipping_address_line_1, 
				shipping.address_line_2 as shipping_address_line_2, 
				shipping.city as shipping_city, 
				shipping.state as shipping_state, 
				shipping.zip as shipping_zip, 
				shipping.country as shipping_country, 
				shipping.phone as shipping_phone,
				shipping.company_name as shipping_company_name,
				
				GROUP_CONCAT(DISTINCT CONCAT_WS('***', ec_customfield.field_name, ec_customfield.field_label, ec_customfielddata.data) ORDER BY ec_customfield.field_name ASC SEPARATOR '---') as customfield_data
				
				FROM 
				ec_user 
				
				LEFT JOIN ec_address as billing 
				ON ec_user.default_billing_address_id = billing.address_id 
				
				LEFT JOIN ec_address as shipping 
				ON ec_user.default_shipping_address_id = shipping.address_id 
				
				LEFT JOIN ec_customfield
				ON ec_customfield.table_name = 'ec_user'
				
				LEFT JOIN ec_customfielddata
				ON ec_customfielddata.customfield_id = ec_customfield.customfield_id AND ec_customfielddata.table_id = ec_user.user_id
				
				WHERE 
				ec_user.email = %s AND
				ec_user.password = %s
				
				GROUP BY
				ec_user.user_id";
		
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $email, $password ) );
		
	}
	
	public function update_user_quickbooks( $user_id, $list_id, $edit_sequence ){
		$sql = "UPDATE ec_user SET list_id = %s, edit_sequence = %s WHERE user_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $list_id, $edit_sequence, $user_id ) );
	}
	
	public function reset_password( $email, $new_password ){
		return $this->mysqli->update( 	'ec_user',
								array( 'password'	=> $new_password ),
								array( 'email'		=> $email ),
								array( '%s', '%s' ) );	
	}
	
	public function update_personal_information( $old_email, $user_id, $first_name, $last_name, $email, $is_subscriber ){
		if( $is_subscriber )
			$this->insert_subscriber( $email, $first_name, $last_name );
		else
			$this->remove_subscriber( $email );
		
		return $this->mysqli->update(	'ec_user',
										array(	'first_name'	=> $first_name,
												'last_name'		=> $last_name,
												'email'			=> $email,
												'is_subscriber'	=> $is_subscriber ),
										array(	'email'			=> $old_email,
												'user_id'		=> $user_id ),
										array(	'%s', '%s', '%s', '%d', '%s', '%s' ) );
	}
	
	public function update_password( $user_id, $current_password, $new_password ){
		$correct_password = $this->mysqli->get_var( $this->mysqli->prepare( "SELECT ec_user.password FROM ec_user WHERE ec_user.user_id = %d", $user_id ) );
		if( $correct_password != $current_password ){
			return false;
		
		}else{
			$this->mysqli->update(	'ec_user',
											array(	'password'		=> $new_password ),
											array(	'user_id'		=> $user_id ),
											array(	'%s', '%d' ) );
			return true;
		}
	}
	
	public function update_user_address( $address_id, $first_name, $last_name, $address, $address2, $city, $state, $zip, $country, $phone, $company_name, $user_id ){
		return $this->mysqli->update(	'ec_address', 
										array(	'first_name'						=> $first_name,
												'last_name'							=> $last_name,
												'address_line_1'					=> $address,
												'address_line_2'					=> $address2,
												'city'								=> $city,
												'state'								=> $state,
												'zip'								=> $zip,
												'country'							=> $country,
												'phone'								=> $phone ,
												'company_name'						=> $company_name 
											 ),
										array( 	'address_id' 						=> $address_id,
												'user_id'							=> $user_id ), 
										array( 	'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d' )
								  );
	}
	
	public function insert_user_address( $first_name, $last_name, $company_name, $address, $address2, $city, $state, $zip, $country, $phone, $user_id, $address_type ){
		
		$this->mysqli->insert(	'ec_address',
												array(	'user_id'							=> $user_id,
														'first_name'						=> $first_name,
														'last_name'							=> $last_name,
														'address_line_1'					=> $address,
														'address_line_2'					=> $address2,
														'city'								=> $city,
														'state'								=> $state,
														'zip'								=> $zip,
														'country'							=> $country,
														'phone'								=> $phone,
														'company_name'						=> $company_name
												),
												array( 	'%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
											);
											
		$address_id = $this->mysqli->insert_id;
		
		if( $address_type == "billing" ){
			return $this->mysqli->update(	"ec_user",
											array( 	"default_billing_address_id"	=> $address_id ),
											array( 	"user_id"						=> $user_id
											),
											array( "%d", "%d" )
										);
			
		}else if( $address_type == "shipping"){
			return $this->mysqli->update(	"ec_user",
											array( 	"default_shipping_address_id"	=> $address_id ),
											array( 	"user_id"						=> $user_id
											),
											array( "%d", "%d" )
										);
										
		}
		
	}
	
	public function update_product_views( $model_number ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_product SET ec_product.views=ec_product.views+1 WHERE ec_product.model_number = '%s'", $model_number ) );
	}
	
	public function update_menu_views( $menuid ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_menulevel1 SET ec_menulevel1.clicks=ec_menulevel1.clicks+1 WHERE ec_menulevel1.menulevel1_id = '%s'", $menuid ) );
	}
	
	public function update_menu_post_id( $menuid, $post_id ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_menulevel1 SET ec_menulevel1.post_id=%d WHERE ec_menulevel1.menulevel1_id = %d", $post_id, $menuid ) );
	}
	
	public function update_submenu_views( $submenuid ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_menulevel2 SET ec_menulevel2.clicks=ec_menulevel2.clicks+1 WHERE ec_menulevel2.menulevel2_id = '%s'", $submenuid ) );
	}
	
	public function update_submenu_post_id( $submenuid, $post_id ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_menulevel2 SET ec_menulevel2.post_id=%d WHERE ec_menulevel2.menulevel2_id = %d", $post_id, $submenuid ) );
	}
	
	public function update_subsubmenu_views( $subsubmenuid ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_menulevel3 SET ec_menulevel3.clicks=ec_menulevel3.clicks+1 WHERE ec_menulevel3.menulevel3_id = '%s'", $subsubmenuid ) );
	}
	
	public function update_subsubmenu_post_id( $subsubmenuid, $post_id ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_menulevel3 SET ec_menulevel3.post_id=%d WHERE ec_menulevel3.menulevel3_id = %d", $post_id, $subsubmenuid ) );
	}
	
	public function update_product_post_id( $product_id, $post_id ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_product SET ec_product.post_id=%d WHERE ec_product.product_id = %d", $post_id, $product_id ) );
	}
	
	public function update_category_post_id( $category_id, $post_id ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_category SET ec_category.post_id=%d WHERE ec_category.category_id = %d", $post_id, $category_id ) );
	}
	
	public function update_manufacturer_post_id( $manufacturer_id, $post_id ){
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_manufacturer SET ec_manufacturer.post_id=%d WHERE ec_manufacturer.manufacturer_id = %d", $post_id, $manufacturer_id ) );
	}
	
	public function get_countries( ){
		$sql = "SELECT name_cnt, iso2_cnt, vat_rate_cnt FROM ec_country ORDER BY sort_order ASC";
		return $this->mysqli->get_results( $sql );
	}
	
	public function get_country_name( $iso2 ){
		$sql = "SELECT name_cnt FROM ec_country WHERE iso2_cnt = '%s'";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $iso2 ) );
	}
	
	public function get_country_code( $country_name ){
		$sql = "SELECT iso2_cnt FROM ec_country WHERE name_cnt = '%s'";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $country_name ) );
	}
	
	public function get_states( ){
		$sql = "SELECT ec_state.name_sta, ec_state.code_sta, ec_country.iso2_cnt, ec_state.group_sta FROM ec_state LEFT JOIN ec_country ON ( ec_country.id_cnt = ec_state.idcnt_sta ) ORDER BY ec_country.iso2_cnt, ec_state.group_sta, ec_state.sort_order ASC";
		return $this->mysqli->get_results( $sql );
	}
	
	public function get_settings( ){
		$sql = "SELECT shipping_method, shipping_expedite_rate, shipping_handling_rate, ups_access_license_number, ups_user_id, ups_password, ups_ship_from_zip, ups_shipper_number, ups_country_code, ups_weight_type, ups_conversion_rate, ups_ship_from_state, ups_negotiated_rates, usps_user_name, usps_ship_from_zip, fedex_key, fedex_account_number, fedex_meter_number, fedex_password, fedex_ship_from_zip, fedex_weight_units, fedex_country_code, fedex_conversion_rate, fedex_test_account, auspost_api_key, auspost_ship_from_zip, dhl_site_id, dhl_password, dhl_ship_from_country, dhl_ship_from_zip, dhl_weight_unit, dhl_test_mode, fraktjakt_customer_id, fraktjakt_login_key, fraktjakt_conversion_rate, fraktjakt_test_mode, fraktjakt_address, fraktjakt_city, fraktjakt_state, fraktjakt_zip, fraktjakt_country, canadapost_username, canadapost_password, canadapost_customer_number, canadapost_contract_id, canadapost_test_mode, canadapost_ship_from_zip FROM ec_setting WHERE setting_id = 1";
			return $this->mysqli->get_row( $sql );
	}
	
	public function get_ios3_country_code( $iso2 ){
		$sql = "SELECT iso3_cnt FROM ec_country WHERE iso2_cnt = '%s'";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $iso2 ) );
	}
	
	public function get_manufacturer_row( $manufacturer_id ){
		$sql = "SELECT ec_manufacturer.manufacturer_id, ec_manufacturer.name, ec_manufacturer.clicks, ec_manufacturer.post_id FROM ec_manufacturer WHERE ec_manufacturer.manufacturer_id = %d";
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $manufacturer_id ) );	
	}
	
	public function get_manufacturer_list( ){
		$sql = "SELECT ec_manufacturer.manufacturer_id, ec_manufacturer.name, ec_manufacturer.clicks, ec_manufacturer.post_id FROM ec_manufacturer";
		return $this->mysqli->get_results( $sql );	
	}
	
	public function get_category_list( ){
		$sql = "SELECT ec_category.category_id, ec_category.category_name, ec_category.post_id FROM ec_category";
		return $this->mysqli->get_results( $sql );	
	}
	
	public function get_menu_row( $menu_id, $level ){
		if( $level == 1 ){
			$sql = "SELECT ec_menulevel1.menulevel1_id, ec_menulevel1.post_id, ec_menulevel1.name, ec_menulevel1.order, ec_menulevel1.clicks, ec_menulevel1.seo_keywords, ec_menulevel1.seo_description, ec_menulevel1.banner_image FROM ec_menulevel1 WHERE ec_menulevel1.menulevel1_id = %d";
			return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $menu_id ) );
		}else if( $level == 2 ){
			$sql = "SELECT ec_menulevel2.menulevel2_id, ec_menulevel2.post_id, ec_menulevel2.menulevel1_id, ec_menulevel2.name, ec_menulevel2.order, ec_menulevel2.clicks, ec_menulevel2.seo_keywords, ec_menulevel2.seo_description, ec_menulevel2.banner_image FROM ec_menulevel2 WHERE ec_menulevel2.menulevel2_id = %d";
			return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $menu_id ) );
		}else if( $level == 3 ){
			$sql = "SELECT ec_menulevel3.menulevel3_id, ec_menulevel3.post_id, ec_menulevel3.menulevel2_id, ec_menulevel3.name, ec_menulevel3.order, ec_menulevel3.clicks, ec_menulevel3.seo_keywords, ec_menulevel3.seo_description, ec_menulevel3.banner_image FROM ec_menulevel3 WHERE ec_menulevel3.menulevel3_id = %d";
			return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $menu_id ) );
		}
	}
	
	public function get_menu_row_from_post_id( $post_id, $level ){
		if( $level == 1 ){
			$sql = "SELECT ec_menulevel1.menulevel1_id, ec_menulevel1.post_id, ec_menulevel1.name, ec_menulevel1.order, ec_menulevel1.clicks, ec_menulevel1.seo_keywords, ec_menulevel1.seo_description, ec_menulevel1.banner_image FROM ec_menulevel1 WHERE ec_menulevel1.post_id = %d";
			return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $post_id ) );
		}else if( $level == 2 ){
			$sql = "SELECT ec_menulevel2.menulevel2_id, ec_menulevel2.post_id, ec_menulevel2.menulevel1_id, ec_menulevel2.name, ec_menulevel2.order, ec_menulevel2.clicks, ec_menulevel2.seo_keywords, ec_menulevel2.seo_description, ec_menulevel2.banner_image FROM ec_menulevel2 WHERE ec_menulevel2.post_id = %d";
			return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $post_id ) );
		}else if( $level == 3 ){
			$sql = "SELECT ec_menulevel3.menulevel3_id, ec_menulevel3.post_id, ec_menulevel3.menulevel2_id, ec_menulevel3.name, ec_menulevel3.order, ec_menulevel3.clicks, ec_menulevel3.seo_keywords, ec_menulevel3.seo_description, ec_menulevel3.banner_image FROM ec_menulevel3 WHERE ec_menulevel3.post_id = %d";
			return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $post_id ) );
		}
	}
	
	public function get_product_from_post_id( $post_id ){
		$sql = "SELECT ec_product.product_id, ec_product.model_number, ec_product.title, ec_product.description, ec_product.use_optionitem_images, ec_product.image1 FROM ec_product WHERE ec_product.post_id = %d";
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $post_id ) );
	}
	
	public function get_category_id( $category_id ){
		$sql = "SELECT ec_category.category_id FROM ec_category WHERE ec_category.category_id = %d";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $category_id ) );
	}
	
	public function get_category_id_from_post_id( $post_id ){
		$sql = "SELECT ec_category.category_id FROM ec_category WHERE ec_category.post_id = %d";
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $post_id ) );
	}
	
	public function get_manufacturer_id( $manufacturer_id ){
		$sql = "SELECT ec_manufacturer.manufacturer_id FROM ec_manufacturer WHERE ec_manufacturer.manufacturer_id = %d";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $manufacturer_id ) );
	}
	
	public function get_manufacturer_id_from_post_id( $post_id ){
		$sql = "SELECT ec_manufacturer.manufacturer_id FROM ec_manufacturer WHERE ec_manufacturer.post_id = %d";
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $post_id ) );
	}
	
	public function get_pricepoint_id( $pricepoint_id ){
		$sql = "SELECT ec_pricepoint.pricepoint_id FROM ec_pricepoint WHERE ec_pricepoint.pricepoint_id = %d";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $pricepoint_id ) );
	}
	
	public function get_model_number( $model_number ){
		$sql = "SELECT ec_product.model_number FROM ec_product WHERE ec_product.model_number = %s";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $model_number ) );
	}
	
	public function get_roleprice( $user_id, $product_id ){
		$sql = "SELECT ec_roleprice.role_price FROM ec_roleprice, ec_user WHERE ec_user.user_id = %d AND ec_user.user_level = ec_roleprice.role_label AND ec_roleprice.product_id = %d";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $user_id, $product_id ) );
	}
	
	public function update_user_realvault_registered( $user_id ){
		$sql = "UPDATE ec_user SET realauth_registered = 1 WHERE user_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $user_id ) );
	}
	
	public function get_donation_order_total( $model_number ){
		$sql = "SELECT SUM( ec_orderdetail.total_price ) as order_sum FROM ec_order, ec_orderstatus, ec_orderdetail WHERE ec_orderstatus.status_id = ec_order.orderstatus_id AND ec_orderstatus.is_approved = 1 AND ec_order.order_id = ec_orderdetail.order_id AND ec_orderdetail.model_number = %s";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $model_number ) );
	}
	
	public function get_advanced_optionsets( $product_id ){
		$sql = "SELECT ec_option.option_id, ec_option.option_name, ec_option.option_label, ec_option.option_type, ec_option.option_required, ec_option.option_error_text FROM ec_option_to_product LEFT JOIN ec_option ON ec_option.option_id = ec_option_to_product.option_id WHERE ec_option_to_product.product_id = %d AND ec_option.option_id != '' ORDER BY ec_option_to_product.option_to_product_id ASC";
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $product_id ) );
	}
	
	public function get_advanced_optionitems( $option_id ){
		$sql = "SELECT 
					ec_optionitem.optionitem_id, 
					ec_optionitem.option_id, 
					ec_optionitem.optionitem_name, 
					ec_optionitem.optionitem_price, 
					ec_optionitem.optionitem_price_onetime, 
					ec_optionitem.optionitem_price_override, 
					ec_optionitem.optionitem_price_multiplier, 
					ec_optionitem.optionitem_price_per_character,
					ec_optionitem.optionitem_weight, 
					ec_optionitem.optionitem_weight_onetime, 
					ec_optionitem.optionitem_weight_override, 
					ec_optionitem.optionitem_weight_multiplier, 
					ec_optionitem.optionitem_order, 
					ec_optionitem.optionitem_icon, 
					ec_optionitem.optionitem_initial_value, 
					ec_optionitem.optionitem_model_number,
					ec_optionitem.optionitem_initially_selected,
					
					ec_option.option_name,
					ec_option.option_type
					
					FROM ec_optionitem 
					LEFT JOIN ec_option ON ( ec_option.option_id = ec_optionitem.option_id )
					
					WHERE ec_optionitem.option_id = %d 
					
					ORDER BY ec_optionitem.optionitem_order";
					
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $option_id ) );
	}
	
	public function add_option_to_cart( $tempcart_id, $session_id, $option_val ){
		$sql = "INSERT INTO ec_tempcart_optionitem(tempcart_id, session_id, option_id, optionitem_id, optionitem_value, optionitem_model_number) VALUES(%d, %s, %d, %d, %s, %s)";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $tempcart_id, $session_id, $option_val["option_id"], $option_val["optionitem_id"], $option_val["optionitem_value"], $option_val["optionitem_model_number"] ) ); 
	}
	
	public function get_advanced_cart_options( $tempcart_id ){
		$sql = "SELECT ec_tempcart_optionitem.tempcart_id, ec_tempcart_optionitem.option_id, ec_tempcart_optionitem.optionitem_id, ec_tempcart_optionitem.optionitem_value, ec_tempcart_optionitem.optionitem_model_number, ec_option.option_name, ec_option.option_label, ec_option.option_type, ec_optionitem.optionitem_name, ec_optionitem.optionitem_price, ec_optionitem.optionitem_price_onetime, ec_optionitem.optionitem_price_override, ec_optionitem.optionitem_price_multiplier, ec_optionitem.optionitem_price_per_character, ec_optionitem.optionitem_weight, ec_optionitem.optionitem_weight_onetime, ec_optionitem.optionitem_weight_override, ec_optionitem.optionitem_weight_multiplier, ec_optionitem.optionitem_allow_download, ec_optionitem.optionitem_disallow_shipping FROM ec_tempcart_optionitem LEFT JOIN ec_option ON ec_option.option_id = ec_tempcart_optionitem.option_id LEFT JOIN ec_optionitem ON ec_optionitem.optionitem_id = ec_tempcart_optionitem.optionitem_id LEFT JOIN ec_tempcart ON ec_tempcart.tempcart_id = ec_tempcart_optionitem.tempcart_id LEFT JOIN ec_option_to_product ON ( ec_option_to_product.option_id = ec_option.option_id AND ec_option_to_product.product_id = ec_tempcart.product_id ) WHERE ec_tempcart_optionitem.tempcart_id = %d ORDER BY ec_option_to_product.option_to_product_id ASC";
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $tempcart_id ) );
	}
	
	public function get_order_options( $orderdetail_id ){
		$sql = "SELECT ec_order_option.option_name,  ec_order_option.option_label, ec_order_option.optionitem_name, ec_order_option.option_type, ec_order_option.option_value, ec_order_option.option_price_change, ec_order_option.optionitem_allow_download FROM ec_order_option WHERE ec_order_option.orderdetail_id = %d  ORDER BY ec_order_option.order_option_id ASC";
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $orderdetail_id ) );
	}
	
	public function update_tempcart_grid_quantity( $tempcart_id, $quantity ){
		$sql = "UPDATE ec_tempcart SET ec_tempcart.grid_quantity = %d WHERE ec_tempcart.tempcart_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $quantity, $tempcart_id ) );
	}
	
	public function get_zone_ids( $iso2_cnt, $code_sta ){
		$sql = "SELECT zone_id FROM ec_zone_to_location WHERE ( iso2_cnt = %s AND ( code_sta = '-1' OR code_sta = '' ) ) OR ( iso2_cnt = %s AND code_sta = %s )";
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $iso2_cnt, $iso2_cnt, $code_sta ) );
	}
	
	//////////////// SUBSCRIPTION FUNCTIONS //////////////////////////
	public function has_subscription_inserted( $subscr_id ){
		$sql = "SELECT subscription_id FROM ec_subscription WHERE paypal_subscr_id = %s";
		$results = $this->mysqli->get_results( $this->mysqli->prepare( $sql, $subscr_id ) );
		if( count( $results ) > 0 ){
			return true;
		}else{
			return false;
		}
	}
	
	public function insert_paypal_subscription( $item_name, $payer_email, $first_name, $last_name, $residence_country, $mc_gross, $payment_date, $txn_id, $txn_type, $subscr_id, $username, $password ){
		
		$sql = "SELECT ec_product.model_number, ec_product.subscription_bill_length, ec_product.subscription_bill_period, ec_product.subscription_bill_duration FROM ec_product WHERE ec_product.title LIKE %s";
		$result = $this->mysqli->get_results( $this->mysqli->prepare( $sql, $item_name ) );
		
		$model_number = "";
		$bill_length = 0;
		$bill_period = "";
		if( count( $result ) > 0 ){
			$model_number = $result[0]->model_number;
			$bill_length = $result[0]->subscription_bill_length;
			$bill_period = $result[0]->subscription_bill_period;
			$bill_duration = $result[0]->subscription_bill_duration;
		}
		
		$sql = "INSERT INTO ec_subscription( subscription_type, title, email, first_name, last_name, user_country, model_number, price, payment_length, payment_period, payment_duration, last_payment_date, paypal_txn_id, paypal_txn_type, paypal_subscr_id, paypal_username, paypal_password) VALUES( 'paypal', %s, %s, %s, %s, %s, %s, %s, %d, %s, %d. %s, %s, %s, %s, %s, %s )";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $item_name, $payer_email, $first_name, $last_name, $residence_country, $model_number, $mc_gross, $bill_length, $bill_period, $bill_duration, $payment_date, $txn_id, $txn_type, $subscr_id, $username, $password ) );
	
	}
	
	public function update_paypal_subscription( $next_payment_date, $subscr_id ){
		
		$sql = "UPDATE ec_subscription SET next_payment_date = %s, number_payments_completed = number_payments_completed + 1, last_payment_date = NOW( ) WHERE paypal_subscr_id = %s";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $next_payment_date, $subscr_id ) );
		
	}
	
	public function cancel_paypal_subscription( $subscr_id ){
		$sql = "UPDATE ec_subscription SET subscription_status = 'Canceled' WHERE paypal_subscr_id = %s";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $subscr_id ) );
	}
	
	public function update_order_fraktjakt_info( $order_id, $ship_order_info ){
		$sql = "UPDATE ec_order SET ec_order.fraktjakt_order_id = %s, ec_order.fraktjakt_shipment_id = %s WHERE ec_order.order_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $ship_order_info['order_id'], $ship_order_info['shipment_id'], $order_id ) );
	}
	
	public function update_order_stripe_charge_id( $order_id, $charge_id ){
		$sql = "UPDATE ec_order SET ec_order.stripe_charge_id = %s WHERE ec_order.order_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $charge_id, $order_id ) );
	}
	
	public function update_order_transaction_id( $order_id, $transaction_id ){
		$sql = "UPDATE ec_order SET ec_order.gateway_transaction_id = %s WHERE ec_order.order_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $transaction_id, $order_id ) );
	}
	
	public function update_user_stripe_id( $user_id, $customer_id ){
		$sql = "UPDATE ec_user SET ec_user.stripe_customer_id = %s WHERE ec_user.user_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $customer_id, $user_id ) );
	}
	
	public function update_product_stripe_added( $product_id ){
		$sql = "UPDATE ec_product SET ec_product.stripe_plan_added = 1 WHERE ec_product.product_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $product_id ) );
	}
	
	public function insert_stripe_subscription( $subscription, $product, $user, $card, $quantity ){
		$sql = "INSERT INTO ec_subscription( subscription_type, title, user_id, email, first_name, last_name, product_id, price, payment_length, payment_period, payment_duration, stripe_subscription_id, last_payment_date, next_payment_date, quantity ) VALUES( 'stripe', %s, %s, %s, %s, %s, %s, %s, %d, %s, %d, %s, %s, %s, %d )";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $product->title, $user->user_id, $user->email, $user->billing->first_name, $user->billing->last_name, $product->product_id, $product->price, $product->subscription_bill_length, $product->subscription_bill_period, $product->subscription_bill_duration, $subscription->id, $subscription->current_period_start, $subscription->current_period_end, $quantity ) );
		
		return $this->mysqli->insert_id;
	}
	
	public function insert_subscription_order( $product, $user, $card, $subscription_id, $coupon_code, $order_notes, $option1_name, $option2_name, $option3_name, $option4_name, $option5_name, $option1_label, $option2_label, $option3_label, $option4_label, $option5_label, $quantity ){
		$sql = "INSERT INTO ec_order( user_id, user_email, user_level, orderstatus_id, sub_total, grand_total, promo_code, billing_first_name, billing_last_name, billing_address_line_1, billing_city, billing_state, billing_country, billing_zip, billing_phone, shipping_first_name, shipping_last_name, shipping_address_line_1, shipping_city, shipping_state, shipping_country, shipping_zip, shipping_phone, payment_method, creditcard_digits, subscription_id, order_customer_notes, billing_company_name, shipping_company_name, billing_address_line_2, shipping_address_line_2, order_gateway) VALUES( %d, %s, %s, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d, %s, %s, %s, %s, %s, 'stripe')";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $user->user_id, $user->email, $user->user_level, 6, ( $product->price * $quantity ) + $product->subscription_signup_fee, ( $product->price * $quantity ) + $product->subscription_signup_fee, $coupon_code, $user->billing->first_name, $user->billing->last_name, $user->billing->address_line_1, $user->billing->city, $user->billing->state, $user->billing->country, $user->billing->zip, $user->billing->phone, $user->shipping->first_name, $user->shipping->last_name, $user->shipping->address_line_1, $user->shipping->city, $user->shipping->state, $user->shipping->country, $user->shipping->zip, $user->shipping->phone, $card->payment_method, $card->get_last_four( ), $subscription_id, $order_notes, $user->billing->company_name, $user->shipping->company_name, $user->billing->address_line_2, $user->shipping->address_line_2 ) );
		
		$order_id = $this->mysqli->insert_id;
		$image1 = $product->images->get_single_image( );
		
		$sql = "INSERT INTO ec_orderdetail( order_id, product_id, title, model_number, order_date, unit_price, total_price, quantity, image1, optionitem_name_1, optionitem_name_2, optionitem_name_3, optionitem_name_4, optionitem_name_5, optionitem_label_1, optionitem_label_2, optionitem_label_3, optionitem_label_4, optionitem_label_5, use_advanced_optionset, subscription_signup_fee ) VALUES( %d, %d, %s, %s, NOW( ), %s, %s, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d, %s )";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $order_id, $product->product_id, $product->title, $product->model_number, $product->price, ( $product->price * $quantity ), $quantity, $image1, $option1_name, $option2_name, $option3_name, $option4_name, $option5_name, $option1_label, $option2_label, $option3_label, $option4_label, $option5_label, $product->use_advanced_optionset, $product->subscription_signup_fee ) );
		
		$orderdetail_id = $this->mysqli->insert_id;
		
		if( isset( $GLOBALS['ec_cart_data']->cart_data->subscription_advanced_option ) && $GLOBALS['ec_cart_data']->cart_data->subscription_advanced_option != "" ){
			$advanced_options = json_decode( $GLOBALS['ec_cart_data']->cart_data->subscription_advanced_option, true );
			foreach( $advanced_options as $advanced_option ){
				$sql = "INSERT INTO ec_order_option( orderdetail_id, option_name, optionitem_name, option_type, option_value ) VALUES( %d, %s, %s, %s, %s )";
				$this->mysqli->query( $this->mysqli->prepare( $sql, $orderdetail_id, $advanced_option['option_name'], $advanced_option['optionitem_name'], $advanced_option['option_type'], $advanced_option['optionitem_value'] ) );
				$i++;
			}
		}
		
		return $order_id;
	}
	
	public function insert_paypal_subscription_order( $product, $user, $coupon_code, $order_notes, $option1_name, $option2_name, $option3_name, $option4_name, $option5_name, $option1_label, $option2_label, $option3_label, $option4_label, $option5_label, $quantity ){
		$sql = "INSERT INTO ec_order( user_id, user_email, user_level, orderstatus_id, sub_total, grand_total, promo_code, billing_first_name, billing_last_name, billing_address_line_1, billing_city, billing_state, billing_country, billing_zip, billing_phone, shipping_first_name, shipping_last_name, shipping_address_line_1, shipping_city, shipping_state, shipping_country, shipping_zip, shipping_phone, payment_method, order_customer_notes, billing_company_name, shipping_company_name, billing_address_line_2, shipping_address_line_2) VALUES( %d, %s, %s, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $user->user_id, $user->email, $user->user_level, 8, ( $product->price * $quantity ) + $product->subscription_signup_fee, ( $product->price * $quantity ) + $product->subscription_signup_fee, $coupon_code, $user->billing->first_name, $user->billing->last_name, $user->billing->address_line_1, $user->billing->city, $user->billing->state, $user->billing->country, $user->billing->zip, $user->billing->phone, $user->shipping->first_name, $user->shipping->last_name, $user->shipping->address_line_1, $user->shipping->city, $user->shipping->state, $user->shipping->country, $user->shipping->zip, $user->shipping->phone, 'PayPal', $order_notes, $user->billing->company_name, $user->shipping->company_name, $user->billing->address_line_2, $user->shipping->address_line_2 ) );
		
		$order_id = $this->mysqli->insert_id;
		$image1 = $product->images->get_single_image( );
		
		$sql = "INSERT INTO ec_orderdetail( order_id, product_id, title, model_number, order_date, unit_price, total_price, quantity, image1, optionitem_name_1, optionitem_name_2, optionitem_name_3, optionitem_name_4, optionitem_name_5, optionitem_label_1, optionitem_label_2, optionitem_label_3, optionitem_label_4, optionitem_label_5, use_advanced_optionset, subscription_signup_fee ) VALUES( %d, %d, %s, %s, NOW( ), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d, %s )";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $order_id, $product->product_id, $product->title, $product->model_number, $product->price, ( $product->price * $quantity ), $quantity, $image1, $option1_name, $option2_name, $option3_name, $option4_name, $option5_name, $option1_label, $option2_label, $option3_label, $option4_label, $option5_label, $product->use_advanced_optionset, $product->subscription_signup_fee ) );
		
		$orderdetail_id = $this->mysqli->insert_id;
		
		foreach( $GLOBALS['ec_cart_data']->cart_data->subscription_advanced_option as $advanced_option ){
			$sql = "INSERT INTO ec_order_option( orderdetail_id, option_name, optionitem_name, option_type, option_value ) VALUES( %d, %s, %s, %s, %s )";
			$this->mysqli->query( $this->mysqli->prepare( $sql, $orderdetail_id, $advanced_option['option_name'], $advanced_option['optionitem_name'], $advanced_option['option_type'], $advanced_option['optionitem_value'] ) );
			$i++;
		}
		
		return $order_id;
	}
	
	public function get_subscriptions( $user_id ){
		$sql = "SELECT ec_subscription.subscription_id, ec_subscription.subscription_type, ec_subscription.subscription_status, ec_subscription.title, ec_subscription.user_id, ec_subscription.email, ec_subscription.first_name, ec_subscription.last_name, ec_subscription.user_country, ec_subscription.product_id, ec_subscription.model_number, ec_subscription.price, ec_subscription.payment_length, ec_subscription.payment_period, ec_subscription.start_date, ec_subscription.last_payment_date, ec_subscription.next_payment_date, ec_subscription.number_payments_completed, ec_subscription.paypal_txn_id, ec_subscription.paypal_txn_type, ec_subscription.paypal_subscr_id, ec_subscription.paypal_username, ec_subscription.paypal_password, ec_subscription.stripe_subscription_id, ec_subscription.payment_duration, ec_subscription.quantity, ec_product.trial_period_days, ec_product.membership_page, ec_product.min_purchase_quantity FROM ec_subscription LEFT JOIN ec_product ON ec_subscription.product_id = ec_product.product_id WHERE ec_subscription.user_id = %d";
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $user_id ) );
	}
	
	public function get_subscription_row( $subscription_id ){
		$sql = "SELECT ec_subscription.subscription_id, ec_subscription.subscription_type, ec_subscription.subscription_status, ec_subscription.title, ec_subscription.user_id, ec_subscription.email, ec_subscription.first_name, ec_subscription.last_name, ec_subscription.user_country, ec_subscription.product_id, ec_subscription.model_number, ec_subscription.price, ec_subscription.payment_length, ec_subscription.payment_period, ec_subscription.start_date, ec_subscription.last_payment_date, ec_subscription.next_payment_date, ec_subscription.number_payments_completed, ec_subscription.paypal_txn_id, ec_subscription.paypal_txn_type, ec_subscription.paypal_subscr_id, ec_subscription.paypal_username, ec_subscription.paypal_password, ec_subscription.stripe_subscription_id, ec_subscription.payment_duration, ec_subscription.quantity, ec_product.trial_period_days, ec_product.membership_page, ec_product.min_purchase_quantity FROM ec_subscription LEFT JOIN ec_product ON ec_subscription.product_id = ec_product.product_id WHERE ec_subscription.subscription_id = %d";
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $subscription_id ) );
	}
	
	public function find_subscription_match( $email, $product_id ){
		$sql = "SELECT ec_subscription.subscription_id FROM ec_subscription, ec_product WHERE ec_subscription.email = %s AND ec_subscription.subscription_status = 'Active' AND ec_subscription.product_id = %d AND ec_product.product_id = ec_subscription.product_id AND ec_product.allow_multiple_subscription_purchases = 0";
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $email, $product_id ) );
	}
	
	public function activate_user( $email, $key ){
	
		$sql = "SELECT ec_user.email, ec_user.user_level FROM ec_user WHERE ec_user.email = %s";
		$user = $this->mysqli->get_row( $this->mysqli->prepare( $sql, $email ) );
		
		if( $user->user_level != "pending" ){
			return true;
		}else{
		
			if( $user && isset( $user->email ) ){
				$match_key = md5( $user->email . "ecsalt" );
				
				if( $match_key == $key ){
					$sql = "UPDATE ec_user SET ec_user.user_level = 'shopper' WHERE ec_user.email = %s";
					$this->mysqli->query( $this->mysqli->prepare( $sql, $email ) );
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
	}
	
	public function get_stripe_customer_id( $user_id ){
		$sql = "SELECT ec_user.stripe_customer_id FROM ec_user WHERE ec_user.user_id = %d";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $user_id ) );
	}
	
	public function get_subscription_upgrades( $subscription_id ){
		$sql = "SELECT ec_product.subscription_plan_id FROM ec_subscription, ec_product WHERE ec_subscription.subscription_id = %d AND ec_product.product_id = ec_subscription.product_id";
		$plan_id = $this->mysqli->get_var( $this->mysqli->prepare( $sql, $subscription_id ) );
		if( $plan_id != 0 ){
			$sql = "SELECT ec_product.title, ec_product.product_id, ec_product.price, ec_product.subscription_bill_length, ec_product.subscription_bill_period, ec_product.subscription_bill_duration,  ec_subscription_plan.can_downgrade FROM ec_product, ec_subscription_plan WHERE ec_product.subscription_plan_id = %d AND ec_subscription_plan.subscription_plan_id = ec_product.subscription_plan_id ORDER BY ec_product.price ASC";
			return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $plan_id ) );
		}else{
			return array( );
		}
	}
	
	public function upgrade_subscription( $subscription_id, $product, $quantity ){
		$sql = "UPDATE ec_subscription SET title = %s, product_id = %d, price = %s, payment_length = %d, payment_period = %s, payment_duration = %s, quantity = %s WHERE subscription_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $product->title, $product->product_id, $product->price, $product->subscription_bill_length, $product->subscription_bill_period, $product->subscription_bill_duration, $quantity, $subscription_id ) );
	}
	
	public function update_subscription( $subscription_id, $user, $product, $card, $quantity ){
		$sql = "UPDATE ec_subscription SET title = %s, email = %s, first_name = %s, last_name = %s, product_id = %d, price = %s, payment_length = %d, payment_period = %s, payment_duration = %s, quantity = %s WHERE subscription_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $product->title, $user->email, $user->billing->first_name, $user->billing->last_name, $product->product_id, $product->price, $product->subscription_bill_length, $product->subscription_bill_period, $product->subscription_bill_duration, $quantity, $subscription_id ) );
	}
	
	public function get_webhook( $webhook_id ){
		$sql = "SELECT ec_webhook.webhook_type FROM ec_webhook WHERE ec_webhook.webhook_id = %s";
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $webhook_id ) );
	}
	
	public function insert_webhook( $webhook_id, $webhook_type, $webhook_data ){
		if( get_option( 'ec_option_enable_gateway_log' ) ){
			$sql = "INSERT INTO ec_webhook( webhook_id, webhook_type, webhook_data ) VALUES( %s, %s, %s )";
			$this->mysqli->query( $this->mysqli->prepare( $sql, $webhook_id, $webhook_type, print_r( $webhook_data, true ) ) );
		}
	}
	
	public function get_stripe_subscription( $stripe_subscription_id ){
		$sql = "SELECT ec_subscription.subscription_id, ec_subscription.subscription_type, ec_subscription.subscription_status, ec_subscription.title, ec_subscription.user_id, ec_subscription.email, ec_subscription.first_name, ec_subscription.last_name, ec_subscription.user_country, ec_subscription.product_id, ec_subscription.model_number, ec_subscription.price, ec_subscription.payment_length, ec_subscription.payment_period, ec_subscription.payment_duration, ec_subscription.start_date, ec_subscription.last_payment_date, ec_subscription.next_payment_date, ec_subscription.number_payments_completed, ec_subscription.paypal_txn_id, ec_subscription.paypal_txn_type, ec_subscription.paypal_subscr_id, ec_subscription.paypal_username, ec_subscription.paypal_password, ec_subscription.stripe_subscription_id, ec_product.image1 FROM ec_subscription LEFT JOIN ec_product ON ec_product.product_id = ec_subscription.product_id WHERE ec_subscription.stripe_subscription_id = %s";
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $stripe_subscription_id ) );
	}
			
	public function update_stripe_order( $subscription_id, $stripe_charge_id ){
		$sql = "UPDATE ec_order SET ec_order.stripe_charge_id = %s WHERE ec_order.subscription_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $stripe_charge_id, $subscription_id ) );
	}
	
	public function insert_stripe_order( $subscription, $webhook_data, $user ){
		
		$this->mysqli->insert( 	'ec_order',
						array( 	'user_id'					=> $user->user_id,
								'user_email'				=> $user->email,
								'user_level'				=> $user->user_level,
								'orderstatus_id'			=> 6,
								'sub_total'					=> number_format( ( $webhook_data->subtotal / 100 ), 3, '.', '' ),
								'grand_total'				=> number_format( ( $webhook_data->total / 100 ), 3, '.', '' ),
								'billing_first_name'		=> $user->billing_first_name,
								'billing_last_name'			=> $user->billing_last_name,
								'billing_company_name'		=> $user->billing_company_name,
								'billing_address_line_1'	=> $user->billing_address_line_1,
								'billing_address_line_2'	=> $user->billing_address_line_2,
								'billing_city'				=> $user->billing_city,
								'billing_state'				=> $user->billing_state,
								'billing_country'			=> $user->billing_country,
								'billing_zip'				=> $user->billing_zip,
								'billing_phone'				=> $user->billing_phone,
								'payment_method'			=> $user->default_card_type,
								'creditcard_digits'			=> $user->default_card_last4,
								'stripe_charge_id'			=> $webhook_data->charge,
								'subscription_id'			=> $subscription->subscription_id ),
						array( '%d', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d' ) );
		
		$order_id = $this->mysqli->insert_id;
		
		foreach( $webhook_data->lines->data as $sub_row ){
			$this->mysqli->insert( 	'ec_orderdetail',
							array(	'order_id'		=> $order_id,
									'product_id'	=> $subscription->product_id,
									'title'			=> $sub_row->plan->name,
									'model_number'	=> $subscription->model_number,
									'order_date'	=> 'NOW( )',
									'unit_price'	=> ( $sub_row->amount / 100 ),
									'total_price'	=> ( $sub_row->amount / 100 ),
									'quantity'		=> 1,
									'image1'		=> $subscription->image1 ),
							array( '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%s' ) );
							
		}
		
		return $order_id;
		
	}
	
	public function insert_stripe_failed_order( $subscription, $webhook_data ){
		
		$user = $this->get_stripe_user( $webhook_data->customer );
		
		$this->mysqli->insert( 	'ec_order',
						array( 	'user_id'					=> $user->user_id,
								'user_email'				=> $user->email,
								'user_level'				=> $user->user_level,
								'orderstatus_id'			=> 7,
								'sub_total'					=> number_format( ( $webhook_data->subtotal / 100 ), 3, '.', '' ),
								'grand_total'				=> number_format( ( $webhook_data->total / 100 ), 3, '.', '' ),
								'billing_first_name'		=> $user->first_name,
								'billing_last_name'			=> $user->last_name,
								'billing_address_line_1'	=> $user->address_line_1,
								'billing_city'				=> $user->city,
								'billing_state'				=> $user->state,
								'billing_country'			=> $user->country,
								'billing_zip'				=> $user->zip,
								'billing_phone'				=> $user->phone,
								'payment_method'			=> $user->default_card_type,
								'creditcard_digits'			=> $user->default_card_last4,
								'stripe_charge_id'			=> $webhook_data->charge,
								'subscription_id'			=> $subscription->subscription_id ),
						array( '%d', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d' ) );
		
		$order_id = $this->mysqli->insert_id;
		
		$this->mysqli->insert( 	'ec_orderdetail',
						array(	'order_id'		=> $order_id,
								'product_id'	=> $subscription->product_id,
								'title'			=> $subscription->title,
								'model_number'	=> $subscription->model_number,
								'order_date'	=> 'NOW( )',
								'unit_price'	=> $subscription->price,
								'total_price'	=> $subscription->price,
								'quantity'		=> 1,
								'image1'		=> $subscription->image1 ),
						array( '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%s' ) );
		
		return $order_id;
		
	}
	
	public function update_stripe_subscription( $subscription_id, $webhook_data ){
		$sql = "UPDATE ec_subscription SET title = %s, price = %s, payment_length = %d, payment_period = %s, last_payment_date = %s, next_payment_date = %s, number_payments_completed = number_payments_completed + 1 WHERE stripe_subscription_id = %s";
		
		$this->mysqli->query( $this->mysqli->prepare( $sql, $webhook_data->lines->data[0]->plan->name, ( $webhook_data->lines->data[0]->plan->amount /100 ), $webhook_data->lines->data[0]->plan->interval_count, $this->get_stripe_subscription_period( $webhook_data->lines->data[0]->plan->interval ), $webhook_data->period_start, $webhook_data->period_end, $subscription_id ) );
	}
	
	public function update_stripe_subscription_failed( $subscription_id, $webhook_data ){
		$sql = "UPDATE ec_subscription SET subscription_status = 'Failed' WHERE subscription_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $subscription_id ) );
	}
	
	public function get_stripe_user( $stripe_customer_id ){
		
		$sql = "SELECT ec_user.user_id, ec_user.first_name, ec_user.last_name, ec_user.user_level, ec_user.default_billing_address_id, ec_user.default_shipping_address_id, ec_user.is_subscriber, ec_user.realauth_registered, ec_user.stripe_customer_id, ec_user.default_card_type, ec_user.default_card_last4, ec_user.email,
				
				billing.first_name as billing_first_name, billing.last_name as billing_last_name, billing.address_line_1 as billing_address_line_1, billing.address_line_2 as billing_address_line_2, billing.city as billing_city, billing.state as billing_state, billing.zip as billing_zip, billing.country as billing_country, billing.phone as billing_phone, billing.company_name as billing_company_name
				
				FROM 
				ec_user 
				
				LEFT JOIN ec_address as billing 
				ON ec_user.default_billing_address_id = billing.address_id 
				
				WHERE 
				ec_user.stripe_customer_id = %s";
		
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $stripe_customer_id ) );
		
	}
	
	public function update_user_default_card( $user, $card ){
		$sql = "UPDATE ec_user SET default_card_type = %s, default_card_last4 = %s WHERE user_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $card->payment_method, $card->get_last_four( ), $user->user_id ) );
	}
	
	public function get_subscription_payments( $subscription_id, $user_id ){
		$sql = "SELECT ec_order.order_id, ec_order.order_date, ec_order.grand_total FROM ec_order WHERE ec_order.subscription_id = %d AND ec_order.user_id = %d";
		return $this->mysqli->get_results( $this->mysqli->prepare( $sql, $subscription_id, $user_id ) );
	}
	
	public function update_stripe_order_status( $stripe_charge_id, $orderstatus_id, $refund_total ){
		$sql = "UPDATE ec_order SET orderstatus_id = %d, refund_total = %s WHERE stripe_charge_id = %s";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $orderstatus_id, $refund_total, $stripe_charge_id ) );
	}
	
	public function cancel_subscription( $subscription_id ){
		$sql = "UPDATE ec_subscription SET ec_subscription.subscription_status = 'Canceled' WHERE ec_subscription.subscription_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $subscription_id ) );
	}
	
	public function has_membership_product_ids( $product_id_list ){
		
		if( $GLOBALS['ec_cart_data']->cart_data->user_id != "" && $GLOBALS['ec_cart_data']->cart_data->user_id != 0 ){
			$products = explode( ',', $product_id_list );
			$subscription_where = $this->mysqli->prepare( " WHERE ec_subscription.user_id = %d AND ec_subscription.subscription_status = 'Active' AND ( ", $GLOBALS['ec_user']->user_id );
			$i = 0;
			foreach( $products as $product_id ){
				if( $i > 0 ){
					$subscription_where .= " OR ";
				}
				$subscription_where .= $this->mysqli->prepare( "ec_subscription.product_id = %d", $product_id );
				$i++;
			}
			
			$subscription_sql = "SELECT ec_subscription.product_id FROM ec_subscription " . $subscription_where . " )";
			
			$subscription_product_ids = $this->mysqli->get_results( $subscription_sql );
			
			if( count( $subscription_product_ids ) > 0 ){
				return true;
			}
			
			// Check for regular products as well
			$product_where = $this->mysqli->prepare( " WHERE ec_order.user_id = %d AND ec_orderdetail.order_id = ec_order.order_id AND ec_order.orderstatus_id = ec_orderstatus.status_id AND ec_orderstatus.is_approved = 1 AND ( ", $GLOBALS['ec_user']->user_id );
			
			$i = 0;
			foreach( $products as $product_id ){
				if( $i > 0 ){
					$product_where .= " OR ";
				}
				$product_where .= $this->mysqli->prepare( "ec_orderdetail.product_id = %d", $product_id );
				$i++;
			}
			
			$orderdetails_sql = "SELECT ec_orderdetail.product_id FROM ec_order, ec_orderdetail, ec_orderstatus " . $product_where . " )";
			
			$orderdetail_product_ids = $this->mysqli->get_results( $orderdetails_sql );
			
			if( count( $orderdetail_product_ids ) > 0 ){
				return true;
			}
		}
		
		return false;
		
	}
	
	public function get_membership_link( $subscription_id ){
		$sql = "SELECT ec_product.membership_page FROM ec_subscription, ec_product WHERE ec_subscription.subscription_id = %d AND ec_product.product_id = ec_subscription.product_id";
		return $this->mysqli->get_var( $this->mysqli->prepare( $sql, $subscription_id ) );
	}
	
	public function does_user_exist( $email ){
		$sql = "SELECT ec_user.user_id FROM ec_user WHERE ec_user.email = %s";
		$results = $this->mysqli->get_results( $this->mysqli->prepare( $sql, $email ) );
		if( count( $results ) > 0 ){
			return true;
		}else{
			return false;
		}
	}
	
	public function get_stripe_subscription_period( $interval ){
	
		if( $interval == "day" )
			return "D";
		
		else if( $interval == "week" )
			return "W";
			
		else if( $interval == "month" )
			return "M";
		
		else if( $interval == "year" )
			return "Y";
	
	}
	
	public function cancel_stripe_subscription( $stripe_subscription_id ){
		
		$sql = "UPDATE ec_subscription SET subscription_status = 'Canceled' WHERE stripe_subscription_id = %s";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $stripe_subscription_id ) );
		
	}
	
	public function update_order_user( $user_id, $order_id ){
		
		$sql = "UPDATE ec_order SET user_id = %d WHERE order_id = %d";
		$this->mysqli->query( $this->mysqli->prepare( $sql, $user_id, $order_id ) );
	
	}
	
	public function get_page_options( $post_id ){
		
		$sql = "SELECT option_type, option_value FROM ec_pageoption WHERE post_id = %d";
		$pageoption_arr = $this->mysqli->get_results( $this->mysqli->prepare( $sql, $post_id ) );
		$pageoption_obj = new stdClass( );
		foreach( $pageoption_arr as $option ){
			
			$pageoption_obj->{$option->option_type} = $option->option_value;
			
		}
		
		return $pageoption_obj;
		
	}
	
	public function update_page_option( $post_id, $key, $value ){
		
		$results = $this->mysqli->get_results( $this->mysqli->prepare( "SELECT option_value FROM ec_pageoption WHERE post_id = %d AND option_type = %s", $post_id, $key ) );
		if( count( $results ) > 0 ){
			$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_pageoption SET option_value = %s WHERE post_id = %d AND option_type = %s", $value, $post_id, $key ) );
		}else{
			$this->mysqli->query( $this->mysqli->prepare( "INSERT INTO ec_pageoption( post_id, option_type, option_value ) VALUES( %d, %s, %s )", $post_id, $key, $value ) );
		}
		
	}
	
	public function update_product_options( $model_number, $product_options ){
		
		$sql = "UPDATE ec_product SET ";
		
		$add_comma = false;
		
		if( isset( $product_options->image_hover_type ) ){
			if( $add_comma )
				$sql .= ", ";
			$sql .= $this->mysqli->prepare( "ec_product.image_hover_type = %s", $product_options->image_hover_type );
			$add_comma = true;
		}
		
		if( isset( $product_options->image_effect_type ) ){
			if( $add_comma )
				$sql .= ", ";
			$sql .= $this->mysqli->prepare( "ec_product.image_effect_type = %s", $product_options->image_effect_type );
			$add_comma = true;
		}
		
		if( isset( $product_options->tag_type ) ){
			if( $add_comma )
				$sql .= ", ";
			$sql .= $this->mysqli->prepare( "ec_product.tag_type = %s", $product_options->tag_type );
			$add_comma = true;
		}
		
		if( isset( $product_options->tag_bg_color ) ){
			if( $add_comma )
				$sql .= ", ";
			$sql .= $this->mysqli->prepare( "ec_product.tag_bg_color = %s", $product_options->tag_bg_color );
			$add_comma = true;
		}
		
		if( isset( $product_options->tag_text_color ) ){
			if( $add_comma )
				$sql .= ", ";
			$sql .= $this->mysqli->prepare( "ec_product.tag_text_color = %s", $product_options->tag_text_color );
			$add_comma = true;
		}
		
		if( isset( $product_options->tag_text ) ){
			if( $add_comma )
				$sql .= ", ";
			$sql .= $this->mysqli->prepare( "ec_product.tag_text = %s", $product_options->tag_text );
			$add_comma = true;
		}
		
		$sql .= $this->mysqli->prepare( " WHERE ec_product.model_number = %s", $model_number );
		
		$this->mysqli->query( $sql ) ;
		
	}
	
	public function get_menu_values( $product_id ){
		
		return $this->mysqli->get_results( $this->mysqli->prepare( "SELECT 
		
		ec_menulevel1_1.name as menulevel1_1_name, 
		ec_menulevel2_1.name as menulevel2_1_name, 
		ec_menulevel3_1.name as menulevel3_1_name,
		ec_menulevel1_1.post_id as menulevel1_1_post_id, 
		ec_menulevel2_1.post_id as menulevel2_1_post_id, 
		ec_menulevel3_1.post_id as menulevel3_1_post_id,
		ec_menulevel1_1.menulevel1_id as menulevel1_1_menu_id, 
		ec_menulevel2_1.menulevel2_id as menulevel2_1_menu_id, 
		ec_menulevel3_1.menulevel3_id as menulevel3_1_menu_id, 
		
		ec_menulevel1_2.name as menulevel1_2_name, 
		ec_menulevel2_2.name as menulevel2_2_name, 
		ec_menulevel3_2.name as menulevel3_2_name,
		ec_menulevel1_2.post_id as menulevel1_2_post_id, 
		ec_menulevel2_2.post_id as menulevel2_2_post_id, 
		ec_menulevel3_2.post_id as menulevel3_2_post_id,
		ec_menulevel1_2.menulevel1_id as menulevel1_2_menu_id, 
		ec_menulevel2_2.menulevel2_id as menulevel2_2_menu_id, 
		ec_menulevel3_2.menulevel3_id as menulevel3_2_menu_id,  
		
		ec_menulevel1_3.name as menulevel1_3_name, 
		ec_menulevel2_3.name as menulevel2_3_name, 
		ec_menulevel3_3.name as menulevel3_3_name,
		ec_menulevel1_3.post_id as menulevel1_3_post_id, 
		ec_menulevel2_3.post_id as menulevel2_3_post_id, 
		ec_menulevel3_3.post_id as menulevel3_3_post_id,
		ec_menulevel1_3.menulevel1_id as menulevel1_3_menu_id, 
		ec_menulevel2_3.menulevel2_id as menulevel2_3_menu_id, 
		ec_menulevel3_3.menulevel3_id as menulevel3_3_menu_id
		 
		FROM ec_product
		
		LEFT JOIN ec_menulevel1 as ec_menulevel1_1 ON ( ec_product.menulevel1_id_1 = ec_menulevel1_1.menulevel1_id )
		LEFT JOIN ec_menulevel1 as ec_menulevel1_2 ON ( ec_product.menulevel2_id_1 = ec_menulevel1_2.menulevel1_id )
		LEFT JOIN ec_menulevel1 as ec_menulevel1_3 ON ( ec_product.menulevel3_id_1 = ec_menulevel1_3.menulevel1_id )
		
		LEFT JOIN ec_menulevel2 as ec_menulevel2_1 ON ( ec_product.menulevel1_id_2 = ec_menulevel2_1.menulevel2_id )
		LEFT JOIN ec_menulevel2 as ec_menulevel2_2 ON ( ec_product.menulevel2_id_2 = ec_menulevel2_2.menulevel2_id )
		LEFT JOIN ec_menulevel2 as ec_menulevel2_3 ON ( ec_product.menulevel3_id_2 = ec_menulevel2_3.menulevel2_id )
		
		LEFT JOIN ec_menulevel3 as ec_menulevel3_1 ON ( ec_product.menulevel1_id_3 = ec_menulevel3_1.menulevel3_id )
		LEFT JOIN ec_menulevel3 as ec_menulevel3_2 ON ( ec_product.menulevel2_id_3 = ec_menulevel3_2.menulevel3_id )
		LEFT JOIN ec_menulevel3 as ec_menulevel3_3 ON ( ec_product.menulevel3_id_3 = ec_menulevel3_3.menulevel3_id )
		
		WHERE ec_product.product_id = %d", $product_id ) );
		
	}
	
	public function get_category_values( $product_id ){
		
		return $this->mysqli->get_results( $this->mysqli->prepare( "SELECT DISTINCT ec_category.category_id, ec_category.category_name, ec_category.post_id FROM ec_categoryitem LEFT JOIN ec_category ON ( ec_category.category_id = ec_categoryitem.category_id ) WHERE ec_categoryitem.product_id = %d", $product_id ) );
		
	}
	
	public function get_option_quantity_values( $product_id ){
		
		return $this->mysqli->get_results( $this->mysqli->prepare( "SELECT ec_optionitemquantity.optionitem_id_1 as optionitem_id, SUM( ec_optionitemquantity.quantity ) as quantity FROM ec_optionitemquantity LEFT JOIN ec_optionitem ON ( ec_optionitemquantity.optionitem_id_1 = ec_optionitem.optionitem_id ) WHERE ec_optionitemquantity.product_id = %d GROUP BY ec_optionitemquantity.optionitem_id_1 ORDER By ec_optionitem.optionitem_order", $product_id ) );
		
	}
	
	public function get_option2_quantity_values( $product_id, $optionitem_id_1 ){
	
		return $this->mysqli->get_results( $this->mysqli->prepare( "SELECT ec_optionitemquantity.optionitem_id_2 as optionitem_id, SUM( ec_optionitemquantity.quantity ) as quantity FROM ec_optionitemquantity LEFT JOIN ec_optionitem ON ( ec_optionitemquantity.optionitem_id_2 = ec_optionitem.optionitem_id ) WHERE ec_optionitemquantity.product_id = %d AND ec_optionitemquantity.optionitem_id_1 = %d GROUP BY ec_optionitemquantity.optionitem_id_1, ec_optionitemquantity.optionitem_id_2 ORDER By ec_optionitem.optionitem_order", $product_id, $optionitem_id_1 ) );
		
	}
	
	public function get_option3_quantity_values( $product_id, $optionitem_id_1, $optionitem_id_2 ){
	
		return $this->mysqli->get_results( $this->mysqli->prepare( "SELECT ec_optionitemquantity.optionitem_id_3 as optionitem_id, SUM( ec_optionitemquantity.quantity ) as quantity FROM ec_optionitemquantity LEFT JOIN ec_optionitem ON ( ec_optionitemquantity.optionitem_id_3 = ec_optionitem.optionitem_id ) WHERE ec_optionitemquantity.product_id = %d AND ec_optionitemquantity.optionitem_id_1 = %d AND ec_optionitemquantity.optionitem_id_2 = %d GROUP BY ec_optionitemquantity.optionitem_id_1, ec_optionitemquantity.optionitem_id_2, ec_optionitemquantity.optionitem_id_3 ORDER By ec_optionitem.optionitem_order", $product_id, $optionitem_id_1, $optionitem_id_2 ) );
		
	}
	
	public function get_option4_quantity_values( $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3 ){
	
		return $this->mysqli->get_results( $this->mysqli->prepare( "SELECT ec_optionitemquantity.optionitem_id_4 as optionitem_id, SUM( ec_optionitemquantity.quantity ) as quantity FROM ec_optionitemquantity LEFT JOIN ec_optionitem ON ( ec_optionitemquantity.optionitem_id_4 = ec_optionitem.optionitem_id ) WHERE ec_optionitemquantity.product_id = %d AND ec_optionitemquantity.optionitem_id_1 = %d AND ec_optionitemquantity.optionitem_id_2 = %d AND ec_optionitemquantity.optionitem_id_3 = %d GROUP BY ec_optionitemquantity.optionitem_id_1, ec_optionitemquantity.optionitem_id_2, ec_optionitemquantity.optionitem_id_3, ec_optionitemquantity.optionitem_id_4 ORDER By ec_optionitem.optionitem_order", $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3 ) );
		
	}
	
	public function get_option5_quantity_values( $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3, $optionitem_id_4 ){
	
		return $this->mysqli->get_results( $this->mysqli->prepare( "SELECT ec_optionitemquantity.optionitem_id_5 as optionitem_id, SUM( ec_optionitemquantity.quantity ) as quantity FROM ec_optionitemquantity LEFT JOIN ec_optionitem ON ( ec_optionitemquantity.optionitem_id_5 = ec_optionitem.optionitem_id ) WHERE ec_optionitemquantity.product_id = %d AND ec_optionitemquantity.optionitem_id_1 = %d AND ec_optionitemquantity.optionitem_id_2 = %d AND ec_optionitemquantity.optionitem_id_3 = %d AND ec_optionitemquantity.optionitem_id_4 = %d GROUP BY ec_optionitemquantity.optionitem_id_1, ec_optionitemquantity.optionitem_id_2, ec_optionitemquantity.optionitem_id_3, ec_optionitemquantity.optionitem_id_4, ec_optionitemquantity.optionitem_id_5 ORDER By ec_optionitem.optionitem_order", $product_id, $optionitem_id_1, $optionitem_id_2, $optionitem_id_3, $optionitem_id_4 ) );
		
	}
	
	public function get_product( $model_number, $product_id = 0 ){
		
		$sql = "SELECT
				product.product_id,
				product.model_number,
				product.post_id,
				product.activate_in_store,
				product.title,
				product.description,
				product.short_description,
				product.seo_description,
				product.seo_keywords,
				product.price,
				product.list_price,
				product.vat_rate,
				product.handling_price,
				product.handling_price_each,
				product.stock_quantity,
				product.min_purchase_quantity,
				product.max_purchase_quantity,
				product.weight,
				product.width,
				product.height,
				product.length,
				product.use_optionitem_quantity_tracking,
				product.use_specifications,
				product.specifications,
				product.use_customer_reviews,
				product.show_on_startup,
				product.show_stock_quantity,
				product.is_special,
				product.is_taxable,
				product.is_shippable,
				product.is_giftcard,
				product.is_download,
				product.is_donation,
				product.is_subscription_item,
				product.is_deconetwork,
				product.allow_backorders,
				product.backorder_fill_date,
				
				product.include_code,
				
				product.download_file_name,
				
				product.subscription_bill_length,
				product.subscription_bill_period,
				product.subscription_bill_duration,
				product.trial_period_days,
				product.stripe_plan_added,
				product.subscription_signup_fee,
				product.subscription_unique_id,
				product.subscription_prorate,
				
				product.use_advanced_optionset,
				product.use_optionitem_images,
				
				product.image1,
				product.image2,
				product.image3,
				product.image4,
				product.image5,
				
				product.featured_product_id_1,
				product.featured_product_id_2,
				product.featured_product_id_3,
				product.featured_product_id_4,
				
				product.catalog_mode,
				product.catalog_mode_phrase,
				
				product.inquiry_mode,
				product.inquiry_url,
				
				product.deconetwork_mode,
				product.deconetwork_product_id,
				product.deconetwork_size_id,
				product.deconetwork_color_id,
				product.deconetwork_design_id,

				product.display_type,
				product.image_hover_type,
				product.image_effect_type,
				product.tag_type,
				product.tag_bg_color,
				product.tag_text_color,
				product.tag_text,
				
				product.views
				
				FROM ec_product as product 
				
				WHERE product.model_number = %s OR product.product_id = %d";
				
		return $this->mysqli->get_row( $this->mysqli->prepare( $sql, $model_number, $product_id ) );
		
	}
	
	public function deconetwork_add_to_cart( ){
		
		// First check if this is already in the cart
		$sql = "SELECT tempcart_id FROM ec_tempcart WHERE ec_tempcart.deconetwork_id = %s AND ec_tempcart.session_id = %s";
		$cartrow = $this->mysqli->get_row( $this->mysqli->prepare( $sql, $_GET['id'], $GLOBALS['ec_cart_data']->ec_cart_id ) );
		
		if( $cartrow->tempcart_id ){
			
			$sql = "UPDATE ec_tempcart SET ec_tempcart.quantity = %d, ec_tempcart.deconetwork_name = %s, ec_tempcart.deconetwork_product_code = %s, ec_tempcart.deconetwork_options = %s, ec_tempcart.deconetwork_edit_link = %s, ec_tempcart.deconetwork_color_code = %s, ec_tempcart.deconetwork_product_id = %s, ec_tempcart.deconetwork_image_link = %s, ec_tempcart.deconetwork_discount = %s, ec_tempcart.deconetwork_tax = %s, ec_tempcart.deconetwork_total = %s, ec_tempcart.deconetwork_version = ec_tempcart.deconetwork_version+1 WHERE ec_tempcart.tempcart_id = %d AND ec_tempcart.session_id = %s";
			$this->mysqli->query( $this->mysqli->prepare( $sql, $_GET['qty'], $_GET['name'], $_GET['product_code'], $_GET['options'], $_GET['edit_link'], $_GET['color'], $_GET['product_id'], $_GET['tn'], $_GET['discount'], $_GET['tax'], $_GET['line_total'], $cartrow->tempcart_id, $GLOBALS['ec_cart_data']->ec_cart_id ) );
			
		}else{
			
			$sql = "INSERT INTO ec_tempcart( session_id, product_id, quantity, is_deconetwork, deconetwork_id, deconetwork_name, deconetwork_product_code, deconetwork_options, deconetwork_edit_link, deconetwork_color_code, deconetwork_product_id, deconetwork_image_link, deconetwork_discount, deconetwork_tax, deconetwork_total ) VALUES( %s, %d, %d, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )";
			$this->mysqli->query( $this->mysqli->prepare( $sql, $GLOBALS['ec_cart_data']->ec_cart_id, $_GET['ec_product_id'], $_GET['qty'], 1, $_GET['id'], $_GET['name'], $_GET['product_code'], $_GET['options'], $_GET['edit_link'], $_GET['color'], $_GET['product_id'], $_GET['tn'], $_GET['discount'], $_GET['tax'], $_GET['line_total'] ) );
			
		}
		
	}
	
	public function update_affirm_id( $order_id, $charge_id ){
		
		$this->mysqli->query( $this->mysqli->prepare( "UPDATE ec_order SET affirm_charge_id = %s WHERE ec_order.order_id = %d", $charge_id, $order_id ) );
		
	}
	
	public function get_live_search_options( $search_val ){
		$sql = "SELECT ec_product.title FROM ec_product WHERE ( ec_product.title LIKE %s OR ec_product.model_number ) AND ec_product.activate_in_store = 1";
		$products = $this->mysqli->get_results( $this->mysqli->prepare( $sql, '%' . $search_val . '%', '%' . $search_val . '%' ) );
		
		$sql = "SELECT ec_category.category_name as title FROM ec_category WHERE ec_category.category_name LIKE %s";
		$categories = $this->mysqli->get_results( $this->mysqli->prepare( $sql, '%' . $search_val . '%' ) );
		
		$sql = "SELECT ec_menulevel1.name as title FROM ec_menulevel1 WHERE ec_menulevel1.name LIKE %s";
		$menu1 = $this->mysqli->get_results( $this->mysqli->prepare( $sql, '%' . $search_val . '%' ) );
		
		$sql = "SELECT ec_menulevel2.name as title FROM ec_menulevel2 WHERE ec_menulevel2.name LIKE %s";
		$menu2 = $this->mysqli->get_results( $this->mysqli->prepare( $sql, '%' . $search_val . '%' ) );
		
		$sql = "SELECT ec_menulevel3.name as title FROM ec_menulevel3 WHERE ec_menulevel3.name LIKE %s";
		$menu3 = $this->mysqli->get_results( $this->mysqli->prepare( $sql, '%' . $search_val . '%' ) );
		
		return array_merge( $products, $categories, $menu1, $menu2, $menu3 );
	}
	
	public function get_affiliate_rule( $affiliate_id, $product_id ){
		return $this->mysqli->get_row( $this->mysqli->prepare( "SELECT ec_affiliate_rule.* FROM ec_affiliate_rule, ec_affiliate_rule_to_product, ec_affiliate_rule_to_affiliate WHERE ec_affiliate_rule_to_affiliate.affiliate_id = %s AND ec_affiliate_rule_to_product.product_id = %d AND ec_affiliate_rule.affiliate_rule_id = ec_affiliate_rule_to_affiliate.affiliate_rule_id AND ec_affiliate_rule.affiliate_rule_id = ec_affiliate_rule_to_product.affiliate_rule_id AND ec_affiliate_rule.rule_active = 1", $affiliate_id, $product_id ) );
	}
	
	public function get_total_cart_items_by_product_id( $product_id, $session_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT SUM( ec_tempcart.quantity ) FROM ec_tempcart WHERE ec_tempcart.product_id = %d AND ec_tempcart.session_id = %s", $product_id, $session_id ) );
	}
	
	public function get_total_cart_items_with_grid_by_product_id( $product_id, $option_id, $session_id ){
		return $this->mysqli->get_var( $this->mysqli->prepare( "SELECT SUM( ec_tempcart_optionitem.optionitem_value ) 
				FROM ec_tempcart_optionitem 
				LEFT JOIN ec_tempcart 
				ON ec_tempcart.tempcart_id = ec_tempcart_optionitem.tempcart_id 
				WHERE ec_tempcart.session_id = %s 
				AND ec_tempcart.product_id = %d 
				AND ec_tempcart_optionitem.tempcart_id = ec_tempcart.tempcart_id
				AND ec_tempcart_optionitem.option_id = %d", $session_id, $product_id, $option_id ) );
	}
	
}

?>