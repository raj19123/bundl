<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



/*
| -------------------------------------------------------------------------
| ADMIN SIDE ROUTES
| -------------------------------------------------------------------------
*/

// Admin side login routes
$route['admin'] = 'admin/user/index';
$route['admin/login'] = 'admin/user/login';
$route['admin/logout'] = 'admin/user/logout';

// Admin side profile management routes
$route['admin/profile'] = 'admin/Dashboard/profile';
$route['admin/profile/update'] = 'admin/Dashboard/update_profile';
$route['admin/profile/password'] = 'admin/Dashboard/password';
$route['admin/profile/password/update'] = 'admin/Dashboard/update_password';

// Admin side dashboard routes
$route['admin/dashboard'] = 'admin/Dashboard/index';


// Admin Design CRUD URLs
$route['admin/design'] = 'admin/Design/index';
$route['admin/design/add'] = 'admin/Design/add';
$route['admin/design/delete'] = 'admin/Design/delete';
$route['admin/design/edit/(:any)'] = 'admin/Design/edit/$1';
$route['admin/design/update'] = 'admin/Design/update';

// Admin Design Categories CRUD URLs
$route['admin/design/categories'] = 'admin/Design/cats_list';
$route['admin/design/categories/add'] = 'admin/Design/cats_add';
$route['admin/design/categories/edit/(:any)'] = 'admin/Design/cats_edit/$1';
$route['admin/design/categories/update'] = 'admin/Design/cats_update';
$route['admin/design/categories/delete'] = 'admin/Design/delete';

// Admin Design Questionnaire URLs
$route['admin/design/questionnaire/(:any)'] = 'admin/design/show_questionnaire/$1';
$route['admin/design/add-questionnaire'] = 'admin/design/add_questionnaire';
$route['admin/design/update-questionnaire'] = 'admin/design/update_questionnaire';

// Admin Design Adjustments URLs
$route['admin/design/adjustments/(:any)'] = 'admin/design/show_adjustments/$1';
$route['admin/design/add-adjustments'] = 'admin/design/add_adjustments';
$route['admin/design/remove-adjustments/(:any)/(:any)'] = 'admin/design/remove_adjustments/$1/$2';

// Admin Package CRUD URLs
$route['admin/package'] = 'admin/Package/index';
$route['admin/package/add'] = 'admin/Package/add';
$route['admin/package/delete'] = 'admin/Package/delete';
$route['admin/package/edit/(:any)'] = 'admin/Package/edit/$1';
$route['admin/package/update'] = 'admin/Package/update';

// Admin Package Categories CRUD URLs
$route['admin/package/categories'] = 'admin/Package/cats_list';
$route['admin/package/categories/add'] = 'admin/Package/cats_add';
$route['admin/package/categories/edit/(:any)'] = 'admin/Package/cats_edit/$1';
$route['admin/package/categories/update'] = 'admin/Package/cats_update';
$route['admin/package/categories/delete'] = 'admin/Package/delete';

// Admin Package Components CRUD URLs
$route['admin/package/components'] = 'admin/Package/components_list';
$route['admin/package/components/add'] = 'admin/Package/components_add';
$route['admin/package/components/edit/(:any)'] = 'admin/Package/components_edit/$1';
$route['admin/package/components/update'] = 'admin/Package/components_update';
$route['admin/package/components/delete/(:any)'] = 'admin/Package/components_delete/$1';
$route['admin/package/components/add-designs/(:any)'] = 'admin/Package/add_designs/$1';
$route['admin/package/components/update-designs'] = 'admin/Package/update_designs';
$route['admin/package/components/remove-designs/(:any)/(:any)'] = 'admin/Package/remove_designs/$1/$2';

// Admin Email Templates CRUD URLs
$route['admin/email'] = 'admin/Email_Templates/index';
$route['admin/email/add'] = 'admin/Email_Templates/add';
$route['admin/email/delete/(:any)'] = 'admin/Email_Templates/delete/$1';
$route['admin/email/edit/(:any)'] = 'admin/Email_Templates/edit/$1';
$route['admin/email/update'] = 'admin/Email_Templates/update';

