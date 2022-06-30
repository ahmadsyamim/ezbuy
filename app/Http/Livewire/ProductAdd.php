<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Modules\Ezbuy\Entities\Product;
use App\Models\Buyforme;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Events\ProductUpdated;

class ProductAdd extends Component
{
    public $search = '';
    public $message = '';
    public $url = false;
    public $products = [];
    public $product_id = false;
    public $data = null;

    // protected $listeners = ['ProductUpdated' => 'ProductUpdated'];
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function ProductUpdated(Buyforme $product)
    {
        dd($product);
        dd($this->product_id);
        // $this->postCount = Post::count();
    }

    public function scrape($id) {
        $product = Buyforme::find($id);
        if (!$product) { dd('error'); }
        $process = Process::fromShellCommandline(sprintf(
            'cd %s && node resources/scraper/mercari.js 1 --id=%s --noloop=true',
            base_path(),
            $id
        ), null, ['COMPOSER_HOME' => getenv('COMPOSER_HOME')]);
        $process->setTimeout(480);
        $process->run();
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        } else {
            ProductUpdated::dispatch($product);
        }
        $output = json_decode($process->getOutput()); 
    }

    public function add()
    {
        // $this->message = 'Loading';
        $url = $this->search;
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            $this->message = 'Invalid URL';
            return;
            // abort(500, 'Invalid URL.');
        }
        $this->products = Buyforme::create([
            'producturl' => $url,
            'user' => auth()->user() ? auth()->user()->id : 0,
        ]);
        // $this->scrape($this->products->id);
        $this->product_id = $this->products->id;
        // $this->data = $this->products;
        $this->data = Buyforme::find($this->product_id);
        $this->message = 'Success';
        $this->url = url()->route('ezbuy.item',[$this->product_id]);
    }

    public function render()
    {
        return view('livewire.product-add', [
            'data' => $this->data,
            // 'products' => User::where('name', 'like', '%'.$this->search.'%')->get(),
        ]);
    }
}
