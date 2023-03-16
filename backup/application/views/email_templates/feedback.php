<!DOCTYPE html>
<html lang="en">

<head>
    <title>Love To Get Feedback</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <section class="order-section" style="padding: 50px 0px 65px 0px;">
        <div class="container" style="max-width: 800px; margin: auto">
            <h2 style="text-align: center; border-bottom: 2px solid rgba(0, 0, 0, 0.5); padding-bottom: 20px; margin: 0px; font-size: 32px;
        font-weight: 700; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('we_love_to_get_your_feedback'); ?>
            </h2>
            <p style="padding: 30px 0px 40px 0px; font-style: italic; font-size: 25px;     text-align: center;
        color: black; margin: 0; font-family: 'Open Sans', sans-serif;     line-height: 45px;"><?= $notification['email_body_'.$language] ?>
            </p>
            <div style="text-align: center;">
                <?php if ($language == 'english') : ?>
                    <a href="{btn_link}" style=" border: 1px solid black; text-decoration: none; color: black; padding: 1px 40px; letter-spacing: 5px;font-weight: 600;font-size: 14px; background: none; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('send_feedback'); ?></a>
                <?php else: ?>
                    <a href="{btn_link}" style=" border: 1px solid black; text-decoration: none; color: black; padding: 1px 40px; letter-spacing: 0px;font-weight: 600;font-size: 14px; background: none; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('send_feedback'); ?></a>
                <?php endif; ?>
            </div>



    </section>
    <footer style="padding: 0px 0px 150px 0px;">
        <div class="container" style="max-width: 800px; margin: auto;">
            <h2 style="text-align: center; border-bottom: 1.5px solid rgba(0, 0, 0, 0.5); padding-bottom: 25px; margin: 0px; font-size: 28px;
            font-weight: 400;font-family: 'Open Sans', sans-serif; font-style: italic;"><?= $this->lang->line('have_a_question'); ?>
                <a href="{contact_url}" style="font-size: 24px; letter-spacing: -1.5px; font-weight: 600; font-family: 'Open Sans', sans-serif; text-decoration: none !important; font-style: normal; font-weight: 600; color: #ae74a1;" target="_blank"><?= $this->lang->line('footer_contectus_li'); ?></a>
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