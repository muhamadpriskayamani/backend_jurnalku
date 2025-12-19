<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Resources\GetResource;

class SettingController extends Controller
{
    //
    public function index()
    {
        $setting = Setting::latest()->paginate(5);
        return new GetResource($setting);
    }

    public function store(Request $request)
    {
        $setting = Setting::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ]);
        return new GetResource($setting);
    }
}
