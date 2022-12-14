<?php
$settings = lwp_get_option( $this->id . "-config" );

$apiurl = isset( $settings['apiurl'] ) ? esc_attr( $settings['apiurl'] ) : null;
$apikey = isset( $settings['apikey'] ) ? esc_attr( $settings['apikey'] ) : null;
?>

<style>
    /* Action Tab */
    #tab-wablas-log:checked ~ .tab-body-wrapper #tab-body-wablas-log,
    #tab-wablas-settings:checked ~ .tab-body-wrapper #tab-body-wablas-settings {
        position: relative;
        top: 0;
        opacity: 1;
    }

    .tab-body-wrapper .table-log th {
        display: inline-block;
    }

    .tab-body-wrapper .table-log tr {
        margin-bottom: 0;
    }

    .tab-body-wrapper .table-log tbody tr td {
        display: inline-block;
        padding: 10px;
    }

    .tab-body-wrapper .table-log.table td,
    .tab-body-wrapper .table-log.table th {
        border-bottom: 0;
    }

    .tab-body-wrapper label.fix {
        margin-top: 3px;
        font-weight: 600;
        float: left;
        padding: 5px 0 !important;
        font-size: 14px;
    }
</style>

<div class="tabs-wrapper">
    <input type="radio" name="wablas" id="tab-wablas-log" checked="checked"/>
    <label class="tab" for="tab-wablas-log"><?php _e( 'Log', 'lokuswp' ); ?></label>

    <input type="radio" name="wablas" id="tab-wablas-settings"/>
    <label class="tab" for="tab-wablas-settings"><?php _e( 'Settings', 'lokuswp' ); ?></label>

    <div class="tab-body-wrapper">

        <!------------ Tab : Test and Log ------------>
        <div id="tab-body-wablas-log" class="tab-body">

            <!--			<div class="divider" data-content="Test Notification"></div>-->
            <!--			<div class="input-group" style="width:50%;">-->
            <!--				<input id="lokuswp_wablas_test" style="margin-top:3px;" class="form-input input-md"-->
            <!--				       type="text" placeholder="0812387621f812">-->
            <!--				<button id="lokuswp_wablas_sendtest" style="margin-top:3px;"-->
            <!--				        class="btn btn-primary input-group-btn">-->
            <?php //_e( 'Test Notification', "lokuswp" ); ?><!--</button>-->
            <!--			</div>-->

            <div class="divider" data-content="Notification Log"></div>
            <table class="table-log table table-striped table-hover">
                <tbody>
                <?php $db = lwp_get_option( $this->id . '-log' ); ?>
                <?php $log = json_decode( $db, true ) ?? []; ?>

                <?php if ( $log ) : ?>
                    <?php foreach ( array_reverse( $log ) as $key => $value ) : ?>
                        <tr>
                            <td><?php echo lwp_date_format( $value[0], 'j M Y, H:i:s' ); ?></td>
                            <td><?php echo json_encode( $value[1] ); ?></td>
                            <td><?php echo $value[2]; ?></td>
                            <td><?php echo $value[3]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td><?php _e( 'Empty Log', 'lokuswp' ); ?></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>

        <!------------ Tab : Settings ------------>
        <div id="tab-body-wablas-settings" class="tab-body">

            <form class="form-horizontal">

                <!-- API URL -->
                <div class="form-group">
                    <div class="col-3 col-sm-12">
                        <label class="form-label" for="apikey"><?php _e( 'Host', "lokuswp-wablas" ); ?></label>
                    </div>
                    <div class="col-9 col-sm-12">
                        <input class="form-input" type="text" name="apiurl"
                               placeholder="https://texas.wablas.com" style="width:320px"
                               value="<?= $apiurl; ?>">
                    </div>
                </div>

                <!-- Sender Email -->
                <div class="form-group">
                    <div class="col-3 col-sm-12">
                        <label class="form-label" for="apikey"><?php _e( 'Token', "lokuswp-wablas" ); ?></label>
                    </div>
                    <div class="col-9 col-sm-12">
                        <input class="form-input" type="password" autocompleted="off" name="apikey"
                               placeholder="srJNJ6FU3IceEv0rmumz86n0W8wXaHbB1We8E2TlVU9lC0KqCM1U" style="width:320px"
                               value="<?= $apikey; ?>">
                    </div>
                </div>

                <button type="button" class="btn btn-primary lokuswp_admin_option_save"
                        option="<?php echo $this->id; ?>-config"
                        style="width:120px"><?php _e( 'Save', "lokuswp" ); ?></button>
            </form>

        </div>
    </div>

</div>

<script>

    // // On User Sending Test Email
    // jQuery(document).on("click", "#lokuswp_wablas_sendtest", function (e) {
    //     const elTextPhone = jQuery('#lokuswp_wablas_test');
    //     const that = this;
    //
    //     if (elTextPhone.val() !== '') {
    //         jQuery(this).addClass('loading');
    //         elTextPhone.css('border', 'none');
    //
    //         jQuery.post(lokuswp_admin.ajax_url, {
    //             action: 'lokuswp_notification_wablas_test',
    //             phone: elTextPhone.val(),
    //             security: lokuswp_admin.ajax_nonce,
    //         }, function (response) {
    //
    //             if (response.trim() == 200) {
    //                 jQuery(that).removeClass('loading');
    //                 jQuery(that).text("Success");
    //             } else {
    //                 jQuery(that).removeClass('loading');
    //                 jQuery(that).text("Failed");
    //             }
    //
    //         }).fail(function () {
    //             alert('Failed, please check your internet');
    //         });
    //
    //     } else {
    //         elTextPhone.css('border', '1px solid red');
    //     }
    // });
</script>