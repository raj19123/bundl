<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNDL</title>
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-Bold/FuturaPT-Bold.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-LightObl/FuturaPT-LightObl.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-Light/FuturaPT-Light.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-Demi/FuturaPT-Demi.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-CondBook/FuturaPT-CondBook.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_user/FuturaPT-Book/FuturaPT-Book.css"> -->

    <style>
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
    <div style="max-width: 1000px; margin: auto;">
        <div style="width: 22.66px; height: 30.45px; background-color: #E62D25;"></div>
    <div id="container" style="max-width: 800px;margin: auto; padding: 50px 0px;">
        <table cellpadding="0" cellspacing="0" height="100%" width="90%" style="margin: auto;" id="bodyTable">
            <thead style="text-align: center;">
                <tr>
                    <td colspan="2" style="text-align: right;"><img id="plus-icon" style="margin: 0px 60px -20px; height: 56px;" src="http://bundl_new/assets_user/images/email_images/mail-plus.png" alt=""></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p style="text-transform: uppercase; color: #000; font-family: 'Kumbh',sans-serif; font-weight: 900; font-size: 29.49px; margin-top: 10px; margin-bottom: 20px;">questionnaire completed
                        </p>
                    </td>
                </tr>
                <tr><td colspan="2" style="border: 1px solid #000;"></td></tr> 
                <tr>
                    <td colspan="2">
                        <p style="font-family: 'Jost', sans-serif; font-size: 18.43px;margin: 45px 0px 10px; color: #000;">
                            <em>Thank you for filling us in on your project. We’re excited to get our creative juices flowing!</em>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="color: #000;">
                        <div style="margin: 5px 0px 0px;text-align: center; margin-left: auto;margin-right: auto;">
                        <span><u style="font-family:'Kumbh', sans-serif; font-weight: 900; font-size: 18.43px; color: #000;">Order number:</u>
                        &nbsp;</span>
                        <span style="font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><em>12345</em></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="margin: 5px 0px;text-align: center; margin-left: auto;margin-right: auto;">
                            <span><u style="font-family:'Kumbh', sans-serif; font-size: 18.43px; font-weight: 900; color: #000;">Order date:</u>
                            &nbsp;</span>
                            <span style="font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><em>01/01/2021</em></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="margin: 5px 0px 35px;text-align: center; margin-left: auto;margin-right: auto;">
                            <span><u style="font-family:'Kumbh', sans-serif; font-size: 18.43px; font-weight: 900; color: #000;">Branding due date:</u>
                            &nbsp;</span>
                            <span style="font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><em>01/01/2021</em></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="margin-bottom: 45px;">
                            <?php if ($this->language == 'english') : ?>
                            <a href="{btn_link}" style="border: 1px solid black; text-decoration: none; color: black; padding: 5px 35px; letter-spacing: 5px;font-weight: 600;font-size: 14px; background: none; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('go_to_dashboard'); ?></a>
                            <?php else: ?>
                                <a href="{btn_link}" style="border: 1px solid black; text-decoration: none; color: black; padding: 5px 35px; letter-spacing: 0px;font-weight: 600;font-size: 14px; background: none; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('go_to_dashboard'); ?></a>
                            <?php endif; ?>
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
                    <h3 style="color: #68C1BB;margin: 25px 0px;font-family:'jost', sans-serif; font-size: 25px; font-weight: 400; text-transform: uppercase;"> WHAT WE’LL BE SENDING YOUR WAY</h3>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 10px;">
                    <!-- <?php $package_name = 'The Newbie';
                    foreach ($order_summery as $key => $value) { 
                        if ($value['item_type'] == 'package') {
                            $package_name = $value['item_name'];
                        }
                    }?> -->
                    <!-- <p style="margin: 5px 0px;">
                        <u class="font-md" style="font-weight: 900; font-family:'Kumbh', sans-serif; font-size: 18.43px; color: #000;"><?= $package_name ?>:</u>&nbsp;
                    </p> -->
                    <p style="color: #000; font-size: 18.43px; font-family: 'jost', sans-serif; font-weight: 300;">Logo Design</p>
                    <p style="color: #000; font-size: 18.43px; font-family: 'jost', sans-serif; font-weight: 300;">Visual Identity</p>
                    <p style="color: #000; font-size: 18.43px; font-family: 'jost', sans-serif; font-weight: 300;">Typography</p>
                    <p style="color: #000; font-size: 18.43px; font-family: 'jost', sans-serif; font-weight: 300;">Color Scheme</p>
                    <p style="color: #000; font-size: 18.43px; font-family: 'jost', sans-serif; font-weight: 300;">Logo Measurements</p>
                    <p style="color: #000; font-size: 18.43px; font-family: 'jost', sans-serif; font-weight: 300;">Visual Elements</p>
                    <p style="color: #000; font-size: 18.43px; font-family: 'jost', sans-serif; font-weight: 300;">Do’s and Don’ts</p>
                </td>
            </tr>
   <!--  <?php $addon_sum = 0; foreach ($order_summery as $key => $value) { 
        if (in_array($value['item_type'], ['logo', 'design'])) {
            if ($value['item_type'] == 'logo') {
                $item_name = $this->lang->line('logo')."(".$value['item_name'].")";
            } else {
                $item_name = $value['item_name'];
            }
            ?> -->
            <tr>
                <td style="padding: 0px 10px;">
                    <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-size: 18.43px; color: #000;">Logo
                        <?= $item_name; ?></p>
                    </td>
                    <td style="text-align: right;"></td>
                </tr>
            <?php  }elseif(in_array($value['item_type'], ['addon', 'custom_addon'])){ $addon_sum += $value['subtotal_price'];} } ?> 

            <tr>
                <td style="padding: 0px 10px;"></td>
                <td style="text-align: right;padding-right: 10px;">
                    <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-size: 18.43px; font-weight: 600; color: #000;" id="amount-val">
                        <?= number_format($grand_total['grand_total'] - $addon_sum) ?> SAR</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border: 1px solid;"></td>
                </tr>
                <tr>
                    <td style="padding: 0px 10px;">
                        <h3 style="margin: 15px 0px 5px;">
                            <u style="font-family:'Kumbh', sans-serif; font-weight: 900; font-size: 18.43px; color: #000;">Add-ons:</u>
                        </h3>
                    </td>
                </tr>
                <?php  foreach ($order_summery as $key => $value) { 
                    if (in_array($value['item_type'], ['addon', 'custom_addon'])) { ?>
                        <tr>
                            <td style="padding: 0px 10px;">
                                <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-size: 18.43px; color: #000;"><?= $value['item_name']; ?></p>
                            </td>
                            <td style="text-align: right;padding-right: 10px;">
                                <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-weight: 600; font-size: 18.43px; color: #000;"><?= number_format($value['subtotal_price']); ?> SAR</p>
                            </td>
                        </tr>

                    <?php } } ?>
                    <tr>
                        <td style="border: 1px solid;"></td>
                        <td style="border: 1px solid;"></td>
                    </tr>
                <tr>
                    <td style="padding: 0px 10px;"> 
                        <h3 style="margin: 15px 0px 5px;color: #68C1BB; font-family:'Kumbh', sans-serif; font-weight: 600; font-size: 18.43px;">Total</h3>
                    </td>
                    <td style="text-align: right;padding-right: 10px;">
                    <p style="margin: 5px 0px; font-family:'jost', sans-serif; font-weight: 600; font-size: 18.43px; color: #000;" id="amount-val">
                        <?= number_format($grand_total['grand_total'])  ?> SAR</p>
                    </td>
                </tr>
                    <tr>
                        <td style="border: 1px solid;"></td>
                        <td style="border: 1px solid;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 25px;padding-left: 10px;">
                            <h3 style="color: #68C1BB;margin: 0px 0px 5px; font-family:'Kumbh', sans-serif; font-weight: 600; font-size: 25px;">
                            CUSTOMER DETAILS</h3>
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
                    <td colspan="2" style="border-bottom: 2px solid #000; height: 30px;"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3 style="color: #000;margin: 55px auto; font-family:'jost', sans-serif; font-size: 25px; font-weight: 400; text-transform: uppercase; text-align: center; padding-bottom: 10px; border-bottom: 2px solid #000; width: max-content;">WHAT'S NEXT?</h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" height="100%" width="100%">
            <tbody>
                <tr>
                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 50% 2px; background-position: right center;">
                            <img style="height: 70px;" src="<?= base_url('assets_user/images/email_images/cube.png'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'kumbh', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">1</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'kumbh', sans-serif;"><?= $this->lang->line('step_1_heading'); ?></h4>

                        <div style="padding: 0px 16px;">
                            <p style="font-family: 'jost', sans-serif; font-size: 12px; font-weight: 600;"><?= $this->lang->line('step_1_description'); ?></p>
                        </div>
                    </td>

                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 100%; background-position: right center;">
                            <img style="    height: 70px;" src="<?= base_url('assets_user/images/email_images/circle-1.jpg'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'kumbh', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">2</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'kumbh', sans-serif;"><?= strtoupper($this->lang->line('step_2_heading')); ?></h4>

                        <div style="padding: 0px 13px;">
                            <p style="font-family: 'jost', sans-serif; font-size: 12px; font-weight: 600;"><?= $this->lang->line('step_2_description'); ?></p>
                        </div>
                    </td>

                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 100%; background-position: right center;">
                            <img style="height: 70px;" src="<?= base_url('assets_user/images/email_images/cone.png'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'kumbh', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">3</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'kumbh', sans-serif;"><?= $this->lang->line('step_3_heading'); ?></h4>

                        <div style="padding: 0px 16px;">
                            <p style="font-family: 'jost', sans-serif; font-size: 12px; font-weight: 600;"><?= $this->lang->line('step_3_description'); ?></p>
                        </div>
                    </td>

                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 100%; background-position: right center;">
                            <img style="height: 70px;" src="<?= base_url('assets_user/images/email_images/pipe.png'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'kumbh', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">4</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'kumbh', sans-serif;"><?= strtoupper($this->lang->line('step_4_heading')); ?></h4>

                        <div style="padding: 0px 11px;">
                            <p style="font-family: 'jost', sans-serif; font-size: 12px; font-weight: 600;"><?= $this->lang->line('step_4_description'); ?></p>
                        </div>
                    </td>
                    
                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 50% 2px; background-position: left center;">
                            <img style="height: 70px;" src="<?= base_url('assets_user/images/email_images/cube2.png'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'kumbh', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">5</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'kumbh', sans-serif;"><?= $this->lang->line('step_5_heading'); ?></h4>

                        <div style="padding: 0px 13px;">
                            <p style="font-family: 'jost', sans-serif; font-size: 12px; font-weight: 600;"><?= $this->lang->line('step_5_description'); ?></p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" height="100%" width="90%" style="margin: auto;">
            <tbody>
                <tr style="text-align: center;">
                    <td colspan="2" style="padding: 70px 0 40px;">
                        <em style="margin: 5px 0px; font-family:'jost', sans-serif; font-size: 22.66px; color: #000;">
                            Having a question?
                            <span style="color: #AE76A7; font-family:'jost', sans-serif; font-size: 22.66px;"><a
                                href="" style="color: #AE76A7;text-decoration: none;">contact
                            us</a></span>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border: 1px solid;"></td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="2" style="padding: 40px 0px 10px;">
                        <p style="margin: 5px 0px; font-family:'Kumbh', sans-serif; font-weight: 900; font-size: 33.47px;"
                        id="stay-connected">STAY CONNECTED</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;padding: 0px 0px 20px;">
                        <a href=""><img id="social-icons" style="margin: 0px 20px; height: 30px;" src="<?= base_url() ?>assets_user/images/email_images/fb.png" alt=""></a>
                        <a href=""><img id="social-icons" style="margin: 0px 20px; height: 30px;" src="<?= base_url() ?>assets_user/images/email_images/insta.png" alt=""></a>
                        <a href=""><img id="social-icons" style="margin: 0px 20px; height: 30px;" src="<?= base_url() ?>assets_user/images/email_images/linkdin.png" alt=""></a>
                        <a href=""><img id="social-icons" style="margin: 0px 20px; height: 30px;" src="<?= base_url() ?>assets_user/images/email_images/twitter.png" alt=""></a>
                        
                    </td>
                </tr>
                <!-- <tr>
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
                <td style="text-align: center; padding: 10px 0px;" colspan="2">
                        <img style="margin: 0 0 -1px; height: 17px;" src="<?= base_url() ?>assets_user/images/email_images/whatsapp.png" alt=""> &nbsp;
                    <span style="margin-left: -10px; margin-right: 15px;"><a href=""
                        style="
                        vertical-align: text-bottom;color: #000;text-decoration: none; font-family:'jost', sans-serif; font-size: 13.813px;">+(966)
                    543318362</a></span>
                        <img style="margin: 0 0 -1px; height: 16px;" src="<?= base_url() ?>assets_user/images/email_images/mailbox.png" alt=""> &nbsp;
                    <span style="margin-left: -10px;"><a href=""
                        style="
                        vertical-align: text-bottom;color: #000;text-decoration: none; font-family:'jost', sans-serif; font-size: 13.813px;">info@bundldesigns.com</a></span>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
</body>

    </html>