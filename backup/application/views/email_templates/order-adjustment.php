<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order adjustment</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <section class="order-section" style="padding: 50px 0px 50px 0px;">
        <div class="container" style="max-width: 800px; margin: auto">
            <h2 style="text-align: center; border-bottom: 1px solid black; padding-bottom: 20px; margin: 0px; font-size: 36px;
        font-weight: 700; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('adjustment_order_confirmation'); ?></h2>
            <p style="padding: 30px 0px 30px 0px; font-style: italic; font-size: 22px;     text-align: center;
        color: black; margin: 0; font-family: 'Open Sans', sans-serif;"><?= $notification['email_body_'.$language] ?> </p>
            <div class="order-details" style="text-align: center;     padding-bottom: 50px;">
                <p><span style="font-size: 22px; font-family: 'Open Sans', sans-serif; font-weight: bold; border-bottom: 1px solid black;"><?= $this->lang->line('order_name'); ?>:</span><i style="font-size:22px; font-family: 'Open Sans', sans-serif; letter-spacing: 3px;"> {order_name}</i></p>
                <p><span style="font-size: 22px; font-family: 'Open Sans', sans-serif; font-weight: bold; border-bottom: 1px solid black;"><?= $this->lang->line('order_number'); ?>:</span><i style="font-size:22px; font-family: 'Open Sans', sans-serif; letter-spacing: 3px;"> {order_id}</i></p>
                <p><span style="font-size: 22px; font-family: 'Open Sans', sans-serif; font-weight: bold; border-bottom: 1px solid black;"><?= $this->lang->line('order_date'); ?>:</span><i style="font-size:22px; font-family: 'Open Sans', sans-serif; letter-spacing: 3px;"> {order_date}</i></p>
                <!-- <p><span style="font-size: 22px; font-family: 'Open Sans', sans-serif; font-weight: bold; border-bottom: 1px solid black;">Branding due date:</span><i style="font-size:22px; font-family: 'Open Sans', sans-serif; letter-spacing: 3px;"> 01/02/2021</i></p> -->
            </div>
            <div style="text-align: center; padding-bottom: 70px; border-bottom: 1px solid black;">
                <?php if ($language == 'english') : ?>
                    <a href="{btn_link}" style=" border: 1px solid black; text-decoration: none; color: black; padding: 1px 40px; letter-spacing: 5px;font-weight: 600;font-size: 14px; background: none; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('go_to_dashboard'); ?></a>
                <?php else: ?>
                    <a href="{btn_link}" style=" border: 1px solid black; text-decoration: none; color: black; padding: 1px 40px; letter-spacing: 0px;font-weight: 600;font-size: 14px; background: none; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('go_to_dashboard'); ?></a>
                <?php endif; ?>
            </div>
            <?php if (isset($order_summery)) { ?>
                <div class="order-summery">
                    <h3 style="color: #6ec3bd; font-size: 32px; font-family: 'Open Sans', sans-serif; font-weight: 600; margin-bottom: 40px;"><?= $this->lang->line('adjustment_order_summery'); ?>:</h3>
                    <table style="width: 100%; padding: 0px 0px 60px 0px; border-bottom: 2px solid rgba(0, 0, 0, 0.5);">
                        <tr>
                            <th style="text-align: left;"><span style="border-bottom: 2px solid black; text-align: left;font-size: 22px; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('adjusments'); ?>:</span></th>
                            <?php $add_ons = false;
                            foreach ($order_adjustments as $key1 => $value) {
                                $add_ons = true;
                            }
                            if ($add_ons == true) { ?>
                                <th style="text-align: left;"><span style=" border-bottom: 2px solid black; text-align: left;font-size: 22px; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('extras'); ?>:</span></th>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td style="    padding: 10px 0px; font-family: 'Open Sans', sans-serif; font-size: 20px;">
                                <ul style="list-style: none; padding: 0; margin-bottom: 0;">
                                    <?php foreach ($order_adjustments as $key2 => $value) { ?>
                                        <li style="font-family: 'Open Sans', sans-serif; font-size: 20px; margin-bottom: 12px;"><?= $value['item_name']; ?></li>
                                    <?php } ?>
                                </ul> 
                            </td>
                            <td style="font-family: 'Open Sans', sans-serif; font-size: 20px;">
                                <ul style="list-style: none; padding: 0; margin-bottom: 0;">
                                    <?php foreach ($order_summery as $key3 => $value) { 
                                        if (in_array($value['item_type'], ['custom_addon'])) {
                                            ?>
                                        <li style="font-family: 'Open Sans', sans-serif; font-size: 20px; margin-bottom: 12px;"><?= $value['item_name']; ?></li>
                                    <?php } }?>
                                </ul>
                            </td>
                        </tr>

                    </table>
                </div>
            <?php } ?>

            <div style="text-align: center;">
                <h3 style="font-size: 22px; font-family: 'Open Sans', sans-serif; text-align: center;  padding-bottom: 10px; margin-bottom: 65px; margin-top: 50px; font-weight: 600; display: inline-block; text-align: center; border-bottom: 1px solid #000;"><?= $this->lang->line('what_the_next'); ?></h3>
            </div>
            <table style="width: 100%;" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 50% 2px; background-position: right center;">
                            <img style="height: 70px;" src="<?= base_url('assets_user/images/email_images/cube.png'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'Open Sans', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">1</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('step_1_heading'); ?></h4>

                        <div style="padding: 0px 16px;">
                            <p style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-weight: 600;"><?= $this->lang->line('step_1_description'); ?></p>
                        </div>
                    </td>

                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 100%; background-position: right center;">
                            <img style="    height: 70px;" src="<?= base_url('assets_user/images/email_images/circle-1.jpg'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'Open Sans', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">2</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'Open Sans', sans-serif;"><?= strtoupper($this->lang->line('step_2_heading')); ?></h4>

                        <div style="padding: 0px 13px;">
                            <p style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-weight: 600;"><?= $this->lang->line('step_2_description'); ?></p>
                        </div>
                    </td>

                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 100%; background-position: right center;">
                            <img style="height: 70px;" src="<?= base_url('assets_user/images/email_images/cone.png'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'Open Sans', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">3</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('step_3_heading'); ?></h4>

                        <div style="padding: 0px 16px;">
                            <p style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-weight: 600;"><?= $this->lang->line('step_3_description'); ?></p>
                        </div>
                    </td>

                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 100%; background-position: right center;">
                            <img style="height: 70px;" src="<?= base_url('assets_user/images/email_images/pipe.png'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'Open Sans', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">4</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'Open Sans', sans-serif;"><?= strtoupper($this->lang->line('step_4_heading')); ?></h4>

                        <div style="padding: 0px 11px;">
                            <p style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-weight: 600;"><?= $this->lang->line('step_4_description'); ?></p>
                        </div>
                    </td>
                    
                    <td style="width: 20%; vertical-align: top; text-align: center;">
                        <div style="height: 70px; background-image: url(<?= base_url('assets_user/images/email_images/border.png'); ?>); background-repeat: no-repeat; background-size: 50% 2px; background-position: left center;">
                            <img style="height: 70px;" src="<?= base_url('assets_user/images/email_images/cube2.png'); ?>" alt="image">
                        </div>
                        <p style="font-family: 'Open Sans', sans-serif; font-size: 25px;font-weight: 700; padding: 5px 0px; margin: 0px;">5</p>
                        <h4 style="color: #6ec3bd; margin: 0px; text-transform: uppercase; font-size: 14px; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('step_5_heading'); ?></h4>

                        <div style="padding: 0px 13px;">
                            <p style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-weight: 600;"><?= $this->lang->line('step_5_description'); ?></p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </section>
    <footer style="padding: 0px 0px 150px 0px;">
        <div class="container" style="max-width: 800px; margin: auto;">
            <h2 style="text-align: center; border-bottom: 2px solid rgba(0, 0, 0, 0.5); padding-bottom: 25px; margin: 0px; font-size: 28px;
            font-weight: 400;font-family: 'Open Sans', sans-serif; font-style: italic;"><?= $this->lang->line('have_a_question'); ?>
                <span style="font-size: 24px; letter-spacing: -1.5px; font-weight: 600; font-family: 'Open Sans', sans-serif; font-style: normal; font-weight: 600; color: #ae74a1;">contact us</span>
            </h2>
            <div class="stay-connected" style="text-align:center; padding-top: 0px;">
                <h2 style="font-size: 32px; margin-bottom: 0; margin-top: 35px; font-family: 'Open Sans', sans-serif;font-weight: 700;"><?= strtoupper($this->lang->line('footer_stay_connected')); ?></h2>
                <ul class="connected" style=" text-align: center; list-style: none;padding-left: 0px;">
                    <li style="margin-right: 52px; display: inline-block;">
                        <a href="https://www.facebook.com/"><img style="  height: 20px;" src="<?= base_url('assets_user/images/email_images/fb.png'); ?>" alt=""></a>
                    </li>
                    <li style="margin-right: 52px; display: inline-block;">
                        <a href="https://www.instagram.com/"><img style=" height: 20px;" src="<?= base_url('assets_user/images/email_images/insta.png'); ?>" alt=""></a>
                    </li>
                    <li style="margin-right: 52px; display: inline-block;">
                        <a href="https://www.linkedin.com/"><img style="height: 20px;" src="<?= base_url('assets_user/images/email_images/linkdin.png'); ?>" alt=""></a>
                    </li>
                    <li style="margin-right: 0px; display: inline-block;">
                        <a href="https://twitter.com/?lang=en"><img style=" height: 20px;" src="<?= base_url('assets_user/images/email_images/twitter.png'); ?>" alt=""></a>
                    </li>
                </ul>
            </div>

        </div>
    </footer>
</body>