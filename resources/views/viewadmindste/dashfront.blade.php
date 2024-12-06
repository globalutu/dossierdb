@extends('templatedste._temp')

@section('css')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="cssdste/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="cssdste/node-waves/waves.css" rel="stylesheet" />
    <link href="cssdste/animate-css/animate.css" rel="stylesheet" />
    <link href="cssdste/css/style.css" rel="stylesheet">
    <link href="cssdste/css/themes/all-themes.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    <style>
        #user,
        #position,
        #facebook_url,
        #twitter_url,
        #linkedin_url {
            max-width: 100%;
            /* Ajuste à la largeur du conteneur parent */
        }

        .modal-dialog {
            max-width: 600px;
            /* Limite la largeur du modal */
        }

        .modal-content {
            padding: 1rem;
            /* Espacement interne pour éviter le chevauchement */
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="content p-5">
            <div class="block-header">
                @include('flash::message')
                <h2>
                    <a style="color:#795548" href="{{ route('dashboard') }}"> Tableau de bord </a> /Manage Testimonials and
                    Contacts
                    <small></small>
                </h2>
                <header class="d-flex justify-content-between align-items-center pb-4">

                    <div>
                        <button class="btn btn-info" data-toggle="modal" data-target="#newsletterModal">View
                            Newsletters</button>
                        <button class="btn btn-success" data-toggle="modal" data-target="#editContactModal">Edit
                            Contact</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addTestimonialModal">Add
                            Testimonial</button>
                    </div>
                </header>
            </div>

            <!-- Testimonials Section -->

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h5 class="card-title mb-3"><i class="bi bi-chat-left-quote"></i> Témoignages</h5>
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom du Client</th>
                                        <th>Profession</th>
                                        <th>Image</th>
                                        <th>Témoignage</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $testimonial->id }}</td>
                                            <td>{{ $testimonial->clientName }}</td>
                                            <td>{{ $testimonial->clientProfession }}</td>
                                            <td>
                                                @if ($testimonial->image)
                                                    <img src="{{ asset('storage/' . $testimonial->image) }}"
                                                        class="img-fluid rounded" style="width: 50px;" data-toggle="modal"
                                                        data-target="#viewImageModal{{ $testimonial->id }}">
                                                @else
                                                    <span class="text-muted">Pas d'image</span>
                                                @endif
                                            </td>
                                            <td>{{ $testimonial->testimonialText }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#editTestimonialModal{{ $testimonial->id }}">Modifier</button>
                                                <form action="{{ route('testimonials.destroy', $testimonial->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger delete-btn">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal pour voir l'image -->
                                        <div class="modal fade" id="viewImageModal{{ $testimonial->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        @if ($testimonial->image)
                                                            <img src="{{ asset('storage/' . $testimonial->image) }}"
                                                                class="img-fluid rounded">
                                                        @else
                                                            <p>Aucune image disponible</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Edit Testimonial Modal -->
                <div class="modal fade" id="editTestimonialModal{{ $testimonial->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST"
                            enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('POST')
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier le témoignage</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="editClientName{{ $testimonial->id }}" class="form-label">Nom du
                                        client</label>
                                    <input type="text" class="form-control" id="editClientName{{ $testimonial->id }}"
                                        name="editClientName" value="{{ $testimonial->clientName }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editClientProfession{{ $testimonial->id }}"
                                        class="form-label">Profession</label>
                                    <input type="text" class="form-control"
                                        id="editClientProfession{{ $testimonial->id }}" name="editClientProfession"
                                        value="{{ $testimonial->clientProfession }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editImage{{ $testimonial->id }}" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="editImage{{ $testimonial->id }}"
                                        name="editImage">
                                    @if ($testimonial->image)
                                        <small class="text-muted">Image actuelle : {{ $testimonial->image }}</small>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="editTestimonialText{{ $testimonial->id }}"
                                        class="form-label">Témoignage</label>
                                    <textarea class="form-control" id="editTestimonialText{{ $testimonial->id }}" name="editTestimonialText"
                                        rows="3" required>{{ $testimonial->testimonialText }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">Enregistrer les modifications</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Newsletters Modal -->
                <div class="modal fade" id="newsletterModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">Abonnés à la Newsletter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Email</th>
                                            <th>Date d'inscription</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscribers as $subscriber)
                                            <tr>
                                                <td>{{ $subscriber->id }}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td>{{ $subscriber->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>





                <!-- Modal Modifier Contact -->
                <div class="modal fade" id="editContactModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('contacts.update', $contact->id) }}" method="POST"
                            enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title">Modifier les Informations de Contact</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input type="text" id="adresse" name="adresse" class="form-control"
                                        value="{{ $contact->adresse }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telephone_1" class="form-label">Téléphone 1</label>
                                    <input type="text" id="telephone_1" name="telephone_1" class="form-control"
                                        value="{{ $contact->telephone_1 }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telephone_2" class="form-label">Téléphone 2</label>
                                    <input type="text" id="telephone_2" name="telephone_2" class="form-control"
                                        value="{{ $contact->telephone_2 }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ $contact->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="heures_ouverture_1" class="form-label">Heures d'Ouverture</label>
                                    <input type="text" id="heures_ouverture_1" name="heures_ouverture_1"
                                        class="form-control" value="{{ $contact->heures_ouverture_1 }}">
                                </div>
                                <div class="mb-3">
                                    <label for="facebook_url" class="form-label">URL Facebook</label>
                                    <input type="url" id="facebook_url" name="facebook_url" class="form-control"
                                        value="{{ $contact->facebook_url }}">
                                </div>
                                <div class="mb-3">
                                    <label for="twitter_url" class="form-label">URL Twitter</label>
                                    <input type="url" id="twitter_url" name="twitter_url" class="form-control"
                                        value="{{ $contact->twitter_url }}">
                                </div>
                                <div class="mb-3">
                                    <label for="linkedin_url" class="form-label">URL LinkedIn</label>
                                    <input type="url" id="linkedin_url" name="linkedin_url" class="form-control"
                                        value="{{ $contact->linkedin_url }}">
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" id="logo" name="logo" class="form-control">
                                    @if ($contact->logo)
                                        <small class="text-muted">Logo actuel : {{ $contact->logo }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Enregistrer les Modifications</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>




                <!-- Add Testimonial Modal -->
                <div class="modal fade" id="addTestimonialModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data"
                            class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Ajouter un Nouveau Témoignage</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="clientName" class="form-label">Nom du Client</label>
                                    <input type="text" class="form-control" id="clientName" name="clientName"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="clientProfession" class="form-label">Profession</label>
                                    <input type="text" class="form-control" id="clientProfession"
                                        name="clientProfession" required>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="testimonialText" class="form-label">Témoignage</label>
                                    <textarea class="form-control" id="testimonialText" name="testimonialText" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ajouter le Témoignage</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="content p-5">
            <!-- En-tête de la page -->
            <header class="d-flex justify-content-between align-items-center pb-4">
                <h1 class="h3">Gérer les Membres de l'Équipe / les Services</h1>
                <div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">Ajouter un Nouveau
                        Membre</button>
                </div>
            </header>

            <!-- Section Équipe -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="bi bi-person"></i> </h5>
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nom du Membre</th>
                                <th>Poste</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teamMembers as $member)
                                <tr>
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->position }}</td>
                                    <td>
                                        @if ($member->image)
                                            <img src="{{ asset('storage/' . $member->image) }}" class="img-fluid rounded"
                                                style="width: 50px;" data-toggle="modal"
                                                data-target="#viewImageModal{{ $member->id }}">
                                        @else
                                            <span class="text-muted">Aucune Image</span>
                                        @endif
                                    </td>
                                    <td>

                                        <form action="{{ route('team.destroy', $member->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger delete-btn">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal pour voir l'image -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Add Member Modal -->
        <!-- Add Member Modal -->
        <div class="modal fade" id="addMemberModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data"
                    class="modal-content">
                    @csrf
                    <!-- En-tête du modal -->
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">Ajouter un Nouveau Membre</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Corps du modal -->
                    <div class="modal-body">
                        <!-- Champ Utilisateur -->
                        <div class="modal-body">
                            <!-- Champ Utilisateur -->
                            <div class="form-group">
                                <label for="user" class="form-label">Utilisateur</label>
                                <select class="form-control" id="user" name="name" required>
                                    <option value="" selected>Sélectionner un utilisateur</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->nom . ' ' . $user->prenom }}">
                                            {{ $user->nom }} {{ $user->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Champ Position -->
                        <div class="form-group">
                            <label for="position" class="form-label">Poste</label>
                            <input type="text" class="form-control" id="position" name="position"
                                placeholder="Exemple : Manager" required>
                        </div>

                        <!-- Lien Facebook -->
                        <div class="form-group">
                            <label for="facebook_url" class="form-label">URL Facebook</label>
                            <input type="url" class="form-control" id="facebook_url" name="facebook_url"
                                placeholder="https://facebook.com/username">
                        </div>

                        <!-- Lien Twitter -->
                        <div class="form-group">
                            <label for="twitter_url" class="form-label">URL Twitter</label>
                            <input type="url" class="form-control" id="twitter_url" name="twitter_url"
                                placeholder="https://twitter.com/username">
                        </div>

                        <!-- Lien LinkedIn -->
                        <div class="form-group">
                            <label for="linkedin_url" class="form-label">URL LinkedIn</label>
                            <input type="url" class="form-control" id="linkedin_url" name="linkedin_url"
                                placeholder="https://linkedin.com/in/username">
                        </div>

                        <!-- Champ Image -->
                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>

                    <!-- Pied du modal -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ajouter le Membre</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Edit Member Modal -->


        <div class="content p-5">
            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">

                            <!-- Section de Gestion des Services -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nom du Service</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $service)
                                                <tr>
                                                    <td>{{ $service->id }}</td>
                                                    <td>{{ $service->libelle }}</td>
                                                    <td>
                                                        @if ($service->image)
                                                            <img src="{{ asset('storage/' . $service->image) }}"
                                                                class="img-fluid rounded" style="width: 50px;"
                                                                data-toggle="modal"
                                                                data-target="#viewImageModal{{ $service->id }}">
                                                        @else
                                                            <span class="text-muted">Pas d'Image</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $service->description }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                            data-target="#editServiceModal{{ $service->id }}">Modifier</button>
                                                    </td>
                                                </tr>

                                                <!-- Modal pour Modifier le Service -->
                                                <div class="modal fade" id="editServiceModal{{ $service->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('update', $service->id) }}" method="POST"
                                                            enctype="multipart/form-data" class="modal-content">
                                                            @csrf
                                                            @method('PATCH') <!-- Utilisez PATCH pour une mise à jour -->
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Modifier le Service</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Fermer"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="editServiceImage{{ $service->id }}"
                                                                        class="form-label">Image</label>
                                                                    <input type="file" class="form-control"
                                                                        id="editServiceImage{{ $service->id }}"
                                                                        name="editServiceImage">
                                                                    @if ($service->image)
                                                                        <small class="text-muted">Image Actuelle :
                                                                            {{ $service->image }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-warning">Enregistrer
                                                                    les
                                                                    Modifications</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Modal pour Visualiser l'Image -->
                                                <div class="modal fade" id="viewImageModal{{ $service->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                @if ($service->image)
                                                                    <img src="{{ asset('storage/' . $service->image) }}"
                                                                        class="img-fluid rounded">
                                                                @else
                                                                    <p>Aucune Image Disponible</p>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script src="cssdste/jquery/jquery.min.js"></script>
        <script src="cssdste/bootstrap/js/bootstrap.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
        <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });


            $(document).ready(function() {
                $('.modal').on('hidden.bs.modal', function() {
                    $(this).find('form')[0].reset();
                });
            });
        </script>
    @endsection
