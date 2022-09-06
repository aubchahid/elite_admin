<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Page d'accueil</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">DMPRO</a></li>
                        <li class="breadcrumb-item active">Page d'accueil</li>
                    </ol>
                    <a type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" href="/new-factures">
                        Créer une nouvelle
                        facture
                    </a>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Factures</h4>
                        <div class="text-end">
                            <h3 class="font-light">{{ $invoices->count() }} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Factures Payées</h4>
                        <div class="text-end">
                            <h3 class="font-light">{{ $invoicesPaid }} DHS</h3>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Factures Impayées</h4>
                        <div class="text-end">
                            <h3 class="font-light">{{ $invoicesNotPaid }} DHS </h3>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-head row justify-content-center align-items-center">
                            <h5 class="card-title col-10">Dernières factures </h5>
                            <div class="form-group col-2">
                                <input type="text" class="form-control form-control-line" placeholder="Rechercher"
                                    wire:model="search">
                            </div>
                        </div>
                        <div class="table-responsive m-t-30">
                            <table class="table product-overview">
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
                                    @foreach ($allInvoices as $item)
                                        <tr>
                                            <td class="align-middle">{{ $item->client->name }}</td>
                                            <td class="align-middle">{{ '#' . $item->id }}</td>
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

                                                <a href="/facture/detail/{{ $item->id }}" class="btn btn-info">
                                                    <i class="icon-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $allInvoices->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
