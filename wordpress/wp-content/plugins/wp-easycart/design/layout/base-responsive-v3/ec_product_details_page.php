<?php
// Video Option
if( isset( $this->page_options->video_viewed ) || get_option( 'ec_option_hide_design_help_video' ) == '1' ){
	$show_video = false;
}else{
	$show_video = true;
}

// Check for iPhone/iPad/Admin
$ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
$iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');

$is_admin = ( current_user_can( 'manage_options' ) && !get_option( 'ec_option_hide_live_editor' ) );

if( isset( $_GET['preview'] ) ){
	$is_preview = true;
}else{
	$is_preview = false;
}

if( isset( $_GET['previewholder'] ) )
	$is_preview_holder = true;
else
	$is_preview_holder = false;
	
// END CHECK // 

/* PREVIEW CONTENT */
if( $is_preview_holder && $is_admin ){ ?>

<div class="ec_admin_preview_container" id="ec_admin_preview_container">
	<div class="ec_admin_preview_content">
    	<div class="ec_admin_preview_button_container">
            <div class="ec_admin_preview_ipad_landscape"><input type="button" onclick="ec_admin_ipad_landscape_preview( );" value="iPad Landscape"></div>
            <div class="ec_admin_preview_ipad_portrait"><input type="button" onclick="ec_admin_ipad_portrait_preview( );" value="iPad Portrait"></div>
            <div class="ec_admin_preview_iphone_landscape"><input type="button" onclick="ec_admin_iphone_landscape_preview( );" value="iPhone Landscape"></div>
            <div class="ec_admin_preview_iphone_portrait"><input type="button" onclick="ec_admin_iphone_portrait_preview( );" value="iPhone Portrait"></div>
        </div>
		<div id="ec_admin_preview_content" class="ec_admin_preview_wrapper ipad landscape">
			<iframe src="<?php the_permalink( ); ?>?model_number=<?php echo $this->product->model_number; ?>&amp;preview=true" width="100%" height="100%" id="ec_admin_preview_iframe"></iframe>
		</div>
	</div>
</div><?php }else if( $is_admin && !$is_preview ){ ?>
<div class="ec_admin_video_container" id="ec_admin_video_container"<?php if( !$show_video ){ ?> style="display:none;"<?php }?>>
	<div class="ec_admin_video_content">
		<div class="ec_admin_video_padding">
    		<div class="ec_admin_video_holder">
    	    	<div class="ec_admin_video">
                	<h3>WP EasyCart Design Help</h3>
                    <h5>Do you need help in designing your perfect store? Watch our short video and start on your way to success.</h5>
                    <div class="ec_admin_video_hide_div"><a href="" onclick="ec_admin_hide_video_from_page( '<?php global $post; echo $post->ID; ?>' ); return false;">Hide the help video for this page?</a> OR if you no longer need design help, <a href="" onclick="ec_admin_hide_video_forever( ); return false;">hide it forever</a></div>
                    <video width="853" height="480" controls>
						<source src="https://wpeasycart.com/videos/v3_feature_demo.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
    	        	<div class="ec_admin_video_close"><input type="button" onclick="ec_admin_close_video_screen( );" value="x"></div>
                </div>
    	    </div>
    	</div>
	</div>
</div>
<div class="ec_admin_successfully_update_container" id="ec_admin_page_updated">
	<div class="ec_admin_successfully_updated">
    	<div>Your Page Settings Have Been Updated Successfully. The Page Will Now Reload.</div>
    </div>
</div>  
<div class="ec_admin_loader_container" id="ec_admin_page_updated_loader">
	<div class="ec_admin_loader">
    	<div>Updating Your Page Options...</div>
    </div>
</div>
<div class="ec_admin_loader_bg" id="ec_admin_loader_bg"></div>
<div id="ec_page_editor" class="ec_slideout_editor ec_display_editor_false ec_details_editor">
	<div id="ec_page_editor_openclose_button" class="ec_slideout_openclose" data-post-id="<?php global $post; echo $post->ID; ?>">
    	<div class="dashicons dashicons-admin-generic"></div>
    </div>
    <div class="ec_admin_preview_button"><a href="<?php the_permalink( ); ?>?model_number=<?php echo $this->product->model_number; ?>&amp;previewholder=true" target="_blank">Show Device Preview</a></div>
    <div class="ec_admin_page_size">Product Details Options</div>
    <div><strong>Main Content Color</strong></div>
    <div><input id="ec_option_details_main_color" type="color" value="<?php echo get_option( 'ec_option_details_main_color' ); ?>" /></div>
    <div><strong>Desktop Columns</strong></div>
    <div><select id="ec_option_details_columns_desktop">
    		<option value="0"<?php if( get_option( 'ec_option_details_columns_desktop' ) == "" ){?> selected="selected"<?php }?>>Select One</option>
            <option value="1"<?php if( get_option( 'ec_option_details_columns_desktop' ) == "1" ){?> selected="selected"<?php }?>>1 Column</option>
            <option value="2"<?php if( get_option( 'ec_option_details_columns_desktop' ) == "2" ){?> selected="selected"<?php }?>>2 Columns</option>
    </select></div>
    <div><strong>Tablet Landscape Columns</strong></div>
    <div><select id="ec_option_details_columns_laptop">
    		<option value="0"<?php if( get_option( 'ec_option_details_columns_laptop' ) == "" ){?> selected="selected"<?php }?>>Select One</option>
            <option value="1"<?php if( get_option( 'ec_option_details_columns_laptop' ) == "1" ){?> selected="selected"<?php }?>>1 Column</option>
            <option value="2"<?php if( get_option( 'ec_option_details_columns_laptop' ) == "2" ){?> selected="selected"<?php }?>>2 Columns</option>
    </select></div>
    <div><strong>Tablet Portfolio Columns</strong></div>
    <div><select id="ec_option_details_columns_tablet_wide">
    		<option value="0"<?php if( get_option( 'ec_option_details_columns_tablet_wide' ) == "" ){?> selected="selected"<?php }?>>Select One</option>
            <option value="1"<?php if( get_option( 'ec_option_details_columns_tablet_wide' ) == "1" ){?> selected="selected"<?php }?>>1 Column</option>
            <option value="2"<?php if( get_option( 'ec_option_details_columns_tablet_wide' ) == "2" ){?> selected="selected"<?php }?>>2 Columns</option>
    </select></div>
    <div><strong>Smartphone Landscape Columns</strong></div>
    <div><select id="ec_option_details_columns_tablet">
    		<option value="0"<?php if( get_option( 'ec_option_details_columns_tablet' ) == "" ){?> selected="selected"<?php }?>>Select One</option>
            <option value="1"<?php if( get_option( 'ec_option_details_columns_tablet' ) == "1" ){?> selected="selected"<?php }?>>1 Column</option>
            <option value="2"<?php if( get_option( 'ec_option_details_columns_tablet' ) == "2" ){?> selected="selected"<?php }?>>2 Columns</option>
    </select></div>
    <div><strong>Smartphone Portfolio Columns</strong></div>
    <div><select id="ec_option_details_columns_smartphone">
    		<option value="0"<?php if( get_option( 'ec_option_details_columns_smartphone' ) == "" ){?> selected="selected"<?php }?>>Select One</option>
            <option value="1"<?php if( get_option( 'ec_option_details_columns_smartphone' ) == "1" ){?> selected="selected"<?php }?>>1 Column</option>
            <option value="2"<?php if( get_option( 'ec_option_details_columns_smartphone' ) == "2" ){?> selected="selected"<?php }?>>2 Columns</option>
    </select></div>
    <div><strong>Dark/Light Theme Background</strong></div>
    <div><select id="ec_option_use_dark_bg">
    		<option value="0"<?php if( get_option( 'ec_option_use_dark_bg' ) == "" ){?> selected="selected"<?php }?>>Select One</option>
            <option value="1"<?php if( get_option( 'ec_option_use_dark_bg' ) == "1" ){?> selected="selected"<?php }?>>Dark Background</option>
            <option value="0"<?php if( get_option( 'ec_option_use_dark_bg' ) == "0" ){?> selected="selected"<?php }?>>Light Background</option>
    </select></div>
    
    <div><input type="button" value="APPLY AND SAVE" onclick="ec_admin_save_product_details_options( ); return false;" /></div>
    
    <div class="ec_admin_view_more_button">
    	<a href="<?php echo get_admin_url( ); ?>admin.php?page=ec_adminv2&ec_page=store-setup&ec_panel=basic-settings#product-details" target="_blank" title="More Options">View More Display Options</a>
    </div>
    
</div>
<div id="ec_current_media_size"></div>
<script>function ec_admin_save_product_details_options( ){
	jQuery( "#ec_admin_page_updated_loader" ).show( );
	jQuery( "#ec_admin_loader_bg" ).show( );
	var data = {
		action: 'ec_ajax_save_product_details_options',
		ec_option_details_main_color: jQuery( document.getElementById( 'ec_option_details_main_color' ) ).val( ),
		ec_option_details_columns_desktop: jQuery( document.getElementById( 'ec_option_details_columns_desktop' ) ).val( ),
		ec_option_details_columns_laptop: jQuery( document.getElementById( 'ec_option_details_columns_laptop' ) ).val( ),
		ec_option_details_columns_tablet_wide: jQuery( document.getElementById( 'ec_option_details_columns_tablet_wide' ) ).val( ),
		ec_option_details_columns_tablet: jQuery( document.getElementById( 'ec_option_details_columns_tablet' ) ).val( ),
		ec_option_details_columns_smartphone: jQuery( document.getElementById( 'ec_option_details_columns_smartphone' ) ).val( ),
		ec_option_use_dark_bg: jQuery( document.getElementById( 'ec_option_use_dark_bg' ) ).val( )
	}
	jQuery.ajax({url: ajax_object.ajax_url, type: 'post', data: data, success: function(data){ 
		jQuery( document.getElementById( 'ec_admin_page_updated_loader' ) ).hide( );
		jQuery( document.getElementById( 'ec_admin_page_updated' ) ).show( );
		jQuery( document.getElementById( 'ec_admin_loader_bg' ) ).fadeOut( 'slow' );
		location.reload( );
	} } );
	jQuery( document.getElementById( 'ec_page_editor' ) ).animate( { left:'-290px' }, {queue:false, duration:220} ).removeClass( 'ec_display_editor_true' ).addClass( 'ec_display_editor_false' );
}</script><?php }// Close editor content ?><?php 
/* START PRODUCT DETAILS PAGE */ 
?>

<?php
/* If using Google Merchant Show Necessary META */
if( isset( $this->product->google_attributes ) && $this->product->google_attributes != NULL && $this->product->google_attributes != "" ){
	$google_attributes = json_decode( $this->product->google_attributes );
?>
<div itemscope itemtype="http://schema.org/Product" style="display:none;">

	<span itemprop="name"><?php echo $this->product->title; ?></span>
	<?php if( strlen( $google_attributes->gtin ) > 0 ){?>
	<meta itemprop="gtin<?php echo strlen( $google_attributes->gtin ); ?>" content="<?php echo $google_attributes->gtin; ?>" />
	<?php }else if( strlen( $google_attributes->mpn ) > 0 ){?>
	<meta itemprop="mpn" content="<?php echo $google_attributes->mpn; ?>" />
	<?php }?>
	<meta itemprop="sku" content="<?php echo $this->product->model_number; ?>" />

	<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<meta itemprop="priceCurrency" content="<?php echo $GLOBALS['currency']->currency_code; ?>" /><?php if( $GLOBALS['currency']->symbol_location ){ echo $GLOBALS['currency']->symbol; } ?><span itemprop="price"><?php echo number_format( $this->product->price, 2, '.', '' ); ?></span><?php if( !$GLOBALS['currency']->symbol_location ){ echo $GLOBALS['currency']->symbol; } ?>
		<meta itemprop="itemCondition" itemtype="http://schema.org/OfferItemCondition" content="http://schema.org/<?php if( strtolower( $google_attributes->condition ) == "new" ){ ?>NewCondition<?php }else if( strtolower( $google_attributes->condition ) == "used" ){?>UsedCondition<?php }else{?>RefurbishedConiditon<?php }?>"/><?php echo $google_attributes->condition; ?>
	</div>

</div>
<?php }?>

<?php /* INQUIRY OPTIONS */ ?>
<?php if( $this->product->is_inquiry_mode && $this->product->inquiry_url == "" ){ ?>

<div class="ec_details_inquiry_popup">
<div class="ec_details_inquiry_popup_content">
	<div class="ec_details_inquiry_popup_padding">
		<div class="ec_details_inquiry_popup_holder">
			<div class="ec_details_inquiry_popup_main">
				<div style="display:none;" class="ec_store_loader" id="ec_inquiry_loader">Loading...</div>
				<div class="ec_store_loader_bg" id="ec_inquiry_loader_bg"></div>
				<form action="<?php echo $this->cart_page; ?>" method="POST" enctype="multipart/form-data" class="ec_add_to_cart_form">
				<div class="ec_details_options">
					<h3><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_inquiry_title' ); ?></h3>
					<strong><?php echo $this->product->title; ?></strong>
					<div class="ec_details_option_row_error ec_inquiry_error" id="ec_details_inquiry_error"><?php echo $GLOBALS['language']->get_text( 'ec_errors', 'missing_inquiry_options' ); ?></div>
					<div class="ec_details_option_row">
						<div class="ec_details_option_label"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_inquiry_name' ); ?></div>
						<div class="ec_details_option_data"><input type="text" name="ec_inquiry_name" id="ec_inquiry_name" value="" /></div>
					</div>
					<div class="ec_details_option_row">
						<div class="ec_details_option_label"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_inquiry_email' ); ?></div>
						<div class="ec_details_option_data"><input type="text" name="ec_inquiry_email" id="ec_inquiry_email" value="" /></div>
					</div>
					<div class="ec_details_option_row">
						<div class="ec_details_option_label"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_inquiry_message' ); ?></div>
						<div class="ec_details_option_data"><textarea name="ec_inquiry_message" id="ec_inquiry_message"></textarea></div>
					</div>
					<div class="ec_details_option_row">
						<div class="ec_details_option_label"></div>
						<div class="ec_details_option_data"><input type="checkbox" name="ec_inquiry_send_copy" id="ec_inquiry_send_copy" /> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_inquiry_send_copy' ); ?></div>
					</div>
				</div>
				
				<div class="ec_details_add_to_cart">
					<input type="submit" value="<?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_inquire' ); ?>" onclick="return ec_details_submit_inquiry( );" style="margin-left:0px !important;" />
				</div>
                <input type="hidden" name="ec_cart_form_action" value="send_inquiry" />
                <input type="hidden" name="ec_inquiry_model_number" value="<?php echo $this->product->model_number; ?>" />
				</form>
			</div>
			<div class="ec_details_large_popup_close"><input type="button" onclick="ec_details_hide_inquiry_popup( );" value="x"></div>
		</div>
	</div>
</div>
</div>
<script>
jQuery( '.ec_details_inquiry_popup' ).appendTo( document.body );
</script>

<?php } ?>
<?php /* END INQUIRY OPTIONS */ ?>

