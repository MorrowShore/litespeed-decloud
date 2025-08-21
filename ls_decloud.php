<?php
/**
 * @package ls_decloud
 * @version 1.2
 */
/*
Plugin Name: DeCloud for LiteSpeed: Remove QUIC.cloud Features
Plugin URI: https://wordpress.org/plugins/litespeed-decloud/
Description: Hides QUIC.cloud features from LiteSpeed Cache plugin.
Author: Morrow Shore
Version: 1.2
Author URI: https://morrowshore.com
License: AGPLv3 or later
License URI: https://www.gnu.org/licenses/agpl-3.0.en.html
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function ls_decloud_enqueue() {
    if (!is_admin()) {
        return;
    }
    
    $lsdccss1 = '
        .litespeed-dashboard-group-quic,
        .litespeed-dashboard-qc-enable,
        .litespeed-dashboard-unlock,
        .litespeed-dashboard-cloud-banner,
        .litespeed-postbox-quiccloud,
        .litespeed-postbox--quiccloud,
        .litespeed-menu-presets,
        .litespeed-tab[data-litespeed-tab="standard"],
        a[data-litespeed-tab="online"],
        div[data-litespeed-layout="online"],
        .litespeed-form-group.litespeed-form-group-guest,
        a[data-litespeed-tab="esi"],
        div[data-litespeed-layout="esi"],
        a[data-litespeed-tab="settings_vpi"],
        div[data-litespeed-layout="settings_vpi"],
        a[data-litespeed-tab="qc"],
        div[data-litespeed-layout="qc"],
        a[data-litespeed-tab="standard"],
        div[data-litespeed-layout="standard"],
        .litespeed-dashboard-unlock--inline,
        .litespeed-menu-img_optm,
        .litespeed-form-group.litespeed-form-group-css_ucss,
        .litespeed-form-group.litespeed-form-group-css_ucss_inline,
        .litespeed-form-group.litespeed-form-group-css_async,
        .litespeed-form-group.litespeed-form-group-css_async_inline,
        .litespeed-form-group.litespeed-form-group-css_async_inline_aggressive,
        .litespeed-form-group.litespeed-form-group-media_lqip,
        .litespeed-form-group.litespeed-form-group-media_lqip_qual,
        .litespeed-form-group.litespeed-form-group-media_lqip_min_w,
        .litespeed-form-group.litespeed-form-group-media_lqip_min_h,
        .litespeed-form-group.litespeed-form-group-media_lqip_cron,
        .litespeed-form-group.litespeed-form-group-role_simulation,
        .litespeed-quic-icon,
        .litespeed-banner-quic-cloud,
        .litespeed-notice-quic,
        [class*="litespeed-notice-cloud"],
        .postbox.litespeed-postbox.litespeed-postbox-pagespeed,
        .postbox.litespeed-postbox.litespeed-postbox-pagetime,
        .postbox.litespeed-postbox.litespeed-postbox-double.litespeed-postbox-imgopt,
        .postbox.litespeed-postbox.litespeed-postbox-ccss,
        .postbox.litespeed-postbox.litespeed-postbox-lqip,
        .postbox.litespeed-postbox.litespeed-postbox-vpi,
        .postbox.litespeed-postbox.litespeed-postbox-ucss,
        .postbox.litespeed-postbox.litespeed-postbox-quiccloud.litespeed-postbox--quiccloud,
        p.litespeed-right.litespeed-qc-dashboard-link,
        .litespeed-dashboard-stats-wrapper,
        p.litespeed-desc.litespeed-margin-top-remove,
        .litespeed-dashboard-header,
        .wp-submenu a[href*="page=litespeed-img_optm"],
        .litespeed-tab[data-litespeed-tab="standard"],
        a.litespeed-tab[data-litespeed-tab="online"],
        a.nav-tab[data-litespeed-tab="online"],
        a.litespeed-tab[href="#online"],
        a.litespeed-tab[href="#standard"],
        .litespeed_icon.notice.notice-error.is-dismissible,
        .wp-list-table.litespeed-table tr:nth-child(3),
        [id*="litespeed-notice-cloud"] {
            display: none !important;
        }
    ';
    
    wp_add_inline_style('common', $lsdccss1);
    
    $lsdcjs1 = '
        document.addEventListener("DOMContentLoaded", function() {
            const targetValues = [
                "optm-ucss",
                "optm-ucss_inline",
                "optm-css_async",
                "media-lqip",
                "media-lqip_qual",
                "media-lqip_min_w",
                "media-lqip_min_h",
                "media-lqip_exc",
                "media-placeholder_resp_async",
                "optm-ucss_file_exc_inline",
                "optm-ucss_whitelist",
                "optm-ucss_exc"
            ];
            document.querySelectorAll("input[type=\\"hidden\\"][name=\\"_settings-enroll[]\\"]").forEach(input => {
                if (targetValues.includes(input.value)) {
                    input.closest("tr").style.display = "none";
                }
            });
        });
    ';
    
    wp_add_inline_script('common', $lsdcjs1);
}

function ls_decloud_footer() {
    if (!is_admin()) {
        return;
    }
    
    $lsdcjs2 = '
        document.querySelectorAll("a[href*=\'page=litespeed-\']").forEach(l => {
            let p = new URL(l.href).searchParams.get("page"),
            m = {
                "litespeed-cdn": "#cf",
                "litespeed-presets": "#import_export",
                "litespeed-general": "#settings"
            }[p];
            if (m && !l.href.includes(m)) {
                l.href += m;
            }
        });
    ';
    
    wp_add_inline_script('common', $lsdcjs2);
}

add_action('admin_enqueue_scripts', 'ls_decloud_enqueue');
add_action('admin_footer', 'ls_decloud_footer', 999);
?>