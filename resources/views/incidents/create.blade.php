<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-10 flex items-center justify-between">
            <div>
                <a href="{{ route('incidents.index') }}" class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] hover:text-[#FFCC00] transition-colors flex items-center mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to List
                </a>
                <h1 class="text-4xl font-black text-white tracking-tight mb-2">Create Incident</h1>
                <p class="text-gray-500 font-medium italic">Phase 1: Manual incident reporting system</p>
            </div>
        </div>

        <div class="bg-[#1E2635] rounded-[32px] shadow-lg border border-[#2A3441] p-10 md:p-16">
            <form action="{{ route('incidents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Incident Title</label>
                        <input type="text" name="title" required placeholder="Short summary of the issue" 
                            class="w-full rounded-2xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold placeholder-gray-600 focus:ring-[#FFCC00] focus:border-[#FFCC00] py-4 px-6 shadow-sm transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Tracking Number</label>
                        <input type="text" name="tracking_number" placeholder="DHLXXXXXXXXX" 
                            class="w-full rounded-2xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold placeholder-gray-600 focus:ring-[#FFCC00] focus:border-[#FFCC00] py-4 px-6 shadow-sm transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Category</label>
                        <select name="category" required class="w-full rounded-2xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-4 px-6 shadow-sm transition-all">
                            <option value="" class="bg-[#141A25]">Select Category</option>
                            @foreach(['Late Delivery', 'Damaged Parcel', 'Missing Parcel', 'Address Issue', 'System Error', 'Customer Complaint'] as $cat)
                                <option value="{{ $cat }}" class="bg-[#141A25]">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Priority Level</label>
                        <select name="priority" required class="w-full rounded-2xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-4 px-6 shadow-sm transition-all">
                            <option value="" class="bg-[#141A25]">Select Priority</option>
                            @foreach(['Low', 'Medium', 'High', 'Critical'] as $priority)
                                <option value="{{ $priority }}" class="bg-[#141A25]">{{ $priority }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Description</label>
                    <textarea name="description" rows="6" required placeholder="Detailed description of the incident..." 
                        class="w-full rounded-[24px] border-[#2A3441] bg-[#141A25] text-white text-base font-bold placeholder-gray-600 focus:ring-[#FFCC00] focus:border-[#FFCC00] py-6 px-8 shadow-sm transition-all"></textarea>
                </div>

                <div class="space-y-4">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Attachment</label>
                    <div class="relative group">
                        <input type="file" name="attachment" id="file-upload" class="hidden" onchange="previewFile()">
                        <label for="file-upload" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-[#2A3441] rounded-[24px] cursor-pointer bg-[#141A25] group-hover:bg-[#FFCC00]/5 group-hover:border-[#FFCC00] transition-all overflow-hidden">
                            <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-600 group-hover:text-[#FFCC00] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-sm font-black text-gray-500 uppercase tracking-tight">Upload Evidence</p>
                                <p class="text-[10px] text-gray-600 font-bold mt-2 italic">Images, PDFs, or Docs</p>
                            </div>
                            <!-- Preview Container -->
                            <div id="file-preview" class="hidden absolute inset-0 w-full h-full bg-[#141A25] flex items-center justify-center p-4">
                                <div class="flex flex-col items-center">
                                    <img id="image-preview" src="#" alt="Preview" class="hidden h-32 w-auto rounded-xl shadow-lg border border-[#2A3441] mb-2">
                                    <div id="file-name" class="text-xs font-black text-[#FFCC00] uppercase tracking-widest text-center truncate max-w-[200px]"></div>
                                    <button type="button" onclick="resetUpload(event)" class="mt-2 text-[10px] font-black text-red-500 uppercase tracking-widest hover:text-red-400">Remove</button>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <script>
                    function previewFile() {
                        const file = document.getElementById('file-upload').files[0];
                        const preview = document.getElementById('file-preview');
                        const placeholder = document.getElementById('upload-placeholder');
                        const imgPreview = document.getElementById('image-preview');
                        const fileName = document.getElementById('file-name');

                        if (file) {
                            placeholder.classList.add('hidden');
                            preview.classList.remove('hidden');
                            fileName.textContent = file.name;

                            if (file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    imgPreview.src = e.target.result;
                                    imgPreview.classList.remove('hidden');
                                }
                                reader.readAsDataURL(file);
                            } else {
                                imgPreview.classList.add('hidden');
                            }
                        }
                    }

                    function resetUpload(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        document.getElementById('file-upload').value = '';
                        document.getElementById('file-preview').classList.add('hidden');
                        document.getElementById('upload-placeholder').classList.remove('hidden');
                        document.getElementById('image-preview').src = '#';
                    }
                </script>

                <div class="pt-10 border-t border-[#2A3441] flex flex-col md:flex-row items-center justify-between gap-6">
                    <button type="reset" class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] hover:text-[#FFCC00] transition-colors">Discard</button>
                    <button type="submit" class="w-full md:w-auto bg-[#FFCC00] text-black px-12 py-5 rounded-2xl font-black text-base shadow-xl hover:shadow-2xl transition-all transform hover:scale-[1.02] shadow-[#FFCC00]/10">
                        Create Incident
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
