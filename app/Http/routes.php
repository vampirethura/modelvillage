<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

#rereoute to the login
Route::get('/', 		function(){ return Redirect::to('/crm/login');  });
Route::get('/crm', 		function(){ return Redirect::to('/crm/login');  });

# Login, Logout Routing ...
Route:: resource('/crm/login', 'LoginController');
Route:: get('/crm/logout', 					array('uses'=>'LoginController@doLogout', 	'as'=>'crm.logout'));
Route:: get('/crm/relogin', 				array('uses'=>'LoginController@doRelogin', 	'as'=>'crm.relogin'));
Route::post('/crm/user/forget_password', 	array('uses'=>'LoginController@processForgetPassword', 	'as'=>'crm.forget_password'));

# Home Related Routing ----------------------------------------------------------------------------------------
Route::get('/crm/home', 					array('uses'=>'HomeController@showHome'));

# Profile Related Routing ----------------------------------------------------------------------------------------
Route::get('/crm/profile', 					array('uses'=>'ProfileController@showUserProfile', 			'as'=>'crm.profile.index'));
Route::get('/crm/profile/edit', 			array('uses'=>'ProfileController@editUserProfile', 			'as'=>'crm.profile.edit'));
Route::post('/crm/profile/update',		 	array('uses'=>'ProfileController@updateUserProfile', 		'as'=>'crm.profile.update'));
// Route::post('/crm/user/ajax/upload_image', 	array('uses'=>'ProfileController@profileImageUpload', 		'as'=>'crm.user.ajax.upload_image'));
Route::post('/crm/user/change_password', 	array('uses'=>'ProfileController@processChangePassword',	'as'=>'crm.user.change_password'));


Route::resource('/crm/user', 'UserController'); # resource routing

Route::get('/crm/feature/{fid}/permission/create', array('uses'=>'FeatureController@createPermission', 'as'=>'crm.feature.create_permission'));
Route::post('/crm/feature/{fid}/permission', array('uses'=>'FeatureController@storePermission', 'as'=>'crm.feature.store_permission'));
Route::get('/crm/feature/{fid}/permission/{pid}/edit', array('uses'=>'FeatureController@editPermission', 'as'=>'crm.feature.edit_permission'));
Route:: put('/crm/feature/{fid}/permission/{pid}', array('uses'=>'FeatureController@updatePermission', 'as'=>'crm.feature.update_permission'));
Route::delete('/crm/feature/{fid}/permission/{pid}', array('uses'=>'FeatureController@deletePermission', 	'as'=>'crm.feature.delete_permission'));
Route::resource('/crm/feature', 'FeatureController'); # resource routing

Route::delete('/crm/role/{rid}/user/{uid}/remove', array('uses'=>'RoleController@removeRoleUser', 'as'=>'crm.role.user.user_remove'));
Route:: get('/crm/role/{rid}/user_assign', array('uses'=>'RoleController@assignRoleUserForm', 'as'=>'crm.role.user.user_assign_form'));
Route::post('/crm/role/{rid}/user_assign', array('uses'=>'RoleController@assignRoleUser', 'as'=>'crm.role.user.user_assign'));
Route:: get('/crm/role/{rid}/feature_assign', array('uses'=>'RoleController@assignRoleFeatureForm', 	'as'=>'crm.role.feature.feature_assign_form'));
Route::post('/crm/role/{rid}/feature_assign', array('uses'=>'RoleController@assignRoleFeature', 'as'=>'crm.role.feature.feature_assign'));
Route::post('/crm/role/{rid}/permission_assign', array('uses'=>'RoleController@assignRolePermission', 'as'=>'crm.role.permission_assign'));
Route::delete('/crm/role/{rid}/feature/{fid}/remove', array('uses'=>'RoleController@removeRoleFeature', 'as'=>'crm.role.feature.feature_remove'));
Route::resource('/crm/role', 'RoleController');

