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
		<a href="{{ route('dashboard') }}"> Tableau de bord </a> / Rencontre : {{ $info->nom }} {{ $info->prenom }}
			<small></small>
		</h2>
	</div>
	<div class="row clearfix">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						Rencontre 
                        <button type="button" style="margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px; background-color: #795548; color: white" class="btn  waves-effect" data-color="deep-orange" data-toggle="modal" data-target="#add">Ajouter</button>
					</h2>
				</div>
				<div class="body">
					<div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                    <thead>

                                    <tr>
                                        <th>Date</th>
                                        <th data-priority="1">Commentaire</th>
                                        <th data-priority="1">Nom, prenom et titre Client</th>
                                        <th data-priority="1">Structure</th>
                                        <th data-priority="1">Résultat</th>
                                        <th data-priority="6">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($list as $serv)
                                        <tr>
                                            <th><span class="co-name">{{ date("d-m-Y à h:i", strtotime($serv->date)) }}</span></th>
                                            <td>{{$serv->commentaire}}</td>
                                            <td>{{$serv->nom}}</td>
                                            <td>{{$serv->structure}}</td>
                                            <td>{{$serv->resultat}}</td>
                                            <td>
                                            @if(in_array("update_vc", session("auto_action")))
                                            <button type="button" title="Modifier"  class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light" onclick="getupdaterct('{{ $serv->nom}}', '{{ $serv->resultat}}', {{ $serv->id}}, '{{ $serv->commentaire}}', '{{ $serv->date}}', '{{ $serv->structure}}',)" data-toggle="modal" data-target="#update">
                                               <i class="material-icons">system_update_alt</i>
                                                
                                            </button>
                                            @endif

                                            @if(in_array("delete_vc", session("auto_action")))
                                            <button type="button" onclick="getdeleterct('{{ $serv->nom}}', '{{ $serv->id}}')" data-toggle="modal" data-target="#delete" title="Supprimer"  class="btn btn-danger btn-circle btn-xs  margin-bottom-10 waves-effect waves-light"><i class="material-icons">delete_sweep</i> </button>
                                            @endif

                                            
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9"><center>Pas de rencontre enregistrer!!!</center> </td>
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
            <form method="post" action="{{ route('SRDV') }}">
            <div class="modal-body">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id" value="{{ $info->id }}" />
                    <input type="hidden" name="idrct" value="0" />
                    
                    <div class="row clearfix">

                        <div class="col-md-12">
                            <label for="commentaire">Commentaire</label>
                           <div class="form-group">
                            <div class="form-line">
                                <textarea type="text" id="commentaire" name="commentaire" class="form-control" required placeholder=""></textarea>
                            </div>
                           </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                                <label for="nom">Titre client </label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nom" name="nom"  required class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                                <label for="structure">Structure </label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="structure" name="structure"  required class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <label for="resultat">Résultat </label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="resultat" name="resultat"  required class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <label for="daterdv">Date de la rencontre </label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="datetime-local" id="daterdv" name="daterdv"  required class="form-control" placeholder="">
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

