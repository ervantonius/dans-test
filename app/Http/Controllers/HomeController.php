<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $input = $request->only([
            'page',
            'description',
            'location',
            'type_time'
        ]);

        if (!empty($input['type_time'])) {
            $input['full_time'] = 'true';
        }

        $result = $this->list_positions(array_filter($input));

        if (!empty($result) && is_array($result)) {
	        return view('home', [
	        	'data' => $result,
                'is_able_next_page' => $this->is_able_next_page(array_filter($input))
	        ]);
        } else {
            return view('home')->withErrors([
            	'message' => 'There\'s something wrong with our data.'
            ]);
        }
    }

    private function list_positions($query = [])
    {
        $url = 'https://jobs.github.com/positions.json';
        
        if (!empty($query)) {
            $url .= '?'.http_build_query($query);
        }

        $headers = array(
            'Content-Type: application/x-www-form-urlencoded'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = json_decode(curl_exec($ch));

        return $result;
    }

    private function is_able_next_page($query = [])
    {
        if (!empty($query['page'])) {
            $query['page'] = intval($query['page']) + 1;
        } else {
            $query['page'] = 2;
        }

        return (count($this->list_positions($query))) ? $query['page'] : 0;
    }
}
