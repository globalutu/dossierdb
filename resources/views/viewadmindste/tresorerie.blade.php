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
		<a href="{{ route('dashboard') }}"> Tableau de bord </a> / Trésorerie
			<small></small>
		</h2>
	</div>
	<div class="row clearfix">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header"> 
					<h2>
						Caisse
                        <button type="button" style="margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px; background-color: #795548; color: white" class="btn  waves-effect" data-color="deep-orange" data-toggle="modal" data-target="#add">Ajouter</button>
					</h2>
				</div>
				<div class="body">
					<div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                    <thead>
                                        
                                    <tr>
                                        <th>Date</th>
                                        <th data-priority="1">Libellé</th>
                                        <th data-priority="1">Entrée</th>
                                        <th data-priority="1">Sortir</th>
                                        <th data-priority="1">Solde</th>
                                        <th data-priority="6">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $nbr = count($list);
                                            $i = 1;
                                        @endphp
                                        @forelse($list as $serv)
                                        <tr>
                                            <th><span class="co-name">{{$serv->date}}</span></th>
                                            <td>{{$serv->libelle}}</td>
                                            <td>{{number_format($serv->entre, 0, '.', ' ')}}</td>
                                            <td> {{number_format( $serv->restant, 0, '.', ' ') }} </td>
                                            <td>
                                            
                                            @if($i == $nbr)
                                                @if(in_array("delete_vc", session("auto_action")))
                                                <button type="button" onclick="getdeleterct('{{ $serv->libelle}}', '{{ $serv->id}}')" data-toggle="modal" data-target="#delete" title="Supprimer"  class="btn btn-danger btn-circle btn-xs  margin-bottom-10 waves-effect waves-light"><i class="material-icons">delete_sweep</i> </button>
                                                @endif
                                            @else
                                                @if(in_array("delete_vc", session("auto_action")))
                                                <button type="button" title="Impossible de supprimer"  class="btn btn-default btn-circle btn-xs  margin-bottom-10 waves-effect waves-light"><i class="material-icons">delete_sweep</i> </button>
                                                @endif
                                            @endif

                                            @php $i++; @endphp
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9"><center>Pas de solde dans la trésorerie de ce dossier enregistrer!!!</center> </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{$list->links()}}
                            </div> 
                            
				</div>
			</div>
		</div>
		
	</div>
</div>

@endsection

@section("model")

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">AJOUTER : </h4>
            </div>
            <form method="post" action="{{ route('STDV') }}">
            <div class="modal-body">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id" value="{{ $info->id }}" />
                    <input type="hidden" id="trestant" name="trestant" />
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <label for="lib">Libellé</label>
                           <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="lib" name="lib"  required class="form-control" placeholder="">
                            </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                            <label for="date">Date</label>
                           <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="date" name="date"  required class="form-control" placeholder="">
                            </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                            <label for="op">Type d'opération</label>
                            <div class="form-group">
                            <div class="form-line">
                                <select type="text" id="op" name="op"  required class="form-control" placeholder="">
                                    <option id="1">Entré</option>
                                    <option id="2">Sortir</option>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="montant">Montant</label>
                           <div class="form-group">
                            <div class="form-line">
                                <input type="number" id="montant" name="montant"  required class="form-control" placeholder="">
                            </div>
                           </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">FERMER</button>
                <button type="submit" style="background-color: #795548; color: white" class="btn  waves-effect">AJOUTER</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Suppression d'une ligne : </h4>
            </div>
            <div class="modal-body">
                
                    <div class="row clearfix">
                        <input type="hidden" id="code_d" name="code_d" class="form-control" placeholder="">
                        <label id="infodelete"></label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">FERMER</button>
                <button onclick="validedelete()" id="modif" class="btn bg-deep-orange waves-effect">SUPPRIMER</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    async function getdeleterct(nom, id){
            document.getElementById('infodelete').innerHTML = "Vous voulez vraiment supprimer le payement <i style='color:#0F056B'> "+nom+" </i> ?";
            document.getElementById('code_d').value = id;
        }

    async function validedelete(){
                token = document.getElementById("_token").value;
                iddelete = document.getElementById("code_d").value;
                    
                dat = {_token: token, id: iddelete,};

                    document.getElementById("infodelete").innerHTML = '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';
                    
                    // En cours d'envoie
                        try {
                            let response = await fetch("{{route('DTDV')}}",
                            {
                                method: 'POST',
                                headers: {
                                                'Access-Control-Allow-Credentials': true,
                                                'Content-Type': 'application/json',
                                                'Accept': 'application/json',
                                            },
                                body: JSON.stringify(dat)
                            });
                            if(response.status == 200)
                            {
                                data = await response.text();
                                document.getElementById("infodelete").innerHTML = '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>'+data+'</strong></div>';
                                setTimeout(function(){
                                        window.location.reload();
                                    }, 3000);
                            }
                            else{
                                document.getElementById("infodelete").innerHTML = '<div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">×</button><strong>Une erreur s\'est produite </strong></div>';
                            }
                        } catch (error) {
                            document.getElementById("infodelete").innerHTML = error;
                        } 
        }
</script>

@endsection

@section("js")
<script>
</script>
@endsection