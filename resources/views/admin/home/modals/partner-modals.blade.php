<!-- Modal Ajouter Partenaire -->
<div class="modal fade" id="addPartnerModal" tabindex="-1" aria-labelledby="addPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPartnerModalLabel">Ajouter un partenaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.accueil.partners.items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Image du partenaire</label>
                        <input type="file" class="form-control" name="home_partner_item_image" accept="image/*" required>
                        <small class="text-muted">Formats acceptés: JPEG, PNG, JPG, GIF, SVG. Max: 2MB</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Texte alternatif</label>
                        <input type="text" class="form-control" name="home_partner_item_alt"
                               placeholder="Nom du partenaire">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" name="home_partner_item_order" value="0" required>
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

<!-- Modal Modifier Partenaire -->
<div class="modal fade" id="editPartnerModal" tabindex="-1" aria-labelledby="editPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPartnerModalLabel">Modifier le partenaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPartnerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Image du partenaire</label>
                        <input type="file" class="form-control" name="home_partner_item_image" accept="image/*">
                        <small class="text-muted">Laisser vide pour conserver l'image actuelle</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Texte alternatif</label>
                        <input type="text" class="form-control" name="home_partner_item_alt"
                               id="edit_home_partner_item_alt">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" name="home_partner_item_order"
                               id="edit_home_partner_item_order" required>
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
