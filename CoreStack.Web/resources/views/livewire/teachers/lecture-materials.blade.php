<div class="p-6 bg-stone-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Lecture Materials</h1>
            <p class="text-sm text-gray-600">Manage and share resources with your students.</p>
        </div>

        <!-- Upload Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload New Material</h2>
            <form wire:submit.prevent="uploadMaterial" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="title" class="block text-sm font-medium text-gray-700">Material Title</label>
                    <input type="text" id="title" wire:model="title" 
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1A2B4C] focus:ring-[#1A2B4C] sm:text-sm" 
                        placeholder="e.g., Week 1: Intro to React">
                    @error('title') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="file" class="block text-sm font-medium text-gray-700">File (PDF, ZIP, DOCX)</label>
                    <input type="file" id="file" wire:model="file" 
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1A2B4C]/10 file:text-[#1A2B4C] hover:file:bg-[#1A2B4C]/20">
                    <div wire:loading wire:target="file" class="text-xs text-[#1A2B4C] mt-1">Uploading...</div>
                    @error('file') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <button type="submit" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#1A2B4C] hover:bg-[#2A3B5C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1A2B4C] transition-colors">
                        Upload Resource
                    </button>
                </div>
            </form>
        </div>

        <!-- Materials List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800">Available Materials</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resource Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded Date</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Introduction to Web Development</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#F0E68C]/30 text-[#D4AF37] capitalize">
                                    pdf
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 15, 2024</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-[#1A2B4C] hover:text-[#D4AF37] mr-4">Download</button>
                                <button onclick="confirm('Are you sure you want to delete this material?') || event.stopImmediatePropagation()"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Advanced JavaScript Concepts</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#F0E68C]/30 text-[#D4AF37] capitalize">
                                    zip
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 20, 2024</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-[#1A2B4C] hover:text-[#D4AF37] mr-4">Download</button>
                                <button onclick="confirm('Are you sure you want to delete this material?') || event.stopImmediatePropagation()"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
