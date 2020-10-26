<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqsRequest;
use App\Http\Requests\Admin\UpdateFaqsRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FaqController extends Controller
{

    /**
     * Display a listing of Testimonial.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.faqs.index');
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
        $faqs = Faq::whereHas('category')->orderBy('created_at', 'desc')->get();


        return DataTables::of($faqs)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $status = "";
                if ($q->status == 1) {
                    $status = "<a href='" . route('admin.faqs.status', ['id' => $q->id]) . "' class='btn mb-1 mr-1 btn-danger'> <i class='fa fa-power-off'></i></a>";
                } else {
                    $status = "<a href='" . route('admin.faqs.status', ['id' => $q->id]) . "' class='btn mb-1 mr-1 btn-success'> <i class='fa fa-power-off'></i></a>";
                }
                $view .= $status;
                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.faqs.edit', ['faqs_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.faqs.destroy', ['faqs_option' => $q->id])])
                    ->render();
                $view .= $delete;
                return $view;

            })
            ->editColumn('status', function ($q) {
                return ($q->status == 1) ? "Enabled" : "Disabled";
            })
            ->addColumn('category',function ($q){
                return $q->category->name;
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
        $category = Category::pluck('name','id')->prepend('Please select', '');
        return view('backend.faqs.create',compact('category'));
    }

    /**
     * Store a newly created Testimonial in storage.
     *
     * @param  \App\Http\Requests\StoreFaqsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqsRequest $request)
    {
        $faq = new Faq();
        $faq->category_id = $request->category;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('admin.faqs.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Testimonial.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::pluck('name','id')->prepend('Please select', '');
        $faq = Faq::findOrFail($id);
        return view('backend.faqs.edit', compact('faq','category'));
    }

    /**
     * Update Testimonial in storage.
     *
     * @param  \App\Http\Requests\UpdateFaqsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqsRequest $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->category_id = $request->category;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('admin.faqs.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }



    /**
     * Remove Testimonial from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faqs.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Testimonial at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Faq::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function status($id)
    {
        $faq = Faq::findOrFail($id);
        if ($faq->status == 1) {
            $faq->status = 0;
        } else {
            $faq->status = 1;
        }
        $faq->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

}
