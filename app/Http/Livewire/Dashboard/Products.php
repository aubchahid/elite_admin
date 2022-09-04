<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private $products;

    protected $listeners = ['success'];


    public $name, $price, $qte, $promo;

    public $eid, $ename, $eprice, $eqte, $epromo;

    public $search, $idProduct;

    public function success()
    {
        $this->name = "";
        $this->price = "";
        $this->qte = "";
        $this->promo = "";


        $this->ename = "";
        $this->eprice = "";
        $this->eqte = "";
        $this->epromo = "";
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'qte' => 'required',
        ]);

        Product::create([
            'name' => $this->name,
            'unit_price' => $this->price,
            'stock' => $this->qte,
            'promo' => $this->promo,
        ]);

        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => "Le produit a été ajouté avec succès."]);
    }

    public function deleteProduct()
    {
        Product::updateOrCreate(['id' => $this->idProduct], [
            'is_deleted' => 1,
        ]);
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => "Le produit a été supprimé avec succès."]);
    }

    public function setProduct($id)
    {
        $product = Product::find($id);
        $this->eid = $product->id;
        $this->ename = $product->name;
        $this->eprice = $product->unit_price;
        $this->eqte = $product->stock;
        $this->epromo = $product->promo;
    }

    public function edit()
    {
        Product::updateOrCreate(['id' => $this->eid], [
            'name' => $this->ename,
            'unit_price' => $this->eprice,
            'stock' => $this->eqte,
            'promo' => $this->epromo,
        ]);
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => "Le produit a été modifiée avec succès."]);
    }


    public function addingToStock()
    {
        $product = Product::find($this->idProduct);
        Product::updateOrCreate(['id' => $this->idProduct], [
            'stock' => $product->stock + $this->qte,
        ]);
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => $this->qte . " unités ont été ajoutées au produit " . $product->name . "."]);
    }
    public function render()
    {
        $this->products = Product::where([
            ['name', 'like', '%' . $this->search . '%'],
            ['is_deleted', false]
        ])->paginate(5);
        return view('livewire.dashboard.products', ['products' => $this->products])->layout('layouts.dashboard', ['title' => "Produits"]);
    }
}
