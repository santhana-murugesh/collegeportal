<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $enquiry->subject }}
            </h2>
            @if(auth()->user()->isAdminOrStaff())
                <a href="{{ route('enquiries.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to Enquiries
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Enquiry Meta Information -->
                    <div class="mb-6 pb-4 border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">From</h3>
                                <p class="text-sm text-gray-900">{{ $enquiry->name }}</p>
                                <p class="text-sm text-gray-500">{{ $enquiry->email }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Status</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $enquiry->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($enquiry->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst(str_replace('_', ' ', $enquiry->status)) }}
                                </span>
                                <p class="text-sm text-gray-500 mt-1">{{ $enquiry->created_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Enquiry Subject -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Subject</h3>
                        <p class="text-gray-700">{{ $enquiry->subject }}</p>
                    </div>

                    <!-- Enquiry Message -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Message</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="whitespace-pre-wrap text-gray-700">{{ $enquiry->message }}</div>
                        </div>
                    </div>

                    <!-- Status Update (Admin and Staff Only) -->
                    @if(auth()->user()->isAdminOrStaff())
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status</h3>
                            <form method="POST" action="{{ route('enquiries.update-status', $enquiry) }}" class="space-y-4">
                                @csrf
                                @method('PATCH')
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="pending" {{ $enquiry->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ $enquiry->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ $enquiry->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    </select>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Update Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 