<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">MODIFIER : </h4>
            </div>
            <div class="modal-body">
                <label id="infoupdate"></label>
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" id="iddossier" name="iddossier" value="{{ $info->id }}" />
                    <input type="hidden" name="idupdate" id="idupdate" />
                    <div class="row clearfix">

                        <div class="col-md-12">
                            <label for="commentaire_u">Commentaire</label>
                           <div class="form-group">
                            <div class="form-line">
                                <textarea type="text" id="commentaire_u" name="commentaire_u" class="form-control" required placeholder=""></textarea>
                            </div>
                           </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                                <label for="nom_u">Titre client </label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nom_u" name="nom_u"  required class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                                <label for="structure_u">Structure </label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="structure_u" name="structure_u"  required class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <label for="resultat_u">Résultat </label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="resultat_u" name="resultat_u"  required class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <label for="daterdv_u">Date de la rencontre </label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="datetime-local" id="daterdv_u" name="daterdv_u"  required class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">FERMER</button>
                <button onclick="valideupdate()" style="background-color: #795548; color: white" class="btn  waves-effect">MODIFIER</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    async function getdeleterct(nom, id){
            document.getElementById('infodelete').innerHTML = "Vous voulez vraiment supprimer la rencontre effectuer avec <i style='color:#0F056B'> "+nom+" "+" </i> ?";
            document.getElementById('code_d').value = id;
        }

    async function validedelete(){
                token = document.getElementById("_token").value;
                iddelete = document.getElementById("code_d").value;
                    
                dat = {_token: token, id: iddelete,};

                    document.getElementById("infodelete").innerHTML = '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';
                    
                    // En cours d'envoie
                        try {
                            let response = await fetch("{{route('DRCT')}}",
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

    function getupdaterct(nom, resultat, id, commentaire, date, structure){
        console.log(nom);
            
        document.getElementById('infoupdate').innerHTML = "Vous voulez vraiment modifier les informations de la rencontre effectuer avec  <i style='color:#0F056B'> "+nom+" </i> ? <br>";

            document.getElementById('idupdate').value = id;
            document.getElementById('commentaire_u').value = commentaire;
            document.getElementById('nom_u').value = nom;
            document.getElementById('resultat_u').value = resultat;
            document.getElementById('structure_u').value = structure;
            document.getElementById("daterdv_u").value = date;
    }

    async function valideupdate(){
                // récupération des données du formulaire 
                token = document.getElementById("_token").value; // token 
                date = document.getElementById("daterdv_u").value; // date 
                structure = document.getElementById("structure_u").value; // structure
                resultat = document.getElementById("resultat_u").value; // resultat
                nom = document.getElementById("nom_u").value; // nom
                commentaire = document.getElementById("commentaire_u").value; // commentaire
                id = document.getElementById("idupdate").value; // id de modification
                
            
                if(token == "" || date == "" || resultat == "" || structure == "" || nom == "" || commentaire == ""){
                    error = "";
                    if(token == "")
                        error += ". Veuillez vous reconnecter pour continuer <br>";
                    if(date == "")
                        error += ". Le champ date ne peut pas être vide <br>";
                    if(structure == "")
                        error += ". Le champ Structure ne peut pas être vide <br>";
                    if(resultat == "")
                        error += ". Le champ Résultat ne peut pas être vide <br>";
                    if(nom == "")
                        error += ". Le champ nom ne peut pas être vide <br>";
                    if(commentaire == "")
                        error += ". Le champ commentaire ne peut pas être vide <br>";

                    document.getElementById('infoupdate').innerHTML = "<div class='alert alert-danger alert-block'> "+error+" </div>";
                }else{
                    
                    dat = {
                        _token: token, date: date, structure: structure, resultat: resultat, nom: nom, commentaire: commentaire, idrct: id,
                    };

                    document.getElementById("infoupdate").innerHTML = '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';
                    
                    // En cours d'envoie
                        try {
                            let response = await fetch("{{route('SRDV')}}",
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

                                console.log(data);

                                reponse = JSON.parse(data);

                                if(reponse.status == 0)
                                {
                                    document.getElementById("infoupdate").innerHTML = '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>'+reponse.messages+'</strong></div>';
                                     setTimeout(function(){
                                        window.location.reload();
                                    }, 3000);
                                }else{
                                    document.getElementById("infoupdate").innerHTML = '<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>'+reponse.messages+'</strong></div>';
                                }
                            }
                            else{
                                document.getElementById("infoupdate").innerHTML = '<div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">×</button><strong>Une erreur s\'est produite '+response.status+' </strong></div>';
                            }
                        } catch (error) {

                            document.getElementById("infoupdate").innerHTML = error;
                        } 
                }
        }
</script>
@endsection

@section("js")
<script>
	$('#flash-overlay-modal').modal();
	$('div.alert').not('.alert-important').delay(6000).fadeOut(350);
</script>
@endsection