<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">
  /* FONTS */
    @media screen {
    @font-face {
      font-family: 'Lato';
      font-style: normal;
      font-weight: 400;
      src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
    }
    
    @font-face {
      font-family: 'Lato';
      font-style: normal;
      font-weight: 700;
      src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
    }
    
    @font-face {
      font-family: 'Lato';
      font-style: italic;
      font-weight: 400;
      src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
    }
    
    @font-face {
      font-family: 'Lato';
      font-style: italic;
      font-weight: 700;
      src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
    }
    }
    
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; }

    /* RESET STYLES */
    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
    table { border-collapse: collapse !important; }
    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body style="background-color: #fff; margin: 0 !important; padding: 0 !important;">

<!-- HIDDEN PREHEADER TEXT -->


<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    
    <!-- HERO -->
    
    <!-- F BLOCK -->
    <tr>
        <td bgcolor="#fff" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="480">
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                  <h5>{coupon}</h5>
                  <p style="margin: 0;" >
                    <?php 
                      echo $this->lang->line("special_coupon_email_body");
                    ?>
                </td>
              </tr>
              <!-- BULLETPROOF BUTTON -->
              <?php if(isset($btn) && $btn == true): ?>
              <tr>
                <td bgcolor="#ffffff" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                              <td align="center" bgcolor=""><a href="{btn_link}" target="_blank" style="font-family: 'Gotham-medium' , 'Frutiger-regular'; font-size: 16px; color: #fff; background: #69c0ba; padding: 11px 32px; text-decoration: none; text-align: center; border-radius: 0; line-height: 1; border: 2px solid transparent;">{btn_text}</a></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <?php endif; ?>
            </table>
        </td>
    </tr>
    <!-- COPY CALLOUT -->
    <?php if(isset($btn) && $btn == true): ?>
      <tr>
          <td bgcolor="#fff" align="center" style="padding: 0px 10px 0px 10px;">
              <table border="0" cellpadding="0" cellspacing="0" width="480" >
                  <!-- HEADLINE -->
                  <tr>
                    <td bgcolor="" align="left" style="background: #E2D640;  padding: 40px 30px 20px 30px; color: #000; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                      <h2 style="font-size: 24px; font-weight: 400; margin: 0; color: #000">Unable to click on the button above?</h2>
                    </td>
                  </tr>
                  <!-- COPY -->
                  <tr>
                    <td bgcolor="" align="left" style="background:  #E2D640; padding: 0px 30px 20px 30px; color: #000; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                      <p style="margin: 0; color: #000">Click on the link below or copy/paste in the address bar.</p>
                    </td>
                  </tr>
                  <!-- COPY -->
                  <tr>
                    <td bgcolor="" align="left" style="background:  #E2D640; padding: 0px 30px 40px 30px; border-radius: 0px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                      <p style="margin: 0;"><a href="{btn_link}" target="_blank" style="color: blue;">{btn_link}</a></p>
                    </td>
                  </tr>
              </table>
          </td>
      </tr>
    <?php endif; ?>
    <!-- SUPPORT CALLOUT -->
    <tr>
        <td bgcolor="#fff" align="center" style="padding: 30px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="480" >
                <!-- HEADLINE -->
                <tr>
                  <td bgcolor="" align="center" style="background: #69c0ba; padding: 30px 30px 30px 30px; border-radius: 0; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                    <h2 style="font-size: 20px; font-weight: 400; color: #fff; margin: 0;">Need more help?</h2>
                    <p style="margin: 0;"><a href="<?= base_url('faqs'); ?>" target="_blank" style="color: #fffF;">We&rsquo;re here, ready to talk</a></p>
                  </td>
                </tr>
            </table>
        </td>
    </tr>

</table>

</body>
</html>