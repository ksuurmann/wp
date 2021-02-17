<?php

$is_floating = isset($floating) && 'yes' == $floating;
$position    = wp_dark_mode_get_settings('wp_dark_mode_display', 'switcher_position', 'right_bottom');
$light_text  = wp_dark_mode_get_settings('wp_dark_mode_display', 'switch_text_light', 'Light');
$dark_text   = wp_dark_mode_get_settings('wp_dark_mode_display', 'switch_text_dark', 'Dark');

?>
<input type="checkbox" id="wp-dark-mode-switch" class="wp-dark-mode-switch">
<div class="wp-dark-mode-switcher wp-dark-mode-ignore switch-align-<?php echo $align; ?> style-4 <?php echo $is_floating ? "floating $position" : ''; ?>">

    <p><?php echo $light_text; ?></p>
    <label for="wp-dark-mode-switch">
        <div class="modes">
            <img class="light" alt="Light Mode" src="<?php echo wp_dark_mode()->plugin_url('assets/images/btn-4/sun.png'); ?>">
            <img class="dark" alt="Dark Mode" src="<?php echo wp_dark_mode()->plugin_url('assets/images/btn-4/moon.png'); ?>">
        </div>
    </label>
    <p><?php echo $dark_text; ?></p>

</div>