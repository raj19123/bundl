<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bundl_invoice</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href='https://fonts.googleapis.com/css?family=Jost' rel='stylesheet'> -->
    <link href="http://fonts.cdnfonts.com/css/jost" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;1,300;1,400&family=Nunito:wght@900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@600;700;800;900&family=Nunito:wght@900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;300;600;700&display=swap');
    </style>
</head>
<?php $category_arr = [ 1 => 'Branding', 2 => 'Stationery', 3 => 'Products', 4 => 'Publications', 5 => 'E-Designs', 7 => 'Space Design', 11 => 'Social Media' ]; ?>
<body style="margin: 0; font-family: 'Jost',sans-serif; background-color: #fff; color: #000; font-size: 14px; font-weight: 400; line-height: 1.2;">
    <div id="container" style="max-width: 800px; margin: 0; background: #fff;">

        <div class="table-head" style="padding: 36px 2%;">
            <table style='width: 100%; table-layout: fixed; border-collapse: collapse !important;'>
                <tbody style="">
                    <tr>
                        <td colspan="3" style="width: 75%;">
                            <h3 style="line-height: 20px; font-size: 21px; font-weight: 700; color: #020407; margin: 30px 0 0; font-family: 'Jost',sans-serif;">
                                Bundl Name: <?= $bundl_name ?>
                            </h3>
                            <h3 style="line-height: 20px; font-size: 21px; font-weight: 700; color: #020407; margin: 0; font-family: 'Jost',sans-serif;">
                                Project Name: <?= $order_details['project_name'] ?>
                            </h3>
                            <h3 style="line-height: 20px; font-size: 21px; font-weight: 700; color: #020407; margin: 0; font-family: 'Jost',sans-serif;">
                                Bundl No# <?= $order_details['id'] ?>
                            </h3>
                            <h3 style="line-height: 20px; font-size: 21px; font-weight: 700; color: #020407; margin: 0; font-family: 'Jost',sans-serif;">
                                Invoice Date: <?= date("F j, Y"); ?>
                            </h3>
                        </td>
                        <td colspan="1" style="vertical-align: top; width: 25%; padding-left: 10px;">
                            <div class='logo' style='margin-bottom: 10px; text-align: left;'>
                                <a href='https://wwww.bundldesigns.com/'>
                                    <img src='https://bundldesigns.com/assets_user/images/logo.jpg' alt='' style="width: 150px; min-width: 90px; max-width: 100%;">
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-body" style="padding: 0 2%;">
            <table style='width: 100%; table-layout: fixed; border-collapse: collapse !important;'>
            
                <tbody>
                    <tr>
                        <td colspan="3" style="vertical-align: top; width: 75%;">
                            <h3 style="line-height: 24px; font-size: 20px; font-weight: 700; color: #020407; margin: 0px 0px 16px; text-decoration: underline; font-family: 'Jost',sans-serif;">Invoice From:</h3>
                            <div style="">
                                <p style="margin: 0px 0px 0px; color: #020407; font-weight: 400; font-size: 18px; line-height: 18px;">Bundl Designs
                                </p>
                            </div>
                            <div style="">
                                <p style="margin: 0px 0px 0px;  color: #020407; font-weight: 400; font-size: 14px; line-height: 18px;">www.bundldesigns.com</p>
                            </div>
                            <div style="">
                                <p style="margin: 0px 0px 0px;  color: #020407; font-weight: 400; font-size: 14px; line-height: 18px;">info@bundldesigns.com</p>
                            </div>
                            <div style="">
                                <p style="margin: 0px 0px 0px;  color: #020407; font-weight: 400; font-size: 14px; line-height: 18px;">+(966) 54 775 4124</p>
                            </div>
                        </td>
                        <td colspan="1" style="width: 25%; padding-left: 10px; vertical-align: baseline;">
                            <h3 style="line-height: 24px; font-size: 18px; font-weight: 700; color: #020407; margin: 0px 0px 16px; text-decoration: underline; font-family: 'Jost',sans-serif;">Invoice To:</h3>
                            <div style="">
                                <p style="margin: 0px 0px 0px; color: #020407; font-weight: 400; font-size: 18px; line-height: 18px; font-family: 'Jost',sans-serif;"><?= $order_details['user_name'] ?>
                                </p>
                             </div>
                            <div style="">
                                <p style="margin: 0px 0px 0px;  color: #020407; font-weight: 400; font-size: 14px; line-height: 18px;"><?= $order_details['email'] ?></p>
                            </div>
                            <div style="">
                                <p style="margin: 0px 0px 0px;  color: #020407; font-weight: 400; font-size: 14px; line-height: 18px;"><?= $order_details['phone'] ?></p>
                            </div>
                        </td>

                    </tr>
                </tbody>

            </table>
        </div>

        <div class="table-body" style="padding: 24px 2% 10px;">
            <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: 2px solid #020407; width: 100%;">
                    <thead style="background: #141718;">
                        <tr style="background: #141718; padding: 0px 56px; font-weight: 600;">
                            <td style="width: 100%;">
                                <table class="items-detail"style="border-collapse: collapse; width: 100%; table-layout: fixed;">
                                    <tbody>
                                        <tr>
                                            <td style="line-height: 24px; font-size: 14px; font-weight: 400; color: #fff; width: 35%; border-right: 2px solid #020407; padding: 12px 3% 12px;">Item
                                            </td>
                                            <td style="line-height: 24px; font-size: 14px; font-weight: 400; color: #fff; width: 45%; border-right: 2px solid #020407; padding: 12px 3% 12px;">Quantity
                                            </td>
                                            <td style=" text-align: left; line-height: 24px; font-size: 14px; font-weight: 400; color: #fff; width: 20%; padding: 12px 3% 12px;">Item
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </thead>
                    <tbody><tr><td>
                    <?php foreach($order_summery as $key => $val) { ?>
                    <tr style="padding: 0px 56px; font-weight: 600;">
                        <td style="width: 100%;  padding: 0;">
                            <table class="items-detail"style="border-collapse: collapse; width: 100%; table-layout: fixed; border-bottom: 2px solid #020407;">
                                <tbody>
                                    <tr>
                                        <td style="line-height: 18px; font-size: 14px; font-weight: 700; font-family: 'Jost',sans-serif; color: #333333; width: 35%; border-right: 2px solid #020407; padding: 0 3%;">- <?= $category_arr[$key]; ?>
                                        </td>
                                        <td style="line-height: 18px; font-size: 14px; font-weight: 700; font-family: 'Jost',sans-serif; color: #333333; width: 45%; border-right: 2px solid #020407; padding: 0 3%;">
                                        </td>
                                        <td style=" text-align: left; line-height: 18px; font-size: 14px; font-weight: 700; font-family: 'Jost',sans-serif; color: #333333; width: 20%; padding: 0 3%;">
                                        </td>
                                    </tr>
                                    <?php foreach($val as $k => $v) { 
                                        if ($v['item_type'] != 'package') {
                                    ?>
                                        <tr>
                                            <td style="line-height: 18px; margin: 0; font-size: 14px; font-weight: 400; color: #333333; width: 35%; border-right: 2px solid #020407; padding: 0 3%; height: 1rem;"><?= $v['item_name']; ?>
                                            </td>
                                            <td style="line-height: 18px; margin: 0; font-size: 14px; font-weight: 400; color: #333333; width: 45%; border-right: 2px solid #020407; padding: 0 3%; height: 1rem;">1
                                            </td>
                                            <td style=" text-align: left; line-height: 18px; margin: 0; font-size: 14px; font-weight: 400; color: #333333; width: 20%; padding: 0 3%; height: 1rem;"><?= $v['subtotal_price']; ?> SAR
                                            </td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr style="padding: 0px 56px; font-weight: bold;">
                        <td style="width: 100%;  padding: 0;">
                            <table class="items-detail"style="border-collapse: collapse; width: 100%; table-layout: fixed;">
                                <tbody>
                                    <tr>
                                        <td style="line-height: 24px; font-size: 14px; font-weight: 700; color: #333333; width: 35%; border-right: 2px solid #020407; padding: 0 3%; font-family: 'Jost',sans-serif;"><?= ($bundl_name == 'Customized Bundl') ? 'Total' : $bundl_name; ?>
                                        </td>
                                        <td style="line-height: 24px; font-size: 14px; font-weight: 700; color: #333333; width: 45%; border-right: 2px solid #020407; padding: 0 3%; font-family: 'Jost',sans-serif;">
                                        </td>
                                        <td style=" text-align: left; line-height: 24px; font-size: 14px; font-weight: 700; font-family: 'Jost',sans-serif; color: #333333; width: 20%; padding: 0 3%;"><?= $response[0]->cart_amount; ?> SAR
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
            </td></tr></tbody></table>
        </div>

        <div class="table-footer" style="padding: 36px 2%;">
            <table style='width: 100%; table-layout: fixed; border-collapse: collapse !important;'>
            
                <tbody style="border-bottom: 1px solid #020407;">
                    <tr>
                        <td style="vertical-align: top; width: 55%;">
                            <h3 style="line-height: 30px; font-size: 20px; font-weight: 700; color: #5ccdbf; margin: 0; text-transform: uppercase; font-family: 'Jost',sans-serif;">payment details
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 0 0 20px;">
                            <h3 style="line-height: 24px; font-size: 18px; font-weight: 400; color: #020407; margin: 0px 0px 0px; font-style: italic;"><?= $response[0]->payment_info->card_type; ?> card <?= $response[0]->payment_info->card_scheme; ?>: <?= $response[0]->payment_info->payment_description; ?>
                            </h3>
                        </td>
                        <td style="width: 50%; padding: 0 0 20px;">
                            <h3 style="line-height: 30px; font-size: 26px; font-weight: 700; color: #020407; margin: 0px 0px 0px; text-decoration: underline; font-family: 'Jost',sans-serif;"><?= $response[0]->cart_amount; ?> SAR
                            </h3>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table style='width: 100%; table-layout: fixed; border-collapse: collapse !important;'>
                <tbody>
                    <tr>
                        <td style="text-align: center; padding: 50px 0 20px; font-size: 20px;
                        font-style: italic; color: #020407;">Have a question? <span style="font-size: 16px; font-weight: 700; color: #aa75ae; font-style: initial; font-family: 'Jost',sans-serif;">contact us</span></td>
                    </tr>
                    <tr>
                        <td style="font-size: 30px; font-weight: 700; color: #020407; text-align: center; text-transform: uppercase; padding-bottom: 20px; font-family: 'Jost',sans-serif;">stay connected</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding-bottom: 50px;">
                            <a href="https://www.facebook.com/bundldesigns/"><img style="width: auto; height: 25px; padding-right: 25px;" src="<?= base_url('assets_user/images/invoice/fb.png'); ?>"></a>
                            <a href="https://www.instagram.com/bundl_designs/"><img style="width: auto; height: 25px; padding-right: 25px;" src="<?= base_url('assets_user/images/invoice/insta.png'); ?>"></a>
                            <a href="https://www.linkedin.com/company/bundl-designs"><img style="width: auto; height: 25px; padding-right: 25px;" src="<?= base_url('assets_user/images/invoice/linked.png'); ?>"></a>
                            <a href="https://twitter.com/BundlDesigns"><img style="width: auto; height: 25px;" src="<?= base_url('assets_user/images/invoice/twitter.png'); ?>"></a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: 400; color: #020407; text-align: center; text-transform: uppercase; padding-bottom: 15px; border-bottom: 1px solid #020407;">مؤسسة هالة نبيل الحسيني لتقنية المعلومات الرياض، المملكة العربية السعودية رقم السجل: ١٠١٠٤٨١٨٧٣</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; text-transform: uppercase; padding: 40px 0 20px; font-size: 20px; font-weight: 700; font-family: 'Jost',sans-serif;">
                            <a style="color: #5ccdbf; text-decoration: none;" href="https://www.bundldesigns.com/">www.bundldesigns.com</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding: 0 0 100px; font-size: 16px; font-weight: 400;">
                            <img style="height: 15px; width: auto; padding: 1px 10px 0 0;" src="<?= base_url('assets_user/images/invoice/call.png'); ?>"><span>+(966) 543318362</span>
                            <img style="height: 15px; width: auto; padding: 1px 10px 0 30px;" src="<?= base_url('assets_user/images/invoice/email.png'); ?>"><span>info@bundldesigns.com</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html> 