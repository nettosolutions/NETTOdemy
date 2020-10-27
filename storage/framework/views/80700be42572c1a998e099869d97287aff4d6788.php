<?php $request = app('Illuminate\Http\Request'); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        textarea {
            resize: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card message-box">
        <div class="card-header">
            <h3 class="page-title mb-0"><?php echo app('translator')->getFromJson('labels.backend.messages.title'); ?>

                <a href="<?php echo e(route('admin.messages').'?threads'); ?>"
                   class="d-lg-none text-decoration-none threads d-md-none float-right">
                    <i class="icon-speech font-weight-bold"></i>
                </a>
            </h3>
        </div>
        <div class="card-body">
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="inbox_people d-md-block d-lg-block ">
                        <div class="headind_srch">
                            <?php if(request()->has('thread')): ?>
                            <div class="recent_heading btn-sm btn btn-dark">
                                <a class="text-decoration-none" href="<?php echo e(route('admin.messages')); ?>">
                                    <h5 class="text-white mb-0"><i class="icon-plus"></i>&nbsp;&nbsp; <?php echo app('translator')->getFromJson('labels.backend.messages.compose'); ?></h5>
                                </a>
                            </div>
                            <?php endif; ?>
                            <div class="srch_bar <?php if(!request()->has('thread')): ?> text-left <?php endif; ?>">
                                <div class="stylish-input-group">
                                    <input type="text" class="search-bar" id="myInput" placeholder="<?php echo app('translator')->getFromJson('labels.backend.messages.search_user'); ?>">
                                    <span class="input-group-addon">
                                        <button type="button">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="inbox_chat">
                            <?php if($threads->count() > 0): ?>
                                <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->lastMessage): ?>
                                        <a class="<?php if($item->unreadMessagesCount > 0): ?> unread
                                            <?php endif; ?>" href="<?php echo e(route('admin.messages').'?thread='.$item->id); ?>">
                                            <div data-thread="<?php echo e($item->id); ?>"
                                                 class="chat_list <?php if(($thread != "") && ($thread->id == $item->id)): ?>  active_chat <?php endif; ?>" >
                                                <div class="chat_people">

                                                    <div class="chat_ib">
                                                        <h5><?php echo e($item->title); ?> <span
                                                                    class="chat_date"><?php echo e($item->lastMessage->created_at->diffForHumans()); ?></span>
                                                            <?php if($item->unreadMessagesCount > 0): ?>
                                                                <span class="badge badge-primary mr-5"><?php echo e($item->unreadMessagesCount); ?></span>
                                                            <?php endif; ?>
                                                        </h5>
                                                        <p><?php echo e(str_limit($item->lastMessage->body, 35)); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(request()->has('thread')): ?>
                        <form method="post" action="<?php echo e(route('admin.messages.reply')); ?>">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="thread_id" value="<?php echo e(isset($thread->id) ? $thread->id : 0); ?>">
                            <div class="headind_srch ">
                                <div class="chat_people box-header">
                                    <div class="chat_img float-left">
                                        <img src="https://ptetutorials.com/images/user-profile.png"
                                             alt="" height="35px"></div>
                                    <div class="chat_ib float-left">

                                        <h5 class="mb-0 d-inline float-left"><?php echo e($thread->title); ?></h5>
                                        <p class="float-right d-inline mb-0">
                                            <a class="" href="<?php echo e(route('admin.messages',['thread'=>$thread->id])); ?>">
                                                <i class="icon-refresh font-weight-bold"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mesgs">
                                <div class="msg_history">
                                    <?php if(count($thread->messages) > 0 ): ?>
                                        <?php $__currentLoopData = $thread->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($message->sender_id == auth()->user()->id): ?>
                                                <div class="outgoing_msg">
                                                    <div class="sent_msg">
                                                        <p><?php echo e($message->body); ?></p>
                                                        <span class="time_date text-right"> <?php echo e(\Carbon\Carbon::parse($message->created_at)->format('h:i A | M d Y')); ?>

                                                    </span></div>
                                                </div>
                                            <?php else: ?>
                                                <div class="incoming_msg">
                                                    <div class="incoming_msg_img"><img
                                                                src="https://ptetutorials.com/images/user-profile.png"
                                                                alt=""></div>
                                                    <div class="received_msg">
                                                        <div class="received_withd_msg">
                                                            <p><?php echo e($message->body); ?></p>
                                                            <span class="time_date"><?php echo e(\Carbon\Carbon::parse($message->created_at)->format('h:i A | M d Y')); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="type_msg">
                                    <div class="input_msg_write">
                                        <textarea type="text" name="message" class="write_msg"
                                                  placeholder="Type a message"></textarea>
                                        <button class="msg_send_btn" type="submit">
                                            <i class="icon-paper-plane" style="line-height: 2" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <form method="post" action="<?php echo e(route('admin.messages.send')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="headind_srch bg-dark">
                                <div class="chat_people header row">
                                    <div class="col-12 col-lg-3">
                                        <p class="font-weight-bold text-white mb-0" style="line-height: 35px"><?php echo e(trans('labels.backend.messages.select_recipients')); ?>:</p>
                                    </div>
                                    <div class="col-lg-9 col-12 text-dark">
                                        <?php echo Form::select('recipients[]', $teachers, (request('teacher_id') ? request('teacher_id') : old('recipients')), ['class' => 'form-control select2', 'multiple' => 'multiple']); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="mesgs">
                                <div class="msg_history">
                                    <p class="text-center"><?php echo e(trans('labels.backend.messages.start_conversation')); ?></p>
                                </div>
                                <div class="type_msg">
                                    <div class="input_msg_write">
                                        
                                        <textarea type="text" name="message" class="write_msg"
                                                  placeholder="<?php echo e(trans('labels.backend.messages.type_a_message')); ?>"></textarea>
                                        <button class="msg_send_btn" type="submit">
                                            <i class="icon-paper-plane" style="line-height: 2" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('after-scripts'); ?>
    <script>

        $(document).ready(function () {
            //Get to the last message in conversation
            $('.msg_history').animate({
                scrollTop: $('.msg_history')[0].scrollHeight
            }, 1000);

            //Read message
            setTimeout(function () {
                var thread = '<?php echo e(request('thread')); ?>';
               var message =  $(".inbox_chat").find("[data-thread='" + thread + "']");
                message.parent('a').removeClass('unread');
                message.find('span.badge').remove();
            }, 500 );

            //Filter in conversation
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(".chat_list").parent('a').filter(function () {
                    $(this).toggle($(this).find('h5,p').text().toLowerCase().trim().indexOf(value) > -1)
                });
            });

        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>