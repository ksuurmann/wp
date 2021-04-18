<?php
/*
Plugin Name: Easter Egg Drop
Description: Subtle easter egg animation with customisable message popup
License: GPLv2
Version: 1.1.0
Author: Square Media
Author URI: https://squaremedia.solutions/

Easter Egg Drop is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Easter Egg Drop is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Easter Egg Drop.
*/

//Add to document head
add_action('wp_head', 'logistics_head');
function logistics_head()
{
    ?>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <?php
    if(!isset($_COOKIE['easter_egg_count'])) { //if the cookie doesn't exist
        setcookie('easter_egg_count', 0, 0); //set it and initialise it to zero
    }
}

add_action('wp_enqueue_scripts', 'square_media_egg_scripts');
function square_media_egg_scripts()
{
    wp_enqueue_style(
        'sm-easter-eggs',
        plugins_url('/css/eggs.css', __FILE__),
        array(),
        filemtime(dirname(__FILE__).'/css/eggs.css')
    );
    wp_enqueue_script(
        'sm-easter-eggs-js',
        plugins_url('/js/eggs.js', __FILE__),
        array('jquery'),
        filemtime(dirname(__FILE__).'/js/eggs.js')
    );
}

add_action('wp_footer', 'square_media_egg_html');
function square_media_egg_html()
{
    $max_drops = get_option('square_media_egg_max_drops');
    if((int)$_COOKIE['easter_egg_count'] < $max_drops || $max_drops == 0) {
        $egg_colour = get_option('square_media_egg_colour');
        $egg_colour = $egg_colour !== '' ? $egg_colour : '#86bc25';
        $popup_message = get_option('square_media_egg_popup_message');
        $popup_message = $popup_message !== '' ? $popup_message : 'Happy Easter!';
        $side_of_page = get_option('square_media_egg_side_of_page');
        $stop_after_popup = get_option('square_media_egg_stop_after_popup');
        ?>
        <div class="smEasterEgg">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 301.84 402.26">
                <defs>
                    <style>.cls-1 {
                            fill: #86bc25;
                        }</style>
                </defs>
                <g id="Layer_2" data-name="Layer 2">
                    <g id="Layer_1-2" data-name="Layer 1">
                        <path class="cls-1"
                              d="M285.57,175.36a54.41,54.41,0,0,0,12.12,30.73q1.71,2.06,3.65,4a295,295,0,0,0-10.53-61.93,53.21,53.21,0,0,0-5.24,27.21Z"/>
                        <path class="cls-1"
                              d="M45.26,353.05a4.88,4.88,0,0,1,3.92.3,6.42,6.42,0,0,1,2.66,3,4,4,0,0,0,.61,1c1.79,1.09,5-.85,6.49-2.65a19.22,19.22,0,0,0-6.54-29.27,24.09,24.09,0,0,0-21.56.89,24.93,24.93,0,0,0-5.13,3.76,2.25,2.25,0,0,1-.47.34,150.28,150.28,0,0,0,17.62,24.42,5.08,5.08,0,0,1,2.4-1.8Z"/>
                        <path class="cls-1"
                              d="M143.54,2.91A9.48,9.48,0,0,0,148,0a86.52,86.52,0,0,0-15.34,1.93A14.88,14.88,0,0,0,143.54,2.91Z"/>
                        <path class="cls-1"
                              d="M167.39,14.42a38.74,38.74,0,0,1,4.74-.63,27,27,0,0,1,21.74,8.31,29.56,29.56,0,0,1,8,23.8,34.33,34.33,0,0,1-9.58,20.18c-5.65,5.77-15.19,10.77-23.79,9a2.5,2.5,0,0,1,.14-4.92c7.68-1.16,15-7,18.64-14.79,3.15-6.76,3-13.86-.46-19.49-2.85-4.66-6.49-7.27-11.13-8-9.2-1.37-20.6,5.32-28.2,12.05C132,53.57,122.08,70.75,114.16,88.12c.8-.57,1.62-1.11,2.46-1.63,9.09-5.62,19.68-7.9,31.51-6.77l.15,0c15.75,2.46,27.88,11.42,33.28,24.57,5.77,14.06,2.63,30.9-7.43,40.5a40.64,40.64,0,0,1,15,3.79,50.48,50.48,0,0,1-1.76-7.81,35.25,35.25,0,0,1,8.76-29,38.52,38.52,0,0,1,30.22-12.57,44.83,44.83,0,0,1,27.21,10.61c8,6.8,15.44,18.71,13.89,30a2.5,2.5,0,0,1-4.92.21c-2.34-10.35-11-19.75-22-23.94-9.54-3.63-19.24-2.7-26.61,2.57-6.06,4.33-9.38,9.77-9.87,16.16-1,12.64,9.15,27.39,18.94,37,20.81,20.35,46.71,32.26,70.57,40.93a65.66,65.66,0,0,1-4.49-5.5c-8.22-11.38-12.21-25.08-11.85-40.72,0,0,0-.1,0-.15a61.56,61.56,0,0,1,9-27.75,2.49,2.49,0,0,1,1.37-1c-22-68.22-66.85-123.49-116.94-135.3a31.38,31.38,0,0,1-3.29,12.13Z"/>
                        <path class="cls-1"
                              d="M134.11,125.66a2.54,2.54,0,0,1-.82.16,3.29,3.29,0,0,0-2.58,1,3.59,3.59,0,0,0-.16,3.08c2.31,7.72,8.91,13.91,16.41,15.38a23,23,0,0,0,20.1-5.3,28.62,28.62,0,0,0,9.18-23.45C174.87,97,157.47,86.71,141,86.69h0A40.17,40.17,0,0,0,117.7,94a43.51,43.51,0,0,0-9.24,8.93c-.22.29-1,1.63-1.56,2.7l-.66,1.16q-1.86,4.62-3.68,9.26c-2.21,5.59-4.5,11.38-6.85,17-13.46,32.2-31.64,68.17-64.35,90.74A132.69,132.69,0,0,1,1.05,239.29a2.34,2.34,0,0,1-.73.13c1.57,33.08,9.24,61.42,21.46,84.75a33.24,33.24,0,0,1,13.95-7.32l.13,0c9-1.73,17-.35,23.07,4a27.2,27.2,0,0,1,11.49,20.34c.54,8.13-2.28,15.7-7.72,20.78a17.1,17.1,0,0,1-8.4,4.42,140.59,140.59,0,0,0,15.47,12,2.53,2.53,0,0,1,1.34-1c25.25-7.79,46-26.75,57-52,8.21-18.92,11.6-41.71,9.81-65.89A197.24,197.24,0,0,0,134.49,235,79,79,0,0,1,110,279.93c-11.57,10.54-25.4,16.81-40,18.13-13.1,1.19-30.61-.32-39.74-14.26-10-15.31-2.41-32.5,8.9-42C49.79,232.92,71,227,83.3,239c5.84,5.7,7.46,13.37,4.23,20a28.75,28.75,0,0,1-19,15.17c-6.64,1.61-17.78-.12-20.57-8.95-2.29-7.21,3.58-15.1,10.36-17.34a2.5,2.5,0,0,1,2.87,3.76c-2.2,3.32-4,8.37-1.75,11.64,2.08,3,6.84,3.26,10.37,2.18a14.94,14.94,0,0,0,10-10.37,10.49,10.49,0,0,0-3.09-10.32c-7.69-7.4-17.54-5.36-22.72-3.49-11.45,4.13-20.56,14.25-21.67,24.06-1.5,13.29,11.12,24.3,23.85,26.25,13.35,2,30.11-2.55,43.75-12a66.77,66.77,0,0,0,26.28-39c2.33-11.59.76-25.65-1-35.45-5.06-15.52,4.14-36.75,15.61-47.57a52.42,52.42,0,0,1,4.91-4.09,29.44,29.44,0,0,1-11.83-4.77A32.6,32.6,0,0,1,121.7,132.2c-1.18-4-.6-10.52,2.42-14.62a8.76,8.76,0,0,1,7.12-3.82h.09a6.86,6.86,0,0,1,7,5.26c.54,2.85-1.11,5.45-4.2,6.64Z"/>
                        <path class="cls-1"
                              d="M115.9,65.1a171,171,0,0,1,13.07-22c5.87-8.27,15.51-19.33,28.19-25.26a22.41,22.41,0,0,0,3.67-5.18,25.79,25.79,0,0,0,2.58-9.1,13.27,13.27,0,0,1-1.7,3.33h0c-4,5.71-11,7.68-17.44,7.68a31.38,31.38,0,0,1-6.45-.66A34.78,34.78,0,0,1,122.61,6.1,2.42,2.42,0,0,1,121.86,5a111.82,111.82,0,0,0-23,11.22A88.54,88.54,0,0,1,115.9,65.1Z"/>
                        <path class="cls-1"
                              d="M301.28,225c-23.81-5.08-42.65-5.45-59.28-1.17a102.88,102.88,0,0,0-53.51,33.86c-15.47,18.44-23.77,43.12-23.37,69.49.33,21.67,11.11,46.12,34.46,51.94,13.52,3.36,27.36-2.64,37-16.05,11.52-16,13.54-36.62,4.91-50.22-2.34-3.7-8.91-12.21-19.21-11.38-7.72.62-14.57,6.45-17.46,14.84-2.44,7.09-1.79,16.46,4.18,20.68,6.67,4.71,15.55-1.21,19.75-5.46a2.5,2.5,0,0,1,4.26,2.05c-.75,6.55-5.36,13.59-11.19,17.11a14.77,14.77,0,0,1-13.36,1.47c-11.32-4.39-15.54-16.85-14.7-27.24,1-12.77,6.91-23.87,16.14-30.47,8.4-6,20-5.54,29.63,1.22,18.33,12.91,19.18,42.18,9.46,61.9a60,60,0,0,1-15.6,19.86c40.86-28,68.42-79.14,68.42-150.87,0-.51,0-1,0-1.51a2.56,2.56,0,0,1-.55-.05Z"/>
                        <path class="cls-1"
                              d="M205.77,387.85a41.47,41.47,0,0,1-12.46-2C174,379.82,161,360.82,157.6,333.76c-2.83-22.64,2.91-46.8,16.15-68,19.71-31.58,53.94-52,89.78-54.5A234.68,234.68,0,0,1,230,194.75c-11.51-7-27.05-18.69-36.05-34.88a30.57,30.57,0,0,0-7.55-4.6c-9-3.79-20.14-3.51-29.91.74-16.23,7.06-27.43,26.65-24.48,42.79,1.54,8.35,7.52,14.26,15.61,15.43,10.32,1.47,17.6-4.41,21.88-9.61,3.26-3.94,10.37-14.28,6.08-25a12.51,12.51,0,0,0-9-8,26.92,26.92,0,0,0-6.29-.3c-3.2.09-6.51.18-9.82-1.12a2.5,2.5,0,0,1-1.11-3.78c6.36-8.87,17.67-16.88,28.56-10.29,10.45,6.31,12.57,20.24,11.22,30.24-1.83,13.57-11.57,27.4-23.69,33.63-9.19,4.72-18.64,4.77-27.35.16l-.17-.1c2,7.43,3.62,14.76,4.83,21.84,3.07,18,3.6,34.86,1.59,50h0c-3.87,29.12-16.95,55.63-36.83,74.66a119.15,119.15,0,0,1-26,18.76,146.78,146.78,0,0,0,69.4,16.89c25.67,0,50.11-6.12,71.55-18.05a40.82,40.82,0,0,1-16.7,3.64Z"/>
                        <path class="cls-1"
                              d="M59.08,170a84.1,84.1,0,0,0,3.78-17.57c-.07-1.17-.11-1.46-.11-1.47a37.15,37.15,0,0,0-19.76-27,35.32,35.32,0,0,0-21.17-3.81,2.47,2.47,0,0,1-1.29-.15,299.6,299.6,0,0,0-14,46.4,2.55,2.55,0,0,1,.83.32,23.2,23.2,0,0,0,3.7,1.92,21.07,21.07,0,0,0,18.53-.71c2.49-1.28,5.44-4.56,4.57-7a4,4,0,0,0-1-1,7,7,0,0,1-2.64-3.47,5.23,5.23,0,0,1,.7-4.43,5.35,5.35,0,0,1,3.92-2.32,7.62,7.62,0,0,1,6.2,2.09c2.41,2.35,3.07,6,2.88,8.6-.34,4.93-3.12,9.47-7.8,12.8a27.48,27.48,0,0,1-16,4.93,32.18,32.18,0,0,1-8.5-1.17A29.79,29.79,0,0,1,5,174a284.33,284.33,0,0,0-5,52.6c0,1.79,0,3.58.05,5.35C28.49,220.32,50,197.79,59.08,170Z"/>
                        <path class="cls-1"
                              d="M64.57,105c12.16,10.83,14.59,28.33,12.8,41.09a95.43,95.43,0,0,1-5.65,21.27q2.58-4.53,5-9.31c7.2-14.39,13.06-29.71,18.72-44.53,2.07-5.41,4.2-11,6.38-16.47v0c5.61-18.66,7-32.87,4.65-46.07A76.07,76.07,0,0,0,93.28,20l0,0C68,37.68,45.69,66,29.23,100c12.27-4.86,26.43-3,35.34,4.94Z"/>
                        <path class="cls-1"
                              d="M43.31,116.45l.11,0a45.76,45.76,0,0,1,17.19,13.95,30.76,30.76,0,0,0-4.6-8.26c-7.69-9.8-20.45-12.85-29.8-13.68a2.44,2.44,0,0,1-.8-.22c-.64,1.44-1.28,2.9-1.9,4.37A46,46,0,0,1,43.31,116.45Z"/>
                    </g>
                </g>
            </svg>
        </div>
        <div class="smEasterEggMessage"><?php echo $popup_message; ?></div>
        <style type="text/css">.smEasterEgg path {
                fill: <?php echo $egg_colour; ?>;
            }</style>
        <script type="text/javascript">
            let square_media_egg_side_of_page = '<?php echo $side_of_page; ?>';
            let square_media_egg_stop_after_popup = '<?php echo $stop_after_popup; ?>';
        </script>
        <?php
        setcookie('easter_egg_count', $_COOKIE['easter_egg_count'] + 1, 0);
    }
}

