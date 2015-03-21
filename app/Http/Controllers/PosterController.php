<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\PosterRepository;
use App\Http\Requests\PosterRequest;
use Illuminate\Http\Request;

use Lang;

class PosterController extends Controller {

	public function __construct(PosterRepository $poster)
	{
		$this->middleware('auth');
		$this->poster = $poster;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('poster/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PosterRequest $request)
	{	
		$poster = $this->poster->CreateNewPoster($request::all());
		//\Debugbar::info($poster);
		return redirect('/home');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	public function update(PosterRepository $poster, Request $request, $id)
	{	
		$this->validate($request, ['maket_url' => 'required|url']);
		$url = $request['maket_url'];
		$res = $this->poster->UpdateUrl($id, $url);
		if ($res) return redirect('/home')->with('flash_message', Lang::get('messages.update_maket_url_success'));
		return redirect('/home')->with('flash_message', Lang::get('messages.error'))->with('alert-class', 'alert-danger');
		//return $request::all();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(PosterRepository $poster, $id)
	{	
		$res = $this->poster->DestroyPoster($id);
		if ($res) return redirect('/home')->with('flash_message', Lang::get('messages.destroy_poster_success'));
		//session()->flash('flash_message','sdfsdf');
		return redirect('home')->with('flash_message', Lang::get('messages.error'))->with('alert-class', 'alert-danger');
	}

}
