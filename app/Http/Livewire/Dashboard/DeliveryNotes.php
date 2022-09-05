<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\DeliveryNote;
use Livewire\Component;
use Livewire\WithPagination;

class DeliveryNotes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    private $notes;
    public function render()
    {
        $this->notes = DeliveryNote::where([['id', 'LIKE', '%' . $this->search . '%'], ['is_deleted', false]])->paginate(10);
        return view('livewire.dashboard.delivery-notes', ['notes' => $this->notes])->layout('layouts.dashboard', ['title' => "Bons de livraison"]);
    }
}
