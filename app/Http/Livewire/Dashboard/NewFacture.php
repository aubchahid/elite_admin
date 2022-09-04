<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewFacture extends Component
{

    public $products = array();

    public $allProducts, $allClients;
    public $search, $client, $idProduct, $qte, $total = 0, $name, $nameClient, $idClient;

    public $active, $stock;

    public function addingToInvoice()
    {
        $this->validate([
            "search" => "required",
            "qte" => "required",
            "name" => "required",
            "nameClient" => "required"
        ]);

        $pr = Product::find($this->idProduct);

        if ($this->qte <= $pr->stock) {
            $this->total = $this->total + ($this->qte * $pr->unit_price);
            $toCart = [
                "id" => $pr['id'],
                "name" => $pr['name'],
                "price" => $pr['unit_price'],
                "qte" => $this->qte,
                "total" => $this->qte * $pr['unit_price'],
            ];
            array_push($this->products, $toCart);
            $this->active = "disabled";
            $this->search = $this->qte = "";
            $this->stock = '';
        } else {
        }
    }


    public function removeFromCart($id)
    {

        $this->total = $this->total - $this->products[$id]['total'];
        unset($this->products[$id]);
    }

    public function setValue($id, $name, $qte)
    {
        $this->search = $this->nameClient = $name;
        $this->idProduct = $id;
        $this->stock = $qte;
    }

    public function setClient($id, $name)
    {
        $this->client = $this->name = $name;
        $this->idClient = $id;
    }

    public function checkout()
    {
        if ($this->client != null && count($this->products) != 0) {
            $invoice = new Invoice();
            $invoice->client_id = $this->idClient;
            $invoice->user_id = Auth::id();
            $invoice->save();

            foreach ($this->products as $key => $value) {
                $nv = new InvoiceProduct();
                $nv->product_id = $value['id'];
                $nv->qte =  $value['qte'];
                $nv->invoice_id = $invoice->id;

                $nv->save();

                $product = Product::find($value['id']);
                $product->stock = $product->stock - $value['qte'];
                $product->save();
            }

            return redirect()->to('/facture/detail/' . $invoice->id);
        } else {
            $this->dispatchBrowserEvent('failedTask', ['item' => "Ajouter des produits et un client à la facture."]);
        }
    }

    public function mount()
    {
        $this->active = "";
    }


    public function render()
    {
        $this->allProducts = Product::where([[
            'name', 'like', '%' . $this->search . '%'
        ], ['is_deleted', false]])->get();
        $this->allClients = Client::where([
            ['name', 'like', '%' . $this->client . '%'], ['is_deleted', false]
        ])->get();
        return view('livewire.dashboard.new-facture')->layout('layouts.dashboard', ['title' => "Nouvelle facture"]);
    }
}