<section class="ec_product_details_page"><?php if( $this->product->has_promotion_text( ) ){ ?>
	<div class="ec_cart_success"><div><?php $this->product->display_promotion_text( ); ?></div></div><?php }?>
	<?php if( $this->product->is_subscription_item && $this->product->trial_period_days > 0 ){ ?>
    <div class="ec_cart_success"><?php echo $GLOBALS['language']->get_text( 'product_page', 'product_page_start_trial_1' ); ?> <?php echo $this->product->trial_period_days; ?> <?php echo $GLOBALS['language']->get_text( 'product_page', 'product_page_start_trial_2' ); ?></div>
    <?php }?>
	<?php 
	/* START PRODUCT BREADCRUMBS */ 
	?><?php if( get_option( 'ec_option_show_breadcrumbs' ) ){ ?>
	<h4 class="ec_details_breadcrumbs" id="ec_breadcrumbs_type1">
    	<a href="<?php echo home_url( ); ?>"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_home_link' ); ?></a> / 
        <a href="<?php echo $this->store_page; ?>"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_store_link' ); ?></a> <?php if( $this->product->menuitems[0]->menulevel1_1_name ){ ?> / 
        <a href="<?php if( !get_option( 'ec_option_use_old_linking_style' ) && $postid != "0" ){ 
			echo get_permalink( $this->product->menuitems[0]->menulevel1_1_post_id ); 
		}else{ 
			echo $this->store_page . $this->permalink_divider . "menuid=" . $this->product->menuitems[0]->menulevel1_1_menu_id;
		} ?>"><?php echo $this->product->menuitems[0]->menulevel1_1_name; ?></a>
		<?php if( $this->product->menuitems[0]->menulevel2_1_name ){ ?> / 
        <a href="<?php if( !get_option( 'ec_option_use_old_linking_style' ) && $postid != "0" ){ 
			echo get_permalink( $this->product->menuitems[0]->menulevel2_1_post_id );
		}else{ 
			echo $this->store_page . $this->permalink_divider . "submenuid=" . $this->product->menuitems[0]->menulevel2_1_menu_id;
		} ?>"><?php echo $this->product->menuitems[0]->menulevel2_1_name; ?></a>
		<?php if( $this->product->menuitems[0]->menulevel3_1_name ){ ?> / 
        <a href="<?php if( !get_option( 'ec_option_use_old_linking_style' ) && $postid != "0" ){ 
			echo get_permalink( $this->product->menuitems[0]->menulevel3_1_post_id );
		}else{
			echo $this->store_page . $this->permalink_divider . "subsubmenuid=" . $this->product->menuitems[0]->menulevel3_1_menu_id; 
		} ?>"><?php echo $this->product->menuitems[0]->menulevel3_1_name; ?></a><?php } } }?></h4>
    <?php } ?><?php 
	/* START MAIN DATA AREA FOR PRODUCT */ ?>
    <div class="ec_details_content">
        <?php /* START MOBILE SIZED CONTENT REGION */ ?>
        <div class="ec_details_mobile_title_area">
        	<h1 class="ec_details_title"><?php echo $this->product->title; ?></h1>
        	<?php if( $this->product->use_customer_reviews ){ ?>
            <div class="ec_details_review_holder">
                <span class="ec_details_review_stars">
                	<?php $rating = $this->product->get_rating( ); ?>
                	<div class="ec_product_details_star_<?php if( $rating > 0.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
                    <div class="ec_product_details_star_<?php if( $rating > 1.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
                    <div class="ec_product_details_star_<?php if( $rating > 2.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
                    <div class="ec_product_details_star_<?php if( $rating > 3.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
                    <div class="ec_product_details_star_<?php if( $rating > 4.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
                </span>
                <div class="ec_details_reviews"><?php $this->product->display_product_number_reviews(); ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_reviews_text' ); ?></div>
			</div>
			<?php }?>
        	<?php if( ( $this->product->is_catalog_mode && get_option( 'ec_option_hide_price_seasonal' ) ) || 
					  ( $this->product->is_inquiry_mode && get_option( 'ec_option_hide_price_inquiry' ) ) ){ // NO PRICE SHOWN
			
			}else if( $this->product->vat_rate > 0  && get_option( 'ec_option_show_multiple_vat_pricing' ) ){ ?>
            
            <div class="ec_details_price"><?php $this->product->display_product_pricing_no_vat( ); ?></div>
        	<div class="ec_details_price"><?php $this->product->display_product_pricing_vat( ); ?></div>
        	
			<?php }else{ ?>
        	<div class="ec_details_price"><?php $this->product->display_product_list_price(); ?><?php $this->product->display_price(); ?></div>
        	<?php }?>
        	<div class="ec_details_clear"></div>
        </div>
        <?php /* END MOBILE SIZED CONTENT REGION */ ?>
        <?php /* START PRODUCT IMAGES AREA */ ?>
        <div class="ec_details_images">
        	<div class="ec_details_main_image"<?php if( get_option( 'ec_option_show_large_popup' ) ){?> onclick="ec_details_show_image_popup( '<?php echo $this->product->model_number; ?>' );"<?php }else{ ?> style="cursor:inherit;"<?php }?>><img src="<?php echo $this->product->get_first_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div>
            
			<?php /* START MAIN IMAGE THUMBNAILS */ ?>
            <?php /* START DISPLAY FOR OPTION ITEM IMAGES USEAGE */ ?>
			<?php 
			if( $this->product->use_optionitem_images ){ ?>
            	<?php
				$optionitem_id_array = array( );
				foreach( $this->product->options->optionset1->optionset as $optionitem ){
					$optionitem_id_array[] = $optionitem->optionitem_id;
				}
				$thumbnails_displayed = 0;
				for( $i=0; $i<count( $this->product->images->imageset ); $i++ ){
					
					if( in_array( $this->product->images->imageset[$i]->optionitem_id, $optionitem_id_array ) ){
					?>
                    <div class="ec_details_thumbnails<?php if( $thumbnails_displayed > 0 ){ ?> ec_inactive<?php }?><?php if( $this->product->images->imageset[$i]->image2 == "" ){ ?> ec_no_thumbnails<?php }?>" id="ec_details_thumbnails_<?php echo $this->product->images->imageset[$i]->optionitem_id; ?>"<?php if( trim( $this->product->images->imageset[$i]->image2 ) == "" ){ ?> style="display:none !important;"<?php }?>>
                        <div class="ec_details_thumbnail ec_active"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics1/" . $this->product->images->imageset[$i]->image1 ); ?>" alt="<?php echo $this->product->title; ?>" /></div>
                        <?php if( trim( $this->product->images->imageset[$i]->image2 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics2/" . $this->product->images->imageset[$i]->image2 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                        <?php if( trim( $this->product->images->imageset[$i]->image3 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics3/" . $this->product->images->imageset[$i]->image3 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                        <?php if( trim( $this->product->images->imageset[$i]->image4 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics4/" . $this->product->images->imageset[$i]->image4 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                        <?php if( trim( $this->product->images->imageset[$i]->image5 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics5/" . $this->product->images->imageset[$i]->image5 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                    </div>
                    <?php
					
						if( $thumbnails_displayed == 0 ){ ?>
						
                    <div class="ec_details_thumbnails ec_inactive<?php if( $this->product->images->imageset[$i]->image2 == "" ){ ?> ec_no_thumbnails<?php }?>" id="ec_details_thumbnails_0"<?php if( trim( $this->product->images->imageset[$i]->image2 ) == "" ){ ?> style="display:none !important;"<?php }?>>
                        <div class="ec_details_thumbnail ec_active"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics1/" . $this->product->images->imageset[$i]->image1 ); ?>" alt="<?php echo $this->product->title; ?>" /></div>
                        <?php if( trim( $this->product->images->imageset[$i]->image2 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics2/" . $this->product->images->imageset[$i]->image2 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                        <?php if( trim( $this->product->images->imageset[$i]->image3 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics3/" . $this->product->images->imageset[$i]->image3 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                        <?php if( trim( $this->product->images->imageset[$i]->image4 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics4/" . $this->product->images->imageset[$i]->image4 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                        <?php if( trim( $this->product->images->imageset[$i]->image5 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics5/" . $this->product->images->imageset[$i]->image5 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                    </div>
                        
					<?php 
						
						$thumbnails_displayed++;
					
						}
					
					}// Close test for existing option item id (bad data fix)
				
				} //Close for loop of image set
				?>
            <?php 
			/* END DISPLAY FOR OPTION ITEM IMAGES THUMNAILS */
			
			
			/* START DISPLAY FOR BASIC IMAGE THUMBNAILS */
			}else if( trim( $this->product->images->image2 ) != "" ){ ?>
            <div class="ec_details_thumbnails">
            	<div class="ec_details_thumbnail ec_active"><img src="<?php echo $this->product->get_first_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div>
            	<div class="ec_details_thumbnail"><img src="<?php echo $this->product->get_second_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div>
            	<?php if( trim( $this->product->images->image3 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo $this->product->get_third_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
            	<?php if( trim( $this->product->images->image4 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo $this->product->get_fourth_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
            	<?php if( trim( $this->product->images->image5 ) != "" ){ ?><div class="ec_details_thumbnail"><img src="<?php echo $this->product->get_fifth_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
            </div>
            <?php }?>
            <?php /* END MAIN IMAGE THUMBNAILS */ ?>
            
            <?php /* START IMAGE MAGNIFICATION BOX */ ?>
            <?php if( !$ipad && !$iphone && get_option( 'ec_option_show_magnification' ) ){?>
            <div class="ec_details_magbox">
            	<div class="ec_details_magbox_image" style="background:url( '<?php echo $this->product->get_first_image_url( ); ?>' ) no-repeat"></div>
            </div>
            <?php }?>
            <?php /* END IMAGE MAGNICFICATION BOX */ ?>
            
            <?php /* START PRODUCT IMAGES POPUP AREA */ ?>
            <?php if( get_option( 'ec_option_show_large_popup' ) ){?>
            <div class="ec_details_large_popup" id="ec_details_large_popup_<?php echo $this->product->model_number; ?>">
            	<div class="ec_details_large_popup_content">
                	<div class="ec_details_large_popup_padding">
                    	<div class="ec_details_large_popup_holder">
                            <div class="ec_details_large_popup_main"><img src="<?php echo $this->product->get_first_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div>
                            
                            <?php /* SETUP POPUP THUMBNAILS */ ?>
                            <?php if( $this->product->use_optionitem_images ){ ?>
                                <?php
                                for( $i=0; $i<count( $this->product->images->imageset ); $i++ ){
                                    ?>
                                    <div class="ec_details_large_popup_thumbnails<?php if( $i > 0 ){ ?> ec_inactive<?php }?>" id="ec_details_large_popup_thumbnails_<?php echo $this->product->images->imageset[$i]->optionitem_id; ?>"<?php if( trim( $this->product->images->imageset[$i]->image2 ) == "" ){ ?> style="display:none;"<?php }?>>
                                        <div class="ec_details_large_popup_thumbnail ec_active"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics1/" . $this->product->images->imageset[$i]->image1 ); ?>" alt="<?php echo $this->product->title; ?>" /></div>
                                        <?php if( trim( $this->product->images->imageset[$i]->image2 ) != "" ){ ?><div class="ec_details_large_popup_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics2/" . $this->product->images->imageset[$i]->image2 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                                        <?php if( trim( $this->product->images->imageset[$i]->image3 ) != "" ){ ?><div class="ec_details_large_popup_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics3/" . $this->product->images->imageset[$i]->image3 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                                        <?php if( trim( $this->product->images->imageset[$i]->image4 ) != "" ){ ?><div class="ec_details_large_popup_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics4/" . $this->product->images->imageset[$i]->image4 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                                        <?php if( trim( $this->product->images->imageset[$i]->image5 ) != "" ){ ?><div class="ec_details_large_popup_thumbnail"><img src="<?php echo plugins_url( "/wp-easycart-data/products/pics5/" . $this->product->images->imageset[$i]->image5 ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            <?php }else if( trim( $this->product->images->image2 ) != "" ){ ?>
                            <div class="ec_details_large_popup_thumbnails">
                                <div class="ec_details_large_popup_thumbnail"><img src="<?php echo $this->product->get_first_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div>
                                <div class="ec_details_large_popup_thumbnail"><img src="<?php echo $this->product->get_second_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div>
                                <?php if( trim( $this->product->images->image3 ) != "" ){ ?><div class="ec_details_large_popup_thumbnail"><img src="<?php echo $this->product->get_third_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                                <?php if( trim( $this->product->images->image4 ) != "" ){ ?><div class="ec_details_large_popup_thumbnail"><img src="<?php echo $this->product->get_fourth_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                                <?php if( trim( $this->product->images->image5 ) != "" ){ ?><div class="ec_details_large_popup_thumbnail"><img src="<?php echo $this->product->get_fifth_image_url( ); ?>" alt="<?php echo $this->product->title; ?>" /></div><?php } ?>
                            </div>
                            <?php }?>
                            <?php /* END POPUP THUMBNAIL SETUP */ ?>
                            <div class="ec_details_large_popup_close"><input type="button" onclick="ec_details_hide_large_popup( '<?php echo $this->product->model_number; ?>' );" value="x"></div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                jQuery( '.ec_details_large_popup' ).appendTo( document.body );
            </script>
            <?php }?>
            <?php /* END PRODUCT IMAGE POPUP AREA */ ?>
            
        </div>
        <?php /* END PRODUCT IMAGES AREA */ ?>
        
        
        <div class="ec_details_right">
        	<?php if( $this->product->inquiry_url == "" ){ // Regular Add to Cart Form ?>
        	
            <form action="<?php echo $this->cart_page; ?>" method="POST" enctype="multipart/form-data" class="ec_add_to_cart_form">
            <?php if( $this->product->is_subscription_item ){ ?>
            <input type="hidden" name="ec_cart_form_action" value="subscribe_v3" />
            <?php }else{ ?>
            <input type="hidden" name="ec_cart_form_action" value="add_to_cart_v3" />
            <?php }?>
            <input type="hidden" name="product_id" value="<?php echo $this->product->product_id; ?>"  />
            
			<?php }else{ // Custom Inquiry Form ?>
            
            <form action="<?php echo $this->product->inquiry_url; ?>" method="GET" enctype="multipart/form-data" class="ec_add_to_cart_form">
            <input type="hidden" name="model_number" value="<?php echo $this->product->model_number; ?>"  />
            
			<?php }?>
            
        	<?php /* START TOP PRODUCT DATA */ ?>
        	<?php if( get_option( 'ec_option_show_breadcrumbs' ) ){ ?>
        	<h4 class="ec_details_breadcrumbs ec_small" id="ec_breadcrumbs_type2">
            <a href="<?php echo home_url( ); ?>"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_home_link' ); ?></a> / 
            <a href="<?php echo $this->store_page; ?>"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_store_link' ); ?></a> 
            <?php if( $this->product->menuitems[0]->menulevel1_1_name ){ ?> / 
            <a href="<?php if( !get_option( 'ec_option_use_old_linking_style' ) && $postid != "0" ){ 
                echo get_permalink( $this->product->menuitems[0]->menulevel1_1_post_id ); 
            }else{ 
                echo $this->store_page . $this->permalink_divider . "menuid=" . $this->product->menuitems[0]->menulevel1_1_menu_id;
            } ?>"><?php echo $this->product->menuitems[0]->menulevel1_1_name; ?></a>
            <?php if( $this->product->menuitems[0]->menulevel2_1_name ){ ?> / 
            <a href="<?php if( !get_option( 'ec_option_use_old_linking_style' ) && $postid != "0" ){ 
                echo get_permalink( $this->product->menuitems[0]->menulevel2_1_post_id );
            }else{ 
                echo $this->store_page . $this->permalink_divider . "submenuid=" . $this->product->menuitems[0]->menulevel2_1_menu_id;
            } ?>"><?php echo $this->product->menuitems[0]->menulevel2_1_name; ?></a>
            <?php if( $this->product->menuitems[0]->menulevel3_1_name ){ ?> / 
            <a href="<?php if( !get_option( 'ec_option_use_old_linking_style' ) && $postid != "0" ){ 
                echo get_permalink( $this->product->menuitems[0]->menulevel3_1_post_id );
            }else{
                echo $this->store_page . $this->permalink_divider . "subsubmenuid=" . $this->product->menuitems[0]->menulevel3_1_menu_id; 
            } ?>"><?php echo $this->product->menuitems[0]->menulevel3_1_name; ?></a><?php } } }?>
            </h4>
            <?php }?>
            
            <h1 class="ec_details_title"><?php echo $this->product->title; ?></h1>
            <div class="ec_title_divider"></div>
            <?php if( ( $this->product->is_catalog_mode && get_option( 'ec_option_hide_price_seasonal' ) ) || 
					  ( $this->product->is_inquiry_mode && get_option( 'ec_option_hide_price_inquiry' ) ) ){ // NO PRICE SHOWN
			
			}else if( $this->product->vat_rate > 0  && get_option( 'ec_option_show_multiple_vat_pricing' ) ){ ?>
            
            <div class="ec_details_price"><?php $this->product->display_product_pricing_no_vat( ); ?></div>
        	<div class="ec_details_price"><?php $this->product->display_product_pricing_vat( ); ?></div>
        	
			<?php }else{ ?>
            <div class="ec_details_price"><?php $this->product->display_product_list_price(); ?><?php $this->product->display_price(); ?></div>
            <?php }?>
            <?php if( $this->product->use_customer_reviews ){ ?>
            <div class="ec_details_rating">
				<?php $rating = $this->product->get_rating( ); ?>
                <div class="ec_product_details_star_<?php if( $rating > 0.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
                <div class="ec_product_details_star_<?php if( $rating > 1.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
                <div class="ec_product_details_star_<?php if( $rating > 2.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
                <div class="ec_product_details_star_<?php if( $rating > 3.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
                <div class="ec_product_details_star_<?php if( $rating > 4.49 ){ ?>on<?php }else{ ?>off<?php }?>"></div>
            </div>
            <?php }?>
            <?php if( get_option( 'ec_option_show_model_number' ) ){ ?>
            <div class="ec_details_model_number"><?php echo ucwords( $GLOBALS['language']->get_text( 'product_details', 'product_details_model_number' ) ); ?>: <?php echo $this->product->model_number; ?></div>
            <?php }?>
            <div class="ec_details_description"><?php echo nl2br( stripslashes( $this->product->short_description ) ); ?></div>
            <?php /* GIFT CARD OPTIONS */ ?>
            <?php if( $this->product->is_giftcard ){ ?>
			<div class="ec_details_options">
            	<div class="ec_details_option_row_error ec_giftcard_error" id="ec_details_giftcard_error"><?php echo $GLOBALS['language']->get_text( 'ec_errors', 'missing_gift_card_options' ); ?></div>
                <div class="ec_details_option_row">
                	<div class="ec_details_option_label"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_gift_card_recipient_name' ); ?></div>
                	<div class="ec_details_option_data"><input type="text" name="ec_giftcard_to_name" id="ec_giftcard_to_name" value="" /></div>
                </div>
            
                <div class="ec_details_option_row">
                	<div class="ec_details_option_label"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_gift_card_recipient_email' ); ?></div>
                	<div class="ec_details_option_data"><input type="text" name="ec_giftcard_to_email" id="ec_giftcard_to_email" value="" /></div>
                </div>
            
                <div class="ec_details_option_row">
                	<div class="ec_details_option_label"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_gift_card_sender_name' ); ?></div>
                	<div class="ec_details_option_data"><input type="text" name="ec_giftcard_from_name" id="ec_giftcard_from_name" value="" /></div>
                </div>
            
                <div class="ec_details_option_row">
                	<div class="ec_details_option_label"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_gift_card_message' ); ?></div>
                	<div class="ec_details_option_data"><textarea name="ec_giftcard_message" id="ec_giftcard_message"></textarea></div>
                </div>
            </div>
            <?php }?>
            <?php /* END GIFT CARD OPTIONS */ ?>
            
            <?php /* DONATION OPTIONS */ ?>
            <?php if( $this->product->is_donation ){ ?>
            <div class="ec_details_options">
            	<div class="ec_details_option_row_error ec_donation_error" id="ec_details_donation_error"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_gift_card_error' ); ?></div>
                <div class="ec_details_option_row">
                	<div class="ec_details_option_label"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_donation_amount' ); ?></div>
                	<div class="ec_details_option_data"><input type="number" step=".01" min="<?php echo $GLOBALS['currency']->get_number_only( $this->product->price ); ?>" name="ec_donation_amount" id="ec_donation_amount" value="<?php echo $GLOBALS['currency']->get_number_only( $this->product->price ); ?>" /></div>
                </div>
            </div>
            <?php } ?>
            <?php /* END DONATION OPTIONS */ ?>
            
			<?php if( !$this->product->using_role_price && isset( $this->product->pricetiers[0] ) && count( $this->product->pricetiers[0] ) > 1 ){ ?>
            <ul class="ec_details_tiers">
            	<?php 
				foreach( $this->product->pricetiers as $pricetier ){
					$tier_price = $GLOBALS['currency']->get_currency_display( $pricetier[0] );
					$tier_quantity = $pricetier[1];
					?>
            	<li><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_tier_buy' ); ?> <?php echo $tier_quantity; ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_tier_buy_at' ); ?> <?php echo $tier_price; ?></li>
                <?php }?>
            </ul>
            <?php }
			/* END TOP PRODUCT DATA */
			?>
            
            <?php /* PRODUCT BASIC OPTIONS */ 
			$has_quantity_grid = false;
			?>
            <?php if( $this->product->has_options ){ ?>
            <div class="ec_details_options">
            <?php 
			$optionsets = array( $this->product->options->optionset1, $this->product->options->optionset2, $this->product->options->optionset3, $this->product->options->optionset4, $this->product->options->optionset5 );
			
			for( $i=0; $i<5; $i++ ){ ?>
            
            	<?php
				/* START SWATCHES AREA */
				if( count( $optionsets[$i]->optionset ) > 0 && $optionsets[$i]->optionset[0]->optionitem_icon && $optionsets[$i]->optionset[0]->optionitem_icon != "" ){ ?>
                
                <div class="ec_details_option_row_error ec_option<?php echo ( $i+1 ); ?>" id="ec_details_option_row_error_<?php echo $optionsets[$i]->option_id; ?>"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_missing_option' ); ?> <?php echo $optionsets[$i]->option_label; ?></div>
                <input type="hidden" name="ec_option<?php echo ($i+1); ?>" id="ec_option<?php echo ($i+1); ?>" value="0" />
                <div class="ec_details_option_row">
                	<div class="ec_details_option_label"><?php echo $optionsets[$i]->option_label; ?></div>
					<ul class="ec_details_swatches">
                	<?php
					for( $j=0; $j<count( $optionsets[$i]->optionset ); $j++ ){
						// Check the in stock status for this option item
						if( $this->product->use_optionitem_quantity_tracking && ( $i > 0 || $this->product->option1quantity[$j]->quantity <= 0 ) ){
							$optionitem_in_stock = false;
						}else{
							$optionitem_in_stock = true;
						}
					?>
					<li class="ec_details_swatch ec_option<?php echo ($i+1); ?><?php if( $optionitem_in_stock ){ ?> ec_active <?php }?><?php if( $optionsets[$i]->optionset[$j]->optionitem_initially_selected ){ ?> ec_selected<?php }?>" data-optionitem-id="<?php echo $optionsets[$i]->optionset[$j]->optionitem_id; ?>"<?php if( $this->product->use_optionitem_quantity_tracking && $i == 0 ){ ?> data-optionitem-quantity="<?php echo $this->product->option1quantity[$j]->quantity; ?>"<?php }?> data-optionitem-price="<?php if( $optionsets[$i]->optionset[$j]->optionitem_price != "" ){ echo $optionsets[$i]->optionset[$j]->optionitem_price; }else{ echo "0.00"; } ?>" data-optionitem-price-onetime="<?php if( isset( $optionsets[$i]->optionset[$j]->optionitem_price_onetime ) && $optionsets[$i]->optionset[$j]->optionitem_price_onetime != "" ){ echo $optionsets[$i]->optionset[$j]->optionitem_price_onetime; }else{ echo "0.00"; } ?>" data-optionitem-price-override="<?php if( isset( $optionsets[$i]->optionset[$j]->optionitem_price_override ) && $optionsets[$i]->optionset[$j]->optionitem_price_override != "" ){ echo $optionsets[$i]->optionset[$j]->optionitem_price_override; }else{ echo "-1.00"; } ?>" data-optionitem-price-multiplier="<?php echo $optionsets[$i]->optionset[$j]->optionitem_price_multiplier; ?>"><img src="<?php echo plugins_url( "/wp-easycart-data/products/swatches/" . $optionsets[$i]->optionset[$j]->optionitem_icon ); ?>" title="<?php echo $optionsets[$i]->optionset[$j]->optionitem_name; ?><?php if( $optionsets[$i]->optionset[$j]->optionitem_price > 0 ){ ?> ( +<?php echo $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price ); ?> <?php echo $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ); ?> )<?php }else if( $optionsets[$i]->optionset[$j]->optionitem_price < 0 ){ ?> ( <?php echo $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price ); ?> <?php echo $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ); ?> )<?php }else if( isset( $optionsets[$i]->optionset[$j]->optionitem_price_onetime ) && $optionsets[$i]->optionset[$j]->optionitem_price_onetime > 0 ){ ?> ( +<?php echo $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price_onetime ); ?> <?php echo $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ); ?> )<?php }else if( isset( $optionsets[$i]->optionset[$j]->optionitem_price_onetime ) && $optionsets[$i]->optionset[$j]->optionitem_price_onetime < 0 ){ ?> ( <?php echo $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price_onetime ); ?> <?php echo $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ); ?> )<?php }else if( isset( $optionsets[$i]->optionset[$j]->optionitem_price_override ) && $optionsets[$i]->optionset[$j]->optionitem_price_override > -1 ){ ?> ( <?php echo $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ); ?> <?php echo $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price_override ); ?> )<?php }?>" /></li>
					<?php
                    }
					?>
                	</ul>
                    <div class="ec_option_loading" id="ec_option_loading_<?php echo ($i+1); ?>"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_loading_options' ); ?></div>
                </div>
				<?php
				/* END SWATCHES AREA */
				
				/* START COMBO BOX AREA */
				}else if( count( $optionsets[$i]->optionset ) > 0 && $optionsets[$i]->optionset[0]->optionitem_name != "" ){ ?>
                <div class="ec_details_option_row_error ec_option<?php echo ( $i+1 ); ?>" id="ec_details_option_row_error_<?php echo $optionsets[$i]->option_id; ?>"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_missing_option' ); ?> <?php echo $optionsets[$i]->option_label; ?></div>
                
                <div class="ec_details_option_row">
					<select name="ec_option<?php echo ($i+1); ?>" id="ec_option<?php echo ($i+1); ?>" class="ec_details_combo ec_option<?php echo ($i+1); ?><?php if( $this->product->use_optionitem_quantity_tracking && $i > 0 ){ ?> ec_inactive<?php }?>"<?php if( $this->product->use_optionitem_quantity_tracking && $i > 0 ){ ?> disabled="disabled"<?php }?>>
                    <option value="0"<?php if( $this->product->use_optionitem_quantity_tracking && $i == 0 ){ ?> data-optionitem-quantity="<?php echo $this->product->stock_quantity; ?>"<?php }?> data-optionitem-price="0.00" data-optionitem-price-onetime="0.00" data-optionitem-price-override="-1" data-optionitem-price-multiplier="-1.00"><?php echo $optionsets[$i]->option_label; ?></option>
					<?php
                    for( $j=0; $j<count( $optionsets[$i]->optionset ); $j++ ){
						// Check the in stock status for this option item
						if( $this->product->use_optionitem_quantity_tracking && ( $i > 0 || $this->product->option1quantity[$j]->quantity <= 0 ) ){
							$optionitem_in_stock = false;
						}else{
							$optionitem_in_stock = true;
						}
					?>
                    <?php if( !$this->product->use_optionitem_quantity_tracking || $i != 0 || $this->product->option1quantity[$j]->quantity > 0 ){ ?> 
					<option value="<?php echo $optionsets[$i]->optionset[$j]->optionitem_id; ?>"<?php if( $this->product->use_optionitem_quantity_tracking && $i == 0 ){ ?> data-optionitem-quantity="<?php echo $this->product->option1quantity[$j]->quantity; ?>"<?php }?> data-optionitem-price="<?php if( $optionsets[$i]->optionset[$j]->optionitem_price != "" ){ echo $optionsets[$i]->optionset[$j]->optionitem_price; }else{ echo "0.00"; } ?>" data-optionitem-price-onetime="<?php if( $optionsets[$i]->optionset[$j]->optionitem_price_onetime != "" ){ echo $optionsets[$i]->optionset[$j]->optionitem_price_onetime; }else{ echo "0.00"; } ?>" data-optionitem-price-override="<?php if( isset( $optionsets[$i]->optionset[$j]->optionitem_price_override ) && $optionsets[$i]->optionset[$j]->optionitem_price_override != "" ){ echo $optionsets[$i]->optionset[$j]->optionitem_price_override; }else{ echo "-1.00"; } ?>" data-optionitem-price-multiplier="<?php echo $optionsets[$i]->optionset[$j]->optionitem_price_multiplier; ?>"<?php if( $optionsets[$i]->optionset[$j]->optionitem_initially_selected ){ ?> selected="selected"<?php }?>><?php echo $optionsets[$i]->optionset[$j]->optionitem_name; ?><?php if( $optionsets[$i]->optionset[$j]->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionsets[$i]->optionset[$j]->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( isset( $optionsets[$i]->optionset[$j]->optionitem_price_onetime ) && $optionsets[$i]->optionset[$j]->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionsets[$i]->optionset[$j]->optionitem_price_onetime ) && $optionsets[$i]->optionset[$j]->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionsets[$i]->optionset[$j]->optionitem_price_override ) && $optionsets[$i]->optionset[$j]->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . $GLOBALS['currency']->get_currency_display( $optionsets[$i]->optionset[$j]->optionitem_price_override ) . ')'; } ?></option>
                    <?php }?>	
					<?php
                    }
					?>
                    </select>
                    <div class="ec_option_loading" id="ec_option_loading_<?php echo ($i+1); ?>"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_loading_options' ); ?></div>
                </div>
                <?php
				}
				/* END COMBO BOX AREA*/
			}
			?>
            </div>
            <?php } ?>
            <?php /* END BASIC OPTIONS */ ?>
            
            <?php /* PRODUCT ADVANCED OPTIONS */ ?>
            <?php 
			
			$add_price_grid = 0;
			$add_order_price_grid = 0;
			$override_price_grid = -1;
			if( $this->product->use_advanced_optionset && count( $this->product->advanced_optionsets ) > 0 ){ ?>
            <div class="ec_details_options">
            	<?php 
				foreach( $this->product->advanced_optionsets as $optionset ){
					$optionitems = $this->product->get_advanced_optionitems( $optionset->option_id );
				?>
                <?php 
				if( $optionset->option_required ){ 
				?>
                <div class="ec_details_option_row_error" id="ec_details_option_row_error_<?php echo $optionset->option_id; ?>"><?php echo $optionset->option_error_text; ?></div>
                <?php
				}
				?>
                <div class="ec_details_option_row ec_option_type_<?php echo $optionset->option_type; ?>" data-option-id="<?php echo $optionset->option_id; ?>" data-option-required="<?php echo $optionset->option_required; ?>">
                	<?php if( $optionset->option_type != "combo" ){ ?>
                    <div class="ec_details_option_label"><?php echo $optionset->option_label; ?></div>
                    <?php }?>
                    <div class="ec_details_option_data">
                	<?php
					/* START ADVANCED CHECBOX TYPE */
					if( $optionset->option_type == "checkbox" ){
					?>
                    
                    	<?php
						foreach( $optionitems as $optionitem ){
						?>
                        	
                            <div class="ec_details_checkbox_row"><input type="checkbox" class="ec_option_<?php echo $optionset->option_id; ?>" name="ec_option_<?php echo $optionset->option_id; ?>_<?php echo $optionitem->optionitem_id; ?>" value="<?php echo $optionitem->optionitem_name; ?>" data-optionitem-price="<?php echo $optionitem->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitem->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitem->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitem->optionitem_price_multiplier; ?>"<?php if( $optionitem->optionitem_initially_selected ){ ?> checked="checked"<?php }?> /> <?php echo $optionitem->optionitem_name; ?><?php if( $optionitem->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitem->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitem->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitem->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitem->optionitem_price_override ) && $optionitem->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_override ) . ')'; } ?></div>
                            
                        <?php
						}
						?>
                        
                    <?php
					
					/* START ADVANCED COMBO TYPE */
					}else if( $optionset->option_type == "combo" ){
					?>
                    	<select name="ec_option_<?php echo $optionset->option_id; ?>" id="ec_option_<?php echo $optionset->option_id; ?>">
                        <option value="0" data-optionitem-price="0.000" data-optionitem-price-onetime="0.000" data-optionitem-price-override="-1.000" data-optionitem-price-multiplier="-1.000"><?php echo $optionset->option_label; ?></option>
                    	<?php
						foreach( $optionitems as $optionitem ){
						?>
                        	
                            <option value="<?php echo $optionitem->optionitem_id; ?>" data-optionitem-price="<?php echo $optionitem->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitem->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitem->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitem->optionitem_price_multiplier; ?>"<?php if( $optionitem->optionitem_initially_selected ){ ?> selected="selected"<?php }?>><?php echo $optionitem->optionitem_name; ?><?php if( $optionitem->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitem->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitem->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitem->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitem->optionitem_price_override ) && $optionitem->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_override ) . ')'; } ?></option>
                            
                        <?php
						}
						?>
                    	</select>
                    <?php
					
					/* START ADVANCED DATE TYPE*/
					}else if( $optionset->option_type == "date" ){
					?>
                    
                    	<input type="date" name="ec_option_<?php echo $optionset->option_id; ?>" id="ec_option_<?php echo $optionset->option_id; ?>" data-optionitem-price="<?php echo $optionitems[0]->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitems[0]->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitems[0]->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitems[0]->optionitem_price_multiplier; ?>" /><?php if( $optionitems[0]->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_override ) && $optionitems[0]->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_override ) . ')'; } ?>
                    
                    <?php
					
					/* START ADVANCED FILE TYPE */
					}else if( $optionset->option_type == "file" ){
					?>
                    
                    	<input type="file" name="ec_option_<?php echo $optionset->option_id; ?>" id="ec_option_<?php echo $optionset->option_id; ?>" data-optionitem-price="<?php echo $optionitems[0]->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitems[0]->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitems[0]->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitems[0]->optionitem_price_multiplier; ?>" /><?php if( $optionitems[0]->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_override ) && $optionitems[0]->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_override ) . ')'; } ?>
                    
                    <?php
					
					/* START ADVANCED SWATCH TYPE */
					}else if( $optionset->option_type == "swatch" ){
					?>
                    	<input type="hidden" name="ec_option_<?php echo $optionset->option_id; ?>" id="ec_option_<?php echo $optionset->option_id; ?>" value="0" />
                    	<ul class="ec_details_swatches">
							<?php
                            for( $j=0; $j<count( $optionitems ); $j++ ){
                            ?>
                            	<li class="ec_details_swatch ec_advanced ec_option_<?php echo $optionset->option_id; ?> ec_active<?php if( $optionsets[$i]->optionset[$j]->optionitem_initially_selected ){ ?> ec_selected<?php }?>" data-optionitem-id="<?php echo $optionitems[$j]->optionitem_id; ?>" data-option-id="<?php echo $optionset->option_id; ?>" data-optionitem-price="<?php echo $optionitems[$j]->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitems[$j]->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitems[$j]->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitems[$j]->optionitem_price_multiplier; ?>"><img src="<?php echo plugins_url( "/wp-easycart-data/products/swatches/" . $optionitems[$j]->optionitem_icon ); ?>"<?php if( $optionitems[$j]->optionitem_price > 0 ){ ?> title="+<?php echo $GLOBALS['currency']->get_currency_display( $optionitems[$j]->optionitem_price ); ?> <?php echo $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ); ?>"<?php }else if( $optionitems[$j]->optionitem_price < 0 ){ ?> title="<?php echo $GLOBALS['currency']->get_currency_display( $optionitems[$j]->optionitem_price ); ?> <?php echo $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ); ?>"<?php }else if( $optionitems[$j]->optionitem_price_onetime > 0 ){ ?> title="+<?php echo $GLOBALS['currency']->get_currency_display( $optionitems[$j]->optionitem_price_onetime ); ?> <?php echo $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ); ?>"<?php }else if( $optionitems[$j]->optionitem_price_onetime < 0 ){ ?> title="<?php echo $GLOBALS['currency']->get_currency_display( $optionitems[$j]->optionitem_price_onetime ); ?> <?php echo $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ); ?>"<?php }else if( isset( $optionitems[$j]->optionitem_price_override ) && $optionitems[$j]->optionitem_price_override > -1 ){ ?> title="<?php $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ); ?> <?php echo $GLOBALS['currency']->get_currency_display( $optionitems[$j]->optionitem_price_override ); ?>"<?php }?>/></li>
                            <?php
							}
							?>
                        </ul>
                    
                    <?php
					
					/* START ADVANCED GRID TYPE */
					}else if( $optionset->option_type == "grid" ){
						$has_quantity_grid = true;
					?>
                    
                    	<?php
						foreach( $optionitems as $optionitem ){
						
						if( $optionitem->optionitem_initial_value > 0 ){	
							if( $optionitem->optionitem_price >= 0 ){
								$add_price_grid = $add_price_grid + $optionitem->optionitem_price;
							
							}else if( $optionitem->optionitem_price_override >= 0 ){
								$override_price_grid = $optionitem->optionitem_price_override;
							
							}else if( $optionitem->optionitem_price_onetime > 0 ){
								$add_order_price_grid = $add_order_price_grid + $optionitem->optionitem_price_onetime;
							
							}
						}
						?>
                        	
                            <div class="ec_details_grid_row"><span><?php echo $optionitem->optionitem_name; ?></span><input type="number" min="0" step="1" name="ec_option_<?php echo $optionset->option_id; ?>_<?php echo $optionitem->optionitem_id; ?>" value="<?php echo number_format( $optionitem->optionitem_initial_value, 0, "", "" ); ?>" data-optionitem-price="<?php echo $optionitem->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitem->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitem->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitem->optionitem_price_multiplier; ?>" /><?php if( $optionitem->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitem->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitem->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitem->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitem->optionitem_price_override ) && $optionitem->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_override ) . ')'; } ?></div>
                            
                        <?php
						}
						?>
                    
                    <?php
					
					/* START ADVANCED RADIO TYPE */
					}else if( $optionset->option_type == "radio" ){
					?>
                    
                    	<?php
						foreach( $optionitems as $optionitem ){
						?>
                        	
                            <div class="ec_details_radio_row"><input type="radio" name="ec_option_<?php echo $optionset->option_id; ?>" value="<?php echo $optionitem->optionitem_id; ?>" data-optionitem-price="<?php echo $optionitem->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitem->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitem->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitem->optionitem_price_multiplier; ?>"<?php if( $optionitem->optionitem_initially_selected ){ ?> selected="selected"<?php }?> /> <?php echo $optionitem->optionitem_name; ?><?php if( $optionitem->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitem->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitem->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitem->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitem->optionitem_price_override ) && $optionitem->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitem->optionitem_price_override ) . ')'; } ?></div>
                            
                        <?php
						}
						?>
                        
                    <?php
					
					/* START ADVANCED TEXT TYPE */
					}else if( $optionset->option_type == "text" ){
					?>
                    
                    	<input type="text" name="ec_option_<?php echo $optionset->option_id; ?>" id="ec_option_<?php echo $optionset->option_id; ?>" data-optionitem-price="<?php echo $optionitems[0]->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitems[0]->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitems[0]->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitems[0]->optionitem_price_multiplier; ?>" data-optionitem-price-per-character="<?php echo $optionitems[0]->optionitem_price_per_character; ?>" /><?php if( $optionitems[0]->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_override ) && $optionitems[0]->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_override ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_per_character ) && $optionitems[0]->optionitem_price_per_character > 0 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_per_character ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment_per_character' ) . ')'; } ?>
                    
                    <?php
					
					/* START ADVANCED TEXT AREA TYPE */
					}else if( $optionset->option_type == "textarea" ){
					?>
                    
                    	<textarea name="ec_option_<?php echo $optionset->option_id; ?>" id="ec_option_<?php echo $optionset->option_id; ?>" data-optionitem-price="<?php echo $optionitems[0]->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitems[0]->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitems[0]->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitems[0]->optionitem_price_multiplier; ?>" data-optionitem-price-per-character="<?php echo $optionitems[0]->optionitem_price_per_character; ?>"></textarea><?php if( $optionitems[0]->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_override ) && $optionitems[0]->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_override ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_per_character ) && $optionitems[0]->optionitem_price_per_character > 0 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_per_character ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment_per_character' ) . ')'; } ?>
                    
                    <?php
					
					/* START ADVANCED DIMENSIONS TYPE */
					}else if( $optionset->option_type == "dimensions1" || $optionset->option_type == "dimensions2" ){
						
						// Type 1 is NO sub dimensions (34")
						// Type 2 USES sub dimensions (34 1/2")
						
						$type = 2;
						
						if( $optionitems[0]->optionitem_name == "DimensionType1" )
							$type = 1;
					?>
                    
                    	<input type="text" name="ec_option_<?php echo $optionset->option_id; ?>_width" id="ec_option_<?php echo $optionset->option_id; ?>_width" data-optionitem-price="<?php echo $optionitems[0]->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitems[0]->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitems[0]->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitems[0]->optionitem_price_multiplier; ?>" data-optionitem-price-per-character="<?php echo $optionitems[0]->optionitem_price_per_character; ?>" class="ec_dimensions_box ec_dimensions_width" data-option-id="<?php echo $optionset->option_id; ?>" /><?php if( $optionitems[0]->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_override ) && $optionitems[0]->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_override ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_per_character ) && $optionitems[0]->optionitem_price_per_character > 0 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_per_character ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment_per_character' ) . ')'; } ?>
                        
                        <?php if( $type == 2 ){ ?>
                        <select name="ec_option_<?php echo $optionset->option_id; ?>_sub_width" id="ec_option_<?php echo $optionset->option_id; ?>_sub_width" class="ec_dimensions_select">
                        	<option value="0">0</option>
                        	<option value="1/16">1/16</option>
                        	<option value="1/8">1/8</option>
                        	<option value="3/16">3/16</option>
                        	<option value="1/4">1/4</option>
                        	<option value="5/16">5/16</option>
                        	<option value="3/8">3/8</option>
                        	<option value="7/16">7/16</option>
                        	<option value="1/2">1/2</option>
                        	<option value="9/16">9/16</option>
                        	<option value="5/8">5/8</option>
                        	<option value="11/16">11/16</option>
                        	<option value="3/4">3/4</option>
                        	<option value="13/16">13/16</option>
                        	<option value="7/8">7/8</option>
                        	<option value="15/16">15/16</option>
                        </select>
                        <?php }?>
                        
                        <span class="ec_dimensions_seperator">x</span>
                        
                        <input type="text" name="ec_option_<?php echo $optionset->option_id; ?>_height" id="ec_option_<?php echo $optionset->option_id; ?>_height" data-optionitem-price="<?php echo $optionitems[0]->optionitem_price; ?>" data-optionitem-price-onetime="<?php echo $optionitems[0]->optionitem_price_onetime; ?>" data-optionitem-price-override="<?php echo $optionitems[0]->optionitem_price_override; ?>" data-optionitem-price-multiplier="<?php echo $optionitems[0]->optionitem_price_multiplier; ?>" data-optionitem-price-per-character="<?php echo $optionitems[0]->optionitem_price_per_character; ?>" class="ec_dimensions_box" /><?php if( $optionitems[0]->optionitem_price > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime > 0 ){ echo ' (+' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( $optionitems[0]->optionitem_price_onetime < 0 ){ echo ' (' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_onetime ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_order_adjustment' ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_override ) && $optionitems[0]->optionitem_price_override > -1 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_new_price_option' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_override ) . ')'; }else if( isset( $optionitems[0]->optionitem_price_per_character ) && $optionitems[0]->optionitem_price_per_character > 0 ){ echo ' (' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment' ) . ' ' . $GLOBALS['currency']->get_currency_display( $optionitems[0]->optionitem_price_per_character ) . ' ' . $GLOBALS['language']->get_text( 'cart', 'cart_item_adjustment_per_character' ) . ')'; } ?>
                        
                        <?php if( $type == 2 ){ ?>
                        <select name="ec_option_<?php echo $optionset->option_id; ?>_sub_height" id="ec_option_<?php echo $optionset->option_id; ?>_sub_height" class="ec_dimensions_select">
                        	<option value="0">0</option>
                        	<option value="1/16">1/16</option>
                        	<option value="1/8">1/8</option>
                        	<option value="3/16">3/16</option>
                        	<option value="1/4">1/4</option>
                        	<option value="5/16">5/16</option>
                        	<option value="3/8">3/8</option>
                        	<option value="7/16">7/16</option>
                        	<option value="1/2">1/2</option>
                        	<option value="9/16">9/16</option>
                        	<option value="5/8">5/8</option>
                        	<option value="11/16">11/16</option>
                        	<option value="3/4">3/4</option>
                        	<option value="13/16">13/16</option>
                        	<option value="7/8">7/8</option>
                        	<option value="15/16">15/16</option>
                        </select>
                        <?php }?>
                    
                    <?php
					}
				?>
                	</div>
				</div>				
				<?php
				}
				?>
            </div>
            <?php }?>
            <?php /* END ADVANCED OPTIONS*/ ?>
            
            <?php /* PRODUCT ADD TO CART */ ?>
            <div class="ec_details_option_row_error" id="ec_addtocart_quantity_exceeded_error"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_maximum_quantity' ); ?></div>
            <div class="ec_details_option_row_error" id="ec_addtocart_quantity_minimum_error"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_minimum_quantity_text1' ); ?> <?php echo $this->product->min_purchase_quantity; ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_minimum_quantity_text2' ); ?></div>
            <div class="ec_details_option_row_error" id="ec_addtocart_quantity_maximum_error"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_maximum_quantity_text1' ); ?> <?php echo $this->product->max_purchase_quantity; ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_maximum_quantity_text2' ); ?></div>
            
            <div class="ec_details_add_to_cart_area">
				
				<?php /* CATALOG MODE */ ?>
				<?php if( get_option( 'ec_option_display_as_catalog' ) ){
				// Show nothing
				
				}else if( $this->product->is_catalog_mode ){ ?>
				<div class="ec_details_seasonal_mode"><?php echo $this->product->catalog_mode_phrase; ?></div>	
        		
				<?php /* INQUIRY BUTTON */ ?>
				<?php }else if( $this->product->is_inquiry_mode ){ ?>
                <div class="ec_details_add_to_cart">
                	<input type="submit" value="<?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_inquire' ); ?>" <?php if( $this->product->inquiry_url == "" ){ ?>onclick="return ec_details_show_inquiry_form( );" <?php }?>style="margin-left:0px !important;" />
                </div>
                
                <?php /* DecoNetwork BUTTON */ ?>
				<?php }else if( $this->product->is_deconetwork ){ ?>
                <?php if( get_option( 'ec_option_deconetwork_allow_blank_products' ) ){ // Custom option to have both add to cart and design now ?>
                    
                <div class="ec_details_quantity"<?php if( $has_quantity_grid ){ ?> style="display:none;"<?php }?>><input type="button" value="-" class="ec_minus" onclick="ec_minus_quantity( '<?php echo $this->product->model_number; ?>', <?php echo $this->product->min_purchase_quantity; ?> );" /><input type="number" value="<?php if( $this->product->min_purchase_quantity > 0 ){ echo $this->product->min_purchase_quantity; }else{ echo '1'; } ?>" name="ec_quantity" id="ec_quantity" autocomplete="off" step="1" min="<?php if( $this->product->min_purchase_quantity > 0 ){ echo $this->product->min_purchase_quantity; }else{ echo '1'; } ?>" class="ec_quantity"<?php if( $this->product->show_stock_quantity || $this->product->max_purchase_quantity > 0 ){ ?> max="<?php if( $this->product->max_purchase_quantity > 0 ){ echo $this->product->max_purchase_quantity; }else{ echo $this->product->stock_quantity; } ?>"<?php }?> /><input type="button" value="+" class="ec_plus" onclick="ec_plus_quantity( '<?php echo $this->product->model_number; ?>', <?php echo $this->product->show_stock_quantity; ?>, <?php echo $this->product->min_purchase_quantity; ?>, <?php if( $this->product->max_purchase_quantity > 0 ){ echo $this->product->max_purchase_quantity; }else{ echo $this->product->stock_quantity; } ?> );" /></div>
                <div class="ec_details_add_to_cart ec_deconetwork_custom_space">
                    <input type="submit" value="<?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_add_to_cart' ); ?>" onclick="return ec_details_add_to_cart( );"<?php if( $has_quantity_grid ){ ?> style="margin-left:0px !important;"<?php }?> />
                </div>
                    
                <?php }?>
                
                <div class="ec_details_add_to_cart">
                	<a href="<?php echo $this->product->get_deconetwork_link( ); ?>" style="margin-left:0px !important;"><?php echo $GLOBALS['language']->get_text( 'product_page', 'product_design_now' ); ?></a>
                </div>
				
				<?php /* SUBSCRIPTION BUTTON */ ?>
				<?php }else if( $this->product->is_subscription_item ){ ?>
                
				<?php if( !get_option( 'ec_option_subscription_one_only' ) ){ ?>
                <div class="ec_details_quantity"<?php if( $has_quantity_grid ){ ?> style="display:none;"<?php }?>><input type="button" value="-" class="ec_minus" onclick="ec_minus_quantity( '<?php echo $this->product->model_number; ?>', <?php echo $this->product->min_purchase_quantity; ?> );" /><input type="number" value="<?php if( $this->product->min_purchase_quantity > 0 ){ echo $this->product->min_purchase_quantity; }else{ echo '1'; } ?>" name="ec_quantity" id="ec_quantity" autocomplete="off" step="1" min="<?php if( $this->product->min_purchase_quantity > 0 ){ echo $this->product->min_purchase_quantity; }else{ echo '1'; } ?>" class="ec_quantity"<?php if( $this->product->show_stock_quantity || $this->product->max_purchase_quantity > 0 ){ ?> max="<?php if( $this->product->max_purchase_quantity > 0 ){ echo $this->product->max_purchase_quantity; }else{ echo $this->product->stock_quantity; } ?>"<?php }?> /><input type="button" value="+" class="ec_plus" onclick="ec_plus_quantity( '<?php echo $this->product->model_number; ?>', <?php echo $this->product->show_stock_quantity; ?>, <?php echo $this->product->min_purchase_quantity; ?>, <?php if( $this->product->max_purchase_quantity > 0 ){ echo $this->product->max_purchase_quantity; }else{ echo $this->product->stock_quantity; } ?> );" /></div>
                <?php }?>
                
                <div class="ec_details_add_to_cart">
                	<input type="submit" value="<?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_sign_up_now' ); ?>" onclick="return ec_details_add_to_cart( );"<?php if( get_option( 'ec_option_subscription_one_only' ) ){ ?> style="margin-left:0px !important;"<?php }?> />
                </div>
                
                <?php /* REGULAR BUTTON + QUANTITY */ ?>
                <?php }else if( $this->product->in_stock( ) ){ ?>
                <div class="ec_details_quantity"<?php if( $has_quantity_grid ){ ?> style="display:none;"<?php }?>><input type="button" value="-" class="ec_minus" onclick="ec_minus_quantity( '<?php echo $this->product->model_number; ?>', <?php echo $this->product->min_purchase_quantity; ?> );" /><input type="number" value="<?php if( $this->product->min_purchase_quantity > 0 ){ echo $this->product->min_purchase_quantity; }else{ echo '1'; } ?>" name="ec_quantity" id="ec_quantity" autocomplete="off" step="1" min="<?php if( $this->product->min_purchase_quantity > 0 ){ echo $this->product->min_purchase_quantity; }else{ echo '1'; } ?>" class="ec_quantity"<?php if( $this->product->show_stock_quantity || $this->product->max_purchase_quantity > 0 ){ ?> max="<?php if( $this->product->max_purchase_quantity > 0 ){ echo $this->product->max_purchase_quantity; }else{ echo $this->product->stock_quantity; } ?>"<?php }?> /><input type="button" value="+" class="ec_plus" onclick="ec_plus_quantity( '<?php echo $this->product->model_number; ?>', <?php echo $this->product->show_stock_quantity; ?>, <?php echo $this->product->min_purchase_quantity; ?>, <?php if( $this->product->max_purchase_quantity > 0 ){ echo $this->product->max_purchase_quantity; }else{ echo $this->product->stock_quantity; } ?> );" /></div>
                <div class="ec_details_add_to_cart">
                	<input type="submit" value="<?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_add_to_cart' ); ?>" onclick="return ec_details_add_to_cart( );"<?php if( $has_quantity_grid ){ ?> style="margin-left:0px !important;"<?php }?> />
                </div>
                
                <?php /* PRICING AREA FOR OPTIONS */ ?>
				<?php if( $this->product->has_options || $this->product->use_advanced_optionset ){ ?>
                <div class="ec_details_final_price"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_your_price' ); ?> <span id="ec_final_price"><?php if( $override_price_grid > -1 ){ echo $GLOBALS['currency']->get_currency_display( $override_price_grid ); }else if( $add_price_grid > 0 ){ echo $GLOBALS['currency']->get_currency_display( $this->product->price + $add_price_grid ); }else{ echo $GLOBALS['currency']->get_currency_display( $this->product->price ); } ?></span></div>
				<?php } ?>
                <span class="ec_details_hidden_base_price" id="ec_base_price"><?php echo $this->product->price; ?></span>
                
                 <?php /* OUT OF STOCK BUT BACKORDERS ALLOWED */ ?>
                <?php }else if( $this->product->allow_backorders ){ ?>
				<div class="ec_details_quantity"<?php if( $has_quantity_grid ){ ?> style="display:none;"<?php }?>><input type="button" value="-" class="ec_minus" onclick="ec_minus_quantity( '<?php echo $this->product->model_number; ?>', <?php echo $this->product->min_purchase_quantity; ?> );" /><input type="number" value="<?php if( $this->product->min_purchase_quantity > 0 ){ echo $this->product->min_purchase_quantity; }else{ echo '1'; } ?>" name="ec_quantity" id="ec_quantity" autocomplete="off" step="1" min="<?php if( $this->product->min_purchase_quantity > 0 ){ echo $this->product->min_purchase_quantity; }else{ echo '1'; } ?>" class="ec_quantity" /><input type="button" value="+" class="ec_plus" onclick="ec_plus_quantity( '<?php echo $this->product->model_number; ?>', <?php echo $this->product->show_stock_quantity; ?>, <?php echo $this->product->min_purchase_quantity; ?>, <?php if( $this->product->max_purchase_quantity > 0 ){ echo $this->product->max_purchase_quantity; }else{ echo '1000000'; } ?> );" /></div>
                <div class="ec_details_add_to_cart">
                	<input type="submit" value="<?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_backorder_button' ); ?>" onclick="return ec_details_add_to_cart( );"<?php if( $has_quantity_grid ){ ?> style="margin-left:0px !important;"<?php }?> />
                </div>
                
                <div class="ec_details_backorder_info" id="ec_back_order_info"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_out_of_stock' ); ?><?php if( $this->product->backorder_fill_date != "" ){ ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_backorder_until' ); ?> <?php echo $this->product->backorder_fill_date; ?><?php }?></div>
                
                <?php /* PRICING AREA FOR OPTIONS */ ?>
				<?php if( $this->product->has_options || $this->product->use_advanced_optionset ){ ?>
                <div class="ec_details_final_price"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_your_price' ); ?> <span id="ec_final_price"><?php if( $override_price_grid > -1 ){ echo $GLOBALS['currency']->get_currency_display( $override_price_grid ); }else if( $add_price_grid > 0 ){ echo $GLOBALS['currency']->get_currency_display( $this->product->price + $add_price_grid ); }else{ echo $GLOBALS['currency']->get_currency_display( $this->product->price ); } ?></span></div>
				<?php } ?>
                <span class="ec_details_hidden_base_price" id="ec_base_price"><?php echo $this->product->price; ?></span>
                
                <?php /* OUT OF STOCK INFO (NO ADD TO CART CASE) */ ?>
                <?php }else{ ?>
                <div class="ec_out_of_stock"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_out_of_stock' ); ?></div>
                <?php }?>
            </div>
            <?php /* END ADD TO CART */ ?>
            
            </form>
            
            <?php /* START AREA BELOW ADD TO CART BUTTON ROW */ ?>
            <?php if( $this->product->has_options || $this->product->use_advanced_optionset ){ ?><div class="ec_details_added_price"<?php if( $add_order_price_grid > 0 ){ echo ' style="display:block";'; } ?>><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_one_time_addition1' ); ?> <?php if( $GLOBALS['currency']->symbol_location ){ echo $GLOBALS['currency']->get_symbol( ); } ?><span id="ec_added_price"><?php if( $add_order_price_grid > 0 ){ echo $GLOBALS['currency']->get_number_only( $add_order_price_grid ); }else{ echo $GLOBALS['currency']->get_number_only( $this->product->price ); } ?></span> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_one_time_addition2' ); ?></span><?php if( !$GLOBALS['currency']->symbol_location ){ echo $GLOBALS['currency']->get_symbol( ); } ?></div><?php }?>
			
            <?php if( ( $this->product->show_stock_quantity || $this->product->use_optionitem_quantity_tracking ) && $this->product->stock_quantity > 0 ){ ?><div class="ec_details_stock_total"><span id="ec_details_stock_quantity"><?php echo $this->product->stock_quantity; ?></span> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_left_in_stock' ); ?></div><?php }?>
			
			<?php if( $this->product->min_purchase_quantity > 1 ){ ?><div class="ec_details_min_purchase_quantity"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_minimum_quantity_text1' ); ?> <?php echo $this->product->min_purchase_quantity; ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_minimum_quantity_text2' ); ?></div><?php }?>
			
			<?php if( $this->product->max_purchase_quantity > 0 ){ ?><div class="ec_details_min_purchase_quantity"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_maximum_quantity_text1' ); ?> <?php echo $this->product->max_purchase_quantity; ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_maximum_quantity_text2' ); ?></div><?php }?>
            
			<?php if( $this->product->handling_price > 0 ){ ?><div class="ec_details_handling_fee"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_handling_fee_notice1' ); ?> <?php echo $GLOBALS['currency']->get_currency_display( $this->product->handling_price ); ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_handling_fee_notice2' ); ?></div><?php }?>
            
			<?php if( $this->product->handling_price_each > 0 ){ ?><div class="ec_details_handling_fee"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_handling_fee_each_notice1' ); ?> <?php echo $GLOBALS['currency']->get_currency_display( $this->product->handling_price_each ); ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_handling_fee_each_notice2' ); ?></div><?php }?>
            
            <?php if( $this->product->subscription_signup_fee > 0 ){ ?><div class="ec_details_handling_fee"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_signup_fee_notice1' ); ?> <?php echo $GLOBALS['currency']->get_currency_display( $this->product->subscription_signup_fee ); ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_signup_fee_notice2' ); ?></div><?php }?>
            
			<?php if( get_option( 'ec_option_show_categories' ) ){ ?>
			<?php if( count( $this->product->categoryitems ) > 0 ){ ?><div class="ec_details_categories"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_categories' ); ?> <?php $categoryitems = array( ); foreach( $this->product->categoryitems as $categoryitem ){ $categoryitems[] = '<a href="' . $this->product->get_category_link( $categoryitem->post_id, $categoryitem->category_id ) . '">' . $categoryitem->category_name . '</a>'; } echo implode( ', ', $categoryitems ); ?></div><?php }?>
            <?php }?>
            
            <?php if( get_option( 'ec_option_show_manufacturer' ) ){ ?>
            <div class="ec_details_manufacturer"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_manufacturer' ); ?> <a href="<?php echo $this->product->get_manufacturer_link( ); ?>"><?php echo $this->product->manufacturer_name; ?></a></div>
			<?php }?>
            
            <?php /* START SOCIAL ICONS */ ?>
            <?php
			if( get_option( 'ec_option_base_theme' ) ){
				$folder = "wp-easycart-data";
				$theme = get_option( 'ec_option_base_theme' );
			}else{
				$folder = "wp-easycart";
				$theme = get_option( 'ec_option_latest_theme' );
			}
			?>
            <div class="ec_details_social">
            	
                <?php if( get_option( 'ec_option_use_facebook_icon' ) ){ ?>
                <div class="ec_details_social_icon ec_facebook"><a href="<?php echo $this->product->social_icons->get_facebook_link( ); ?>" target="_blank"><img src="<?php echo $this->product->social_icons->get_icon_image( "facebook-icon.png" ); ?>" alt="Facebook" /></a></div>
                <?php }?>
            	
                <?php if( get_option( 'ec_option_use_twitter_icon' ) ){ ?>
                <div class="ec_details_social_icon ec_twitter"><a href="<?php echo $this->product->social_icons->get_twitter_link( ); ?>" target="_blank"><img src="<?php echo $this->product->social_icons->get_icon_image( "twitter-icon.png" ); ?>" alt="Twitter" /></a></div>
                <?php }?>
            	
                <?php if( get_option( 'ec_option_use_email_icon' ) ){ ?>
                <div class="ec_details_social_icon ec_email"><a href="<?php echo $this->product->social_icons->get_email_link( ); ?>" target="_blank"><img src="<?php echo $this->product->social_icons->get_icon_image( "email-icon.png" ); ?>" alt="Email" /></a></div>
                <?php }?>
            	
                <?php if( get_option( 'ec_option_use_pinterest_icon' ) ){ ?>
                <div class="ec_details_social_icon ec_pinterest"><a href="<?php echo $this->product->social_icons->get_pinterest_link( ); ?>" target="_blank"><img src="<?php echo $this->product->social_icons->get_icon_image( "pinterest-icon.png" ); ?>" alt="Pinterest" /></a></div>
                <?php }?>
            	
                <?php if( get_option( 'ec_option_use_googleplus_icon' ) ){ ?>
                <div class="ec_details_social_icon ec_googleplus"><a href="<?php echo $this->product->social_icons->get_googleplus_link( ); ?>" target="_blank"><img src="<?php echo $this->product->social_icons->get_icon_image( "google-icon.png" ); ?>" alt="Google+" /></a></div>
                <?php }?>
            	
                <?php if( get_option( 'ec_option_use_linkedin_icon' ) ){ ?>
                <div class="ec_details_social_icon ec_linkedin"><a href="<?php echo $this->product->social_icons->get_linkedin_link( ); ?>" target="_blank"><img src="<?php echo $this->product->social_icons->get_icon_image( "linkedin-icon.png" ); ?>" alt="LinkedIn" /></a></div>
                <?php }?>
            	
                <?php if( get_option( 'ec_option_use_myspace_icon' ) ){ ?>
                <div class="ec_details_social_icon ec_myspace"><a href="<?php echo $this->product->social_icons->get_myspace_link( ); ?>" target="_blank"><img src="<?php echo $this->product->social_icons->get_icon_image( "myspace-icon.png" ); ?>" alt="MySpace" /></a></div>
                <?php }?>
            	
                <?php if( get_option( 'ec_option_use_digg_icon' ) ){ ?>
                <div class="ec_details_social_icon ec_digg"><a href="<?php echo $this->product->social_icons->get_digg_link( ); ?>" target="_blank"><img src="<?php echo $this->product->social_icons->get_icon_image( "digg-icon.png" ); ?>" alt="Digg" /></a></div>
                <?php }?>
            	
                <?php if( get_option( 'ec_option_use_delicious_icon' ) ){ ?>
                <div class="ec_details_social_icon ec_delicious"><a href="<?php echo $this->product->social_icons->get_delicious_link( ); ?>" target="_blank"><img src="<?php echo $this->product->social_icons->get_icon_image( "delicious-icon.png" ); ?>" alt="Delicious" /></a></div>
                <?php }?>
                
            </div>
            <?php /* END SOCIAL ICONS */ ?>
            
        </div>
        <?php /* END RIGHT HALF */ ?>
        
    </div>
    <?php /* END TOP SECTION*/ ?>
    
    
    <?php /* START EXTRA CONTENT AREA */ ?>
    <div class="ec_details_extra_area">
    	
        <ul class="ec_details_tabs">
        
        	<?php do_action( 'wpeasycart_pre_description_tab', $this->product->product_id ); ?>
        	<li class="ec_details_tab <?php echo apply_filters( 'wpeasycart_description_initally_active', 'ec_active', $this->product->product_id ); ?> ec_description"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_description' ); ?></li>
            
            <?php do_action( 'wpeasycart_pre_specifications_tab', $this->product->product_id ); ?>
        	<?php if( $this->product->use_specifications ){ ?><li class="ec_details_tab ec_specifications"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_specifications' ); ?></li><?php } ?>
        	
            <?php do_action( 'wpeasycart_pre_customer_reviews_tab', $this->product->product_id ); ?>
            <?php if( $this->product->use_customer_reviews ){ ?><li class="ec_details_tab ec_customer_reviews"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_customer_reviews' ); ?> (<?php echo count( $this->product->reviews ); ?>)</li><?php } ?>
        	
            <?php do_action( 'wpeasycart_addon_product_details_tab', $this->product->product_id ); ?>
        
        </ul>
        
        <div class="ec_details_description_tab" <?php echo apply_filters( 'wpeasycart_description_content_initally_active', '', $this->product->product_id ); ?>>
        	
			<?php 
			// START CONTENT EDITING SECTION
			if( $is_admin && !$is_preview && substr( $this->product->description, 0, 3 ) != "[ec" ){ ?>
            <div class="ec_details_edit_buttons">
            	<div class="ec_details_edit_button" id="ec_details_edit_description"><input type="button" value="Edit Description" onclick="ec_admin_show_description_editor( );" /></div>
        		<div class="ec_details_edit_button" id="ec_details_save_description"><input type="button" value="Save Description" onclick="ec_admin_save_description_editor( );" /></div>
            </div>
            
            <div class="ec_details_description_editor">
				<?php
					$content = apply_filters( 'the_content', stripslashes( $this->product->description ) );
					$content = str_replace( ']]>', ']]&gt;', $content );
					wp_editor( $content, 'desc_' . $this->product->model_number, array( ) );
				?>
            </div>
        	<?php } 
			//END CONTENT EDITING SECTION ?>
            
            <div class="ec_details_description_content">
				<?php
                	if( substr( $this->product->description, 0, 3 ) == "[ec" ){
                		$this->product->display_product_description( );
					}else{
        				$content = apply_filters( 'the_content', stripslashes( $this->product->description ) );
						$content = str_replace( ']]>', ']]&gt;', $content );
						echo $content;
					}
				?>
			</div>
            
		</div>
        
        <?php if( $this->product->use_specifications ){ ?>
        <div class="ec_details_specifications_tab">
        
        	<?php 
			// START CONTENT EDITING SECTION
			if( $is_admin && !$is_preview && substr( $this->product->specifications, 0, 3 ) != "[ec" ){ ?>
            <div class="ec_details_edit_buttons">
            	<div class="ec_details_edit_button" id="ec_details_edit_specifications"><input type="button" value="Edit Specifications" onclick="ec_admin_show_specifications_editor( );" /></div>
        		<div class="ec_details_edit_button" id="ec_details_save_specifications"><input type="button" value="Save Specifications" onclick="ec_admin_save_specifications_editor( );" /></div>
            </div>
            
            <div class="ec_details_specifications_editor">
				<?php
                	$content = apply_filters( 'the_content', stripslashes( $this->product->specifications ) );
					$content = stripslashes( str_replace( ']]>', ']]&gt;', $content ) );
					wp_editor( $content, 'specs_' . $this->product->model_number, array( ) );
        		?>
            </div>
        	<?php } 
			//END CONTENT EDITING SECTION ?>
            
            <div class="ec_details_specifications_content">
				<?php
        			if( substr( $this->product->specifications, 0, 3 ) == "[ec" ){
                		$this->product->display_product_specifications( );
					}else{
        				$content = apply_filters( 'the_content', stripslashes( $this->product->specifications ) );
						$content = stripslashes( str_replace( ']]>', ']]&gt;', $content ) );
						echo $content;
					}
				?>
			</div>
        
        </div>
        <?php }?>
        
        <?php 
		/* START CUSTOMER REVIEW AREA */
		if( $this->product->use_customer_reviews ){ ?>
        <div class="ec_details_customer_reviews_tab">
        	<?php if( count( $this->product->reviews ) > 0 ){ ?>
            <div class="ec_details_customer_reviews_left">
            	<h3><?php echo count( $this->product->reviews ); ?> <?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_reviews_for_text' ); ?> <?php echo $this->product->title; ?></h3>
            	<ul class="ec_details_customer_review_list">
                	<?php foreach( $this->product->reviews as $review_row ){ 
					$review = new ec_review( $review_row );
					?>
                    <li>
            	    	<div>
                        	<span class="ec_details_customer_review_date"><strong><?php echo $review->title; ?></strong> - <?php echo $review->review_date; ?></span>
                            <?php if( get_option( 'ec_option_customer_review_show_user_name' ) ){ ?><span class="ec_details_customer_review_name"><?php echo $review->reviewer_name; ?></span><?php }?>
                        	<span class="ec_details_customer_review_stars" title="Rated <?php echo $review->rating; ?> of 5"><?php echo $review->display_review_stars( ); ?></span>
                        </div>
            	        <div class="ec_details_customer_review_data"><?php echo nl2br( stripslashes( $review->description ) ); ?></div>
            	    </li>
                    <?php } ?>
            	</ul>
      		</div>
            <?php }else{ ?>
            <div class="ec_details_customer_reviews_left"><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_review_no_reviews' ); ?></div>
            <?php } ?>
            <?php if( !get_option( 'ec_option_customer_review_require_login' ) || ( $GLOBALS['ec_cart_data']->cart_data->user_id != "" && $GLOBALS['ec_cart_data']->cart_data->user_id != 0 ) ){ ?>
            <div class="ec_details_customer_reviews_form">
            	<div class="ec_details_customer_reviews_form_holder">
                    <div class="ec_details_customer_review_loader_holder" id="ec_details_customer_review_loader">
                        <div class="ec_details_customer_review_loader"><?php echo $GLOBALS['language']->get_text( 'customer_review', 'product_details_submitting_review' ); ?></div>
                    </div>
                    <div class="ec_details_customer_review_success_holder" id="ec_details_customer_review_success">
                        <div class="ec_details_customer_review_success"><?php echo $GLOBALS['language']->get_text( 'customer_review', 'product_details_review_submitted' ); ?></div>
                    </div>
                    <h3><?php echo $GLOBALS['language']->get_text( 'customer_review', 'product_details_add_a_review_for' ); ?> <?php echo $this->product->title; ?></h3>
                    <div class="ec_details_option_row_error" id="ec_details_review_error"><?php echo $GLOBALS['language']->get_text( 'customer_review', 'review_error' ); ?></div>
                    <div class="ec_details_customer_reviews_row"><?php echo $GLOBALS['language']->get_text( 'customer_review', 'product_details_your_review_title' ); ?></div>
                    <div class="ec_details_customer_reviews_row ec_lower_space"><input type="text" id="ec_review_title" /></div>
                    <div class="ec_details_customer_reviews_row"><?php echo $GLOBALS['language']->get_text( 'customer_review', 'product_details_your_review_rating' ); ?></div>
                    <div class="ec_details_customer_reviews_row ec_stars">
                        <div class="ec_product_details_star_off ec_details_review_input" data-review-score="1" id="ec_details_review_star1"></div>
                        <div class="ec_product_details_star_off ec_details_review_input" data-review-score="2" id="ec_details_review_star2"></div>
                        <div class="ec_product_details_star_off ec_details_review_input" data-review-score="3" id="ec_details_review_star3"></div>
                        <div class="ec_product_details_star_off ec_details_review_input" data-review-score="4" id="ec_details_review_star4"></div>
                        <div class="ec_product_details_star_off ec_details_review_input" data-review-score="5" id="ec_details_review_star5"></div>
                    </div>
                    <div class="ec_details_customer_reviews_row"><?php echo $GLOBALS['language']->get_text( 'customer_review', 'product_details_your_review_message' ); ?></div>
                    <div class="ec_details_customer_reviews_row ec_lower_space"><textarea id="ec_review_message"></textarea></div>
                    <div class="ec_details_customer_reviews_row" id="ec_details_submit_review_button_row"><input type="button" value="<?php echo $GLOBALS['language']->get_text( 'customer_review', 'product_details_your_review_submit' ); ?>" onclick="ec_submit_product_review( )" /></div>
                    <div class="ec_details_customer_reviews_row" id="ec_details_review_submitted_button_row"><input type="button" disabled="disabled" value="<?php echo $GLOBALS['language']->get_text( 'customer_review', 'product_details_review_submitted_button' ); ?>" /></div>
                </div>
            </div>
            <?php }else{ ?>
            <div class="ec_details_customer_reviews_form">
            	<div class="ec_details_customer_reviews_form_holder">
                	<?php echo $GLOBALS['language']->get_text( 'customer_review', 'product_details_review_log_in_first' ); ?>
                </div> 
            </div>
            <?php }?>
        </div>
        <?php }?>
        
        <?php do_action( 'wpeasycart_addon_product_details_tab_content', $this->product->product_id ); ?>
        
    </div>
    
    <?php /* START RELATED PRODUCTS AREA */ ?>
    <?php if( $this->product->featured_products->product1 || $this->product->featured_products->product2 || $this->product->featured_products->product3 || $this->product->featured_products->product4 ){ ?>
    <div class="ec_details_related_products_area">
    	<h3><?php echo $GLOBALS['language']->get_text( 'product_details', 'product_details_related_products' ); ?></h3>
    	<ul class="ec_details_related_products">
        	<?php if( $this->product->featured_products->product1 ){ ?>
            
            <?php
			$product = $this->product->featured_products->product1;
			if( file_exists( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option( 'ec_option_base_layout' ) . '/ec_product.php' ) )	
				include( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option('ec_option_base_layout') . '/ec_product.php' );
			else if( file_exists( WP_PLUGIN_DIR . '/' . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option( 'ec_option_latest_layout' ) . '/ec_product.php' ) )	
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option('ec_option_latest_layout') . '/ec_product.php' );
            ?>
			
            <?php } ?>
            
        	<?php if( $this->product->featured_products->product2 ){ ?>
            
            <?php
			$product = $this->product->featured_products->product2;
			if( file_exists( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option( 'ec_option_base_layout' ) . '/ec_product.php' ) )	
				include( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option('ec_option_base_layout') . '/ec_product.php' );
			else if( file_exists( WP_PLUGIN_DIR . '/' . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option( 'ec_option_latest_layout' ) . '/ec_product.php' ) )	
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option('ec_option_latest_layout') . '/ec_product.php' );
            ?>
            
            <?php } ?>
            
        	<?php if( $this->product->featured_products->product3 ){ ?>
            
            <?php
			$product = $this->product->featured_products->product3;
			if( file_exists( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option( 'ec_option_base_layout' ) . '/ec_product.php' ) )	
				include( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option('ec_option_base_layout') . '/ec_product.php' );
			else if( file_exists( WP_PLUGIN_DIR . '/' . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option( 'ec_option_latest_layout' ) . '/ec_product.php' ) )	
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option('ec_option_latest_layout') . '/ec_product.php' );
            ?>
            
            <?php } ?>
            
        	<?php if( $this->product->featured_products->product4 ){ ?>
            
            <?php
			$product = $this->product->featured_products->product4;
			if( file_exists( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option( 'ec_option_base_layout' ) . '/ec_product.php' ) )	
				include( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option('ec_option_base_layout') . '/ec_product.php' );
			else if( file_exists( WP_PLUGIN_DIR . '/' . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option( 'ec_option_latest_layout' ) . '/ec_product.php' ) )	
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option('ec_option_latest_layout') . '/ec_product.php' );
            ?>
            
            <?php } ?>
        </ul>
	</div>
    <?php }?>
	<div style="clear:both;"></div>
