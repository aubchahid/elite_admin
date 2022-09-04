<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Facture extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private $invoices;
    public $search;
    public $idFacture;

    public function deleteFacture()
    {
        Invoice::find($this->idFacture)->delete();
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => "La facture a été supprimé avec succès."]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->invoices = Invoice::where('id', 'like', '%' . $this->search . '%')->orWhereHas('client', function (Builder $query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->paginate(10);
        return view('livewire.dashboard.facture', ['invoices' => $this->invoices])->layout('layouts.dashboard', ['title' => "Factures"]);
    }
}
