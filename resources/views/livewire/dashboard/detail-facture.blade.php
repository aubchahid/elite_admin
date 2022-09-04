<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Facture {{ '#' . $invoice['id'] }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">DMPRO</a></li>
                        <li class="breadcrumb-item">Factures</li>
                        <li class="breadcrumb-item">{{ '#' . $invoice['id'] }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex m-b-30 justify-content-between">
                            <div>
                                <span>
                                    <img src="{{ asset('dist/images/logo-light-icon.png') }}" alt="here-1"
                                        class="dark-logo" />
                                    <!-- Light Logo icon -->
                                    <img src="{{ asset('dist/images/logo-light-text.png') }}" alt="here-2"
                                        class="light-logo" />
                                </span>
                                <h5 class="card-title m-t-30">Sté DMPRO</h5>
                                <h5 class="card-title">Lotissement Riad Al Ismailia Anasi, MEKNES</h5>
                                <h5>GSM: 06 69 54 54 96 </h5>
                            </div>
                            <div class="text-end">
                                <h3 class="card-title">Facture N°{{ $invoice['id'] }}</h3>
                                <h5>{{ $invoice['created_at'] }}</h5>
                                <h3 class="card-title">{{ $client->name }}</h3>
                                <h5>ICE : {{ $client->ice }}</h5>
                                <h5>{{ $client->phoneNo }}</h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Désignation </th>
                                        <th>Qté</th>
                                        <th>PU HT</th>
                                        <th>Montant HT</th>
                                        <th>TVA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->qte }}</td>
                                            <td>{{ number_format($item->product->unit_price, 2, '.', ' ') }} MAD</td>
                                            <td>{{ number_format($item->product->unit_price * $item->qte, 2, '.', ' ') }}
                                                MAD</td>
                                            <td>20%</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="font-500" align="right">Total HTT</td>
                                        <td colspan="2" class="font-500">
                                            {{ number_format($invoice->sumInvoice(), 2, '.', ' ') }} MAD</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="font-500" align="right">Total TTV</td>
                                        <td colspan="2" class="font-500">
                                            {{ number_format($invoice->totalTVA(), 2, '.', ' ') }} MAD</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="font-500" align="right">Total TTC</td>
                                        <td colspan="2" class="font-500">
                                            {{ number_format($invoice->totalTVA() + $invoice->sumInvoice(), 2, '.', ' ') }}
                                            MAD
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="text-end">
                            @if ($invoice->status == 0)
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#payer">Payer cette
                                    facture </button>
                            @endif
                            <a class="btn btn-primary" href="/print/{{ $invoice->id }}">
                                Imprimer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self id="payer" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3 class="card-title font-bold m-t-5 m-b-20">Payer cette facture </h3>
                        <h5 class="m-b-40" style="height: 40px">êtes-vous sûr que cette facture a été payée ? cette
                            action est irréversible
                        </h5>
                        <div class="text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Non</button>
                            <button type="submit" class="btn btn-info text-white" wire:click="payer">Oui</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
