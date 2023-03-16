<!-- bundl selection side bar -->
	<div class="cart-box">
		<p class="head"><?= $this->lang->line('sidebar'); ?></p>
		<?php 
		if($this->cart->contents()):
			$has_package = false;
			foreach ($this->cart->contents() as $row_id => $item):
				if($item['options']['type'] == 'package'):
					$has_package = true;
				?>
					<p class="pro-title"><?= $item['name']; ?>:</p>
				<?php
				endif;

				$show_adjustment = false;
				if($item['options']['type'] == 'adjustment'){
					$show_adjustment = true;
				}
			endforeach;
			
			if($show_adjustment == true):
			?>
				<p class="pro-title"><?= $this->lang->line('sidebar_adjustment'); ?></p>
			<?php
			endif;
		endif;
		?>
		<table class="pro-info">
			<tbody>
				<?php 
				if($this->cart->contents()):
					$cart_contents = $this->cart->contents();
					foreach ($cart_contents as $row_id => $item):

						if($item['options']['type'] == 'logo'):
							?>

							<tr>
								<td class="name"><?= $this->lang->line('logo'); ?> (<?= ($item['name'] == 'both') ? $this->lang->line('english_arabic') : (($item['name'] == 'english') ? $this->lang->line('english') : $this->lang->line('arabic')); ?>)</td>
								<td><?= $this->lang->line('cart_qty'); ?><span class="qty"><?= $item['qty']; ?></span></td>
							</tr>

							<?php
						endif;

						if($item['options']['type'] == 'adjustment'):
							?>

							<tr>
								<td class="name"><?= $item['name']; ?></td>
								<td></td>
							</tr>

							<?php
						endif;

						if($item['options']['type'] == 'design'):
							
						?>
							<tr>
								<td class="name"><?= $item['name']; ?></td>
								<td><?= $this->lang->line('cart_qty'); ?><span class="qty"><?= $item['qty']; ?></span></td>
							</tr>
							<?php
						endif;
					endforeach;
				endif;
				?>
			</tbody>
		</table>

		<p class="pro-title"><?= $this->lang->line('sidebar_addone'); ?></p>
		<table class="pro-info border-0">
			<tbody>

				<?php 
				if($this->cart->contents()):
					$cart_contents = $this->cart->contents();
					$item_counts = array_count_values(array_column($cart_contents, 'id'));

					// for qty = 1
					foreach ($cart_contents as $row_id => $item) {
						if( in_array($item['options']['type'], ['addon', 'custom_addon'])){
							if($item_counts[$item['id']] == 1){ ?>
								<tr>
									<td class="name"><?= $item['name']; ?></td>
									<td><?= $this->lang->line('cart_qty'); ?><span class="qty"><?= $item_counts[$item['id']]; ?></span></td>
								</tr>
							<?php }
						}
					}

					//for qty > 1
					$item_ids = [];
					$package_items = [];
					foreach ($cart_contents as $row_id => $item) {
						if( in_array($item['options']['type'], ['addon', 'custom_addon'])){
							array_push($item_ids, $item['id']);
						}
						if($item['options']['type'] == 'design'){
							array_push($package_items, $item['id']);
						}
					}
					$item_ids = array_unique($item_ids);

					foreach ($item_ids as $key => $item_id) {
						if($item_counts[$item_id] > 1){
							$design = $this->db->get_where('designs', ['id' => $item_id])->row_array();
							?>
							<tr class="has-child">
								<td class="name"><?= $design['name_'.$language]; ?></td>
								<td><?= $this->lang->line('cart_qty'); ?>
									<span class="qty">
										<?php 
										$quty = $item_counts[$item_id];
										if($has_package){
											if(in_array($item_id, $package_items)){
												$quty = (int)$item_counts[$item_id] -1;
											}
										}
										echo $quty;
										?>
									</span>
								</td>
							</tr>
							<tr class="sub-menu">
								<td colspan="2">
									<table>
										<?php foreach ($cart_contents as $row => $value) {  
											if( ($value['id'] == $item_id) && (in_array($value['options']['type'], ['addon', 'custom_addon'])) ){
											?>
												<tr>
													<td class="name"><?= $value['name']; ?></td>
													<td><?= $this->lang->line('sar'); ?>: <span class="qty"><?= $this->cart->format_number($value['price']); ?></span></td>
												</tr>
											<?php }  ?>
										<?php } ?>
									</table>
								</td>
							</tr>
						<?php }
					}

				else:
					?>
					<td class="name"><?= $this->lang->line('sidebar_none_text'); ?></td>
					<td><span></span></td>
					<?php
				endif;
				?>
			</tbody>

		</table>
		<div class="grand-total">
			<h2>
				<span><?= $this->lang->line('sidebar_total_text'); ?></span> <?= $this->cart->format_number($this->cart->total()); ?> <?= $this->lang->line('sar'); ?>
			</h2>
			<h3>
				<span><?= $this->lang->line('sidebar_duration'); ?></span> 
				<?php 
				if($this->cart->contents()):
					$total_time = 0;
					foreach ($this->cart->contents() as $row_id => $item):
						$total_time += $item['subtotal_time'];
					endforeach;
					echo $this->cart->format_number($total_time);
				else:
					echo 0;
				endif;
				?>
				<small><?= $this->lang->line('work_days'); ?></small>
			</h3>
		</div>
		<div class="button-row">
			<?php if($this->cart->contents()): ?>
				<p id="msg"><?= $this->lang->line('sidebar_success_msg'); ?></p>
			<?php endif; ?>
			<a href="<?= base_url('cart'); ?>" class="btn btn-default" id="go_to_cart"><?= $this->lang->line('sidebar_btn'); ?></a>
		</div>
	</div>



<script type="text/javascript">
	$('#msg').fadeOut(10000);
</script>