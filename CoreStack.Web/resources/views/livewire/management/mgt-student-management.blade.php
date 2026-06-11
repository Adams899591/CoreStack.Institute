<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <!-- Header Section -->
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-xl leading-6 font-bold text-gray-900">
                    Student Management
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Complete the form below to register or update student information.
                </p>
            </div>

            <!-- Form Section -->
            <form wire:submit.prevent="saveStudent" class="p-6">
                <!-- Personal Information -->
                <h4 class="text-sm font-bold text-gold uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Personal Information</h4>
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div>
                        <label for="student_name" class="block text-sm font-medium text-gray-700">Common Name (Display Name)</label>
                        <div class="mt-1">
                            <input type="text" name="student_name" id="student_name" wire:model="studentName" autocomplete="name"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('studentName') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="legal_name" class="block text-sm font-medium text-gray-700">Legal Name</label>
                        <div class="mt-1">
                            <input type="text" name="legal_name" id="legal_name" wire:model="legalName"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('legalName') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <div class="mt-1">
                            <input type="date" name="dob" id="dob" wire:model="dateOfBirth"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('dateOfBirth') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <div class="mt-1">
                            <select id="gender" name="gender" wire:model="gender"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gold focus:border-gold sm:text-sm rounded-md shadow-sm">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        @error('gender') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
                        <div class="mt-1">
                            <input type="text" name="nationality" id="nationality" wire:model="nationality"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('nationality') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="state_of_origin" class="block text-sm font-medium text-gray-700">State of Origin</label>
                        <div class="mt-1">
                            <input type="text" name="state_of_origin" id="state_of_origin" wire:model="stateOfOrigin"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('stateOfOrigin') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="marital_status" class="block text-sm font-medium text-gray-700">Marital Status</label>
                        <div class="mt-1">
                            <select id="marital_status" name="marital_status" wire:model="maritalStatus"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gold focus:border-gold sm:text-sm rounded-md shadow-sm">
                                <option value="">Select Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                        @error('maritalStatus') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Contact Information -->
                <h4 class="text-sm font-bold text-gold uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Contact Information</h4>
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8 mb-8">
                    <div>
                        <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="mt-1">
                            <input type="email" name="email_address" id="email_address" wire:model="emailAddress" autocomplete="email"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('emailAddress') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                        <div class="mt-1">
                            <input type="tel" name="mobile_number" id="mobile_number" wire:model="mobileNumber"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('mobileNumber') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Residential Address</label>
                        <div class="mt-1">
                            <textarea id="address" name="address" rows="3" wire:model="residentialAddress"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                        @error('residentialAddress') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Academic Information -->
                <h4 class="text-sm font-bold text-gold uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Academic Information</h4>
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div>
                        <label for="faculty" class="block text-sm font-medium text-gray-700">Faculty</label>
                        <div class="mt-1">
                            <input type="text" name="faculty" id="faculty" wire:model="faculty"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('faculty') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700">Program / Department</label>
                        <div class="mt-1">
                            <select id="department" name="department" wire:model="departmentId"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gold focus:border-gold sm:text-sm rounded-md shadow-sm">
                                <option value="">Select Department</option>
                                <option value="1">Web Development</option>
                                <option value="2">Cyber Security</option>
                                <option value="3">Data Science</option>
                            </select>
                        </div>
                        @error('departmentId') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                        <div class="mt-1">
                            <select id="level" name="level" wire:model="level"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gold focus:border-gold sm:text-sm rounded-md shadow-sm">
                                <option value="">Select Level</option>
                                <option value="100">100 Level</option>
                                <option value="200">200 Level</option>
                                <option value="300">300 Level</option>
                                <option value="400">400 Level</option>
                                <option value="500">500 Level</option>
                            </select>
                        </div>
                        @error('level') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="enrollment_date" class="block text-sm font-medium text-gray-700">Enrollment Date</label>
                        <div class="mt-1">
                            <input type="date" name="enrollment_date" id="enrollment_date" wire:model="enrollmentDate"
                                class="shadow-sm focus:ring-gold focus:border-gold block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('enrollmentDate') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold">
                            Cancel
                        </button>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-darkblue hover:bg-darkblue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
