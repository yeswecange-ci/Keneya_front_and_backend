<!-- Modal Ajouter Colonne -->
<div class="modal fade" id="addColumnModal" tabindex="-1" aria-labelledby="addColumnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addColumnModalLabel">Ajouter une colonne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.accueil.footer.columns.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Titre de la colonne</label>
                        <input type="text" class="form-control" name="column_title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" name="column_order" value="0" required>
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

<!-- Modal Modifier Colonne -->
<div class="modal fade" id="editColumnModal" tabindex="-1" aria-labelledby="editColumnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editColumnModalLabel">Modifier la colonne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editColumnForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Titre de la colonne</label>
                        <input type="text" class="form-control" name="column_title" id="edit_column_title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" name="column_order" id="edit_column_order" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ajouter Lien -->
<div class="modal fade" id="addLinkModal" tabindex="-1" aria-labelledby="addLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLinkModalLabel">Ajouter un lien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.accueil.footer.links.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Colonne</label>
                        <select class="form-control" name="footer_column_id" required>
                            <option value="">Sélectionner une colonne</option>
                            @foreach($footerColumns as $column)
                                <option value="{{ $column->id }}">{{ $column->column_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Texte du lien</label>
                        <input type="text" class="form-control" name="link_text" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL du lien</label>
                        <input type="text" class="form-control" name="link_url" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" name="link_order" value="0" required>
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

<!-- Modal Modifier Lien -->
<div class="modal fade" id="editLinkModal" tabindex="-1" aria-labelledby="editLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLinkModalLabel">Modifier le lien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editLinkForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Colonne</label>
                        <select class="form-control" id="edit_link_column_id" name="footer_column_id" required>
                            <option value="">Sélectionner une colonne</option>
                            @foreach($footerColumns as $column)
                                <option value="{{ $column->id }}">{{ $column->column_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Texte du lien</label>
                        <input type="text" class="form-control" id="edit_link_text" name="link_text" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL du lien</label>
                        <input type="text" class="form-control" id="edit_link_url" name="link_url" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" id="edit_link_order" name="link_order" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Gérer les liens -->
<div class="modal fade" id="manageLinksModal" tabindex="-1" aria-labelledby="manageLinksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageLinksModalLabel">Gérer les liens - <span id="current_column_title"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout de lien -->
                <div class="mb-4">
                    <h6>Ajouter un nouveau lien</h6>
                    <form action="{{ route('dashboard.accueil.footer.links.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="footer_column_id" id="quick_add_column_id">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Texte du lien</label>
                                    <input type="text" class="form-control" name="link_text" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">URL du lien</label>
                                    <input type="text" class="form-control" name="link_url" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Ordre</label>
                                    <input type="number" class="form-control" name="link_order" value="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-save"></i> Sauvegarder
                            </button>
                        </div>
                    </form>
                </div>

                <hr>

                <!-- Liste des liens existants -->
                <div class="mb-4">
                    <h6>Liens existants pour cette colonne</h6>
                    <div id="linksList">
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-link fa-2x mb-2"></i><br>
                            Les liens s'afficheront ici après ajout.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajouter Réseau Social -->
<div class="modal fade" id="addSocialModal" tabindex="-1" aria-labelledby="addSocialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSocialModalLabel">Ajouter un réseau social</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.accueil.footer.socials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Plateforme</label>
                        <input type="text" class="form-control" name="social_platform" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="url" class="form-control" name="social_url" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icône</label>
                        <input type="file" class="form-control" name="social_icon" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" name="social_order" value="0" required>
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

<!-- Modal Modifier Réseau Social -->
<div class="modal fade" id="editSocialModal" tabindex="-1" aria-labelledby="editSocialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSocialModalLabel">Modifier le réseau social</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSocialForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Plateforme</label>
                        <input type="text" class="form-control" name="social_platform" id="edit_social_platform" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="url" class="form-control" name="social_url" id="edit_social_url" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icône</label>
                        <input type="file" class="form-control" name="social_icon" accept="image/*">
                        <small class="text-muted">Laisser vide pour conserver l'icône actuelle</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" name="social_order" id="edit_social_order" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>