    

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center align-items-center mb-3">
        <div class="col col-sm-12 align-self-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Stripe</h3>
                </div>

                <div class="card-body">
                    <h4 class="mb-1">
<?php if($stripeaccount->details_submitted): ?>
Stripe Account Successfully Connected!
<?php else: ?>
Failed to Connect Stripe Account!
<?php endif; ?>
 </h4>
                </div><!--card body-->
            </div><!-- card -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>