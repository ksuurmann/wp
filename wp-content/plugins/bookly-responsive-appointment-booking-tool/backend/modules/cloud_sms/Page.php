<?php
namespace Bookly\Backend\Modules\CloudSms;

use Bookly\Lib;
use Bookly\Backend\Modules\CloudProducts\Page as CloudProducts;
use Bookly\Backend\Components;

/**
 * Class Controller
 * @package Bookly\Backend\Modules\CloudSms
 */
class Page extends Lib\Base\Component
{
    /**
     * Render page.
     */
    public static function render()
    {
        $cloud = Lib\Cloud\API::getInstance();
        if ( ! $cloud->account->loadProfile() ) {
            Components\Cloud\LoginRequired\Page::render( __( 'SMS Notifications', 'bookly' ), self::pageSlug() );
        } else {
            self::enqueueStyles( array(
                'frontend' => array( 'css/ladda.min.css', 'css/intlTelInput.css' ),
                'backend'  => array( 'bootstrap/css/bootstrap.min.css', ),
            ) );

            self::enqueueScripts( array(
                'backend'  => array(
                    'bootstrap/js/bootstrap.min.js' => array( 'jquery' ),
                    'js/datatables.min.js'          => array( 'jquery' ),
                    'js/moment.min.js',
                    'js/daterangepicker.js'         => array( 'jquery' ),
                    'js/alert.js'                   => array( 'jquery' ),
                    'js/select2.min.js'             => array( 'jquery' ),
                ),
                'frontend' => array_merge(
                    array(
                        'js/spin.min.js'  => array( 'jquery' ),
                        'js/ladda.min.js' => array( 'jquery' ),
                    ),
                    get_option( 'bookly_cst_phone_default_country' ) == 'disabled'
                        ? array()
                        : array( 'js/intlTelInput.min.js' => array( 'jquery' ) )
                ),
                'module'   => array(
                    'js/sms.js'                => array( 'bookly-notifications-list.js', ),
                    'js/notifications-list.js' => array( 'jquery', ),
                )
            ) );

            // Prepare tables settings.
            $datatables = Lib\Utils\Tables::getSettings( array(
                'sms_notifications',
                'sms_details',
                'sms_prices',
                'sms_sender',
            ) );

            $current_tab = self::hasParameter( 'tab' ) ? self::parameter( 'tab' ) : 'notifications';

            // Number of undelivered sms.
            $undelivered_count = Lib\Cloud\SMS::getUndeliveredSmsCount();

            wp_localize_script( 'bookly-sms.js', 'BooklyL10n',
                array(
                    'csrfToken'     => Lib\Utils\Common::getCsrfToken(),
                    'areYouSure'    => __( 'Are you sure?', 'bookly' ),
                    'country'       => $cloud->account->getCountry(),
                    'current_tab'   => $current_tab,
                    'intlTelInput'  => array(
                        'country' => get_option( 'bookly_cst_phone_default_country' ),
                        'utils'   => plugins_url( 'intlTelInput.utils.js', Lib\Plugin::getDirectory() . '/frontend/resources/js/intlTelInput.utils.js' ),
                        'enabled' => get_option( 'bookly_cst_phone_default_country' ) != 'disabled',
                    ),
                    'datePicker'    => Lib\Utils\DateTime::datePickerOptions(),
                    'dateRange'     => Lib\Utils\DateTime::dateRangeOptions( array( 'lastMonth' => __( 'Last month', 'bookly' ), ) ),
                    'sender_id'     => array(
                        'sent'        => __( 'Sender ID request is sent.', 'bookly' ),
                        'set_default' => __( 'Sender ID is reset to default.', 'bookly' ),
                    ),
                    'zeroRecords'   => __( 'No records for selected period.', 'bookly' ),
                    'noResults'     => __( 'No records.', 'bookly' ),
                    'processing'    => __( 'Processing...', 'bookly' ),
                    'state'         => array( __( 'Disabled', 'bookly' ), __( 'Enabled', 'bookly' ) ),
                    'action'        => array( __( 'enable', 'bookly' ), __( 'disable', 'bookly' ) ),
                    'edit'          => __( 'Edit', 'bookly' ),
                    'settingsSaved' => __( 'Settings saved.', 'bookly' ),
                    'gateway'       => 'sms',
                    'datatables'    => $datatables
                )
            );

            self::renderTemplate( 'index', compact( 'cloud', 'datatables', 'undelivered_count' ) );
        }
    }

    /**
     * Show 'SMS Notifications' submenu with counter inside Bookly main menu.
     */
    public static function addBooklyMenuItem()
    {
        $sms = __( 'SMS Notifications', 'bookly' );

        $cloud = Lib\Cloud\API::getInstance();

        $promotion = $cloud->general->getPromotionForNotice();
        if ( $promotion ) {
            $title = sprintf( '%s <span class="update-plugins"><span class="update-count">$</span></span>', $sms );
        } else {
            $count = Lib\Cloud\SMS::getUndeliveredSmsCount();
            $title = $count ? sprintf( '%s <span class="update-plugins"><span class="update-count">%d</span></span>', $sms, $count ) : $sms;
        }

        $page = $cloud->getToken() && $cloud->account->productActive( 'sms' ) ? self::pageSlug() : CloudProducts::pageSlug();

        add_submenu_page(
            'bookly-menu',
            $sms,
            '<span id="bookly-js-sms-menu-redirect">' . $title . '</span><script>document.getElementById("bookly-js-sms-menu-redirect").parentNode.href+="=' . $page . '";</script>',
            Lib\Utils\Common::getRequiredCapability(),
            '',
            function () { Page::render(); }
        );
    }

    /**
     * Show 'SMS Notifications' submenu with counter inside Bookly Cloud main menu.
     *
     * @param array $product
     */
    public static function addBooklyCloudMenuItem( $product )
    {
        $sms = $product['texts']['title'];

        $count = Lib\Cloud\SMS::getUndeliveredSmsCount();
        $title = $count ? sprintf( '%s <span class="update-plugins"><span class="update-count">%d</span></span>', $sms, $count ) : $sms;

        add_submenu_page(
            'bookly-cloud-menu',
            $sms,
            $title,
            Lib\Utils\Common::getRequiredCapability(),
            self::pageSlug(),
            function () { Page::render(); }
        );
    }
}