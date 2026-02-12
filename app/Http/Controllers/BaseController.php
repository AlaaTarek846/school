<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    // view pages
    protected $layout = 'Frontend.Layouts.app';
    protected $page = 'Frontend.pages.';
    protected $header = 'Frontend.Partials.header.';
    protected $footer = 'Frontend.Partials.footer.';
    protected $elements = 'Frontend.Partials.elements.';
    protected $components = 'Frontend.Partials.components.';
    protected $partials = 'Frontend.Partials.';

    protected function view(string $view, array $data = []){
        $data = array_merge([
            'layout' => $this->layout,
            'header' => $this->header,
            'footer' => $this->footer,
            'elements' => $this->elements,
            'components' => $this->components,
            'partials' => $this->partials,
        ], $data);
        return view("{$this->page}.{$view}", $data);
    }

}
