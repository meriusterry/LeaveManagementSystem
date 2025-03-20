<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Leave Management') }}
        </h2>
    </x-slot>

    <body class="bg-gray-100">
        <div class="max-w-7xl mx-auto py-0 px-0">
            <div class="px-2 py-0 sm:px-0">

                <div class="flex justify-end pt-4">
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 mt-0">
                        <div class="bg-blue-500 text-white rounded-lg p-2 shadow-sm">
                            <div class="text-md font-semibold">Total Leaves</div>
                            <div class="text-md font-bold">{{ $total }}</div>
                        </div>
                        <div class="bg-orange-500 text-white rounded-lg p-2 shadow-sm">
                            <div class="text-md font-semibold">Pending Leaves</div>
                            <div class="text-md font-bold"> {{ $pendingapproval }}</div>
                        </div>
                        <div class="bg-green-500 text-white rounded-lg p-2 shadow-sm">
                            <div class="text-md font-semibold">Approved Leaves</div>
                            <div class="text-md font-bold">{{ $approved }}</div>
                        </div>
                        <div class="bg-red-500 text-white rounded-lg p-2 shadow-sm">
                            <div class="text-md font-semibold">Declined Leaves</div>
                            <div class="text-md font-bold">{{ $declined }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-2"></div>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-300">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Employee#</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Employee Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Leave Type</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Duration</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Applied on</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Action</th>

                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">View</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($tableData as $data)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                    {{ $data->user_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="flex justify-center mb-1">
                                            <img class="h-10 w-10 rounded-full"src="{{ asset('images/logo.png') }}"
                                                alt="Logo" class="w-40">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-500">
                                                {{ $data->user->firstName }} {{ $data->user->surname }} </div>
                                                {{ $data->user->position }} 
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $data->leave_types }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $data->start_date }} -> {{ $data->end_date }} <br />
                                    {{ $data->date_difference }} day(s)</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $data->created_at }} <br>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $data->status == 'Approved' ? 'bg-green-400 text-green-800' : 
                                       ($data->status == 'Declined' ? 'bg-red-400 text-red-800' : 
                                       ($data->status == 'Cancelled' ? 'bg-blue-400 text-blue-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                    {{ $data->status }}
                                </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.approval', ['id' => $data->id]) }}"
                                        class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        View</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

            <div class="flex justify-between items-center  mt-4 mb-2">
                <div class="text-sm text-gray-700">
                    Showing {{ $tableData->firstItem() }} to {{ $tableData->lastItem() }} of
                    {{ $tableData->total() }} leaves
                </div>
                <div class="flex">
                    @if ($tableData->previousPageUrl())
                        <a href="{{ $tableData->previousPageUrl() }}"
                            class="px-1 py-1 text-sm font-small text-gray-900 bg-white hover:bg-gray-50 border border-gray-300 rounded-md">Previous</a>
                    @endif

                    @foreach ($tableData as $leave)
                        <!--  <a href="#" class="ml-3 px-1 py-1 text-sm font-small text-gray-900 bg-white hover:bg-gray-50 border border-gray-300 rounded-md"></a>-->
                    @endforeach

                    @if ($tableData->nextPageUrl())
                        <a href="{{ $tableData->nextPageUrl() }}"
                            class="ml-3 px-1 py-1 text-sm font-small text-gray-900 bg-white hover:bg-gray-50 border border-gray-300 rounded-md">Next</a>
                    @endif
                </div>
            </div>

        </div>
        </div>
    </body>

</x-app-layout>
