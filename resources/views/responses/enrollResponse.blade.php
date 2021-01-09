<x-app-layout>
    <div class="p-2">
        <div class="p-4">
                <h3 class="lg:text-2xl font-bold text-yellow-600 text-center">{{ $message }}</h3>
        </div>
        <div class="p-2 flex justify-center">
            <button class="h-10 px-6 text-base text-yellow-600 transition-colors duration-150 bg-white rounded-lg focus:shadow-outline hover:bg-yellow-200">
                <a href="/user">Back To Profile</a>
            </button>
        </div>
    </div>
</x-app-layout>
