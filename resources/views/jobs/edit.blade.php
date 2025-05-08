<x-layout>
    <x-slot:heading>
        Edit Job: {{ $job->title }}
    </x-slot:heading>

    <form method="POST" action="/jobs">
        @csrf

        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
    
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                  <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                  <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                      <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                        placeholder="Shift Leader" 
                        value="{{ $job->title }}"
                        required>
                    </div>

                    {{-- Error de validación --}}
                    @error('title') 
                      <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label for="salary" class="block text-sm/6 font-medium text-gray-900">Salary</label>
                  <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                      <input 
                        type="text" 
                        name="salary" 
                        id="salary" 
                        class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                        placeholder="$50,000 Per Year" 
                        value="{{ $job->salary }}"
                        required>
                    </div>

                    {{-- Error de validación --}}
                    @error('salary') 
                      <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
            </div>
          </div>
        </div>
      
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="/jobs/{{ $job->id }}" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
          <button type="submit" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white-700 bg-blue-300 border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150'">Update</button>
        </div>
      </form>
      
</x-layout>