<?php if(auth()->user() && session()->has("admin_user_id") && session()->has("temp_user_id")): ?>
    <div class="alert alert-warning logged-in-as mb-0">
        You are currently logged in as <?php echo e(auth()->user()->name); ?>. <a href="<?php echo e(route("frontend.auth.logout-as")); ?>">Re-Login as <?php echo e(session()->get("admin_user_name")); ?></a>.
    </div><!--alert alert-warning logged-in-as-->
<?php endif; ?>