add_action('admin_menu', 'square_media_egg_admin_menu');
function square_media_egg_admin_menu()
{
    add_options_page(
        'Easter egg drop',
        'Easter Egg Drop',
        'manage_options',
        'square-media-egg-settings-page',
        'square_media_egg_options_page');
}

function square_media_egg_options_page()
{
    ?>
    <h1>Easter Egg Drop Settings</h1>
    <form method="POST" action="options.php">
        <?php
        settings_fields('square-media-egg-settings-page');
        do_settings_sections('square-media-egg-settings-page');
        submit_button();
        ?>
    </form>
    <?php
}

add_action('admin_init', 'square_media_egg_settings_init');
function square_media_egg_settings_init()
{
    add_settings_section(
        'square_media_egg_settings_section',
        '',
        null,
        'square-media-egg-settings-page'
    );
    add_settings_field(
        'square_media_egg_colour',
        'Egg colour',
        'square_media_egg_colour',
        'square-media-egg-settings-page',
        'square_media_egg_settings_section'
    );
    add_settings_field(
        'square_media_egg_popup_message',
        'Popup message',
        'square_media_egg_popup_message',
        'square-media-egg-settings-page',
        'square_media_egg_settings_section'
    );
    add_settings_field(
        'square_media_egg_max_drops',
        'Maximum number of drops',
        'square_media_egg_max_drops',
        'square-media-egg-settings-page',
        'square_media_egg_settings_section'
    );
    add_settings_field(
        'square_media_egg_side_of_page',
        'Side of the page to drop on',
        'square_media_egg_side_of_page',
        'square-media-egg-settings-page',
        'square_media_egg_settings_section'
    );
    add_settings_field(
        'square_media_egg_stop_after_popup',
        'Stop showing egg after popup is displayed',
        'square_media_egg_stop_after_popup',
        'square-media-egg-settings-page',
        'square_media_egg_settings_section'
    );
    register_setting('square-media-egg-settings-page', 'square_media_egg_colour');
    register_setting('square-media-egg-settings-page', 'square_media_egg_popup_message');
    register_setting('square-media-egg-settings-page', 'square_media_egg_max_drops');
    register_setting('square-media-egg-settings-page', 'square_media_egg_side_of_page');
    register_setting('square-media-egg-settings-page', 'square_media_egg_stop_after_popup');
}

