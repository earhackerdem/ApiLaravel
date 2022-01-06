<div class="grid grid-cols-3 gap-6">

    <div>

        <h3 class="text-lg font-medium text-gray-900">

            {{ $title }}

        </h3>

        <p class="mt-1 text-sm text-gray-600">

            {{ $description }}
        </p>

    </div>


    <div class="col-span-2">

        <div>
            <div class="p-6 bg-white shadow rounded-tl-md rounded-tr-md">

                {{ $slot }}

            </div>

            <div class="px-6 py-3 bg-gray-100 shadow flex justify-end items-center rounded-bl-md rounded-br-md">
                {{ $actions }}
            </div>
        </div>

    </div>

</div>
