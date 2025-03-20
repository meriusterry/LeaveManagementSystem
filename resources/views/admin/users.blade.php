<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Leave Management') }}
        </h2>

    </x-slot>
   
    <body class="bg-gray-100">
        <div class="max-w-7xl mx-auto py-0 px-0">
            <div class="px-4 py-5 sm:px-1">
                <div class="mt-0">
                    
                    <div class="px-0 sm:px-1 flex justify-end mt-0 ">
                        <a href="{{ route('admin.createuser') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create User
                        </a>
                    </div>

                    <div class="mt-2"></div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-300">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Employee ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Employee Name</th>
                                        <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Email</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Department</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Position</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="  px-14 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Action</th>
                                        
                                           
                                        
                                        
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($tableData as $data)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                            {{ $data->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="text-sm font-medium text-gray-500">
                                            {{ $data->firstName }} {{ $data->surname }} <br>
                                        </div> 
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $data->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $data->department }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $data->position }} </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                            {{ $data->status == 'Active' ? 'bg-green-500 text-gray-800' : 'bg-red-500 text-gray-700' }}">
                                                {{ $data->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            
                                            <div class="flex items-center">
                                                <!-- Form for giving permission -->

                                                @if ($data->access == 'True')

                                                <form id="blockForm" method="POST" action="{{ route('blockaccess', $data->id) }}">
                                                    @csrf
                                                    <button type="submit" onclick="return confirmBlock();" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        Block Permision
                                                    </button>
                                                    &nbsp;
                                                   <!--  <a href="{{ route('admin.users', ['id' => $data->id]) }}"
                                                        class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                         Delete
                                                     </a>
                                                     -->
                                                 
                                                </form>
                                                
                                                @else
                                                <form id="accessForm" method="POST" action="{{ route('giveaccess', $data->id) }}" class="mr-2">
                                                    @csrf
                                                    <button type="submit" onclick="return confirmAccess()" onclick="return confirmAccess();" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                        Allow Permission
                                                    </button>
                                                </form>
                                                
                                                <!-- Form for deleting -->
                                                <form action="{{ route('destroyuser', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"  onclick="return confirmDeleteUser()"class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                            
                                           
                                           
                                            @endif
                                        </td>
                                     
                                          
                                    </tr>
                                    
                               
                            
                                @endforeach

                            </tbody>

                        </table>
                    </div>

                    <script>
                        function confirmBlock() {
                            return confirm("Are you sure you want to Block Permision");
                        }

                        function confirmAccess() {
                            return confirm("Are you sure you want to Allow Permision");
                        }
                        function confirmDeleteUser() {
                         return confirm('Are you sure you want to delete this user?');
                         }
                                                   
                                            
                                           
                    </script>
                    <div class="flex justify-between items-center mt-4 mb-2">
                        <div class="text-sm text-gray-700">
                            Showing {{ $tableData->firstItem() }} to {{ $tableData->lastItem() }} of
                            {{ $tableData->total() }} Users
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
        </div>
        </div>
    
    </body>

</x-app-layout>
