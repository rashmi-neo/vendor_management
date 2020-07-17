<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\Category\CategoryInterface as CategoryInterface;
use App\Http\Requests\VendorCategory;

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
    * @param void
    * @return void
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
        $this->categoryRepository->save($category);
        return redirect('admin/categories')->with('success', 'Category  is successfully saved');
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
    	$category = $this->categoryRepository->get($categoryId);
        
        try {
            if($category){
    	        return view('admin.category.edit',compact('category','categoryId'));
            }else{
                return redirect('admin/categories')->with('error', 'Category not found');
            }
        }catch(\Throwable $th){
            return redirect('admin/categories')->with('error', 'Something went wrong!');
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
        
        try{
            $category =  $this->categoryRepository->update($id,$categoryUpdate);
            if($category){
                return redirect('admin/categories')->with('success', 'Category is successfully updated');
            }
                return redirect('admin/categories')->with('error','Category not found');
        }catch(\Exception $ex){
            return redirect('admin/categories')->with('error','Something went wrong!');
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
