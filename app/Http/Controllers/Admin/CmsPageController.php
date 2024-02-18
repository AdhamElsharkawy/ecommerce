<?php

namespace App\Http\Controllers\Admin;

use App\Models\CmsPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cmsPages = CmsPage::all();
        return view('admin.pages.cms_pages_index', compact('cmsPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id=null)
    {
        if($id==""){
            $cmsPage = new CmsPage;
            $title = "Add CMS Page";
            $message = "CMS Page added successfully!";
        }else{
            $cmsPage = CmsPage::find($id);
            $title = "Edit CMS Page";
            $message = "CMS Page updated successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            //validation
            $rules = [
                'title' => 'required',
                'url' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Title is required',
                'url.required' => 'URL is required',
            ];
            $validated = $this->validate($request, $rules, $customMessages);
            $cmsPage->title = $data['title'];
            $cmsPage->url = $data['url'];
            $cmsPage->meta_title = $data['meta_title'];
            $cmsPage->meta_keywords = $data['meta_keywords'];
            $cmsPage->meta_description = $data['meta_description'];
            $cmsPage->status = 1;
            $cmsPage->save();
            return redirect('admin/cms-pages')->with('success_message',$message);
        }

        return view('admin.pages.add_edit_cms_page',compact('title','cmsPage'));

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CmsPage $cmsPage)
    {





    }

    public function updateCmsPageStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            $data = CmsPage::where('id', $data['page_id'])->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CmsPage $cmsPage)
    {
        //
    }
}
