<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index(){
        // $categories = Category::with(['parentCategory:id,name','user'])->select(['id','name','parent_id','user_id','order'])->get();
        $categories = Category::with(['parentCategory:id,name','user'])
        ->paginate(5);
        // return $categories; 
        // return response()->json($categories);
        // dd($categories[36]);
        return view("admin.categories.index",compact("categories"));
    }

    public function create(){
        $categories = Category::all();
        return view("admin.categories.create",compact("categories"));
    }

    public function changeStatus(Request $request){
        $request->validate([
            "id"=> ["required","integer","exists:categories"], 
        ]);
        $categoryId= $request->id;
        $category = Category::where('id',$categoryId)->first(); 
        if($category){
            $category->status = !$category->status;
            $category->save();
            alert()->success('Başarılı',$category->name ." güncellendi")
            ->showConfirmButton("Tamam")
            ->autoClose(5000);
           return redirect()->route("category.index");
        }
    }

    public function changeFeatureStatus(Request $request){
        $request->validate([
            "id"=> ["required","integer","exists:categories"], 
        ]);
        $categoryId= $request->id;
        $category = Category::where('id',$categoryId)->first(); 
        if($category){
            $category->feature_status = !$category->feature_status;
            $category->save();
            alert()->success('Başarılı',$category->name ." güncellendi")
            ->showConfirmButton("Tamam")
            ->autoClose(5000);
           return redirect()->route("category.index");
        }
    }

    public function delete(Request $request){
        $request->validate([
            "id"=> ["required","integer","exists:categories"],
        ]);
        $categoryId= $request->id;
        Category::where("id", $categoryId)->delete();
        alert()->success('Silindi',"Kategori silindi")
        ->showConfirmButton("Tamam")
        ->autoClose(3000);
       return redirect()->back();    
    }
     public function edit(int $id){
        $categories = Category::all();
        $category = Category::where('id',$id)->first(); 
        // dd($category);
        if($category){
            // dd($category);
            return view("admin.categories.create",["category"=>$category,"categories"=>$categories]);
        }
        else{
            alert()->error("Hata","Kategori bulunamadı !")->showConfirmButton("Tamam")->autoClose(3000);
            return redirect()->route("category.index");
        }
    } 

    public function store(CategoryStoreRequest $request){

        $slugCheck =$this->checkSlug( $request->slug );

        $category = new Category();
        $category->name = $request->name;
        $category->slug = is_null( $slugCheck ) ? Str::slug($request->slug ): Str::slug($request->slug . time() );
        $category->desciption = $request->description;
        $category->status = $request->status ? 1 : 0;
        $category->feature_status = $request->feature_status ? 1 :0;
        $category->seo_keywords = $request->seo_keywords;
        $category->seo_desciption = $request->seo_description;
        $category->parent_id = $request->parent_id;
        $category->order = $request->order;
        $category->user_id = random_int(1,10); 

        try{
            $category->save(); 
        }catch(\Exception $e){
            // alert()->error("Hata","Kategori eklenemedi.\nHata:".$e)->showConfirmButton("Tamam")->autoClose(3000);
            abort(404, $e->getMessage());
        }
        alert()->success("Kayıt Başarılı","Kategori eklendi")->showConfirmButton("Tamam")->autoClose(3000);
        return redirect()->route("category.index");
    }

    public function update(CategoryStoreRequest $request,int $id){
        $slug = Str::slug($request->slug);

        $slugCheck = $this->checkSlug($slug);

        $category = Category::find( $id );
        if( (!is_null( $slugCheck ) && $slugCheck->id == $request->id) || is_null( $slugCheck )){
            $category->slug = $slug;
        }else if( !is_null( $slugCheck ) && $slugCheck->slug != $request->slug ){
            $category->slug = Str::slug($slug.time());
        }else{
            $category->slug = Str::slug($slug.time());
        }

        $category->name = $request->name;
        $category->desciption = $request->desciption;
        $category->status = $request->status ? 1 : 0;
        $category->feature_status = $request->feature_status ? 1 :0;
        $category->seo_keywords = $request->seo_keywords;
        $category->seo_desciption = $request->seo_desciption;
        $category->parent_id = $request->parent_id;
        $category->order = $request->order;
        // $category->user_id = random_int(1,10); 

        
        try{
            $category->save(); 
        }catch(\Exception $e){
            // alert()->error("Hata","Kategori eklenemedi.\nHata:".$e)->showConfirmButton("Tamam")->autoClose(3000);
            abort(404, $e->getMessage());
        }
       
        alert()->success("Başarılı","Kategori güncellendi !")->showConfirmButton("Tamam")->autoClose(3000);
        return redirect()->route("category.index");
    }

    public function checkSlug(string $text){
        return  Category::where("slug",Str::slug($text))->first();
    }

}
