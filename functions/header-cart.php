<?php if ( class_exists( 'Woocommerce' ) ) {
	global $woocommerce; ?>

	<div id="top-panel">
		<div id="panel">
			<?php if (sizeof($woocommerce->cart->get_cart())>0) : ?>
				<table>
					<tbody>
						<tr class="thead">
							<th class="qty">QTY</th>
							<th class="titler">Title</th>
							<th class="pricer">Price</th>
						</tr>
						<?php foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) :
							$_product = $cart_item['data'];
							if ($_product->exists() && $cart_item['quantity']>0) :
								echo '<tr>';									
								echo '<td class="qty">' .$cart_item['quantity'].'</td>';									
								echo '<td class="titler"><a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product).'</a></td>';
								echo '<td class="pricer">' .woocommerce_price($_product->get_price()).'</td></tr>';
				   				echo $woocommerce->cart->get_item_data( $cart_item );
			
							endif;
						endforeach; ?>
					</tbody>
				</table>
				
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="checkout">Proceed to checkout &rarr;</a>
				
			<?php else:
				echo '<span class="empty">'.__('No products in the cart.', 'woocommerce').'</span>';
			endif; ?>
		
		</div>
		
		<div class="cart-bottom">
			<a href="#" class="btn-slide">
				<?php 
				echo sprintf(_n('%d item &ndash; ', '%d items &ndash; ', $woocommerce->cart->cart_contents_count), $woocommerce->cart->cart_contents_count);
				echo $woocommerce->cart->get_cart_total();
				?>
			</a>
		</div>
	</div>
<?php } ?>