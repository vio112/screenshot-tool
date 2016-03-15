<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cache;
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
        $historical = [];
        $content = "";

        foreach ($pieces as $key => $url) {

            // $url = 'http://dynupdate.no-ip.com/ip.php';
            // $proxy = '127.0.0.1:8888';

            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL,$url);
            // curl_setopt($ch, CURLOPT_PROXY, $proxy);
            // //curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_HEADER, 1);
            // $curl_scraped_page = curl_exec($ch);
            // curl_close($ch);

            // echo $curl_scraped_page;


            if(empty($url))
            {
                unset($pieces[$key]);
            }
            else
            {
                if (Cache::has($url)) {
                    // echo "cached!";
                    $historical[$key] = Cache::get($url);
                }
                else{
                    // echo "not cached!";
                    $history = 'http://api.screenshots.com/v1/'. $url .'/history/';
                    $content = @file_get_contents($history);

                    if($content === FALSE){
                        unset($pieces[$key]);
                    }
                    else{
                        // $historical[$key] = json_decode($content, true);
                        $historical[$key] = Cache::remember($url, 1440, function() use ($content)
                        {
                            return json_decode($content, true);
                        });
                    }
                }
            }
        }

        return view('screenShot.index', compact('pieces', 'historical', 'option', 'count'));
        // return $historical[0]['historical'][0]['large'];
        // return $historical;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $history = 'http://api.screenshots.com/v1/'. $id .'/history/';
        $content = file_get_contents($history);

        return response()->json($content);
        // return view('screenShot.show', compact('id'));
    }

    public function imagePaginate($option, $url, $id)
    {
        $cached = Cache::get($url);

        if(strcmp($option, 'current') == 0)
        {
            $content = $cached;
            list($width, $height, $type, $attr) = getimagesize( $content['large_current'] );
        }
        else
        {
            $content = $cached['historical'][$id];
            list($width, $height, $type, $attr) = getimagesize( $content['large'] );
        }

        $content['option'] = $option;
        $content['width'] = $width;
        $content['height'] = $height;

        json_encode($content);

        return Response()->json($content);
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
