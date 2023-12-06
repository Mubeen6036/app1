<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use DB; 
use App\User;
use App\Category;
use App\Biome;
use App\Tag;
use App\Post;
use App\Country;
use App\Commodity;
use App\Language;  
use App\Counter;
use App\Helpers\Common;
use Hash;
use Cookie; 

class HomeController extends Controller {
  
	 
     public function __construct() {
         
     } 
  
    public  function test(Request $request) {

       
   }

    // Show Index Page
	public function index() {
        
        $data['category'] = Category::where('status','active')->orderBy('id','DESC')->get();
        $data['biome'] = Biome::where('status','active')->get();
        $data['tag'] = Tag::where('status','active')->get();
 
 
         $category =  DB::select(DB::raw(" SELECT id,name,slug,heading  FROM category WHERE status  = 'active' "));
         $post = array();
         foreach ($category as $key => $value) {
                $cat = array(); 
                $cat['id'] = $value->id;
                $cat['name'] = $value->name;
                $cat['slug'] = $value->slug;
                $cat['heading'] = $value->heading;
                $cat['post'] = Post::with('category_name')->where('status','active')->take('3')->where('category',$value->id)->orderBy('date_month','DESC')->get();
                $post[] = $cat;
         } 
         $data['all_post'] = $post;  
         $data['favorite'] = Post::with('category_name')->where('status','active')->where('favorite','yes')->take('3')->orderBy('date_month','DESC')->get(); 
        return view('index',$data);   
    } 


 public function top_resources(){ 
         $data['category'] = Category::where('status','active')->get();
         $data['biome'] = Biome::where('status','active')->get();
         $data['favorite'] = Post::with('category_name')->where('status','active')->where('favorite','yes')->orderBy('date_month','DESC')->paginate(20)->appends(request()->query()); 
         return view('top_resources',$data); 

    }



 
     public function resources_category($slug){ 
		 $kpi_search  = DB::table('kpi_search')->insert(['resource'=>$slug,'created_at'=>date('Y-m-d H:i:s')]);
         $data['category'] = Category::where('status','active')->get();
         $data['biome'] = Biome::where('status','active')->get();
         $category =  DB::select(DB::raw(" SELECT id,name,slug,heading  FROM category WHERE status  = 'active' and slug = '".$slug."' "));
         $post = array();
         foreach ($category as $key => $value) {
                $cat = array(); 
                $cat['id'] = $value->id;
                $cat['name'] = $value->name;
                $cat['slug'] = $value->slug;
                $cat['heading'] = $value->heading;
                $cat['post'] = Post::with('category_name')->where('status','active')->where('category',$value->id)->orderBy('date_month','DESC')->paginate(10)->appends(request()->query());
                $post[] = $cat;
         } 
         $data['all_post'] = $post;  
         return view('resources_category',$data); 

    }
  
 
  // Show about Page
    public function resources_detail($cat,$slug){
             $id = explode("-",$slug);
             $id = end($id);   
             $data['post'] =   Post::with('category_name')->where('status','active')->where('id',$id)->first();
			 
			 
			 if(@$data['post']->title){
				  $kpi_search  = DB::table('kpi_search')->insert(['post_name'=>$data['post']->title,'post_id'=>$data['post']->id,'created_at'=>date('Y-m-d H:i:s')]);
			 }
			 if(@$data['post']->category_name->slug){
				  $kpi_search  = DB::table('kpi_search')->insert(['resource'=>$data['post']->category_name->slug,'created_at'=>date('Y-m-d H:i:s')]);
			 }
			  $data['posts'] =  Post::with('category_name')->where('status','active')->take('3')->where('category',$data['post']->category_name->id)->where('id','!=',$id)->orderBy('date_month','DESC')->get();
             return view('resources_detail',$data); 
    }     

	// Show about Page
	public function about() {
		return view('about');   
    } 
	    // Show contact Page
	public function contact() {
		return view('contact');   
    } 
	    // Show knowledge_hub Page
	public function knowledge_hub() {
		return view('knowledge_hub');   
    } 
	    // Show privacy_policy Page
	public function privacy_policy() {
		return view('privacy_policy');   
    } 
 

	
	// Show terms_conditions Page
	public function terms_conditions() {
		return view('terms_conditions');   
    } 
	
    //advanced_filters 
    public function advanced_filters(Request $request) {
         $data['category'] = Category::where('status','active')->get();
         $data['biome'] = Biome::where('status','active')->get();
         $data['tag'] = Tag::where('status','active')->get();
         $data['country'] = Country::where('status','active')->get();
         $data['commodity'] = Commodity::where('status','active')->get();
         $data['language'] = Language::where('status','active')->get();
         return view('advanced_filters',$data); 
    }
     
