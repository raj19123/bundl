<?php

$this->load->view('user/header', ['data' => $header_data]);

if(!empty($page)){
	$this->load->view('user/dashboard-header',['page' => $page]); 
}

echo $main_content;

if(!empty($page)){
	$this->load->view('user/dashboard-footer');
}
echo '<a class="floating-icon" href="https://wa.me/966547754124" target="blank"><i class="fa fa-whatsapp" style="color: white; font-size: 32px;"></i></a>';
$this->load->view('user/footer', ['data' => $footer_data]);