// Admin Coupon CRUD URLs
$route['admin/coupon'] = 'admin/Coupon/index';
$route['admin/coupon/add'] = 'admin/Coupon/add';
$route['admin/coupon/delete'] = 'admin/Coupon/delete';
$route['admin/coupon/edit/(:any)'] = 'admin/Coupon/edit/$1';
$route['admin/coupon/update'] = 'admin/Coupon/update';

// Admin Users control CRUD URLs
$route['admin/users'] = 'admin/Users/index';
$route['admin/update_request'] = 'admin/Users/update_request';
$route['admin/users/block/(:any)'] = 'admin/Users/block/$1';
$route['admin/users/unblock/(:any)'] = 'admin/Users/unblock/$1';
//$route['admin/users/add'] = 'admin/Users/add';
//$route['admin/users/delete/(:any)'] = 'admin/Users/delete/$1';
//$route['admin/users/edit/(:any)'] = 'admin/Users/edit/$1';
//$route['admin/users/update'] = 'admin/Users/update';

// Admin Orders control CRUD URLs
$route['admin/orders'] = 'admin/orders/index';
$route['admin/orders/feedback'] = 'admin/orders/client_feedback';
$route['admin/orders/detail/(:any)'] = 'admin/orders/detail/$1';
$route['admin/orders/complete/(:any)'] = 'admin/orders/complete_order/$1';
$route['admin/orders/transaction/(:any)'] = 'admin/orders/transaction_log/$1';
$route['admin/orders/item_complete/(:any)'] = 'admin/orders/complete_order_items/$1';
$route['admin/orders/item/(:any)'] = 'admin/orders/view_item/$1';
$route['admin/orders/item_update/(:any)'] = 'admin/orders/view_item_update/$1';
$route['approve-item-admin/(:any)/(:any)'] = 'admin/orders/approve_item_by_admin/$1/$2';
//$route['admin/orders/block/(:any)'] = 'admin/orders/block/$1';
//$route['admin/orders/unblock/(:any)'] = 'admin/orders/unblock/$1';
//$route['admin/orders/add'] = 'admin/orders/add';
//$route['admin/orders/delete/(:any)'] = 'admin/orders/delete/$1';
//$route['admin/orders/edit/(:any)'] = 'admin/orders/edit/$1';
//$route['admin/orders/update'] = 'admin/orders/update';
$route['admin/orders/delivery-files'] = 'admin/orders/delivery_files';
$route['admin/orders/download-questionnaire'] = 'admin/orders/pdfdoc';

// Admin Adjustments control CRUD URLs
$route['admin/adjustments'] = 'admin/adjustments/index';
$route['admin/adjustments/add'] = 'admin/adjustments/add';
$route['admin/adjustments/delete'] = 'admin/adjustments/delete';
$route['admin/adjustments/edit/(:any)'] = 'admin/adjustments/edit/$1';
$route['admin/adjustments/update'] = 'admin/adjustments/update';

// Admin Projects CRUD URLs
$route['admin/projects'] = 'admin/projects/index';
$route['admin/projects/add'] = 'admin/projects/add';
$route['admin/projects/delete'] = 'admin/projects/delete';
$route['admin/projects/edit/(:any)'] = 'admin/projects/edit/$1';
$route['admin/projects/update'] = 'admin/projects/update';
$route['admin/projects/files-upload'] = 'admin/projects/project_files';
$route['admin/projects/delete-image'] = 'admin/projects/delete_project_image';
$route['admin/projects/hero-image/(:any)'] = 'admin/projects/hero_image/$1';
$route['admin/projects/update-hero-image'] = 'admin/projects/update_hero_image';

// Admin Careers CRUD udm_clear_search_limits(agent)
$route['admin/careers'] = 'admin/careers/index';
$route['admin/careers/add'] = 'admin/careers/add';
$route['admin/careers/delete'] = 'admin/careers/delete';
$route['admin/careers/edit/(:any)'] = 'admin/careers/edit/$1';
$route['admin/careers/update'] = 'admin/careers/update';
$route['admin/careers/applications'] = 'admin/careers/application_list';
$route['admin/careers/applications/delete'] = 'admin/careers/delete';

