<footer>
    <?php $settings = $this->db->get('settings')->row_array(); ?>
    <div class="container">
        <div class="social-icons">
            <!-- <h4>stay connected</h4> -->
            <h4><?= $this->lang->line('footer_stay_connected'); ?></h4>
            <ul>
                <li>
                    <a href="<?= $settings['facebook']; ?>" target="_blank">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="<?= $settings['instagram']; ?>" target="_blank">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
                <li>
                    <a href="<?= $settings['linked_in']; ?>" target="_blank">
                        <i class="fa fa-linkedin"></i>
                    </a>
                </li>
                <li>
                    <a href="<?= $settings['twitter']; ?>" target="_blank">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="newsletter">
            <!-- <h5>SIGN UP FOR OUR NEWLETTER</h5> -->
            <h5><?= $this->lang->line('footer_signup'); ?></h5>
            
            <form class="contact-form">
                <div class="form-group with-icon">
                    <input type="text" id="newsemail" name="email-newsletter" class="form-control" placeholder="<?= $this->lang->line('footer_placeholder_email'); ?>">
                    <span class="icon email"></span>
                    <ul class="email-error"></ul>
                </div>
                <div class="button-row">
                    <button type="submit" id="newsletter" class="btn btn-default"><?= $this->lang->line('footer_signup_btn'); ?></button>
                    <div class="proceed-text" id="newsletterMsg" style="display: none;">
                        <!-- <h4>YOU ARE SUCCESSFULLY SIGN UP FOR NEWSLETTER</h4> -->
                        <h4><?= $this->lang->line('newsletter'); ?></h4>
                    </div>
                </div>
            </form>
        </div>

        <div class="customer-help">
            <div class="row">
                <div class="col-4">
                    <div class="block">
                        <div class="icon">
                            <img src="<?= base_url(); ?>assets_user/images/customer-care.png" alt="">
                        </div>
                        <h5><?= $this->lang->line('footer_customer_care'); ?></h5>
                        <ul>
                            <li>
                                <a href="<?= base_url('contact-us'); ?>"><?= $this->lang->line('footer_contectus_li'); ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('faqs'); ?>"><?= $this->lang->line('footer_faq_li'); ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('careers'); ?>"><?= $this->lang->line('footer_careers_li'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-4">
                    <div class="block">
                        <div class="icon">
                            <img src="<?= base_url(); ?>assets_user/images/dashboard-icon.png" alt="">
                        </div>
                        <h5><?= $this->lang->line('footer_dashbord'); ?></h5>
                        <ul>
                            <li>
                                <a href="<?= base_url('profile'); ?>"><?= $this->lang->line('footer_profile_li'); ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('feedback'); ?>"><?= $this->lang->line('footer_feedback_li'); ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('recommend'); ?>"><?= $this->lang->line('footer_recomend_us'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-4">
                    <div class="block">
                        <div class="icon">
                            <img src="<?= base_url(); ?>assets_user/images/information-icon.png" alt="">
                        </div>
                        <!-- <h5>INFORMATION</h5> -->
                        <h5><?= $this->lang->line('footer_information'); ?></h5>
                        <ul>
                            <li>
                                <a href="<?= base_url('about'); ?>"><?= $this->lang->line('footer_aboutus_li'); ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('terms-and-conditions'); ?>"><?= $this->lang->line('footer_terms_condition'); ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('legal'); ?>"><?= $this->lang->line('footer_legal'); ?></a>
                            </li>
							 <li>
                                <a href="https://bundldesigns.com/privacy-policy"><?= $this->lang->line('footer_legal_pp'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <!-- <p>2019 Bundl, All rights reserved. Site by <a href="https://appliconsoft.com/" target="_blank"> Applicon Soft</a></p> -->
        <p><?= date('Y'); ?> <?= $this->lang->line('footer_slogan'); ?></p>
    </div>
</footer>

<!--Login Modal -->
<div id="login-modal" class="modal fade login-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body">
                <div class="sign-in">
                    <!-- <h3>SIGN-IN USING</h3> -->
                    <h3><?= $this->lang->line('login_page'); ?></h3>
                    
                    <ul class="social-btns">
                        <li>
                            <a href="#" id="gLogin">
                                <i class="fa fa-google"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="fbLogin">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="separator">
                        <span><?= $this->lang->line('login_or'); ?></span>
                    </div>
                        
                        <?php if($this->session->flashdata('error_login')){ ?>
                            <div id="error-register" class="text-danger border-message valid-error">
                                <strong><?= $this->lang->line('error'); ?></strong> <?= $this->session->flashdata('error_login'); ?>
                            </div>
                        <?php } ?>
                        

                        <!-- <?php //if($this->session->flashdata('register')){ ?>
                            <div id="error-register" class="text-danger border-message">
                                <strong>Message!</strong> <?php //$this->session->flashdata('register'); ?>
                            </div>
                        <?php //} ?> -->

                        <?php if($this->session->flashdata('success_login')){ ?>
                            <div class="text-success border-message valid-error">
                                <strong><?= $this->lang->line('success'); ?></strong> <?= $this->session->flashdata('success_login'); ?>
                            </div>
                        <?php } ?>

                    <form method="post" id="signin" action="<?= base_url('login'); ?>"  autocomplete="off">
                        <div class="form-group with-icon">
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?= $this->lang->line('footer_placeholder_email'); ?>" autocomplete="off">
                            <span class="icon email"></span>
                            <!-- <ul class="valid-error"></ul> -->
                            <span class="msg-label valid-error"></span>
                        </div>
                        <div class="form-group with-icon">
                            <input type="password" name="password" id="password" class="form-control" placeholder="<?= $this->lang->line('placeholder_password'); ?>" autocomplete="off">
                            <span class="icon lock"><i class="fa fa-lock"></i></span>
                            <!-- <ul class="valid-error"></ul> -->
                            <span class="msg-label valid-error"></span>
                        </div>
                        <div class="button-row">
                            <button type="submit" id="login"  class="btn btn-default"><?= $this->lang->line('login_signin_btn'); ?></button>
                        </div>
                    </form>
                    <div class="action-row">
                        <a href="<?= base_url('forgot-password'); ?>" class="action-link"><?= $this->lang->line('login_fordot_pass_link'); ?></a>
                        <a href="#" class="show-register"><?= $this->lang->line('login_register_link'); ?></a>
                    </div>
                    <!-- <a href="<?= base_url('forgot-password'); ?>" class="action-link">< FORGOT PASSWORD ></a> -->
                </div>
                <div class="register">
                    <!-- <?php //if($this->session->flashdata('error')){ ?>
                        <div id="error-register valid-error" class="text-purple border-message">
                            <strong>Error!</strong> <?php //$this->session->flashdata('error'); ?>
                        </div>
                    <?php //} ?> -->
                    

                    <!-- <?php //if($this->session->flashdata('register')){ ?>
                        <div id="error-register" class="text-purple border-message">
                            <strong>Message!</strong> <?php //$this->session->flashdata('register'); ?>
                        </div>
                    <?php //} ?> -->

                    <!-- <?php //if($this->session->flashdata('success')){ ?>
                        <div class="text-success border-message valid-error">
                            <strong>Success!</strong> <?php //$this->session->flashdata('success'); ?>
                        </div>
                    <?php //} ?> -->
                    <form method="post" id="register" action="<?= base_url('register'); ?>">
                        <div class="form-group with-icon">
                            <input type="text" 
                                name="full_name" 
                                id="full_name"
                                value="<?= isset($register) ? $register['full_name'] : ''; ?>" 
                                class="form-control" 
                                placeholder="<?= $this->lang->line('contactus_name'); ?>">
                            <span class="icon name">
                            </span>
                            <ul class="valid-error"></ul>
                        </div>
                        <div class="form-group with-icon">
                            <input type="email"
                                id="register-email" 
                                name="email" 
                                value="<?= isset($register) ? $register['email'] : ''; ?>"
                                class="form-control" 
                                placeholder="<?= $this->lang->line('footer_placeholder_email'); ?>">
                            <span class="icon email">
                            </span>
                            <ul class="valid-error"></ul>
                        </div>
                        <div class="form-group with-icon">
                            <input type="tel" 
                                name="phone" 
                                id="register-phone" 
                                class="form-control phoneMask"
                                maxlength="11"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            <span class="icon phone"></span>
                        </div>
                        <!-- <div class="form-group with-icon">
                            <input type="text" 
                                name="phone"
                                id="phone"
                                value="<?= isset($register) ? $register['phone'] : ''; ?>" 
                                class="form-control" 
                                placeholder="+( )">
                            <span class="icon phone">
                            </span>
                            <ul class="valid-error"></ul>
                        </div> -->
                        <div class="form-group with-icon">
                            <input type="password" 
                                name="password"
                                id="rpassword"
                                value="<?= isset($register) ? $register['password'] : ''; ?>" 
                                class="form-control" 
                                placeholder="<?= $this->lang->line('placeholder_password'); ?>">
                            <span class="icon lock">
                                <i class="fa fa-lock"></i>
                            </span>
                            <ul class="valid-error"></ul>
                        </div>

                        <div class="form-group with-icon payment-form">
                            <select name="language" id="id-language" class="selectpicker">
                                <option value="english" selected="">English</option>
                                <option value="arabic">Arabic</option>
                            </select>
                            <span class="icon font-icon">
                                <i class="fas fa-language"></i>
                            </span>
                        </div>

                        <div class="form-group with-icon payment-form">
                            <script type="text/javascript" language="JavaScript">
                              // Callback to get the button working.
                              function enableBtn1(){
                                document.getElementById("sbmt-register").disabled = false;
                              }

                              // Call to rendor the captcha
                              var recaptcha1;
                              var myCallBack = function() {
                                //Render the recaptcha1 on the element with ID "recaptcha1"
                                recaptcha1 = grecaptcha.render('recaptcha1', {
                                  'sitekey' : '6LeAPiMcAAAAAFhiepNjIngjJbs4BWb9zpUkHJl4', // production
                                  'theme' : 'light', // can also be dark
                                  'callback' : 'enableBtn1' // function to call when successful verification for button 1
                                });    
                              };
                            </script>
                            <div class="g-recaptcha" id="recaptcha1" data-sitekey="6LeAPiMcAAAAAFhiepNjIngjJbs4BWb9zpUkHJl4"></div>
                        </div>

                        <div class="button-row">
                            <button type="submit" id="sbmt-register" class="btn btn-default"><?= $this->lang->line('register_btn'); ?></button>
                            <span class="back-link"><?= $this->lang->line('back_to_login_link'); ?></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Facebook login functionality
    // Facebook JS SDK configurations
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '489006768555190',
            cookie     : true,   // Enable cookies to allow the server to access the session.
            xfbml      : true,   // Parse social plugins on this webpage.
            version    : 'v9.0'  // Use this Graph API version for this call.
        });

        /*FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', {fields: 'email,id,name'}, function(response) {
                    socialLogin(response);
                });
            }
        });*/
    };

    // Load the Facebook JS SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function facebookLogin() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', {fields: 'email,id,name'}, function(response) {
                    socialLogin(response);
                });
            } else {
                FB.login(function(response) {
                    FB.api('/me', {fields: 'email,id,name'}, function(response) {
                        socialLogin(response);
                    });
                }, {
                    scope: 'email',
                    return_scopes: true
                });
            }
        });
    }

    function socialLogin(userProfile) {
        //console.log(userProfile);
        if( ! userProfile.login_with){
            userProfile.login_with = 'facebook';
        }

        if(userProfile.id){
            $.ajax({
                type: 'post',
                url: '<?= base_url('social-login'); ?>',
                data: userProfile,
                success: function(msg){
                    //console.log(msg);
                    if(IsJsonString(msg)){
                        var resp = JSON.parse(msg);
                        //console.log(resp);
                        window.location.replace(resp.return_url);
                    }
                }
            });
        }
    }

    function IsJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    $('#fbLogin').on('click', function(event){
        event.preventDefault();
        facebookLogin();
    });

