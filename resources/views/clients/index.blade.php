<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clientes
        </h2>

    </x-slot>

    <x-container id="app" class="py-8">

        <x-form-section class="mb-12">

            <x-slot name="title">
                Crear un un nuevo cliente
            </x-slot>


            <x-slot name="description">
                Ingrese los datos solicitados para poder crear un nuevo cliente
            </x-slot>

            <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6 sm:col-span-4">

                    <x-label>
                        Nombre
                    </x-label>

                    <x-input v-model="createForm.name" type="text" class="w-full mt-1" />

                </div>

                <div class="col-span-6 sm:col-span-4">

                    <x-label>
                        URL de redirección
                    </x-label>

                    <x-input v-model="createForm.redirect" type="text" class="w-full mt-1" />

                </div>

            </div>

            <x-slot name="actions">

                <x-button v-on:click="store">
                    Crear
                </x-button>

            </x-slot>

        </x-form-section>

        <x-form-section>

            <x-slot name="title">
                Listado de clientes
            </x-slot>


            <x-slot name="description">
                Aquí podrás encontrar todos los clientes que has agregado
            </x-slot>

            <div>

                <table class="text-gray-600">

                    <thead class="border-b border-gray-300">
                        <tr class="text-left">
                            <th class="py-2 w-full">Nombre</th>
                            <th class="py-2">Acción</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-300">
                        <tr v-for="client in clients">
                            <td class="py-2">
                                @{{ client . name }}
                            </td>
                            <td class="flex divide-x divide-gray-300 py-2">
                                <a class="pr-2 hover:text-blue-600 font-semibold cursor-pointer">
                                    Editar
                                </a>
                                <a class="pl-2 hover:text-red-600 font-semibold cursor-pointer">
                                    Eliminar
                                </a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>



        </x-form-section>

    </x-container>

    @push('js')
        <script>
            new Vue({
                el: "#app",
                data: {
                    clients: [],
                    createForm: {

                        errors: [],
                        name: null,
                        redirect: null,
                    }
                },
                mounted() {
                    this.getClients();
                },
                methods: {
                    getClients() {
                        axios.get('/oauth/clients')
                            .then(response => {
                                this.clients = response.data
                            });
                    },
                    store() {
                        axios.post('/oauth/clients', this.createForm)
                            .then(response => {
                                this.createForm.name = null;
                                this.createForm.redirect = null;
                                Swal.fire(
                                    'Deleted',
                                    'Se ha guardado',
                                    'success'
                                )
                            }).catch(error => {
                                alert('No has completado los datos correspondientes')
                            })
                    }
                }
            })
        </script>
    @endpush

</x-app-layout>
