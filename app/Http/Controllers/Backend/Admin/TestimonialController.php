<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestimonialsRequest;
use App\Http\Requests\Admin\UpdateTestimonialsRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller
{

    /**
     * Display a listing of Testimonial.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.testimonials.index');
    }


    /**
     * Display a listing of Testimonials via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();


        return DataTables::of($testimonials)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $status = "";
                if ($q->status == 1) {
                    $status = "<a href='" . route('admin.testimonials.status', ['id' => $q->id]) . "' class='btn mb-1 mr-1 btn-danger'> <i class='fa fa-power-off'></i></a>";
                } else {
                    $status = "<a href='" . route('admin.testimonials.status', ['id' => $q->id]) . "' class='btn mb-1 mr-1 btn-success'> <i class='fa fa-power-off'></i></a>";
                }
                $view .= $status;
                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.testimonials.edit', ['testimonials_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.testimonials.destroy', ['testimonials_option' => $q->id])])
                    ->render();
                $view .= $delete;
                return $view;

            })
            ->editColumn('status', function ($q) {
                return ($q->status == 1) ? "Enabled" : "Disabled";
            })
            ->rawColumns( ['actions'])
            ->make();
    }

    /**
     * Show the form for creating new Testimonial.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.testimonials.create');
    }

    /**
     * Store a newly created Testimonial in storage.
     *
     * @param  \App\Http\Requests\StoreTestimonialsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestimonialsRequest $request)
    {
        Testimonial::create($request->all());
        
        return redirect()->route('admin.testimonials.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Testimonial.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $testimonial = Testimonial::findOrFail($id);

        return view('backend.testimonials.edit', compact('testimonial', 'tests'));
    }

    /**
     * Update Testimonial in storage.
     *
     * @param  \App\Http\Requests\UpdateTestimonialsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestimonialsRequest $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($request->all());

        return redirect()->route('admin.testimonials.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }



    /**
     * Remove Testimonial from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Testimonial at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Testimonial::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function status($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->status == 1) {
            $testimonial->status = 0;
        } else {
            $testimonial->status = 1;
        }
        $testimonial->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }


}
