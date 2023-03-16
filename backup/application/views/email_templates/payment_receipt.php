<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNDL</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-Bold/FuturaPT-Bold.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-LightObl/FuturaPT-LightObl.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-Light/FuturaPT-Light.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-Demi/FuturaPT-Demi.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-CondBook/FuturaPT-CondBook.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-Book/FuturaPT-Book.css">

    <style>
        /*@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap');*/
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;1,300;1,400&family=Nunito:wght@900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@600;700;800;900&family=Nunito:wght@900&display=swap');

        @media screen and (min-width:330px) and (max-width: 480px) {
            #container {
                padding: 50px 0px !important;
                /* width: 360px !important; */
            }
            .font-md{
                font-size: 16px !important;
            }
            #amount-val {
                min-width: 120px !important;
            }

            #stay-connected {
                font-size: 26.626px !important;
            }

            #social-icons {
                margin: 0px 10px !important;
            }
        }
        /*@import url(<?= base_url() ?>'assets_user/FuturaPT-Book/FuturaPT-Demi.woff2');*/
    </style>
</head>

<body style="margin: 0;padding: 0;">
    <div id="container" style="max-width: 600px;margin: auto; padding: 50px 0px; <?= ($language != "english")?'direction: rtl;':'';  ?>">
        <table cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
            <thead style="text-align: center;">
                <tr>
                    <td colspan="2">
                        <!-- <img width="172" src="<?= base_url() ?>assets_user/images/logo.pdf" alt=""> -->
                        <img src="<?= base_url() ?>assets_user/images/logo.jpg" width=172></image>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="font-family: 'Jost', sans-serif; font-size: 18.43px;margin: 45px 0px 10px; color: #000;"><em><?= $notification['email_body_'.$language] ?></em></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="color: #000;">
                    <div
                    style="margin: 5px 0px 0px;text-align: left;width: 300px;padding-left: 100px;margin-left: auto;margin-right: auto;">
                    <span><u style="font-family:'Kumbh', sans-serif; font-weight: 900; font-size: 18.43px; color: #000;"><?= $this->lang->line('order_number'); ?>:</u>
                    &nbsp;</span>
                    <span style="font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><em>{order_id}</em></span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div
                style="margin: 5px 0px 35px;text-align: left;width: 300px;padding-left: 100px;margin-left: auto;margin-right: auto;">
                    <span><u style="font-family:'Kumbh', sans-serif; font-size: 18.43px; font-weight: 900; color: #000;"><?= $this->lang->line('order_date'); ?>:</u>
                    &nbsp;</span>
                    <span style="font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><em>{order_date}</em></span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border: 1px solid #000;"></td>
            <!-- <td style="border: 1px solid #000100;"></td> -->
        </tr>
    </thead>

