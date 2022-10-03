<?php
$settings = lwp_get_option( $this->id . "-config" );

$apikey = isset( $settings['apikey'] ) ? esc_attr( $settings['apikey'] ) : null;
?>

<style>
    /* Action Tab */
    #tab-dripsender-log:checked ~ .tab-body-wrapper #tab-body-dripsender-log,
    #tab-dripsender-settings:checked ~ .tab-body-wrapper #tab-body-dripsender-settings {
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
    <input type="radio" name="dripsender" id="tab-dripsender-log" checked="checked"/>
    <label class="tab" for="tab-dripsender-log"><?php _e( 'Log', 'lokuswp' ); ?></label>

    <input type="radio" name="dripsender" id="tab-dripsender-settings"/>
    <label class="tab" for="tab-dripsender-settings"><?php _e( 'Settings', 'lokuswp' ); ?></label>

    <div class="tab-body-wrapper">

        <!------------ Tab : Test and Log ------------>
        <div id="tab-body-dripsender-log" class="tab-body">

            <!--			<div class="divider" data-content="Test Notification"></div>-->
            <!--			<div class="input-group" style="width:50%;">-->
            <!--				<input id="lokuswp_dripsender_test" style="margin-top:3px;" class="form-input input-md"-->
            <!--				       type="text" placeholder="0812387621f812">-->
            <!--				<button id="lokuswp_dripsender_sendtest" style="margin-top:3px;"-->
            <!--				        class="btn btn-primary input-group-btn">-->
            <?php //_e( 'Test Notification', "lokuswp" ); ?><!--</button>-->
            <!--			</div>-->

            <div class="divider" data-content="Test: Messaging"></div>

            <div class="input-group" style="width:50%;">
                <input id="lwp_dripsender_test_phone" style="margin-top:3px;" class="form-input input-md" type="text"
                       placeholder="081238642022">
                <button id="lwp_dripsender_test" style="margin-top:3px;"
                        class="btn btn-primary input-group-btn">
			        <?php _e('Send Message', 'lokuswp');?> </button>
            </div>

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
        <div id="tab-body-dripsender-settings" class="tab-body">

            <form class="form-horizontal">

                <!-- API Key -->
                <div class="form-group">
                    <div class="col-3 col-sm-12">
                        <label class="form-label" for="apikey"><?php _e( 'API Key', "lokuswp-dripsender" ); ?></label>
                    </div>
                    <div class="col-9 col-sm-12">
                        <input class="form-input" type="password" autocompleted="off" name="apikey"
                               placeholder="e7cd0e25157124d565fe16ac516d" style="width:320px"
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
    // Save Template
    // On User Sending Test Message
    jQuery(document).on("click", "#lwp_dripsender_test", function (e) {
        const elTextPhone = jQuery('#lwp_dripsender_phone_test');
        const that = this;

        if (elTextPhone.val() !== '') {
            jQuery(this).addClass('loading');
            elTextPhone.css('border', 'none');

            jQuery.post(lokuswp_admin.ajax_url, {
                action: 'wp_ajax_lokuswp_notification_onesender_test',
                phone: elTextPhone.val(),
                security: lokuswp_admin.ajax_nonce,
            }, function (response) {

                if (response.trim() == 200) {
                    jQuery(that).removeClass('loading');
                    jQuery(that).text("Success");
                } else {
                    jQuery(that).removeClass('loading');
                    jQuery(that).text("Failed");
                }

            }).fail(function () {
                alert('Failed, please check your internet');
            });

        } else {
            elTextPhone.css('border', '1px solid red');
        }
    });
</script>

<?php
//
//// Action for Save Option and Test
//add_action( 'wp_ajax_lokuswp_notification_onesender_test', 'lwp_wagateway_dripsender_test' );
//function lwp_wagateway_dripsender_test(){
//	$phone = lwp_sanitize_phone( $_POST['phone'] );
//
//	$this->send( array(
//		'recipient' => $phone,
//		'template'  => "Test : Sending Message with DripSender by LokusWP",
//	) );
//
//	wp_send_json_success();
//}