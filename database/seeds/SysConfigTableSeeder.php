<?php

use Illuminate\Database\Seeder;

class SysConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_configs')->delete();

        $conf = array(
            ['type'=>'SystemSettings','label'=>'Company Logo (Login Screen)', 'key'=>'crm-company-logo', 'value'=>'/assets/images/backend/logo.png'],
            ['type'=>'SystemSettings','label'=>'Company Logo (Header Nav)', 'key'=>'crm-company-logo-sm', 'value'=>'/assets/images/backend/logo-36p.png'],
            ['type'=>'SystemSettings','label'=>'Company Name', 'key'=>'crm-company-name', 'value'=>'Balanced CRM'],
            ['type'=>'SystemSettings','label'=>'Login Background Image', 'key'=>'crm-login-bg-image', 'value'=>'/assets/images/login-bg/bg-4.jpg'],
            ['type'=>'SystemSettings','label'=>'Home URL', 'key'=>'crm-home-url', 'value'=>'/crm/home'],
            ['type'=>'SystemSettings','label'=>'Login Title', 'key'=>'crm-login-title', 'value'=>'Customer Relation Management'],

            ['type'=>'MailSettings','label'=>'Mail Driver', 'key'=>'crm-mail-driver', 'value'=>'smtp'],
            ['type'=>'MailSettings','label'=>'Mail Host', 'key'=>'crm-mail-host', 'value'=>'smtp.gmail.com'],
            ['type'=>'MailSettings','label'=>'Mail Port', 'key'=>'crm-mail-port', 'value'=>'587'],
            ['type'=>'MailSettings','label'=>'Mail From Addr', 'key'=>'crm-mail-fromaddress', 'value'=>'bctester001@gmail.com'],
            ['type'=>'MailSettings','label'=>'Mail From Name', 'key'=>'crm-mail-fromname', 'value'=>'BCTestGMail'],
            ['type'=>'MailSettings','label'=>'Mail Encryption', 'key'=>'crm-mail-encryption', 'value'=>'tls'],
            ['type'=>'MailSettings','label'=>'Mail Username', 'key'=>'crm-mail-username', 'value'=>'bctester001@gmail.com'],
            ['type'=>'MailSettings','label'=>'Mail Password', 'key'=>'crm-mail-password', 'value'=>'bCtesting123456'],
            ['type'=>'MailSettings','label'=>'Mail Send Mail', 'key'=>'crm-mail-sendmail', 'value'=>'/usr/sbin/sendmail -bs'],
            ['type'=>'MailSettings','label'=>'Mail Testing', 'key'=>'crm-mail-pretend', 'value'=>'0'],

            ['type'=>'SystemSettings','label'=>'Testing Route', 'key'=>'system-testing', 'value'=>'true'],
            ['type'=>'SystemLocation','label'=>'System Location', 'key'=>'system-location-id', 'value'=>'1'],

            //for dropdown of the permission position type
            ['type'=>'SystemPermissionPositionType','label'=>'Form Post', 'key'=>'form', 'value'=>'Form'],
            ['type'=>'SystemPermissionPositionType','label'=>'Panel Button', 'key'=>'panel', 'value'=>'Panel'],
            ['type'=>'SystemPermissionPositionType','label'=>'Table Button', 'key'=>'table', 'value'=>'Table'],

            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-android', 'value'=>'Android'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-archive', 'value'=>'Archive'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-asterisk', 'value'=>'Asterisk'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-automobile', 'value'=>'Car'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-bar-chart-o', 'value'=>'Barchart'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-barcode', 'value'=>'Barcode'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-bars', 'value'=>'Bars'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-beer', 'value'=>'Beer'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-bolt', 'value'=>'Bolt'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-book', 'value'=>'Book'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-briefcase', 'value'=>'Briefcase'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-bug', 'value'=>'Bug'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-bulleye', 'value'=>'Bulleye'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-cab', 'value'=>'Taxi'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-calendar', 'value'=>'Calendar'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-camera', 'value'=>'Camera'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-check', 'value'=>'Check Mark'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-check-circle', 'value'=>'Circle Check'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-check-circle-o', 'value'=>'Circle Check-O'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-child', 'value'=>'Child'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-clock-o', 'value'=>'Clock'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-cloud', 'value'=>'Cloud'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-cloud-download', 'value'=>'Cloud Download'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-cloud-upload', 'value'=>'Cloud Upload'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-coffee', 'value'=>'Coffee'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-cog', 'value'=>'Gear'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-cogs', 'value'=>'Gears'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-comment', 'value'=>'Call out'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-comments', 'value'=>'Call Outs'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-compass', 'value'=>'Compass'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-credit-card', 'value'=>'Credit Card'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-crosshairs', 'value'=>'Focus Scope'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-cube', 'value'=>'Cube'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-cubes', 'value'=>'Cubes'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-cutlery', 'value'=>'Restaurant'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-dashboard', 'value'=>'Dashboard'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-database', 'value'=>'Database'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-gear', 'value'=>'Gear'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-gears', 'value'=>'Gears'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-plus', 'value'=>'Plus'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-plus-circle', 'value'=>'Plus Circle'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-minus', 'value'=>'Minus'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-minus-circle', 'value'=>'Minus Circle'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-times', 'value'=>'Times'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-times-circle', 'value'=>'Times Circle'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-times-circle-o', 'value'=>'Times Circle O'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-power-off', 'value'=>'Power Off'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-refresh', 'value'=>'Refresh'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-qrcode', 'value'=>'QRCode'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-map-marker', 'value'=>'Map Pin'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-desktop', 'value'=>'Desktop'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-exchange', 'value'=>'Exchange'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-gamepad', 'value'=>'Game'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-home', 'value'=>'Home'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-send', 'value'=>'Send'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-rocket', 'value'=>'Rocket'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-shopping-cart', 'value'=>'Shopping Cart'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-tag', 'value'=>'Tag'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-tags', 'value'=>'Tags'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-truck', 'value'=>'Truck'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-tint', 'value'=>'Tint'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-upload', 'value'=>'Upload'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-thumbs-up', 'value'=>'Thumb Up'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-thumbs-down', 'value'=>'Thumb Down'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-warning', 'value'=>'Warning'],
            // ['type'=>'Icons','label'=>'Icons', 'key'=>'fa-wrench', 'value'=>'Wrench'],
            ['type'=>'IconBG','label'=>'Icon Background', 'key'=>'btn-default', 'value'=>'Grey'],
            ['type'=>'IconBG','label'=>'Icon Background', 'key'=>'btn-primary', 'value'=>'Blue'],
            ['type'=>'IconBG','label'=>'Icon Background', 'key'=>'btn-info', 'value'=>'Aqua Blue'],
            ['type'=>'IconBG','label'=>'Icon Background', 'key'=>'btn-success', 'value'=>'Green'],
            ['type'=>'IconBG','label'=>'Icon Background', 'key'=>'btn-danger', 'value'=>'Red'],
            ['type'=>'IconBG','label'=>'Icon Background', 'key'=>'btn-warning', 'value'=>'Orange'],
            ['type'=>'IconBG','label'=>'Icon Background', 'key'=>'btn-inverse', 'value'=>'Black'],
            ['type'=>'IconBG','label'=>'Icon Background', 'key'=>'btn-white', 'value'=>'white']
        );

        DB::table('sys_configs')->insert($conf);
        // Icons ----------------------------------->
        $web_app_icons = "fa-adjust fa-anchor fa-archive fa-area-chart fa-arrows fa-arrows-h fa-arrows-v fa-asterisk fa-at fa-automobile fa-balance-scale fa-ban fa-bank fa-bar-chart fa-bar-chart-o fa-barcode fa-bars fa-battery-0 fa-battery-1 fa-battery-2 fa-battery-3 fa-battery-4 fa-battery-empty fa-battery-full fa-battery-half fa-battery-quarter fa-battery-three-quarters fa-bed fa-beer fa-bell fa-bell-o fa-bell-slash fa-bell-slash-o fa-bicycle fa-binoculars fa-birthday-cake fa-bolt fa-bomb fa-book fa-bookmark fa-bookmark-o fa-briefcase fa-bug fa-building fa-building-o fa-bullhorn fa-bullseye fa-bus fa-cab fa-calculator fa-calendar fa-calendar-check-o fa-calendar-minus-o fa-calendar-o fa-calendar-plus-o fa-calendar-times-o fa-camera fa-camera-retro fa-car fa-caret-square-o-down fa-caret-square-o-left fa-caret-square-o-right fa-caret-square-o-up fa-cart-arrow-down fa-cart-plus fa-cc fa-certificate fa-check fa-check-circle fa-check-circle-o fa-check-square fa-check-square-o fa-child fa-circle fa-circle-o fa-circle-o-notch fa-circle-thin fa-clock-o fa-clone fa-close fa-cloud fa-cloud-download fa-cloud-upload fa-code fa-code-fork fa-coffee fa-cog fa-cogs fa-comment fa-comment-o fa-commenting fa-commenting-o fa-comments fa-comments-o fa-compass fa-copyright fa-creative-commons fa-credit-card fa-crop fa-crosshairs fa-cube fa-cubes fa-cutlery fa-dashboard fa-database fa-desktop fa-diamond fa-dot-circle-o fa-download fa-edit fa-ellipsis-h fa-ellipsis-v fa-envelope fa-envelope-o fa-envelope-square fa-eraser fa-exchange fa-exclamation fa-exclamation-circle fa-exclamation-triangle fa-external-link fa-external-link-square fa-eye fa-eye-slash fa-eyedropper fa-fax fa-feed fa-female fa-fighter-jet fa-file-archive-o fa-file-audio-o fa-file-code-o fa-file-excel-o fa-file-image-o fa-file-movie-o fa-file-pdf-o fa-file-photo-o fa-file-picture-o fa-file-powerpoint-o fa-file-sound-o fa-file-video-o fa-file-word-o fa-file-zip-o fa-film fa-filter fa-fire fa-fire-extinguisher fa-flag fa-flag-checkered fa-flag-o fa-flash fa-flask fa-folder fa-folder-o fa-folder-open fa-folder-open-o fa-frown-o fa-futbol-o fa-gamepad fa-gavel fa-gear fa-gears fa-gift fa-glass fa-globe fa-graduation-cap fa-group fa-hand-grab-o fa-hand-lizard-o fa-hand-paper-o fa-hand-peace-o fa-hand-pointer-o fa-hand-rock-o fa-hand-scissors-o fa-hand-spock-o fa-hand-stop-o fa-hdd-o fa-headphones fa-heart fa-heart-o fa-heartbeat fa-history fa-home fa-hotel fa-hourglass fa-hourglass-1 fa-hourglass-2 fa-hourglass-3 fa-hourglass-end fa-hourglass-half fa-hourglass-o fa-hourglass-start fa-i-cursor fa-image fa-inbox fa-industry fa-info fa-info-circle fa-institution fa-key fa-keyboard-o fa-language fa-laptop fa-leaf fa-legal fa-lemon-o fa-level-down fa-level-up fa-life-bouy fa-life-buoy fa-life-ring fa-life-saver fa-lightbulb-o fa-line-chart fa-location-arrow fa-lock fa-magic fa-magnet fa-mail-forward fa-mail-reply fa-mail-reply-all fa-male fa-map fa-map-marker fa-map-o fa-map-pin fa-map-signs fa-meh-o fa-microphone fa-microphone-slash fa-minus fa-minus-circle fa-minus-square fa-minus-square-o fa-mobile fa-mobile-phone fa-money fa-moon-o fa-mortar-board fa-motorcycle fa-mouse-pointer fa-music fa-navicon fa-newspaper-o fa-object-group fa-object-ungroup fa-paint-brush fa-paper-plane fa-paper-plane-o fa-paw fa-pencil fa-pencil-square fa-pencil-square-o fa-phone fa-phone-square fa-photo fa-picture-o fa-pie-chart fa-plane fa-plug fa-plus fa-plus-circle fa-plus-square fa-plus-square-o fa-power-off fa-print fa-puzzle-piece fa-qrcode fa-question fa-question-circle fa-quote-left fa-quote-right fa-random fa-recycle fa-refresh fa-registered fa-remove fa-reorder fa-reply fa-reply-all fa-retweet fa-road fa-rocket fa-rss fa-rss-square fa-search fa-search-minus fa-search-plus fa-send fa-send-o fa-server fa-share fa-share-alt fa-share-alt-square fa-share-square fa-share-square-o fa-shield fa-ship fa-shopping-cart fa-sign-in fa-sign-out fa-signal fa-sitemap fa-sliders fa-smile-o fa-soccer-ball-o fa-sort fa-sort-alpha-asc fa-sort-alpha-desc fa-sort-amount-asc fa-sort-amount-desc fa-sort-asc fa-sort-desc fa-sort-down fa-sort-numeric-asc fa-sort-numeric-desc fa-sort-up fa-space-shuttle fa-spinner fa-spoon fa-square fa-square-o fa-star fa-star-half fa-star-half-empty fa-star-half-full fa-star-half-o fa-star-o fa-sticky-note fa-sticky-note-o fa-street-view fa-suitcase fa-sun-o fa-support fa-tablet fa-tachometer fa-tag fa-tags fa-tasks fa-taxi fa-television fa-terminal fa-thumb-tack fa-thumbs-down fa-thumbs-o-down fa-thumbs-o-up fa-thumbs-up fa-ticket fa-times fa-times-circle fa-times-circle-o fa-tint fa-toggle-down fa-toggle-left fa-toggle-off fa-toggle-on fa-toggle-right fa-toggle-up fa-trademark fa-trash fa-trash-o fa-tree fa-trophy fa-truck fa-tty fa-tv fa-umbrella fa-university fa-unlock fa-unlock-alt fa-unsorted fa-upload fa-user fa-user-plus fa-user-secret fa-user-times fa-users fa-video-camera fa-volume-down fa-volume-off fa-volume-up fa-warning fa-wheelchair fa-wifi fa-wrench";
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

        $data = $this->getData($web_app_icons, 'Web Application Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($hand_icons, 'Hand Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($transport_icons, 'Transport Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($gender_icons, 'Gender Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($file_type_icons, 'File Type Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($spinner_icons, 'Spinner Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($form_control_icons, 'Form Control Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($payment_icons, 'Payment Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($chart_icons, 'Chart Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($currency_icons, 'Currency Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($text_editor_icons, 'Text Editor Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($directional_icons, 'Directional Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($video_player_icons, 'Video Player Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($brand_icons, 'Brand Icons');
        DB::table('sys_configs')->insert($data);
        $data = $this->getData($medical_icons, 'Medical Icons');
        DB::table('sys_configs')->insert($data);
        // Icons ----------------------------------->
    }

    private function getData($icon_source, $label = 'Icons'){
      $data = [];
      $icons = explode(' ', $icon_source);
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
          'label' => $label,
          'type' => 'Icons',
          'key' => $icon,
          'value' => $value,
          'order' => 1
        ];
      }
      return $data;
    }
}
