<!-- Add Testimonial Modal -->
<div x-show="testimonialModal && !editMode"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;"
     @open-testimonial-modal.window="testimonialModal = true; editMode = false">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="testimonialModal = false"></div>

        <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Ajouter un témoignage</h3>
                <button @click="testimonialModal = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('activities.store-testimonial') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="form-group">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="activities_testimonial_title" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="activities_testimonial_description" class="form-textarea" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" name="activities_testimonial_image" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Formats acceptés: JPEG, PNG, JPG, GIF. Max: 2MB</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Lien</label>
                    <input type="url" name="activities_testimonial_link" class="form-input" placeholder="https://exemple.com">
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="btn-secondary" @click="testimonialModal = false">Annuler</button>
                    <button type="submit" class="btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Testimonial Modal -->
<div x-show="testimonialModal && editMode"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;"
     @open-testimonial-modal.window="testimonialModal = true; editMode = true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="testimonialModal = false; editMode = false"></div>

        <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Modifier le témoignage</h3>
                <button @click="testimonialModal = false; editMode = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="editTestimonialForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="activities_testimonial_title" id="edit_testimonial_title" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="activities_testimonial_description" id="edit_testimonial_description" class="form-textarea" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" name="activities_testimonial_image" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Laisser vide pour conserver l'image actuelle</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Lien</label>
                    <input type="url" name="activities_testimonial_link" id="edit_testimonial_link" class="form-input" placeholder="https://exemple.com">
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="btn-secondary" @click="testimonialModal = false; editMode = false">Annuler</button>
                    <button type="submit" class="btn-success">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
