<!-- Modal Ajouter Slide -->
<div class="modal fade" id="addSlideModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('dashboard.accueil.slides.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Numéro de slide *</label>
                                <input type="text" class="form-control" name="home_slide_number" required
                                       placeholder="Ex: 01, 02, 03...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ordre d'affichage *</label>
                                <input type="number" class="form-control" name="home_slide_order" required
                                       min="1" value="1" placeholder="Ordre d'affichage">
                                <small class="form-text text-muted">Plus le chiffre est bas, plus la slide apparaît en premier</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Titre *</label>
                        <textarea class="form-control" name="home_slide_title" rows="2" required
                                  placeholder="Titre de la slide (HTML autorisé)"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea class="form-control" name="home_slide_description" rows="3" required
                                  placeholder="Description de la slide"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image de fond *</label>
                        <input type="file" class="form-control" name="home_slide_image" accept="image/*" required>
                        <small class="form-text text-muted">Formats acceptés: JPG, PNG, GIF (max: 2MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Slide -->
<!-- Modal Modifier Slide -->
<div class="modal fade" id="editSlideModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editSlideForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Numéro de slide *</label>
                                <input type="text" class="form-control" id="edit_home_slide_number" name="home_slide_number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ordre d'affichage *</label>
                                <input type="number" class="form-control" id="edit_home_slide_order" name="home_slide_order" required
                                       min="1" placeholder="Ordre d'affichage">
                                <small class="form-text text-muted">Plus le chiffre est bas, plus la slide apparaît en premier</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Titre *</label>
                        <textarea class="form-control" id="edit_home_slide_title" name="home_slide_title" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea class="form-control" id="edit_home_slide_description" name="home_slide_description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nouvelle image de fond (optionnel)</label>
                        <input type="file" class="form-control" name="home_slide_image" accept="image/*">
                        <small class="form-text text-muted">Laissez vide pour conserver l'image actuelle</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-warning">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
