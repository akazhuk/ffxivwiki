<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Sheets extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
    */
    public function list(Request $request)
    {
        $query = $request->query();
        $response = Http::get('https://v2.xivapi.com/api/sheet',
            [
                'version' => $query['version'],
            ]);
        return success($response->json());
    }

    /**
     * @param Request $request
     */
    public function rows(Request $request)
    {
        $query = $request->query();
        $response = Http::get('https://v2.xivapi.com/api/sheet/'.$query['sheet'],
            [
                'rows' => $query['rows'],
                'limit' => $query['limit'],
                'after' => $query['after'],
                'language' => $query['language'],
                'schema' => $query['schema'],
                'fields' => $query['fields'],
                'transient' => $query['transient'],
            ]);
        return success($response->json());
    }

    /**
     * @param Request $request
     */
    public function readSheetRow(Request $request)
    {
        $query = $request->query();
        $response = Http::get('https://v2.xivapi.com/api/sheet/'.$query['sheet'].'/'.$query['row'],
            [
                'language' => $query['language'],
                'schema' => $query['schema'],
                'fields' => $query['fields'],
                'transient' => $query['transient'],
            ]);
        return success($response->json());
    }

}
