<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class DetailFacture extends Component
{

    public $idInvoice;

    public $invoice;
    public $client, $products;

    public function mount($id)
    {
        $this->invoice = Invoice::find($id);
        $this->products = $this->invoice->products;
        $this->client = $this->invoice->client;
    }

    public function payer()
    {
        $this->invoice->status = 1;
        $this->invoice->save();
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => "La facture a été payée."]);
    }


    public function render()
    {
        return view('livewire.dashboard.detail-facture')->layout('layouts.dashboard', ['title' => '#' . $this->invoice['id']]);
    }
}
