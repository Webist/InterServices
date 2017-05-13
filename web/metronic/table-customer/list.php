<?php
$userProfileData = $this->data;

/** @var \Account\UserProfileData $customer */
?>
<!-- BEGIN SAMPLE TABLE PORTLET-->
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>&nbsp; </div>
        <div class="tools">
            <a href="javascript:" class="collapse"> </a>
            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
            <a href="javascript:" class="reload"> </a>
            <a href="javascript:" class="remove"> </a>
        </div>
    </div>
    <div class="portlet-body flip-scroll">
        <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th> Full Name </th>
                <th> E-mail </th>
                <th class="numeric" width="20%"> Id </th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach($userProfileData as $customer) {
                ?><tr>
                    <td><?= $customer->getFullName() ?></td>
                    <td><?= $customer->getEmail() ?></td>
                    <td><a href="/customer?uuid=<?= $customer->getId() ?>"> edit </a> </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- END SAMPLE TABLE PORTLET-->
<?php
