<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class screenshotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'textarea' => 'required',
            ]);

        $option = $request->input('screenOption');
        $count = count($option)+1;

        $to_be_replace = array(" ","https://", "http://", "www.");
        $will_replace = array("", "", "", "", "");
        $pieces = explode(PHP_EOL, str_replace($to_be_replace, $will_replace, $request->input('textarea')));


        return view('screenShot.index', compact('pieces', 'option', 'count'));
        // return $pieces;
    }

    public function downloadTxt(Request $request) {

        $contents = implode(PHP_EOL, $request->input('url'));

        $filename = 'export.txt';

        $headers = array(
          'Content-Type' => 'plain/txt',
          'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
          'Content-Length' => strlen($contents),
        );

        // return strlen($contents);
        return \Response::make($contents, 200, $headers);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('screenShot.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
