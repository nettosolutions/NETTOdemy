<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Admin\StoreSponsorsRequest;
use App\Http\Requests\Admin\UpdateSponsorsRequest;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SponsorController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $sponsors = Sponsor::all();
        
        return view('backend.sponsors.index', compact('sponsors'));
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
        $sponsors = "";


        $sponsors = Sponsor::orderBy('created_at','desc')->get();




        return DataTables::of($sponsors)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ( $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $status = "";
                if($q->status == 1){
                    $status = "<a href='".route('admin.sponsors.status',['id'=>$q->id])."' class='btn mb-1 mr-1 btn-danger'> <i class='fa fa-power-off'></i></a>";
                }else{
                    $status = "<a href='".route('admin.sponsors.status',['id'=>$q->id])."' class='btn mb-1 mr-1 btn-success'> <i class='fa fa-power-off'></i></a>";
                }
                    $view .= $status;

                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.sponsors.edit', ['category' => $q->id])])
                        ->render();
                    $view .= $edit;

                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.sponsors.destroy', ['category' => $q->id])])
                        ->render();
                    $view .= $delete;

                return $view;

            })
            ->editColumn('logo',function ($q){
                if($q->logo != null){
                    return  '<img src="'.asset('storage/uploads/'.$q->logo).'" height="50px">';
                }
                return 'N/A';
            })

            ->editColumn('status', function ($q) {
                return ($q->status == 1) ? "Enabled" : "Disabled";
            })
            ->rawColumns(['actions','logo'])
            ->make();
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.sponsors.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreSponsorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsorsRequest $request)
    {
        $request = $this->saveFiles($request);

        Sponsor::create($request->all());


        return redirect()->route('admin.sponsors.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);

        return view('backend.sponsors.index', compact('sponsor'));
    }

    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateSponsorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsorsRequest $request, $id)
    {
        $request = $this->saveFiles($request);

        $sponsor = Sponsor::findOrFail($id);
        $sponsor->update($request->all());

        return redirect()->route('admin.sponsors.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }



    /**
     * Remove Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $sponsor = Sponsor::findOrFail($id);
        $sponsor->delete();

        return redirect()->route('admin.sponsors.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Sponsor::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function status($id)
    {
        $slide = Sponsor::findOrFail($id);
        if ($slide->status == 1) {
            $slide->status = 0;
        } else {
            $slide->status = 1;
        }
        $slide->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }


}
