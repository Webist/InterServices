<?php
/** @var \Payment\CreditCardData $data */
$data = $this->data;
?><div class="tab-pane" id="tab3">
    <h3 class="block">Provide your billing and credit card details</h3>
    <div class="form-group">
        <label class="control-label col-md-3">Card Holder Name
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="card_name" value="<?= $data->getName() ?>"/>
            <span class="help-block"> </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Card Number
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="card_number" value="<?= $data->getNumber() ?>"/>
            <span class="help-block"> </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">CVC
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" placeholder="" class="form-control" name="card_cvc" value="<?= $data->getCvc() ?>"/>
            <span class="help-block"> </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Expiration(MM/YYYY)
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" placeholder="MM/YYYY" maxlength="7" class="form-control"
                   name="card_expiry_date" value="<?= $data->getExpiryDate() ?>"/>
            <span class="help-block"> e.g 11/2020 </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Payment Options
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <div class="checkbox-list">
                <label>
                    <input type="checkbox" name="payment[]" value="1" <?= $this->data->getPaymentPreference()->getAutopay() == true ? 'checked=checked' : null ?>
                           data-title="Auto-Pay with this Credit Card."/> Auto-Pay with
                    this Credit Card </label>
                <label>
                    <input type="checkbox" name="payment[]" value="2" <?= $this->data->getBillingSchedule()->getPeriod() > 0 ? 'checked=checked' : null ?>
                           data-title="Email me monthly billing."/> Email me monthly
                    billing </label>
            </div>
            <div id="form_payment_error"></div>
        </div>
    </div>
</div>