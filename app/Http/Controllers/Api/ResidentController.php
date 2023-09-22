<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;

class ResidentController extends Controller
{
    use HttpResponse;
    public function index()
    {
        $data = Resident::all();
        return $this->sendResponse($data, 'Data Fetch Successfully');
    }
}