// Admin FAQs CRUD URLs
$route['admin/faqs'] = 'admin/faqs/index';
$route['admin/faqs/add'] = 'admin/faqs/add';
$route['admin/faqs/delete'] = 'admin/faqs/delete';
$route['admin/faqs/edit/(:any)'] = 'admin/faqs/edit/$1';
$route['admin/faqs/update'] = 'admin/faqs/update';

// Admin FAQs Categories CRUD URLs
$route['admin/faqs/categories'] = 'admin/faqs/cats_list';
$route['admin/faqs/categories/add'] = 'admin/faqs/cats_add';
$route['admin/faqs/categories/edit/(:any)'] = 'admin/faqs/cats_edit/$1';
$route['admin/faqs/categories/update'] = 'admin/faqs/cats_update';
$route['admin/faqs/categories/delete'] = 'admin/faqs/delete';

$route['admin/settings'] = 'admin/settings/index';
$route['admin/settings/update'] = 'admin/settings/update';
$route['admin/settings/social-update'] = 'admin/settings/social_update';

// Admin Terms and Conditions CRUD URLs
$route['admin/terms'] = 'admin/Terms_Conditions/index';
$route['admin/terms/add'] = 'admin/Terms_Conditions/add';
$route['admin/terms/delete'] = 'admin/Terms_Conditions/delete';
$route['admin/terms/edit/(:any)'] = 'admin/Terms_Conditions/edit/$1';
$route['admin/terms/update'] = 'admin/Terms_Conditions/update';

// Admin About Us CRUD URLs
$route['admin/about/edit'] = 'admin/About_Us/edit';
$route['admin/about/update'] = 'admin/About_Us/update';

// Admin Privacy Policy CRUD URLs
$route['admin/privacy'] = 'admin/Privacy_Policy/index';
$route['admin/privacy/add'] = 'admin/Privacy_Policy/add';
$route['admin/privacy/delete'] = 'admin/Privacy_Policy/delete';
$route['admin/privacy/edit/(:any)'] = 'admin/Privacy_Policy/edit/$1';
$route['admin/privacy/update'] = 'admin/Privacy_Policy/update';

// Admin TESTIMONIALS CRUD URLs
$route['admin/testimonials'] = 'admin/Testimonials/index';
$route['admin/testimonials/add'] = 'admin/Testimonials/add';
$route['admin/testimonials/delete'] = 'admin/Testimonials/delete';
$route['admin/testimonials/edit/(:any)'] = 'admin/Testimonials/edit/$1';
$route['admin/testimonials/update'] = 'admin/Testimonials/update';


/*
| -------------------------------------------------------------------------
| USER SIDE ROUTES
| -------------------------------------------------------------------------
*/

// User side static pages
$route['about'] = 'user/pages/about_us';
$route['terms-and-conditions'] = 'user/pages/terms_and_conditions';
$route['legal'] = 'user/pages/legal';
$route['privacy-policy'] = 'user/pages/privacy_policy';
$route['our-work'] = 'user/pages/our_work';

//our work project slider
$route['get-project-detail'] = 'user/pages/our_work_detail';

$route['contact-us'] = 'user/pages/contact_us';
$route['contact-us-email'] = 'user/pages/contact_us_email';

$route['faqs'] = 'user/pages/faqs';

$route['careers'] = 'user/pages/careers';
$route['vacancy-apply'] = 'user/pages/vacancy_apply';
$route['vacancy-dz'] = 'user/pages/dz_files_vacancy';

$route['news-letter'] = 'user/pages/signup_for_newsletter';



