<?php
$settings = json_decode( lwp_get_option( $this->id . '-lwcommerce' ), true );
include LOKUSWP_WA_GATEWAY_PATH . 'src/includes/channel/templates/default-template-lwcommerce.php';

$pending_template_for_user = isset( $settings['pending']['user']['template']['id_ID'] ) ? esc_attr( $settings['pending']['user']['template']['id_ID'] ) : $template_pending_for_user;
$paid_template_for_user    = isset( $settings['paid']['user']['template']['id_ID'] ) ? esc_attr( $settings['paid']['user']['template']['id_ID'] ) : $template_paid_for_user;

$processing_template_for_user = isset( $settings['processing']['user']['template']['id_ID'] ) ? esc_attr( $settings['processing']['user']['template']['id_ID'] ) : $template_processing_for_user;
$cancelled_template_for_user  = isset( $settings['cancelled']['user']['template']['id_ID'] ) ? esc_attr( $settings['cancelled']['user']['template']['id_ID'] ) : $template_cancelled_for_user;

$pickup_template_for_user     = isset( $settings['pickup']['user']['template']['id_ID'] ) ? esc_attr( $settings['pickup']['user']['template']['id_ID'] ) : $template_pickup_for_user;
$shipped_template_for_user    = isset( $settings['shipped']['user']['template']['id_ID'] ) ? esc_attr( $settings['shipped']['user']['template']['id_ID'] ) : $template_shipped_for_user;

$completed_template_for_user  = isset( $settings['completed']['user']['template']['id_ID'] ) ? esc_attr( $settings['completed']['user']['template']['id_ID'] ) : $template_completed_for_user;

// ------------------ Admin ------------------ //

$receivers_for_admin_when_pending = isset( $settings['pending']['admin']['receivers'] ) ? esc_attr( $settings['pending']['admin']['receivers'] ) : "";
$pending_template_for_admin       = isset( $settings['pending']['admin']['template']['id_ID'] ) ? esc_attr( $settings['pending']['admin']['template']['id_ID'] ) : $template_pending_for_admin;

$receivers_for_admin_when_completed = isset( $settings['completed']['admin']['receivers'] ) ? esc_attr( $settings['completed']['admin']['receivers'] ) : "";
$completed_template_for_admin       = isset( $settings['completed']['admin']['template']['id_ID'] ) ? esc_attr( $settings['completed']['admin']['template']['id_ID'] ) : $template_completed_for_admin;
?>

<style>
    /* Action Tab */
    #<?= $this->id; ?>-tab1:checked ~ .tab-body-wrapper #<?= $this->id; ?>-tab-body-1,
    #<?= $this->id; ?>-tab2:checked ~ .tab-body-wrapper #<?= $this->id; ?>-tab-body-2,
    #<?= $this->id; ?>-tab3:checked ~ .tab-body-wrapper #<?= $this->id; ?>-tab-body-3,
    #<?= $this->id; ?>-tab4:checked ~ .tab-body-wrapper #<?= $this->id; ?>-tab-body-4,
    #<?= $this->id; ?>-tab5:checked ~ .tab-body-wrapper #<?= $this->id; ?>-tab-body-5,
    #<?= $this->id; ?>-tab6:checked ~ .tab-body-wrapper #<?= $this->id; ?>-tab-body-6,
    #<?= $this->id; ?>-tab7:checked ~ .tab-body-wrapper #<?= $this->id; ?>-tab-body-7{
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

    span.input-group-addon {
        height: 36px;
    }

    .tabs-wrapper input[type=radio]:checked + label.tab {
        margin-bottom: -2px;
    }
</style>