function square_media_egg_colour()
{
    ?>
    <input type="color" id="square_media_egg_colour" name="square_media_egg_colour"
           value="<?php echo get_option('square_media_egg_colour'); ?>">
    <?php
}

function square_media_egg_popup_message()
{
    ?>
    <input type="text" id="square_media_egg_popup_message" name="square_media_egg_popup_message"
           value="<?php echo get_option('square_media_egg_popup_message'); ?>"
           placeholder="Happy Easter!" style="width:100%; max-width:400px;">
    <?php
}

function square_media_egg_max_drops()
{
    ?>
    <input type="text" id="square_media_egg_max_drops" name="square_media_egg_max_drops"
           value="<?php echo get_option('square_media_egg_max_drops'); ?>"
           placeholder="Leave blank for unlimited" style="width:100%; max-width:400px;">
    <?php
}

function square_media_egg_side_of_page()
{
    $storedOption = get_option('square_media_egg_side_of_page');
    ?>
    <select id="square_media_egg_max_drops" name="square_media_egg_side_of_page">
        <option value="random"<?php echo $storedOption == 'random' ? ' selected' : ''; ?>>Random</option>
        <option value="left"<?php echo $storedOption == 'left' ? ' selected' : ''; ?>>Left</option>
        <option value="right"<?php echo $storedOption == 'right' ? ' selected' : ''; ?>>Right</option>
    </select>
    <?php
}

function square_media_egg_stop_after_popup()
{
    $storedOption = get_option('square_media_egg_stop_after_popup');
    ?>
    <input type="checkbox" id="square_media_egg_stop_after_popup" name="square_media_egg_stop_after_popup"
           value="1"<?php echo $storedOption == '1' ? ' checked="checked"' : ''; ?>>
    <?php
}