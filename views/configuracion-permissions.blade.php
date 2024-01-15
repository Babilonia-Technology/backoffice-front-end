@extends('Layout.master')

@section('styles')
<link rel="stylesheet" href="public/plugins/LibDataTables/DataTables-1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="public/plugins/LibDataTables/Responsive-2.5.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="public/plugins/LibDataTables/Buttons-2.4.2/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="public/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="@asset("css/jquery.nestable.css")">
<style>
.socialite { display: block; float: left; height: 35px; }
.gap-1{gap: 0.5rem}
.gap-2{gap: 1rem}
.gap-3{gap: 1.5rem}
</style>
@endsection

@section('page')

Administración de permisos

@endsection

@section('content')
<div class="row">
	<div class="col-12">

		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Administración de permisos</h3>
			</div>
			<div class="card-body">
                <div class="card-body table-responsive">					
                    <div class="row mb-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a href="/permisos/new/permiso" class="btn btn-primary">Nuevo</a>
                        </div>
                    </div>
					<table class="display table table-striped nowrap compact responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Permiso</th>								
								<th width="100">acciones</th>
							</tr>
						</thead>
						@foreach ($data as $key => $item)
							<tr>
								<td>{{ $item["name"] ?? '' }}</td>																
								<td>
									<div class="dropdown">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
											Acciones
										</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="/permisos/{{ $key }}/permiso"><i class="fas fa-edit"></i>&nbsp;&nbsp;Editar</a>
											<form action="/permisos" method="POST">
												<input type="hidden" name="type" value="delete" />
												<input type="hidden" name="id" value="{{ $key }}">
												<button class="dropdown-item" type="submit"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Eliminar</button>
											</form>
										</div>
									</div>
								</td>
							</tr>
						@endforeach
					</table>
				</div>

			</div>

		</div>

	</div>
</div>

@endsection

@section('scripts')
<script src="public/plugins/LibDataTables/datatables.min.js"></script>
<script src="public/plugins/LibDataTables/DataTables-1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="public/plugins/LibDataTables/Responsive-2.5.0/js/responsive.bootstrap4.min.js"></script>
<script src="public/plugins/LibDataTables/Buttons-2.4.2/js/buttons.bootstrap4.min.js"></script>
<script src="public/plugins/LibDataTables/JSZip-3.10.1/jszip.min.js"></script>
<script src="public/plugins/LibDataTables/Buttons-2.4.2/js/buttons.html5.min.js"></script>
<script src="public/plugins/LibDataTables/Buttons-2.4.2/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="public/plugins/select2/js/select2.full.min.js"></script>
<script>
	$(document).ready( function () {
		$('.table').DataTable();
	} );
</script>
@endsection