@extends('app')

@section('content')
<script>
	let contacts = @json($contacts);
</script>

<div class="inner">

	<!-- Header -->
	<header id="header">
		<span class="logo"><strong>Contatos</strong></span>
	</header>

	<!-- Banner -->
	<section id="banner">
		<div class="content">
			<header style="position: absolute;">
				<h3>Meus contatos</h3>
			</header>
			<ul class="actions" style="justify-content: flex-end;">
				<li><a href="contacts.php"><button class=" button icon solid fa-plus">Novo</button></a></li>
			</ul>
			<div class="table-wrapper">
				<table id="contactsTable" class="table table-bordered">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Empresa</th>
							<th>Cargo</th>
							<th>Telefone</th>
							<th>Opções</th>
						</tr>
					</thead>
					<tbody>
						<!-- Inoformações preenchidas com o rows.add do DataTable -->
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
<script src="{{asset('assets/scripts/contacts.js')}}"></script>

@endsection