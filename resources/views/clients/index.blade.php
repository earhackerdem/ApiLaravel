<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clientes
        </h2>

    </x-slot>

    <x-container id="app" class="py-8">

        <x-form-section>

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

    </x-container>

    @push('js')
        <script>
            new Vue({
                el: "#app",
                data: {
                    createForm: {
                        errors: [],
                        name: null,
                        redirect: null,
                    }
                },
                methods: {
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