<h4>Pengaturan Template </h4>
<div class="tabs-wrapper">

    <input type="radio" name="<?= $this->id; ?>" id="<?= $this->id; ?>-tab1" checked="checked"/>
    <label class="tab" for="<?= $this->id; ?>-tab1"><?php _e( 'Pending', 'lokuswp' ); ?></label>

    <input type="radio" name="<?= $this->id; ?>" id="<?= $this->id; ?>-tab2"/>
    <label class="tab" for="<?= $this->id; ?>-tab2"><?php _e( 'Paid', 'lokuswp' ); ?></label>

    <input type="radio" name="<?= $this->id; ?>" id="<?= $this->id; ?>-tab3"/>
    <label class="tab" for="<?= $this->id; ?>-tab3"><?php _e( 'Processing', 'lokuswp' ); ?></label>

    <input type="radio" name="<?= $this->id; ?>" id="<?= $this->id; ?>-tab4"/>
    <label class="tab" for="<?= $this->id; ?>-tab4"><?php _e( 'Cancelled', 'lokuswp' ); ?></label>

    <input type="radio" name="<?= $this->id; ?>" id="<?= $this->id; ?>-tab5"/>
    <label class="tab" for="<?= $this->id; ?>-tab5"><?php _e( 'Shipped', 'lokuswp' ); ?></label>

    <input type="radio" name="<?= $this->id; ?>" id="<?= $this->id; ?>-tab6"/>
    <label class="tab" for="<?= $this->id; ?>-tab6"><?php _e( 'Pickup', 'lokuswp' ); ?></label>

    <input type="radio" name="<?= $this->id; ?>" id="<?= $this->id; ?>-tab7"/>
    <label class="tab" for="<?= $this->id; ?>-tab7"><?php _e( 'Completed', 'lokuswp' ); ?></label>


    <div class="tab-body-wrapper">

        <!------------ Tab : Pending ------------>
        <div id="<?= $this->id; ?>-tab-body-1" class="tab-body">

            <form>
                <h6><?php _e( "Untuk Pembeli", "lokuswp" ); ?></h6>
                <textarea class="form-input"
                          name="pending[user][template][id_ID]"
                          placeholder="<?= $pending_template_for_user; ?>"
                          rows="9"><?= $pending_template_for_user; ?>
                </textarea>

                <br>
                <h6><?php _e( "Untuk Admin", "lokuswp" ); ?></h6>
                <input type="text" class="form-input" name="pending[admin][receivers]"
                       placeholder="628238642022, 6285618257521" value="<?= $receivers_for_admin_when_pending; ?>">

                <textarea class="form-input"
                          name="pending[admin][template][id_ID]"
                          placeholder="<?= $pending_template_for_admin; ?>"
                          rows="3"><?= $pending_template_for_admin; ?></textarea>

                <button style="margin-top:12px" class="btn btn-primary input-group-btn lokuswp_admin_option_array_save"
                        option="<?= $this->id ?>-lwcommerce">
					<?php _e( 'Simpan', 'lokuswp' ); ?>
                </button>

            </form>

        </div>

        <!------------ Tab : Paid ------------>
        <div id="<?= $this->id; ?>-tab-body-2" class="tab-body">

            <form>
                <h6><?php _e( "Untuk Pembeli", "lokuswp" ); ?></h6>
                <textarea class="form-input"
                          name="paid[user][template][id_ID]"
                          placeholder="<?= $paid_template_for_user; ?>"
                          rows="9"><?= $paid_template_for_user; ?></textarea>

                <button style="margin-top:12px" class="btn btn-primary input-group-btn lokuswp_admin_option_array_save"
                        option="<?= $this->id ?>-lwcommerce">
				    <?php _e( 'Simpan', 'lokuswp' ); ?>
                </button>

            </form>

        </div>

        <!------------ Tab : Processing ------------>
        <div id="<?= $this->id; ?>-tab-body-3" class="tab-body">

            <form>
                <h6><?php _e( "Untuk Pembeli", "lokuswp" ); ?></h6>
                <textarea class="form-input"
                          name="processing[user][template][id_ID]"
                          placeholder="<?= $processing_template_for_user; ?>"
                          rows="9"><?= $processing_template_for_user; ?></textarea>

                <button style="margin-top:12px" class="btn btn-primary input-group-btn lokuswp_admin_option_array_save"
                        option="<?= $this->id ?>-lwcommerce">
					<?php _e( 'Simpan', 'lokuswp' ); ?>
                </button>

            </form>

        </div>

        <!------------ Tab : Cancelled ------------>
        <div id="<?= $this->id; ?>-tab-body-4" class="tab-body">

            <form>
                <h6><?php _e( "Untuk Pembeli", "lokuswp" ); ?></h6>
                <textarea class="form-input"
                          name="cancelled[user][template][id_ID]"
                          placeholder="<?= $cancelled_template_for_user; ?>"
                          rows="9"><?= $cancelled_template_for_user; ?></textarea>

                <button style="margin-top:12px" class="btn btn-primary input-group-btn lokuswp_admin_option_array_save"
                        option="<?= $this->id ?>-lwcommerce">
				    <?php _e( 'Simpan', 'lokuswp' ); ?>
                </button>

            </form>

        </div>

        <!------------ Tab : Shipped ------------>
        <div id="<?= $this->id; ?>-tab-body-5" class="tab-body">

            <form>
                <h6><?php _e( "Untuk Pembeli", "lokuswp" ); ?></h6>
                <textarea class="form-input"
                          name="shipped[user][template][id_ID]"
                          placeholder="<?= $shipped_template_for_user; ?>"
                          rows="9"><?= $shipped_template_for_user; ?></textarea>

                <button style="margin-top:12px" class="btn btn-primary input-group-btn lokuswp_admin_option_array_save"
                        option="<?= $this->id ?>-lwcommerce">
				    <?php _e( 'Simpan', 'lokuswp' ); ?>
                </button>

            </form>

        </div>

        <!------------ Tab : Pickup ------------>
        <div id="<?= $this->id; ?>-tab-body-6" class="tab-body">

            <form>
                <h6><?php _e( "Untuk Pembeli", "lokuswp" ); ?></h6>
                <textarea class="form-input"
                          name="pickup[user][template][id_ID]"
                          placeholder="<?= $pickup_template_for_user; ?>"
                          rows="9"><?= $pickup_template_for_user; ?></textarea>

                <button style="margin-top:12px" class="btn btn-primary input-group-btn lokuswp_admin_option_array_save"
                        option="<?= $this->id ?>-lwcommerce">
					<?php _e( 'Simpan', 'lokuswp' ); ?>
                </button>

            </form>

        </div>

        <!------------ Tab : Completed ------------>
        <div id="<?= $this->id; ?>-tab-body-7" class="tab-body">

            <form>
                <h6><?php _e( "Untuk Pembeli", "lokuswp" ); ?></h6>
                <textarea class="form-input"
                          name="completed[user][template][id_ID]"
                          placeholder="<?= $completed_template_for_user; ?>"
                          rows="9"><?= $completed_template_for_user; ?></textarea>

                <br>
                <h6><?php _e( "Untuk Admin", "lokuswp" ); ?></h6>
                <input type="text" class="form-input" name="completed[admin][receivers]"
                       placeholder="628238642022, 6285618257521" value="<?= $receivers_for_admin_when_completed; ?>">

                <textarea class="form-input"
                          name="completed[admin][template][id_ID]"
                          placeholder="<?= $completed_template_for_admin; ?>"
                          rows="3"><?= $completed_template_for_admin; ?></textarea>

                <button style="margin-top:12px" class="btn btn-primary input-group-btn lokuswp_admin_option_array_save"
                        option="<?= $this->id ?>-lwcommerce">
					<?php _e( 'Simpan', 'lokuswp' ); ?>
                </button>

            </form>

        </div>
    </div>
</div>