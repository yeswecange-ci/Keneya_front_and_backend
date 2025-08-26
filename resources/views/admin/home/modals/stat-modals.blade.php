<!-- Modal Ajouter Statistique -->
<div class="modal fade" id="addStatModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une statistique</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('dashboard.accueil.stats.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre/Chiffre *</label>
                                <input type="text" class="form-control" name="home_stat_number" required
                                       placeholder="Ex: 500+, 10K, 95%...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ordre d'affichage *</label>
                                <input type="number" class="form-control" name="home_stat_order" required
                                       min="1" value="1" placeholder="Ordre">
                                <small class="form-text text-muted">Ordre d'apparition</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea class="form-control" name="home_stat_description" rows="2" required
                                  placeholder="Description de la statistique"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Icône *</label>
                        <input type="file" class="form-control" name="home_stat_icon" accept="image/*" required>
                        <small class="form-text text-muted">Formats acceptés: JPG, PNG, GIF, SVG (max: 1MB)</small>
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

<!-- Modal Modifier Statistique -->
<div class="modal fade" id="editStatModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la statistique</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editStatForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre/Chiffre *</label>
                                <input type="text" class="form-control" id="edit_home_stat_number" name="home_stat_number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ordre d'affichage *</label>
                                <input type="number" class="form-control" id="edit_home_stat_order" name="home_stat_order" required
                                       min="1" placeholder="Ordre">
                                <small class="form-text text-muted">Ordre d'apparition</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea class="form-control" id="edit_home_stat_description" name="home_stat_description" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nouvelle icône (optionnel)</label>
                        <input type="file" class="form-control" name="home_stat_icon" accept="image/*">
                        <small class="form-text text-muted">Laissez vide pour conserver l'icône actuelle</small>
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
