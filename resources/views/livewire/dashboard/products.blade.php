<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Produits</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">DMPRO</a></li>
                        <li class="breadcrumb-item active">Produits</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"
                        data-bs-toggle="modal" data-bs-target="#newProduct">Nouveau produit
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
                                <h5 class="card-title">Produits ({{ $products->count() }})</h5>
                                <h6 class="card-subtitle">Tous vos produits sont ici </h6>
                            </div>
                            <div class="form-group col-2">
                                <input type="text" class="form-control form-control-line" wire:model="search"
                                    placeholder="Rechercher">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-1">#</th>
                                        <th class="col-3">Désignation</th>
                                        <th class="col-2">Stock</th>
                                        <th class="col-2">Prix unitaire</th>
                                        <th class="col-2">Promo</th>
                                        <th class="col-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <td>{{ $item->unit_price }} MAD</td>
                                            <td><span class="label label-warning">-{{ $item->promo }} MAD</span></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editProduct"
                                                    wire:click="setProduct({{ $item->id }})"><i
                                                        class="icon-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteProduct"
                                                    wire:click="$set('idProduct',{{ $item->id }})"><i
                                                        class="icon-trash"></i>
                                                </button>
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#rechargeProduct"
                                                    wire:click="$set('idProduct',{{ $item->id }})"><i
                                                        class="icon-refresh"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self id="newProduct" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3 class="card-title font-bold m-t-5 m-b-20">Nouveau produit</h3>
                        <form class="mt-4" wire:submit.prevent="save">
                            <div class="form-group">
                                <label for="text-1" class="form-label">Désignation <span
                                        class="f-s-18">*</span></label>
                                <input type="text" class="form-control" id="text-1" placeholder="Ex : Paper"
                                    wire:model.lazy="name" required>
                            </div>
                            <div class="form-group">
                                <label for="text-2" class="form-label">Prix unitaire <span
                                        class="f-s-18">*</span></label>
                                <input type="text" class="form-control" id="text-2" placeholder="Ex : 3500 MAD"
                                    wire:model.lazy="price" required>
                            </div>
                            <div class="form-group">
                                <label for="text-2" class="form-label">Quantite <span class="f-s-18">*</span></label>
                                <input type="text" class="form-control" id="text-2" placeholder="Ex : 300"
                                    wire:model.lazy="qte" required>
                            </div>
                            <div class="form-group">
                                <label for="text-2" class="form-label">Promo </label>
                                <input type="text" class="form-control" id="text-2" placeholder="Ex : 300"
                                    wire:model.lazy="promo">
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-light me-2"
                                    data-bs-dismiss="modal">Fermer</button>
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
            </div>
        </div>

        <div wire:ignore.self id="editClient" class="modal" tabindex="-1" role="dialog"
            aria-labelledby="vcenter">
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
                                <input type="text" class="form-control" id="text-3"
                                    placeholder="Ex : 0535001152" wire:model.lazy="ephoneNo">
                            </div>
                            <div class="form-group">
                                <label for="text-4" class="form-label">Adresse <span
                                        class="text-small text-muted">(Optionnel)</span></label>
                                <input type="text" class="form-control" id="text-4"
                                    placeholder="Ex : Lotissement Riad Ismailia Anasi, Meknès"
                                    wire:model.lazy="eaddress">
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-light me-2"
                                    data-bs-dismiss="modal">Fermer</button>
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
            </div>
        </div>

        <div wire:ignore.self id="editProduct" class="modal" tabindex="-1" role="dialog"
            aria-labelledby="vcenter">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3 class="card-title font-bold m-t-5 m-b-20">Modifier produit</h3>
                        <form class="mt-4" wire:submit.prevent="edit">
                            <div class="form-group">
                                <label for="text-1" class="form-label">Désignation <span
                                        class="f-s-18">*</span></label>
                                <input type="text" class="form-control" id="text-1" placeholder="Ex : Paper"
                                    wire:model.lazy="ename" required>
                            </div>
                            <div class="form-group">
                                <label for="text-2" class="form-label">Prix unitaire <span
                                        class="f-s-18">*</span></label>
                                <input type="text" class="form-control" id="text-2"
                                    placeholder="Ex : 3500 MAD" wire:model.lazy="eprice" required>
                            </div>
                            <div class="form-group">
                                <label for="text-2" class="form-label">Quantite <span
                                        class="f-s-18">*</span></label>
                                <input type="text" class="form-control" id="text-2" placeholder="Ex : 300"
                                    wire:model.lazy="eqte" required>
                            </div>
                            <div class="form-group">
                                <label for="text-2" class="form-label">Promo </label>
                                <input type="text" class="form-control" id="text-2" placeholder="Ex : 300"
                                    wire:model.lazy="epromo">
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-light me-2"
                                    data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-info text-white">
                                    <span wire:loading.remove wire:target="save" class="text-white font-bold">
                                        Modofier</span>
                                    <span wire:loading wire:target="save" class="text-white font-bold"><i
                                            class="feather-loader"></i>
                                        &nbsp; En cours</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self id="rechargeProduct" class="modal" tabindex="-1" role="dialog"
            aria-labelledby="vcenter">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3 class="card-title font-bold m-t-5 m-b-20">Ajouter au stock</h3>
                        <form class="mt-4" wire:submit.prevent="addingToStock">
                            <div class="form-group">
                                <label for="text-2" class="form-label">Quantite <span
                                        class="f-s-18">*</span></label>
                                <input type="text" class="form-control" id="text-2" placeholder="Ex : 300"
                                    wire:model.lazy="qte" required>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-light me-2"
                                    data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-info text-white">
                                    <span wire:loading.remove wire:target="save" class="text-white font-bold">
                                        Ajouter au stock</span>
                                    <span wire:loading wire:target="save" class="text-white font-bold"><i
                                            class="feather-loader"></i>
                                        &nbsp; En cours</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
