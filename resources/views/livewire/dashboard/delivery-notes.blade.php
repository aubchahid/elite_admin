<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Bons de livraison</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">DMPRO</a></li>
                        <li class="breadcrumb-item active">Bons de livraison</li>
                    </ol>
                    <a type="button" href="/new-delivary"
                        class="btn btn-info d-none d-lg-block m-l-15 text-white">Nouvelle Bons
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-head row justify-content-center align-items-center">
                            <h5 class="card-title col-10">Bons de livraison ({{ $notes->count() }})</h5>
                            <div class="form-group col-2">
                                <input type="text" class="form-control form-control-line" placeholder="Rechercher"
                                    wire:model="search">
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Qté commandée</th>
                                        <th>Qté livrée</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notes as $item)
                                        <tr>
                                            <td class="align-middle">{{ $item->id }}</td>
                                            <td class="align-middle">{{ $item->client->name }}</td>
                                            <td class="align-middle">{{ $item->qteCommande() }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $notes->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div wire:ignore.self id="deleteFacture" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="card-title font-bold m-t-5 m-b-20">Supprimer cette facture </h3>
                    <h5 class="m-b-40" style="height: 40px">Voulez-vous vraiment supprimer cette facture ? cette
                        action est
                        irréversible
                    </h5>
                    <div class="text-end">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger text-white" wire:click="deleteFacture">Oui,
                            supprimez-le </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
