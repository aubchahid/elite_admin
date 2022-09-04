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
                        <li class="breadcrumb-item active">Factures</li>
                    </ol>
                    <a type="button" href="/new-factures"
                        class="btn btn-info d-none d-lg-block m-l-15 text-white">Nouvelle facture
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-head row justify-content-center align-items-center">
                            <h5 class="card-title col-10">Factures ({{ $invoices->count() }})</h5>
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
                                        <th>Client</th>
                                        <th>Numéro de commande </th>
                                        <th>Prix ​​total </th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $item)
                                        <tr>
                                            <td class="align-middle">{{ $item->client->name }}</td>
                                            <td class="align-middle"> <a href="/detail-facture/{{ $item->id }}">
                                                    {{ '#' . $item->id }}</a></td>
                                            <td class="align-middle">{{ $item->sumInvoice() }} DHS</td>
                                            <td class="align-middle">{{ $item->created_at }}</td>
                                            <td class="align-middle">
                                                <span
                                                    class="label label-{{ $item->status ? 'success' : 'warning' }}">{{ $item->status ? 'Payé' : 'Non-Payé' }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a type="button" class="btn btn-warning"
                                                    href="/print/{{ $item->id }}"><i class="icon-printer"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteFacture"
                                                    wire:click="$set('idFacture',{{ $item->id }})"><i
                                                        class="icon-trash"></i>
                                                </button>
                                                <a href="/facture/detail/{{ $item->id }}" class="btn btn-info">
                                                    <i class="icon-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $invoices->links() }}
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
