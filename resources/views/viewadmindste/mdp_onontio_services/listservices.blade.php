@extends('templatedste._temp')
@section('css')
    <link href="cssdste/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endsection
	
@section('content')

    <div class="container-fluid">
            <div class="block-header">
                @include('flash::message')
                <h2>
                    Services
                </h2>
            </div>
            <div class="row clearfix">
                <!-- Liste des services  -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Liste des services
                            <button type="button" style="margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px; background-color: #795548; color: white" class="btn  waves-effect" data-color="deep-orange" data-toggle="modal" data-target="#addservice">Ajouter</button>
                            <br>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                    <thead>
                                        
                                    <tr>
                                        <th data-priority="1">#</th>
                                        <th>Libellé</th>
                                        <th data-priority="6">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="bodylistservices">
                                        

                                    </tbody>
                                </table>
                            </div> 
                            
                        </div>
                    </div>
                </div>

                <!-- Paramétrage des services -->

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Paramétrage de <strong id="nameservicesparam"> Service </strong>
                            <button type="button" style="display: none; margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px; background-color: #795548; color: white" class="btn  waves-effect" data-color="deep-orange" data-toggle="modal" id="paramserv" data-target="#addparamservice">Ajouter</button>
                            <br>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Client</th>
                                            <th>Ouverture de dossier</th>
                                            <th>Montant Contrat</th>
                                            <th>Taux Contrat</th>
                                            <th>Tranche Min</th>
                                            <th>Tranche Max</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodylistparamservices">
                                        
                                    </tbody>
                                </table>
                            </div> 
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <script type="text/javascript">
            const sessionActions = @json(session('auto_action'));

            getlistservices();

            async function getlistservices() {
                try {
                        let response = await fetch("{{route('GVSO')}}",
                        {
                            method: 'get',
                            headers: {
                                'Access-Control-Allow-Credentials': true,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-Token': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                        });
                        if(response.status == 200)
                        {

                            let dataresponse = await response.json();

                            let list = dataresponse.data;

                            let tbody = document.getElementById('bodylistservices');
                            tbody.innerHTML = "";

                            list.forEach((service, index) => {
                                let tr = document.createElement('tr');

                                tr.innerHTML = `
                                    <td>${index + 1}</td>
                                    <th><span class="co-name">${service.libelle}</span></th>
                                    <td>
                                        ${sessionActions.includes("update_vc") ? `
                                        <button type="button" title="Modifier" data-values='[${service.id}, "${service.libelle}"]' onclick="getupdateservice(this)" data-toggle="modal" data-target="#updateservice" class="btn btn-primary btn-circle btn-xs margin-bottom-10 waves-effect waves-light">
                                            <i class="material-icons">system_update_alt</i>
                                        </button>` : ''}
                                        
                                        
                                        
                                        ${sessionActions.includes("delete_vc") ? `
                                        <button type="button" title="Supprimer"  data-values='[${service.id}, "${service.libelle}"]' onclick="deleteservice(this)"  class="btn btn-danger btn-circle btn-xs margin-bottom-10 waves-effect waves-light">
                                            <i class="material-icons">delete_sweep</i>
                                        </button>` : ''}

                                        ${sessionActions.includes("update_vc") ? `
                                        <button type="button" title="Paramétrage" data-values='[${service.id}, "${service.libelle}"]' onclick="paramservice(this)" class="btn btn-primary btn-circle btn-xs margin-bottom-10 waves-effect waves-light">
                                            <i class="material-icons">send</i>
                                        </button>` : ''}
                                    </td>
                                `;

                                tbody.appendChild(tr);
                            });
                        }
                    } catch (error) {
                        return "";
                    }
            }

            async function paramservice(button) {
                const valuesString = button.dataset.values;
                try {
                    const values = JSON.parse(valuesString);
                    
                    const id = values[0];
                    const libelle = values[1];

                    document.getElementById('paramserv').style.display = "block";
                    document.getElementById('nameservicesparam').innerHTML = libelle;
                    document.getElementById('paramid').value = id;
                    
                    affichelistparam(id, libelle);

                } catch (error) {
                    console.error("Erreur lors de l'analyse des valeurs :", error);
                }
            }

            async function affichelistparam(id, libelle) {
                            dat = {
                                id: id,
                            };
                            const response = await fetch("{{route('GPSO')}}", {
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
                                respons = await response.json();
                                
                                let list = respons.data;

                                let tbody = document.getElementById('bodylistparamservices');
                                tbody.innerHTML = ""; 

                                list.forEach((param, index) => {
                                    let tr = document.createElement('tr');

                                    tr.innerHTML = `
                                        <td>${index + 1}</td>
                                        <th><span class="co-name">${getNameTypeClient(param.typeclient)}</span></th>
                                        <th><span class="co-name">${ new Intl.NumberFormat('fr-FR').format( param.ouverture ) }</span></th>
                                        <th><span class="co-name">${ new Intl.NumberFormat('fr-FR').format( param.montantcontrat ) }</span></th>
                                        <th><span class="co-name">${ new Intl.NumberFormat('fr-FR').format( param.tauxcontrat ) } %</span></th>
                                        <th><span class="co-name">${ new Intl.NumberFormat('fr-FR').format( param.tranchemin ) }</span></th>
                                        <th><span class="co-name">${ new Intl.NumberFormat('fr-FR').format( param.tranchemax ) }</span></th>
                                        <td>
                                            ${sessionActions.includes("update_vc") ? `
                                            <button type="button" title="Modifier" data-values='[${param.id}, "${libelle}"]' onclick="getupdateparam(this)" data-toggle="modal" data-target="#updateparam" class="btn btn-primary btn-circle btn-xs margin-bottom-10 waves-effect waves-light">
                                                <i class="material-icons">system_update_alt</i>
                                            </button>` : ''}
                                                                                        
                                            ${sessionActions.includes("delete_vc") ? `
                                            <button type="button" title="Supprimer"  data-values='[${param.id}, "${libelle}"]' onclick="deleteparam(this)"  class="btn btn-danger btn-circle btn-xs margin-bottom-10 waves-effect waves-light">
                                                <i class="material-icons">delete_sweep</i>
                                            </button>` : ''}

                                        </td>
                                    `;

                                    tbody.appendChild(tr);
                                });

                            }
            }

            function getNameTypeClient(id) {
                return (id == 1) ? "Personne Physique" : "Personne Morale" ;
            }

            async function deleteservice(button) {
                const valuesString = button.dataset.values;
                try {
                    const values = JSON.parse(valuesString);
                    
                    const id = values[0];
                    const libelle = values[1];
                    
                    const {
                        isConfirmed
                    } = await Swal.fire({
                        title: "Êtes-vous sûr de vouloir supprimer le service " + libelle + "?",
                        text: "Cette action est irréversible!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Oui, supprimer",
                        cancelButtonText: "Annuler",
                        customClass: {
                            confirmButton: 'bg-confirm',
                            cancelButton: 'bg-cancel'
                        }
                    });

                    if (isConfirmed) {
                        try {
                            dat = {
                                id: id,
                            };
                            const response = await fetch("{{route('DSO')}}", {
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
                                data = await response.json();
                                Swal.fire("Succès", data.message, "success")
                                    .then(
                                        () => {
                                            window.location.reload();
                                        });

                            } else {
                                throw new Error('Erreur lors de la suppression');
                            }
                        } catch (error) {
                            Swal.fire("Erreur", "La suppression a échoué" + error);
                        }
                    }

                } catch (error) {
                    console.error("Erreur lors de l'analyse des valeurs :", error);
                }
            }

            async function getupdateservice(button) {
                const valuesString = button.dataset.values;
                try {
                    const values = JSON.parse(valuesString);
                    
                    const id = values[0];
                    const libelle = values[1];
                    
                    document.getElementById('denomupdateid').value= id;
                    document.getElementById('denomupdate').value= libelle;
                } catch (error) {
                    console.error("Erreur lors de l'analyse des valeurs :", error);
                }
            }

            async function valideservice() {
                
                    
                    lib = document.getElementById('denom').value;

                    let data = {denom: lib};

                    document.getElementById("infoadd").innerHTML = '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';
                    
                    // En cours d'envoie
                    try {
                        let response = await fetch("{{route('SSO')}}",
                        {
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
                        if(response.status == 200)
                        {
                            let reponse = await response.json();

                            if(reponse.success == true)
                            {
                                document.getElementById("infoadd").innerHTML = '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>'+reponse.message+'</strong></div>';
                                
                                var link = document.createElement('a');
                                link.href = '#';
                                link.onclick = function() {
                                    getlistservices();
                                };
                                
                                document.body.appendChild(link);

                                link.click();
                                setTimeout(function() {
                                    $('#addservice').modal('hide');
                                }, 500);

                            }else{
                                document.getElementById("infoadd").innerHTML = '<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>'+reponse.message+'</strong></div>';
                            }
                        }
                        else{
                            let reponse = await response.json();
                            document.getElementById("infoadd").innerHTML = '<div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">×</button><strong> '+reponse.message+' </strong></div>';
                        }
                    } catch (error) {
                        document.getElementById("infoadd").innerHTML = error;
                    } 
            }

            async function valideupdateservice() {
                
                    
                    lib = document.getElementById('denomupdate').value;
                    id = document.getElementById('denomupdateid').value;

                    let data = {denom: lib, id: id};

                    document.getElementById("infoupdate").innerHTML = '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';
                    
                    // En cours d'envoie
                    try {
                        let response = await fetch("{{route('SUSO')}}",
                        {
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
                        if(response.status == 200)
                        {
                            let reponse = await response.json();

                            if(reponse.success == true)
                            {
                                document.getElementById("infoupdate").innerHTML = '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>'+reponse.message+'</strong></div>';
                                
                                var link = document.createElement('a');
                                link.href = '#';
                                link.onclick = function() {
                                    getlistservices();
                                };
                                
                                document.body.appendChild(link);

                                link.click();
                                setTimeout(function() {
                                    $('#updateservice').modal('hide');
                                }, 500);

                            }else{
                                document.getElementById("infoupdate").innerHTML = '<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>'+reponse.message+'</strong></div>';
                            }
                        }
                        else{
                            let reponse = await response.json();
                            document.getElementById("infoupdate").innerHTML = '<div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">×</button><strong> '+reponse.message+' </strong></div>';
                        }
                    } catch (error) {
                        document.getElementById("infoupdate").innerHTML = error;
                    } 
            }

            async function valideparamservice(argument) {
                
                typeclient = document.getElementById('typeclient').value;
                ouverture = document.getElementById('ouverture').value;
                montant = document.getElementById('montant').value;
                taux = document.getElementById('taux').value;
                tranchemax = document.getElementById('tranchemax').value;
                tranchemin = document.getElementById('tranchemin').value;
                id = document.getElementById('paramid').value;
                libelle = document.getElementById('nameservicesparam').innerHTML;

                    let data = {id: id, libelle: libelle, typeclient: typeclient, ouverture: ouverture, montant: montant, taux: taux, tranchemax: tranchemax, tranchemin: tranchemin};

                    document.getElementById("infoaddparam").innerHTML = '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';
                    
                    // En cours d'envoie
                    try {
                        let response = await fetch("{{route('SPSO')}}",
                        {
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

                        if(response.status == 200)
                        {
                            let reponse = await response.json();

                            if(reponse.success == true)
                            {
                                document.getElementById("infoaddparam").innerHTML = '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>'+reponse.message+'</strong></div>';
                                
                                var link = document.createElement('a');
                                link.href = '#';
                                link.onclick = function() {
                                    affichelistparam(id, libelle)
                                };
                                
                                document.body.appendChild(link);

                                link.click();
                                setTimeout(function() {
                                    $('#addparamservice').modal('hide');
                                }, 500);

                            }else{
                                document.getElementById("infoaddparam").innerHTML = '<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>'+reponse.message+'</strong></div>';
                            }
                        }
                        else{
                            let reponse = await response.json();
                            document.getElementById("infoaddparam").innerHTML = '<div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">×</button><strong> '+reponse.message+' </strong></div>';
                        }
                    } catch (error) {
                        document.getElementById("infoaddparam").innerHTML = error;
                    }
            }

        </script>

@endsection

@section("model")

<div class="modal fade" id="addservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajouter un service : </h4>
            </div>
            
            <div class="modal-body">
                    <div class="row clearfix">
                        <label id="infoadd"></label>
                        <div class="col-md-12">
                                <label for="denom">Libellé</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="denom" name="denom" class="form-control">
                                </div>
                                </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">FERMER</button>
                <button onclick="valideservice()" style="background-color: #795548; color: white" class="btn  waves-effect">AJOUTER</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="updateservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modification de service : </h4>
            </div>
            
            <div class="modal-body">
                    <div class="row clearfix">
                        <label id="infoupdate"></label>
                        <input type="hidden" id="denomupdateid">
                        <div class="col-md-12">
                                <label for="denomupdate">Libellé</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="denomupdate" name="denomupdate" class="form-control">
                                </div>
                                </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">FERMER</button>
                <button onclick="valideupdateservice()" style="background-color: #795548; color: white" class="btn  waves-effect">MODIFIER</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="addparamservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajouter un paramétre : </h4>
            </div>
            <div class="modal-body">
                    <div class="row clearfix">
                        <label id="infoaddparam"></label>
                        <input type="hidden" id="paramid">
                        <div class="col-md-4">
                                <label for="typeclient">Client</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <select type="text" id="typeclient" name="typeclient" class="form-control" >
                                        <option value="2"> Personne Morale </option>
                                        <option value="1"> Personne Physique </option>
                                    </select>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <label for="ouverture">Ouverture de dossier</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="ouverture" name="ouverture" class="form-control" >
                                </div>
                                </div>
                        </div>
                        <div class="col-md-12">
                            <label for="contrat">Contrat <br> </label>
                        </div>
                        <div class="col-md-3">
                                <label for="montant">Montant</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="montant" name="montant" class="form-control" >
                                </div>
                                </div>
                        </div>
                        <div class="col-md-3">
                                <label for="taux">Taux (%)</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="taux" name="taux" class="form-control" >
                                </div>
                                </div>
                        </div>
                        <div class="col-md-3">
                                <label for="tranchemax">Tranche max</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="tranchemax" name="tranchemax" min="0" class="form-control"  >
                                </div>
                                </div>
                        </div>
                        <div class="col-md-3">
                                <label for="tranchemin">Tranche min</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="tranchemin" name="tranchemin" min="-1" class="form-control" >
                                </div>
                                </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">FERMER</button>
                <button onclick="valideparamservice()" style="background-color: #795548; color: white" class="btn  waves-effect">AJOUTER</button>
            </div>
        </div>
    </div>
</div>

@endsection