<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <a href="{{ route('vehicle.create') }}"
                   class="items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">Create
                    new vehicle</a>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-white-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Brand
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Model
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Plate Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody id="table-vehicle">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(function () {
                $.ajax({
                    type: 'GET',
                    url: '/api/vehicle',
                    success: function (response) {
                        console.log(response)

                        let tbody = ''
                        response.data.forEach(vehicle => {
                            let actions = `<a href="{{ config('app.url') }}vehicle/${vehicle.id}/edit"  class="items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">Edit</a>
                                    <button type="button" data-id="${vehicle.id}"
                                                    class="delete text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                Delete
                                            </button>
                                    `
                            tbody += `
                            <tr id="${vehicle.id}">
                                    <td class='px-6 py-4 font-medium'>${vehicle.brand}</td>
                                    <td class='px-6 py-4 font-medium'>${vehicle.model}</td>
                                    <td class='px-6 py-4 font-medium'>${vehicle.plate_number}</td>
                                    <td class='px-6 py-4 font-medium'>${actions}</td>
                              </tr>
                            `
                        });

                        $(document).on('click', '.delete', function (e) {
                            let vehicleId = $(this).data('id')
                            $.ajax({
                                type: 'DELETE',
                                url: '/api/vehicle/' + vehicleId,
                                success: function (response) {
                                    $(`#${vehicleId}`).remove()
                                }
                            });
                        });
                        $('#table-vehicle').html(tbody)
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
