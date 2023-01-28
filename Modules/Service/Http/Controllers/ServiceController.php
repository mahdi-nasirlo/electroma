<?php

namespace Modules\Service\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ServiceController extends Controller
{

    public function index()
    {
        SEOMeta::setTitle("درخواست خدمات")
            ->addMeta("designer", env("DESIGNER"));

        return view('service::service.index');
    }

    public function destroy($id)
    {
        //
    }
}
