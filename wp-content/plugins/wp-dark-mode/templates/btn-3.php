<?php

$is_floating = isset($floating) && 'yes' == $floating;
$position    = wp_dark_mode_get_settings('wp_dark_mode_display', 'switcher_position', 'right_bottom');

?>
<input type="checkbox" id="wp-dark-mode-switch" class="wp-dark-mode-switch">
<div class="wp-dark-mode-switcher wp-dark-mode-ignore switch-align-<?php echo $align; ?>  style-3 <?php echo $is_floating ? "floating $position" : ''; ?>">

    <img class="sun-light" alt="Light Mode" src="<?php echo wp_dark_mode()->plugin_url('assets/images/btn-3/sun-light.png'); ?>">
    <img class="sun-dark" alt="Dark Mode" src="<?php echo wp_dark_mode()->plugin_url('assets/images/btn-3/sun-dark.png'); ?>">
    <label for="wp-dark-mode-switch">
        <div class="toggle"></div>
    </label>
    <img class="moon-dark" alt="Dark Mode" src="<?php echo wp_dark_mode()->plugin_url('assets/images/btn-3/moon-dark.png'); ?>">
    <img class="moon-light" alt="Light Mode" src="<?php echo wp_dark_mode()->plugin_url('assets/images/btn-3/moon-light.png'); ?>">

</div>