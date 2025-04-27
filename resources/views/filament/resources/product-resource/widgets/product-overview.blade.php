<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-6 flex flex-col items-center">
        <div class="text-3xl font-bold">{{ $totalProducts }}</div>
        <div class="text-gray-500 mt-2">Total Products</div>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-6 flex flex-col items-center">
        <div class="text-3xl font-bold text-green-600">{{ $inStock }}</div>
        <div class="text-gray-500 mt-2">In Stock</div>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-6 flex flex-col items-center">
        <div class="text-3xl font-bold text-red-600">{{ $outOfStock }}</div>
        <div class="text-gray-500 mt-2">Out of Stock</div>
    </div>
</div>
