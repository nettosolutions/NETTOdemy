<p><?php echo app('translator')->getFromJson('strings.emails.contact.email_body_title'); ?></p>

<p><strong><?php echo app('translator')->getFromJson('validation.attributes.frontend.name'); ?>:</strong> <?php echo e($request->name); ?></p>
<p><strong><?php echo app('translator')->getFromJson('validation.attributes.frontend.email'); ?>:</strong> <?php echo e($request->email); ?></p>
<p><strong><?php echo app('translator')->getFromJson('validation.attributes.frontend.phone'); ?>:</strong>  <?php echo e(($request->phone == "") ? "N/A" : $request->phone); ?></p>
<p><strong><?php echo app('translator')->getFromJson('validation.attributes.frontend.message'); ?>:</strong> <?php echo e($request->message); ?></p>
