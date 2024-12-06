@extends('templatedste._temp')
@section('css')
    <link href="cssdste/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endsection
	
@section('content')

    <div class="container-fluid">
            <div class="block-header">
                @include('flash::message')
                <h2>
                    Liste des services
                </h2>
            </div>
            <div class="row clearfix">
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            <button type="button" style="margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px; background-color: #795548; color: white" class="btn  waves-effect" data-color="deep-orange" data-toggle="modal" data-target="#add">Ajouter</button>
                            <br>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                    <thead>
                                        
                                    <tr>
                                        <th data-priority="1">#</th>
                                        <th>Client</th>
                                        <th>Ouverture de dossier</th>
                                        <th>Montant Contrat</th>
                                        <th>Taux Contrat</th>
                                        <th>Tranche Max</th>
                                        <th>Tranche Min</th>
                                        <th data-priority="6">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td>1</td>
                                            <th><span class="co-name">Personne Morale</span></th>
                                            <th><span class="co-name">200 000</span></th>
                                            <th><span class="co-name">0</span></th>
                                            <th><span class="co-name">5%</span></th>
                                            <th><span class="co-name">0</span></th>
                                            <th><span class="co-name">infini</span></th>
                                            <td>
                                            @if(in_array("update_vc", session("auto_action")))
                                            <button type="button" title="Modifier"  class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light">
                                                <a href="" style="color:white;"> <i class="material-icons">system_update_alt</i></a> 
                                                
                                            </button>
                                            @endif

                                            @if(in_array("delete_vc", session("auto_action")))
                                            <button type="button" title="Supprimer"  class="btn btn-danger btn-circle btn-xs  margin-bottom-10 waves-effect waves-light"><a href="" style="color:white;"><i class="material-icons">delete_sweep</i></a> </button>
                                            @endif

                                            
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>2</td>
                                            <th><span class="co-name">Personne Physique</span></th>
                                            <th><span class="co-name">200 000</span></th>
                                            <th><span class="co-name">0</span></th>
                                            <th><span class="co-name">5%</span></th>
                                            <th><span class="co-name">0</span></th>
                                            <th><span class="co-name">infini</span></th>
                                            <td>
                                            @if(in_array("update_vc", session("auto_action")))
                                            <button type="button" title="Modifier"  class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light">
                                                <a href="" style="color:white;"> <i class="material-icons">system_update_alt</i></a> 
                                                
                                            </button>
                                            @endif

                                            @if(in_array("delete_vc", session("auto_action")))
                                            <button type="button" title="Supprimer"  class="btn btn-danger btn-circle btn-xs  margin-bottom-10 waves-effect waves-light"><a href="" style="color:white;"><i class="material-icons">delete_sweep</i></a> </button>
                                            @endif

                                            
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
            <form method="post" action="{{ route('GMDOS') }}">
            <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="row clearfix">
                        <div class="col-md-4">
                                <label for="denom">Client</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <select type="text" id="denom" name="denom" class="form-control" placeholder="" required>
                                        <option> Personne Morale </option>
                                        <option> Personne Physique </option>

                                    </select>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <label for="denom">Ouverture de dossier</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="denom" name="denom" class="form-control" placeholder="" required>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-12">
                            <label for="denom">Contrat <br> </label>
                        </div>
                        <div class="col-md-3">
                                <label for="denom">Montant</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="denom" name="denom" class="form-control" placeholder="" required>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-3">
                                <label for="denom">Taux (%)</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="denom" name="denom" class="form-control" placeholder="" required>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-3">
                                <label for="denom">Tranche max</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="denom" name="denom" class="form-control" placeholder="" required>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-3">
                                <label for="denom">Tranche min</label>
                                <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="denom" name="denom" class="form-control" placeholder="" required>
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

@endsection