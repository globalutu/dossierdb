@extends('templatedste._temp')

@section('css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>Tableau de bord</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="style.css">
@endsection

@section('content')
    <div class="container mt-4">
        <!-- Header Section -->
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Tableau de bord Dashfront</h1>
        </header>

        <!-- Buttons Section -->
        <div class="btn-group mb-4 w-100" role="group">
            <button class="btn btn-info" data-toggle="modal" data-target="#newsletterModal">View Newsletters</button>
            <button class="btn btn-success" data-toggle="modal" data-target="#editContactModal">Edit Contact</button>
            <button class="btn btn-warning" data-toggle="modal" data-target="#contentEditorModal">Éditeur de
                Contenu</button>

            <!-- Modal Éditeur de Contenu -->
            <div class="modal fade" id="contentEditorModal" tabindex="-1" role="dialog"
                aria-labelledby="contentEditorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contentEditorModalLabel">Modifier le Contenu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('content.update', $Contents->id ?? '') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Titre -->
                                <div class="form-group">
                                    <label for="contentTitle">Titre du Contenu :</label>
                                    <input type="text" name="titre" id="contentTitle" class="form-control"
                                        value="{{ $Contents->titre ?? '' }}" placeholder="Titre du contenu">
                                </div>

                                <!-- Contenu -->
                                <div class="form-group">
                                    <label for="contentBody">Contenu :</label>
                                    <textarea name="content" id="contentBody" rows="5" class="form-control"
                                        placeholder="Ajoutez ou modifiez le contenu ici...">{{ $Contents->content ?? '' }}</textarea>
                                </div>

                                <!-- Ancienne Image -->
                                <div class="form-group">
                                    <label>Image actuelle :</label>
                                    @if (!empty($Contents->image))
                                        <div class="img-border">
                                            <img class="img-fluid" src="{{ asset('storage/' . $Contents->image) }}"
                                                alt="Image actuelle" style="max-width: 100%;">
                                        </div>
                                    @else
                                        <p>Aucune image existante.</p>
                                    @endif
                                </div>

                                <!-- Nouvelle Image -->
                                <div class="form-group">
                                    <label for="contentImage">Nouvelle Image :</label>
                                    <input type="file" name="image" id="contentImage" class="form-control-file">
                                </div>

                                <!-- Bouton Enregistrer -->
                                <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                    <form action="{{ route('contacts.update', $contact->id) }}" method="POST" enctype="multipart/form-data"
                        class="modal-content">
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
        </div>

        <!-- Main Content -->
        <main>
            <!-- Services Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-white text-center py-4">
                            <h2 class="h3 font-weight-bold">Nos Services</h2>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
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

                                        <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="{{ route('update', $service->id) }}" method="POST"
                                                    enctype="multipart/form-data" class="modal-content">
                                                    @csrf
                                                    @method('PATCH') <!-- Utilisez PATCH pour une mise à jour -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modifier le Service</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Fermer"><span
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



                                        <div class="modal fade" id="viewImageModal{{ $service->id }}" tabindex="-1">
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

            <!-- Testimonials Section -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h2 class="h3 font-weight-bold"><i class="bi bi-chat-left-quote"></i> Témoignages</h2>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <button class="btn btn-primary" data-toggle="modal"
                                    data-target="#addTestimonialModal">Ajouter un Témoignage</button>
                            </div>
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
                                                        class="img-fluid rounded" style="width: 50px;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewImageModal{{ $testimonial->id }}">
                                                @else
                                                    <span class="text-muted">Pas d'image</span>
                                                @endif

                                            </td>
                                            <td>{{ $testimonial->testimonialText }}</td>
                                            <td>

                                                <form action="{{ route('testimonials.destroy', $testimonial->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger delete-btn">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="viewImageModal{{ $testimonial->id }}"
                                            tabindex="-1">
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
                        <div class="modal fade" id="addTestimonialModal" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('testimonials.store') }}" method="POST"
                                    enctype="multipart/form-data" class="modal-content">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ajouter un Nouveau Témoignage</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
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
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Management Section -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header  text-white text-center py-4 " style="background-color: #8a2be2;">
                            <h2 class="h3 font-weight-bold">Gérer les Membres de l'Équipe</h2>
                        </div>
                        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMemberModal">Ajouter un
                            Nouveau Membre</button>
                        <div class="card-body">
                            <h5 class="card-title mb-3"><i class="bi bi-person"></i> Membres de l'Équipe</h5>
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
                                                    <img src="{{ asset('storage/' . $member->image) }}"
                                                        class="img-fluid rounded" style="width: 50px;"
                                                        data-toggle="modal"
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                                            <input type="url" class="form-control" id="facebook_url"
                                                name="facebook_url" placeholder="https://facebook.com/username">
                                        </div>

                                        <!-- Lien Twitter -->
                                        <div class="form-group">
                                            <label for="twitter_url" class="form-label">URL Twitter</label>
                                            <input type="url" class="form-control" id="twitter_url"
                                                name="twitter_url" placeholder="https://twitter.com/username">
                                        </div>

                                        <!-- Lien LinkedIn -->
                                        <div class="form-group">
                                            <label for="linkedin_url" class="form-label">URL LinkedIn</label>
                                            <input type="url" class="form-control" id="linkedin_url"
                                                name="linkedin_url" placeholder="https://linkedin.com/in/username">
                                        </div>

                                        <!-- Champ Image -->
                                        <div class="form-group">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control-file" id="image"
                                                name="image">
                                        </div>
                                    </div>

                                    <!-- Pied du modal -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Ajouter le Membre</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Fermer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-4 text-center">
            <p class="text-muted">&copy; 2025 Dashfront. All rights reserved.</p>
        </footer>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

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
        }); <
        script src = "https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js" >
    </script>

    </script>
    <script>
        // Initialisation de CKEditor
        CKEDITOR.replace('editorContent');
    </script>
@endsection
