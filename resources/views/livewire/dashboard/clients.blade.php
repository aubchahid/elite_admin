<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Clients</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">DMPRO</a></li>
                        <li class="breadcrumb-item active">Clients</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"
                        data-bs-toggle="modal" data-bs-target="#newClient">Ajouter un nouveau
                        client
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-head row justify-content-center align-items-center">
                            <div class="col-10">
                                <h5 class="card-title">Clients ({{ $clients->count() }})</h5>
                                <h6 class="card-subtitle">Tous vos clients sont ici </h6>
                            </div>
                            <div class="form-group col-2">
                                <input type="text" class="form-control form-control-line" wire:model="search"
                                    placeholder="Rechercher">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="example23" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Client</th>
                                        <th>ICE</th>
                                        <th>Numéro de telephone</th>
                                        <th>Adresse</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->ice }}</td>
                                            <td>{{ $item->phoneNo ?? '-' }}</td>
                                            <td>{{ $item->address ?? '-' }}</td>
                                            <td> <button type="button"
                                                    class="btn waves-effect waves-light btn-sm btn-warning"
                                                    data-bs-toggle="modal" data-bs-target="#editClient"
                                                    wire:click="setClient({{ $item->id }})">Modifier</button>
                                                <button type="button"
                                                    class="btn waves-effect waves-light btn-sm btn-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteClient"
                                                    wire:click="$set('idClient',{{ $item->id }})">Supprimer</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $clients->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self id="newClient" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="card-title font-bold m-t-5 m-b-20">Nouveau client</h3>
                    <form class="mt-4" wire:submit.prevent="save">
                        <div class="form-group">
                            <label for="text-1" class="form-label">Nom de client <span class="f-s-18">*</span></label>
                            <input type="text" class="form-control" id="text-1" placeholder="Ex : Maroc Telecom"
                                wire:model.lazy="name" required>
                        </div>
                        <div class="form-group">
                            <label for="text-2" class="form-label">ICE <span class="f-s-18">*</span></label>
                            <input type="text" class="form-control" id="text-2" placeholder="Ex : 182738DJ8282"
                                wire:model.lazy="ice" required>
                        </div>
                        <div class="form-group">
                            <label for="text-3" class="form-label">Numéro de téléphone <span
                                    class="text-small text-muted">(Optionnel)</span></label>
                            <input type="text" class="form-control" id="text-3" placeholder="Ex : 0535001152"
                                wire:model.lazy="phoneNo">
                        </div>
                        <div class="form-group">
                            <label for="text-4" class="form-label">Adresse <span
                                    class="text-small text-muted">(Optionnel)</span></label>
                            <input type="text" class="form-control" id="text-4"
                                placeholder="Ex : Lotissement Riad Ismailia Anasi, Meknès" wire:model.lazy="address">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-info text-white">
                                <span wire:loading.remove wire:target="save" class="text-white font-bold">
                                    Enregistrer</span>
                                <span wire:loading wire:target="save" class="text-white font-bold"><i
                                        class="feather-loader"></i>
                                    &nbsp; En cours</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div wire:ignore.self id="editClient" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="card-title font-bold m-t-5 m-b-20">Modifier le client </h3>
                    <form class="mt-4" wire:submit.prevent="editClient">
                        <div class="form-group">
                            <label for="text-1" class="form-label">Nom de client <span
                                    class="f-s-18">*</span></label>
                            <input type="text" class="form-control" id="text-1"
                                placeholder="Ex : Maroc Telecom" wire:model.lazy="ename" required>
                        </div>
                        <div class="form-group">
                            <label for="text-2" class="form-label">ICE <span class="f-s-18">*</span></label>
                            <input type="text" class="form-control" id="text-2"
                                placeholder="Ex : 182738DJ8282" wire:model.lazy="eice" required>
                        </div>
                        <div class="form-group">
                            <label for="text-3" class="form-label">Numéro de téléphone <span
                                    class="text-small text-muted">(Optionnel)</span></label>
                            <input type="text" class="form-control" id="text-3" placeholder="Ex : 0535001152"
                                wire:model.lazy="ephoneNo">
                        </div>
                        <div class="form-group">
                            <label for="text-4" class="form-label">Adresse <span
                                    class="text-small text-muted">(Optionnel)</span></label>
                            <input type="text" class="form-control" id="text-4"
                                placeholder="Ex : Lotissement Riad Ismailia Anasi, Meknès" wire:model.lazy="eaddress">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-info text-white">
                                <span wire:loading.remove wire:target="save" class="text-white font-bold">
                                    Modifier</span>
                                <span wire:loading wire:target="save" class="text-white font-bold"><i
                                        class="feather-loader"></i>
                                    &nbsp; En cours</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div wire:ignore.self id="deleteClient" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="card-title font-bold m-t-5 m-b-20">Supprimer le client </h3>
                    <h5 class="m-b-40" style="height: 40px">Voulez-vous vraiment supprimer cet utilisateur ? cette
                        action est
                        irréversible
                    </h5>
                    <div class="text-end">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger text-white" wire:click="deleteClient">Oui,
                            supprimez-le </button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