//user registration & login URLs
$route['register'] = 'user/user/register';
$route['register/verify-email/(:any)'] = 'user/user/verify_email/$1';
$route['login'] = 'user/user/login';
$route['logout'] = 'user/user/logout';
$route['forgot-password'] = 'user/user/forgot_password';
$route['reset-password'] = 'user/user/reset_password_email';
$route['set-password/(:any)'] = 'user/user/reset_password/$1';
$route['set-forgot-password'] = 'user/user/reset_forgot_password';
$route['social-login'] = 'user/user/social_login';

$route['test-email'] = 'user/user/test_email';


// user dashboard URLs
$route['dashboard'] = 'user/dashboard/index';
$route['set-profile-password'] = 'user/dashboard/reset_password';
$route['profile'] = 'user/dashboard/profile';
$route['update-profile'] = 'user/dashboard/update_profile';
$route['purchases'] = 'user/dashboard/purchases';
$route['feedback'] = 'user/dashboard/feedback';
$route['feedback-response'] = 'user/dashboard/feedback_response';
$route['recommend'] = 'user/dashboard/recommend';
$route['recommend-response'] = 'user/dashboard/recommend_us_process';

//user bundl selection URLs
$route['select/(:any)'] = 'welcome/select_bundl/$1';
$route['chkstatus'] = 'welcome/check_bundl';

//custom bundle
$route['custom'] = 'welcome/custom_bundl';

//The Webster
$route['webster'] = 'welcome/webster_bundl';
$route['premium'] = 'welcome/webster_bundl';
$route['request-webster'] = 'welcome/request_webster';

//cart URLs
$route['add-cart'] = 'user/cart/add_to_cart';
$route['addon-cart'] = 'user/cart/addon_to_cart';
$route['free-cart'] = 'user/cart/cartfree';
$route['cart'] = 'user/cart/cart';
$route['remove-cart/(:any)'] = 'user/cart/remove_cart/$1';
$route['remove-cart-jd/(:any)'] = 'user/cart/remove_cart_all/$1';
$route['cart-free'] = 'user/cart/cartfree';
$route['cart-empty'] = 'user/cart/cartempty';
$route['update-cart'] = 'user/cart/update_cart';
$route['update-cart-addon'] = 'user/cart/update_cart_addon';
$route['checkout'] = 'user/cart/checkout';
$route['adjustment-cart'] = 'user/cart/adjustment_to_cart';
$route['adjustment-files'] = 'user/dashboard/adjustment_files';
$route['dropzone-files'] = 'user/dashboard/dz_files';
$route['dropzone-files-delete'] = 'user/dashboard/dz_files_delete';

// Order related URLs
$route['place-order'] = 'user/dashboard/place_order';
$route['return-paytab'] = 'user/dashboard/return_paytab';
$route['questionnaire'] = 'user/dashboard/questionnaire';
$route['branding-questions'] = 'user/dashboard/branding_questions';
$route['design-questions/(:any)'] = 'user/dashboard/design_questions/$1';
$route['save-questions'] = 'user/dashboard/save_questions';
$route['save-questions-for-later'] = 'user/dashboard/save_questions_later';
$route['get-order-items'] = 'user/dashboard/get_order_items';
$route['get-order-items-detail'] = 'user/dashboard/get_order_items_detail';
$route['get-delivery-files'] = 'user/dashboard/get_delivery_files_list';
$route['get-cities'] = 'user/dashboard/get_cities';
$route['approve-item'] = 'user/dashboard/approve_item';
$route['adjustments/(:any)'] = 'user/dashboard/adjustments/$1';
$route['promo'] = 'user/dashboard/apply_promo';

//edit bundle
$route['edit-bundl/(:any)'] = 'user/dashboard/edit_bundl/$1';
$route['get-order-detail'] = 'user/dashboard/get_order_detail';

// search handling
$route['search'] = 'welcome/search';

//language handling
$route['language/(:any)'] = 'welcome/language/$1';
$route['e-temp'] = 'welcome/test_email_template';

//Data Deletion URL for FB SDK
$route['user-data-deletion'] = 'welcome/user_data_deletion';

$route['current-date'] = 'welcome/show_date';




$route['show_coupon_on_web'] = 'admin/Coupon/show_coupon_on_web';