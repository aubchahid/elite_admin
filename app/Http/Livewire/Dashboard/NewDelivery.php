<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Client;
use App\Models\DeliveryNote;
use App\Models\DeliveryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewDelivery extends Component
{
    public $products = array();

    public $search, $allProducts, $allClients, $client, $active, $stock, $total;

    public $qteC, $qteL;
    public function addingToInvoice()
    {
        $this->validate([
            "search" => "required",
            "qteL" => "required",
            "qteC" => "required",
            "name" => "required",
            "nameClient" => "required"
        ]);

        $pr = Product::find($this->idProduct);

        if ($this->qteL <= $pr->stock && $this->qteC <= $pr->stock) {
            $toCart = [
                "id" => $pr['id'],
                "name" => $pr['name'],
                "qteC" => $this->qteC,
                "qteL" => $this->qteL,
            ];
            array_push($this->products, $toCart);
            $this->active = "disabled";
            $this->search = $this->qteL = $this->qteC = "";
            $this->stock = '';
        } else {
            $this->dispatchBrowserEvent('failedTask', ['item' => "Ajouter des produits et un client à la facture."]);
        }
    }


    public function removeFromCart($id)
    {

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
            $invoice = new DeliveryNote();
            $invoice->client_id = $this->idClient;
            $invoice->user_id = Auth::id();
            $invoice->save();

            foreach ($this->products as $key => $value) {
                $nv = new DeliveryProduct();
                $nv->product_id = $value['id'];
                $nv->qte = $value['qteC'];
                $nv->qteL =  $value['qteL'];
                $nv->delivery_notes_id = $invoice->id;

                $nv->save();
            }

            //return redirect()->to('/facture/detail/' . $invoice->id);
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
        return view('livewire.dashboard.new-delivery')->layout('layouts.dashboard', ['title' => "Nouvelle Bons de livraison"]);
    }
}
