<!-- Modal Ajouter Colonne -->
<div id="addColumnModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('dashboard.accueil.footer.columns.store') }}" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ajouter une colonne</h3>
                        <button type="button" onclick="document.getElementById('addColumnModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Titre de la colonne</label>
                            <input type="text" class="form-input" name="column_title" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" class="form-input" name="column_order" value="0" required>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">Ajouter</button>
                    <button type="button" onclick="document.getElementById('addColumnModal').classList.add('hidden')" class="btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Colonne -->
<div id="editColumnModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="editColumnForm" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Modifier la colonne</h3>
                        <button type="button" onclick="document.getElementById('editColumnModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Titre de la colonne</label>
                            <input type="text" class="form-input" name="column_title" id="edit_column_title" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" class="form-input" name="column_order" id="edit_column_order" required>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">Modifier</button>
                    <button type="button" onclick="document.getElementById('editColumnModal').classList.add('hidden')" class="btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ajouter Lien -->
<div id="addLinkModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('dashboard.accueil.footer.links.store') }}" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ajouter un lien</h3>
                        <button type="button" onclick="document.getElementById('addLinkModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Colonne</label>
                            <select class="form-select" name="footer_column_id" required>
                                <option value="">Sélectionner une colonne</option>
                                @foreach($footerColumns as $column)
                                    <option value="{{ $column->id }}">{{ $column->column_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Texte du lien</label>
                            <input type="text" class="form-input" name="link_text" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">URL du lien</label>
                            <input type="text" class="form-input" name="link_url" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" class="form-input" name="link_order" value="0" required>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">Ajouter</button>
                    <button type="button" onclick="document.getElementById('addLinkModal').classList.add('hidden')" class="btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Lien -->
<div id="editLinkModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="editLinkForm" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Modifier le lien</h3>
                        <button type="button" onclick="document.getElementById('editLinkModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Colonne</label>
                            <select class="form-select" id="edit_link_column_id" name="footer_column_id" required>
                                <option value="">Sélectionner une colonne</option>
                                @foreach($footerColumns as $column)
                                    <option value="{{ $column->id }}">{{ $column->column_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Texte du lien</label>
                            <input type="text" class="form-input" id="edit_link_text" name="link_text" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">URL du lien</label>
                            <input type="text" class="form-input" id="edit_link_url" name="link_url" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" class="form-input" id="edit_link_order" name="link_order" required>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">Modifier</button>
                    <button type="button" onclick="document.getElementById('editLinkModal').classList.add('hidden')" class="btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Gérer les liens -->
<div id="manageLinksModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Gérer les liens - <span id="current_column_title"></span></h3>
                    <button type="button" onclick="document.getElementById('manageLinksModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Formulaire d'ajout de lien -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h6 class="font-semibold text-gray-900 mb-3">Ajouter un nouveau lien</h6>
                    <form action="{{ route('dashboard.accueil.footer.links.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="footer_column_id" id="quick_add_column_id">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div class="form-group">
                                <label class="form-label">Texte du lien</label>
                                <input type="text" class="form-input" name="link_text" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">URL du lien</label>
                                <input type="text" class="form-input" name="link_url" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ordre</label>
                                <input type="number" class="form-input" name="link_order" value="0" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-success mt-3">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Sauvegarder
                        </button>
                    </form>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <h6 class="font-semibold text-gray-900 mb-3">Liens existants pour cette colonne</h6>
                    <div id="linksList" class="text-center text-muted py-8">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                        <p class="text-gray-500">Les liens s'afficheront ici après ajout.</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6">
                <button type="button" onclick="document.getElementById('manageLinksModal').classList.add('hidden')" class="btn-secondary">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajouter Réseau Social -->
<div id="addSocialModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('dashboard.accueil.footer.socials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ajouter un réseau social</h3>
                        <button type="button" onclick="document.getElementById('addSocialModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Plateforme</label>
                            <input type="text" class="form-input" name="social_platform" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">URL</label>
                            <input type="url" class="form-input" name="social_url" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Icône</label>
                            <input type="file" class="form-input" name="social_icon" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" class="form-input" name="social_order" value="0" required>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">Ajouter</button>
                    <button type="button" onclick="document.getElementById('addSocialModal').classList.add('hidden')" class="btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Réseau Social -->
<div id="editSocialModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="editSocialForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Modifier le réseau social</h3>
                        <button type="button" onclick="document.getElementById('editSocialModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Plateforme</label>
                            <input type="text" class="form-input" name="social_platform" id="edit_social_platform" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">URL</label>
                            <input type="url" class="form-input" name="social_url" id="edit_social_url" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Icône</label>
                            <input type="file" class="form-input" name="social_icon" accept="image/*">
                            <p class="text-xs text-muted mt-1">Laisser vide pour conserver l'icône actuelle</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" class="form-input" name="social_order" id="edit_social_order" required>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                    <button type="submit" class="btn-primary">Modifier</button>
                    <button type="button" onclick="document.getElementById('editSocialModal').classList.add('hidden')" class="btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
