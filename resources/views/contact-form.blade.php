@extends('app')

@section('content')
<div class="inner">
    <!-- Header -->
    <header id="header">
        <span class="logo"><strong>@lang('contacts.contacts')</strong></span>
    </header>



    @if (!isset($contact->contact_id))
    <form method="post" action="{{route('contacts.store')}}">
        @else
        <form method="post" action="{{route('contacts.update', $contact->contact_id)}}">
            @method('put')
            @endif
            @csrf

            <!-- Banner -->
            <section id="banner">
                <div class="content">
                    @include('flash-message');
                    <header style="position: absolute;">
                        <h3>@lang('app.new_contact')</h3>
                    </header>

                    <ul class="actions" style="justify-content: flex-end;">
                        <li><button type="submit" class="button small icon solid fa-save">@lang('app.save')</button></li>
                    </ul>

                    <div class="row gtr-uniform">
                        <div class="col-md-4 col-sm-12">
                            <label for="name">@lang('contacts.name'):</label>
                            <input id="name" name="name" type="text" required placeholder="Nome..."
                                autocomplete="off" />
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="company">@lang('contacts.company'):</label>
                            <input id="company" name="company" type="text" placeholder="Empresa..."
                                autocomplete="off" />
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="role">@lang('contacts.role'):</label>
                            <input id="role" name="role" type="text" placeholder="Cargo..." autocomplete="off" />
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <header style="position: absolute;">
                    <h5>@lang('phones.phones')</h5>
                </header>
                <ul id="phoneActions" class="actions" style="justify-content: flex-end;">
                    <li><button type="button" class="button small" onclick="addPhone()"><span
                                class="icon solid fa-plus"></span></li>
                </ul>
                <div id="phonesDiv" class="row gtr-uniform">
                    <div id="phoneDiv0" class="col-md-4 col-sm-12">
                        <label for="phoneLabel0">@lang('phones.phone'):</label>
                        <div class="input-group mb-3">
                            <select name="phones[0][type]" class="col-5 custom-select" id="phoneSelect0">
                                <option value="celular" selected>@lang('phones.cellphone')</option>
                                <option value="residencial">@lang('phones.home')</option>
                            </select>
                            <div class="col-7 input-group-append no-padding">
                                <input name="phones[0][phone]" type="text" onkeyup="phoneMask(0)" id="phoneInput0"
                                    required placeholder="Telefone..." autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <header style="position: absolute;">
                    <h5>@lang('addresses.addresses')</h5>
                </header>
                <ul id="addressActions" class="actions" style="justify-content: flex-end;">
                    <li><button type="button" class="button small" onclick="addAddress()"><span
                                class="icon solid fa-plus"></span>
                    </li>
                </ul>
                <div id="addressesDiv">
                    <div id="addressDiv0">
                        <div class="row gtr-uniform">
                            <div class="col-md-3 col-sm-12">
                                <label for="zipCode0">@lang('addresses.zip_code'):</label>
                                <div class="input-group mb-3" style="align-items: center;">
                                    <input type="text" name="addresses[0][zip_code]" id="zipCode0" class="form-control"
                                        placeholder="CEP..." aria-label="Recipient's username"
                                        aria-describedby="basic-addon2" onkeyup="zipCodeMask(0)" autocomplete="off">
                                    <div class="input-group-append">
                                        <button id="zipButton0" class="button search btn btn-outline-secondary"
                                            onclick="getCep(0)" type="button"><span
                                                class=" icon solid fa-search"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gtr-uniform">
                            <div class="col-md-6 col-sm-12">
                                <label for="street0">@lang('addresses.street'):</label>
                                <input type="text" name="addresses[0][street]" id="street0" required
                                    placeholder="Logradouro..." autocomplete="off" />
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="number0">@lang('addresses.number'):</label>
                                <input type="text" name="addresses[0][number]" id="number0" required
                                    placeholder="Número..." autocomplete="off" />
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="neighborhood0">@lang('addresses.neighborhood'):</label>
                                <input type="text" name="addresses[0][neighborhood]" id="neighborhood0" required
                                    placeholder="Bairro..." autocomplete="off" />
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="complement0">@lang('addresses.complement'):</label>
                                <input type="text" name="addresses[0][complement]" id="complement0"
                                    placeholder="Complemento..." autocomplete="off" />
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="city0">@lang('addresses.city'):</label>
                                <input type="text" name="addresses[0][city]" id="city0" required placeholder="Cidade..."
                                    autocomplete="off" />
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="state0">@lang('addresses.state'):</label>
                                <input type="text" name="addresses[0][state]" id="state0" required
                                    placeholder="Estado..." autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
</div>
@if (isset($contact))
<script>
    let contact = @json($contact);
</script>
@endif
<script src="{{asset('assets/scripts/register.js')}}"></script>
@endsection