   //   search Page
	public function search(Request $request) { 
        $sql = ''; 
        $sql.= " `status` = 'active' ";
        $wheresql=''; 
      
        if (isset($request->resource)) {
            $resource_array = explode(',', $request->resource_id);
            foreach($resource_array as $item){
                $resource_where[] = "FIND_IN_SET('$item', `category`) > 0";
            }
            if(is_array($resource_where)){
                $sql.= " AND (";
                $sql.= implode(' OR ', $resource_where);
                $sql.= ")";
            }
        }
          if (isset($request->biome)) {
            $biomeid_array = explode(',', $request->biome_id);
            foreach($biomeid_array as $item){
                $biomeid_where[] = "FIND_IN_SET('$item', `biome`) > 0";
            }
            if(is_array($biomeid_where)){
                $sql.= " AND (";
                $sql.= implode(' OR ', $biomeid_where);
                $sql.= ")";
            }
        }
        
        if (isset($request->commodity)) {
            $commodity_array = explode(',', $request->commodity_id);
            foreach($commodity_array as $item){
                $commodity_where[] = "FIND_IN_SET('$item', `commodity`) > 0";
            }
            if(is_array($commodity_where)){
                $sql.= ' AND (';
                $sql.= implode(' OR ', $commodity_where);
                $sql.= ')';
            }
        }
        

        if (isset($request->country)) {
            $country_array = explode(',', $request->country_id);
            foreach($country_array as $item){
                $country_where[] = "FIND_IN_SET('$item', `country`) > 0";
            }
            if(is_array($country_where)){
                $sql.= ' AND (';
                $sql.= implode(' OR ', $country_where);
                $sql.= ')';
            }
        }
        

        if (isset($request->language)) {
            $language_array = explode(',', $request->language_id);
            foreach($language_array as $item){
                $language_where[] = "FIND_IN_SET('$item', `language`) > 0";
            }
            if(is_array($language_where)){
                $sql.= ' AND (';
                $sql.= implode(' OR ', $language_where);
                $sql.= ')';
            }
        }
        if(isset($request->q)) { 
             $sql.= " AND `title` LIKE '%$request->q%'";
        }

		if (isset($request->q)) {
			  $kpi_search  = DB::table('kpi_search')->insert(['title'=>$request->q,'created_at'=>date('Y-m-d H:i:s')]);
		} else{
			$search  =  "";
		} 


 		if (isset($request->biome)) {
				$biome_array = explode(',', $request->biome);
				foreach($biome_array as $val){
					 $kpi_search  = DB::table('kpi_search')->insert(['biome'=>$val,'created_at'=>date('Y-m-d H:i:s')]);
				} 
		}else{
				$biome_array = array();
		} 
         
         if (isset($request->resource)) {
                $resource_array = explode(',', $request->resource);
                foreach($resource_array as $val){
                    $kpi_search  = DB::table('kpi_search')->insert(['resource'=>$val,'created_at'=>date('Y-m-d H:i:s')]);
                }
        }else{
                $resource_array = array();
        } 

 
        if(isset($request->commodity)) {
           $commodity_array = explode(',', $request->commodity);
                foreach($commodity_array as $val){
                    // $kpi_search  = DB::table('kpi_search')->insert(['commodity'=>$val,'created_at'=>date('Y-m-d H:i:s')]);
                } 
        }else{
                $commodity_array = array();
        }


        if(isset($request->country)) {
           $country_array = explode(',', $request->country);
                foreach($country_array as $val){
                     //$kpi_search  = DB::table('kpi_search')->insert(['country'=>$val,'created_at'=>date('Y-m-d H:i:s')]);
                } 
        }else{
                $country_array = array();
        }


        if(isset($request->language)) {
           $language_array = explode(',', $request->language);
                foreach($language_array as $val){
                     //$kpi_search  = DB::table('kpi_search')->insert(['language'=>$val,'created_at'=>date('Y-m-d H:i:s')]);
                } 
        }else{
                $language_array = array();
        } 
		
	     $data['search'] = $request->q;
	     $data['biome_array'] = $biome_array; 
	     $data['resource_array'] = $resource_array;
         $data['commodity_array'] = $commodity_array;
         $data['country_array'] = $country_array;
         $data['language_array'] = $language_array;  
         $data['category'] = Category::where('status','active')->get();
         $data['biome'] = Biome::where('status','active')->get(); 
         $data['country'] = Country::where('status','active')->get();
         $data['commodity'] = Commodity::where('status','active')->get();
         $data['language'] = Language::where('status','active')->get();  
         $data['post'] = DB::table('post')->select('*')->whereRaw($sql)->orderBy('date_month','DESC')->paginate(15)->appends(request()->query());  
       	 return view('search',$data);   
    }
	 
 
    // search  filter
    public function search_filter(Request $request){  
		     $search  =  $request->search;  
			 
			 if(empty($search)){
				  /* Search category Start */
                 $category = DB::table('category')
                             ->select('category.id','category.slug','category.name')
                             ->where([['category.status','=','active']])
                             ->orderby('category.id','desc')->get();  
                if(count($category)){                    
                        echo "<h6><b>Quick Links</b></h6><ul>";
                        foreach ($category as $key1 => $value1) {
                             $name = preg_replace('#'. preg_quote($search) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $value1->name);
                              echo "<li><a href=". url('/resources/'.$value1->slug). "> <div class='name-search'>".  $name ."</div></a> </li>";
                           }
                     echo "</ul>";   
                }

                  /* Search biome Start */
                 $biome = DB::table('biome')
                             ->select('biome.id','biome.slug','biome.name')
                             ->where([['biome.status','=','active']])
                             ->orderby('biome.id','desc')->get();  
                if(count($biome)){                    
                        echo "<h6><b>Biome</b></h6><ul>";
                        foreach ($biome as $key2 => $value2) {
                             $name = preg_replace('#'. preg_quote($search) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $value2->name);
                              echo "<li><a href=". url('/search?biome='.$value2->slug). "> <div class='name-search'>".  $name ."</div></a> </li>";
                           }
                     echo "</ul>";   
                } 


				 
			 } else {
		    /* Search product Start */
                 $post = Post::with('category_name')
                                ->where([['post.title', 'like', '%' . $request->search . '%'],['post.description', 'like', '%' . $request->search . '%'],['post.status','=','active']])
                               ->orderBy('post.date_month','DESC')->limit(5)->get(); 
							 
				    if(count($post)){                 
                        echo "<h6><b>Related Results</b></h6><ul>";
                        foreach ($post as $key => $value) {
                            $name = preg_replace('#'. preg_quote($search) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $value->title);
						 
                            echo "<li><a href=". url('/resources/'.$value->category_name->slug . '/'. preg_replace('/[^a-zA-Z0-9]+/','-', strtolower($value->title)).'-'.$value->id) .  "> ". $name ." </a> </li>"; 
                          }  
                     echo "</ul>"; 
                }
				 
				 /* Search category Start */
                 $category = DB::table('category')
                             ->select('category.id','category.slug','category.name')
                             ->where([['category.name', 'like', '%' . $request->search . '%'],['category.status','=','active']])
                             ->orderby('category.id','desc')->get();  
                if(count($category)){                    
                        echo "<h6><b>Category</b></h6><ul>";
                        foreach ($category as $key1 => $value1) {
                             $name = preg_replace('#'. preg_quote($search) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $value1->name);
                              echo "<li><a href=". url('/resources/'.$value1->slug). "> <div class='name-search'>".  $name ."</div></a> </li>";
                           }
                     echo "</ul>";   
                }  

                /* Search biome Start */
                 $biome = DB::table('biome')
                             ->select('biome.id','biome.slug','biome.name')
                             ->where([['biome.name', 'like', '%' . $request->search . '%'],['biome.status','=','active']])
                             ->orderby('biome.id','desc')->get();  
                if(count($biome)){                    
                        echo "<h6><b>Biome</b></h6><ul>";
                        foreach ($biome as $key2 => $value2) {
                             $name = preg_replace('#'. preg_quote($search) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $value2->name);
                              echo "<li><a href=". url('/search?biome='.$value2->slug). "> <div class='name-search'>".  $name ."</div></a> </li>";
                           }
                     echo "</ul>";   
                }  


                /* Search tag Start
                 $tag = DB::table('tag')
                             ->select('tag.id','tag.slug','tag.name')
                             ->where([['tag.name', 'like', '%' . $request->search . '%'],['tag.status','=','active']])
                             ->orderby('tag.id','desc')->get();  
                if(count($tag)){                    
                        echo "<h6><b>Tag</b></h6><ul>";
                        foreach ($tag as $key2 => $value2) {
                             $name = preg_replace('#'. preg_quote($search) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $value2->name);
                              echo "<li><a href=". url('/search?tag='.$value2->slug). "> <div class='name-search'>".  $name ."</div></a> </li>";
                           }
                     echo "</ul>";   
                }   */



                    //
              /* Search category End */
				      
               if((count($post) == 0)  && (count($category) == 0) && (count($biome) == 0)) {
                        "<h6 class='text-center'><b>No records found!!!</b></h6>";
               }  
			    echo "<h6 class='text-center'><b><a href=" . url('/search?q='.$request->search). ">View all results</a></b></h6>";
				
			 
			 }
				 
   }
  

    public function send_ajax_mail(Request $request){
		
		echo 1;
		die();
         $users = User::where('email', $request->email)->get();
            if(sizeof($users) == 0){
                $response[] = array("status" => 'false',"message" => "Email not exist .try again!!");
            } else {
                    $name = $request->name;
                    $email = $request->email;
                    $subject = $request->subject;
                    $message = $request->message;
                    $common = new Common;
                    $send = $common->send_mail($name,$email,$subject,$message);
                   if($send){
                           $response[] = array("status" => 'true',"message" => "Mail has been Send Successfully");
                    } else{
                           $response[] = array("status" => 'false',"message" => "error while Sending mail!!!");
                    }
           }
        echo json_encode($response);
    } 

    


}
