<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Api Tokens
        </h2>
    </x-slot>

    <div id="app">

        <x-container class="py-8">

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

        </x-container>

    </div>

    @push('js')

        <script>
            new Vue({
                el: "#app",
                data: {
                    form: {
                        name: '',
                        errors: [],
                        disabled: false,
                    },
                },
                methods: {
                    store() {
                        this.form.disable = true;
                        axios.post('/oauth/personal-access-tokens', this.form)
                            .then(response => {
                                this.form.name = null;
                                this.form.errors = [];
                                this.form.disable = false;
                            })
                            .catch(error => {
                                this.form.errors = _.flatten(_.toArray(error.response.data.errors));
                                this.form.disable = false;
                            })
                    }
                },
            });
        </script>

    @endpush

</x-app-layout>
