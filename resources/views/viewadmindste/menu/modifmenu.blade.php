@extends('templatedste._temp')
@section('css')

<!-- Bootstrap Select Css -->
<link href="cssdste/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

@endsection
@section('content')

<div class="container-fluid">
	<div class="block-header">
		@include('flash-message')
		<h2>
			<a style="color:#795548" href="{{ route('dashboard') }}"> Tableau de bord </a> / <a style="color:#795548" href="{{ route('GM')}}"> Menu </a>/ Modification
			<small></small>
		</h2>
	</div>
	<div class="row clearfix">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						Modifier un menu de {{config('app.name')}} 
					</h2>
				</div>
				<div class="body">
					<div class="row">
						
						<form style="padding : 20px" method="post" action="{{ route('SML') }}" >
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<input type="hidden" name="id" value="{{ $info->idMenu }}">
							
							<div class="row clearfix">
                        <div class="col-md-6">
                             	<label for="libelle">Libellé menu</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="libelle" name="lib" value="{{ $info->libelleMenu }}" class="form-control" placeholder="" required>
                                </div>
                                </div>
                        </div>

                        <div class="col-md-6">
                        	<label for="titre">Titre page</label>
                           <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="titre" name="titre"  value="{{ $info->titre_page }}" class="form-control" placeholder="">
                            </div>
                           </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                             	<label for="routes">Route</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="routes" name="rout" value="{{ $info->route }}" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                        	<label for="icone">Icon</label>
                           <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="icone" name="icon" value="{{ $info->iconee }}" class="form-control" placeholder="">
                            </div>
                           </div>
                        </div>
                    </div>
                    
                    <div class="row clearfix">
                        <div class="col-md-6">
                             	<label for="pose">Position</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="pose" name="pos" value="{{ $info->num_ordre }}" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                        	<label for="menn">Menu parent</label>
                           <div class="form-group">
                            <div class="form-line">
                                <select type="text" id="menn" name="parent" class="form-control show-tick" placeholder="">
                                	<option value="{{ $info->Topmenu_id }}">{{ App\Providers\InterfaceServiceProvider::libmenu($info->Topmenu_id) }}</option>
                                        @foreach($list as $par)
                                            @if($par->Topmenu_id == 0)
                                                <option value="{{ $par->idMenu }}">{{ $par->libelleMenu }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                           </div>
                        </div>
                    </div>
							

							<div class="form-group" style="display: block;" >
								<div class="col-sm-12">
									<button type="submit" class="btn  waves-effect" style="float:right; margin-top: 20px; margin-left: 15px; background-color: #795548; color:white; width: 25%;">Mettre à jour
									</button>
								</div>
							</div>
						</form>	
					</div>

				</div>
			</div>
		</div>
		
	</div>
</div>

@endsection

@section("js")
<script>
	$('#flash-overlay-modal').modal();
	$('div.alert').not('.alert-important').delay(6000).fadeOut(350);
</script>
@endsection