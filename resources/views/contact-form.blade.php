@extends('app')

@section('content')
<div class="inner">
    <!-- Header -->
    <header id="header">
        <span class="logo"><strong>Contatos</strong></span>
    </header>

    <form method="post" action="{{route('store-contact')}}">
        @csrf
        <!-- Banner -->
        <section id="banner">
            <div class="content">
                <header style="position: absolute;">
                    <h3>Novo contato</h3>
                </header>
                <ul class="actions" style="justify-content: flex-end;">
                    <li><button type="submit" class="button small icon solid fa-save">salvar</button></li>
                </ul>

                <div class="row gtr-uniform">
                    <div class="col-md-4 col-sm-12">
                        <label for="name">Nome:</label>
                        <input type="text" placeholder="Nome..." autocomplete="false" />
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="company">Empresa:</label>
                        <input type="text" placeholder="Empresa..." />
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="role">Cargo:</label>
                        <input type="text" placeholder="Cargo..." />
                    </div>
                </div>

            </div>
        </section>

        <section>
            <header style="position: absolute;">
                <h5>Telefones</h5>
            </header>
            <ul id="phoneActions" class="actions" style="justify-content: flex-end;">
                <li><button class="button small"><span class="icon solid fa-plus"></span></li>
            </ul>
            <div id="phonesDiv" class="row gtr-uniform">
                <div id="phoneDiv0" class="col-md-4 col-sm-12">
                    <label for="phoneLabel0">Telefone:</label>
                    <div class="input-group mb-3">
                        <select class="col-5 custom-select" id="phoneSelect0">
                            <option value="celular" selected>Celular</option>
                            <option value="residencial">Residencial</option>
                        </select>
                        <div class="col-7 input-group-append no-padding">
                            <input type="text" id="phoneInput0" placeholder="Telefone..." autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <header style="position: absolute;">
                <h5>Endereços</h5>
            </header>
            <ul id="addressActions" class="actions" style="justify-content: flex-end;">
                <li><button type="button" class="button small"><span class="icon solid fa-plus"></span>
                </li>
            </ul>
            <div id="addressesDiv">
                <div id="addressDiv0">
                    <div class="row gtr-uniform">
                        <div class="col-md-3 col-sm-12">
                            <label for="zipCode0">CEP:</label>
                            <div class="input-group mb-3" style="align-items: center;">
                                <input type="text" id="zipCode0" class="form-control" placeholder="CEP..."
                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                    autocomplete="off">
                                <div class="input-group-append">
                                    <button id="zipButton0" class="button search btn btn-outline-secondary"
                                        type="button"><span class=" icon solid fa-search"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gtr-uniform">
                        <div class="col-md-6 col-sm-12">
                            <label for="street0">Logradouro:</label>
                            <input type="text" id="street0" placeholder="Logradouro..." autocomplete="off" />
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="number0">Número:</label>
                            <input type="text" id="number0" placeholder="Número..." autocomplete="off" />
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="neighborhood0">Bairro:</label>
                            <input type="text" id="neighborhood0" placeholder="Bairro..." autocomplete="off" />
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="complement0">Complemento:</label>
                            <input type="text" id="complement0" placeholder="Complemento..." autocomplete="off" />
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="city0">Cidade:</label>
                            <input type="text" id="city0" placeholder="Cidade..." autocomplete="off" />
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="state0">Estado:</label>
                            <input type="text" id="state0" placeholder="Estado..." autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
@endsection