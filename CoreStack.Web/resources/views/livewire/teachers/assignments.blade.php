<div>

    <h2 class="text-2xl font-bold mb-6 text-stone-800">Create New Assignment</h2>

    <div class="mb-8 p-6 bg-white rounded-xl shadow-md border border-stone-100">
        <form wire:submit.prevent="createAssignment">
            <div class="mb-4">
                <label for="course_id" class="block text-sm font-medium text-stone-700 mb-2">Select Course</label>
                <select id="course_id" wire:model="course_id"
                        class="block w-full px-4 py-2 border border-stone-300 rounded-lg shadow-sm focus:ring-gold focus:border-gold sm:text-sm">
                    <option value="">-- Select a Course --</option>
                    {{-- Example static options; these would typically be dynamic from a database --}}
                    <option value="1">Advanced Web Development (CSC 401)</option>
                    <option value="2">Data Structures and Algorithms (CSC 305)</option>
                    <option value="3">Introduction to AI (CSC 405)</option>
                </select>
                @error('course_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-stone-700 mb-2">Assignment Title</label>
                <input type="text" id="title" wire:model="title" placeholder="e.g., Final Project - E-commerce API"
                       class="block w-full px-4 py-2 border border-stone-300 rounded-lg shadow-sm focus:ring-gold focus:border-gold sm:text-sm">
                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-stone-700 mb-2">Assignment Description</label>
                <textarea id="description" wire:model="description" rows="5" placeholder="Provide detailed instructions for the assignment..."
                          class="block w-full px-4 py-2 border border-stone-300 rounded-lg shadow-sm focus:ring-gold focus:border-gold sm:text-sm"></textarea>
                @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="due_date" class="block text-sm font-medium text-stone-700 mb-2">Due Date</label>
                <input type="date" id="due_date" wire:model="due_date"
                       class="block w-full px-4 py-2 border border-stone-300 rounded-lg shadow-sm focus:ring-gold focus:border-gold sm:text-sm">
                @error('due_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    class="w-full bg-black text-white py-3 px-4 rounded-lg font-semibold hover:bg-gray-800 transition duration-200 ease-in-out shadow-md">
                Create Assignment
            </button>
        </form>
    </div>

    <h2 class="text-2xl font-bold mb-4 text-stone-800">Assignments Overview</h2>

    <!-- Static Course Example -->
    <div class="mb-8 p-4 border rounded-lg shadow-sm">
        <h3 class="text-xl font-semibold mb-2">Advanced Web Development</h3>
        <p class="text-gray-600 mb-4">Mastering modern frameworks and backend integration.</p>

        {{-- Add a button to add a new assignment for this course --}}
        <div class="flex justify-end mb-4">
            <button class="bg-gold text-darkblue py-2 px-4 rounded-lg text-sm font-semibold hover:bg-yellow-500 transition duration-200 ease-in-out">
                Add New Assignment
            </button>
        </div>

        <!-- Static Assignment Example -->
        <div class="mb-6 p-3 border-l-4 border-blue-500 bg-blue-50 rounded-r-lg">
            <h4 class="text-lg font-medium">Final Project - E-commerce API</h4>
            <p class="text-sm text-gray-700 mb-2">Build a robust RESTful API using Laravel and Sanctum.</p>
            <p class="text-xs text-gray-500">Due: Dec 15, 2025 23:59</p>

            <div class="mt-3">
                <h5 class="font-semibold mb-2">Submissions:</h5>
                <ul class="list-disc pl-5">
                    <!-- Static Submission 1 -->
                    <li class="mb-1">
                        <span class="font-medium">John Doe</span>:
                        Submitted on Dec 10, 2025 14:20
                        <a href="#" class="text-blue-600 hover:underline ml-2">Download</a>
                        <span class="ml-2 text-green-600">Grade: 95/100</span>
                    </li>

                    <!-- Static Submission 2 -->
                    <li class="mb-1">
                        <span class="font-medium">Jane Smith</span>:
                        Submitted on Dec 11, 2025 09:45
                        <a href="#" class="text-blue-600 hover:underline ml-2">Download</a>
                        <span class="ml-2 text-yellow-600">Not Graded</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
 