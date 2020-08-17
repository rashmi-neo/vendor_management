<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\Category\CategoryInterface as CategoryInterface;
use App\Http\Requests\VendorCategory;
use DB;

class CategoryController extends Controller
{
	/**
    * Initialize Repository
    *@Author Pooja <Pooja.lavhat@neosofttech.com>
    *
    * @return \App\Repositories\CategoryRepository
    */ 

    private $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
   {
       $this->categoryRepository = $categoryRepository;
   }

    /**
    * Index page of category.
    *@author Pooja<pooja.lavhat@neosofttech.com>
    * 
    * @param Illuminate\Http\Request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        if($request->ajax()){
            $data = $this->categoryRepository->all();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return view('admin.category.actions', compact('row'));
            })
            ->editColumn('status', function($row){
            
                $status = \Config::get('constants.CATEGORY_STATUS');

                if($row->status == 1){
                    
                    return $status['active'];
                    
                }else{
                    
                    return $status['inactive'];
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    	return view('admin.category.index');
    }


    public function create()
	{
	   return view('admin.category.create');
	}

	/**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\VendorCategory $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorCategory $request)
    {
    	$category = $request->all();
        
        DB::beginTransaction();
        
        try {
            $result = $this->categoryRepository->save($category);
            if($result) {
                DB::commit();
                return redirect('admin/categories')->with('success', 'Category added successfully.');
            } else {
                DB::rollback();
                return redirect('admin/categories')->with('error', 'Something went wrong!');
            }
        } catch(\Exception $e) {
            DB::rollback();
            return redirect('admin/categories')->with('error', json_encode($e->getMessage()));
        }
    }

    /**
    * Show the form for editing the specified Category.
    *@author Pooja<pooja.lavhat@neosofttech.com>
    *  
    * @param  $id
    * @return $category
    */
    public function edit($id)
    {
    	$categoryId = $id;
        
        try {
            $category = $this->categoryRepository->get($categoryId);
            if($category){
                return view('admin.category.edit',compact('category','categoryId'));
            }else{
                return redirect('admin/categories')->with('error', 'Category not found');
            }
        }catch(\Exception $e){
            return redirect('admin/categories')->with('error', json_encode($e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\VendorCategory  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorCategory $request, $id)
    {
    	$categoryUpdate = $request->all();
        
        DB::beginTransaction();
        
        try {
            $category =  $this->categoryRepository->update($id,$categoryUpdate);
            if($category){
                return redirect('admin/categories')->with('success', 'Category is successfully updated.');
            }
                DB::rollback();
                return redirect('admin/categories')->with('error','Category not found.');
        } catch(\Exception $e) {
            DB::rollback();
            return redirect('admin/categories')->with('error', json_encode($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryId = $id; 
    	$this->categoryRepository->delete($categoryId);
        return response()->json(['success' => true],200);
    }
}
