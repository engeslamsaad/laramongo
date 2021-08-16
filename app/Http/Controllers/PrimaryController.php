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
        if ($request->un=="123" && $request->up=="321") {
            if ($request->start ==0) {
                $request['page']=1;
            } else {
                $request['page']= ($request->start / $request->length)+1;
            }

            $query_length = $request['length'];
            $request['limit']=$query_length ;
            // dd($request['test'] == "0");
            if($request['test'] == "0"){
                $users=new DBLogTest;
            }else{
                $users=new DBLog;
            }
            $count=$users->count();
            $data=$users->orderBy("_id", "DESC")->simplepaginate($query_length)->toArray();
            // dd($request['limit'], $request['page'],$count );
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
