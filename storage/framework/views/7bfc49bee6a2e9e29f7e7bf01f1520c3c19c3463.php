<?php $request = app('Illuminate\Http\Request'); ?>

<?php $__env->startSection('title', __('labels.backend.orders.title').' | '.app_name()); ?>


<?php $__env->startSection('content'); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline mb-0"><?php echo app('translator')->getFromJson('labels.backend.orders.title'); ?></h3>

        </div>
        <div class="card-body">
            <div class="d-block">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="<?php echo e(route('admin.orders.index')); ?>"
                           style="<?php echo e(request('offline_requests') == 1 ? '' : 'font-weight: 700'); ?>"><?php echo e(trans('labels.general.all')); ?></a>
                    </li>
                    |
                    <li class="list-inline-item">
                        <a href="<?php echo e(route('admin.orders.index')); ?>?offline_requests=1"
                           style="<?php echo e(request('offline_requests') == 1 ? 'font-weight: 700' : ''); ?>"><?php echo e(trans('labels.backend.orders.offline_requests')); ?></a>
                    </li>
                </ul>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="text-align:center;">
                            <input type="checkbox" class="mass" id="select-all"/>
                        </th>
                        <th><?php echo app('translator')->getFromJson('labels.general.sr_no'); ?></th>
                        <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.reference_no'); ?></th>
                        <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.items'); ?></th>
                        <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.amount'); ?> <small>(in <?php echo e($appCurrency['symbol']); ?>)</small></th>
                        <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.payment_status.title'); ?></th>
                        <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.user_email'); ?></th>
                        <th><?php echo app('translator')->getFromJson('labels.backend.orders.fields.date'); ?></th>
                        <th>&nbsp; <?php echo app('translator')->getFromJson('strings.backend.general.actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {
            var route = '<?php echo e(route('admin.orders.get_data')); ?>';

            <?php if(request('offline_requests') == 1): ?>
                route = '<?php echo e(route('admin.orders.get_data',['offline_requests' => 1])); ?>';
            <?php endif; ?>

            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6, 7 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6, 7 ]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                    {
                        data: function (data) {
                            return '<input type="checkbox" class="single" name="id[]" value="' + data.id + '" />';
                        }, "orderable": false, "searchable": false, "name": "id"
                    },
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "reference_no", name: 'reference_no'},
                    {data: "items", name: 'items'},
                    {data: "amount", name: 'amount'},
                    {data: "payment", name: 'payment'},
                    {data: "user_email", name: 'user_email'},
                    {data: "date", name: "date"},
                    {data: "actions", name: "actions"}
                ],
                <?php if(request('show_deleted') != 1): ?>
                columnDefs: [
                    {"width": "5%", "targets": 0},
                    {"className": "text-center", "targets": [0]}
                ],
                <?php endif; ?>

                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-entry-id', data.id);
                },
                language:{
                    url : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo e($locale_full_name); ?>.json",
                    buttons :{
                        colvis : '<?php echo e(trans("datatable.colvis")); ?>',
                        pdf : '<?php echo e(trans("datatable.pdf")); ?>',
                        csv : '<?php echo e(trans("datatable.csv")); ?>',
                    }
                }
            });
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('course_delete')): ?>
            <?php if(request('show_deleted') != 1): ?>
            $('.actions').html('<a href="' + '<?php echo e(route('admin.orders.mass_destroy')); ?>' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            <?php endif; ?>
            <?php endif; ?>
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>