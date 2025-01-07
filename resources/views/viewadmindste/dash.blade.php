@extends('templatedste._temp')
@section('css')
    <link href="cssdste/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            @include('flash::message')
            <h2>
                Tableau de bord
            </h2>
        </div>
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            @if (in_array('add_doc', session('auto_action')))
                                <button type="button"
                                    style="margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px; background-color: #795548; color: white"
                                    class="btn  waves-effect" data-color="deep-orange" data-toggle="modal"
                                    onclick="getadddossier()" data-target="#add">Ajouter</button>
                            @endif
                            <br>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive" data-pattern="priority-columns">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <input class=" form-control" type="text" id="check" name="check"
                                        style="border:1px solid #795548;" id="search" placeholder="... ">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <button class=" form-control" onclick="search()" value="Rechercher"
                                        style="border:1px solid #795548; color:white; background:#795548" id="sub"> <i
                                            class="material-icons">search</i> </button>
                                </div>
                            </div>

                            <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                <thead id="headerdossiers">


                                </thead>
                                <tbody id="bodylistdossiers">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('model')
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">AJOUTER : </h4>
                </div>
                <div class="modal-body">
                    <label id="infoadd"></label>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <label for="denom">Client</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select type="text" id="denom" name="denom" onchange="changetypeclient()"
                                        class="form-control" placeholder="" required>
                                        <option value="2"> Personne Morale </option>
                                        <option value="1"> Personne Physique </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="seeraison">
                            <label for="raison">Raison social</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="raison" name="raison" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="seenom">
                            <label for="nom">Nom</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nom" name="nom" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="seeprenom">
                            <label for="prenom">Prenom</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="prenom" name="prenom" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <label for="typeservice">Type de services</label>
                            <div class="form-group">
                                <div class="form-line" id="seetypeservice">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="tranche">Tranche</label>
                            <div class="form-group">
                                <div class="form-line" id="seetranche">
                                    <select type="text" id="tranche" name="tranche" class="form-control"
                                        placeholder="">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="seepourcentage">
                            <label for="taux">Taux %</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="taux" name="taux" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="seemontantassist">
                            <label for="montantassist">Montant d'assistance : </label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="montantassist" name="montantassist" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <label>Ouverture de dossier : </label>
                        </div>
                        <div class="col-md-6">
                            <label for="montant"> Montant d'ouverture </label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="montant" disabled name="montant" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="montantwrite"> Saisir le montant (si necessaire) </label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="montantwrite" name="montantwrite" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">

                        <div class="col-md-12">
                            <label for="objet">Objet :</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea type="text" id="objet" name="objet" class="form-control" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="datedebut">Date début</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="datedebut" name="datedebut" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="datefin">Date fin</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="datefin" name="datefin" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <label for="commentaire">Commentaire</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea type="text" id="commentaire" name="commentaire" class="form-control" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm waves-effect waves-light"
                        data-dismiss="modal">FERMER</button>
                    <button onclick="setdossiers()" style="background-color: #795548; color: white"
                        class="btn  waves-effect">AJOUTER</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">MODIFICATION : </h4>
                </div>
                <div class="modal-body">
                    <label id="infoadd"></label>

                    <div class="row clearfix">

                        <div class="col-md-6">
                            <label for="montantwrite"> Emolument : </label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="montantwrite" name="montantwrite" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">

                        <div class="col-md-12">
                            <label for="objet">Objet :</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea type="text" id="objet" name="objet" class="form-control" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="datedebut">Date début</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="datedebut" name="datedebut" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="datefin">Date fin</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="datefin" name="datefin" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <label for="commentaire">Commentaire</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea type="text" id="commentaire" name="commentaire" class="form-control" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm waves-effect waves-light"
                        data-dismiss="modal">FERMER</button>
                    <button onclick="setupdatedossiers()" style="background-color: #795548; color: white"
                        class="btn  waves-effect">MODIFIER</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="affecter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Affectation du dossier à un poste : </h4>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="idaffactation" name="idaffactation" />
                    <label id="infoaffectation"></label>
                    <div class="row clearfix">
                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="form-line">
                                    @php
                                        $users = App\Providers\InterfaceServiceProvider::allutilisateurs();
                                    @endphp
                                    <select type="text" id="affecteruser" name="affecteruser" class="form-control">
                                        <option value="0">Sélectionner un poste</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->idUser }}"> {{ $user->nom }} {{ $user->prenom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="bg-blue-grey btn-circle btn-lg margin-bottom-10 waves-effect waves-light"
                                onclick="addusers()">
                                <i class="material-icons">add</i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm waves-effect waves-light"
                        data-dismiss="modal">FERMER</button>
                    <button onclick="valideaffectationposte()" class="btn bg-deep-orange waves-effect">VALIDER</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reaffecter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Réaffectation du dossier à un autre poste : </h4>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="idreaffactation" name="idreaffactation" />
                    <label id="inforeaffectation"></label>
                    <div class="row clearfix">
                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="form-line" id="selectuser">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="bg-blue-grey btn-circle btn-lg  margin-bottom-10 waves-effect waves-light"
                                onclick="addusers()"> <i class="material-icons">add</i> </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm waves-effect waves-light"
                        data-dismiss="modal">FERMER</button>
                    <button onclick="validereaffectationposte()" class="btn bg-deep-orange waves-effect">VALIDER</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const sessionActions = @json(session('auto_action'));

        let listservices = "";

        let listparamservices = "";

        let idparam = 0;

        async function search() {
            let check = document.getElementById('check').value;
            getlistdossiers(check);
        }

        getlistdossiers();

        document.getElementById('seenom').style.display = "none";
        document.getElementById('seeprenom').style.display = "none";
        document.getElementById('seeraison').style.display = "block";
        document.getElementById('seepourcentage').style.display = "block";
        document.getElementById('seemontantassist').style.display = "none";

        async function getlistdossiers(seach = "") {
            try {

                let response = "";

                if (seach == "") {
                    response = await fetch("{{ route('dashboard') }}", {
                        method: 'get',
                        headers: {
                            'Access-Control-Allow-Credentials': true,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-Token': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    });
                } else {
                    response = await fetch("{{ route('dashboard') }}?check=" + seach, {
                        method: 'get',
                        headers: {
                            'Access-Control-Allow-Credentials': true,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-Token': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    });
                }

                if (response.status == 200) {

                    let dataresponse = await response.json();

                    let list = dataresponse.data;

                    // All services
                    listservices = dataresponse.services;

                    // All params services
                    listparamservices = dataresponse.paramservices;

                    /* Entête */
                    let theader = document.getElementById('headerdossiers');
                    theader.innerHTML = "";

                    let tr = document.createElement('tr');
                    tr.innerHTML = ` 
                                            <th data-priority="1">#</th>
                                            <th>Type Client</th>
                                            <th data-priority="1">Nom</th>
                                            <th data-priority="3">Type de service</th>
                                               <th data-priority="3">Date début</th>
                                         
                                            ${sessionActions.includes("see_montant_ouv") ? `
                                                <th data-priority="3">Montant d'ouverture</th> 
                                                ` : ''}
                                            <th data-priority="3">Emulement</th> 
                                            ${sessionActions.includes("see_montant_payer") ? `
                                                <th data-priority="3">Montant payer</th> 
                                                ` : ''}
                                            ${sessionActions.includes("see_montant_restant") ? `
                                                <th data-priority="3">Montant restant</th> 
                                                ` : ''}
                                            ${sessionActions.includes("see_poste_doc") ? `
                                                <th data-priority="3">Poste</th> 
                                                ` : ''}
                                            <th data-priority="6">Actions</th>

                            `;

                    theader.appendChild(tr);

                    /* Body */

                    let tbody = document.getElementById('bodylistdossiers');
                    tbody.innerHTML = "";

                    list.forEach((dossier, index) => {
                        let tr = document.createElement('tr');

                        tr.innerHTML = `
                                    <td><i class="material-icons">folder</i></td>
                                    <th><span class="co-name">${getNameTypeClient(dossier.typeclient)}</span></th>
                                    <td> ${ dossier.nom }  ${ dossier.prenom } </td>
                                    <td> ${ dossier.libelle } </td>
                                    <td> ${ formatDate(dossier.datedebut) }</td>
                                   
                                    ${sessionActions.includes("see_montant_ouv") ? `
                                        <td style="text-align: right;"> ${ new Intl.NumberFormat('fr-FR').format(dossier.montant) }</td>
                                        ` : ''}
                                     <td> ${ new Intl.NumberFormat('fr-FR').format(dossier.payer) } </td>
                                    ${sessionActions.includes("see_montant_payer") ? `
                                        <td style="text-align: right;"> ${ new Intl.NumberFormat('fr-FR').format(dossier.payer) } </td>
                                        ` : ''}
                                    ${sessionActions.includes("see_montant_restant") ? `
                                        <td style="text-align: right;"> ${ new Intl.NumberFormat('fr-FR').format(dossier.montant - dossier.payer) }</td>
                                        ` : ''}
                                    ${sessionActions.includes("see_poste_doc") ? `
                                        <td> ${ (dossier.nomuser) ?? '' } ${ (dossier.prenomuser ) ?? ''}</td>
                                        ` : ''}

                                    <td>
                                        ${sessionActions.includes("update_doc") ? `
                                            <button type="button" title="Modifier"  class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#update" onClick="getupdatemodal( '${ dossier.nom }' , '${ dossier.prenom }',  )">
                                                    =<i class="material-icons">system_update_alt</i> 
                                                </button>` : ''} 



                                        ${(dossier.poste == null || dossier.poste == '') ? `
                                                ${sessionActions.includes("send_doc_poste") ? `
                                            <button type="button" title="Affecter" class="btn btn-primary btn-circle btn-xs margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#affecter" 
                                            onClick="setutilisateurinposte('${dossier.id}')">
                                            <i class="material-icons">account_circle</i>
                                            </button>` : ''}` : `
                                                ${sessionActions.includes("send_doc_poste") ? `
                                            <button type="button" title="Reaffecter" class="btn btn-primary btn-circle btn-xs margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#reaffecter" 
                                            onClick="updateuserinposte('${dossier.id}', '${dossier.poste}')">
                                            <i class="material-icons">account_circle</i>
                                            </button>` : ''}`}

                                        ${sessionActions.includes("renc_client_doc") ? `
                                            <button type="button" title="Rencontre"  class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light">
                                                    <a href="{{ route('RDOS') }}?id=${ dossier.id }" style="color:white;"> <i class="material-icons">group</i></a> 
                                                </button>` : ''}

                                        ${sessionActions.includes("op_caisse_doc") ? `
                                            <button type="button" title="Caisse"  class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light">
                                                    <a href="{{ route('GCSD') }}?id=${ dossier.id }" style="color:white;"> <i class="material-icons">euro_symbol</i></a> 
                                                </button>` : ''}
                                        
                                        ${sessionActions.includes("op_treso_doc") ? `
                                            <button type="button" title="Trésorerie"  class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light">
                                                    <a href="{{ route('TDOS') }}?id=${ dossier.id }" style="color:white;"> <i class="material-icons">poll</i></a> 
                                                </button>` : ''}

                                        ${sessionActions.includes("delete_doc") ? `
                                            <button type="button" title="Supprimer"  class="btn btn-danger btn-circle btn-xs  margin-bottom-10 waves-effect waves-light"><a href="{{ route('DDOS') }}?id=${ dossier.id }" style="color:white;"><i class="material-icons">delete_sweep</i></a> </button>` : ''}
                                    </td>
                                `;

                        tbody.appendChild(tr);
                    });


                    // Si la liste est vide
                    if (list.length === 0) {
                        const emptyRow = document.createElement('tr');
                        emptyRow.innerHTML = `
                                    <td colspan="10"><center>Pas de dossier enregistré!!!</center></td>
                                `;
                        tableBody.appendChild(emptyRow);
                    }

                    getadddossier();

                }
            } catch (error) {
                return "";
            }
        }

        async function updateuserinposte(id, user) {
            document.getElementById('idreaffactation').value = id;

            try {
                let response = await fetch("{{ route('GAUS') }}", {
                    method: 'get',
                    headers: {
                        'Access-Control-Allow-Credentials': true,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                });
                if (response.status == 200) {
                    data = await response.text();
                    contenu = "";
                    list = JSON.parse(data).data;
                    contenu += '<select type="text" id="reaffectuser" name="reaffectuser" class="form-control">';
                    list.forEach(function(currentline, index, arry) {
                        if (currentline["idUser"] == user)
                            contenu += '<option value="' + currentline["idUser"] + '">' + currentline["nom"] +
                            ' ' +
                            currentline["prenom"] + '</option>';
                    });
                    contenu += '<option value="0"> `` Aucun `` </option>';
                    list.forEach(function(currentline, index, arry) {
                        contenu += '<option value="' + currentline["idUser"] + '">' + currentline["nom"] + ' ' +
                            currentline["prenom"] + '</option>';
                    });
                    contenu += '</select>';
                    document.getElementById('selectuser').innerHTML = contenu;
                } else {
                    return "";
                }
            } catch (error) {
                return "";
            }
        }

        async function setutilisateurinposte(id) {
            document.getElementById('infoaffectation').innerHTML = "Affectation au poste : ";
            document.getElementById('idaffactation').value = id;
        }

        function addusers() {
            document.getElementById('infoaffectation').innerHTML =
                "Vous voulez ajouter un utilisateur qui n'existe pas ? Dans cinq secondes vous serez redirigez vers la page d'enregistrement d'utilisateur.. ";
            setTimeout(function() {
                window.location.href = "{{ route('GU') }}";
            }, 5000);
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        // Exemple d'utilisation
        const formattedDate = formatDate(dossier.datedebut);

        async function valideaffectationposte() {

            // récupération des données du formulaire 
            idaffactation = document.getElementById("idaffactation").value;
            affecteruser = document.getElementById("affecteruser").value;

            dat = {
                idaffect: idaffactation,
                user: affecteruser,
            };

            document.getElementById("infoaffectation").innerHTML =
                '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';

            // En cours d'envoie
            try {
                let response = await fetch("{{ route('PAOU') }}", {
                    method: 'POST',
                    headers: {
                        'Access-Control-Allow-Credentials': true,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-Token': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(dat)
                });
                if (response.status == 200) {
                    data = await response.text();
                    document.getElementById("infoaffectation").innerHTML =
                        '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>' +
                        data + '</strong></div>';
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                } else {
                    document.getElementById("infoaffectation").innerHTML =
                        '<div class="alert alert-danger alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>Une erreur s\'est produite </strong></div>';
                }
            } catch (error) {

                document.getElementById("infoaffectation").innerHTML = error;
            }
        }

        async function validereaffectationposte() {

            // récupération des données du formulaire 
            idreaffactation = document.getElementById("idreaffactation").value;
            reaffectuser = document.getElementById("reaffectuser").value;

            dat = {
                idaff: idreaffactation,
                idreaffect: reaffectuser,
            };

            document.getElementById("inforeaffectation").innerHTML =
                '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';

            // En cours d'envoie
            try {
                let response = await fetch("{{ route('RAOU') }}", {
                    method: 'POST',
                    headers: {
                        'Access-Control-Allow-Credentials': true,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-Token': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(dat)
                });
                if (response.status == 200) {
                    data = await response.text();
                    document.getElementById("inforeaffectation").innerHTML =
                        '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>' +
                        data + '</strong></div>';
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                } else {
                    document.getElementById("inforeaffectation").innerHTML =
                        '<div class="alert alert-danger alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>Une erreur s\'est produite </strong></div>';
                }
            } catch (error) {
                document.getElementById("inforeaffectation").innerHTML = error;
            }
        }

        function getNameTypeClient(id) {
            return (id == 1) ? "Personne Physique" : "Personne Morale";
        }

        function changetypeclient() {
            let type = document.getElementById('denom').value;

            if (type == 2) {
                document.getElementById('seenom').style.display = "none";
                document.getElementById('seeprenom').style.display = "none";
                document.getElementById('seeraison').style.display = "block";
            } else {
                document.getElementById('seenom').style.display = "block";
                document.getElementById('seeprenom').style.display = "block";
                document.getElementById('seeraison').style.display = "none";
            }

            getadddossier();

            let trancheSelect = document.getElementById('seetranche');
            let select =
                `<select type="text" id="tranche" onchange="changetaux()" name="tranche" class="form-control"  placeholder=""> </select>`;
            trancheSelect.innerHTML = select;
            document.getElementById('seepourcentage').style.display = "block";
            document.getElementById('seemontantassist').style.display = "none";
            document.getElementById('taux').value = "";
            document.getElementById('montant').value = "";
        }

        function getadddossier() {
            /** Pré remplir les types de services **/

            let typeservicesSelect = document.getElementById('seetypeservice');

            // Clear existing options
            let select =
                '<select type="text" onchange="changecontenutranche()" id="typeservice" name="typeservice" class="form-control"  placeholder="">';
            let option = `<option value='0'> Sélectionner un service </option> `;
            select += option;
            // Add new options
            listservices.forEach(optionText => {
                let option = `<option value='${optionText.id}'> ${optionText.libelle} </option> `;
                select += option;
            });

            select += `</select>`;

            typeservicesSelect.innerHTML = select;
        }

        function changecontenutranche() {

            let select =
                `<select type="text" id="tranche" onchange="changetaux()" name="tranche" class="form-control"  placeholder="">`;

            let idvalue = document.getElementById('typeservice').value;

            let personne = document.getElementById('denom').value;

            let trancheSelect = document.getElementById('seetranche');
            let option = `<option value='0'> Sélectionner la tranche </option> `;
            select += option;
            // Add new options
            listparamservices.forEach(optionText => {

                if (optionText.service == idvalue && optionText.typeclient == personne) {
                    let option = `<option value='${optionText.id}'> De `;

                    if (optionText.tranchemin == -1)
                        option += " infini ";
                    else
                        option += `${new Intl.NumberFormat('fr-FR').format(optionText.tranchemin)}`;
                    option += " à ";

                    if (optionText.tranchemax == -1)
                        option += " infini ";
                    else
                        option += `${new Intl.NumberFormat('fr-FR').format(optionText.tranchemax)}`;

                    select += option;

                    // set value idparam 
                    idparam = optionText.id;
                }
            });

            select += `</select>`;

            trancheSelect.innerHTML = select;
        }

        function changetaux() {
            let plage = document.getElementById('tranche').value;

            let personne = document.getElementById('denom').value;

            listparamservices.forEach(optionText => {

                if (optionText.id == plage) {
                    if (optionText.montantcontrat == 0 && optionText.tauxcontrat == 0 && optionText.typeclient ==
                        personne) {
                        document.getElementById('seepourcentage').style.display = "none";
                        document.getElementById('seemontantassist').style.display = "none";
                        document.getElementById('montant').value = optionText.ouverture;

                        // set value idparam 
                        idparam = optionText.id;
                    } else {

                        if (optionText.montantcontrat != 0 && optionText.typeclient == personne) {
                            document.getElementById('seepourcentage').style.display = "none";
                            document.getElementById('seemontantassist').style.display = "block";

                            // Afficher la valeur
                            document.getElementById('montantassist').value = optionText.montantcontrat;
                            document.getElementById('montant').value = optionText.ouverture;

                            // set value idparam 
                            idparam = optionText.id;
                        }
                        if (optionText.tauxcontrat != 0 && optionText.typeclient == personne) {
                            document.getElementById('seepourcentage').style.display = "block";
                            document.getElementById('seemontantassist').style.display = "none";

                            // Afficher la valeur
                            document.getElementById('taux').value = optionText.tauxcontrat;
                            document.getElementById('montant').value = optionText.ouverture;

                            // set value idparam 
                            idparam = optionText.id;
                        }
                    }
                }
            });
        }

        async function setdossiers() {
            typeclient = document.getElementById('denom').value;
            raison = document.getElementById('raison').value;
            nom = document.getElementById('nom').value;
            prenom = document.getElementById('prenom').value;
            montantwrite = document.getElementById('montantwrite').value;
            objet = document.getElementById('objet').value;
            datedebut = document.getElementById('datedebut').value;
            datefin = document.getElementById('datefin').value;
            commentaire = document.getElementById('commentaire').value;

            let data = {
                typeclient: typeclient,
                raison: raison,
                nom: nom,
                prenom: prenom,
                montantwrite: montantwrite,
                objet: objet,
                datedebut: datedebut,
                datefin: datefin,
                commentaire: commentaire,
                service: idparam
            };

            document.getElementById("infoadd").innerHTML =
                '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';

            // En cours d'envoie
            try {
                let response = await fetch("{{ route('GMDOS') }}", {
                    method: 'POST',
                    headers: {
                        'Access-Control-Allow-Credentials': true,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-Token': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                });
                if (response.status == 200) {
                    let reponse = await response.json();

                    if (reponse.success == true) {
                        document.getElementById("infoadd").innerHTML =
                            '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>' +
                            reponse.message + '</strong></div>';

                        var link = document.createElement('a');
                        link.href = '#';
                        link.onclick = function() {
                            getlistdossiers();
                        };

                        document.body.appendChild(link);

                        link.click();
                        setTimeout(function() {
                            $('#add').modal('hide');
                        }, 500);

                    } else {
                        document.getElementById("infoadd").innerHTML =
                            '<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>' +
                            reponse.message + '</strong></div>';
                    }
                } else {
                    let reponse = await response.json();
                    document.getElementById("infoadd").innerHTML =
                        '<div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">×</button><strong> ' +
                        reponse.message + ' </strong></div>';
                }
            } catch (error) {
                document.getElementById("infoadd").innerHTML = error;
            }
        }
    </script>
@endsection
