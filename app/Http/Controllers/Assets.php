<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Assets extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
    */
    public function asset(Request $request)
    {
        $query = $request->query();
        $response = Http::get('https://v2.xivapi.com/api/asset',
            [
                'version' => $query['version'],
                'path' => $query['path'],
                'format' => $query['format'],
            ]);

        switch ($query['format'])
        {
            case 'jpg':
            case 'png':
                $data = ['image' => "data:image/jpeg;base64," . base64_encode($response)];
            break;
            case 'webp':
                $data = [$response->json()];
                break;
        }

        return success($data);
    }

    public function map(Request $request)
    {
        $query = $request->query();
        $response = Http::get('https://v2.xivapi.com/api/asset/map/'.$query['territory'].'/'.$query['index'],
            [
                'version' => $query['version'],
            ]);
        return success(['image' => "data:image/jpeg;base64," . base64_encode($response)]);
    }
}
