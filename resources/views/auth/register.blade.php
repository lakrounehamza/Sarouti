<script src="https://cdn.tailwindcss.com"></script>

<div class="flex items-center justify-center min-h-screen bg-gray-700">
    <div class="relative w-full max-w-md bg-white rounded-lg p-6 shadow-lg">

        <div class="flex items-center mb-2">
            <div class="flex flex-col items-center mr-4 ">
                <img src="images/logo.png" alt="Logo" class="w-18 h-16">
            </div>
            <div class="flex-grow text-center  ">
                <span class="  font-medium text-lg">Registration</span>
            </div>
            <button type="button" aria-label="Close" class="  absolute top-5  right-4 rounded-full border border-gray-300 p-1 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="w-full h-[0.15em] bg-black "></div>
        <form class="space-y-4">
            <div>
                <label for="email" class="block text-gray-700 mb-1 font-medium">Email</label>
                <input  type="email" id="email"  placeholder="Value" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
            </div>
            <div>
                <label for="name" class="block text-gray-700 mb-1 font-medium">Name</label>
                <input
                    type="text" id="name" placeholder="Value" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
            </div>
            <div class="relative">
                <label for="password" class="block text-gray-700 mb-1 font-medium">Password</label>
                <div class="relative">
                    <input type="password"
                        id="password" value="*********"  required  minlength="8" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                    <button
                        type="button" aria-label="Toggle password visibility" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
            </div>
            <div class="relative">
                <label for="confirmPassword" class="block text-gray-700 mb-1 font-medium">Confirm Password</label>
                <div class="relative">
                    <input
                        type="password" id="confirmPassword"  value="*********" required   minlength="8"  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                    <button
                        type="button" aria-label="Toggle password visibility" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <label for="role" class="block text-gray-700 mb-1 font-medium">Role</label>
                <select
                    id="role"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                    <option value="" disabled selected>Select a role</option>
                    <option value="client">Client</option>
                    <option value="seller">Seller</option>
                </select>
            </div>
            <button
                type="submit"
                class="w-full bg-yellow-400 hover:bg-black text-white py-3 rounded-full font-medium mt-6 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                Register
            </button>
        </form>
    </div>
</div>