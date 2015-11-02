;
ALTER TABLE `ec_address` ADD KEY `ec_address_idx1` (`address_id`) USING BTREE;
ALTER TABLE `ec_address` ADD KEY `ec_address_idx2` (`user_id`) USING BTREE;
ALTER TABLE `ec_affiliate_rule` ADD KEY `ec_affiliate_rule_idx1` (`affiliate_rule_id`) USING BTREE;
ALTER TABLE `ec_affiliate_rule_to_affiliate` ADD KEY `ec_affiliate_rule_to_affiliate_idx1` (`rule_to_account_id`) USING BTREE;
ALTER TABLE `ec_affiliate_rule_to_affiliate` ADD KEY `ec_affiliate_rule_to_affiliate_idx2` (`affiliate_rule_id`) USING BTREE;
ALTER TABLE `ec_affiliate_rule_to_affiliate` ADD KEY `ec_affiliate_rule_to_affiliate_idx3` (`affiliate_id`) USING BTREE;
ALTER TABLE `ec_affiliate_rule_to_product` ADD KEY `ec_affiliate_rule_to_product_idx1` (`rule_to_product_id`) USING BTREE;
ALTER TABLE `ec_affiliate_rule_to_product` ADD KEY `ec_affiliate_rule_to_product_idx2` (`affiliate_rule_id`) USING BTREE;
ALTER TABLE `ec_affiliate_rule_to_product` ADD KEY `ec_affiliate_rule_to_product_idx3` (`product_id`) USING BTREE;
ALTER TABLE `ec_category` ADD KEY `ec_category_idx1` (`category_id`) USING BTREE;
ALTER TABLE `ec_categoryitem` ADD KEY `ec_categoryitem_idx1` (`product_id`) USING BTREE;
ALTER TABLE `ec_categoryitem` ADD KEY `ec_categoryitem_idx2` (`category_id`) USING BTREE;
ALTER TABLE `ec_categoryitem` ADD KEY `ec_categoryitem_idx3` (`categoryitem_id`) USING BTREE;
ALTER TABLE `ec_code` ADD KEY `ec_code_idx1` (`code_id`) USING BTREE;
ALTER TABLE `ec_code` ADD KEY `ec_code_idx2` (`product_id`) USING BTREE;
ALTER TABLE `ec_code` ADD KEY `ec_code_idx3` (`orderdetail_id`) USING BTREE;
ALTER TABLE `ec_country` ADD KEY `ec_country_idx1` (`id_cnt`) USING BTREE;
ALTER TABLE `ec_country` ADD KEY `ec_country_idx2` (`iso2_cnt`) USING BTREE;
ALTER TABLE `ec_country` ADD KEY `ec_country_idx3` (`iso3_cnt`) USING BTREE;
ALTER TABLE `ec_download` ADD KEY `ec_download_idx1` (`download_id`) USING BTREE;
ALTER TABLE `ec_download` ADD KEY `ec_download_idx2` (`order_id`) USING BTREE;
ALTER TABLE `ec_download` ADD KEY `ec_download_idx3` (`product_id`) USING BTREE;
ALTER TABLE `ec_giftcard` ADD KEY `ec_giftcard_idx1` (`giftcard_id`) USING BTREE;
ALTER TABLE `ec_manufacturer` ADD KEY `ec_manufacturer_idx1` (`manufacturer_id`) USING BTREE;
ALTER TABLE `ec_menulevel1` ADD KEY `ec_menulevel1_idx1` (`menulevel1_id`) USING BTREE;
ALTER TABLE `ec_menulevel2` ADD KEY `ec_menulevel2_idx1` (`menulevel2_id`) USING BTREE;
ALTER TABLE `ec_menulevel2` ADD KEY `ec_menulevel2_idx2` (`menulevel1_id`) USING BTREE;
ALTER TABLE `ec_menulevel3` ADD KEY `ec_menulevel3_idx1` (`menulevel3_id`) USING BTREE;
ALTER TABLE `ec_menulevel3` ADD KEY `ec_menulevel3_idx2` (`menulevel2_id`) USING BTREE;
ALTER TABLE `ec_option` ADD UNIQUE KEY (`option_id`);
ALTER TABLE `ec_option` ADD KEY `ec_option_idx2` (`option_id`) USING BTREE;
ALTER TABLE `ec_option_to_product` ADD UNIQUE KEY (`option_to_product_id`);
ALTER TABLE `ec_option_to_product` ADD KEY `ec_option_to_product_idx2` (`option_to_product_id`) USING BTREE;
ALTER TABLE `ec_option_to_product` ADD KEY `ec_option_to_product_idx3` (`option_id`) USING BTREE;
ALTER TABLE `ec_option_to_product` ADD KEY `ec_option_to_product_idx4` (`product_id`) USING BTREE;
ALTER TABLE `ec_optionitemimage` ADD KEY `ec_optionitemimage_idx1` (`optionitemimage_id`) USING BTREE;
ALTER TABLE `ec_optionitemimage` ADD KEY `ec_optionitemimage_idx2` (`optionitem_id`) USING BTREE;
ALTER TABLE `ec_optionitemimage` ADD KEY `ec_optionitemimage_idx3` (`product_id`) USING BTREE;
ALTER TABLE `ec_optionitemquantity` ADD KEY `ec_optionitemquantity_idx1` (`product_id`) USING BTREE;
ALTER TABLE `ec_optionitemquantity` ADD KEY `ec_optionitemquantity_idx2` (`optionitem_id_1`) USING BTREE;
ALTER TABLE `ec_optionitemquantity` ADD KEY `ec_optionitemquantity_idx3` (`optionitem_id_2`) USING BTREE;
ALTER TABLE `ec_optionitemquantity` ADD KEY `ec_optionitemquantity_idx4` (`optionitem_id_3`) USING BTREE;
ALTER TABLE `ec_optionitemquantity` ADD KEY `ec_optionitemquantity_idx5` (`optionitem_id_4`) USING BTREE;
ALTER TABLE `ec_optionitemquantity` ADD KEY `ec_optionitemquantity_idx6` (`optionitem_id_5`) USING BTREE;
ALTER TABLE `ec_order` ADD KEY `ec_order_idx1` (`order_id`) USING BTREE;
ALTER TABLE `ec_order` ADD KEY `ec_order_idx2` (`user_id`) USING BTREE;
ALTER TABLE `ec_order` ADD KEY `ec_order_idx3` (`giftcard_id`) USING BTREE;
ALTER TABLE `ec_order_option` ADD UNIQUE KEY (`order_option_id`);
ALTER TABLE `ec_order_option` ADD KEY `ec_order_option_idx2` (`orderdetail_id`) USING BTREE;
ALTER TABLE `ec_orderdetail` ADD UNIQUE KEY (`orderdetail_id`);
ALTER TABLE `ec_orderdetail` ADD KEY `ec_orderdetail_idx2` (`orderdetail_id`) USING BTREE;
ALTER TABLE `ec_orderdetail` ADD KEY `ec_orderdetail_idx3` (`order_id`) USING BTREE;
ALTER TABLE `ec_orderdetail` ADD KEY `ec_orderdetail_idx4` (`product_id`) USING BTREE;
ALTER TABLE `ec_orderdetail` ADD KEY `ec_orderdetail_idx5` (`giftcard_id`) USING BTREE;
ALTER TABLE `ec_orderstatus` ADD KEY `ec_orderstatus_idx1` (`status_id`) USING BTREE;
ALTER TABLE `ec_pricetier` ADD KEY `ec_pricetier_idx1` (`pricetier_id`) USING BTREE;
ALTER TABLE `ec_pricetier` ADD KEY `ec_pricetier_idx2` (`product_id`) USING BTREE;
ALTER TABLE `ec_product` ADD KEY `ec_product_idx20` (`menulevel1_id_1`,`menulevel2_id_1`,`menulevel3_id_1`) USING BTREE;
ALTER TABLE `ec_product` ADD KEY `ec_product_idx1` (`menulevel1_id_2`,`menulevel2_id_2`,`menulevel3_id_2`) USING BTREE;
ALTER TABLE `ec_product` ADD KEY `ec_product_idx2` (`menulevel1_id_3`,`menulevel2_id_3`,`menulevel3_id_3`) USING BTREE;
ALTER TABLE `ec_product` ADD KEY `ec_product_idx10` (`manufacturer_id`) USING BTREE;
ALTER TABLE `ec_product` ADD KEY `ec_product_idx11` (`option_id_1`) USING BTREE;
ALTER TABLE `ec_product` ADD KEY `ec_product_idx12` (`option_id_2`) USING BTREE;
ALTER TABLE `ec_product` ADD KEY `ec_product_idx13` (`option_id_3`) USING BTREE;
ALTER TABLE `ec_product` ADD KEY `ec_product_idx14` (`option_id_4`) USING BTREE;
ALTER TABLE `ec_product` ADD KEY `ec_product_idx15` (`option_id_5`) USING BTREE;
ALTER TABLE `ec_product_google_attributes` ADD KEY `ec_product_google_attributes_idx1` (`product_id`) USING BTREE;
ALTER TABLE `ec_promocode` ADD KEY `ec_promocode_idx1` (`manufacturer_id`) USING BTREE;
ALTER TABLE `ec_promocode` ADD KEY `ec_promocode_idx2` (`product_id`) USING BTREE;
ALTER TABLE `ec_promotion` ADD KEY `ec_promotion_idx1` (`product_id_1`) USING BTREE;
ALTER TABLE `ec_promotion` ADD KEY `ec_promotion_idx2` (`product_id_2`) USING BTREE;
ALTER TABLE `ec_promotion` ADD KEY `ec_promotion_idx3` (`product_id_3`) USING BTREE;
ALTER TABLE `ec_promotion` ADD KEY `ec_promotion_idx4` (`manufacturer_id_1`) USING BTREE;
ALTER TABLE `ec_promotion` ADD KEY `ec_promotion_idx5` (`manufacturer_id_2`) USING BTREE;
ALTER TABLE `ec_promotion` ADD KEY `ec_promotion_idx6` (`manufacturer_id_3`) USING BTREE;
ALTER TABLE `ec_promotion` ADD KEY `ec_promotion_idx7` (`category_id_1`) USING BTREE;
ALTER TABLE `ec_promotion` ADD KEY `ec_promotion_idx8` (`category_id_2`) USING BTREE;
ALTER TABLE `ec_promotion` ADD KEY `ec_promotion_idx9` (`category_id_3`) USING BTREE;
ALTER TABLE `ec_response` ADD KEY `ec_response_idx1` (`order_id`) USING BTREE;
ALTER TABLE `ec_review` ADD KEY `ec_review_idx1` (`review_id`) USING BTREE;
ALTER TABLE `ec_review` ADD KEY `ec_review_idx2` (`user_id`) USING BTREE;
ALTER TABLE `ec_role` ADD KEY `ec_role_idx1` (`role_label`) USING BTREE;
ALTER TABLE `ec_roleaccess` ADD KEY `ec_roleaccess_idx1` (`role_label`) USING BTREE;
ALTER TABLE `ec_roleprice` ADD KEY `ec_roleprice_idx1` (`product_id`) USING BTREE;
ALTER TABLE `ec_roleprice` ADD KEY `ec_roleprice_idx2` (`role_label`) USING BTREE;
ALTER TABLE `ec_shippingrate` ADD KEY `ec_shippingrate_idx1` (`zone_id`) USING BTREE;
ALTER TABLE `ec_subscription` ADD UNIQUE KEY `ec_subscription_idx1` (`subscription_id`);
ALTER TABLE `ec_subscription` ADD KEY `ec_subscription_idx2` (`user_id`) USING BTREE;
ALTER TABLE `ec_subscription` ADD KEY `ec_subscription_idx3` (`product_id`) USING BTREE;
ALTER TABLE `ec_taxrate` ADD KEY `ec_taxrate_idx1` (`state_code`) USING BTREE;
ALTER TABLE `ec_taxrate` ADD KEY `ec_taxrate_idx2` (`country_code`) USING BTREE;
ALTER TABLE `ec_taxrate` ADD KEY `ec_taxrate_idx3` (`vat_country_code`) USING BTREE;
ALTER TABLE `ec_taxrate` ADD KEY `ec_taxrate_idx4` (`duty_exempt_country_code`) USING BTREE;
ALTER TABLE `ec_tempcart` ADD UNIQUE KEY (`tempcart_id`);
ALTER TABLE `ec_tempcart` ADD KEY `ec_tempcart_idx2` (`session_id`) USING BTREE;
ALTER TABLE `ec_tempcart` ADD KEY `ec_tempcart_idx3` (`product_id`) USING BTREE;
ALTER TABLE `ec_tempcart` ADD KEY `ec_tempcart_idx4` (`optionitem_id_1`) USING BTREE;
ALTER TABLE `ec_tempcart` ADD KEY `ec_tempcart_idx5` (`optionitem_id_2`) USING BTREE;
ALTER TABLE `ec_tempcart` ADD KEY `ec_tempcart_idx6` (`optionitem_id_3`) USING BTREE;
ALTER TABLE `ec_tempcart` ADD KEY `ec_tempcart_idx7` (`optionitem_id_4`) USING BTREE;
ALTER TABLE `ec_tempcart` ADD KEY `ec_tempcart_idx8` (`optionitem_id_5`) USING BTREE;
ALTER TABLE `ec_tempcart_optionitem` ADD UNIQUE KEY (`tempcart_optionitem_id`);
ALTER TABLE `ec_tempcart_optionitem` ADD KEY `ec_tempcart_optionitem_idx2` (`tempcart_id`) USING BTREE;
ALTER TABLE `ec_tempcart_optionitem` ADD KEY `ec_tempcart_optionitem_idx3` (`option_id`) USING BTREE;
ALTER TABLE `ec_tempcart_optionitem` ADD KEY `ec_tempcart_optionitem_idx4` (`optionitem_id`) USING BTREE;
ALTER TABLE `ec_tempcart_optionitem` ADD KEY `ec_tempcart_optionitem_idx5` (`session_id`) USING BTREE;
ALTER TABLE `ec_user` ADD KEY `ec_user_idx1` (`default_billing_address_id`) USING BTREE;
ALTER TABLE `ec_user` ADD KEY `ec_user_idx2` (`default_shipping_address_id`) USING BTREE;
ALTER TABLE `ec_user` ADD KEY `ec_user_idx3` (`user_level`) USING BTREE;
ALTER TABLE `ec_zone_to_location` ADD UNIQUE KEY (`zone_to_location_id`);
ALTER TABLE `ec_zone_to_location` ADD KEY `ec_zone_to_location_idx2` (`zone_id`) USING BTREE;
ALTER TABLE `ec_zone_to_location` ADD KEY `ec_zone_to_location_idx3` (`iso2_cnt`) USING BTREE;
ALTER TABLE `ec_zone_to_location` ADD KEY `ec_zone_to_location_idx4` (`code_sta`) USING BTREE;
ALTER TABLE `ec_product` ADD `subscription_prorate` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Allows the user to turn prorate on/off with Stripe.';
ALTER TABLE `ec_product` ADD `allow_backorders` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Allows a user to purchase a product out of stock that will be shipped when the product is back in stock.';
ALTER TABLE `ec_product` ADD `backorder_fill_date` VARCHAR(512) NOT NULL DEFAULT '' COMMENT 'Gives the customer an idea of when the product will be back in stock.';
ALTER TABLE `ec_order` ADD `gst_total` FLOAT(15,3) NOT NULL DEFAULT 0.000 COMMENT 'The GST total on the order';
ALTER TABLE `ec_order` ADD `gst_rate` FLOAT(15,3) NOT NULL DEFAULT 0.000 COMMENT 'The GST rate applied to the order';
ALTER TABLE `ec_order` ADD `pst_total` FLOAT(15,3) NOT NULL DEFAULT 0.000 COMMENT 'The PST total on the order';
ALTER TABLE `ec_order` ADD `pst_rate` FLOAT(15,3) NOT NULL DEFAULT 0.000 COMMENT 'The PST rate applied to the order';
ALTER TABLE `ec_order` ADD `hst_total` FLOAT(15,3) NOT NULL DEFAULT 0.000 COMMENT 'The HST total on the order';
ALTER TABLE `ec_order` ADD `hst_rate` FLOAT(15,3) NOT NULL DEFAULT 0.000 COMMENT 'The HST rate applied to the order';
ALTER TABLE `ec_order` ADD `gateway_transaction_id` VARCHAR(512) NOT NULL DEFAULT '' COMMENT 'The transaction id to be used for refunds in purchases other than Stripe and PayPal.';