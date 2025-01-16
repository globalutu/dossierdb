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
                <a href="{{ route('dashboard') }}"> Tableau de bord </a> / Caisse
                <small></small>
            </h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Caisse - Gestion des versements d'émoluments
                            <button type="button"
                                style="margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px; background-color: #795548; color: white"
                                class="btn waves-effect" data-color="deep-orange" data-toggle="modal"
                                data-target="#add">Ajouter un versement</button>
                        </h2>
                    </div>

                    <div class="body">
                        <div class="table-responsive" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th data-priority="1">Libellé</th>
                                        <th data-priority="1">Versement</th>
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
                                            <th><span class="co-name">{{ $serv->date }}</span></th>
                                            <td>{{ $serv->libelle }}</td>
                                            <td>{{ number_format($serv->versement, 0, '.', ' ') }}</td>
                                            <td>{{ number_format($serv->solde, 0, '.', ' ') }}</td>

                                            <td>
                                                @if ($i == $nbr)
                                                    @if (in_array('delete_vc', session('auto_action')))
                                                        <button type="button"
                                                            onclick="getdeleterct('{{ $serv->libelle }}', '{{ $serv->id }}')"
                                                            data-toggle="modal" data-target="#delete" title="Supprimer"
                                                            class="btn btn-danger btn-circle btn-xs margin-bottom-10 waves-effect waves-light">
                                                            <i class="material-icons">delete_sweep</i>
                                                        </button>
                                                    @endif
                                                @else
                                                    @if (in_array('delete_vc', session('auto_action')))
                                                        <button type="button" title="Impossible de supprimer"
                                                            class="btn btn-default btn-circle btn-xs margin-bottom-10 waves-effect waves-light">
                                                            <i class="material-icons">delete_sweep</i>
                                                        </button>
                                                    @endif
                                                @endif
                                                @php $i++; @endphp
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9">
                                                <center>Aucun versement d'émoluments enregistré dans la trésorerie pour ce
                                                    dossier!</center>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $list->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('model')
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Ajouter un Versement d'Émoluments</h4>
                    </div>
                    <form method="post" action="{{ route('STDV') }}">
                        <div class="modal-body">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" value="{{ $info->id }}" />
                            <input type="hidden" id="trestant" name="trestant" />

                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="lib">Libellé</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="lib" name="lib" required class="form-control"
                                                placeholder="Ex: Versement d'émoluments" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="date">Date</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" id="date" name="date" required class="form-control"
                                                placeholder="JJ/MM/AAAA" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="op">Type d'Opération</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select type="text" id="op" name="op" required class="form-control">
                                                <option value="1">Entrée</option>
                                                <option value="2">Sortie</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="montant">Montant</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="montant" name="montant" required class="form-control"
                                                placeholder="Montant du versement" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm waves-effect waves-light"
                                data-dismiss="modal">FERMER</button>
                            <button type="submit" style="background-color: #795548; color: white"
                                class="btn waves-effect">AJOUTER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
@endsection