Route::resource('/crm/system_setting', 'SystemSettingController');
Route::resource('/crm/mail_setting', 'MailSettingController');
Route::resource('/crm/permission_pos_type', 'PermPosTypeSettingController');
Route::resource('/crm/system_icon', 'SystemIconController');




/*Start Test Routes*/
Route::post('/test/pns', function () {
  $deviceToken = Input::get('device_token');
  PushNotification::app('l5fAndroid')
              ->to($deviceToken)
              ->send('Hello World, i`m a push message');
});

Route::post('/test/icons', function () {
  $web_app_icons = "fa-adjust fa-anchor fa-archive fa-area-chart fa-arrows fa-arrows-h fa-arrows-v fa-asterisk fa-at fa-automobile fa-balance-scale fa-ban fa-bank fa-bar-chart fa-bar-chart-o fa-barcode fa-bars fa-battery-0 fa-battery-1 fa-battery-2 fa-battery-3 fa-battery-4 fa-battery-empty fa-battery-full fa-battery-half fa-battery-quarter fa-battery-three-quarters fa-bed fa-beer fa-bell fa-bell-o fa-bell-slash fa-bell-slash-o fa-bicycle fa-binoculars fa-birthday-cake fa-bolt fa-bomb fa-book fa-bookmark fa-bookmark-o fa-briefcase fa-bug fa-building fa-building-o fa-bullhorn fa-bullseye fa-bus fa-cab fa-calculator fa-calendar fa-calendar-check-o fa-calendar-minus-o fa-calendar-o fa-calendar-plus-o fa-calendar-times-o fa-camera fa-camera-retro fa-car fa-caret-square-o-down fa-caret-square-o-left fa-caret-square-o-right fa-caret-square-o-up fa-cart-arrow-down fa-cart-plus fa-cc fa-certificate fa-check fa-check-circle fa-check-circle-o fa-check-square fa-check-square-o fa-child fa-circle fa-circle-o fa-circle-o-notch fa-circle-thin fa-clock-o fa-clone fa-close fa-cloud fa-cloud-download fa-cloud-upload fa-code fa-code-fork fa-coffee fa-cog fa-cogs fa-comment fa-comment-o fa-commenting fa-commenting-o fa-comments fa-comments-o fa-compass fa-copyright fa-creative-commons fa-credit-card fa-crop fa-crosshairs fa-cube fa-cubes fa-cutlery fa-dashboard fa-database fa-desktop fa-diamond fa-dot-circle-o fa-download fa-edit fa-ellipsis-h fa-ellipsis-v fa-envelope fa-envelope-o fa-envelope-square fa-eraser fa-exchange fa-exclamation fa-exclamation-circle fa-exclamation-triangle fa-external-link fa-external-link-square fa-eye fa-eye-slash fa-eyedropper fa-fax fa-feed fa-female fa-fighter-jet fa-file-archive-o fa-file-audio-o fa-file-code-o fa-file-excel-o fa-file-image-o fa-file-movie-o fa-file-pdf-o fa-file-photo-o fa-file-picture-o fa-file-powerpoint-o fa-file-sound-o fa-file-video-o fa-file-word-o fa-file-zip-o fa-film fa-filter fa-fire fa-fire-extinguisher fa-flag fa-flag-checkered fa-flag-o fa-flash fa-flask fa-folder fa-folder-o fa-folder-open fa-folder-open-o fa-frown-o fa-futbol-o fa-gamepad fa-gavel fa-gear fa-gears fa-gift fa-glass fa-globe fa-graduation-cap fa-group fa-hand-grab-o fa-hand-lizard-o fa-hand-paper-o fa-hand-peace-o fa-hand-pointer-o fa-hand-rock-o fa-hand-scissors-o fa-hand-spock-o fa-hand-stop-o fa-hdd-o fa-headphones fa-heart fa-heart-o fa-heartbeat fa-history fa-home fa-hotel fa-hourglass fa-hourglass-1 fa-hourglass-2 fa-hourglass-3 fa-hourglass-end fa-hourglass-half fa-hourglass-o fa-hourglass-start fa-i-cursor fa-image fa-inbox fa-industry fa-info fa-info-circle fa-institution fa-key fa-keyboard-o fa-language fa-laptop fa-leaf fa-legal fa-lemon-o fa-level-down fa-level-up fa-life-bouy fa-life-buoy fa-life-ring fa-life-saver fa-lightbulb-o fa-line-chart fa-location-arrow fa-lock fa-magic fa-magnet fa-mail-forward fa-mail-reply fa-mail-reply-all fa-male fa-map fa-map-marker fa-map-o fa-map-pin fa-map-signs fa-meh-o fa-microphone fa-microphone-slash fa-minus fa-minus-circle fa-minus-square fa-minus-square-o fa-mobile fa-mobile-phone fa-money fa-moon-o fa-mortar-board fa-motorcycle fa-mouse-pointer fa-music fa-navicon fa-newspaper-o fa-object-group fa-object-ungroup fa-paint-brush fa-paper-plane fa-paper-plane-o fa-paw fa-pencil fa-pencil-square fa-pencil-square-o fa-phone fa-phone-square fa-photo fa-picture-o fa-pie-chart fa-plane fa-plug fa-plus fa-plus-circle fa-plus-square fa-plus-square-o fa-power-off fa-print fa-puzzle-piece fa-qrcode fa-question fa-question-circle fa-quote-left fa-quote-right fa-random fa-recycle fa-refresh fa-registered fa-remove fa-reorder fa-reply fa-reply-all fa-retweet fa-road fa-rocket fa-rss fa-rss-square fa-search fa-search-minus fa-search-plus fa-send fa-send-o fa-server fa-share fa-share-alt fa-share-alt-square fa-share-square fa-share-square-o fa-shield fa-ship fa-shopping-cart fa-sign-in fa-sign-out fa-signal fa-sitemap fa-sliders fa-smile-o fa-soccer-ball-o fa-sort fa-sort-alpha-asc fa-sort-alpha-desc fa-sort-amount-asc fa-sort-amount-desc fa-sort-asc fa-sort-desc fa-sort-down fa-sort-numeric-asc fa-sort-numeric-desc fa-sort-up fa-space-shuttle fa-spinner fa-spoon fa-square fa-square-o fa-star fa-star-half fa-star-half-empty fa-star-half-full fa-star-half-o fa-star-o fa-sticky-note fa-sticky-note-o fa-street-view fa-suitcase fa-sun-o fa-support fa-tablet fa-tachometer fa-tag fa-tags fa-tasks fa-taxi fa-television fa-terminal fa-thumb-tack fa-thumbs-down fa-thumbs-o-down fa-thumbs-o-up fa-thumbs-up fa-ticket fa-times fa-times-circle fa-times-circle-o fa-tint fa-toggle-down fa-toggle-left fa-toggle-off fa-toggle-on fa-toggle-right fa-toggle-up fa-trademark fa-trash fa-trash-o fa-tree fa-trophy fa-truck fa-tty fa-tv fa-umbrella fa-university fa-unlock fa-unlock-alt fa-unsorted fa-upload fa-user fa-user-plus fa-user-secret fa-user-times fa-users fa-video-camera fa-volume-down fa-volume-off fa-volume-up fa-warning fa-wheelchair fa-wifi";
  $hand_icons = "fa-hand-grab-o fa-hand-lizard-o fa-hand-o-down fa-hand-o-left fa-hand-o-right fa-hand-o-up fa-hand-paper-o fa-hand-peace-o fa-hand-pointer-o fa-hand-rock-o fa-hand-scissors-o fa-hand-spock-o fa-hand-stop-o fa-thumbs-down fa-thumbs-o-down fa-thumbs-o-up fa-thumbs-up";
  $transport_icons = "fa-ambulance fa-automobile fa-bicycle fa-bus fa-cab fa-car fa-fighter-jet fa-motorcycle fa-plane fa-rocket fa-ship fa-space-shuttle fa-subway fa-taxi fa-train fa-truck fa-wheelchair";
  $gender_icons = "fa-genderless fa-intersex fa-mars fa-mars-double fa-mars-stroke fa-mars-stroke-h fa-mars-stroke-v fa-mercury fa-neuter fa-transgender fa-transgender-alt fa-venus fa-venus-double fa-venus-mars";
  $file_type_icons = "fa-file fa-file-archive-o fa-file-audio-o fa-file-code-o fa-file-excel-o fa-file-image-o fa-file-movie-o fa-file-o fa-file-pdf-o fa-file-photo-o fa-file-picture-o fa-file-powerpoint-o fa-file-sound-o fa-file-text fa-file-text-o fa-file-video-o fa-file-word-o";
  $spinner_icons = "fa-circle-o-notch fa-cog fa-gear fa-refresh fa-spinner";
  $form_control_icons = "fa-check-square fa-check-square-o fa-circle fa-circle-o fa-dot-circle-o fa-minus-square fa-minus-square-o fa-plus-square fa-plus-square-o fa-square fa-square-o";
  $payment_icons = "fa-cc-amex fa-cc-diners-club fa-cc-discover fa-cc-jcb fa-cc-mastercard fa-cc-paypal fa-cc-stripe fa-cc-visa fa-credit-card";
  $chart_icons = "fa-area-chart fa-bar-chart fa-bar-chart-o fa-line-chart fa-pie-chart";
  $currency_icons = "fa-bitcoin fa-btc fa-cny fa-dollar fa-eur fa-euro fa-gbp fa-gg fa-gg-circle fa-ils fa-inr fa-jpy fa-krw fa-money fa-rmb fa-rouble fa-rub fa-ruble fa-rupee fa-shekel fa-sheqel fa-try fa-turkish-lira fa-usd fa-won fa-yen";
  $text_editor_icons = "fa-align-center fa-align-justify fa-align-left fa-align-right fa-bold fa-chain fa-chain-broken fa-clipboard fa-columns fa-copy fa-cut fa-dedent fa-eraser fa-file fa-file-o fa-file-text fa-file-text-o fa-files-o fa-floppy-o fa-font fa-header fa-indent fa-italic fa-link fa-list fa-list-alt fa-list-ol fa-list-ul fa-outdent fa-paperclip fa-paragraph fa-paste fa-repeat fa-rotate-left fa-rotate-right fa-save fa-scissors fa-strikethrough fa-subscript fa-superscript fa-table fa-text-height fa-text-width fa-th fa-th-large fa-th-list fa-underline fa-undo fa-unlink";
  $directional_icons = "fa-angle-double-down fa-angle-double-left fa-angle-double-right fa-angle-double-up fa-angle-down fa-angle-left fa-angle-right fa-angle-up fa-arrow-circle-down fa-arrow-circle-left fa-arrow-circle-o-down fa-arrow-circle-o-left fa-arrow-circle-o-right fa-arrow-circle-o-up fa-arrow-circle-right fa-arrow-circle-up fa-arrow-down fa-arrow-left fa-arrow-right fa-arrow-up fa-arrows fa-arrows-alt fa-arrows-h fa-arrows-v fa-caret-down fa-caret-left fa-caret-right fa-caret-square-o-down fa-caret-square-o-left fa-caret-square-o-right fa-caret-square-o-up fa-caret-up fa-chevron-circle-down fa-chevron-circle-left fa-chevron-circle-right fa-chevron-circle-up fa-chevron-down fa-chevron-left fa-chevron-right fa-chevron-up fa-exchange fa-hand-o-down fa-hand-o-left fa-hand-o-right fa-hand-o-up fa-long-arrow-down fa-long-arrow-left fa-long-arrow-right fa-long-arrow-up fa-toggle-down fa-toggle-left fa-toggle-right fa-toggle-up";
  $video_player_icons = "fa-arrows-alt fa-backward fa-compress fa-eject fa-expand fa-fast-backward fa-fast-forward fa-forward fa-pause fa-play fa-play-circle fa-play-circle-o fa-random fa-step-backward fa-step-forward fa-stop fa-youtube-play";
  $brand_icons = "fa-500px fa-adn fa-amazon fa-android fa-angellist fa-apple fa-behance fa-behance-square fa-bitbucket fa-bitbucket-square fa-bitcoin fa-black-tie fa-btc fa-buysellads fa-cc-amex fa-cc-diners-club fa-cc-discover fa-cc-jcb fa-cc-mastercard fa-cc-paypal fa-cc-stripe fa-cc-visa fa-chrome fa-codepen fa-connectdevelop fa-contao fa-css3 fa-dashcube fa-delicious fa-deviantart fa-digg fa-dribbble fa-dropbox fa-drupal fa-empire fa-expeditedssl fa-facebook fa-facebook-f fa-facebook-official fa-facebook-square fa-firefox fa-flickr fa-fonticons fa-forumbee fa-foursquare fa-ge fa-get-pocket fa-gg fa-gg-circle fa-git fa-git-square fa-github fa-github-alt fa-github-square fa-gittip fa-google fa-google-plus fa-google-plus-square fa-google-wallet fa-gratipay fa-hacker-news fa-houzz fa-html5 fa-instagram fa-internet-explorer fa-ioxhost fa-joomla fa-jsfiddle fa-lastfm fa-lastfm-square fa-leanpub fa-linkedin fa-linkedin-square fa-linux fa-maxcdn fa-meanpath fa-medium fa-odnoklassniki fa-odnoklassniki-square fa-opencart fa-openid fa-opera fa-optin-monster fa-pagelines fa-paypal fa-pied-piper fa-pied-piper-alt fa-pinterest fa-pinterest-p fa-pinterest-square fa-qq fa-ra fa-rebel fa-reddit fa-reddit-square fa-renren fa-safari fa-sellsy fa-share-alt fa-share-alt-square fa-shirtsinbulk fa-simplybuilt fa-skyatlas fa-skype fa-slack fa-slideshare fa-soundcloud fa-spotify fa-stack-exchange fa-stack-overflow fa-steam fa-steam-square fa-stumbleupon fa-stumbleupon-circle fa-tencent-weibo fa-trello fa-tripadvisor fa-tumblr fa-tumblr-square fa-twitch fa-twitter fa-twitter-square fa-viacoin fa-vimeo fa-vimeo-square fa-vine fa-vk fa-wechat fa-weibo fa-weixin fa-whatsapp fa-wikipedia-w fa-windows fa-wordpress fa-xing fa-xing-square fa-y-combinator fa-y-combinator-square fa-yahoo fa-yc fa-yc-square fa-yelp fa-youtube fa-youtube-play fa-youtube-square";
  $medical_icons = "fa-ambulance fa-h-square fa-heart fa-heart-o fa-heartbeat fa-hospital-o fa-medkit fa-plus-square fa-stethoscope fa-user-md fa-wheelchair";

  $data = [];
  $icons = explode(' ', $web_app_icons);
  foreach ($icons as $icon) {
    $arr_value = explode('-', $icon);
    $value = '';
    for($i = 1; $i < count($arr_value); $i++){
      if ($i == count($arr_value) - 1) {
        $value .= ucwords($arr_value[$i]);
      }else{
        $value .= ucwords($arr_value[$i]) . ' ';
      }
    }
    $data[] = [
      'label' => 'Web Application Icons',
      'type' => 'Icons',
      'key' => $icon,
      'value' => $value,
      'order' => 1
    ];
  }
  return $data;
});
/*End Test Routes*/
