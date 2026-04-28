<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $links;
    public function __construct()
    {
        $this->links = [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Products', 'url' => route('products.index')],
            ['name' => 'Product Details', 'url' => '#'],
        ];
    }


    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
