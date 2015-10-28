<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Bingo extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $req)
	{
		$numbers = $req->get('n');
		if(empty($numbers)){
			return \App\Bingo::all()->keyBy('id');
		}else{
			$x1 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(1)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 4)->get();
			$x2 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(2)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 4)->get();

            $centerNumbers = $numbers;
            $centerNumbers[] = '0';
			$x3 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(3)->whereIn('number', $centerNumbers)->groupBy('card_id')->having('c', '>=', 4)->get();
			$x4 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(4)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 4)->get();
			$x5 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereX(5)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 4)->get();

			$y1 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(1)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 4)->get();
			$y2 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(2)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 4)->get();
			$y3 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(3)->whereIn('number', $centerNumbers)->groupBy('card_id')->having('c', '>=', 4)->get();
			$y4 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(4)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 4)->get();
			$y5 = \App\Bingo::select(\DB::raw('count(*) as c'), 'card_id')->
				whereY(5)->whereIn('number', $numbers)->groupBy('card_id')->having('c', '>=', 4)->get();

            $_xy1 = \App\Bingo::select('number', 'card_id')->whereX(1)->whereY(5)->get();
            $_xy2 = \App\Bingo::select('number', 'card_id')->whereX(2)->whereY(4)->get();
            $_xy3 = \App\Bingo::select('number', 'card_id')->whereX(3)->whereY(3)->get();
            $_xy4 = \App\Bingo::select('number', 'card_id')->whereX(4)->whereY(2)->get();
            $_xy5 = \App\Bingo::select('number', 'card_id')->whereX(5)->whereY(1)->get();

            $xy1 = array_merge([], $_xy1->toArray(), $_xy2->toArray(), $_xy3->toArray(),$_xy4->toArray(),$_xy5->toArray());
            $xy1 = collect($xy1);

            $centerNumbers = collect($centerNumbers);
            $xy1 = $xy1->filter(function($obj) use ($centerNumbers){
                return $centerNumbers->contains($obj['number']);
            })->groupBy('card_id')->map(function($obj, $key){
                return ['c' => count($obj), 'card_id' => $key];
            })->filter(function($obj){
                return $obj['c'] >= 4;
            });

            $_xy1_ = \App\Bingo::select('number', 'card_id')->whereX(1)->whereY(1)->get();
            $_xy2_ = \App\Bingo::select('number', 'card_id')->whereX(2)->whereY(2)->get();
            $_xy3_ = \App\Bingo::select('number', 'card_id')->whereX(3)->whereY(3)->get();
            $_xy4_ = \App\Bingo::select('number', 'card_id')->whereX(4)->whereY(4)->get();
            $_xy5_ = \App\Bingo::select('number', 'card_id')->whereX(5)->whereY(5)->get();

            $xy2 = array_merge([], $_xy1_->toArray(), $_xy2_->toArray(), $_xy3_->toArray(),$_xy4_->toArray(),$_xy5_->toArray());
            $xy2 = collect($xy2);

            $centerNumbers = collect($centerNumbers);
            $xy2 = $xy2->filter(function($obj) use ($centerNumbers){
                return $centerNumbers->contains($obj['number']);
            })->groupBy('card_id')->map(function($obj, $key){
                return ['c' => count($obj), 'card_id' => $key];
            })->filter(function($obj){
                return $obj['c'] >= 4;
            });

            $all = array_merge(
                $x1->toArray(),
                $x2->toArray(),
                $x3->toArray(),
                $x4->toArray(),
                $x5->toArray(),
                $y1->toArray(),
                $y2->toArray(),
                $y3->toArray(),
                $y4->toArray(),
                $y5->toArray(),
                $xy1->toArray(),
                $xy2->toArray()
            );
            usort($all, function($a, $b){return $b['c'] - $a['c'];});
            $all = collect($all)->groupBy('card_id')->map(function($obj){return $obj[0];});
			return $all;
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $req)
	{
        $type = $req->get('type');
        if($type == "restore"){
            \App\Bingo::onlyTrashed()->restore();
        }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $req)
	{
        $this->validate($req, ['name', 'data']);
        $name = $req->json('name');
        $data = $req->json('data');
        foreach ($data as $x_i => $row) {
            foreach($row as $y_i => $number){
                $bingo = \App\Bingo::create([
                    'card_id'   => $name,
                    'number'    => $number,
                    'x'         => ($x_i + 1),
                    'y'         => ($y_i + 1)
                ]);
            }
        }
        return $bingo;
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
		$bingo = \App\Bingo::whereCardId($id);
        $bingo->restore();
        return $bingo;
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
		return \App\Bingo::whereCardId($id)->delete();
	}

}
