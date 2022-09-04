<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Clients extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $ice, $phoneNo, $address;

    public $ename, $eice, $ephoneNo, $eaddress, $eid;

    private $clients;

    public $search, $idClient;

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'ice' => 'required',
        ]);

        Client::create([
            'name' => $this->name,
            'ice' => $this->ice,
            'phoneNo' => $this->phoneNo,
            'address' => $this->address,
        ]);
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => "Le client a été ajouté avec succès."]);
    }

    public function deleteClient()
    {
        Client::updateOrCreate(['id' => $this->idClient], [
            'is_deleted' => 1,
        ]);
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => "Le client a été supprimé avec succès."]);
    }


    public function setClient($id)
    {
        $client = Client::find($id);
        $this->eid = $client->id;
        $this->ename = $client->name;
        $this->eice = $client->ice;
        $this->ephoneNo = $client->phoneNo;
        $this->eaddress = $client->address;
    }

    public function editClient()
    {
        $this->validate([
            'ename' => 'required',
            'eice' => 'required',
        ]);

        Client::updateOrCreate(['id' => $this->eid], [
            'name' => $this->ename,
            'ice' => $this->eice,
            'phoneNo' => $this->ephoneNo,
            'address' => $this->eaddress,
        ]);
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => "Le client a été modifié avec succès."]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->clients = Client::where([
            ['name', 'like', '%' . $this->search . '%'],
            ['is_deleted', false]
        ])->paginate(10);
        return view('livewire.dashboard.clients', ['clients' => $this->clients])->layout('layouts.dashboard', ['title' => "Clients"]);
    }
}
