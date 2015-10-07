<?php


/**
 * Plugin Name: Simple Login Shortcodes
 * Description: Simple shortcodes to hide or show content based on user login
 * Version: 0.1-alpha
 * Author: Trenton Maki
 * Author URI: my-website.site
 * Text Domain: simple-login-shortcodes
 *
 * This is free and unencumbered software released into the public domain.
 *
 * Anyone is free to copy, modify, publish, use, compile, sell, or
 * distribute this software, either in source code form or as a compiled
 * binary, for any purpose, commercial or non-commercial, and by any
 * means.
 *
 * In jurisdictions that recognize copyright laws, the author or authors
 * of this software dedicate any and all copyright interest in the
 * software to the public domain. We make this dedication for the benefit
 * of the public at large and to the detriment of our heirs and
 * successors. We intend this dedication to be an overt act of
 * relinquishment in perpetuity of all present and future rights to this
 * software under copyright law.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * For more information, please refer to <http://unlicense.org/>
 */

//Adapted from: http://714web.com/wordpress-shortcode-to-show-or-hide-content/
function logged_in($atts, $content = null)
{
    $attributes = shortcode_atts(array(
        "roles" => "administrator, editor, author",
        "hide_for_admin" => "false"
    ), $atts);
    $unfilteredRoles = explode(",", $attributes["roles"]);
    $trimmedRoles = array_map("trim", $unfilteredRoles);
    $roles = array_map("strtolower", $trimmedRoles);

    $admin = filter_var($attributes["hide_for_admin"], FILTER_VALIDATE_BOOLEAN) ? false : is_admin();

    $user = wp_get_current_user();
    if (is_user_logged_in() && !is_null($content) && !is_feed() && (array_intersect(array_map("strtolower", ($user->roles)),
                $roles) || $admin)
    ) {
        return $content;
    }
    return '';
}

add_shortcode('logged_in', 'logged_in');

//Adapted from: http://714web.com/wordpress-shortcode-to-show-or-hide-content/
function logged_out($atts, $content = null)
{
    if (!is_user_logged_in() && !is_null($content) && !is_feed()) {
        return $content;
    }
    return '';
}

add_shortcode('logged_out', 'logged_out');