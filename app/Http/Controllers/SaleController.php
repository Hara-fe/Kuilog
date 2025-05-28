<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SaleController extends Controller
{
    //public function index(){
        //モデル(eloquant)から始まる
    // $sales = Sale::all();//取りすぎ、重くなる



    //クエリビルダ
    //getを消すと、クエリビルダと表示
    //関数をつなげているメソッドチェーン
    //get()で確定=コレクションになる
    //$queryBuilder = DB::table('sales');
    //->select('id')->get();
    //dd($sales); }


    public function trainingA(){
        $q1 = Sale::where('id',10)->get();
        $q2 = Sale::where('price', '>=', 10000)->get();
        $q3 = Sale::latest()->take(10)->get();

        $q4 = Sale::where('category_id', 1)->sum('price');
        $q5 = Sale::where('category_id', 1)->avg('price');

        dd($q1, $q2, $q3, $q4, $q5);
        }


    public function trainingB(){
        $q6=Sale::orderByDesc('price')->first();
        
        $q7=Sale::where('category_id', 1)->orderByDesc('amount')->first();
        
        $q8=Sale::where('category_id', 3)->orderByDesc('price')->first();
        
        $q9=Sale::orderByDesc('price')->take(10)->get();

        $q10=Sale::select('category_id', DB::raw('count(*) as count'))->groupBy('category_id')->get();

        dd($q6,$q7,$q8,$q9,$q10);
    }


    public function trainingC(){

    $q11= Sale::select('category_id', DB::raw('avg(price) as avg_sales'))
    ->groupBy('category_id')
    ->get();

    $q12 = Sale::whereYear('created_at', 2025)
    ->orderByDesc('amount')
    ->first();

    $q13 = Sale::select(DB::raw('YEAR(created_at) as year'), DB::raw('max(price) as max_sales'))
    ->groupBy(DB::raw('YEAR(created_at)'))
    ->get();

    $q14 = Sale::whereYear('created_at', now()->year)->sum('price');

    $q15 = Sale::whereYear('created_at', 2022)
    ->whereMonth('created_at', 12)
    ->get();

    dd($q11,$q12,$q13,$q14,$q15);
    }

    public function trainingD(){

    $q16 = Sale::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(price) as amount'))
    ->groupBy(DB::raw('DATE(created_at)'))
    ->orderByDesc('amount')
    ->take(30)
    ->get();

    $q17 = Sale::whereYear('created_at', 2022)
    ->select(DB::raw('sum(price) as amount'), DB::raw('count(*) as total_count'))
    ->first();

    $q18 = Sale::whereYear('created_at', 2023)
    ->select('category_id', DB::raw('sum(price) as amount'), DB::raw('count(*) as total_count'))
    ->groupBy('category_id')
    ->orderByDesc('amount')
    ->get();

    $q19 = Sale::whereYear('created_at', 2024)
    ->select(DB::raw('MONTH(created_at) as month'), DB::raw('sum(price) as amount'), DB::raw('count(*) as total_count'))
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->get();

    $q20 = Sale::whereYear('created_at', 2021)
    ->select('category_id', DB::raw('sum(price) as amount'))
    ->groupBy('category_id')
    ->orderByDesc('amount')
    ->first();

    dd($q16,$q17,$q18,$q19,$q20);
    }

    public function trainingAA(){
        $collection = Sale::select('id', 'name', 'category_id','price', 'amount', 'created_at')->limit(10)->get();

        $c1=$collection->sum('amount');
        $c2=$collection->max('price');
        $c3=$collection->where('amount','<=',10)->count();
        $c4=$collection->groupBy('category_id')->count();
        $c5=$collection->shuffle();
        $c6=$collection->sortByDesc('created_at')->values();
        $c7=$collection->avg('price');
        $c8=$collection->toArray();
        $c9=$collection->toJson(JSON_PRETTY_PRINT);
        $c10=$collection->unique('category_id')->pluck('category_id')->values();
        $c11=$collection->chunk(5);
        $c12=$collection->map(function ($item) {$item->price = round($item->price * 1.1);return $item;});
        $c13=$collection->map(function ($item) {return $item->price * $item->amount;});
        $c14=$collection->map(function ($item) {return Carbon::parse($item->created_at)->diffInDays(now());});
        $c15=$collection->map(function ($item) {return ['Sale ID'=> $item->id,'Sale Name'   => $item->name,'Total Price' => $item->price * $item->amount,];});
        $c16=$collection->contains('category_id', 1);
        $c17=$collection->map(function ($item) {return collect($item)->except('created_at');});
        $c18=$collection->countBy('category_id');
        $c19=$collection->contains('category_id', 11);
        $c20=$collection->filter(function ($item) {return $item->price >= 5000 && $item->price <= 20000;})->values();

        dd($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$c13,$c14,$c15,$c16,$c17,$c18,$c19,$c20);
    }
}