</script>

<!-- Google Login -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
    //Client ID:  708496813660-tecmdb0d1np91tehnlaanjbjv2t847lf.apps.googleusercontent.com 
    //Client Secret:  WdQQrepproSoViq6ChSYFzS2
    function googleLogin() {
        gapi.load('auth2', function() {
            auth2 = gapi.auth2.init({
                client_id: '708496813660-tecmdb0d1np91tehnlaanjbjv2t847lf.apps.googleusercontent.com',
                fetch_basic_profile: true
            });

            auth2.signIn().then(function() {
                if (auth2.isSignedIn.get()) {
                    var profile = auth2.currentUser.get().getBasicProfile();
                    var googleUser = {
                        id: profile.getId(),
                        name: profile.getName(),
                        email: profile.getEmail(),
                        dp: profile.getImageUrl(),
                        login_with: 'google'
                    }
                    socialLogin(googleUser);
                }
            });
        });
    }

    $('#gLogin').on('click', function(event){
        event.preventDefault();
        googleLogin();
    });

</script>


<script type="text/javascript">
$(document).ready(function(){
    //PhoneMask functionality
    
    $(document).ready(function(){
        $("#register-phone").intlTelInput({
            allowDropdown: true,
            autoPlaceholder: "polite",
            placeholderNumberType: "MOBILE",
            formatOnDisplay: true,
            separateDialCode: true,
            nationalMode: false,
            autoHideDialCode: true,
            preferredCountries: [ "sa", "ae" ]
        });
        //$("#register-phone").intlTelInput("setNumber", "+96651234569");
    });



    // login functionality
    $('#login').on('click', function(event) {
        event.preventDefault();

        var errorMsg = "<?= $this->lang->line('this_value_is_required'); ?>";
        var errorClass = ".valid-error";
        var e;

        e = $('#email');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }

        if( ! isEmail(e.val())){
            e.focus().parent().find(errorClass).html("<?= $this->lang->line('email_is_not_valid'); ?>").addClass('text-purple').show();
            return false;
        }

        e = $('#password');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }

        $(this).text("<?= $this->lang->line('sending') ?>").attr('disabled',true);
        $('#signin').submit();
    });

    // email validation function
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    // registration functionality
    $('#sbmt-register').on('click', function(event) {
        event.preventDefault();

        var errorMsg = "<?= $this->lang->line('this_value_is_required'); ?>";
        var errorClass = ".valid-error";
        var e;

        e = $('#full_name');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }

        e = $('#register-email');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }

        if( ! isEmail(e.val())){
            e.focus().parent().find(errorClass).html("<?= $this->lang->line('email_is_not_valid'); ?>").addClass('text-purple').show();
            return false;
        }

        e = $('#register-phone');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }else{
            e.val($("#register-phone").intlTelInput('getNumber'));
        }

        e = $('#rpassword');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }

        $(this).text('Sending').attr('disabled',true);
        $('#register').submit();
    });

    $('#newsletter').on('click', function(event){
        event.preventDefault();

        e = $('#newsemail');

        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            return false;
        }

        e.siblings('.email-error').html('');
        if( ! isEmail(e.val())){
            e.focus().siblings('.email-error').html('<?= $this->lang->line('email_is_not_valid'); ?>').addClass('text-purple').show();
            return false;
        }


        var btn = $(this);
        var form = btn.closest('form');
        var data = form.serializeArray();
        //console.log(data);
        btn.hide();

        $.ajax({
            type: 'post',
            url: '<?= base_url('news-letter'); ?>',
            data: data,
            success: function(msg){
                console.log(msg);
                if(msg == 'success'){
                    $('#newsletterMsg').show();
                    setTimeout(function() {
                        window.location.reload();
                    }, 5000);
                }else{
                    window.location.reload();
                }
            }
        });

    });

    // form validation procedure
    $("form").on("submit", function(event){
        event.preventDefault();

        //debugger;

        var form = $(this)[0];
        console.log(form);
        //var selectedElements = $(".validThis");
        var selectedElements = $(this).find(".validThis");
        console.log(selectedElements);
        var validation = false;
        var errorMsg = "<?= $this->lang->line('this_value_is_required'); ?>";
        var errorClass = ".valid-error";
        var e;

        if(selectedElements.length == 0){
            form.submit();
        }else{
            if (form.checkValidity()) {
                selectedElements.each(function(){
                    e = $(this);
                    if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
                        e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
                        validation = false;
                        return false;
                    }else{
                        validation = true;
                        e.parent().find(errorClass).html('').hide();
                    }
                });
                if (validation == true) {
                    form.submit();
                }
            }else{
                alert("<?= $this->lang->line('all_enable_fields_required'); ?>");
            }   
        }   
    });
});

window.setTimeout(function(){
    $(".alert,.border-message").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 10000);

$("input,select,textarea,radio,checkbox").on("change input keyPress click", function(){
    $(".valid-error, .showme, .measurement-error").html('');
});

</script>


<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit"  async defer></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        document.getElementById("sbmt-register").disabled = true; 
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-207866473-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-207866473-1');
gtag('config', 'AW-1016242822');
</script>
</body>
</html>