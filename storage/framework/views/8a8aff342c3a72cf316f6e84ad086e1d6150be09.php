<?php $__env->startSection('title', __('labels.backend.translations.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <link href="<?php echo e(asset('plugins/bootstrap4-editable/css/bootstrap-editable.css')); ?>" rel="stylesheet"/>

    <style>
        a.status-1 {
            font-weight: bold;
        }
    </style>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script src="<?php echo e(asset('plugins/bootstrap4-editable/js/bootstrap-editable.min.js')); ?>"></script>
    <script>//https://github.com/rails/jquery-ujs/blob/master/src/rails.js
        (function (e, t) {
            if (e.rails !== t) {
                e.error("jquery-ujs has already been loaded!")
            }
            var n;
            var r = e(document);
            e.rails = n = {
                linkClickSelector: "a[data-confirm], a[data-method], a[data-remote], a[data-disable-with]",
                buttonClickSelector: "button[data-remote], button[data-confirm]",
                inputChangeSelector: "select[data-remote], input[data-remote], textarea[data-remote]",
                formSubmitSelector: "form",
                formInputClickSelector: "form input[type=submit], form input[type=image], form button[type=submit], form button:not([type])",
                disableSelector: "input[data-disable-with], button[data-disable-with], textarea[data-disable-with]",
                enableSelector: "input[data-disable-with]:disabled, button[data-disable-with]:disabled, textarea[data-disable-with]:disabled",
                requiredInputSelector: "input[name][required]:not([disabled]),textarea[name][required]:not([disabled])",
                fileInputSelector: "input[type=file]",
                linkDisableSelector: "a[data-disable-with]",
                buttonDisableSelector: "button[data-remote][data-disable-with]",
                CSRFProtection: function (t) {
                    var n = e('meta[name="csrf-token"]').attr("content");
                    if (n) t.setRequestHeader("X-CSRF-Token", n)
                },
                refreshCSRFTokens: function () {
                    var t = e("meta[name=csrf-token]").attr("content");
                    var n = e("meta[name=csrf-param]").attr("content");
                    e('form input[name="' + n + '"]').val(t)
                },
                fire: function (t, n, r) {
                    var i = e.Event(n);
                    t.trigger(i, r);
                    return i.result !== false
                },
                confirm: function (e) {
                    return confirm(e)
                },
                ajax: function (t) {
                    return e.ajax(t)
                },
                href: function (e) {
                    return e.attr("href")
                },
                handleRemote: function (r) {
                    var i, s, o, u, a, f, l, c;
                    if (n.fire(r, "ajax:before")) {
                        u = r.data("cross-domain");
                        a = u === t ? null : u;
                        f = r.data("with-credentials") || null;
                        l = r.data("type") || e.ajaxSettings && e.ajaxSettings.dataType;
                        if (r.is("form")) {
                            i = r.attr("method");
                            s = r.attr("action");
                            o = r.serializeArray();
                            var h = r.data("ujs:submit-button");
                            if (h) {
                                o.push(h);
                                r.data("ujs:submit-button", null)
                            }
                        } else if (r.is(n.inputChangeSelector)) {
                            i = r.data("method");
                            s = r.data("url");
                            o = r.serialize();
                            if (r.data("params")) o = o + "&" + r.data("params")
                        } else if (r.is(n.buttonClickSelector)) {
                            i = r.data("method") || "get";
                            s = r.data("url");
                            o = r.serialize();
                            if (r.data("params")) o = o + "&" + r.data("params")
                        } else {
                            i = r.data("method");
                            s = n.href(r);
                            o = r.data("params") || null
                        }
                        c = {
                            type: i || "GET", data: o, dataType: l, beforeSend: function (e, i) {
                                if (i.dataType === t) {
                                    e.setRequestHeader("accept", "*/*;q=0.5, " + i.accepts.script)
                                }
                                if (n.fire(r, "ajax:beforeSend", [e, i])) {
                                    r.trigger("ajax:send", e)
                                } else {
                                    return false
                                }
                            }, success: function (e, t, n) {
                                r.trigger("ajax:success", [e, t, n])
                            }, complete: function (e, t) {
                                r.trigger("ajax:complete", [e, t])
                            }, error: function (e, t, n) {
                                r.trigger("ajax:error", [e, t, n])
                            }, crossDomain: a
                        };
                        if (f) {
                            c.xhrFields = {withCredentials: f}
                        }
                        if (s) {
                            c.url = s
                        }
                        return n.ajax(c)
                    } else {
                        return false
                    }
                },
                handleMethod: function (r) {
                    var i = n.href(r), s = r.data("method"), o = r.attr("target"),
                        u = e("meta[name=csrf-token]").attr("content"), a = e("meta[name=csrf-param]").attr("content"),
                        f = e('<form method="post" action="' + i + '"></form>'),
                        l = '<input name="_method" value="' + s + '" type="hidden" />';
                    if (a !== t && u !== t) {
                        l += '<input name="' + a + '" value="' + u + '" type="hidden" />'
                    }
                    if (o) {
                        f.attr("target", o)
                    }
                    f.hide().append(l).appendTo("body");
                    f.submit()
                },
                formElements: function (t, n) {
                    return t.is("form") ? e(t[0].elements).filter(n) : t.find(n)
                },
                disableFormElements: function (t) {
                    n.formElements(t, n.disableSelector).each(function () {
                        n.disableFormElement(e(this))
                    })
                },
                disableFormElement: function (e) {
                    var t = e.is("button") ? "html" : "val";
                    e.data("ujs:enable-with", e[t]());
                    e[t](e.data("disable-with"));
                    e.prop("disabled", true)
                },
                enableFormElements: function (t) {
                    n.formElements(t, n.enableSelector).each(function () {
                        n.enableFormElement(e(this))
                    })
                },
                enableFormElement: function (e) {
                    var t = e.is("button") ? "html" : "val";
                    if (e.data("ujs:enable-with")) e[t](e.data("ujs:enable-with"));
                    e.prop("disabled", false)
                },
                allowAction: function (e) {
                    var t = e.data("confirm"), r = false, i;
                    if (!t) {
                        return true
                    }
                    if (n.fire(e, "confirm")) {
                        r = n.confirm(t);
                        i = n.fire(e, "confirm:complete", [r])
                    }
                    return r && i
                },
                blankInputs: function (t, n, r) {
                    var i = e(), s, o, u = n || "input,textarea", a = t.find(u);
                    a.each(function () {
                        s = e(this);
                        o = s.is("input[type=checkbox],input[type=radio]") ? s.is(":checked") : s.val();
                        if (!o === !r) {
                            if (s.is("input[type=radio]") && a.filter('input[type=radio]:checked[name="' + s.attr("name") + '"]').length) {
                                return true
                            }
                            i = i.add(s)
                        }
                    });
                    return i.length ? i : false
                },
                nonBlankInputs: function (e, t) {
                    return n.blankInputs(e, t, true)
                },
                stopEverything: function (t) {
                    e(t.target).trigger("ujs:everythingStopped");
                    t.stopImmediatePropagation();
                    return false
                },
                disableElement: function (e) {
                    e.data("ujs:enable-with", e.html());
                    e.html(e.data("disable-with"));
                    e.bind("click.railsDisable", function (e) {
                        return n.stopEverything(e)
                    })
                },
                enableElement: function (e) {
                    if (e.data("ujs:enable-with") !== t) {
                        e.html(e.data("ujs:enable-with"));
                        e.removeData("ujs:enable-with")
                    }
                    e.unbind("click.railsDisable")
                }
            };
            if (n.fire(r, "rails:attachBindings")) {
                e.ajaxPrefilter(function (e, t, r) {
                    if (!e.crossDomain) {
                        n.CSRFProtection(r)
                    }
                });
                r.delegate(n.linkDisableSelector, "ajax:complete", function () {
                    n.enableElement(e(this))
                });
                r.delegate(n.buttonDisableSelector, "ajax:complete", function () {
                    n.enableFormElement(e(this))
                });
                r.delegate(n.linkClickSelector, "click.rails", function (r) {
                    var i = e(this), s = i.data("method"), o = i.data("params"), u = r.metaKey || r.ctrlKey;
                    if (!n.allowAction(i)) return n.stopEverything(r);
                    if (!u && i.is(n.linkDisableSelector)) n.disableElement(i);
                    if (i.data("remote") !== t) {
                        if (u && (!s || s === "GET") && !o) {
                            return true
                        }
                        var a = n.handleRemote(i);
                        if (a === false) {
                            n.enableElement(i)
                        } else {
                            a.error(function () {
                                n.enableElement(i)
                            })
                        }
                        return false
                    } else if (i.data("method")) {
                        n.handleMethod(i);
                        return false
                    }
                });
                r.delegate(n.buttonClickSelector, "click.rails", function (t) {
                    var r = e(this);
                    if (!n.allowAction(r)) return n.stopEverything(t);
                    if (r.is(n.buttonDisableSelector)) n.disableFormElement(r);
                    var i = n.handleRemote(r);
                    if (i === false) {
                        n.enableFormElement(r)
                    } else {
                        i.error(function () {
                            n.enableFormElement(r)
                        })
                    }
                    return false
                });
                r.delegate(n.inputChangeSelector, "change.rails", function (t) {
                    var r = e(this);
                    if (!n.allowAction(r)) return n.stopEverything(t);
                    n.handleRemote(r);
                    return false
                });
                r.delegate(n.formSubmitSelector, "submit.rails", function (r) {
                    var i = e(this), s = i.data("remote") !== t, o, u;
                    if (!n.allowAction(i)) return n.stopEverything(r);
                    if (i.attr("novalidate") == t) {
                        o = n.blankInputs(i, n.requiredInputSelector);
                        if (o && n.fire(i, "ajax:aborted:required", [o])) {
                            return n.stopEverything(r)
                        }
                    }
                    if (s) {
                        u = n.nonBlankInputs(i, n.fileInputSelector);
                        if (u) {
                            setTimeout(function () {
                                n.disableFormElements(i)
                            }, 13);
                            var a = n.fire(i, "ajax:aborted:file", [u]);
                            if (!a) {
                                setTimeout(function () {
                                    n.enableFormElements(i)
                                }, 13)
                            }
                            return a
                        }
                        n.handleRemote(i);
                        return false
                    } else {
                        setTimeout(function () {
                            n.disableFormElements(i)
                        }, 13)
                    }
                });
                r.delegate(n.formInputClickSelector, "click.rails", function (t) {
                    var r = e(this);
                    if (!n.allowAction(r)) return n.stopEverything(t);
                    var i = r.attr("name"), s = i ? {name: i, value: r.val()} : null;
                    r.closest("form").data("ujs:submit-button", s)
                });
                r.delegate(n.formSubmitSelector, "ajax:send.rails", function (t) {
                    if (this == t.target) n.disableFormElements(e(this))
                });
                r.delegate(n.formSubmitSelector, "ajax:complete.rails", function (t) {
                    if (this == t.target) n.enableFormElements(e(this))
                });
                e(function () {
                    n.refreshCSRFTokens()
                })
            }
        })(jQuery)
    </script>
    <script>
        jQuery(document).ready(function ($) {

            $.ajaxSetup({
                beforeSend: function (xhr, settings) {
                    console.log('beforesend');
                    settings.data += "&_token=<?php echo csrf_token() ?>";
                }
            });

            $('.editable').editable().on('hidden', function (e, reason) {
                var locale = $(this).data('locale');
                if (reason === 'save') {
                    $(this).removeClass('status-0').addClass('status-1');
                }
                if (reason === 'save' || reason === 'nochange') {
                    var $next = $(this).closest('tr').next().find('.editable.locale-' + locale);
                    setTimeout(function () {
                        $next.editable('show');
                    }, 300);
                }
            });

            $('.group-select').on('change', function () {
                var group = $(this).val();
                if (group) {
                    window.location.href = '<?php echo action('\Barryvdh\TranslationManager\Controller@getView') ?>/' + $(this).val();
                } else {
                    window.location.href = '<?php echo action('\Barryvdh\TranslationManager\Controller@getIndex') ?>';
                }
            });

            $("a.delete-key").click(function (event) {
                event.preventDefault();
                var row = $(this).closest('tr');
                var url = $(this).attr('href');
                var id = row.attr('id');
                $.post(url, {id: id}, function () {
                    row.remove();
                });
            });

            $('.form-import').on('ajax:success', function (e, data) {
                $('div.success-import strong.counter').text(data.counter);
                $('div.success-import').slideDown();
                window.location.reload();
            });

            $('.form-find').on('ajax:success', function (e, data) {
                $('div.success-find strong.counter').text(data.counter);
                $('div.success-find').slideDown();
                window.location.reload();
            });

            $('.form-publish').on('ajax:success', function (e, data) {
                $('div.success-publish').slideDown();
            });

            $('.form-publish-all').on('ajax:success', function (e, data) {
                $('div.success-publish-all').slideDown();
            });

        })
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.submit-btn',function (e) {
                if(confirm('Are you sure you want to delete Locale?')){
                    e.preventDefault();
                    var form = $(this).parents('.form-remove-locale')

                    $.ajax({
                        url:'<?php echo e(route('admin.delete-locale')); ?>',
                        type:'POST',
                        data:{'locale':$(this).val(),_token:'<?php echo e(csrf_token()); ?>'},
                        success:function () {
                            form.submit();
                        }
                    })
                }
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->getFromJson('labels.backend.translations.title'); ?></h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <p class=""><?php echo app('translator')->getFromJson('labels.backend.translations.warning'); ?></p>
                    <hr>
                    <div class="alert alert-success success-import" style="display:none;">
                        <p><?php echo app('translator')->getFromJson('labels.backend.translations.done_importing'); ?></p>
                    </div>
                    <div class="alert alert-success success-find" style="display:none;">
                        <p><?php echo app('translator')->getFromJson('labels.backend.translations.done_searching'); ?></p>
                    </div>
                    <div class="alert alert-success success-publish" style="display:none;">
                        <p><?php echo app('translator')->getFromJson('labels.backend.translations.done_publishing_for_group'); ?> '<?php echo e($group); ?>'!</p>
                    </div>
                    <div class="alert alert-success success-publish-all" style="display:none;">
                        <p><?php echo app('translator')->getFromJson('labels.backend.translations.done_publishing_for_all_groups'); ?></p>
                    </div>
                    <?php if(Session::has('successPublish')): ?>
                        <div class="alert alert-info">
                            <?php echo e(Session::get('successPublish')); ?>

                        </div>
                    <?php endif; ?>


                    <?php if(!isset($group)): ?>
                        <form class="form-import" method="POST"
                              action="<?php echo e(action('\Barryvdh\TranslationManager\Controller@postImport')); ?>"
                              data-remote="true" role="form">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <?php echo app('translator')->getFromJson('labels.backend.translations.import_groups_note'); ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="replace" class="form-control">
                                            <option value="0"><?php echo app('translator')->getFromJson('labels.backend.translations.append_new_translations'); ?></option>
                                            <option value="1"><?php echo app('translator')->getFromJson('labels.backend.translations.replace_existing_translations'); ?></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-success btn-block"
                                                data-disable-with="Loading.."><?php echo app('translator')->getFromJson('labels.backend.translations.import_groups'); ?>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <hr>
                        </form>

                    <?php endif; ?>
                    <?php if(isset($group)): ?>
                        <form class="form-inline form-publish mb-4" method="POST"
                              action="<?php echo e(action('\Barryvdh\TranslationManager\Controller@postPublish', $group)); ?>"
                              data-remote="true" role="form"
                              data-confirm="<?php echo app('translator')->getFromJson('labels.backend.translations.translation_warning', ['group' => $group]); ?>">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <button type="submit" class="btn btn-success" data-disable-with="<?php echo app('translator')->getFromJson('labels.backend.translations.publishing'); ?>"><i class="fa fa-save"></i>
                                <?php echo app('translator')->getFromJson('labels.backend.translations.publish_translations'); ?>
                            </button>
                            <a href="<?php echo e(action('\Barryvdh\TranslationManager\Controller@getIndex')); ?>"
                               class="btn btn-default border ml-3"><?php echo app('translator')->getFromJson('labels.general.back'); ?></a>
                        </form>
                    <?php endif; ?>
                    <form role="form" method="POST"
                          action="<?php echo e(action('\Barryvdh\TranslationManager\Controller@postAddGroup')); ?>">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class="form-group">
                            <p><?php echo app('translator')->getFromJson('labels.backend.translations.choose_a_group'); ?></p>
                            <select name="group" id="group" class="form-control group-select">
                                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>: ?>
                                <option value="<?php echo e($key); ?>" <?php echo e($key == $group ? ' selected':''); ?>>
                                    <?php echo e($value); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>


                    </form>
                    <?php if($group): ?>


                        <h4><?php echo app('translator')->getFromJson('labels.backend.translations.total'); ?>: <?php echo e($numTranslations); ?> , <?php echo app('translator')->getFromJson('labels.backend.translations.changed'); ?>: <?php echo e($numChanged); ?></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="15%"><?php echo app('translator')->getFromJson('labels.backend.translations.key'); ?></th>
                                    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($locale); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($deleteEnabled): ?>
                                        <th>&nbsp;</th>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $translations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $translation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr id="<?php echo e(htmlentities($key, ENT_QUOTES, 'UTF-8', false)); ?>">
                                        <td><?php echo e(htmlentities($key, ENT_QUOTES, 'UTF-8', false)); ?></td>
                                        <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $t = isset($translation[$locale]) ? $translation[$locale] : null ?>

                                            <td>
                                                <a href="#edit"
                                                   class="editable status-<?php echo $t ? $t->status : 0 ?> locale-<?php echo $locale ?>"
                                                   data-locale="<?php echo $locale ?>"
                                                   data-name="<?php echo $locale . "|" . htmlentities($key, ENT_QUOTES, 'UTF-8', false) ?>"
                                                   id="username" data-type="textarea"
                                                   data-pk="<?php echo $t ? $t->id : 0 ?>"
                                                   data-url="<?php echo e($editUrl); ?> "
                                                   data-title="Enter translation"><?php echo $t ? htmlentities($t->value, ENT_QUOTES, 'UTF-8', false) : ''; ?></a>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($deleteEnabled): ?>
                                            <td>
                                                <a href="<?php echo e(action('\Barryvdh\TranslationManager\Controller@postDelete', [$group, $key])); ?>"
                                                   class="delete-key"
                                                   data-confirm="Are you sure you want to delete the translations for '<?php echo e(htmlentities($key, ENT_QUOTES, 'UTF-8', false)); ?>?"><span
                                                            class="glyphicon glyphicon-trash"></span></a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>

                    <?php else: ?>
                        <fieldset>
                            <legend><?php echo app('translator')->getFromJson('labels.backend.translations.supported_locales'); ?></legend>
                            <p>
                                <?php echo app('translator')->getFromJson('labels.backend.translations.current_supported_locales'); ?>:
                            </p>
                            <form class="form-remove-locale" method="POST" role="form"
                                  action="<?php echo e(action('\Barryvdh\TranslationManager\Controller@postRemoveLocale')); ?>">
                                <input type="hidden" name=
                                "_token" value="<?php echo e(csrf_token()); ?>">
                                <ul class="list-locales">
                                    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="form-group">
                                                <button  type="submit"  value="<?php echo e($locale); ?>" name="remove-locale[<?php echo e($locale); ?>]"
                                                        class="btn btn-danger submit-btn btn-xs" data-disable-with="...">
                                                    &times;
                                                </button>
                                                <?php echo e($locale); ?>

                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>

                            </form>
                            <form class="form-add-locale" method="POST" role="form"
                                  action="<?php echo e(action('\Barryvdh\TranslationManager\Controller@postAddLocale')); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <div class="form-group">
                                    <p>
                                        <?php echo app('translator')->getFromJson('labels.backend.translations.enter_new_locale_key'); ?>:
                                    </p>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <input type="text" name="new-locale" class="form-control"/>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-default border btn-block"
                                                    data-disable-with=" <?php echo app('translator')->getFromJson('labels.backend.translations.adding'); ?>:">
                                                <?php echo app('translator')->getFromJson('labels.backend.translations.add_new_locale'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                        <fieldset>
                            <legend> <?php echo app('translator')->getFromJson('labels.backend.translations.export_all_translations'); ?>:</legend>
                            <form class="form-inline form-publish-all" method="POST"
                                  action="<?php echo e(action('\Barryvdh\TranslationManager\Controller@postPublish', '*')); ?>"
                                  data-remote="true" role="form"
                                  data-confirm="<?php echo app('translator')->getFromJson('labels.backend.translations.publish_all_warning'); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <button type="submit" class="btn btn-primary" data-disable-with="Publishing..">
                                    <?php echo app('translator')->getFromJson('labels.backend.translations.publish_all'); ?>
                                </button>
                            </form>
                        </fieldset>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>