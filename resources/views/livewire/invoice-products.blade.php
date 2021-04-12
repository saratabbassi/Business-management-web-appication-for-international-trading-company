<div>
    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
        {{ csrf_field() }}
        {{-- 1 --}}

        <div class="row">

            <div class="col">

                <label for="inputName" class="control-label">Dernier numéro de facture</label>
                <input type="text" class="form-control" id="last_invoice_no" name="last_invoice_no"
                    title="Saisir le nom du produit " readonly>
            </div>
            <div class="col">

                <label for="inputName" class="control-label">Numéro de Facture</label>
                <input type="text" class="form-control" id="invoice_no" name="invoice_no"
                    title="Saisir le nom du produit ">
            </div>
            <div class="col">
                <label>Date</label>
                <input class="form-control fc-datepicker" data-date-format="dd-mm-yyyy" name="invoice_Date"
                    placeholder="DD-MM-YYYY" type="text" value="{{ date('d-m-Y') }}">
            </div>


            <div class="col ">


                <label for="inputName" class="control-label">Devise</label>



                <select name="devise" class="form-control select2" onclick="console.log($(this).val())"
                    onchange="console.log('change is firing')">
                    <option label="Choose one">
                    </option>
                    @foreach ($devises as $d)

                        <option value="{{ $d->id }}"> {{ $d->devise }}</option>
                    @endforeach

                </select>



            </div>

            <div class="col">
                <label for="inputName" class="control-label"> <br></label>
                <div class="d-flex justify-content-between">

                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                        data-toggle="modal" href="#modaldemo8">Ajouter Devise</a>

                </div>
            </div>


        </div>

        {{-- 2 --}}
        <br>


        <div class="row">



            <div class="col ">


                <label for="inputName" class="control-label">Client</label>



                <select id="customer" name="customer" class="form-control select2" onclick="console.log($(this).val())"
                    onchange="console.log('change is firing')">
                    <option label="Choose one">
                    </option>
                    @foreach ($customers as $c)

                        <option value="{{ $c->customer_adress }}" adress="{{ $c->customer_adress }}">
                            {{ $c->customer_name }}</option>
                    @endforeach

                </select>




            </div>









            <div class="col">
                <label for="inputName" class="control-label">Adresse du client</label>
                <input type="text" class="form-control" id="invoice_number" name="adress"
                    title="Saisir le nom du produit " readonly>
            </div>
            <div class="col">
                <label for="inputName" class="control-label"> <br></label>
                <div class="d-flex justify-content-between">

                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                        data-toggle="modal" href="#modaldemo6">Ajouter Client</a>

                </div>
            </div>




        </div>

        {{-- 3 --}}
        <br>
        <div class="row">


            <div class="col">
                <label for="inputName" class="control-label">Nom Societé</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                    title="Saisir le nom du produit " value="TINAST SCI">

            </div>
            <div class="col">
                <label for="inputName" class="control-label">Adresse societé</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                    title="Saisir le nom du produit " value="Agareb Sfax 3030">
            </div>
            <div class="col">
                <label for="inputName" class="control-label">Tel</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                    title="Saisir le nom du produit " value="+216 26 566 627">
            </div>


        </div>

        {{-- 4 --}}
        <br>
        <div class="row">
            <div class="col">
                <label for="inputName" class="control-label">Poids brut</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                    title="Saisir le nom du produit ">
            </div>
            <div class="col">
                <label for="inputName" class="control-label">Poids net</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                    title="Saisir le nom du produit ">
            </div>
            <div class="col">
                <label for="inputName" class="control-label">Le nombre de colis</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                    title="Saisir le nom du produit ">
            </div>
            <div class="col">
                <label for="inputName" class="control-label">Livraison</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                    title="Saisir le nom du produit ">
            </div>
            <div class="col ">


                <label for="inputName" class="control-label">Incoterm</label>



                <select class="form-control select2">
                    <option label="Choisir">
                    </option>
                    <option value="  CFR">
                        CFR
                    </option>
                    <option value="BIO">
                        BIO
                    </option>
                    <option value="FOB">
                        FOB
                    </option>
                    <option value="EXW">
                        EXW
                    </option>
                    <option value="CIF">
                        CIF
                    </option>
                </select>



            </div>
            <div class="col">
                <label for="inputName" class="control-label">Détails de paiement</label>
                <input type="text" class="form-control" id="invoice_no" name="invoice_no"
                    title="Saisir le nom du produit " value="">
            </div>
        </div>

        {{-- 5 --}}
        <br>
        <div class="row">
            <div class="col">
                <label for="inputName" class="control-label"><br></label>
                <div class="product-details table-responsive text-nowrap">
                    <h5>Liste Des produits</h5>
                    <br>
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th style="width: 16.66%" scope="col">Catégorie du produit</th>
                            <th style="width: 20%" scope="col">Produit</th>
                            <th style="width: 20%" scope="col">Designation</th>
                            <th style="width: 9%" scope="col">Quantité</th>
                            <th scope="col">Prix unitaire</th>
                            <th scope="col">Prix total</th>
                            <th scope="col"><a class="btn btn-success btn-sm "  wire:click.prevent="addProduct"><i class="fa fa-plus"></a></th>
                        </tr>
                        @foreach ($invoiceProducts as $index => $invoiceProduct)

                            <tr>
                                <td>
                                    <select name="invoiceProducts[{{ $index }}][categorie_id]"
                                        wire:model="invoiceProducts.{{ $index }}.categorie_id"
                                        class="form-control select2">
                                        <option value="">-- choisir categorie --</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">
                                                {{ $categorie->categorie_name }}
                                            </option>
                                        @endforeach


                                    </select>
                                </td>
                                <td> <input type="text" name="invoiceProducts[{{ $index }}][product_id]"
                                        class="form-control"
                                        wire:model="invoiceProducts.{{ $index }}.product_id" /></td>
                                <td> <input type="text" name="invoiceProducts[{{ $index }}][size_id]"
                                        class="form-control"
                                        wire:model="invoiceProducts.{{ $index }}.size_id" /></td>



                                <td>

                                    <input type="number" name="invoiceProducts[{{ $index }}][quantity]"
                                        class="form-control" wire:model="invoiceProducts.{{ $index }}.quantity"
                                        value="{{ $invoiceProduct['quantity'] }}" />
                                </td>
                                <td>
                                    <input type="text" name="invoiceProducts[{{ $index }}][unit_price]"
                                        class="form-control"
                                        wire:model="invoiceProducts.{{ $index }}.unit_price" />
                                </td>
                                <td>

                                    <input type="text" name="invoiceProducts[{{ $index }}][total_price]"
                                        class="form-control"
                                        wire:model="invoiceProducts.{{ $index }}.total_price" readonly />
                                </td>
                                <td> <a href="#" wire:click.prevent="removeProduct({{ $index }})">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                </div>
               
                <br>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>


    </form>

</div>
