<?php

namespace Modules\Information\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Information\Entities\Page;

class InformationController extends Controller
{

    public function page(Page $page)
    {
        return view('information::page.index', compact('page'));
    }
}
