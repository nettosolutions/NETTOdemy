<?php $__env->startSection('title', __('labels.backend.sponsors.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <?php if(isset($sponsor)): ?>
            <h3 class="page-title d-inline"><?php echo app('translator')->getFromJson('labels.backend.sponsors.edit'); ?></h3>
                <div class="float-right">
                    <a href="<?php echo e(route('admin.sponsors.index')); ?>"
                       class="btn btn-success"><?php echo app('translator')->getFromJson('labels.backend.sponsors.view'); ?></a>
                </div>
            <?php else: ?>
                <h3 class="page-title d-inline"><?php echo app('translator')->getFromJson('labels.backend.sponsors.create'); ?></h3>
                <div class="float-right">
                    <a data-toggle="collapse" id="createCatBtn" data-target="#createCat" href="#"
                       class="btn btn-success"><?php echo app('translator')->getFromJson('strings.backend.general.app_add_new'); ?></a>

                </div>
            <?php endif; ?>

        </div>
        <div class="card-body">
            <div class="row <?php if(!isset($sponsor)): ?> collapse <?php endif; ?>" id="createCat">
                <div class="col-12">
                    <?php if(isset($sponsor)): ?>
                        <?php echo Form::model($sponsor, ['method' => 'PUT', 'route' => ['admin.sponsors.update', $sponsor->id], 'files' => true,]); ?>

                    <?php else: ?>
                        <?php echo Form::open(['method' => 'POST', 'route' => ['admin.sponsors.store'], 'files' => true,]); ?>

                    <?php endif; ?>

                    <div class="row">
                        <div class="col-lg-4 col-12 form-group mb-0">
                            <?php echo Form::label('name', trans('labels.backend.sponsors.fields.name').' *', ['class' => 'control-label']); ?>

                            <?php echo Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.sponsors.fields.name'), 'required' => false]); ?>


                        </div>
                        <div class="col-lg-4 col-12 form-group mb-0">
                            <?php echo Form::label('link', trans('labels.backend.sponsors.fields.link'), ['class' => 'control-label']); ?>

                            <?php echo Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.sponsors.fields.link'), 'required' => false]); ?>

                        </div>

                        <div class="col-lg-4 col-12 form-group mb-0">

                            <?php echo Form::label('logo',  trans('labels.backend.sponsors.fields.logo'), ['class' => 'control-label d-block']); ?>

                            <?php if(isset($sponsor) && ($sponsor->logo != null)): ?>
                                <?php echo Form::file('logo', ['class' => 'form-control w-75 d-inline-block', 'placeholder' => '', 'accept' => 'image/jpeg,image/gif,image/png']); ?>

                                    <img class="d-inline-block" src="<?php echo e(asset('storage/uploads/'.$sponsor->logo)); ?>" height="38px">
                            <?php else: ?>
                                <?php echo Form::file('logo', ['class' => 'form-control d-inline-block', 'placeholder' => '']); ?>

                            <?php endif; ?>
                        </div>
                        <div class="col-12 form-group mt-3 text-center  mb-0 ">

                            <?php echo Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn mt-auto  btn-danger']); ?>

                        </div>
                    </div>

                    <?php echo Form::close(); ?>

                        <hr>


                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <div class="d-block">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="<?php echo e(route('admin.sponsors.index')); ?>"
                                       style="<?php echo e(request('show_deleted') == 1 ? '' : 'font-weight: 700'); ?>"><?php echo e(trans('labels.general.all')); ?></a>
                                </li>
                                |
                                <li class="list-inline-item">
                                    <a href="<?php echo e(route('admin.sponsors.index')); ?>?show_deleted=1"
                                       style="<?php echo e(request('show_deleted') == 1 ? 'font-weight: 700' : ''); ?>"><?php echo e(trans('labels.general.trash')); ?></a>
                                </li>
                            </ul>
                        </div>


                        <table id="myTable"
                               class="table table-bordered table-striped <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_delete')): ?> <?php if( request('show_deleted') != 1 ): ?> dt-select <?php endif; ?> <?php endif; ?>">
                            <thead>
                            <tr>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_delete')): ?>
                                    <?php if( request('show_deleted') != 1 ): ?>
                                        <th style="text-align:center;"><input type="checkbox" class="mass"
                                                                              id="select-all"/>
                                        </th><?php endif; ?>
                                <?php endif; ?>

                                <th><?php echo app('translator')->getFromJson('labels.general.sr_no'); ?></th>
                                <th><?php echo app('translator')->getFromJson('labels.backend.sponsors.fields.name'); ?></th>
                                <th><?php echo app('translator')->getFromJson('labels.backend.sponsors.fields.logo'); ?></th>
                                <th><?php echo app('translator')->getFromJson('labels.backend.sponsors.fields.link'); ?></th>
                                <th><?php echo app('translator')->getFromJson('labels.backend.sponsors.fields.status'); ?></th>
                                <?php if( request('show_deleted') == 1 ): ?>
                                    <th>&nbsp; <?php echo app('translator')->getFromJson('strings.backend.general.actions'); ?></th>
                                <?php else: ?>
                                    <th>&nbsp; <?php echo app('translator')->getFromJson('strings.backend.general.actions'); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>

        $(document).ready(function () {
            var route = '<?php echo e(route('admin.sponsors.get_data')); ?>';

            <?php if(request('show_deleted') == 1): ?>
                route = '<?php echo e(route('admin.sponsors.get_data',['show_deleted' => 1])); ?>';
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
                            columns: [ 1, 2, 4,5]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 1, 2, 4,5]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                        <?php if(request('show_deleted') != 1): ?>
                    {
                        "data": function (data) {
                            return '<input type="checkbox" class="single" name="id[]" value="' + data.id + '" />';
                        }, "orderable": false, "searchable": false, "name": "id"
                    },
                        <?php endif; ?>
                    {
                        data: "DT_RowIndex", name: 'DT_RowIndex'
                    },
                    {data: "name", name: 'name'},
                    {data: "logo", name: 'logo'},
                    {data: "link", name: "link"},
                    {data: "status", name: "status"},
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
            $('.actions').html('<a href="' + '<?php echo e(route('admin.sponsors.mass_destroy')); ?>' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');


            <?php if(request()->has('create')): ?>
                $('#createCatBtn').click();
            <?php endif; ?>
        });

    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>