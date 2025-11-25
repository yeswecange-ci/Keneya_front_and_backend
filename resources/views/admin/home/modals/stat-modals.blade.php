<!-- Modal Ajouter Statistique -->
<div id="addStatModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('dashboard.accueil.stats.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ajouter une statistique</h3>
                        <button type="button" onclick="document.getElementById('addStatModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Nombre/Chiffre *</label>
                                <input type="text" class="form-input" name="home_stat_number" required placeholder="Ex: 500+, 10K, 95%...">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ordre d'affichage *</label>
                                <input type="number" class="form-input" name="home_stat_order" required min="1" value="1" placeholder="Ordre">
                                <p class="text-xs text-muted mt-1">Ordre d'apparition</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description *</label>
                            <textarea class="form-textarea" name="home_stat_description" rows="2" required placeholder="Description de la statistique"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Icône *</label>
                            <input type="file" class="form-input" name="home_stat_icon" accept="image/*" required>
                            <p class="text-xs text-muted mt-1">Formats acceptés: JPG, PNG, GIF, SVG (max: 1MB)</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">
                        Ajouter
                    </button>
                    <button type="button" onclick="document.getElementById('addStatModal').classList.add('hidden')" class="btn-secondary">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Statistique -->
<div id="editStatModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="editStatForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Modifier la statistique</h3>
                        <button type="button" onclick="document.getElementById('editStatModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Nombre/Chiffre *</label>
                                <input type="text" class="form-input" id="edit_home_stat_number" name="home_stat_number" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ordre d'affichage *</label>
                                <input type="number" class="form-input" id="edit_home_stat_order" name="home_stat_order" required min="1">
                                <p class="text-xs text-muted mt-1">Ordre d'apparition</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description *</label>
                            <textarea class="form-textarea" id="edit_home_stat_description" name="home_stat_description" rows="2" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nouvelle icône (optionnel)</label>
                            <input type="file" class="form-input" name="home_stat_icon" accept="image/*">
                            <p class="text-xs text-muted mt-1">Laissez vide pour conserver l'icône actuelle</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">
                        Modifier
                    </button>
                    <button type="button" onclick="document.getElementById('editStatModal').classList.add('hidden')" class="btn-secondary">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
