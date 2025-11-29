<!-- Modal Ajouter Partenaire -->
<div id="addPartnerModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('dashboard.accueil.partners.items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ajouter un partenaire</h3>
                        <button type="button" onclick="document.getElementById('addPartnerModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Image du partenaire *</label>
                            <input type="file" class="form-input" name="home_partner_item_image" accept="image/*" required>
                            <p class="text-xs text-muted mt-1">Formats acceptés: JPEG, PNG, JPG, GIF, SVG. Max: 2MB</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Texte alternatif</label>
                            <input type="text" class="form-input" name="home_partner_item_alt" placeholder="Nom du partenaire">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" class="form-input" name="home_partner_item_order" value="0" required>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">
                        Ajouter
                    </button>
                    <button type="button" onclick="document.getElementById('addPartnerModal').classList.add('hidden')" class="btn-secondary">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Partenaire -->
<div id="editPartnerModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="editPartnerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Modifier le partenaire</h3>
                        <button type="button" onclick="document.getElementById('editPartnerModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Image du partenaire</label>
                            <input type="file" class="form-input" name="home_partner_item_image" accept="image/*">
                            <p class="text-xs text-muted mt-1">Laisser vide pour conserver l'image actuelle</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Texte alternatif</label>
                            <input type="text" class="form-input" name="home_partner_item_alt" id="edit_home_partner_item_alt">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" class="form-input" name="home_partner_item_order" id="edit_home_partner_item_order" required>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">
                        Modifier
                    </button>
                    <button type="button" onclick="document.getElementById('editPartnerModal').classList.add('hidden')" class="btn-secondary">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