</section>

<script>var img = new Image( );
var img_width = 400;
var img_height = 400;
var img_ratio = 1;
var tier_quantities = [<?php if( !$this->product->using_role_price ){ for( $tier_i = 0; $tier_i < count( $this->product->pricetiers ); $tier_i++ ){ if( $tier_i > 0 ){ echo ","; } echo $this->product->pricetiers[$tier_i][1]; } } ?>];
var tier_prices = [<?php if( !$this->product->using_role_price ){ for( $tier_i = 0; $tier_i < count( $this->product->pricetiers ); $tier_i++ ){ if( $tier_i > 0 ){ echo ","; } echo $this->product->pricetiers[$tier_i][0]; } } ?>];<?php if( !$ipad && !$iphone && get_option( 'ec_option_show_magnification' ) ){?>
jQuery( '.ec_details_main_image' ).mousemove( function( e ){
	var parentOffset = jQuery( this ).parent( ).offset( ); 
	var mouse_x = e.pageX - parentOffset.left;
	var mouse_y = e.pageY - parentOffset.top;
	var div_width = jQuery( this ).width( );
	var div_height = jQuery( this ).height( );
	var x_val = '-' + ( ( img_width - div_width ) * ( mouse_x / div_width ) ) + 'px';
	var y_val = '-' + ( ( img_height - div_height ) * ( mouse_y / div_height ) ) + 'px';
	jQuery( '.ec_details_magbox_image' ).css( 'background-position', x_val + ' ' + y_val );	
} );
jQuery( '.ec_details_main_image' ).hover( 
	function( ){ 
		img = new Image( );
		img.onload = function( ){
			img_width = this.width;
			img_height = this.height;
			img_ratio =  img_height / img_width;
			jQuery( '.ec_details_magbox' ).css( 'width', jQuery( '.ec_details_main_image' ).width( ) + 'px' ).css( 'height', jQuery( '.ec_details_main_image' ).height( ) + 'px' );
			jQuery( '.ec_details_magbox_image' ).css( 'width', jQuery( '.ec_details_main_image' ).width( ) + 'px' ).css( 'height', jQuery( '.ec_details_main_image' ).height( ) + 'px' );
		}
		img.src = jQuery( this ).find( 'img' ).attr( 'src' );
		jQuery( '.ec_details_magbox' ).fadeIn( 'fast' ); 
	}, 
	function( ){ 
		jQuery( '.ec_details_magbox' ).fadeOut( 'fast' ); 
	} 
);<?php }?>
jQuery( '.ec_details_thumbnail' ).click( function( e ){ 
	var src = jQuery( this ).find( 'img' ).attr( 'src' );
	jQuery( '.ec_details_thumbnail' ).removeClass( 'ec_active' );
	jQuery( this ).addClass( 'ec_active' );
	jQuery( '.ec_details_main_image' ).find( 'img' ).attr( 'src', src );
	jQuery( '.ec_details_large_popup_main' ).find( 'img' ).attr( 'src', src );
	jQuery( '.ec_details_magbox_image' ).css( 'background', 'url( "' + src + '" ) no-repeat' );
});
jQuery( '.ec_details_large_popup_thumbnail' ).click( function( e ){
	var src = jQuery( this ).find( 'img' ).attr( 'src' );
	jQuery( '.ec_details_large_popup_thumbnail' ).removeClass( 'ec_active' );
	jQuery( this ).addClass( 'ec_active' );
	jQuery( '.ec_details_thumbnail' ).removeClass( 'ec_active' );
	jQuery( '.ec_details_main_image' ).find( 'img' ).attr( 'src', src );
	jQuery( '.ec_details_large_popup_main' ).find( 'img' ).attr( 'src', src );
	jQuery( '.ec_details_magbox_image' ).css( 'background', 'url( "' + src + '" ) no-repeat' );
});
jQuery( '.ec_minus' ).click( function( ){
	if( Number( jQuery( this ).parent( ).find( '.ec_quantity' ).val( ) ) > 0 && 
		Number( jQuery( this ).parent( ).find( '.ec_quantity' ).val( ) ) > Number( jQuery( this ).parent( ).find( '.ec_quantity' ).attr( 'min' ) )
	){
		jQuery( this ).parent( ).find( '.ec_quantity' ).val( Number( jQuery( this ).parent( ).find( '.ec_quantity' ).val( ) ) - 1 )
	}
	<?php if( $this->product->use_advanced_optionset ){ ?>ec_details_advanced_adjust_price( );<?php }else{ ?>ec_details_base_adjust_price( );<?php }?>
} );
jQuery( '.ec_plus' ).click( function( ){
	if( !jQuery( this ).parent( ).find( '.ec_quantity' ).attr( 'max' ) || 
		Number( jQuery( this ).parent( ).find( '.ec_quantity' ).val( ) ) < Number( jQuery( this ).parent( ).find( '.ec_quantity' ).attr( 'max' ) )
	){
		jQuery( this ).parent( ).find( '.ec_quantity' ).val( Number( jQuery( this ).parent( ).find( '.ec_quantity' ).val( ) ) + 1 )
	}
	<?php if( $this->product->use_advanced_optionset ){ ?>ec_details_advanced_adjust_price( );<?php }else{ ?>ec_details_base_adjust_price( );<?php }?>
} );
jQuery( document.getElementById( 'ec_quantity' ) ).change( function( ){
	<?php if( $this->product->use_advanced_optionset ){ ?>ec_details_advanced_adjust_price( );<?php }else{ ?>ec_details_base_adjust_price( );<?php }?>
} );
jQuery( document.getElementById( 'ec_donation_amount' ) ).change( function( ){
	<?php if( $this->product->use_advanced_optionset ){ ?>ec_details_advanced_adjust_price( );<?php }else{ ?>ec_details_base_adjust_price( );<?php }?>
} );
jQuery( '.ec_details_tab' ).click( function( ){
	jQuery( '.ec_details_tab' ).removeClass( 'ec_active' );
	jQuery( this ).addClass( 'ec_active' );
	jQuery( '.ec_details_extra_area' ).children( 'div' ).each( function( ){ jQuery( this ).hide( ) } );
	if( jQuery( this ).hasClass( 'ec_description' ) )
		jQuery( '.ec_details_description_tab' ).show( );
	else if( jQuery( this ).hasClass( 'ec_specifications' ) )
		jQuery( '.ec_details_specifications_tab' ).show( );
	else if( jQuery( this ).hasClass( 'ec_customer_reviews' ) )
		jQuery( '.ec_details_customer_reviews_tab' ).show( );
	else
		jQuery( '.ec_details_' + jQuery( this ).attr( 'data-tab-id' ) + '_tab' ).show( );
} );
jQuery( '.ec_details_swatches > li.ec_option1' ).click( function( ){
	if( jQuery( this ).hasClass( 'ec_active' ) ){
		var optionitem_id_1 = jQuery( this ).attr( 'data-optionitem-id' );
		var quantity = jQuery( this ).attr( 'data-optionitem-quantity' );
		<?php if( $this->product->use_optionitem_quantity_tracking ){ ?>
		ec_option1_selected( optionitem_id_1, quantity );
		<?php }?>
		ec_option1_image_change( optionitem_id_1, quantity );
		jQuery( '.ec_details_swatches > li.ec_option1' ).removeClass( 'ec_selected' );
		jQuery( this ).addClass( 'ec_selected' );
		jQuery( '.ec_option1.ec_details_option_row_error' ).hide( );
		jQuery( document.getElementById( 'ec_option1' ) ).val( optionitem_id_1 );
		ec_details_base_adjust_price( );
	}
} );
jQuery( '.ec_details_swatches > li.ec_option2' ).click( function( ){
	if( jQuery( this ).hasClass( 'ec_active' ) ){
		var optionitem_id_1 = 0;
		if( jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).length ){
			optionitem_id_1 = jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-id' );
		}else{
			optionitem_id_1 = jQuery( '.ec_details_combo.ec_option1' ).val( );
		}
		var optionitem_id_2 = jQuery( this ).attr( 'data-optionitem-id' );
		<?php if( $this->product->use_optionitem_quantity_tracking ){ ?>
		var quantity = jQuery( this ).attr( 'data-optionitem-quantity' );
		option2_selected( optionitem_id_1, optionitem_id_2, quantity );
		<?php }?>
		jQuery( '.ec_details_swatches > li.ec_option2' ).removeClass( 'ec_selected' );
		jQuery( this ).addClass( 'ec_selected' );
		jQuery( '.ec_option2.ec_details_option_row_error' ).hide( );
		jQuery( document.getElementById( 'ec_option2' ) ).val( optionitem_id_2 );
		ec_details_base_adjust_price( );
	}
} );
jQuery( '.ec_details_swatches > li.ec_option3' ).click( function( ){
	if( jQuery( this ).hasClass( 'ec_active' ) ){
		var optionitem_id_1 = 0;
		if( jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).length ){
			optionitem_id_1 = jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-id' );
		}else{
			optionitem_id_1 = jQuery( '.ec_details_combo.ec_option1' ).val( );
		}
		var optionitem_id_2 = 0;
		if( jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).length ){
			optionitem_id_2 = jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).attr( 'data-optionitem-id' );
		}else{
			optionitem_id_2 = jQuery( '.ec_details_combo.ec_option2' ).val( );
		}
		var optionitem_id_3 = jQuery( this ).attr( 'data-optionitem-id' );
		<?php if( $this->product->use_optionitem_quantity_tracking ){ ?>
		var quantity = jQuery( this ).attr( 'data-optionitem-quantity' );
		option3_selected( optionitem_id_1, optionitem_id_2, optionitem_id_3, quantity );
		<?php }?>
		jQuery( '.ec_details_swatches > li.ec_option3' ).removeClass( 'ec_selected' );
		jQuery( this ).addClass( 'ec_selected' );
		jQuery( '.ec_option3.ec_details_option_row_error' ).hide( );
		jQuery( document.getElementById( 'ec_option3' ) ).val( optionitem_id_3 );
		ec_details_base_adjust_price( );
	}
} );
jQuery( '.ec_details_swatches > li.ec_option4' ).click( function( ){
	if( jQuery( this ).hasClass( 'ec_active' ) ){
		var optionitem_id_1 = 0;
		if( jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).length ){
			optionitem_id_1 = jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-id' );
		}else{
			optionitem_id_1 = jQuery( '.ec_details_combo.ec_option1' ).val( );
		}
		var optionitem_id_2 = 0;
		if( jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).length ){
			optionitem_id_2 = jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).attr( 'data-optionitem-id' );
		}else{
			optionitem_id_2 = jQuery( '.ec_details_combo.ec_option2' ).val( );
		}
		var optionitem_id_3 = 0;
		if( jQuery( '.ec_details_swatches > li.ec_option3.ec_selected' ).length ){
			optionitem_id_3 = jQuery( '.ec_details_swatches > li.ec_option3.ec_selected' ).attr( 'data-optionitem-id' );
		}else{
			optionitem_id_3 = jQuery( '.ec_details_combo.ec_option3' ).val( );
		}
		var optionitem_id_4 = jQuery( this ).attr( 'data-optionitem-id' );
		<?php if( $this->product->use_optionitem_quantity_tracking ){ ?>
		var quantity = jQuery( this ).attr( 'data-optionitem-quantity' );
		option4_selected( optionitem_id_1, optionitem_id_2, optionitem_id_3, optionitem_id_4, quantity );
		<?php }?>
		jQuery( '.ec_details_swatches > li.ec_option4' ).removeClass( 'ec_selected' );
		jQuery( this ).addClass( 'ec_selected' );
		jQuery( '.ec_option4.ec_details_option_row_error' ).hide( );
		jQuery( document.getElementById( 'ec_option4' ) ).val( optionitem_id_4 );
		ec_details_base_adjust_price( );
	}
} );
jQuery( '.ec_details_swatches > li.ec_option5' ).click( function( ){
	if( jQuery( this ).hasClass( 'ec_active' ) ){
		var optionitem_id_5 = jQuery( this ).attr( 'data-optionitem-id' );
		jQuery( '.ec_details_swatches > li.ec_option5' ).removeClass( 'ec_selected' );
		jQuery( this ).addClass( 'ec_selected' );
		jQuery( '.ec_option5.ec_details_option_row_error' ).hide( );
		jQuery( document.getElementById( 'ec_option5' ) ).val( optionitem_id_5 );
		ec_details_base_adjust_price( );
	}
} );
jQuery( '.ec_details_combo.ec_option1' ).change( function( ){
	var optionitem_id_1 = jQuery( '.ec_details_combo.ec_option1' ).val( );
	var quantity = jQuery( '.ec_details_combo.ec_option1 option:selected' ).attr( 'data-optionitem-quantity' );
	<?php if( $this->product->use_optionitem_quantity_tracking ){ ?>
	if( optionitem_id_1 != '0' ){
		ec_option1_selected( optionitem_id_1, quantity );
	}else{
		jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( quantity );	
	}
	<?php }?>
	ec_option1_image_change( optionitem_id_1, quantity );
	jQuery( '.ec_option1.ec_details_option_row_error' ).hide( );
	ec_details_base_adjust_price( );
} );
jQuery( '.ec_details_combo.ec_option2' ).change( function( ){
	<?php if( $this->product->use_optionitem_quantity_tracking ){ ?>
	var optionitem_id_1 = 0;
	if( jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).length ){
		optionitem_id_1 = jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-id' );
	}else{
		optionitem_id_1 = jQuery( '.ec_details_combo.ec_option1' ).val( );
	}
	var optionitem_id_2 = jQuery( '.ec_details_combo.ec_option2' ).val( );
	var quantity = jQuery( '.ec_details_combo.ec_option2 option:selected' ).attr( 'data-optionitem-quantity' );
	if( optionitem_id_2 != '0' ){
		option2_selected( optionitem_id_1, optionitem_id_2, quantity );
	}else{
		jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( quantity );	
	}
	<?php }?>
	jQuery( '.ec_option2.ec_details_option_row_error' ).hide( );
	ec_details_base_adjust_price( );
} );
jQuery( '.ec_details_combo.ec_option3' ).change( function( ){
	<?php if( $this->product->use_optionitem_quantity_tracking ){ ?>
	var optionitem_id_1 = 0;
	if( jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).length ){
		optionitem_id_1 = jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-id' );
	}else{
		optionitem_id_1 = jQuery( '.ec_details_combo.ec_option1' ).val( );
	}
	var optionitem_id_2 = 0;
	if( jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).length ){
		optionitem_id_2 = jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).attr( 'data-optionitem-id' );
	}else{
		optionitem_id_2 = jQuery( '.ec_details_combo.ec_option2' ).val( );
	}
	var optionitem_id_3 = jQuery( '.ec_details_combo.ec_option3' ).val( );
	var quantity = jQuery( '.ec_details_combo.ec_option3 option:selected' ).attr( 'data-optionitem-quantity' );
	
	if( optionitem_id_3 != '0' ){
		option3_selected( optionitem_id_1, optionitem_id_2, optionitem_id_3, quantity );
	}else{
		jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( quantity );	
	}
	<?php }?>
	jQuery( '.ec_option3.ec_details_option_row_error' ).hide( );
	ec_details_base_adjust_price( );
} );
jQuery( '.ec_details_combo.ec_option4' ).change( function( ){
	<?php if( $this->product->use_optionitem_quantity_tracking ){ ?>
	var optionitem_id_1 = 0;
	if( jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).length ){
		optionitem_id_1 = jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-id' );
	}else{
		optionitem_id_1 = jQuery( '.ec_details_combo.ec_option1' ).val( );
	}
	var optionitem_id_2 = 0;
	if( jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).length ){
		optionitem_id_2 = jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).attr( 'data-optionitem-id' );
	}else{
		optionitem_id_2 = jQuery( '.ec_details_combo.ec_option2' ).val( );
	}
	var optionitem_id_3 = 0;
	if( jQuery( '.ec_details_swatches > li.ec_option3.ec_selected' ).length ){
		optionitem_id_3 = jQuery( '.ec_details_swatches > li.ec_option3.ec_selected' ).attr( 'data-optionitem-id' );
	}else{
		optionitem_id_3 = jQuery( '.ec_details_combo.ec_option3' ).val( );
	}
	var optionitem_id_4 = jQuery( '.ec_details_combo.ec_option4' ).val( );
	var quantity = jQuery( '.ec_details_combo.ec_option4 option:selected' ).attr( 'data-optionitem-quantity' );
	
	if( optionitem_id_4 != '0' ){
		option4_selected( optionitem_id_1, optionitem_id_2, optionitem_id_3, optionitem_id_4, quantity );
	}else{
		jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( quantity );	
	}
	<?php }?>
	jQuery( '.ec_option4.ec_details_option_row_error' ).hide( );
	ec_details_base_adjust_price( );
} );
jQuery( '.ec_details_combo.ec_option5' ).change( function( ){
	<?php if( $this->product->use_optionitem_quantity_tracking ){ ?>
	var quantity = jQuery( '.ec_details_combo.ec_option5 option:selected' ).attr( 'data-optionitem-quantity' );
	jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( quantity );
	<?php }?>
	jQuery( '.ec_option5.ec_details_option_row_error' ).hide( );
	ec_details_base_adjust_price( );
} );
jQuery( '.ec_details_checkbox_row > input, .ec_details_radio_row > input' ).click( function( ){
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_option_row.ec_option_type_combo > .ec_details_option_data > select' ).change( function( ){
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_option_row.ec_option_type_date > .ec_details_option_data > input' ).change( function( ){
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_option_row.ec_option_type_file > .ec_details_option_data > input' ).change( function( ){
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_option_row.ec_option_type_text > .ec_details_option_data > input' ).change( function( ){
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_option_row.ec_option_type_textarea > .ec_details_option_data > textarea' ).change( function( ){
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_grid_row > input' ).change( function( ){
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_swatches > li.ec_advanced' ).click( function( ){
	var optionitem_id = jQuery( this ).attr( 'data-optionitem-id' );
	var option_id = jQuery( this ).attr( 'data-option-id' );
	jQuery( document.getElementById( 'ec_option_' + option_id ) ).val( optionitem_id );
	jQuery( '.ec_details_swatches > li.ec_option_' + option_id ).removeClass( 'ec_selected' );
	jQuery( this ).addClass( 'ec_selected' );
	jQuery( document.getElementById( 'ec_details_option_row_error_' + option_id ) ).hide( );
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_option_row.ec_option_type_dimensions1 > .ec_details_option_data > input' ).change( function( ){
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_option_row.ec_option_type_dimensions2 > .ec_details_option_data > input' ).change( function( ){
	ec_details_advanced_adjust_price( );
} );
jQuery( '.ec_details_option_row.ec_option_type_dimensions2 > .ec_details_option_data > select' ).change( function( ){
	ec_details_advanced_adjust_price( );
} );
function ec_details_base_adjust_price( ){
	if( jQuery( document.getElementById( 'ec_base_price' ) ).length == 0 )
		return;
	var base_price = Number( jQuery( document.getElementById( 'ec_base_price' ) ).html( ) );
	var option1_price_adj = 0;
	var option2_price_adj = 0;
	var option3_price_adj = 0;
	var option4_price_adj = 0;
	var option5_price_adj = 0;
	var option1_price_add = 0;
	var option2_price_add = 0;
	var option3_price_add = 0;
	var option4_price_add = 0;
	var option5_price_add = 0;
	var option1_price_override = -1;
	var option2_price_override = -1;
	var option3_price_override = -1;
	var option4_price_override = -1;
	var option5_price_override = -1;
	// Option 1 Price Adjustment
	if( jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).length ){
		option1_price_adj = jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-price' );
		option1_price_add = jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-price-onetime' );
		option1_price_override = Number( jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-price-override' ) );
		option1_price_multiplier = Number( jQuery( '.ec_details_swatches > li.ec_option1.ec_selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}else if( jQuery( '.ec_details_combo.ec_option1' ).length ){
		option1_price_adj = jQuery( '.ec_details_combo.ec_option1 option:selected' ).attr( 'data-optionitem-price' );
		option1_price_add = jQuery( '.ec_details_combo.ec_option1 option:selected' ).attr( 'data-optionitem-price-onetime' );
		option1_price_override = Number( jQuery( '.ec_details_combo.ec_option1 option:selected' ).attr( 'data-optionitem-price-override' ) );
		option1_price_multiplier = Number( jQuery( '.ec_details_combo.ec_option1 option:selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}
	// Option 2 Price Adjustment
	if( jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).length ){
		option2_price_adj = jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).attr( 'data-optionitem-price' );
		option2_price_add = jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).attr( 'data-optionitem-price-onetime' );
		option2_price_override = Number( jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).attr( 'data-optionitem-price-override' ) );
		option2_price_multiplier = Number( jQuery( '.ec_details_swatches > li.ec_option2.ec_selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}else if( jQuery( '.ec_details_combo.ec_option2' ).length ){
		option2_price_adj = jQuery( '.ec_details_combo.ec_option2 option:selected' ).attr( 'data-optionitem-price' );
		option2_price_add = jQuery( '.ec_details_combo.ec_option2 option:selected' ).attr( 'data-optionitem-price-onetime' );
		option2_price_override = Number( jQuery( '.ec_details_combo.ec_option2 option:selected' ).attr( 'data-optionitem-price-override' ) );
		option2_price_multiplier = Number( jQuery( '.ec_details_combo.ec_option2 option:selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}
	// Option 3 Price Adjustment
	if( jQuery( '.ec_details_swatches > li.ec_option3.ec_selected' ).length ){
		option3_price_adj = jQuery( '.ec_details_swatches > li.ec_option3.ec_selected' ).attr( 'data-optionitem-price' );
		option3_price_add = jQuery( '.ec_details_swatches > li.ec_option3.ec_selected' ).attr( 'data-optionitem-price-onetime' );
		option3_price_override = Number( jQuery( '.ec_details_swatches > li.ec_option3.ec_selected' ).attr( 'data-optionitem-price-override' ) );
		option3_price_multiplier = Number( jQuery( '.ec_details_swatches > li.ec_option3.ec_selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}else if( jQuery( '.ec_details_combo.ec_option3' ).length ){
		option3_price_adj = jQuery( '.ec_details_combo.ec_option3 option:selected' ).attr( 'data-optionitem-price' );
		option3_price_add = jQuery( '.ec_details_combo.ec_option3 option:selected' ).attr( 'data-optionitem-price-onetime' );
		option3_price_override = Number( jQuery( '.ec_details_combo.ec_option3 option:selected' ).attr( 'data-optionitem-price-override' ) );
		option3_price_multiplier = Number( jQuery( '.ec_details_combo.ec_option3 option:selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}
	// Option 4 Price Adjustment
	if( jQuery( '.ec_details_swatches > li.ec_option4.ec_selected' ).length ){
		option4_price_adj = jQuery( '.ec_details_swatches > li.ec_option4.ec_selected' ).attr( 'data-optionitem-price' );
		option4_price_add = jQuery( '.ec_details_swatches > li.ec_option4.ec_selected' ).attr( 'data-optionitem-price-onetime' );
		option4_price_override = Number( jQuery( '.ec_details_swatches > li.ec_option4.ec_selected' ).attr( 'data-optionitem-price-override' ) );
		option4_price_multiplier = Number( jQuery( '.ec_details_swatches > li.ec_option4.ec_selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}else if( jQuery( '.ec_details_combo.ec_option4' ).length ){
		option4_price_adj = jQuery( '.ec_details_combo.ec_option4 option:selected' ).attr( 'data-optionitem-price' );
		option4_price_add = jQuery( '.ec_details_combo.ec_option4 option:selected' ).attr( 'data-optionitem-price-onetime' );
		option4_price_override = Number( jQuery( '.ec_details_combo.ec_option4 option:selected' ).attr( 'data-optionitem-price-override' ) );
		option4_price_multiplier = Number( jQuery( '.ec_details_combo.ec_option4 option:selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}
	// Option 5 Price Adjustment
	if( jQuery( '.ec_details_swatches > li.ec_option5.ec_selected' ).length ){
		option5_price_adj = jQuery( '.ec_details_swatches > li.ec_option5.ec_selected' ).attr( 'data-optionitem-price' );
		option5_price_add = jQuery( '.ec_details_swatches > li.ec_option5.ec_selected' ).attr( 'data-optionitem-price-onetime' );
		option5_price_override = Number( jQuery( '.ec_details_swatches > li.ec_option5.ec_selected' ).attr( 'data-optionitem-price-override' ) );
		option5_price_multiplier = Number( jQuery( '.ec_details_swatches > li.ec_option5.ec_selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}else if( jQuery( '.ec_details_combo.ec_option5' ).length ){
		option5_price_adj = jQuery( '.ec_details_combo.ec_option5 option:selected' ).attr( 'data-optionitem-price' );
		option5_price_add = jQuery( '.ec_details_combo.ec_option5 option:selected' ).attr( 'data-optionitem-price-onetime' );
		option5_price_override = Number( jQuery( '.ec_details_combo.ec_option5 option:selected' ).attr( 'data-optionitem-price-override' ) );
		option5_price_multiplier = Number( jQuery( '.ec_details_combo.ec_option5 option:selected' ).attr( 'data-optionitem-price-multiplier' ) );
	}
	var num_decimals = <?php echo $GLOBALS['currency']->decimal_length; ?>;
	var decimal_symbol = '<?php echo $GLOBALS['currency']->decimal_symbol; ?>';
	var grouping_symbol = '<?php echo $GLOBALS['currency']->grouping_symbol; ?>';
	var new_price = ec_details_format_money( base_price + Number( option1_price_adj ) + Number( option2_price_adj ) + Number( option3_price_adj ) + Number( option4_price_adj ) + Number( option5_price_adj ) );
	var order_price = Number( option1_price_add ) + Number( option2_price_add ) + Number( option3_price_add ) + Number( option4_price_add ) + Number( option5_price_add );
	var override_price = -1;
	if( option1_price_override > -1 )
		override_price = option1_price_override;
	else if( option2_price_override > -1 )
		override_price = option2_price_override;
	else if( option3_price_override > -1 )
		override_price = option3_price_override;
	else if( option4_price_override > -1 )
		override_price = option4_price_override;
	else if( option5_price_override > -1 )
		override_price = option5_price_override; 
	if( override_price > -1 ){
		jQuery( document.getElementById( 'ec_final_price' ) ).html( ec_details_format_money( override_price ) );
	}else{
		jQuery( document.getElementById( 'ec_final_price' ) ).html( new_price );
	}
	if( order_price != 0 ){
		jQuery( '.ec_details_added_price' ).show( );
		jQuery( document.getElementById( 'ec_added_price' ) ).html( ec_details_format_money( order_price ) );
	}else{
		jQuery( '.ec_details_added_price' ).hide( );
	}
}
function ec_details_advanced_adjust_price( ){	
	if( jQuery( document.getElementById( 'ec_base_price' ) ).length == 0 )
		return;
	var base_price = Number( jQuery( document.getElementById( 'ec_base_price' ) ).html( ) );
	// Get a quantity in case we need to use in calculating price
	var current_quantity = 1;
	if( jQuery( document.getElementById( 'ec_quantity' ) ).length > 0 ){
		current_quantity = jQuery( document.getElementById( 'ec_quantity' ) ).val( );
	}
	
	if( jQuery( '.ec_details_grid_row > input' ).length > 0 ){
		current_quantity = 0;
		jQuery( '.ec_details_grid_row > input' ).each( function( ){
			current_quantity = current_quantity + Number( jQuery( this ).val( ) );
		} );
	}
	for( var i=0; i<tier_quantities.length; i++ ){
		if( tier_quantities[i] <= current_quantity )
			base_price = Number( tier_prices[i] );
	}
	var override_price = -1;
	var price_multiplier = 0;
	// Checkbox Price Adjustments
	var checkbox_adj = 0;
	var checkbox_add = 0;
	// Combox Price Adjustments
	var combo_adj = 0;
	var combo_add = 0;
	// Date Price Adjustments
	var date_adj = 0;
	var date_add = 0;
	// File Price Adjustments
	var file_adj = 0;
	var file_add = 0;
	// Swatch Price Adjustments
	var swatch_adj = 0;
	var swatch_add = 0;
	// Grid Price Adjustments
	var grid_adj = 0;
	var grid_add = 0;
	// Radio Price Adjustments
	var radio_adj = 0;
	var radio_add = 0;
	// Text Price Adjustments
	var text_adj = 0;
	var text_add = 0;
	// Textarea Price Adjustments
	var textarea_adj = 0;
	var textarea_add = 0;
	// Dimensions Price Adjustments
	var has_sq_footage = false;
	var sq_footage = 1;
	jQuery( '.ec_details_checkbox_row > input:checked' ).each( function( ){
		if( jQuery( this ).attr( 'data-optionitem-price' ) != 0 ){
			checkbox_adj += Number( jQuery( this ).attr( 'data-optionitem-price' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-onetime' ) != 0 ){
			checkbox_add += Number( jQuery( this ).attr( 'data-optionitem-price-onetime' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-override' ) >= 0 ){
			override_price = Number( jQuery( this ).attr( 'data-optionitem-price-override' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) > 0 ){
			price_multiplier = Number( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) );
		}
	} );
	jQuery( '.ec_details_option_row.ec_option_type_combo > .ec_details_option_data > select option:selected' ).each( function( ){
		if( jQuery( this ).attr( 'data-optionitem-price' ) != 0 ){
			combo_adj += Number( jQuery( this ).attr( 'data-optionitem-price' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-onetime' ) != 0 ){
			combo_add += Number( jQuery( this ).attr( 'data-optionitem-price-onetime' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-override' ) >= 0 ){
			override_price = Number( jQuery( this ).attr( 'data-optionitem-price-override' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) > 0 ){
			price_multiplier = Number( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) );
		}
	} );
	jQuery( '.ec_details_option_row.ec_option_type_date > .ec_details_option_data > input' ).each( function( ){
		if( jQuery( this ).val( ) != "" ){
			if( jQuery( this ).attr( 'data-optionitem-price' ) != 0 ){
				date_adj += Number( jQuery( this ).attr( 'data-optionitem-price' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-onetime' ) != 0 ){
				date_add += Number( jQuery( this ).attr( 'data-optionitem-price-onetime' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-override' ) >= 0 ){
				override_price = Number( jQuery( this ).attr( 'data-optionitem-price-override' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) > 0 ){
				price_multiplier = Number( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) );
			}
		}
	} );
	jQuery( '.ec_details_option_row.ec_option_type_file > .ec_details_option_data > input' ).each( function( ){
		if( jQuery( this ).val( ) != "" ){
			if( jQuery( this ).attr( 'data-optionitem-price' ) != 0 ){
				file_adj += Number( jQuery( this ).attr( 'data-optionitem-price' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-onetime' ) != 0 ){
				file_add += Number( jQuery( this ).attr( 'data-optionitem-price-onetime' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-override' ) >= 0 ){
				override_price = Number( jQuery( this ).attr( 'data-optionitem-price-override' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) > 0 ){
				price_multiplier = Number( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) );
			}
		}
	} );
	jQuery( '.ec_details_swatch.ec_advanced.ec_selected' ).each( function( ){
		if( jQuery( this ).attr( 'data-optionitem-price' ) != 0 ){
			swatch_adj += Number( jQuery( this ).attr( 'data-optionitem-price' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-onetime' ) != 0 ){
			swatch_add += Number( jQuery( this ).attr( 'data-optionitem-price-onetime' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-override' ) >= 0 ){
			override_price = Number( jQuery( this ).attr( 'data-optionitem-price-override' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) > 0 ){
			price_multiplier = Number( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) );
		}
	} );
	jQuery( '.ec_details_radio_row > input:checked' ).each( function( ){
		if( jQuery( this ).attr( 'data-optionitem-price' ) != 0 ){
			radio_adj += Number( jQuery( this ).attr( 'data-optionitem-price' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-onetime' ) != 0 ){
			radio_add += Number( jQuery( this ).attr( 'data-optionitem-price-onetime' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-override' ) >= 0 ){
			override_price = Number( jQuery( this ).attr( 'data-optionitem-price-override' ) );
		}
		if( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) > 0 ){
			price_multiplier = Number( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) );
		}
	} );
	jQuery( '.ec_details_option_row.ec_option_type_text > .ec_details_option_data > input' ).each( function( ){
		if( jQuery( this ).val( ) != "" ){
			if( jQuery( this ).attr( 'data-optionitem-price' ) != 0 ){
				text_adj += Number( jQuery( this ).attr( 'data-optionitem-price' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-onetime' ) != 0 ){
				text_add += Number( jQuery( this ).attr( 'data-optionitem-price-onetime' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-override' ) >= 0 ){
				override_price = Number( jQuery( this ).attr( 'data-optionitem-price-override' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) > 0 ){
				price_multiplier = Number( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-per-character' ) > 0 ){
				var num_characters = Number(  jQuery( this ).val( ).replace( / /g, '' ).length );
				var price_per_char = Number( jQuery( this ).attr( 'data-optionitem-price-per-character' ) );
				text_adj = text_adj + ( num_characters * price_per_char );
			}
		}
	} );
	jQuery( '.ec_details_option_row.ec_option_type_textarea > .ec_details_option_data > textarea' ).each( function( ){
		if( jQuery( this ).val( ) != "" ){
			if( jQuery( this ).attr( 'data-optionitem-price' ) != 0 ){
				textarea_adj += Number( jQuery( this ).attr( 'data-optionitem-price' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-onetime' ) != 0 ){
				textarea_add += Number( jQuery( this ).attr( 'data-optionitem-price-onetime' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-override' ) >= 0 ){
				override_price = Number( jQuery( this ).attr( 'data-optionitem-price-override' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) > 0 ){
				price_multiplier = Number( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-per-character' ) > 0 ){
				var num_characters = Number(  jQuery( this ).val( ).replace( / /g, '' ).length );
				var price_per_char = Number( jQuery( this ).attr( 'data-optionitem-price-per-character' ) );
				textarea_adj = textarea_adj + ( num_characters * price_per_char );
			}
		}
	} );
	jQuery( '.ec_details_grid_row > input' ).each( function( ){
		if( jQuery( this ).val( ) > 0 ){
			if( jQuery( this ).attr( 'data-optionitem-price' ) != 0 ){
				grid_adj += ( Number( jQuery( this ).attr( 'data-optionitem-price' ) ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-onetime' ) != 0 ){
				grid_add += Number( jQuery( this ).attr( 'data-optionitem-price-onetime' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-override' ) >= 0 ){
				override_price = Number( jQuery( this ).attr( 'data-optionitem-price-override' ) );
			}
			if( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) > 0 ){
				price_multiplier = Number( jQuery( this ).attr( 'data-optionitem-price-multiplier' ) );
			}
		}
	} );
	jQuery( '.ec_dimensions_width' ).each( function( ){
		has_sq_footage = true;
		var option_id = jQuery( this ).attr( 'data-option-id' );
		var width = jQuery( document.getElementById( 'ec_option_' + option_id + '_width' ) ).val( );
		var sub_width = 0;
		if( jQuery( document.getElementById( 'ec_option_' + option_id + '_sub_width' ) ).length )
			var sub_width = jQuery( document.getElementById( 'ec_option_' + option_id + '_sub_width' ) ).val( );
		var height = jQuery( document.getElementById( 'ec_option_' + option_id + '_height' ) ).val( );
		var sub_height = 0;
		if( jQuery( document.getElementById( 'ec_option_' + option_id + '_sub_height' ) ).length )
			var sub_height = jQuery( document.getElementById( 'ec_option_' + option_id + '_sub_height' ) ).val( );
		if( width != "" && height != "" )
			sq_footage = ec_details_get_sq_footage( width, sub_width, height, sub_height ) * Number( jQuery( document.getElementById( 'ec_quantity' ) ).val( ) );	
	} );
	var new_price = ec_details_format_money( ( base_price + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) * sq_footage );
	var order_price = Number( checkbox_add ) + Number( combo_add ) + Number( date_add ) + Number( file_add ) + Number( swatch_add ) + Number( grid_add ) + Number( radio_add ) + Number( text_add ) + Number( textarea_add );
	if( override_price > -1 ){
		jQuery( document.getElementById( 'ec_final_price' ) ).html( ec_details_format_money( override_price + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) );
		jQuery( '.ec_details_price > .ec_product_sale_price' ).each( function( ){ jQuery( this ).html( ec_details_format_money( override_price + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) ); } );
		if( !has_sq_footage )
			jQuery( '.ec_details_price > .ec_product_price' ).each( function( ){ jQuery( this ).html( ec_details_format_money( override_price + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) ); } );
	}else{
		jQuery( document.getElementById( 'ec_final_price' ) ).html( new_price );
		jQuery( '.ec_details_price > .ec_product_sale_price' ).each( function( ){ jQuery( this ).html( new_price ); } );
		if( !has_sq_footage )
			jQuery( '.ec_details_price > .ec_product_price' ).each( function( ){ jQuery( this ).html( new_price ); } );
	}
	if( price_multiplier > 1 && override_price > -1 ){
		jQuery( document.getElementById( 'ec_final_price' ) ).html( ec_details_format_money( ( Number( override_price ) + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) * Number( price_multiplier ) ) );
		jQuery( '.ec_details_price > .ec_product_sale_price' ).each( function( ){ jQuery( this ).html( ( ec_details_format_money( ( Number( override_price ) + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) * Number( price_multiplier ) ) ) ); } );
		jQuery( '.ec_details_price > .ec_product_price' ).each( function( ){ jQuery( this ).html( ( ec_details_format_money( ( Number( override_price ) + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) * Number( price_multiplier ) ) ) ); } );
	}else if( price_multiplier > 1 ){
		jQuery( document.getElementById( 'ec_final_price' ) ).html( ec_details_format_money( ( Number( base_price ) + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) * Number( price_multiplier ) ) );
		jQuery( '.ec_details_price > .ec_product_sale_price' ).each( function( ){ jQuery( this ).html( ( ec_details_format_money( ( Number( base_price ) + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) * Number( price_multiplier ) ) ) ); } );
		jQuery( '.ec_details_price > .ec_product_price' ).each( function( ){ jQuery( this ).html( ( ec_details_format_money( ( Number( base_price ) + Number( checkbox_adj ) + Number( combo_adj ) + Number( date_adj ) + Number( file_adj ) + Number( swatch_adj ) + Number( grid_adj ) + Number( radio_adj ) + Number( text_adj ) + Number( textarea_adj ) ) * Number( price_multiplier ) ) ) ); } );
	}
	if( order_price != 0 ){
		jQuery( '.ec_details_added_price' ).show( );
		jQuery( document.getElementById( 'ec_added_price' ) ).html( ec_details_format_money( order_price ) );
	}else{
		jQuery( '.ec_details_added_price' ).hide( );
	}
}
function ec_details_get_sq_footage( width, sub_width, height, sub_height ){
	var sub_width_decimal = ec_details_get_sub_dimension_decimal( sub_width );
	width = Number( Number( width ) + sub_width_decimal ) / <?php if( !get_option( 'ec_option_enable_metric_unit_display' ) ){ echo "12"; }else{ echo "1000"; } ?>;
	var sub_height_decimal = ec_details_get_sub_dimension_decimal( sub_height );
	height = Number( Number( height ) + sub_height_decimal ) / <?php if( !get_option( 'ec_option_enable_metric_unit_display' ) ){ echo "12"; }else{ echo "1000"; } ?>;
	return width*height;
}
function ec_details_get_sub_dimension_decimal( sub_dimension ){
	if( sub_dimension == "0" ){
		return 0;
	}else if( sub_dimension == "1/16" ){
		return .0625;
	}else if( sub_dimension == "1/8" ){
		return .1250;
	}else if( sub_dimension == "3/16" ){
		return .1875;
	}else if( sub_dimension == "1/4" ){
		return .2500;
	}else if( sub_dimension == "5/16" ){
		return .3125;
	}else if( sub_dimension == "3/8" ){
		return .3750;
	}else if( sub_dimension == "7/16" ){
		return .4375;
	}else if( sub_dimension == "1/2" ){
		return .5000;
	}else if( sub_dimension == "9/16" ){
		return .5625;
	}else if( sub_dimension == "5/8" ){
		return .6250;
	}else if( sub_dimension == "11/16" ){
		return .6875;
	}else if( sub_dimension == "3/4" ){
		return .7500;
	}else if( sub_dimension == "13/16" ){
		return .8125;
	}else if( sub_dimension == "7/8" ){
		return .8750;
	}else if( sub_dimension == "15/16" ){
		return .9375;
	}else{
		return 0;
	}
}
function ec_details_format_money( price, num_decimals, grouping_symbol, decimal_symbol ){
	var currency_symbol = '<?php echo $GLOBALS['currency']->symbol; ?>';
	var num_decimals = <?php echo $GLOBALS['currency']->decimal_length; ?>;
	var decimal_symbol = '<?php echo $GLOBALS['currency']->decimal_symbol; ?>';
	var grouping_symbol = '<?php echo $GLOBALS['currency']->grouping_symbol; ?>';
	var conversion_rate = '<?php echo $GLOBALS['currency']->conversion_rate; ?>';
	var symbol_location = <?php echo $GLOBALS['currency']->symbol_location; ?>;
	price = price * Number( conversion_rate );
    var n = price,
        num_decimals = isNaN(num_decimals = Math.abs(num_decimals)) ? 2 : num_decimals,
        decimal_symbol = decimal_symbol == undefined ? "." : decimal_symbol,
        grouping_symbol = grouping_symbol == undefined ? "," : grouping_symbol,
        i = parseInt(n = n.toFixed(num_decimals)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    var formatted = (j ? i.substr(0, j) + grouping_symbol : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + grouping_symbol) + (num_decimals ? decimal_symbol + Math.abs(n - i).toFixed(num_decimals).slice(2) : "");
	if( symbol_location ){
		formatted = currency_symbol + formatted;
	}else{
		formatted = formatted + currency_symbol;
	}
	return formatted;
};
function ec_details_submit_inquiry( ){
	var errors = 0;
	if( document.getElementById( 'ec_inquiry_name' ) ){
		if( jQuery( document.getElementById( 'ec_inquiry_name' ) ).val( ) == "" || jQuery( document.getElementById( 'ec_inquiry_email' ) ).val( ) == "" || jQuery( document.getElementById( 'ec_inquiry_message' ) ).val( ) == "" ){
			jQuery( document.getElementById( 'ec_details_inquiry_error' ) ).show( );
			errors++;
		}else{
			jQuery( document.getElementById( 'ec_details_inquiry_error' ) ).hide( );
		}
	}
	if( errors > 0 )
		return false;
	else{
		jQuery( document.getElementById( 'ec_inquiry_loader' ) ).show( );
		jQuery( document.getElementById( 'ec_inquiry_loader_bg' ) ).show( );
		return true;
	}
}
function ec_details_add_to_cart( ){
	var errors = 0; 
	// Basic Option 1 Error Check
	if( jQuery( '.ec_details_swatch.ec_option1' ).length && !jQuery( '.ec_option1.ec_selected' ).attr( 'data-optionitem-id' ) ){ 
		jQuery( '.ec_option1.ec_details_option_row_error' ).show( ); 
		errors++; 
	}else if( jQuery( '.ec_details_combo.ec_option1' ).length && jQuery( '.ec_details_combo.ec_option1' ).val( ) == '0' ){ 
		jQuery( '.ec_option1.ec_details_option_row_error' ).show( ); 
		errors++; 
	}else{ 
		jQuery( '.ec_option1.ec_details_option_row_error' ).hide( );
	}
	// Basic Option 2 Error Check
	if( jQuery( '.ec_details_swatch.ec_option2' ).length && !jQuery( '.ec_option2.ec_selected' ).attr( 'data-optionitem-id' ) ){ 
		jQuery( '.ec_option2.ec_details_option_row_error' ).show( ); 
		errors++; 
	}else if( jQuery( '.ec_details_combo.ec_option2' ).length && jQuery( '.ec_details_combo.ec_option2' ).val( ) == '0' ){ 
		jQuery( '.ec_option2.ec_details_option_row_error' ).show( ); 
		errors++; 
	}else{ 
		jQuery( '.ec_option2.ec_details_option_row_error' ).hide( ); 
	}
	// Basic Option 3 Error Check
	if( jQuery( '.ec_details_swatch.ec_option3' ).length && !jQuery( '.ec_option3.ec_selected' ).attr( 'data-optionitem-id' ) ){ 
		jQuery( '.ec_option3.ec_details_option_row_error' ).show( );
		errors++; 
	}else if( jQuery( '.ec_details_combo.ec_option3' ).length && jQuery( '.ec_details_combo.ec_option3' ).val( ) == '0' ){ 
		jQuery( '.ec_option3.ec_details_option_row_error' ).show( ); 
		errors++; 
	}else{ 
		jQuery( '.ec_option3.ec_details_option_row_error' ).hide( ); 
	}
	// Basic Option 4 Error Check
	if( jQuery( '.ec_details_swatch.ec_option4' ).length && !jQuery( '.ec_option4.ec_selected' ).attr( 'data-optionitem-id' ) ){ 
		jQuery( '.ec_option4.ec_details_option_row_error' ).show( ); 
		errors++; 
	}else if( jQuery( '.ec_details_combo.ec_option4' ).length && jQuery( '.ec_details_combo.ec_option4' ).val( ) == '0' ){ 
		jQuery( '.ec_option4.ec_details_option_row_error' ).show( ); 
		errors++; 
	}else{ 
		jQuery( '.ec_option4.ec_details_option_row_error' ).hide( ); 
	}
	// Basic Option 5 Error Check
	if( jQuery( '.ec_details_swatch.ec_option5' ).length && !jQuery( '.ec_option5.ec_selected' ).attr( 'data-optionitem-id' ) ){ 
		jQuery( '.ec_option5.ec_details_option_row_error' ).show( ); 
		errors++; 
	}else if( jQuery( '.ec_details_combo.ec_option5' ).length && jQuery( '.ec_details_combo.ec_option5' ).val( ) == '0' ){ 
		jQuery( '.ec_option5.ec_details_option_row_error' ).show( ); 
		errors++; 
	}else{ 
		jQuery( '.ec_option5.ec_details_option_row_error' ).hide( ); 
	}
	// --------Advanced Option Checks---------- //
	// Select Box Check
	var advanced_select_rows = jQuery( '.ec_details_option_row.ec_option_type_combo' );
	advanced_select_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required
			if( jQuery( document.getElementById( 'ec_option_' + jQuery( this ).attr( 'data-option-id' ) ) ).val( ) == '0' ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}
		}
	} );
	// Check Box Check
	var advanced_checkbox_rows = jQuery( '.ec_details_option_row.ec_option_type_checkbox' );
	advanced_checkbox_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required
			var selected_checkboxes = jQuery( "input.ec_option_" + jQuery( this ).attr( 'data-option-id' ) + ":checked" );
			if( selected_checkboxes.length ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}
		}
	} );
	// Date Box Check
	var advanced_date_rows = jQuery( '.ec_details_option_row.ec_option_type_date' );
	advanced_date_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required
			if( jQuery( document.getElementById( 'ec_option_' + jQuery( this ).attr( 'data-option-id' ) ) ).val( ) == "" ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}
		}
	} );
	// File Upload Check
	var advanced_file_rows = jQuery( '.ec_details_option_row.ec_option_type_file' );
	advanced_file_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required	
			if( jQuery( document.getElementById( 'ec_option_' + jQuery( this ).attr( 'data-option-id' ) ) ).val( ) ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}
		}
	} );
	// Swatch Check
	var advanced_swatch_rows = jQuery( '.ec_details_option_row.ec_option_type_swatch' );
	advanced_swatch_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required
			var advanced_selected_swatches = jQuery( ".ec_details_swatch.ec_option_" + jQuery( this ).attr( 'data-option-id' ) + ".ec_selected" );
			if( advanced_selected_swatches.length ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}
		}
	} );
	// Radio Button Check
	var advanced_radio_rows = jQuery( '.ec_details_option_row.ec_option_type_radio' );
	advanced_radio_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required
			var selected_radios = jQuery( "input[name='ec_option_" + jQuery( this ).attr( 'data-option-id' ) + "']:checked" );
			if( selected_radios.length ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}
		}
	} );
	// Text Box Check
	var advanced_text_rows = jQuery( '.ec_details_option_row.ec_option_type_text' );
	advanced_text_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required	
			if( jQuery( document.getElementById( 'ec_option_' + jQuery( this ).attr( 'data-option-id' ) ) ).val( ) != "" ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}
		}
	} );
	// Text Area Check
	var advanced_textarea_rows = jQuery( '.ec_details_option_row.ec_option_type_textarea' );
	advanced_textarea_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required	
			if( jQuery( document.getElementById( 'ec_option_' + jQuery( this ).attr( 'data-option-id' ) ) ).val( ) != "" ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}
		}
	} );
	// Quantity Grid Check
	var advanced_grid_rows = jQuery( '.ec_details_option_row.ec_option_type_grid' );
	advanced_grid_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required
			var grid_items = jQuery( ".ec_details_grid_row > input" );
			var total_grid_quantity = 0;
			grid_items.each( 
				function( ){ 
					total_grid_quantity += jQuery( this ).val( ); 
				} 
			);
			if( total_grid_quantity > 0 ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}
		}
	} );
	// Dimensions Type 1 Check
	var advanced_dimensions_rows = jQuery( '.ec_details_option_row.ec_option_type_dimensions1' );
	advanced_dimensions_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required	
			// Test Width + Height
			if( jQuery( document.getElementById( 'ec_option_' + jQuery( this ).attr( 'data-option-id' ) + '_width' ) ).val( ) != "" && jQuery( document.getElementById( 'ec_option_' + jQuery( this ).attr( 'data-option-id' ) + '_height' ) ).val( ) != "" ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}
			
		}
	} );
	// Dimensions Type 2 Check
	var advanced_dimensions_rows = jQuery( '.ec_details_option_row.ec_option_type_dimensions2' );
	advanced_dimensions_rows.each( function( ){
		if( jQuery( this ).attr( 'data-option-required' ) == '1' ){ // Option is Required	
			// Test Width + Height
			if( jQuery( document.getElementById( 'ec_option_' + jQuery( this ).attr( 'data-option-id' ) + '_width' ) ).val( ) != "" && jQuery( document.getElementById( 'ec_option_' + jQuery( this ).attr( 'data-option-id' ) + '_height' ) ).val( ) != "" ){
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).hide( );
			}else{
				jQuery( document.getElementById( 'ec_details_option_row_error_' + jQuery( this ).attr( 'data-option-id' ) ) ).show( );
				errors++;
			}
			
		}
	} );
	// -------END Advanced Option Checks------- //
	// -------START GIFT CARD CHECK ----------- //
	var gift_card_errors = 0;
	if( document.getElementById( 'ec_giftcard_to_name' ) && jQuery( document.getElementById( 'ec_giftcard_to_name' ) ).val( ) == "" ){
		errors++;
		gift_card_errors++;
	}
	if( document.getElementById( 'ec_giftcard_to_email' ) && jQuery( document.getElementById( 'ec_giftcard_to_email' ) ).val( ) == "" ){
		errors++;
		gift_card_errors++;
	}
	if( document.getElementById( 'ec_giftcard_from_name' ) && jQuery( document.getElementById( 'ec_giftcard_from_name' ) ).val( ) == "" ){
		errors++;
		gift_card_errors++;
	}
	if( document.getElementById( 'ec_giftcard_message' ) && jQuery( document.getElementById( 'ec_giftcard_message' ) ).val( ) == "" ){
		errors++;
		gift_card_errors++;
	}
	if( gift_card_errors ){
		jQuery( document.getElementById( 'ec_details_giftcard_error' ) ).show( );
	}else{
		jQuery( document.getElementById( 'ec_details_giftcard_error' ) ).hide( );
	}
	// -------END GIFT CARD CHECK   ----------- //
	// -------START DONATION CHECK  ----------- //
	if( document.getElementById( 'ec_donation_amount' ) ){
		if( isNaN( jQuery( document.getElementById( 'ec_donation_amount' ) ).val( ) ) || Number( jQuery( document.getElementById( 'ec_donation_amount' ) ).val( ) ) < <?php echo $GLOBALS['currency']->get_number_only( $this->product->price ); ?> ){
			jQuery( document.getElementById( 'ec_details_donation_error' ) ).show( );
			errors++;
		}else{
			jQuery( document.getElementById( 'ec_details_donation_error' ) ).hide( );
		}
	}
	// -------END DONATION CHECK    ----------- //
	// -------START INQUIRY CHECK  ----------- //
	if( document.getElementById( 'ec_inquiry_name' ) ){
		if( jQuery( document.getElementById( 'ec_inquiry_name' ) ).val( ) == "" || jQuery( document.getElementById( 'ec_inquiry_email' ) ).val( ) == "" || jQuery( document.getElementById( 'ec_inquiry_message' ) ).val( ) == "" ){
			jQuery( document.getElementById( 'ec_details_inquiry_error' ) ).show( );
			errors++;
		}else{
			jQuery( document.getElementById( 'ec_details_inquiry_error' ) ).hide( );
		}
	}
	// -------END INQUIRY CHECK    ----------- //
	// Stock Quantity Check
	var entered_quantity = Number( jQuery( document.getElementById( 'ec_quantity' ) ).val( ) );
	var allowed_quantity = 9999999999999;
	if( jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).length ){
		allowed_quantity = Number( jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( ) );
	}
	// Backorder Check
	if( allowed_quantity <= 0 && jQuery( document.getElementById( 'ec_back_order_info' ) ).length ){
		allowed_quantity = 1000000;
	}
	// Check Stock Quantity
	if( entered_quantity > allowed_quantity ){
		jQuery( document.getElementById( 'ec_addtocart_quantity_exceeded_error' ) ).show( );
		errors++;
	}else{
		jQuery( document.getElementById( 'ec_addtocart_quantity_exceeded_error' ) ).hide( );
	}
	// Minimum Quantity Check
	var min_quantity = <?php echo $this->product->min_purchase_quantity; ?>;
	if( entered_quantity < min_quantity ){
		jQuery( document.getElementById( 'ec_addtocart_quantity_minimum_error' ) ).show( );
		errors++;
	}else{
		jQuery( document.getElementById( 'ec_addtocart_quantity_minimum_error' ) ).hide( );
	}
	// Maximum Quantity Check
	var max_quantity = <?php echo $this->product->max_purchase_quantity; ?>;
	if( max_quantity > 0 && entered_quantity > max_quantity ){
		jQuery( document.getElementById( 'ec_addtocart_quantity_maximum_error' ) ).show( );
		errors++;
	}else{
		jQuery( document.getElementById( 'ec_addtocart_quantity_maximum_error' ) ).hide( );
	}
	if( errors > 0 )
		return false;
	else
		return true;
}
jQuery( '.ec_details_review_input' ).hover( function( ){	
	var score = jQuery( this ).attr( 'data-review-score' );
	jQuery( '.ec_details_review_input' ).removeClass( 'ec_product_details_star_on' ).addClass( 'ec_product_details_star_off' );
	for( var i=0; i<score; i++ ){
		jQuery( document.getElementById( 'ec_details_review_star' + (i+1) ) ).removeClass( 'ec_product_details_star_off' ).addClass( 'ec_product_details_star_on' );
	}
} );
jQuery( '.ec_product_openclose' ).hide( );
function ec_option1_image_change( optionitem_id_1, quantity ){<?php if( $this->product->use_optionitem_images ){ ?>
		jQuery( '.ec_details_thumbnails' ).hide( );
		jQuery( '.ec_details_large_popup_thumbnails' ).hide( );
		jQuery( document.getElementById( 'ec_details_thumbnails_' + optionitem_id_1 ) ).find( '.ec_details_thumbnail' ).first( ).trigger( 'click' );
		if( !jQuery( document.getElementById( 'ec_details_thumbnails_' + optionitem_id_1 ) ).hasClass( 'ec_no_thumbnails' ) ){
			jQuery( document.getElementById( 'ec_details_thumbnails_' + optionitem_id_1 ) ).show( );
			jQuery( document.getElementById( 'ec_details_large_popup_thumbnails_' + optionitem_id_1 ) ).show( );
		}<?php }?>
}
function ec_option1_selected( optionitem_id_1, quantity ){<?php if( $this->product->use_optionitem_images ){ ?>
		jQuery( '.ec_details_thumbnails' ).hide( );
		jQuery( '.ec_details_large_popup_thumbnails' ).hide( );
		jQuery( document.getElementById( 'ec_details_thumbnails_' + optionitem_id_1 ) ).find( '.ec_details_thumbnail' ).first( ).trigger( 'click' );
		if( !jQuery( document.getElementById( 'ec_details_thumbnails_' + optionitem_id_1 ) ).hasClass( 'ec_no_thumbnails' ) ){
			jQuery( document.getElementById( 'ec_details_thumbnails_' + optionitem_id_1 ) ).show( );
			jQuery( document.getElementById( 'ec_details_large_popup_thumbnails_' + optionitem_id_1 ) ).show( );
		}<?php }?>
	jQuery( '.ec_details_swatches > li.ec_option2' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_swatches > li.ec_option3' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_swatches > li.ec_option4' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_swatches > li.ec_option5' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_combo.ec_option2' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( '.ec_details_combo.ec_option3' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( '.ec_details_combo.ec_option4' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( '.ec_details_combo.ec_option5' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( quantity );
	jQuery( document.getElementById( 'ec_option_loading_2' ) ).show( );
	var next_options = jQuery( '.ec_details_swatches > li.ec_option2' );
	if( next_options.length ){
		next_options.each( function( ){
			jQuery( this ).removeClass( 'ec_active' );
		} );
		var data = {
			action: 'ec_ajax_get_optionitem_quantities',
			optionitem_id_1: optionitem_id_1,
			product_id: '<?php echo $this->product->product_id; ?>'
		};
		jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ 
			var json_data = JSON.parse( data );
			jQuery( document.getElementById( 'ec_option_loading_2' ) ).hide( );
			var i=0;
			next_options.each( function( ){
				jQuery( this ).attr( 'data-optionitem-quantity', json_data[i].quantity );
				if( json_data[i].quantity > 0 ){
					jQuery( this ).addClass( 'ec_active' );
				}
				i++;
			} );
		} } );
	}else{
		next_options = jQuery( '.ec_details_combo.ec_option2 option' );
		next_options.each( function( ){
			jQuery( this ).removeClass( 'ec_active' );
		} );
		var data = {
			action: 'ec_ajax_get_optionitem_quantities',
			optionitem_id_1: optionitem_id_1,
			product_id: '<?php echo $this->product->product_id; ?>'
		};
		jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ 
			jQuery( '.ec_details_combo.ec_option2' ).prop( 'disabled', false ).removeClass( 'ec_inactive' );
			var json_data = JSON.parse( data );
			jQuery( document.getElementById( 'ec_option_loading_2' ) ).hide( );
			var i=0;
			next_options.each( function( ){
				if( i > 0 ){
					jQuery( this ).attr( 'data-optionitem-quantity', json_data[i-1].quantity )
					if( json_data[i-1].quantity > 0 ){
						jQuery( this ).show( );
						jQuery( this ).prop( 'disabled', false );
					}else{
						jQuery( this ).hide( );
						jQuery( this ).prop( 'disabled', true );
					}
				}else{
					jQuery( this ).attr( 'data-optionitem-quantity', quantity );
				}
				i++;
			} );
		} } );
	}
}
function option2_selected( optionitem_id_1, optionitem_id_2, quantity ){	
	jQuery( '.ec_details_swatches > li.ec_option3' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_swatches > li.ec_option4' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_swatches > li.ec_option5' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_combo.ec_option3' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( '.ec_details_combo.ec_option4' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( '.ec_details_combo.ec_option5' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( '.ec_option2.ec_details_option_row_error' ).hide( );
	jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( quantity );
	var next_options = jQuery( '.ec_details_swatches > li.ec_option3' );
	jQuery( document.getElementById( 'ec_option_loading_3' ) ).show( );
	if( next_options.length ){
		next_options.each( function( ){
			jQuery( this ).removeClass( 'ec_active' );
		} );
		var data = {
			action: 'ec_ajax_get_optionitem_quantities',
			optionitem_id_1: optionitem_id_1,
			optionitem_id_2: optionitem_id_2,
			product_id: '<?php echo $this->product->product_id; ?>'
		};
		jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ 
			var json_data = JSON.parse( data );
			jQuery( document.getElementById( 'ec_option_loading_3' ) ).hide( );
			var i=0;
			next_options.each( function( ){
				jQuery( this ).attr( 'data-optionitem-quantity', json_data[i].quantity );
				if( json_data[i].quantity > 0 ){
					jQuery( this ).addClass( 'ec_active' );
				}
				i++;
			} );
		} } );
	}else{
		next_options = jQuery( '.ec_details_combo.ec_option3 option' );
		next_options.each( function( ){
			jQuery( this ).removeClass( 'ec_active' );
		} );
		var data = {
			action: 'ec_ajax_get_optionitem_quantities',
			optionitem_id_1: optionitem_id_1,
			optionitem_id_2: optionitem_id_2,
			product_id: '<?php echo $this->product->product_id; ?>'
		};
		jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ 
			jQuery( '.ec_details_combo.ec_option3' ).prop( 'disabled', false ).removeClass( 'ec_inactive' );
			var json_data = JSON.parse( data );
			jQuery( document.getElementById( 'ec_option_loading_3' ) ).hide( );
			var i=0;
			next_options.each( function( ){
				if( i > 0 ){
					jQuery( this ).attr( 'data-optionitem-quantity', json_data[i-1].quantity );
					if( json_data[i-1].quantity > 0 ){
						jQuery( this ).show( );
						jQuery( this ).prop( 'disabled', false );
					}else{
						jQuery( this ).hide( );
						jQuery( this ).prop( 'disabled', true );
					}
				}else{
					jQuery( this ).attr( 'data-optionitem-quantity', quantity );
				}
				i++;
			} );
		} } );
	}
}
function option3_selected( optionitem_id_1, optionitem_id_2, optionitem_id_3, quantity ){	
	jQuery( '.ec_details_swatches > li.ec_option4' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_swatches > li.ec_option5' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_combo.ec_option4' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( '.ec_details_combo.ec_option5' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( '.ec_option3.ec_details_option_row_error' ).hide( );
	jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( quantity );
	var next_options = jQuery( '.ec_details_swatches > li.ec_option4' );
	jQuery( document.getElementById( 'ec_option_loading_4' ) ).show( );
	if( next_options.length ){
		next_options.each( function( ){
			jQuery( this ).removeClass( 'ec_active' );
		} );
		var data = {
			action: 'ec_ajax_get_optionitem_quantities',
			optionitem_id_1: optionitem_id_1,
			optionitem_id_2: optionitem_id_2,
			optionitem_id_3: optionitem_id_3,
			product_id: '<?php echo $this->product->product_id; ?>'
		};
		jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ 
			var json_data = JSON.parse( data );
			jQuery( document.getElementById( 'ec_option_loading_4' ) ).hide( );
			var i=0;
			next_options.each( function( ){
				jQuery( this ).attr( 'data-optionitem-quantity', json_data[i].quantity );
				if( json_data[i].quantity > 0 ){
					jQuery( this ).addClass( 'ec_active' );
				}
				i++;
			} );
		} } );
	}else{
		next_options = jQuery( '.ec_details_combo.ec_option4 option' );
		next_options.each( function( ){
			jQuery( this ).removeClass( 'ec_active' );
		} );
		var data = {
			action: 'ec_ajax_get_optionitem_quantities',
			optionitem_id_1: optionitem_id_1,
			optionitem_id_2: optionitem_id_2,
			optionitem_id_3: optionitem_id_3,
			product_id: '<?php echo $this->product->product_id; ?>'
		};
		jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ 
			jQuery( '.ec_details_combo.ec_option4' ).prop( 'disabled', false ).removeClass( 'ec_inactive' );
			var json_data = JSON.parse( data );
			jQuery( document.getElementById( 'ec_option_loading_4' ) ).hide( );
			var i=0;
			next_options.each( function( ){
				if( i > 0 ){
					jQuery( this ).attr( 'data-optionitem-quantity', json_data[i-1].quantity );
					if( json_data[i-1].quantity > 0 ){
						jQuery( this ).show( );
						jQuery( this ).prop( 'disabled', false );
					}else{
						jQuery( this ).hide( );
						jQuery( this ).prop( 'disabled', true );
					}
				}else{
					jQuery( this ).attr( 'data-optionitem-quantity', quantity );
				}
				i++;
			} );
		} } );
	}
}
function option4_selected( optionitem_id_1, optionitem_id_2, optionitem_id_3, optionitem_id_4, quantity ){	
	jQuery( '.ec_details_swatches > li.ec_option5' ).removeClass( 'ec_selected' );
	jQuery( '.ec_details_combo.ec_option5' ).val( '0' ).prop( 'disabled', true ).addClass( 'ec_inactive' );
	jQuery( '.ec_option4.ec_details_option_row_error' ).hide( );
	jQuery( document.getElementById( 'ec_details_stock_quantity' ) ).html( quantity );
	var next_options = jQuery( '.ec_details_swatches > li.ec_option5' );
	jQuery( document.getElementById( 'ec_option_loading_5' ) ).show( );
	if( next_options.length ){
		next_options.each( function( ){
			jQuery( this ).removeClass( 'ec_active' );
		} );
		var data = {
			action: 'ec_ajax_get_optionitem_quantities',
			optionitem_id_1: optionitem_id_1,
			optionitem_id_2: optionitem_id_2,
			optionitem_id_3: optionitem_id_3,
			optionitem_id_4: optionitem_id_4,
			product_id: '<?php echo $this->product->product_id; ?>'
		};
		jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ 
			var json_data = JSON.parse( data );
			jQuery( document.getElementById( 'ec_option_loading_5' ) ).hide( );
			var i=0;
			next_options.each( function( ){
				jQuery( this ).attr( 'data-optionitem-quantity', json_data[i-1].quantity );
				if( json_data[i-1].quantity > 0 ){
					jQuery( this ).addClass( 'ec_active' );
				}
				i++;
			} );
		} } );
	}else{
		next_options = jQuery( '.ec_details_combo.ec_option5 option' );
		next_options.each( function( ){
			jQuery( this ).removeClass( 'ec_active' );
		} );
		var data = {
			action: 'ec_ajax_get_optionitem_quantities',
			optionitem_id_1: optionitem_id_1,
			optionitem_id_2: optionitem_id_2,
			optionitem_id_3: optionitem_id_3,
			optionitem_id_4: optionitem_id_4,
			product_id: '<?php echo $this->product->product_id; ?>'
		};
		jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ 
			jQuery( '.ec_details_combo.ec_option5' ).prop( 'disabled', false ).removeClass( 'ec_inactive' );
			var json_data = JSON.parse( data );
			jQuery( document.getElementById( 'ec_option_loading_5' ) ).hide( );
			var i=0;
			next_options.each( function( ){
				if( i > 0 ){
					jQuery( this ).attr( 'data-optionitem-quantity', json_data[i-1].quantity );
					if( json_data[i-1].quantity > 0 ){
						jQuery( this ).show( );
						jQuery( this ).prop( 'disabled', false );
					}else{
						jQuery( this ).hide( );
						jQuery( this ).prop( 'disabled', true );
					}
				}else{
					jQuery( this ).attr( 'data-optionitem-quantity', quantity );
				}
				i++;
			} );
		} } );
	}
}
function ec_submit_product_review( ){	
	var review_title = jQuery( document.getElementById( 'ec_review_title' ) ).val( );
	var review_score = 0;
	for( var i=1; i<=5; i++ ){
		if( jQuery( document.getElementById( 'ec_details_review_star' + i ) ).hasClass( 'ec_product_details_star_on' ) ){
			review_score++;
		}
	}
	var review_message = jQuery( document.getElementById( 'ec_review_message' ) ).val( );
	if( review_title != "" && review_score != 0 && review_message != "" ){
		// Submit a filled out review
		jQuery( document.getElementById( 'ec_details_customer_review_loader' ) ).show( );
		jQuery( document.getElementById( 'ec_details_review_error' ) ).hide( );
		var data = {
			action: 'ec_ajax_insert_customer_review',
			review_title: review_title,
			review_score: review_score,
			review_message: review_message,
			product_id: '<?php echo $this->product->product_id; ?>'
		};
		jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ 
			jQuery( document.getElementById( 'ec_details_customer_review_loader' ) ).hide( ); 
			jQuery( document.getElementById( 'ec_review_title' ) ).val( "" );
			jQuery( document.getElementById( 'ec_review_message' ) ).val( "" );
			jQuery( document.getElementById( 'ec_details_review_star1' ) ).removeClass( 'ec_product_details_star_on' ).addClass( 'ec_product_details_star_off' ); 
			jQuery( document.getElementById( 'ec_details_review_star2' ) ).removeClass( 'ec_product_details_star_on' ).addClass( 'ec_product_details_star_off' ); 
			jQuery( document.getElementById( 'ec_details_review_star3' ) ).removeClass( 'ec_product_details_star_on' ).addClass( 'ec_product_details_star_off' ); 
			jQuery( document.getElementById( 'ec_details_review_star4' ) ).removeClass( 'ec_product_details_star_on' ).addClass( 'ec_product_details_star_off' ); 
			jQuery( document.getElementById( 'ec_details_review_star5' ) ).removeClass( 'ec_product_details_star_on' ).addClass( 'ec_product_details_star_off' ); 
			jQuery( document.getElementById( 'ec_details_submit_review_button_row' ) ).hide( );
			jQuery( document.getElementById( 'ec_details_review_submitted_button_row' ) ).show( );
			jQuery( document.getElementById( 'ec_details_customer_review_success' ) ).show( ).delay( 1500 ).fadeOut( 'slow' ); 
		} } );
	}else{
		// Something is missing, display error.
		jQuery( document.getElementById( 'ec_details_review_error' ) ).show( );
	}
}
</script><?php if( $is_admin && !$is_preview ){ ?>
<script>
function ec_admin_show_description_editor( ){
	jQuery( '.ec_details_description_content' ).hide( );
	jQuery( '.ec_details_description_editor' ).show( );
}
function ec_admin_save_description_editor( ){
	var new_html = tinymce.get( 'desc_<?php echo $this->product->model_number; ?>' ).getContent( );
	jQuery( '.ec_details_description_editor' ).hide( );
	jQuery( '.ec_details_description_content' ).html( new_html ).show( );
	var data = {
		action: 'ec_ajax_ec_update_product_description',
		description: new_html,
		product_id: '<?php echo $this->product->product_id; ?>'
	};
	jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ } } );
}
function ec_admin_show_specifications_editor( ){	
	jQuery( '.ec_details_specifications_content' ).hide( );
	jQuery( '.ec_details_specifications_editor' ).show( );
}
function ec_admin_save_specifications_editor( ){
	var new_html = tinymce.get( 'specs_<?php echo $this->product->model_number; ?>' ).getContent( );
	jQuery( '.ec_details_specifications_editor' ).hide( );
	jQuery( '.ec_details_specifications_content' ).html( new_html ).show( );
	var data = {
		action: 'ec_ajax_ec_update_product_specifications',
		specifications: new_html,
		product_id: '<?php echo $this->product->product_id; ?>'
	};
	jQuery.ajax( { url: ajax_object.ajax_url, type: 'post', data: data, success: function( data ){ } } );
}
</script><?php } ?>
<?php /* END NEW PRODUCT DETAILS CONTENT */ ?>