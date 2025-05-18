<?php
/**
 * @package litespeed_decloud
 * @version 1.0
 */
/*
Plugin Name: LiteSpeed DeCloud: Remove QUIC.cloud features
Plugin URI: https://wordpress.org/plugins/litespeed-decloud/
Description: Hides QUIC.cloud features from LiteSpeed Cache plugin.
Author: Morrow Shore
Version: 1.0
Author URI: https://morrowshore.com
*/

function decloud_ls()
{
    if (!is_admin()) {
        return;
    }
?>
    <style type="text/css">
        .litespeed-dashboard-group-quic,
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
        [id*="litespeed-notice-cloud"] {
            display: none !important;
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const targetValues = [
                'optm-ucss',
                'optm-ucss_inline',
                'optm-css_async',
                'media-lqip',
                'media-lqip_qual',
                'media-lqip_min_w',
                'media-lqip_min_h',
                'media-lqip_exc',
                'media-placeholder_resp_async',
                'optm-ucss_file_exc_inline',
                'optm-ucss_whitelist',
                'optm-ucss_exc'
            ];
            document.querySelectorAll('input[type="hidden"][name="_settings-enroll[]"]').forEach(input => {
                if (targetValues.includes(input.value)) {
                    input.closest('tr').style.display = 'none';
                }
            });

        });
    </script>
<?php
}

add_action('admin_footer', 'decloud_ls', 9999);
add_action('admin_print_styles', 'decloud_ls', 9999);

add_action('admin_footer', function () {
    echo '<script>document.querySelectorAll("a[href*=\'page=litespeed-\']").forEach(l => {let p = new URL(l.href).searchParams.get("page"),
                m = {
                    "litespeed-cdn":        "#cf",
                    "litespeed-presets":    "#import_export",
                    "litespeed-general":    "#settings"
                }[p]; if (m && !l.href.includes(m)) {l.href += m;}
         });
    </script>';
}, 999);
?>
