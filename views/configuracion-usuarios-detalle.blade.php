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

Detalle de usuario {{ $data["fullname"]??'' }}

@endsection

@section('content')
<form action="/usuarios" method="POST">
<div class="row">
	<div class="col-12">

		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Detalle de usuario</h3>
			</div>
			<div class="card-body">

				<div class="card-body table-responsive">					
					<div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <strong>Nombre completo:</strong> {{ $data["fullname"]??'' }}
                        </div>
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <strong>Username:</strong> {{ $data["username"]??'' }}
                        </div>
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <strong>Email:</strong> {{ $data["email"]??'' }}
                        </div>
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <strong>Celular:</strong> {{ $data["celular"]??'' }}
                        </div>
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <strong>DNI:</strong> {{ $data["dni"]??'' }}
                        </div>                       
                    </div>                    
				</div>
			</div>
			<div class="card-header rounded-0">
				<h3 class="card-title">Permisos</h3>
			</div>
			<div class="card-body">

				<div class="card-body table-responsive">					
					<div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <select name="permission" id="permissions" class="form-control">
                                <option value="">-Seleccione una opción-</option>
                            </select>
                        </div>               
                    </div>                    
				</div>
			</div>
			<div class="card-header rounded-0">
				<h3 class="card-title">Two Factor Authentication (2FA)</h3>
			</div>
			<div class="card-body">

				<div class="card-body table-responsive">					
					<div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <select name="auth-disabled" id="auth-disabled" class="form-control">
                                <option value="">-Seleccione una opción-</option>
                                <option value="true" {{ $data["auth-disabled"] == true ? 'selected' : '' }}>Habilitado</option>
                                <option value="false" {{ $data["auth-disabled"] == false ? 'selected' : '' }}>Deshabilitado</option>
                            </select>
                            <input type="hidden" name="id" value="{{ $data["dni"]??'' }}">
                            <input type="hidden" name="type" value="edit">
                        </div>               
                    </div>                    
				</div>
			</div>
            <hr class="m-0"/>
            <div class="card-body d-flex gap-2">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="/usuarios" class="btn btn-danger">Cancelar</a>
            </div>
		</div>

	</div>
</div>
</form>
@endsection

@section('scripts')
<script src="public/plugins/LibDataTables/datatables.min.js"></script>
<script src="public/plugins/LibDataTables/DataTables-1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="public/plugins/LibDataTables/Responsive-2.5.0/js/responsive.bootstrap4.min.js"></script>
<script src="public/plugins/LibDataTables/Buttons-2.4.2/js/buttons.bootstrap4.min.js"></script>
<script src="public/plugins/LibDataTables/JSZip-3.10.1/jszip.min.js"></script>
<script src="public/plugins/LibDataTables/Buttons-2.4.2/js/buttons.html5.min.js"></script>
<script src="public/plugins/LibDataTables/Buttons-2.4.2/js/buttons.colVis.min.js"></script>
@endsection