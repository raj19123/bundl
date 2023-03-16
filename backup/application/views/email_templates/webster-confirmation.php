<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $notification['email_subject_'.$language] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <section class="order-section" style="padding: 50px 0px 70px 0px;border-bottom: 2px solid rgba(0, 0, 0, 0.5); max-width: 800px; margin: auto;">
        <div class="container" style=" max-width: 800px; margin: auto">
            <h2 style="text-align: center; border-bottom: 2px solid rgba(0, 0, 0, 0.5); padding-bottom: 20px; margin: 0px; font-size: 32px;
        font-weight: 700; font-family: 'Open Sans', sans-serif;"><?= $notification['email_subject_'.$language]; ?></h2>
            <p style="padding: 30px 0px 70px 0px; font-style: italic; font-size: 19px;     text-align: center;
        color: black; margin: 0; font-family: 'Open Sans', sans-serif;     line-height: 40px;"><?= $notification['email_body_'.$language] ?> </p>
    </section>
    <footer style="padding: 0px 0px 150px 0px;">
        <div class="container" style="max-width: 800px; margin: auto;">
            
            <div class="stay-connected" style="text-align:center; padding-top: 0px;">
                <h2 style="font-size: 32px; margin-bottom: 0; margin-top: 35px; font-family: 'Open Sans', sans-serif;font-weight: 700;"><?= strtoupper($this->lang->line('footer_stay_connected')); ?></h2>
                <ul class="connected" style=" text-align: center; list-style: none;padding-left: 0px;">
                     <li style="margin-right: 52px; display: inline-block;">
                        <a href="{facebook}"><img style="  height: 20px;" src="<?= base_url('assets_user/images/email_images/fb.png'); ?>" alt=""></a>
                    </li>
                    <li style="margin-right: 52px; display: inline-block;">
                        <a href="{instagram}"><img style=" height: 20px;" src="<?= base_url('assets_user/images/email_images/insta.png'); ?>" alt=""></a>
                    </li>
                    <li style="margin-right: 52px; display: inline-block;">
                        <a href="{linked_in}"><img style="height: 20px;" src="<?= base_url('assets_user/images/email_images/linkdin.png'); ?>" alt=""></a>
                    </li>
                    <li style="margin-right: 0px; display: inline-block;">
                        <a href="{twitter}"><img style=" height: 20px;" src="<?= base_url('assets_user/images/email_images/twitter.png'); ?>" alt=""></a>
                    </li>
                </ul>
            </div>

        </div>
    </footer>
</body>