<tbody>
    <tr>
        <td style="padding: 0px 10px;">
            <h3 style="color: #68C1BB;margin: 15px 0px 5px;font-family:'Kumbh', sans-serif; font-size: 25px; font-weight: 600;">
            <?= $this->lang->line('order_summery'); ?>:</h3>
        </td>
    </tr>
    <tr>
        <td style="padding: 0px 10px;">
            <?php $package_name = $this->lang->line('customize_bun');
            foreach ($order_summery as $key => $value) { 
                if ($value['item_type'] == 'package') {
                    $package_info = $this->db->get_where("packages" , ["id" => $value['item_id']])->row_array();
                    $package_name = $package_info['name_'.$language];
                }
            }?>
            <p style="margin: 5px 0px;">
                <u class="font-md" style="font-weight: 900; font-family:'Kumbh', sans-serif; font-size: 18.43px; color: #000;"><?= $package_name ?>:</u>&nbsp;
            </p>
        </td>
        <td style="text-align: right;"></td>
    </tr>
    <?php $addon_sum = 0; $adjustment_sum = 0;
    foreach ($order_summery as $key => $value) { 
        $adjustment_sum += $value['subtotal_price'];
        if (in_array($value['item_type'], ['logo', 'design'])) {
            if ($value['item_type'] == 'logo') {
                $item_name = $this->lang->line('logo')."(".$value['name_'.$language].")";
            } else {
                $item_name = $value['name_'.$language];
            }
            ?>
            <tr>
                <td style="padding: 0px 10px;">
                    <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-size: 18.43px; color: #000;">
                        <?= $item_name; ?></p>
                    </td>
                    <td style="text-align: right;"></td>
                </tr>
            <?php  }elseif(in_array($value['item_type'], ['addon', 'custom_addon'])){ $addon_sum += $value['subtotal_price'];} } ?> 

            <tr>
                <td style="padding: 0px 10px;"></td>
                <td style="text-align: right;padding-right: 10px;">
                    <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-size: 18.43px; font-weight: 600; color: #000;" id="amount-val">
                        <?= number_format(($payment_details['total_price']) ? $payment_details['total_price'] - $addon_sum : $addon_sum) ?> <?= $this->lang->line('sar') ?></p>
                    <?php
                        if ($payment_details['total_price']) {
                            # code...
                        } else {
                            $payment_details['total_price'] = $addon_sum;
                            $payment_details['total_price_paid'] = $addon_sum;

                            if ($payment_details['discount']) {
                                # code...
                            } else {
                                // $original_price = round($addon_sum/((100 - $payment_details['discount'])/100));
                                // $discount_price = $original_price - $addon_sum;

                                $discount_price = round($addon_sum/(100/$payment_details['discount']));
                                $paid_price = $addon_sum - $discount_price;

                                $payment_details['discounted_amount'] = $discount_price;
                                $payment_details['total_price_paid'] = $paid_price;

                                // $payment_details['total_price'] = $original_price;
                            }
                        }
                    ?>
                    </td>
                </tr>
                <?php 
                    // if (isset($all_adj_item_ids) && !empty($all_adj_item_ids) && count($all_adj_item_ids) === count($order_summery)) 
                    // {
                    //     $addOnsJd = false;
                    //     $adjustmentsJd = true;
                    // } else
                    if (isset($all_adj_item_ids) && !empty($all_adj_item_ids) && count($order_summery) > count($all_adj_item_ids)) {

                        $addOnsJd = true;
                        $adjustmentsJd = true;
                    } else {

                        if (isset($all_adj_item_ids) && !empty($all_adj_item_ids)) {
                            $addOnsJd = false;
                            $adjustmentsJd = true;

                            if ($payment_details['total_price']) {
                                # code...
                            } else {
                                $payment_details['total_price'] = $adjustment_sum;
                                $payment_details['total_price_paid'] = $adjustment_sum;

                                if ($payment_details['discount']) {
                                    # code...
                                } else {
                                    // $original_price = round($adjustment_sum/((100 - $payment_details['discount'])/100));
                                    // $discount_price = $original_price - $adjustment_sum;

                                    $discount_price = round($adjustment_sum/(100/$payment_details['discount']));
                                    $paid_price = $adjustment_sum - $discount_price;

                                    $payment_details['discounted_amount'] = $discount_price;
                                    $payment_details['total_price_paid'] = $paid_price;

                                    // $payment_details['total_price'] = $original_price;
                                }
                            }
                        } else {
                            $addOnsJd = true;
                            $adjustmentsJd = false;
                        }    
                    }
                ?>
                <?php if ($addOnsJd) { ?>
                <tr>
                    <td colspan="2" style="border: 1px solid;"></td>
                </tr>
                <tr>
                    <td style="padding: 0px 10px;">
                        <h3 style="margin: 15px 0px 5px;">
                            <u style="font-family:'Kumbh', sans-serif; font-weight: 900; font-size: 18.43px; color: #000;"><?= $this->lang->line('add_ons'); ?>:</u>
                        </h3>
                    </td>
                </tr>
                <?php  foreach ($order_summery as $key => $value) { 
                    if (in_array($value['item_type'], ['addon', 'custom_addon']) && !(in_array($value['id'], $all_adj_item_ids))) { ?>
                        <tr>
                            <td style="padding: 0px 10px;">
                                <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><?= $value['name_'.$language]; ?></p>
                            </td>
                            <td style="text-align: right;padding-right: 10px;">
                                <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-weight: 600; font-size: 18.43px; color: #000;"><?= number_format($value['subtotal_price']); ?> <?= $this->lang->line('sar') ?></p>
                            </td>
                        </tr>

                    <?php } } ?>
                    <tr>
                        <td style="border: 1px solid;"></td>
                        <td style="border: 1px solid;"></td>
                    </tr>
                <?php } 
                    if ($adjustmentsJd) {
                ?>
                <tr>
                    <td colspan="2" style="border: 1px solid;"></td>
                </tr>
                <tr>
                    <td style="padding: 0px 10px;">
                        <h3 style="margin: 15px 0px 5px;">
                            <u style="font-family:'Kumbh', sans-serif; font-weight: 900; font-size: 18.43px; color: #000;"><?= $this->lang->line('adjusments'); ?>:</u>
                        </h3>
                    </td>
                </tr>
                <?php  foreach ($order_summery as $key => $value) { 
                    if (in_array($value['id'], $all_adj_item_ids)) { ?>
                        <tr>
                            <td style="padding: 0px 10px;">
                                <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><?= $value['name_'.$language]; ?></p>
                            </td>
                            <td style="text-align: right;padding-right: 10px;">
                                <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-weight: 600; font-size: 18.43px; color: #000;"><?= number_format($value['subtotal_price']); ?> <?= $this->lang->line('sar') ?></p>
                            </td>
                        </tr>

                    <?php } } ?>
                    <tr>
                        <td style="border: 1px solid;"></td>
                        <td style="border: 1px solid;"></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="padding: 0px 10px;"> 
                        <h3 style="margin: 15px 0px 5px;color: #68C1BB; font-family:'Kumbh', sans-serif; font-weight: 600; font-size: 18.43px;"><?= $this->lang->line('total') ?></h3>
                    </td>
                    <td style="text-align: right;padding-right: 10px;">
                    <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-weight: 600; font-size: 18.43px; color: #000;" id="amount-val">
                        <?= number_format($payment_details['total_price'])  ?> <?= $this->lang->line('sar') ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 10px;"> 
                        <h3 style="margin: 15px 0px 5px;color: #68C1BB; font-family:'Kumbh', sans-serif; font-weight: 600; font-size: 18.43px;"><?= $this->lang->line("discount") ?></h3>
                    </td>
                    <td style="text-align: right;padding-right: 10px;">
                    <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-weight: 600; font-size: 18.43px; color: #000;" id="amount-val">
                        <?= number_format($payment_details['discounted_amount'])  ?> <?= $this->lang->line('sar') ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;"></td>
                    <td style="border: 1px solid;"></td>
                </tr>
                <tr>
                    <td style="padding: 0px 10px;"> 
                        <h3 style="margin: 15px 0px 5px;color: #68C1BB; font-family:'Kumbh', sans-serif; font-weight: 600; font-size: 18.43px;"><?= $this->lang->line('total_paid') ?></h3>
                    </td>
                    <td style="text-align: right;padding-right: 10px;">
                    <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-weight: 600; font-size: 18.43px; color: #000;" id="amount-val">
                        <?= number_format($payment_details['total_price_paid'])  ?> <?= $this->lang->line('sar') ?></p>
                    </td>
                </tr>
                    <tr>
                        <td style="border: 1px solid;"></td>
                        <td style="border: 1px solid;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 25px;padding-left: 10px;">
                            <h3 style="color: #68C1BB;margin: 0px 0px 5px; font-family:'Kumbh', sans-serif; font-weight: 600; font-size: 25px;">
                            <?= $this->lang->line('customer_detail') ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 10px;">
                            <em style="margin: 0px; font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><?= $this->User->full_name; ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 10px;">
                            <em style="margin: 0px; font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><?= $this->User->phone; ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 25px;padding-left: 10px;">
                            <em style="margin: 0px; font-family:'jost', sans-serif; font-size: 18.43px; color: #000; text-decoration: none;">
                                <a style="color: #68C1BB;"><?= $this->User->email; ?></a></em>
                            </td>
                        </tr>
                <!-- <tr>
                    <td style="border: 1px solid;"></td>
                    <td style="border: 1px solid;"></td>
                </tr> -->
                <!-- <td style="padding-top: 25px;">
                    <h3 style="color: #6CC4C7;margin: 0px 0px 5px;font-family: 'FuturaPT-Bold';font-size: 18.43px;">PAYMENT DETAILS</h3>
                </td>
                <tr>
                    <td style="padding-bottom: 30px;">
                        <p style="margin: 5px;font-family:'FuturaPT-LightObl';font-size: 18.43px;">Credit card VISA: xxxx-xxxx-xxxx-5410</p>
                    </td>
                    <td style="text-align: right;padding-bottom: 30px;">
                        <p style="margin: 0px;font-family: 'FuturaPT-Demi'; font-size: 18.43px;">4,000 AED</p>
                    </td>
                </tr> -->
                <tr>
                    <td colspan="2" style="border: 1px solid;"></td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="2" style="padding: 20px;">
                        <em style="margin: 5px 0px; font-family:'jost', sans-serif; font-size: 22.66px; color: #000;">
                           <?= $this->lang->line('have_a_question'); ?>
                            <span style="color: #AE76A7; font-family:'jost', sans-serif; font-size: 22.66px;"><a
                                href="https://bundldesigns.com/contact-us" style="color: #AE76A7;text-decoration: none;"><?= $this->lang->line('footer_contectus_li'); ?></a></span>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border: 1px solid;"></td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="2" style="padding: 20px 0px 10px;">
                        <p style="margin: 5px 0px; font-family:'Kumbh', sans-serif; font-weight: 900; font-size: 33.47px;"
                        id="stay-connected"><?= strtoupper($this->lang->line('footer_stay_connected')); ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;padding: 0px 0px 20px;">
                        <a href="https://www.facebook.com/bundldesigns/"><img id="social-icons" style="margin: 0px 20px; height: 30px;" src="<?= base_url() ?>assets_user/images/email_images/fb.png" alt=""></a>
                        <a href="https://www.instagram.com/bundl_designs/"><img id="social-icons" style="margin: 0px 20px; height: 30px;" src="<?= base_url() ?>assets_user/images/email_images/insta.png" alt=""></a>
                        <a href="https://www.linkedin.com/company/bundl-designs"><img id="social-icons" style="margin: 0px 20px; height: 30px;" src="<?= base_url() ?>assets_user/images/email_images/linkdin.png" alt=""></a>
                        <a href="https://twitter.com/BundlDesigns"><img id="social-icons" style="margin: 0px 20px; height: 30px;" src="<?= base_url() ?>assets_user/images/email_images/twitter.png" alt=""></a>
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border: 1px solid;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;" colspan="2">
                        <h3
                        style="color: #68C1BB; margin: 20px 0px 5px;font-size: 22.493px; font-family:'Kumbh', sans-serif; font-weight: 600; text-decoration: none;">
                    <a style="color: #68C1BB;">WWW.BUNDLDESIGNS.COM</a></h3>
                </td>
            </tr>
            <tr>
                    <!-- <td colspan="2">
                        <div>
                            <p>
                                <img src="whatsapp.png" alt="">
                                +(966) 543318362
                            </p>
                            <p>
                                <img src="mailbox.png" alt="">
                                info@bundldesigns.com
                            </p>
                        </div>
                    </td> -->
                    <td style="text-align: center; padding: 10px 0px; direction: ltr;" colspan="2">
                        <!-- <span style="margin: 0px 10px;cursor: pointer;"> -->
                            <img style="margin: 0; height: 24px;" src="<?= base_url() ?>assets_user/images/email_images/whatsapp-1.png" alt=""> &nbsp;
                        <!-- </span> -->
                        <span style="margin-left: -10px; margin-right: 15px;"><a href=""
                            style="
                            vertical-align: text-bottom;color: #000;text-decoration: none; font-family:'jost', sans-serif; font-size: 14px; line-height: 25px;">+(966)
                        547754124</a></span>
                        <!-- <span style="margin: 0px 10px;cursor: pointer;"> -->
                            <img style="margin: 0; height: 20px;" src="<?= base_url() ?>assets_user/images/email_images/mailbox-1.png" alt=""> &nbsp;
                        <!-- </span> -->
                        <span style="margin-left: -10px;"><a href=""
                            style="
                            vertical-align: text-bottom;color: #000;text-decoration: none; font-family:'jost', sans-serif; font-size: 14px; line-height: 25px;">info@bundldesigns.com</a></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>

    </html>