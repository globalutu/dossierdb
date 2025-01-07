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
                        <button type="button"
                            style="margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px; background-color: #795548; color: white"
                            class="btn  waves-effect" data-color="deep-orange" data-toggle="modal"
                            data-target="#add">Ajouter</button>
                        <br>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                            <thead>
                                <form class="form-horizontal" action="{{ route('dashboard') }}" method="GET"
                                    id="recherche">
                                    <tr>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input class=" form-control" type="hidden" name="rec" value="1">
                                        <th colspan="2">
                                            <input class=" form-control" type="text" name="check"
                                                style="border:1px solid #795548;" id="search" placeholder="... ">
                                        </th>

                                        <th data-priority="1">
                                            <input class=" form-control" type="submit" value="Rechercher"
                                                style="border:1px solid #795548; color:white; background:#795548"
                                                id="sub">
                                        </th>
                                        <th colspan="6"> </th>
                                        <th>
                                            <a href="{{ route('dashboard') }}">
                                                <button type="button" style="margin-right: 30px; float: right; padding-right: 30px; 
                                            padding-left: 30px; background-color: #795548; color: white"
                                                    class="btn  waves-effect"> Actualiser </button> </a>

                                        </th>
                                    </tr>
                                </form>

                                <tr>
                                    <th data-priority="1">#</th>
                                    <th>Dénomination</th>
                                    <th data-priority="1">Nom</th>
                                    <th data-priority="3">Prénom</th>
                                    <th data-priority="3">Date début</th>
                                    <th data-priority="3">Montant</th>
                                    <th data-priority="3">Montant payer</th>
                                    <th data-priority="3">Montant restant</th>
                                    <th data-priority="6">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($list as $vcs)
                                <tr>
                                    <td><i class="material-icons">folder</i></td>
                                    <th><span class="co-name">{{$vcs->denomination}}</span></th>
                                    <td>{{$vcs->nom}}</td>
                                    <td>{{$vcs->prenom}}</td>
                                    <td>{{$vcs->datedebut}}</td>
                                    <td>{{ number_format($vcs->montant, 0, '.', ' ')}}</td>
                                    <td>{{ number_format($vcs->payer, 0, '.', ' ')}}</td>
                                    <td>{{ number_format(($vcs->montant - $vcs->payer) , 0, '.', ' ') }} </td>

                                    <td>
                                        @if(in_array("update_vc", session("auto_action")))
                                        <button type="button" title="Modifier"
                                            class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light">
                                            <a href="{{ route('UDOS', $vcs->id)}}" style="color:white;"> <i
                                                    class="material-icons">system_update_alt</i></a>

                                        </button>
                                        @endif

                                        @if(in_array("update_vc", session("auto_action")))
                                        <button type="button" title="Rencontre"
                                            class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light">
                                            <a href="{{ route('RDOS', $vcs->id)}}" style="color:white;"> <i
                                                    class="material-icons">group</i></a>

                                        </button>
                                        @endif

                                        @if(in_array("update_vc", session("auto_action")))
                                        <button type="button" title="Trésorerie"
                                            class="btn btn-primary btn-circle btn-xs  margin-bottom-10 waves-effect waves-light">
                                            <a href="{{ route('TDOS', $vcs->id)}}" style="color:white;"> <i
                                                    class="material-icons">poll</i></a>

                                        </button>
                                        @endif

                                        @if(in_array("delete_vc", session("auto_action")))
                                        <button type="button" title="Supprimer"
                                            class="btn btn-danger btn-circle btn-xs  margin-bottom-10 waves-effect waves-light"><a
                                                href="{{ route('DDOS', $vcs->id)}}" style="color:white;"><i
                                                    class="material-icons">delete_sweep</i></a> </button>
                                        @endif


                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10">
                                        <center>Pas de dossier enregistrer!!!</center>
                                    </td>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">AJOUTER : </h4>
            </div>
            <form method="post" action="{{ route('GMDOS') }}">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <label for="denom">Dénomination</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="denom" name="denom" class="form-control" placeholder=""
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="nom">Nom</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nom" name="nom" class="form-control" required placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="prenom">Prénoms</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="prenom" name="prenom" class="form-control" required
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">

                        <div class="col-md-6">
                            <label for="objet">Objet</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea type="text" id="objet" name="objet" class="form-control" required
                                        placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="montant">Montant </label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="montant" name="montant" required class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="datedebut">Date début</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="datedebut" name="datedebut" class="form-control" required
                                        placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="datefin">Date fin</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="datefin" name="datefin" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <label for="commentaire">Commentaire</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea type="text" id="commentaire" name="commentaire" class="form-control"
                                        placeholder=""></textarea>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm waves-effect waves-light"
                        data-dismiss="modal">FERMER</button>
                    <button type="submit" style="background-color: #795548; color: white"
                        class="btn  waves-effect">AJOUTER</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection