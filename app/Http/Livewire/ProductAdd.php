<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Modules\Ezbuy\Entities\Product;

class ProductAdd extends Component
{
    public $search = '';
    public $message = '';
    public $products = [];

    public function add()
    {
        $url = $this->search;
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            $this->message = 'Invalid URL';
            return;
            // abort(500, 'Invalid URL.');
        }
        $this->products = Product::create([
            'producturl' => $url,
        ]);
        $this->message = 'Success';
    }

    public function render()
    {
        return view('livewire.product-add', [
            // 'products' => User::where('name', 'like', '%'.$this->search.'%')->get(),
        ]);
    }
}
