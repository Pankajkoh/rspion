<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search_keyword = '';
            $status = 'all'; // all status

            $request_data = $request->all();
            if ($request->has('search_keyword')) {
                $search_keyword = $request->search_keyword;
            }
           
            // avoid zero column as it's checkbox so we can't sort by it
            if ($request->has('order') && $request->order[0]['column'] != 0) {
                $sort_column_number = $request->order[0]['column'];
                $sort_column_dir = $request->order[0]['dir'];
                $sort_column_key = $request->columns[$sort_column_number]['data'];
            }

            $main_query = BlogCategory::query();
            $query = $main_query;
            if (!empty($search_keyword)) {
                $query = $query->where('name', 'LIKE', '%' . $search_keyword . '%');
            }
          
            if (!empty($sort_column_key)) {
                $query = $query->orderBy($sort_column_key, $sort_column_dir);
            } else {
                $query = $query->latest();
            }

            $data = $query->get();
            $count_total = $main_query->count();
            $count_filter = $count_total;
            return DataTables::of($data)

                ->addColumn('Name', function ($row) {
                    return $row->name;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at;
                })
              


                ->addColumn('action', function ($row) {


                    return view('admin.blog_category.partially.delete', compact('row'));
                })

                ->rawColumns(['action'])
                ->with([
                    "recordsTotal"    => $count_total,
                    "recordsFiltered" => $count_filter,
                ])
                ->make(true);
        }
        return view('admin.blog_category.index');
    }

    
    public function create()
    {
        return view('admin.blog_category.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [

            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog_category = new BlogCategory();
        $blog_category->name = $request->name;
        $blog_category->save();
        return redirect()->route('blog_category.index')->with('success', 'Blog Category added Successfully');
    }
    public function edit($id)
    {
        $blog_category = BlogCategory::find($id);
        return view('admin.blog_category.edit', compact('blog_category'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $blog_category = BlogCategory::find($id);
        if (isset($blog_category)) {

            $blog_category->name = $request->name;

            $blog_category->save();
            return redirect()->route('blog_category.index')->with('success', 'Blog Category updated successfully!');
        }
    }
    public function destroy(string $id)
    {
        $blog_category = BlogCategory::find($id);

        if ($blog_category) {
            $blog_category->delete(); // This will perform a soft delete

            return redirect()->back()->with('success', 'Blog Category has been deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Blog Category not found.');
        }
    }
}
