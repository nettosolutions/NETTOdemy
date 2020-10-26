<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Admin\StoreTeachersRequest;
use App\Http\Requests\Admin\UpdateTeachersRequest;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class TeachersController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request('show_deleted') == 1) {

            $users = User::role('teacher')->onlyTrashed()->get();
        } else {
            $users = User::role('teacher')->get();
        }

        return view('backend.teachers.index', compact('users'));
    }

    /**
     * Display a listing of Courses via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $teachers = "";


        if (request('show_deleted') == 1) {

            $teachers = User::role('teacher')->onlyTrashed()->orderBy('created_at', 'desc')->get();
        } else {
            $teachers = User::role('teacher')->orderBy('created_at', 'desc')->get();
        }

        if (auth()->user()->isAdmin()) {
            $has_view = true;
            $has_edit = true;
            $has_delete = true;
        }


        return DataTables::of($teachers)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.teachers', 'label' => 'teacher', 'value' => $q->id]);
                }
//                if ($has_view) {
//                    $view = view('backend.datatable.action-view')
//                        ->with(['route' => route('admin.teachers.show', ['teacher' => $q->id])])->render();
//                }

                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.teachers.edit', ['teacher' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.teachers.destroy', ['teacher' => $q->id])])
                        ->render();
                    $view .= $delete;
                }

                $view .= '<a class="btn btn-warning mb-1" href="' . route('admin.courses.index', ['teacher_id' => $q->id]) . '">' . trans('labels.backend.courses.title') . '</a>';

                return $view;

            })
            ->editColumn('status', function ($q) {
                return ($q->active == 1) ? "Enabled" : "Disabled";
            })
            ->rawColumns(['actions', 'image'])
            ->make();
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.teachers.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \App\Http\Requests\StoreTeachersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeachersRequest $request)
    {
//        $request = $this->saveFiles($request);

        $user = User::create($request->all());
        $user->confirmed = 1;
        $user->avatar_type = 'storage';
        if ($request->image) {
            $user->avatar_location = $request->image->store('/avatars', 'public');
        }
        $user->save();

        $user->assignRole('teacher');

        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $teacher = User::findOrFail($id);

        return view('backend.teachers.edit', compact('teacher'));
    }

    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\UpdateTeachersRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeachersRequest $request, $id)
    {
        $request = $this->saveFiles($request);

        $teacher = User::findOrFail($id);
        $teacher->update($request->except('email'));
        $teacher->avatar_type = 'storage';
        if ($request->image) {
            $teacher->avatar_location = $request->image->store('/avatars', 'public');
        } else {
            // No image being passed
            // If there is no existing image
            if (!strlen(auth()->user()->avatar_location)) {
                throw new GeneralException('You must supply a profile image.');
            }
        }
        $teacher->save();

        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }


    /**
     * Display Category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = User::findOrFail($id);

        return view('backend.teachers.show', compact('teacher'));
    }


    /**
     * Remove Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $teacher = User::findOrFail($id);
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $teacher = User::onlyTrashed()->findOrFail($id);
        $teacher->restore();

        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.restored'));
    }

    /**
     * Permanently delete Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {

        $teacher = User::onlyTrashed()->findOrFail($id);
        $teacher->forceDelete();

        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
