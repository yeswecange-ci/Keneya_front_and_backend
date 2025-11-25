<!-- Modal Ajouter Slide -->
<div id="addSlideModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <form action="{{ route('dashboard.accueil.slides.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ajouter une slide</h3>
                        <button type="button" onclick="document.getElementById('addSlideModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Numéro de slide *</label>
                                <input type="text" class="form-input" name="home_slide_number" required placeholder="Ex: 01, 02, 03...">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ordre d'affichage *</label>
                                <input type="number" class="form-input" name="home_slide_order" required min="1" value="1" placeholder="Ordre d'affichage">
                                <p class="text-xs text-muted mt-1">Plus le chiffre est bas, plus la slide apparaît en premier</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Titre *</label>
                            <textarea class="form-textarea" name="home_slide_title" rows="2" required placeholder="Titre de la slide (HTML autorisé)"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description *</label>
                            <textarea class="form-textarea" name="home_slide_description" rows="3" required placeholder="Description de la slide"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Image de fond *</label>
                            <input type="file" class="form-input" name="home_slide_image" accept="image/*" required>
                            <p class="text-xs text-muted mt-1">Formats acceptés: JPG, PNG, GIF (max: 2MB)</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">
                        Ajouter
                    </button>
                    <button type="button" onclick="document.getElementById('addSlideModal').classList.add('hidden')" class="btn-secondary">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Slide -->
<div id="editSlideModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <form id="editSlideForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Modifier la slide</h3>
                        <button type="button" onclick="document.getElementById('editSlideModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Numéro de slide *</label>
                                <input type="text" class="form-input" id="edit_home_slide_number" name="home_slide_number" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ordre d'affichage *</label>
                                <input type="number" class="form-input" id="edit_home_slide_order" name="home_slide_order" required min="1">
                                <p class="text-xs text-muted mt-1">Plus le chiffre est bas, plus la slide apparaît en premier</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Titre *</label>
                            <textarea class="form-textarea" id="edit_home_slide_title" name="home_slide_title" rows="2" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description *</label>
                            <textarea class="form-textarea" id="edit_home_slide_description" name="home_slide_description" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nouvelle image de fond (optionnel)</label>
                            <input type="file" class="form-input" name="home_slide_image" accept="image/*">
                            <p class="text-xs text-muted mt-1">Laissez vide pour conserver l'image actuelle</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">
                        Modifier
                    </button>
                    <button type="button" onclick="document.getElementById('editSlideModal').classList.add('hidden')" class="btn-secondary">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
