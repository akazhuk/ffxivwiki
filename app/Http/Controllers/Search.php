<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Search extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
    */
    public function search(Request $request)
    {
        $query = $request->query();
        $response = Http::get('https://v2.xivapi.com/api/search',
            [
                'version' => $query['version'],
                'query' => $query['query'],
                'sheets' => $query['sheets'],
                'cursor' => $query['cursor'],
                'limit' => $query['limit'],
                'language' => $query['language'],
                'schema' => $query['schema'],
                'fields' => $query['fields'],
                'transient' => $query['transient'],
            ]);
        return success($response->json());
    }


}
