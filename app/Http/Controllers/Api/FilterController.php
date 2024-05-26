<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function filter_by_post($id)
    {
        if ($id != -1) {
            //            $employers = DB::table("users")
            //                ->rightJoin("employees","users.id","=","employees.user_id")
            //                ->rightJoin("posts","employees.post_id","=","posts.id")
            //                ->leftJoin("leaves","employees.social_number","=","leaves.social_number")
            //                ->where("employees.post_id",$id)
            //                ->groupBy('employees.social_number','posts.name','users.first_name','users.last_name',"employees.salary","employees.hiring_date")
            //                ->select("employees.social_number","posts.name as post_name"
            //                   ,"users.first_name","users.last_name","employees.salary","employees.hiring_date",
            //                    DB::raw('if(count(leaves.social_number)>0,true,false) as inHoliday'))
            //                ->get();
            $employers = EmployeeResource::collection(Employee::where("post_id", $id)->get());
        } else {
            //            $employers = DB::table("users")
            //            ->rightJoin("employees","users.id","=","employees.user_id")
            //            ->rightJoin("posts","employees.post_id","=","posts.id")
            //            ->leftJoin("leaves","employees.social_number","=","leaves.social_number")
            //            ->groupBy('employees.social_number','posts.name','users.first_name','users.last_name',"employees.salary","employees.hiring_date")
            //            ->select("employees.social_number","posts.name as post_name",
            //               "users.first_name","users.last_name","employees.salary","employees.hiring_date",
            //                    DB::raw('if(count(leaves.social_number)>0,true,false) as inHoliday'))
            //                ->get();
            $employers = EmployeeResource::collection(Employee::all());
        }
        return response()->json(["employers" => $employers]);
    }
}
