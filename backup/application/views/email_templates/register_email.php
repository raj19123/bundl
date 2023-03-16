<!DOCTYPE html>
<html lang="en">

<head>
    <title>Email Template</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <section class="welcome-banner" style="padding: 50px 0px 50px 0px;">
        <div class="container" style="max-width: 800px; margin: auto">
            <h2 style="text-align: center; border-bottom: 2px solid rgba(0, 0,0,0.5); padding-bottom: 20px; margin: 0px; font-size: 32px;
            font-weight: 700; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('welcome_to_bundl'); ?></h2>
            <p style="padding: 36px 0px 30px 0px; font-style: italic; font-size: 22px;     text-align: center;
            color: black; margin: 0; font-family: 'Open Sans', sans-serif;"><?= $notification['email_body_'.$language] ?></p>
            <div style="text-align: center; padding-bottom: 50px;">
                <?php if ($language == 'english') : ?>
                    <a href="{link_activation}" style="border: 1px solid black; text-decoration: none; padding: 1px 58px; color: black; text-align: center; letter-spacing: 8px;font-weight: 600;font-size: 14px; background: none; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('confirm'); ?></a>
                <?php else: ?>
                    <a href="{link_activation}" style="border: 1px solid black; text-decoration: none; padding: 1px 58px; color: black; text-align: center; letter-spacing: 0px;font-weight: 600;font-size: 14px; background: none; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('confirm'); ?></a>
                <?php endif; ?>
            </div>
            <p style="text-align: center; font-weight: 400; font-style: italic;font-size: 21px; font-family: 'Open Sans', sans-serif;"><?= $this->lang->line('your_username_is'); ?>: {email}</p>
            <p style="text-align: center;">
                <!-- <a href="#" style="color: #6ec3bd; text-decoration: none; font-weight: 900;font-size: 17px; font-family: 'Open Sans', sans-serif;">
                    < &nbsp; &nbsp; GET YOUR PROJECT STARTED &nbsp; &nbsp;>
                </a> -->
            </p>
            <div style="text-align: center;">
                <h3 style="font-size: 22px; font-family: 'Open Sans', sans-serif; text-align: center;  padding-bottom: 10px; margin-bottom: 40px; margin-top: 60px; display: inline-block; text-align: center; border-bottom: 1px solid #000; margin-bottom: 60px;"><?= $this->lang->line('what_the_next'); ?> </h3>
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
    <footer style="padding: 0px 0px 70px 0px;">
        <div class="container" style="max-width: 800px; margin: auto;">
            <h2 style="text-align: center; border-bottom: 2px solid rgba(0, 0,0,0.5); padding-bottom: 25px; margin: 0px; font-size: 28px;
            font-weight: 400;font-family: 'Open Sans', sans-serif; font-style: italic;"><?= $this->lang->line('have_a_question'); ?>
                <a href="{contact_url}" style="font-size: 24px; letter-spacing: -1.5px; font-weight: 600; font-family: 'Open Sans', sans-serif; font-style: normal; text-decoration: none !important; font-weight: 600; color: #ae74a1;" target="_blank"><?= $this->lang->line('footer_contectus_li'); ?></a>
            </h2>
            <div class="stay-connected" style="text-align:center; padding-top: 0px;">
                <h2 style="font-size: 32px; margin-bottom: 0; margin-top:35px; font-family: 'Open Sans', sans-serif;font-weight: 700;"><?= strtoupper($this->lang->line('footer_stay_connected')); ?></h2>
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
            <!-- <form style="text-align: center; padding-top: 0px;">
                <h3 style="font-size: 30px; font-weight: 700; font-family: 'Open Sans', sans-serif; color: #6ec3bd; margin-bottom: 0px; margin-top: 55px; letter-spacing: 0px;">SIGN UP FOR OUR NEW LETTER</h3>
                <div class="wrap" style="display: flex; justify-content: left;align-items: baseline; width: 56%;margin: auto; padding-top: 15px; border-bottom: 2px solid black;">
                    <img style="width: 20px; margin-right: 25px;" src="<?= base_url('assets_user/images/email_images/envelop.png'); ?>" alt="">
                    <input type="text" value="example@mail.com" style="width: 50%; color: #ccc; font-size: 16px; padding-bottom: 5px; background: none; border: none; box-shadow: none; outline: none;">
                </div>
                <button style="font-style: normal; font-family: 'Open Sans', sans-serif; border: 1px solid black;  width: 30%; letter-spacing: 5px;font-weight: 600;font-size: 14px;
                background: none; margin-top: 35px;">SIGN UP</button>
            </form> -->
        </div>
    </footer>
</body>

</html>