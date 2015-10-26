<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class Bingo extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $req)
	{
		$fetch = $req->get('fetch');
		$numbers = $req->get('numbers');
		if(empty($numbers)){
			return \App\Bingo::all()->keyBy('id');
		}else{
			$x1 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(1)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();
			$x2 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(2)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();
			$x3 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(3)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();
			$x4 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(4)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();
			$x5 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(5)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();

			$y1 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(1)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();
			$y2 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(2)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();
			$y3 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(3)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();
			$y4 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(4)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();
			$y5 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(5)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();

			$xy1 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				orWhere(function($query){
					$query->whereX(1)->
					whereY(1);
				})->
				orWhere(function($query){
					$query->whereX(2)->
					whereY(2);
				})->
				orWhere(function($query){
					$query->whereX(4)->
					whereY(4);
				})->
				orWhere(function($query){
					$query->whereX(5)->
					whereY(5);
				})->
				whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();

			$xy2 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				orWhere(function($query){
					$query->whereX(1)->
					whereY(5);
				})->
				orWhere(function($query){
					$query->whereX(2)->
					whereY(4);
				})->
				orWhere(function($query){
					$query->whereX(4)->
					whereY(2);
				})->
				orWhere(function($query){
					$query->whereX(5)->
					whereY(1);
				})->
				whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 3)->with('numbers')->get();
			return collect($x1, $x2, $x3, $x4, $x5, $y1, $y2, $y3, $y4, $y5, $xy1, $xy2);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return \App\Bingo::whereCardId($id)->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\App\Bingo::whereCardId($id)->delete();
	}

}
