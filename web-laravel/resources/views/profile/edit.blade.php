<x-app-layout>
    <div class="mb-10">
        <h1 class="text-4xl font-black text-white tracking-tight mb-2">My Profile</h1>
        <p class="text-gray-400 font-medium italic">Manage your account information and security</p>
    </div>

    <div class="space-y-8">
        <div class="p-8 sm:p-12 bg-[#1E2635] shadow-lg rounded-[32px] border border-[#2A3441]">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-8 sm:p-12 bg-[#1E2635] shadow-lg rounded-[32px] border border-[#2A3441]">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-8 sm:p-12 bg-[#1E2635] shadow-lg rounded-[32px] border border-[#2A3441]">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
