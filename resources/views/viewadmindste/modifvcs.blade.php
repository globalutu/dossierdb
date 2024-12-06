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
		<a href="{{ route('dashboard') }}"> Tableau de bord </a> / Modification
			<small></small>
		</h2>
	</div>
	<div class="row clearfix">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						Modification
					</h2>
				</div>
				<div class="body">
					<div class="row">
						
						<form style="padding : 20px" method="post" action="{{ route('SUDOS') }}" >
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<input type="hidden" name="id" value="{{ $info->id }}" />
                            <div class="row clearfix">
                                <div class="col-md-12">
                                        <label for="denom">Dénomination</label>
                                        <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" disabled id="denom" value="{{ $info->denomination }}" name="denom" class="form-control" placeholder="" required>
                                        </div>
                                        </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="nom">Nom</label>
                                   <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nom" name="nom" value="{{ $info->nom }}" class="form-control" required placeholder="">
                                    </div>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                        <label for="prenom">Prénoms</label>
                                        <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="prenom" value="{{ $info->prenom }}" name="prenom" class="form-control" required placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">

                                <div class="col-md-6">
                                    <label for="objet">Objet</label>
                                   <div class="form-group">
                                    <div class="form-line">
                                        <textarea type="text" id="objet" name="objet" class="form-control" required placeholder="">{{ $info->objet }}</textarea>
                                    </div>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                        <label for="montant">Montant </label>
                                        <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="montant" name="montant" value="{{ $info->montant }}" required class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                        <label for="datedebut">Date début</label>
                                        <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" id="datedebut" name="datedebut" value="{{ $info->datedebut }}" class="form-control" required placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="datefin">Date fin</label>
                                   <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" id="datefin" name="datefin" value="{{ $info->datefin }}" class="form-control" placeholder="">
                                    </div>
                                   </div>
                                </div>
                            </div>
                            
							
                    </div>
                    		<div class="form-group" style="display: block;" >
								<div class="col-sm-12">
									<button type="submit" class="btn waves-effect" style="float:right; background-color: #795548; color: white; margin-top: 20px; margin-left: 15px; width: 25%;">Mettre à jour
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