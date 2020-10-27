<div class="in-total font-weight-normal mb-3"><?php echo app('translator')->getFromJson('labels.frontend.cart.price'); ?>
    <small class="text-muted">
        (<?php echo e(Cart::getContent()->count()); ?><?php echo e((Cart::getContent()->count() > 1) ? ' '.trans('labels.frontend.cart.items') : ' '.trans('labels.frontend.cart.item')); ?>)
    </small>
    <span class="font-weight-bold">
                                                <?php if(isset($total)): ?>
            <?php echo e($appCurrency['symbol'].' '.$total); ?>

        <?php endif; ?>
                                            </span>
</div>
<?php if(Cart::getConditionsByType('coupon') != null): ?>
    <?php $__currentLoopData = Cart::getConditionsByType('coupon'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="in-total font-weight-normal  mb-3"> <?php echo e($condition->getValue().' '.$condition->getName()); ?>

            <span class="font-weight-bold"><?php echo e($appCurrency['symbol'].' '.number_format($condition->getCalculatedValue($total),2)); ?></span>
         <i style="cursor: pointer" id="removeCoupon" class="fa text-danger fa-times-circle"></i>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php endif; ?>
<?php if($taxData != null): ?>
    <?php $__currentLoopData = $taxData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="in-total font-weight-normal  mb-3"> <?php echo e($tax['name']); ?>

            <span class="font-weight-bold"><?php echo e($appCurrency['symbol'].' '.number_format($tax['amount'],2)); ?></span>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<div class="in-total border-top pt-3"><?php echo app('translator')->getFromJson('labels.frontend.cart.total_payable'); ?>
    <span>
                                                    <?php echo e($appCurrency['symbol'].' '.number_format(Cart::session(auth()->user()->id)->getTotal(),2)); ?>

                                            </span>
</div>


<div class="input-group mt-3 mb-1">
    <input type="text" id="coupon" pattern="[^\s]+" name="coupon"
           class="form-control" placeholder="Enter Coupon">
    <div class="input-group-append">
        <button class="btn btn-dark shadow-none " id="applyCoupon"
                type="button">
            <?php echo app('translator')->getFromJson('labels.frontend.cart.apply'); ?>
        </button>
    </div>
</div>
<p class="d-none" id="coupon-error"></p>
