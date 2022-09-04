<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Nouvelle facture</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">DMPRO</a></li>
                        <li class="breadcrumb-item active">Nouvelle Facture</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Remplir la facture </h4>
                        <h6 class="card-subtitle"> Ajoutez votre produit </h6>
                        <form class="mt-4" wire:submit.prevent="addingToInvoice">
                            <div class="alert alert-danger alert-dismissible"> <b>Note :</b>
                                Vous ne pouvez ajouter que des produits qui existent déjà dans votre base de données.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"></span> </button>
                            </div>
                            <div class="form-group">
                                <label for="produit" class="form-label">Client <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="produit"
                                    placeholder="Entrez le nom de client" wire:model="client" autocomplete="off"
                                    {{ $active }} required>
                                @if ($client != null && $active != 'disabled')
                                    <div class="m-t-20">
                                        @foreach ($allClients as $item)
                                            <button type="button" class="btn waves-effect waves-light btn-light"
                                                wire:click="setClient({{ $item->id }},'{{ $item->name }}')">
                                                {{ $item->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="produit" class="form-label">Produit <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="produit"
                                    placeholder="Entrez le nom du produit" wire:model="search" autocomplete="off"
                                    required>
                                @if ($search != null)
                                    <div class="m-t-20">
                                        @foreach ($allProducts as $item)
                                            <button type="button" class="btn waves-effect waves-light btn-light m-b-10"
                                                wire:click="setValue({{ $item->id }},'{{ $item->name }}',{{ $item->stock }})">
                                                {{ $item->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="qte" class="form-label">Quantité <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="qte" placeholder="Ex : 10"
                                    autocomplete="off" wire:model.lazy="qte" required>
                                @if ($stock)
                                    <p class="m-t-10" style="color: red">Il y a {{ $stock }} unités de ce
                                        produit. </p>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary text-white">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Facture ({{ count($products) }} items)</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table product-overview">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Designation</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($products) == 0)
                                        <tr>
                                            <td colspan="6" style="text-center">
                                                <p class="text-center">Ajouter des produits </p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($products as $key => $item)
                                            <tr>
                                                <td>
                                                    {{ $item['id'] }}
                                                </td>
                                                <td>
                                                    {{ $item['name'] }}
                                                </td>
                                                <td>
                                                    {{ $item['price'] . ' MAD' }}
                                                </td>
                                                <td>
                                                    {{ $item['qte'] }}
                                                </td>
                                                <td>
                                                    {{ $item['total'] . ' MAD' }}
                                                </td>
                                                <td style="text-align:center">
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        wire:click="removeFromCart({{ $key }})"><i
                                                            class="icon-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <h5 class="text-left">Total : {{ $total }} MAD</h5>
                            </div>
                            <hr>
                            <button class="btn btn-danger pull-right text-white" wire:click="checkout">
                                Checkout</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
