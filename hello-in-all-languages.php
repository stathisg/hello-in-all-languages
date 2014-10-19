<?php
/*
Plugin Name: Hello In All Languages
Plugin URI: http://stathisg.com/projects/hello-in-all-languages/
Version: 1.0.4
Author: Stathis Goudoulakis
Author URI: http://stathisg.com/
Description: Hello In All Languages displays a "hello" word translated to the official language of the country the visitor's IP belongs to.

Copyright 2010-2014 Stathis Goudoulakis (me@stathisg.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

if (!class_exists("HelloInAllLanguages"))
{
    class HelloInAllLanguages
    {
        private $wpdb;
        private $tableName;
        private $greetingQuery;
        private $adminOptionsName = "HelloInAllLanguagesAdminOptions";
        private $defaultAPIkey = "9200a77e841b835118667753c0320d6c1fdf2b0e8541fccf11b0b0c06e6f3edb";

        public function __construct()
        {
            global $wpdb;
            $this->wpdb = $wpdb;
            $this->tableName = $wpdb->prefix . 'hello_in_all_languages';
            $this->greetingQuery = "SELECT greeting FROM $this->tableName WHERE country_code=%s";
        }

        private function getAdminOptions()
        {
            $adminOptions = array('display' => 'default',
                'default_country_code' => 'UK',
                'how_to_open_url' => 'curl',
                'api_key' => $this->defaultAPIkey);
            $options = get_option($this->adminOptionsName);
            if(!empty($options))
            {
                foreach ($options as $key => $option)
                {
                    $adminOptions[$key] = $option;
                }
            }
            update_option($this->adminOptionsName, $adminOptions);
            return $adminOptions;
        }

        public function dropTable()
        {
            $query = "DROP TABLE $this->tableName;";
            $this->wpdb->query($query);
        }

        public function createTable()
        {
            if($this->wpdb->get_var("show tables like '$this->tableName'") != $this->tableName)
            {
                $query = "CREATE TABLE " . $this->tableName . " (
                    country_code varchar(2) CHARACTER SET utf8 NOT NULL,
                    country_name varchar(64) CHARACTER SET utf8 NOT NULL,
                    greeting varchar(100) CHARACTER SET utf8 NOT NULL,
                    PRIMARY KEY (country_code)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; ";

                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($query);

                $insert = "INSERT INTO " . $this->tableName . " (country_code, country_name, greeting) VALUES
                ('A1', 'Anonymous Proxy', 'Hello'),
                ('A2', 'Satellite Provider', 'Hello'),
                ('AD', 'Andorra', 'Hola'),
                ('AE', 'United Arab Emirates', 'Marhaba'),
                ('AF', 'Afghanistan', 'Senga yai'),
                ('AG', 'Antigua and Barbuda', 'Hello'),
                ('AI', 'Anguilla', 'Hello'),
                ('AL', 'Albania', 'Tungjatjeta'),
                ('AM', 'Armenia', 'Barev'),
                ('AN', 'Netherlands Antilles', 'Kon ta bai'),
                ('AO', 'Angola', 'Olá'),
                ('AP', 'Asia/Pacific Region', 'Hello'),
                ('AQ', 'Antarctica', 'Hello'),
                ('AR', 'Argentina', 'Hola'),
                ('AS', 'American Samoa', 'Hello'),
                ('AT', 'Austria', 'Hallo'),
                ('AU', 'Australia', 'Hello'),
                ('AW', 'Aruba', 'Kon ta bai'),
                ('AX', 'Aland Islands', 'Hello'),
                ('AZ', 'Azerbaijan', 'Salam'),
                ('BA', 'Bosnia and Herzegovina', 'Zdravo'),
                ('BB', 'Barbados', 'Hello'),
                ('BD', 'Bangladesh', 'Namaskar'),
                ('BE', 'Belgium', 'Hallo'),
                ('BF', 'Burkina Faso', 'Bonjour'),
                ('BG', 'Bulgaria', 'Zdravei'),
                ('BH', 'Bahrain', 'Marhaba'),
                ('BI', 'Burundi', 'Bonjour'),
                ('BJ', 'Benin', 'Bonjour'),
                ('BM', 'Bermuda', 'Hello'),
                ('BN', 'Brunei Darussalam', 'Selamat'),
                ('BO', 'Bolivia', 'Hola'),
                ('BR', 'Brazil', 'Olá'),
                ('BS', 'Bahamas', 'Hello'),
                ('BT', 'Bhutan', 'Kuzu zangpo'),
                ('BV', 'Bouvet Island', 'Hello'),
                ('BW', 'Botswana', 'Dumela'),
                ('BY', 'Belarus', 'Вітаю'),
                ('BZ', 'Belize', 'Hello'),
                ('CA', 'Canada', 'Hello'),
                ('CD', 'Congo  The Democratic Republic of the', 'Bonjour'),
                ('CF', 'Central African Republic', 'Bonjour'),
                ('CG', 'Congo', 'Bonjour'),
                ('CH', 'Switzerland', 'Hallo'),
                ('CI', 'Cote d''Ivoire', 'Bonjour'),
                ('CK', 'Cook Islands', 'Kia orana'),
                ('CL', 'Chile', 'Hola'),
                ('CM', 'Cameroon', 'Hello'),
                ('CN', 'China', '&#20320;&#22909;'),
                ('CO', 'Colombia', 'Hola'),
                ('CR', 'Costa Rica', 'Hola'),
                ('CU', 'Cuba', 'Hola'),
                ('CV', 'Cape Verde', 'Olá'),
                ('CY', 'Cyprus', '&#915;&#949;&#953;&#945; &#963;&#959;&#965;'),
                ('CZ', 'Czech Republic', 'Dobrý den'),
                ('DE', 'Germany', 'Hallo'),
                ('DJ', 'Djibouti', 'Marhaba'),
                ('DK', 'Denmark', 'Hej'),
                ('DM', 'Dominica', 'Hello'),
                ('DO', 'Dominican Republic', 'Hola'),
                ('DZ', 'Algeria', 'Marhaba'),
                ('EC', 'Ecuador', 'Hola'),
                ('EE', 'Estonia', 'Tervist'),
                ('EG', 'Egypt', 'Marhaba'),
                ('ER', 'Eritrea', 'Marhaba'),
                ('ES', 'Spain', 'Hola'),
                ('ET', 'Ethiopia', 'Teanastëllën'),
                ('EU', 'Europe', 'Hello'),
                ('FI', 'Finland', 'Moi'),
                ('FJ', 'Fiji', 'Hello'),
                ('FK', 'Falkland Islands (Malvinas)', 'Hello'),
                ('FM', 'Micronesia  Federated States of', 'Hello'),
                ('FO', 'Faroe Islands', 'Hallo'),
                ('FR', 'France', 'Bonjour'),
                ('GA', 'Gabon', 'Bonjour'),
                ('GB', 'Great Britain', 'Hello'),
                ('GD', 'Grenada', 'Hello'),
                ('GE', 'Georgia', 'Gamardjobat'),
                ('GF', 'French Guiana', 'Bonjour'),
                ('GG', 'Guernsey', 'Hello'),
                ('GH', 'Ghana', 'Hello'),
                ('GI', 'Gibraltar', 'Hello'),
                ('GL', 'Greenland', 'Aluu'),
                ('GM', 'Gambia', 'Hello'),
                ('GN', 'Guinea', 'Bonjour'),
                ('GP', 'Guadeloupe', 'Hello'),
                ('GQ', 'Equatorial Guinea', 'Hola'),
                ('GR', 'Greece', '&#915;&#949;&#953;&#945; &#963;&#959;&#965;'),
                ('GT', 'Guatemala', 'Hola'),
                ('GU', 'Guam', 'Hello'),
                ('GW', 'Guinea-Bissau', 'Olá'),
                ('GY', 'Guyana', 'Hello'),
                ('HK', 'Hong Kong', '&#20320;&#22909;'),
                ('HN', 'Honduras', 'HHola'),
                ('HR', 'Croatia', 'Bok'),
                ('HT', 'Haiti', 'Bonjour'),
                ('HU', 'Hungary', 'Jó napot'),
                ('ID', 'Indonesia', 'Selamat'),
                ('IE', 'Ireland', 'Haileo'),
                ('IL', 'Israel', 'Shalom'),
                ('IM', 'Isle of Man', 'Hello'),
                ('IN', 'India', '&#2344;&#2350;&#2360;&#2381;&#2340;&#2375;'),
                ('IO', 'British Indian Ocean Territory', 'Hello'),
                ('IQ', 'Iraq', 'Marhaba'),
                ('IR', 'Iran  Islamic Republic of', 'Salâm'),
                ('IS', 'Iceland', 'Góðan daginn'),
                ('IT', 'Italy', 'Buon giorno'),
                ('JE', 'Jersey', 'Hello'),
                ('JM', 'Jamaica', 'Hello'),
                ('JO', 'Jordan', 'Marhaba'),
                ('JP', 'Japan', '&#12371;&#12435;&#12395;&#12385;&#12399;'),
                ('KE', 'Kenya', 'Habari'),
                ('KG', 'Kyrgyzstan', 'Kandisiz'),
                ('KH', 'Cambodia', 'Sua s''dei'),
                ('KI', 'Kiribati', 'Mauri'),
                ('KM', 'Comoros', 'Bariza djioni'),
                ('KN', 'Saint Kitts and Nevis', 'Hello'),
                ('KP', 'Korea  Democratic People''s Republic of', '&#50504;&#45397;&#54616;&#49464;&#50836;'),
                ('KR', 'Korea  Republic of', '&#50504;&#45397;&#54616;&#49464;&#50836;'),
                ('KW', 'Kuwait', 'Marhaba'),
                ('KY', 'Cayman Islands', 'Hello'),
                ('KZ', 'Kazakhstan', 'Salam'),
                ('LA', 'Lao People''s Democratic Republic', 'Sabaidee'),
                ('LB', 'Lebanon', 'Marhaba'),
                ('LC', 'Saint Lucia', 'Hello'),
                ('LI', 'Liechtenstein', 'Hallo'),
                ('LK', 'Sri Lanka', 'A`yubowan'),
                ('LR', 'Liberia', 'Hello'),
                ('LS', 'Lesotho', 'Hello'),
                ('LT', 'Lithuania', 'Laba diena'),
                ('LU', 'Luxembourg', 'Moïen'),
                ('LV', 'Latvia', 'Sveiki'),
                ('LY', 'Libyan Arab Jamahiriya', 'Marhaba'),
                ('MA', 'Morocco', 'Marhaba'),
                ('MC', 'Monaco', 'Bonjour'),
                ('MD', 'Moldova  Republic of', 'Salut'),
                ('ME', 'Montenegro', 'Zdravo'),
                ('MG', 'Madagascar', 'Manao ahoana'),
                ('MH', 'Marshall Islands', 'Yokwe'),
                ('MK', 'Macedonia', '&#1047;&#1076;&#1088;&#1072;&#1074;&#1086;'),
                ('ML', 'Mali', 'Bonjour'),
                ('MM', 'Myanmar', 'Mingalarba'),
                ('MN', 'Mongolia', 'Sain baina uu'),
                ('MO', 'Macao', '&#20320;&#22909;'),
                ('MP', 'Northern Mariana Islands', 'Hello'),
                ('MQ', 'Martinique', 'Hello'),
                ('MR', 'Mauritania', 'Marhaba'),
                ('MS', 'Montserrat', 'Hello'),
                ('MT', 'Malta', 'Bongu'),
                ('MU', 'Mauritius', 'Hello'),
                ('MV', 'Maldives', 'Kihineth'),
                ('MW', 'Malawi', 'Muribwanji'),
                ('MX', 'Mexico', 'Hola'),
                ('MY', 'Malaysia', 'Selamat'),
                ('MZ', 'Mozambique', 'Olá'),
                ('NA', 'Namibia', 'Hello'),
                ('NC', 'New Caledonia', 'Bozo'),
                ('NE', 'Niger', 'Bonjour'),
                ('NF', 'Norfolk Island', 'Whataway'),
                ('NG', 'Nigeria', 'Hello'),
                ('NI', 'Nicaragua', 'Hola'),
                ('NL', 'Netherlands', 'Hallo'),
                ('NO', 'Norway', 'Hallo'),
                ('NP', 'Nepal', 'Namaste'),
                ('NR', 'Nauru', 'Hello'),
                ('NU', 'Niue', 'Faka lofa lahi atu'),
                ('NZ', 'New Zealand', 'Hello'),
                ('OM', 'Oman', 'Marhaba'),
                ('PA', 'Panama', 'Hola'),
                ('PE', 'Peru', 'Hola'),
                ('PF', 'French Polynesia', 'Bonjour'),
                ('PG', 'Papua New Guinea', 'Hello'),
                ('PH', 'Philippines', 'Halo'),
                ('PK', 'Pakistan', 'Adaab'),
                ('PL', 'Poland', 'Dzień dobry'),
                ('PM', 'Saint Pierre and Miquelon', 'Hello'),
                ('PR', 'Puerto Rico', 'Hola'),
                ('PS', 'Palestinian Territory', 'Marhaba'),
                ('PT', 'Portugal', 'Olá'),
                ('PW', 'Palau', 'Alii'),
                ('PY', 'Paraguay', 'Hola'),
                ('QA', 'Qatar', 'Marhaba'),
                ('RE', 'Reunion', 'Hello'),
                ('RO', 'Romania', 'Salut'),
                ('RS', 'Serbia', 'Zdravo'),
                ('RU', 'Russian Federation', '&#1047;&#1076;&#1088;&#1072;&#1074;&#1089;&#1090;&#1074;&#1091;&#1081;&#1090;&#1077;'),
                ('RW', 'Rwanda', 'Hello'),
                ('SA', 'Saudi Arabia', 'Marhaba'),
                ('SB', 'Solomon Islands', 'Hello'),
                ('SC', 'Seychelles', 'Hello'),
                ('SD', 'Sudan', 'Marhaba'),
                ('SE', 'Sweden', 'God dag'),
                ('SG', 'Singapore', 'Selamat'),
                ('SI', 'Slovenia', 'Živijo'),
                ('SK', 'Slovakia', 'Dobrý deň'),
                ('SL', 'Sierra Leone', 'Hello'),
                ('SM', 'San Marino', 'Buon giorno'),
                ('SN', 'Senegal', 'Bonjour'),
                ('SO', 'Somalia', 'Maalim wanaqsan'),
                ('SR', 'Suriname', 'Hallo'),
                ('ST', 'Sao Tome and Principe', 'Hello'),
                ('SV', 'El Salvador', 'Hola'),
                ('SY', 'Syrian Arab Republic', 'Marhaba'),
                ('SZ', 'Swaziland', 'Hello'),
                ('TC', 'Turks and Caicos Islands', 'Hello'),
                ('TD', 'Chad', 'Marhaba'),
                ('TG', 'Togo', 'Bonjour'),
                ('TH', 'Thailand', 'Sawatdi'),
                ('TJ', 'Tajikistan', 'Salom'),
                ('TK', 'Tokelau', 'Taloha'),
                ('TM', 'Turkmenistan', 'Salam'),
                ('TN', 'Tunisia', 'Marhaba'),
                ('TO', 'Tonga', 'Malo e lelei'),
                ('TR', 'Turkey', 'Merhaba'),
                ('TT', 'Trinidad and Tobago', 'Hello'),
                ('TV', 'Tuvalu', 'Talofa'),
                ('TW', 'Taiwan', '&#20320;&#22909;'),
                ('TZ', 'Tanzania  United Republic of', 'Habari'),
                ('UA', 'Ukraine', 'Pryvit'),
                ('UG', 'Uganda', 'Habari'),
                ('UK', 'United Kingdom', 'Hello'),
                ('UM', 'United States Minor Outlying Islands', 'Hello'),
                ('US', 'United States', 'Hello'),
                ('UY', 'Uruguay', 'Hola'),
                ('UZ', 'Uzbekistan', 'Salom'),
                ('VA', 'Holy See (Vatican City State)', 'Buon giorno'),
                ('VC', 'Saint Vincent and the Grenadines', 'Hello'),
                ('VE', 'Venezuela', 'Hola'),
                ('VG', 'Virgin Islands  British', 'Hello'),
                ('VI', 'Virgin Islands  U.S.', 'Hello'),
                ('VN', 'Vietnam', 'Chào'),
                ('VU', 'Vanuatu', 'Halo'),
                ('WF', 'Wallis and Futuna', 'Malo le kataki'),
                ('WS', 'Samoa', 'Talofa'),
                ('YE', 'Yemen', 'Marhaba'),
                ('YT', 'Mayotte', 'Hello'),
                ('ZA', 'South Africa', 'Hello'),
                ('ZM', 'Zambia', 'Hello'),
                ('ZW', 'Zimbabwe', 'Hello'),
                ('RD', 'Reserved', 'Hello');";

                $this->wpdb->query($insert);
            }

        }

        public function displayHello()
        {
            $options = $this->getAdminOptions();

            $ip = $_SERVER['REMOTE_ADDR'];
            $url = "http://api.ipinfodb.com/v3/ip-country/?key={$options['api_key']}&ip=$ip&format=xml";
            $buffer = '';

            if($options['how_to_open_url']=='curl')
            {
                $curl = curl_init($url);
                $timeout = 5;
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,$timeout);
                $buffer = curl_exec($curl);
                curl_close($curl);
            }
            elseif($options['how_to_open_url']=='fopen')
            {
                $buffer = file_get_contents($url);
            }

            try
            {
                $xml = new SimpleXMLElement($buffer);
                $countryCode = $xml -> countryCode;
            }
            catch(Exception $e)
            {
                $countryCode = '';
            }

            if(empty($countryCode))
            {
                $countryCode = $options['default_country_code'];
            }

            $hello = $this->wpdb->get_var($this->wpdb->prepare($this->greetingQuery, $countryCode));

                        //if the country code is unknown, $hello will be empty
            if(empty($hello))
            {
                $hello = $this->wpdb->get_var($this->wpdb->prepare($this->greetingQuery, $options['default_country_code']));
            }

            if ($options['display']=='capitalised')
            {
                $hello = strtoupper($hello);
            }
            elseif ($options['display']=='decapitalised')
            {
                $hello = strtolower($hello);
            }

            return $hello;
        }

        public function printAdminPage()
        {
            $options = $this->getAdminOptions();

            if (isset($_POST['update_HelloInAllLanguagesSettings']))
            {
                if (isset($_POST['display']))
                {
                    $options['display'] = $_POST['display'];
                }

                if (isset($_POST['language']))
                {
                    $options['default_country_code'] = $_POST['language'];
                }

                if (isset($_POST['url']))
                {
                    $options['how_to_open_url'] = $_POST['url'];
                }

                if (isset($_POST['api-key']) && !empty($_POST['api-key']))
                {
                    $options['api_key'] = $_POST['api-key'];
                }
                else
                {
                    $options['api_key'] = $this->defaultAPIkey;
                }

                update_option($this->adminOptionsName, $options);
                ?>
                <div class="updated">
                    <p>
                        <strong><?php _e("Settings Updated.", "HelloInAllLanguages");?></strong>
                    </p>
                </div>
                <?php
            }
            ?>
            <div class="wrap">
                <div class="icon32" id="icon-options-general"><br/></div>
                <h2>Hello In All Languages Settings</h2>
                <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                    <h3>Select how the "hello" word will be displayed:</h3>
                    <p>
                        <input type="radio" id="default-hello" name="display" value="default" <?php if ($options['display'] == "default") { _e('checked="checked"', "HelloInAllLanguages"); }?> />
                        <label for="default-hello">Capitalised <span class="description">(Example: "Hello")</span></label>
                    </p>
                    <p>
                        <input type="radio" id="cap-hello" name="display" value="capitalised" <?php if ($options['display'] == "capitalised") { _e('checked="checked"', "HelloInAllLanguages"); }?> />
                        <label for="cap-hello">Uppercase <span class="description">(Example: "HELLO")</span></label>
                    </p>
                    <p>
                        <input type="radio" id="decap-hello" name="display" value="decapitalised" <?php if ($options['display'] == "decapitalised") { _e('checked="checked"', "HelloInAllLanguages"); }?> />
                        <label for="decap-hello">Lowercase <span class="description">(Example: "hello")</span></label>
                    </p>
                    <h3>Select default language:</h3>
                    <p>
                        <span class="description">Will be used if visitor's IP cannot be determined.</span>
                    </p>
                    <p>
                        <select name="language">
                            <?php
                            $query = "SELECT country_code, country_name FROM $this->tableName ORDER BY country_name ASC";
                            $countries = $this->wpdb->get_results($query);

                            foreach ($countries as $country)
                            {
                                echo '<option value="'.$country->country_code.'"';
                                if($country->country_code==$options['default_country_code'])
                                {
                                    echo ' selected';
                                }
                                echo '>'.$country->country_name.'</option>';
                            }
                            ?>
                        </select>
                    </p>
                    <h3>IPInfoDB API Key:</h3>
                    <p>
                        <span class="description">Although the plugin will work with its predefined API key, you're advised to use your own API key. <a href="http://ipinfodb.com/register.php" target="_blank">Click here</a> to register for a free IPInfoDB account, to get your personal API key, and paste it to the field below.</span>
                    </p>
                    <p>
                        <input name="api-key" type="text" value="<?php if($this->defaultAPIkey !== $options['api_key']) { echo $options['api_key']; } ?>" class="large-text" placeholder="leave blank to use default API key" />
                    </p>
                    <h3>Way to connect to API:</h3>
                    <p>
                        <span class="description">There is no need to change this option, unless you get the "Call to undefined function: curl_init()" error. If you try "allow_url_fopen" and get an error similar to "URL file-access is disabled in the server configuration" please contact your hosting company and ask them to enable either cURL or allow_url_fopen.</span>
                    </p>
                    <p>
                        <select name="url">
                            <option value="curl" <?php if ($options['how_to_open_url']=='curl') { echo ' selected'; } ?>>cURL</option>
                            <option value="fopen" <?php if ($options['how_to_open_url']=='fopen') { echo ' selected'; } ?>>allow_url_fopen</option>
                        </select>
                    </p>
                    <div class="submit">
                        <input type="submit" name="update_HelloInAllLanguagesSettings" value="<?php _e('Update Settings', 'HelloInAllLanguages') ?>" />
                    </div>
                </form>
                <h2>Usage</h2>
                <p>Enter the shortcode <strong>[HELLO-IN-ALL-LANGUAGES]</strong> in any post or page and the translated hello will be displayed.</p>
                <h2>Notes</h2>
                <ul>
                    <li>To ensure that all the hello translations will be displayed correctly, please use <strong>UTF-8</strong> charset.</li>
                    <li>Please be aware that the plugin may not work properly if you are testing your blog in a local server.</li>
                    <li>To determine the visitor's physical location based on his IP, the free geolocation API provided by <a href="http://ipinfodb.com/" title="IPInfoDB">IPInfoDB</a> is used.</li>
                </ul>
                <h2>Support &amp; feedback</h2>
                <p>For questions, issues, or feature requests, you can either <a href="http://burnmind.com/contact">contact me</a>, or post them either in the <a href="http://wordpress.org/tags/hello-in-all-languages">WordPress Forum</a> (make sure to add the tag "hello-in-all-languages"), or in <a href="http://burnmind.com/freebies/hello-in-all-languages-wordpress-plugin">this</a> blog post.</p>
                <h2>How to contribute</h2>
                <ul>
                    <li>&raquo; Source code on <a href="https://github.com/stathisg/hello-in-all-languages">GitHub</a>.</li>
                    <li>&raquo; Blog about or link to the plugin so others can learn about it.</li>
                    <li>&raquo; Report issues, request features, provide feedback, etc.</li>
                    <li>&raquo; <a href="http://wordpress.org/extend/plugins/hello-in-all-languages/">Rate and/or review</a> the plugin</li>
                    <li>&raquo; <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=A545FWZ8AB5GL">Make a donation</a></li>
                </ul>
                <h2>Other links</h2>
                <ul>
                    <li>&raquo; <a href="http://burnmind.com">burnmind.com</a></li>
                    <li>&raquo; <a href="http://twitter.com/stathisg">@stathisg</a></li>
                    <li>&raquo; <a href="http://wordpress.org/extend/plugins/how-old-am-i/">How Old Am I</a> WordPress plugin</li>
                </ul>
            </div>
            <?php
        }
    }
}

if (class_exists("HelloInAllLanguages"))
{
    $helloClass = new HelloInAllLanguages();
}

if (!function_exists("HelloInAllLanguages_Admin"))
{
    function HelloInAllLanguages_Admin()
    {
        global $helloClass;
        if (!isset($helloClass))
        {
            return;
        }
        if (function_exists('add_options_page'))
        {
            add_options_page('Hello In All Languages Settings', 'Hello In All Languages', 'manage_options', basename(__FILE__), array(&$helloClass, 'printAdminPage'));
        }
    }
}

if (isset($helloClass))
{
    register_activation_hook(__FILE__, array(&$helloClass, 'createTable'));
    register_deactivation_hook(__FILE__, array(&$helloClass, 'dropTable'));
    add_shortcode('HELLO-IN-ALL-LANGUAGES', array( &$helloClass, 'displayHello'));
    add_action('admin_menu', 'HelloInAllLanguages_Admin');
}

function helloInAllLanguagesSettingsLink($links) { 
    $settings_link = '<a href="options-general.php?page=hello-in-all-languages.php">Settings</a>'; 
    array_unshift($links, $settings_link); 
    return $links; 
}

$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'helloInAllLanguagesSettingsLink' );
?>