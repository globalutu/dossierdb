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
    <div class="container mt-5">
        <h3 class="text-center">Partage de Fichiers</h3>
        <!-- Bouton pour ouvrir la modale -->
        <div class="text-center mt-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fileModal">Partager un Fichier</button>
        </div>

        <!-- Modale -->
        <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fileModalLabel">Partager un Fichier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="sendForm">
                            <!-- Upload files -->
                            <div class="mb-3">
                                <label for="fileInput" class="form-label">Choisir un fichier</label>
                                <input type="file" id="fileInput" class="form-control" multiple>
                            </div>

                            <!-- User select -->
                            <div class="mb-3">
                                <label for="userSelect" class="form-label">Partager avec</label>
                                <select id="userSelect" class="form-select" multiple>
                                    <option value="user1">Utilisateur 1</option>
                                    <option value="user2">Utilisateur 2</option>
                                    <option value="user3">Utilisateur 3</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" id="submitButton">Partager</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des fichiers partagés -->
        <div class="mt-5">
            <h4>Fichiers Partagés</h4>
            <ul id="fileList" class="list-group">
                <!-- Les fichiers partagés apparaîtront ici -->
            </ul>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const fileInput = document.getElementById('fileInput');
        const userSelect = document.getElementById('userSelect');
        const fileList = document.getElementById('fileList');
        const submitButton = document.getElementById('submitButton');

        // Ajouter les fichiers partagés à la liste
        submitButton.addEventListener('click', () => {
            const files = Array.from(fileInput.files);
            const selectedUsers = Array.from(userSelect.selectedOptions).map(option => option.text);

            if (files.length === 0 || selectedUsers.length === 0) {
                alert('Veuillez sélectionner au moins un fichier et un utilisateur.');
                return;
            }

            files.forEach(file => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                listItem.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <span>${file.name}</span>
                        <small>Partagé avec : ${selectedUsers.join(', ')}</small>
                    </div>
                `;
                fileList.appendChild(listItem);
            });

            // Réinitialiser le formulaire et fermer la modale
            fileInput.value = '';
            userSelect.value = '';
            const modal = bootstrap.Modal.getInstance(document.getElementById('fileModal'));
            modal.hide();
        });
    </script>
@endsection
