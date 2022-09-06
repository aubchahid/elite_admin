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

    public $delivery, $invoices;

    protected $invoicesNotPaid, $invoicesPaid;

    public $search;

    protected $allInvoices;

    public function render()
    {
        $this->delivery = DeliveryNote::get();
        $this->invoices = Invoice::get();
        $this->invoicesNotPaid = Invoice::totalNotPaid(Invoice::where('status', 0)->get());
        $this->invoicesPaid = Invoice::totalNotPaid(Invoice::where('status', 1)->get());
        $this->allInvoices = Invoice::where('id', 'like', '%' . $this->search . '%')->orWhereHas('client', function (Builder $query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->paginate(10);
        return view('livewire.dashboard.main', ['allInvoices' => $this->allInvoices, 'invoicesNotPaid' => $this->invoicesNotPaid, 'invoicesPaid' => $this->invoicesPaid])->layout('layouts.dashboard', ['title' => "Page d'accueil"]);
    }
}
