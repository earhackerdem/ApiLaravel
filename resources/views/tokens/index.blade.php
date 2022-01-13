<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Api Tokens
        </h2>
    </x-slot>

    <div id="app">

        <x-container class="py-8">

            {{-- Crear access token --}}
            <x-form-section class="mb-12">
                <x-slot name="title">
                    AccessToken
                </x-slot>
                <x-slot name="description">
                    Aquí podrá generar un AccessToken
                </x-slot>

                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">

                        <div v-if="form.errors.length > 0"
                            class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong class="font-bold">Whoops!</strong>
                            <span>!Algo salio mal</span>
                            <ul>
                                <li v-for="error in form.errors">
                                    @{{ error }}
                                </li>
                            </ul>
                        </div>

                        <x-label>
                            Nombre
                        </x-label>
                        <x-input v-model="form.name" type="text" class="w-full mt-1" />
                    </div>
                </div>

                <x-slot name="actions">
                    <x-button v-on:click="store" v-bind:disabled="form.disabled">
                        Crear
                    </x-button>
                </x-slot>
            </x-form-section>

            {{-- Mostrar access tokens --}}
            <x-form-section v-if="tokens.length > 0">

                <x-slot name="title">
                    Listado de Access Tokens
                </x-slot>


                <x-slot name="description">
                    Aquí podrás encontrar todos los Access Tokens que has agregado
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
                            <tr v-for="token in tokens">
                                <td class="py-2">
                                    @{{ token.name }}
                                </td>
                                <td class="flex divide-x divide-gray-300 py-2">
                                    <a v-on:click="" class="pr-2 hover:text-green-600 font-semibold cursor-pointer">
                                        Ver
                                    </a>
                                    <a v-on:click="" class="px-2 hover:text-blue-600 font-semibold cursor-pointer">
                                        Editar
                                    </a>
                                    <a class="pl-2 hover:text-red-600 font-semibold cursor-pointer"
                                        v-on:click="revoke(token)">
                                        Eliminar
                                    </a>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>



            </x-form-section>

        </x-container>

    </div>

    @push('js')

        <script>
            new Vue({
                el: "#app",
                data: {
                    tokens: [],
                    form: {
                        name: '',
                        errors: [],
                        disabled: false,
                    },
                },
                mounted() {
                    this.getTokens();
                },
                methods: {
                    getTokens() {
                        axios.get('/oauth/personal-access-tokens')
                            .then(response => {
                                this.tokens = response.data;
                            });
                    },
                    store() {
                        this.form.disable = true;
                        axios.post('/oauth/personal-access-tokens', this.form)
                            .then(response => {
                                this.form.name = null;
                                this.form.errors = [];
                                this.form.disable = false;
                                this.getTokens();
                            })
                            .catch(error => {
                                this.form.errors = _.flatten(_.toArray(error.response.data.errors));
                                this.form.disable = false;
                            })
                    },
                    revoke(token) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                axios.delete('/oauth/personal-access-tokens/' + token.id)
                                    .then(response => {
                                        this.getTokens();
                                    });
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        })
                    }
                },
            });
        </script>

    @endpush

</x-app-layout>
