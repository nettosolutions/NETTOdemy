<?php $__env->startSection('title', __('labels.backend.orders.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">

        <div class="card-header">
            <h3 class="page-title mb-0 float-left"><?php echo app('translator')->getFromJson('labels.backend.orders.title'); ?></h3>
            <?php if($order->invoice != ""): ?>
                <div class="float-right">
                    <a class="btn btn-success" target="_blank" href="<?php echo e(asset('storage/invoices/'.$order->invoice->url)); ?>">
                        <?php echo app('translator')->getFromJson('labels.backend.orders.view_invoice'); ?>
                    </a>
                    <a class="btn btn-primary" href="<?php echo e(route('admin.invoice.download',['order'=>$order->id])); ?>">
                        <?php echo app('translator')->getFromJson('labels.backend.orders.download_invoice'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.reference_no'); ?></th>
                            <td>
                               <?php echo e($order->reference_no); ?>

                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.ordered_by'); ?></th>
                            <td>
                                Name    : <b><?php echo e($order->user->name); ?></b><br>
                                Email   : <b><?php echo e($order->user->email); ?></b>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.items'); ?></th>
                            <td>
                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $key++ ?>
                                    <?php echo e($key.'. '.$item->item->title); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.amount'); ?></th>
                            <td><?php echo e($order->amount.' '.$appCurrency['symbol']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.payment_type.title'); ?></th>
                            <td>

                                <?php if($order->payment_type == 1): ?>
                                    <?php echo e(trans('labels.backend.orders.fields.payment_type.stripe')); ?>

                                <?php elseif($order->payment_type == 2): ?>
                                    <?php echo e(trans('labels.backend.orders.fields.payment_type.paypal')); ?>

                                <?php else: ?>
                                    <?php echo e(trans('labels.backend.orders.fields.payment_type.offline')); ?>

                                <?php endif; ?>

                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.payment_status.title'); ?></th>
                            <td>

                                <?php if($order->status == 0): ?>
                                <?php echo e(trans('labels.backend.orders.fields.payment_status.pending')); ?>

                                    <a class="btn btn-xs mb-1 mr-1 btn-success text-white" style="cursor:pointer;"
                                       onclick="$(this).find('form').submit();">
                                        <?php echo e(trans('labels.backend.orders.complete')); ?>

                                        <form action="<?php echo e(route('admin.orders.complete', ['order' => $order->id])); ?>"
                                              method="POST" name="complete" style="display:none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </a>
                                <?php elseif($order->status == 1): ?>
                               <?php echo e(trans('labels.backend.orders.fields.payment_status.completed')); ?>

                                <?php else: ?>
                                <?php echo e(trans('labels.backend.orders.fields.payment_status.failed')); ?>

                                <?php endif; ?>

                            </td>
                        </tr>


                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.date'); ?></th>
                            <td><?php echo e($order->created_at->format('d M, Y | h:i A')); ?></td>
                        </tr>


                    </table>
                </div>
            </div><!-- Nav tabs -->

            <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-default border"><?php echo app('translator')->getFromJson('strings.backend.general.app_back_to_list'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>