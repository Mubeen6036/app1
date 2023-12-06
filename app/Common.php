<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB; 
use App\User;
use App\Category;
use App\Biome;
use App\Tag;
use App\Post;
use App\Counter; 
use Illuminate\Support\Facades\Auth;
class Common extends Model {        
     
      public static function get_biome($id) {
		 $biome_array =   explode(",",$id); 
	     $biome =  Biome::select('name')->whereIn('id',$biome_array)->get()->toArray();
			  if($biome){
					 $hasComma = false; 
					 foreach($biome as $val){
						 if($hasComma){ 
						     echo ", ";  
						 } 
					     echo $val['name'];
					     $hasComma=true;
					}
			  }  
      }
	  
	  
	  public static function get_biome_css($id) {
		 $biome_array =   explode(",",$id); 
	     $biome =  Biome::select('slug')->whereIn('id',$biome_array)->get()->toArray();
			  if($biome){
					 foreach($biome as $val){
					     echo "biome-".$val['slug']." ";
					}
			  }  
      }
	  
	  public static function get_biome_css2($id) {
		 $biome_array =   explode(",",$id); 
	     $biome =  Biome::select('slug')->whereIn('id',$biome_array)->get()->toArray();
			  if($biome){
					 foreach($biome as $val){
					     echo  $val['slug']." ";
					}
			  }  
      }


      public static function get_category_slug($id) {
         return  Category::where('id',$id)->first()->slug; 
      }


      


	  
       public static function in_array_any($key1,$key2,$id) {
    		  if(!empty(array_intersect($key1,$key2))){
				  return $id;
			  }  
       }
 
     public static function timeAgo($time_ago) {
                $time_ago = strtotime($time_ago);
                $cur_time   = time();
                $time_elapsed   = $cur_time - $time_ago;
                $seconds    = $time_elapsed ;
                $minutes    = round($time_elapsed / 60 );
                $hours      = round($time_elapsed / 3600);
                $days       = round($time_elapsed / 86400 );
                $weeks      = round($time_elapsed / 604800);
                $months     = round($time_elapsed / 2600640 );
                $years      = round($time_elapsed / 31207680 );
                // Seconds
                if($seconds <= 60){
                    return "just now";
                }
                //Minutes
                else if($minutes <=60){
                    if($minutes==1){
                        return "one minute ago";
                    }
                    else{
                        return "$minutes minutes ago";
                    }
                }
                //Hours
                else if($hours <=24){
                    if($hours==1){
                        return "an hour ago";
                    }else{
                        return "$hours hrs ago";
                    }
                }
                //Days
                else if($days <= 7){
                    if($days==1){
                        return "yesterday";
                    }else{
                        return "$days days ago";
                    }
                }
                //Weeks
                else if($weeks <= 4.3){
                    if($weeks==1){
                        return "a week ago";
                    }else{
                        return "$weeks weeks ago";
                    }
                }
                //Months
                else if($months <=12){
                    if($months==1){
                        return "a month ago";
                    }else{
                        return "$months months ago";
                    }
                }
                //Years
                else{
                    if($years==1){
                        return "one year ago";
                    }else{
                        return "$years years ago";
                    }
                }
    }



}    	

