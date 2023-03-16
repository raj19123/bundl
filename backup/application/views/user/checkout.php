<?php //print_r($this->cart->contents()); ?>
<?php if($this->session->flashdata('paytab_data')){
	print_r($this->session->flashdata('paytab_data'));
} ?>

<main class="main-contents payment-page checkout-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<div class="steps-banenr">
			<div class="main-steps">
				<div class="row stack-on-600">
					<div class="col-sm-4 col">
						<div class="box step1">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/cube.png" alt="">
							</div>
							<div class="desc">
								<h4>1</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_1_heading');  ?><!-- </a> -->
								</h5>
								<p>
				                    <?= $this->lang->line('step_1_description'); ?>
				                </p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col">
						<div class="box step2">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/circle-1.jpg" alt="">
							</div>
							<div class="desc">
								<h4>2</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_2_heading'); ?><!-- </a> -->
								</h5>
								<p>
			                        <?= $this->lang->line('step_2_description'); ?>
			                    </p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col">
						<div class="box step3">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/cone.png" alt="">
							</div>
							<div class="desc">
								<h4>3</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_3_heading'); ?><!-- </a> -->
								</h5>
								<p>
			                        <?= $this->lang->line('step_3_description'); ?>
			                    </p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col">
						<div class="box step4">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/pipe.png" alt="">
							</div>
							<div class="desc">
								<h4>4</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_4_heading'); ?><!-- </a> -->
								</h5>
								<p>
			                        <?= $this->lang->line('step_4_description'); ?>
			                    </p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col">
						<div class="box step5">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/plane.png" alt="">
							</div>
							<div class="desc">
								<h4>5</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_5_heading'); ?><!-- </a> -->
								</h5>
								<p>
			                       <?= $this->lang->line('step_5_description'); ?>
			                    </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php $a = $this->session->flashdata('error') ; if($a){ ?>
            <div class="border-message">
                <?= $a; ?>
            </div>
        <?php } ?>

		<?php $b = $this->session->flashdata('success'); if($b){ ?>
            <div class="border-message">
                <?= $b; ?>
            </div>
        <?php } ?>

		<div class="section-title">
			<h1>
				<?= $this->lang->line('heading_checkout_text'); ?>
				<span class="add-icon"></span>
			</h1>
		</div>
		<form action="<?= base_url('place-order'); ?>" method="post" class="payment-form" id="placeOrderForm">
			<table class="cart-table" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td>
							<div class="item">
								<h5><?= $this->lang->line('billing_adress'); ?></h5>
							</div>
						</td>
						<td>
							<table class="inner-table">
								<tr>
									<td>
										<ul class="payment-options h-list">
											<li>
												<div class="image">
													<img src="<?= base_url(); ?>assets_user/images/visa.png" alt="visa card">
													<img src="<?= base_url(); ?>assets_user/images/mastercard.png" alt="master card" style="height: 33px;">
												</div>
												<!-- <p><?php //$this->lang->line('aboutus_craditcard'); ?></p> -->
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>
											<div class="row">
												<!-- <div class="col-sm-12">
													<div class="form-group with-icon full-width">
							                            <input type="text"
							                            	name="name" 
							                            	value="<?= isset($user) ? $user['full_name'] : ''; ?>" 
							                            	class="form-control validThis" 
							                            	placeholder="<?= $this->lang->line('contactus_name'); ?>">
							                            <span class="icon name"></span>
							                            <ul class="valid-error"></ul>
							                        </div>
							                    </div> -->
							                    <div class="col-md-6">
							                        <div class="form-group with-icon full-width">
							                            <input type="text"
							                            	name="f_name"
							                            	class="form-control validThis" 
							                            	placeholder="<?= $this->lang->line('placeholder_firstname'); ?>">
							                            <span class="icon font-icon">
							                            	<i class="fas fa-id-card"></i>
							                            </span>
							                            <ul class="valid-error text-purple"></ul>
							                        </div>
							                    </div>
							                    <div class="col-md-6">
							                        <div class="form-group with-icon full-width">
							                            <input type="text"
							                            	name="l_name" 
							                            	class="form-control validThis" 
							                            	placeholder="<?= $this->lang->line('placeholder_lastname'); ?>">
							                            <span class="icon font-icon">
							                            	<i class="fas fa-id-card"></i>
							                            </span>
							                            <ul class="valid-error text-purple"></ul>
							                        </div>
							                    </div>

							                    <div class="col-md-6">
							                        <div class="form-group with-icon full-width">
							                            <input type="text"
							                            	name="email" 
							                            	value="<?= isset($user) ? $user['email'] : ''; ?>"
							                            	class="form-control validThis" 
							                            	placeholder="<?= $this->lang->line('email_text'); ?>">
							                            <span class="icon email">
							                            	<!-- <i class="fas fa-envalop"></i> -->
							                            </span>
							                            <ul class="valid-error text-purple"></ul>
							                        </div>
							                    </div>

							                    <div class="col-md-6">
								                    <div class="form-group with-icon full-width">
														<input type="tel" 
															name="phone"
															id="checkout-phone" 
															class="form-control phoneMask validThis" 
															maxlength="11"
															oninput="this.value=this.value.replace(/[^0-9]/g,'');">
														<span class="icon phone"></span>
													</div>
												</div>

							                    <div class="col-md-6">
							                        <div class="form-group with-icon full-width">
							                            <input type="text"
							                            	name="city"
							                            	class="form-control validThis" 
							                            	oninput="this.value=this.value.replace(/[^a-zA-Z]/g,'');"
							                            	placeholder="<?= $this->lang->line('city_text'); ?>">
							                            <span class="icon font-icon">
							                            	<i class="fas fa-city"></i>
							                            </span>
							                            <ul class="valid-error text-purple"></ul>
							                        </div>
							                    </div>
							                    <div class="col-md-6">
							                        <div class="form-group with-icon full-width">
							                            <input type="text"
							                            	name="state"
							                            	class="form-control validThis" 
							                            	placeholder="<?= $this->lang->line('state_text'); ?>">
							                            <span class="icon font-icon">
							                            	<i class="fas fa-university"></i>
							                            </span>
							                            <ul class="valid-error text-purple"></ul>
							                        </div>
							                    </div>
							                    <div class="col-md-6">
							                        <div class="form-group with-icon full-width">
							                            <input type="text"
							                            	name="postal code"
							                            	class="form-control validThis" 
							                            	placeholder="<?= $this->lang->line('postal_code_text'); ?>">
							                            <span class="icon font-icon">
							                            	<i class="fas fa-mail-bulk"></i>
							                            </span>
							                            <ul class="valid-error text-purple"></ul>
							                        </div>
							                    </div>
							                    <div class="col-md-6">
							                        <div class="form-group with-icon full-width">
								                        <select name="country" id="id-location" class="selectpicker">
															<option value="AFG">Afghanistan</option>
															<option value="ALA">Åland Islands</option>
															<option value="ALB">Albania</option>
															<option value="DZA">Algeria</option>
															<option value="ASM">American Samoa</option>
															<option value="AND">Andorra</option>
															<option value="AGO">Angola</option>
															<option value="AIA">Anguilla</option>
															<option value="ATA">Antarctica</option>
															<option value="ATG">Antigua and Barbuda</option>
															<option value="ARG">Argentina</option>
															<option value="ARM">Armenia</option>
															<option value="ABW">Aruba</option>
															<option value="AUS">Australia</option>
															<option value="AUT">Austria</option>
															<option value="AZE">Azerbaijan</option>
															<option value="BHS">Bahamas</option>
															<option value="BHR">Bahrain</option>
															<option value="BGD">Bangladesh</option>
															<option value="BRB">Barbados</option>
															<option value="BLR">Belarus</option>
															<option value="BEL">Belgium</option>
															<option value="BLZ">Belize</option>
															<option value="BEN">Benin</option>
															<option value="BMU">Bermuda</option>
															<option value="BTN">Bhutan</option>
															<option value="BOL">Bolivia, Plurinational State of</option>
															<option value="BES">Bonaire, Sint Eustatius and Saba</option>
															<option value="BIH">Bosnia and Herzegovina</option>
															<option value="BWA">Botswana</option>
															<option value="BVT">Bouvet Island</option>
															<option value="BRA">Brazil</option>
															<option value="IOT">British Indian Ocean Territory</option>
															<option value="BRN">Brunei Darussalam</option>
															<option value="BGR">Bulgaria</option>
															<option value="BFA">Burkina Faso</option>
															<option value="BDI">Burundi</option>
															<option value="KHM">Cambodia</option>
															<option value="CMR">Cameroon</option>
															<option value="CAN">Canada</option>
															<option value="CPV">Cape Verde</option>
															<option value="CYM">Cayman Islands</option>
															<option value="CAF">Central African Republic</option>
															<option value="TCD">Chad</option>
															<option value="CHL">Chile</option>
															<option value="CHN">China</option>
															<option value="CXR">Christmas Island</option>
															<option value="CCK">Cocos (Keeling) Islands</option>
															<option value="COL">Colombia</option>
															<option value="COM">Comoros</option>
															<option value="COG">Congo</option>
															<option value="COD">Congo, the Democratic Republic of the</option>
															<option value="COK">Cook Islands</option>
															<option value="CRI">Costa Rica</option>
															<option value="CIV">Côte d'Ivoire</option>
															<option value="HRV">Croatia</option>
															<option value="CUB">Cuba</option>
															<option value="CUW">Curaçao</option>
															<option value="CYP">Cyprus</option>
															<option value="CZE">Czech Republic</option>
															<option value="DNK">Denmark</option>
															<option value="DJI">Djibouti</option>
															<option value="DMA">Dominica</option>
															<option value="DOM">Dominican Republic</option>
															<option value="ECU">Ecuador</option>
															<option value="EGY">Egypt</option>
															<option value="SLV">El Salvador</option>
															<option value="GNQ">Equatorial Guinea</option>
															<option value="ERI">Eritrea</option>
															<option value="EST">Estonia</option>
															<option value="ETH">Ethiopia</option>
															<option value="FLK">Falkland Islands (Malvinas)</option>
															<option value="FRO">Faroe Islands</option>
															<option value="FJI">Fiji</option>
															<option value="FIN">Finland</option>
															<option value="FRA">France</option>
															<option value="GUF">French Guiana</option>
															<option value="PYF">French Polynesia</option>
															<option value="ATF">French Southern Territories</option>
															<option value="GAB">Gabon</option>
															<option value="GMB">Gambia</option>
															<option value="GEO">Georgia</option>
															<option value="DEU">Germany</option>
															<option value="GHA">Ghana</option>
															<option value="GIB">Gibraltar</option>
															<option value="GRC">Greece</option>
															<option value="GRL">Greenland</option>
															<option value="GRD">Grenada</option>
															<option value="GLP">Guadeloupe</option>
															<option value="GUM">Guam</option>
															<option value="GTM">Guatemala</option>
															<option value="GGY">Guernsey</option>
															<option value="GIN">Guinea</option>
															<option value="GNB">Guinea-Bissau</option>
															<option value="GUY">Guyana</option>
															<option value="HTI">Haiti</option>
															<option value="HMD">Heard Island and McDonald Islands</option>
															<option value="VAT">Holy See (Vatican City State)</option>
															<option value="HND">Honduras</option>
															<option value="HKG">Hong Kong</option>
															<option value="HUN">Hungary</option>
															<option value="ISL">Iceland</option>
															<option value="IND">India</option>
															<option value="IDN">Indonesia</option>
															<option value="IRN">Iran, Islamic Republic of</option>
															<option value="IRQ">Iraq</option>
															<option value="IRL">Ireland</option>
															<option value="IMN">Isle of Man</option>
															<option value="ISR">Israel</option>
															<option value="ITA">Italy</option>
															<option value="JAM">Jamaica</option>
															<option value="JPN">Japan</option>
															<option value="JEY">Jersey</option>
															<option value="JOR">Jordan</option>
															<option value="KAZ">Kazakhstan</option>
															<option value="KEN">Kenya</option>
															<option value="KIR">Kiribati</option>
															<option value="PRK">Korea, Democratic People's Republic of</option>
															<option value="KOR">Korea, Republic of</option>
															<option value="KWT">Kuwait</option>
															<option value="KGZ">Kyrgyzstan</option>
															<option value="LAO">Lao People's Democratic Republic</option>
															<option value="LVA">Latvia</option>
															<option value="LBN">Lebanon</option>
															<option value="LSO">Lesotho</option>
															<option value="LBR">Liberia</option>
															<option value="LBY">Libya</option>
															<option value="LIE">Liechtenstein</option>
															<option value="LTU">Lithuania</option>
															<option value="LUX">Luxembourg</option>
															<option value="MAC">Macao</option>
															<option value="MKD">Macedonia, the former Yugoslav Republic of</option>
															<option value="MDG">Madagascar</option>
															<option value="MWI">Malawi</option>
															<option value="MYS">Malaysia</option>
															<option value="MDV">Maldives</option>
															<option value="MLI">Mali</option>
															<option value="MLT">Malta</option>
															<option value="MHL">Marshall Islands</option>
															<option value="MTQ">Martinique</option>
															<option value="MRT">Mauritania</option>
															<option value="MUS">Mauritius</option>
															<option value="MYT">Mayotte</option>
															<option value="MEX">Mexico</option>
															<option value="FSM">Micronesia, Federated States of</option>
															<option value="MDA">Moldova, Republic of</option>
															<option value="MCO">Monaco</option>
															<option value="MNG">Mongolia</option>
															<option value="MNE">Montenegro</option>
															<option value="MSR">Montserrat</option>
															<option value="MAR">Morocco</option>
															<option value="MOZ">Mozambique</option>
															<option value="MMR">Myanmar</option>
															<option value="NAM">Namibia</option>
															<option value="NRU">Nauru</option>
															<option value="NPL">Nepal</option>
															<option value="NLD">Netherlands</option>
															<option value="NCL">New Caledonia</option>
															<option value="NZL">New Zealand</option>
															<option value="NIC">Nicaragua</option>
															<option value="NER">Niger</option>
															<option value="NGA">Nigeria</option>
															<option value="NIU">Niue</option>
															<option value="NFK">Norfolk Island</option>
															<option value="MNP">Northern Mariana Islands</option>
															<option value="NOR">Norway</option>
															<option value="OMN">Oman</option>
															<option value="PAK">Pakistan</option>
															<option value="PLW">Palau</option>
															<option value="PSE">Palestinian Territory, Occupied</option>
															<option value="PAN">Panama</option>
															<option value="PNG">Papua New Guinea</option>
															<option value="PRY">Paraguay</option>
															<option value="PER">Peru</option>
															<option value="PHL">Philippines</option>
															<option value="PCN">Pitcairn</option>
															<option value="POL">Poland</option>
															<option value="PRT">Portugal</option>
															<option value="PRI">Puerto Rico</option>
															<option value="QAT">Qatar</option>
															<option value="REU">Réunion</option>
															<option value="ROU">Romania</option>
															<option value="RUS">Russian Federation</option>
															<option value="RWA">Rwanda</option>
															<option value="BLM">Saint Barthélemy</option>
															<option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
															<option value="KNA">Saint Kitts and Nevis</option>
															<option value="LCA">Saint Lucia</option>
															<option value="MAF">Saint Martin (French part)</option>
															<option value="SPM">Saint Pierre and Miquelon</option>
															<option value="VCT">Saint Vincent and the Grenadines</option>
															<option value="WSM">Samoa</option>
															<option value="SMR">San Marino</option>
															<option value="STP">Sao Tome and Principe</option>
															<option selected="" value="SAU">Saudi Arabia</option>
															<option value="SEN">Senegal</option>
															<option value="SRB">Serbia</option>
															<option value="SYC">Seychelles</option>
															<option value="SLE">Sierra Leone</option>
															<option value="SGP">Singapore</option>
															<option value="SXM">Sint Maarten (Dutch part)</option>
															<option value="SVK">Slovakia</option>
															<option value="SVN">Slovenia</option>
															<option value="SLB">Solomon Islands</option>
															<option value="SOM">Somalia</option>
															<option value="ZAF">South Africa</option>
															<option value="SGS">South Georgia and the South Sandwich Islands</option>
															<option value="SSD">South Sudan</option>
															<option value="ESP">Spain</option>
															<option value="LKA">Sri Lanka</option>
															<option value="SDN">Sudan</option>
															<option value="SUR">Suriname</option>
															<option value="SJM">Svalbard and Jan Mayen</option>
															<option value="SWZ">Swaziland</option>
															<option value="SWE">Sweden</option>
															<option value="CHE">Switzerland</option>
															<option value="SYR">Syrian Arab Republic</option>
															<option value="TWN">Taiwan, Province of China</option>
															<option value="TJK">Tajikistan</option>
															<option value="TZA">Tanzania, United Republic of</option>
															<option value="THA">Thailand</option>
															<option value="TLS">Timor-Leste</option>
															<option value="TGO">Togo</option>
															<option value="TKL">Tokelau</option>
															<option value="TON">Tonga</option>
															<option value="TTO">Trinidad and Tobago</option>
															<option value="TUN">Tunisia</option>
															<option value="TUR">Turkey</option>
															<option value="TKM">Turkmenistan</option>
															<option value="TCA">Turks and Caicos Islands</option>
															<option value="TUV">Tuvalu</option>
															<option value="UGA">Uganda</option>
															<option value="UKR">Ukraine</option>
															<option value="ARE">United Arab Emirates</option>
															<option value="GBR">United Kingdom</option>
															<option value="USA">United States</option>
															<option value="UMI">United States Minor Outlying Islands</option>
															<option value="URY">Uruguay</option>
															<option value="UZB">Uzbekistan</option>
															<option value="VUT">Vanuatu</option>
															<option value="VEN">Venezuela, Bolivarian Republic of</option>
															<option value="VNM">Viet Nam</option>
															<option value="VGB">Virgin Islands, British</option>
															<option value="VIR">Virgin Islands, U.S.</option>
															<option value="WLF">Wallis and Futuna</option>
															<option value="ESH">Western Sahara</option>
															<option value="YEM">Yemen</option>
															<option value="ZMB">Zambia</option>
															<option value="ZWE">Zimbabwe</option>
														</select>
														<span class="icon font-icon">
															<i class="fas fa-globe-americas"></i>
														</span>
							                            <ul class="valid-error text-purple"></ul>
							                            <script>
												            $('#id-location').val("<?= isset($user['location']) ? $user['location'] : 'SAU'; ?>");
												        </script>
													</div>
												</div>
											</div>

					                        <!-- <div class="form-group with-icon">
					                            <input type="text" name="creditcard" class="form-control validThis" placeholder="card number">
					                            <span class="icon card-no"></span>
					                            <ul class="valid-error"></ul>
					                        </div> -->

					                        <!-- <div class="row">
					                        	<div class="col-sm-5">
					                        		<label>Expiry date</label>
					                        		<div class="row">
					                        			<div class="col-6">
					                        				<div class="form-group">
					                        					<select name="month" class="selectpicker" title="Month">
					                        						<option value="01" selected="selected">January</option>
					                        						<option value="02">February</option>
					                        						<option value="03">March</option>
					                        						<option value="04">April</option>
					                        						<option value="05">May</option>
					                        						<option value="06">June</option>
					                        						<option value="07">July</option>
					                        						<option value="08">August</option>
					                        						<option value="09">September</option>
					                        						<option value="10">October</option>
					                        						<option value="11">November</option>
					                        						<option value="12">December</option>
					                        					</select>
					                        					<ul class="valid-error"></ul>
					                        				</div>
					                        			</div>
					                        			<div class="col-6">
					                        				<div class="form-group">
					                        					<select name="year" class="selectpicker" title="Year">
					                        						<?php for ($i=date('Y'); $i < 2050; $i++): ?> 
					                        							<option value="<?= $i; ?>" <?= ($i == 2025) ? 'selected' : ''; ?>><?= $i; ?></option>';
					                        						<?php endfor; ?>
					                        					</select>
					                        					<ul class="valid-error"></ul>
					                        				</div>
					                        			</div>
					                        		</div>
					                        	</div>
					                        	<div class="col-sm-5">
					                        		<label>Security code</label>
					                        		<div class="row">
					                        			<div class="col-6">
					                        				<input type="text" name="cvv" class="form-control validThis" placeholder="CVV">
					                        				<ul class="valid-error"></ul>
					                        			</div>
					                        		</div>
					                        	</div>
					                        </div> -->
					                    <!-- </form> -->
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<td>
							<div class="item">
								<h5><?= $this->lang->line('promo_code'); ?></h5>
							</div>
						</td>
						<td>
							<table class="inner-table">
								<tr>
									<td>
										<div class="row align-items-center">
											<div class="col-sm-6">
												<div class="form-group with-icon">
						                            <input type="text" name="promo" class="form-control" placeholder="<?= $this->lang->line('code_number_text'); ?>">
						                            <span class="icon card-code"></span>
						                        </div>
						                        <div id="promo-msg"></div>
											</div>
											<div class="col-sm-6">
												<a href="javascript:void(0)" id="promocode" class="apply-link"><?= $this->lang->line('applay_code'); ?></a>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>

				</tbody>
			</table>
			<?php //print_r($this->session->userdata()); ?>
			<div class="proceed-cart">
				<div class="grand-total">
					<h2 id="show-total">
						<span><?= $this->lang->line('sidebar_total_text'); ?></span> 
						<?php 
							if($this->session->userdata("cart_total_discounted")){
								$tot =  $this->cart->format_number($this->session->userdata("cart_total_discounted"));
							}else{
								$tot = $this->cart->format_number($this->session->userdata("cart_total"));
							}
							echo $tot.' '.$this->lang->line('sar'); 
						?>
					</h2>
					<h3>
						<span><?= $this->lang->line('cart_duration'); ?></span> 
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
						<small><?= $this->lang->line('cart_working_days'); ?></small>
					</h3>
				</div>
				<div class="checkbox">
					<label>
						<input name="agree" type="checkbox" id="agree" class="validThis">
						<span><?= $this->lang->line('i_agree'); ?> <a href="<?= base_url('terms-and-conditions'); ?>"><?= $this->lang->line('footer_terms_condition'); ?></a></span>
						<ul id="agree-error" class="text-purple"></ul>
					</label>
				</div>
				<div class="button-row">
					<button type="submit" id="order" class="btn btn-default word-gap-0"><?= $this->lang->line('place_order_btn'); ?></button>
				</div>
			</div>
		</form>
	</div>
