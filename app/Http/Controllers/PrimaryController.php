<?php

namespace App\Http\Controllers;

use App\DBLog;
use App\DBLogTest;
use App\Models\PrimaryModels as Moloquent;
use App\Models\Account;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Input;
use Redirect;
use Carbon\Carbon;

class PrimaryController extends Controller
{
    public function home(Request $request, $template="home")
    {
        if ($request->uh=="123" && $request->up=="321") {
            // $getAllData = Moloquent::all();
            return view($template);
        } else {
            echo "WELCOME HOME ::)))";
        }
    }
    public function hometest(Request $request, $template="home")
    {
        if ($request->uh=="123" && $request->up=="321") {
            return view($template, ['test' => "test"]);
        } else {
            echo "WELCOME HOME ::)))";
        }
    }
    public function index(Request $request)
    {
        $mytime = Carbon::now();
        if ($request->un=="123" && $request->up=="321") {
            if ($request->from!=null &&$request->to!=null) {
                $start=$request->from.' 00:00:00';
                $end=$request->to.' 23:59:59';
            } elseif ($request->from!=null&&$request->to==null) {
                $start=$request->from.' 00:00:00';
                $end=$mytime;//for the now
            } elseif ($request->from==null&&$request->to!=null) {
                $end=$request->to.' 23:59:59';
                $start=DBLogTest::first()->created_at;// form  now;
            } else {
                $start=null;
                $end=null;
            }

            if ($request->start ==0) {
                $request['page']=1;
            } else {
                $request['page']= ($request->start / $request->length)+1;
            }
            // dd($start,$end);

            $query_length = $request['length'];
            $request['limit']=$query_length ;
            if($request['test'] == "0"){
                $users=DBLogTest::query();
                
            }else{
                $users= DBLog::query();
                
            }
            // return $users->get();
            if ($start!=null&&$end!=null) {
                // $start = new MongoDate(strtotime($start));
                // $stop = new MongoDate(strtotime($end));
                $start = new \MongoDB\BSON\UTCDateTime(strtotime($start) * 1000);
                $stop = new \MongoDB\BSON\UTCDateTime(strtotime($end) * 1000);
                // dd($date);
                // $users = DB::collection('users');

                // dd($users->where('created_at', '<=', time())->get());
                
                $users=$users
                    // ->where('created_at', '>=', $start)
                    ->whereBetween('created_at', array($start, $stop))
                    // ->where('created_at', '<=', $end)
                    ;

            }
            $columns=[
                0=>"user_id",
                1=>"user_name",
                3=>"created_at",
            ];
            // dd($request["search"]["value"]);
            $column= isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] :null;
            $dir=$request["order"][0]["dir"];
            if ($column!=null) {
                $users = $users->
                    orderBy($column, $dir);
            }
    
            if ($request["search"]["value"]  != null) {
                $users=$users->where('user_id', 'like', '%'.$request['search']["value"].'%')
                    ->orWhere('user_name', 'like', '%'.$request['search']["value"].'%')
                    ->orWhere('message', 'like', '%'.$request['search']["value"].'%')
                    ;
            }
    
            // dd($request['test'] == "0");
           
            $count=$users->count();
            $data=$users->orderBy("_id", "DESC")->simplepaginate($query_length)->toArray();
            
            $data['recordsTotal']=  $count;
            $data['recordsFiltered']=  $count;
            return response()->json($data);
        } else {
            echo "WELCOME HOME 2 ::)))";
        }
    }

    public function pages(Request $request, $template)
    {
        if ($request->un=="123" && $request->up=="321") {
            return view($template);
        } else {
            echo "WELCOME HOME 2 ::)))";
        }
    }

    public function saveLog(Request $request)
    {
        $getTable = new DBLog;
        $getTable->message =$request->input('message');
        $getTable->level = $request->input('level');
        $getTable->INFO = $request->input('INFO');
        $getTable->extra = $request->input('extra');
        $getTable->user_id = $request->input('user_id');
        $getTable->user_name = $request->input('user_name');
        $getTable->save();

        return 1;
    }

    public function saveLogtest(Request $request)
    {
        $getTable = new DBLogTest;
        $getTable->message =$request->input('message');
        $getTable->level = $request->input('level');
        $getTable->INFO = $request->input('INFO');
        $getTable->extra = $request->input('extra');
        $getTable->user_id = $request->input('user_id');
        $getTable->user_name = $request->input('user_name');
        $getTable->save();
        return  $request;
    }

    public function save(Request $request)
    {
        $getTable = new Moloquent;
        $getTable->username = $request->input('username');
        $getTable->email = $request->input('email');
        $getTable->address = $request->input('address');
        $getTable->save();

        return Redirect::to('home')
                ->with('success', 'You have been successfully insert data');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        
        $getTable = Moloquent::find($id);
        $getTable->username = $request->input('username');
        $getTable->email = $request->input('email');
        $getTable->address = $request->input('address');
        $getTable->save();
        
        return Redirect::to('home')
                ->with('success', 'You have been successfully update data');
    }

    public function getdata($id)
    {
        $getData = Moloquent::where('_id', $id)
                            ->get();
        
        $getAllData = Moloquent::all();
        
        return view('edit', ['get_user' => $getData, 'data_user' => $getAllData]);
    }
    public function delete($id)
    {
        $return = Moloquent::where('_id', $id)
                                ->delete();
        
        return Redirect::to('home')
                ->with('success', 'You have been successfully deleted data');
    }
    public function deleteAll()
    {
        $return = Moloquent::where('_id', '!=', '')->delete();
        
        return Redirect::to('home');
    }
    
    public function generateFake(Request $request)
    {
        $count = $request->input('fakedata');

        if ($count < 1000000) {
            $faker = Faker::create();
            for ($i=1; $i <= $count; $i++) {
                $user = new Moloquent;
                $user->username = $faker->name;
                $user->email = $faker->email;
                $user->address = $faker->address;
                $user->save();
            }
        }
        return Redirect::to('home');
    }
}
