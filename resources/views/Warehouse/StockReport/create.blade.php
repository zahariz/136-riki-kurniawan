<x-layouts.master>
    <x-slot:head>
        <title>{{ $title }} | Simerak Web App</title>
    </x-slot:head>
    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <x-breadcumb>
                <x-breadcumb-head route="/home" title="Dashboard" />
                <x-breadcumb-link route="#" title="Warehouse" />
                <x-breadcumb-link route="#" current="true" :title="$title" />
            </x-breadcumb>
        </div>
    </div>

   <div class="grid gird-cols-1 px-4 pt-2 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
    <!-- Right Content -->
    <div class="col-span-full">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">{{$title}}</h3>
            <form action="index.html#">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <x-text-input for="product" id="product" type="text" name="product" label="Product" placeholder="Type sku product here.."/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-text-input for="batch" id="batch" type="text" name="batch" label="Batch" placeholder="Type batch here.."/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-text-input for="sloc" id="sloc" type="text" name="sloc" label="Storage Location" placeholder="Type storage location code here.."/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-text-input for="sloc" id="sloc" type="text" name="to_sloc" label="To" placeholder="Type destination sloc here.."/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-text-input for="bin" id="bin" type="text" name="bin" label="Storage Bin" placeholder="Type storage bin code here.."/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-text-input for="bin" id="bin" type="text" name="to_bin" label="To" placeholder="Type destination bin here.."/>
                    </div>
                    <div class="col-span-6 sm:col-span-3 flex items-end">
                        <x-button label="Login" type="submit">Submit</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>

    <x-slot:js>
        <script>
      
        </script>
    </x-slot:js>
</x-layouts.master>
