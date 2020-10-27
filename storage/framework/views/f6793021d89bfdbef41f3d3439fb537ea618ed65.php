<?php echo app('translator')->getFromJson('strings.emails.contact.email_body_title'); ?>

<?php echo app('translator')->getFromJson('validation.attributes.frontend.name'); ?>: <?php echo e($request->name); ?>

<?php echo app('translator')->getFromJson('validation.attributes.frontend.email'); ?>: <?php echo e($request->email); ?>

<?php echo app('translator')->getFromJson('validation.attributes.frontend.phone'); ?>: <?php echo e(($request->phone == "") ? "N/A" : $request->phone); ?>

<?php echo app('translator')->getFromJson('validation.attributes.frontend.message'); ?>: <?php echo e($request->message); ?>

