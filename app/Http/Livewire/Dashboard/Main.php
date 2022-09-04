<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\DeliveryNote;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $delivery, $invoices, $invoicesPaid, $invoicesNotPaid;

    public $search;

    protected $allInvoices;

    public function render()
    {
        $this->delivery = DeliveryNote::get();
        $this->invoices = Invoice::get();
        $this->invoicesNotPaid = Invoice::where('status', 0)->get();
        $this->allInvoices = Invoice::where('id', 'like', '%' . $this->search . '%')->orWhereHas('client', function (Builder $query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->paginate(10);
        return view('livewire.dashboard.main', ['allInvoices' => $this->allInvoices])->layout('layouts.dashboard', ['title' => "Page d'accueil"]);
    }
}
