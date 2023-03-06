<?php

namespace Modules\Information\Http\Controllers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Information\Entities\Page;

class InformationController extends Controller
{

    public function page(Page $page)
    {
        SEOMeta::setTitle($page->name)
            ->addMeta("revised", $page->updated_at)
            ->addMeta("designer", env("DESIGNER"));

        return view('information::page.index', compact('page'));
    }
}
