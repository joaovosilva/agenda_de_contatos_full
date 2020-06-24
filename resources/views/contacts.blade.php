@extends('app')

@section('content')
<script>
    let contacts = @json($contacts ?? []);
</script>

<div class="inner">

    <!-- Header -->
    <header id="header">
        <span class="logo"><strong>@lang('contacts.contacts')</strong></span>
    </header>

    <!-- Banner -->
    <section id="banner">
        <div class="content">
            <header style="position: absolute;">
                <h3>@lang('app.my_contacts')</h3>
            </header>
            <ul class="actions" style="justify-content: flex-end;">
                <li><a href="{{route('contacts.create')}}"><button class="button icon solid fa-plus">@lang('app.new')</button></a>
                </li>
            </ul>
            @include('flash-message');
            <div class="table-wrapper">
                <table id="contactsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('contacts.name')</th>
                            <th>@lang('contacts.company')</th>
                            <th>@lang('contacts.role')</th>
                            <th>@lang('phones.phone')</th>
                            <th>@lang('app.options')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Inoformações preenchidas com o rows.add do DataTable -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div id="contact_modal" class="mar-top pad-top">

    </div>
</div>
<script src="{{asset('assets/scripts/contacts.js')}}"></script>

@endsection
