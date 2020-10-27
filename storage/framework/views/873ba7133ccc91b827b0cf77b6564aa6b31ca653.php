<?php $request = app('Illuminate\Http\Request'); ?>

<?php $__env->startSection('title', __('labels.backend.faqs.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->getFromJson('labels.backend.faqs.title'); ?></h3>
                <div class="float-right">
                    <a href="<?php echo e(route('admin.faqs.create')); ?>"
                       class="btn btn-success"><?php echo app('translator')->getFromJson('strings.backend.general.app_add_new'); ?></a>

                </div>
        </div>
        <div class="card-body table-responsive">

            <table id="myTable"
                   class="table table-bordered table-striped">
                <thead>
                <tr>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('question_delete')): ?>
                        <?php if( request('show_deleted') != 1 ): ?>
                            <th style="text-align:center;"><input type="checkbox" class="mass" id="select-all"/></th><?php endif; ?>
                    <?php endif; ?>
                        <th><?php echo app('translator')->getFromJson('labels.general.sr_no'); ?></th>
                        <th><?php echo app('translator')->getFromJson('labels.backend.faqs.fields.category'); ?></th>
                    <th><?php echo app('translator')->getFromJson('labels.backend.faqs.fields.question'); ?></th>
                    <th><?php echo app('translator')->getFromJson('labels.backend.faqs.fields.answer'); ?></th>
                    <th><?php echo app('translator')->getFromJson('labels.backend.faqs.fields.status'); ?></th>
                    <?php if( request('show_deleted') == 1 ): ?>
                        <th><?php echo app('translator')->getFromJson('strings.backend.general.actions'); ?></th>
                    <?php else: ?>
                        <th><?php echo app('translator')->getFromJson('strings.backend.general.actions'); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>

        $(document).ready(function () {
            var route = '<?php echo e(route('admin.faqs.get_data')); ?>';

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
                            columns: [ 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                        <?php if(request('show_deleted') != 1): ?>
                    { "data": function(data){
                        return '<input type="checkbox" class="single" name="id[]" value="'+ data.id +'" />';
                    }, "orderable": false, "searchable":false, "name":"id" },
                        <?php endif; ?>
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "category", name: 'category'},
                    {data: "question", name: 'question'},
                    {data: "answer", name: 'answer'},
                    {data: "status", name: 'status'},
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('question_delete')): ?>
            <?php if(request('show_deleted') != 1): ?>
            $('.actions').html('<a href="' + '<?php echo e(route('admin.faqs.mass_destroy')); ?>' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            <?php endif; ?>
            <?php endif; ?>

        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>