</main>

<script>
	$(document).ready(function(){
	    $("#checkout-phone").intlTelInput({
	        allowDropdown: true,
	        autoPlaceholder: "polite",
	        placeholderNumberType: "MOBILE",
	        formatOnDisplay: true,
	        separateDialCode: true,
	        nationalMode: false,
	        autoHideDialCode: true,
	        //hiddenInput: "phone",
	        preferredCountries: [ "sa", "ae" ]
	    });
	    $("#checkout-phone").intlTelInput("setNumber", "<?= isset($user) ? $user['phone'] : ''; ?>");

	    if(localStorage.preservedFormValues){
	    	var getFormValues = JSON.parse(localStorage.getItem("preservedFormValues"));
    	    jQuery.each( getFormValues, function( i, field ) {
		      	$('[name="'+field.name+'"]').val(field.value);
		    });
		    localStorage.removeItem("preservedFormValues");
	    }
	});

	$('#order').on('click', function(event){
		event.preventDefault();

		$('#agree-error').html('');
		if($('#agree').is(':checked')){
			//console.log($(this).closest('form'));
			$('#checkout-phone').val($("#checkout-phone").intlTelInput('getNumber'));
			$(this).trigger("submit");
			//$(this).closest('form').submit();
		}else{
			$('#agree-error').html("<?= $this->lang->line('please_indicate_you_accept_terms_conditions'); ?>");
		}
	});

	$('#promocode').on('click', function(event){
		event.preventDefault();

		var code = $('input[name=promo]').val();
		//alert(code);

		$.ajax({
			type: 'post',
			url: '<?= base_url('promo'); ?>',
			data: {'code': code},
			success: function(msg){
				console.log(msg);
				if(msg == 'success'){
					var preservedFormValues = $("#placeOrderForm").serializeArray();
					localStorage.setItem("preservedFormValues", JSON.stringify(preservedFormValues));
					console.log(localStorage.getItem("preservedFormValues"));
					//$('#show-total').html('<span>total :</span> <?= $this->cart->format_number($this->session->userdata("cart_total")); ?> SAR');
					$('#promo-msg').html('<div class="alert alert-success alert-dismissible"><?= $this->lang->line('promotion_code_been_applied_successfully'); ?></div>');
					setTimeout(function(){ window.location.reload(); }, 1000);
				}else{
					$('#promo-msg').html('<div class="alert alert-danger text-purple alert-dismissible"><?= $this->lang->line('Promotion_code_failed_to_apply'); ?></div>');
				}
			}
		});
	});
</script>