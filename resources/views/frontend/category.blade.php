@extends('frontend.layout')
@section('css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')
<main>
    <main>
        <div class="max-w-7xl mx-auto px-4 py-12" x-data="wizard()" x-init="init()">
            <div class="max-w-3xl mx-auto px-4 py-12">
                <div class="text-center mb-12">
                    <h1 class="text-3xl md:text-4xl font-bold text-center mb-4">Sell Your Device</h1>
                    <p class="text-[#9F9F9F] text-sm text-start max-w-3xl mx-auto">
                        Every day, we assist customers in trading in or selling their old devices effortlessly. Start by
                        selecting your device below to receive a quote. Upon receiving your quote, we will provide a prepaid
                        shipping label for you to send in your device.
                    </p>
                    <!-- Search Box -->
                    <div x-show="step === 1 || step === 2" class="relative bg-white rounded-xl my-10">
                        <input type="text" 
                            x-model="searchQuery" 
                            @input.debounce.300ms="handleSearch()"
                            placeholder="Search ..."
                            class="flex h-10 px-10 w-full border border-black/30 bg-[#F8F8F8] rounded-xl border-input py-2 text-base ring-offset-transparent file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-0 focus-visible:ring-transparent focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
                        <!-- Clear button -->
                        <button 
                            x-show="searchQuery"
                            @click="searchQuery = ''; handleSearch()"
                            class="absolute inset-y-0 right-3 flex items-center"
                        >
                            <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0 8.66993C0 3.88166 3.84034 0 8.57764 0C10.8526 0 13.0343 0.913436 14.6429 2.53936C16.2516 4.16529 17.1553 6.37052 17.1553 8.66993C17.1553 13.4582 13.3149 17.3399 8.57764 17.3399C3.84034 17.3399 0 13.4582 0 8.66993ZM17.0134 15.6543L19.568 17.7164H19.6124C20.1292 18.2388 20.1292 19.0858 19.6124 19.6082C19.0955 20.1306 18.2576 20.1306 17.7407 19.6082L15.6207 17.1785C15.4203 16.9766 15.3076 16.7024 15.3076 16.4164C15.3076 16.1304 15.4203 15.8562 15.6207 15.6543C16.0072 15.2704 16.6268 15.2704 17.0134 15.6543Z"
                                    fill="#9F9F9F" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
    
            <!-- Step 1: Categories -->
            <div x-show="step === 1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="category in filteredCategories" :key="category.id">
                        <div @click="selectCategory(category)"
                            class="bg-primary2 rounded-3xl p-3 lg:p-8 flex flex-col-reverse md:flex-row items-center justify-center gap-8 cursor-pointer hover:shadow-lg transition-all duration-300">
                            <div class="flex flex-col space-y-6">
                                <div>
                                    <h2 class="text-white text-2xl font-light mb-2" x-text="category.name"></h2>
                                    <p class="text-gray-300 text-xl font-light">Now Available</p>
                                </div>
                                <button class="bg-white text-black py-3 px-6 rounded-xl text-lg hover:bg-gray-100 transition-colors w-40">
                                    Learn More
                                </button>
                            </div>
                            <div class="rounded-2xl overflow-hidden">
                                <img :src="category.image ? category.image : '{{ asset('assets/images/default.png') }}'" 
                                    :alt="category.name" 
                                    class="w-full h-48 object-cover transform hover:scale-105 transition-transform duration-300">
                            </div>
                        </div>
                    </template>
                </div>
                <!-- No Results Message -->
                <div x-show="filteredCategories.length === 0" class="text-center py-8">
                    <p class="text-gray-500">No categories found matching your search.</p>
                </div>
            </div>
    
            <!-- Step 2: Products -->
            <div x-show="step === 2">
                <div class="my-5">
                    <button @click="backToCategories" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back to device selection</span>
                    </button>
                </div>
    
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <div @click="selectProduct(product)"
                            class="p-4 border rounded-lg text-center cursor-pointer hover:border-blue-500 hover:shadow-md transition-all duration-300">
                            <img :src="product.image ? product.image : '{{ asset('frontend_assets/assets/images/Iphone.webp') }}'" 
                                :alt="product.name" 
                                class="mx-auto mb-2 w-32 h-32 object-contain transform hover:scale-105 transition-transform duration-300">
                            <span class="font-medium" x-text="product.name"></span>
                        </div>
                    </template>
                </div>
                <!-- No Results Message -->
                <div x-show="filteredProducts.length === 0" class="text-center py-8">
                    <p class="text-gray-500">No products found matching your search.</p>
                </div>
            </div>
    
            <!-- الخطوة 1: عرض التصنيفات -->
            {{-- <div x-show="step === 1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="category in categories" :key="category.id">
                        <div @click="selectCategory(category)"
                            class="bg-primary2 rounded-3xl p-3 lg:p-8 flex flex-col-reverse md:flex-row items-center justify-center gap-8 cursor-pointer">
                            <div class="flex flex-col space-y-6">
                                <div>
                                    <h2 class="text-white text-2xl font-light mb-2" x-text="category.name"></h2>
                                    <p class="text-gray-300 text-xl font-light">Now Available</p>
                                </div>
                                <button class="bg-white text-black py-3 px-6 rounded-xl text-lg hover:bg-gray-100 transition-colors w-40">
                                    Learn More
                                </button>
                            </div>
                            <div class="rounded-2xl overflow-hidden">
                                <img :src="category.image ? category.image : '{{ asset('assets/images/default.png') }}'" :alt="category.name" class="w-full h-48 object-cover">
                            </div>
                        </div>
                    </template>
                </div>
            </div>
    
            <!-- الخطوة 2: عرض المنتجات -->
            <div x-show="step === 2">
                <div class="my-5">
                    <button @click="backToCategories" class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back to device selection</span>
                    </button>
                </div>
    
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <template x-for="product in products" :key="product.id">
                        <div @click="selectProduct(product)"
                            class="p-4 border rounded-lg text-center cursor-pointer hover:border-blue-500">
                            <img :src="product.image ? product.image : '{{ asset('frontend_assets/assets/images/Iphone.webp') }}'" 
                                    :alt="product.name" class="mx-auto mb-2 w-32 h-32 object-contain">
                            <span x-text="product.name"></span>
                        </div>
                    </template>
                </div>
            </div> --}}
    
            <!-- الخطوة 3: تحديد المواصفات -->
            <div x-show="step === 3">
                <div class="my-5">
                    <button @click="step = 2" class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back to model selection</span>
                    </button>
                </div>
    
                <div class="space-y-6">
                    <!-- اختيار السنة -->
                    <div class="py-5 px-8 rounded-3xl bg-[#F8F8F8] border flex items-center justify-between">
                        <h3 class="font-medium">Year</h3>
                        <span x-text="selections.year"></span>
                    </div>
                    <div class="border-b p-6">
                        <div class="flex gap-3 flex-wrap">
                            <template x-for="year in availableYears">
                                <button @click="setYear(year)" 
                                    :class="selections.year === year ? 'bg-black text-white' : 'bg-gray-200'"
                                    class="px-4 py-2 rounded transition-colors" x-text="year">
                                </button>
                            </template>
                        </div>
                    </div>
    
                    <!-- اختيار الذاكرة -->
                    <div x-show="selections.year">
                        <div class="py-5 px-8 rounded-3xl bg-[#F8F8F8] border flex items-center justify-between">
                            <h3 class="font-medium">Memory</h3>
                            <span x-text="selections.memory"></span>
                        </div>
                        <div class="border-b p-6">
                            <div class="flex gap-3 flex-wrap">
                                <template x-for="memory in availableMemories">
                                    <button @click="setMemory(memory)"
                                        :class="selections.memory === memory ? 'bg-black text-white' : 'bg-gray-200'"
                                        class="px-4 py-2 rounded transition-colors">
                                        <span x-text="memory"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
    
                    <!-- اختيار الحالة -->
                    <div x-show="selections.memory">
                        <h3 class="font-medium mb-4">Select Condition</h3>
                        <div class="space-y-4">
                            <template x-for="condition in availableConditions" :key="condition.name">
                                <div @click="toggleCondition(condition)"
                                    :class="selections.condition?.name === condition.name ? 'border-blue-500 bg-blue-50' : ''"
                                    class="border p-4 rounded-lg cursor-pointer">
                                    <div class="items-center">
                                        <h4 class="font-medium text-center" x-text="condition.name"></h4>
                                        <div class="text-gray-600 mb-4" x-text="condition.description"></div>
                                    </div>
                                    <div x-show="activeCondition?.name === condition.name" class="mt-4">
                                        <ul class="space-y-2">
                                            <template x-for="requirement in availableConditions[condition.name]?.requirements || []">
                                                <li class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                                    </svg>
                                                    <span x-text="requirement"></span>
                                                </li>
                                            </template>
                                        </ul>
                                        <button @click="setCondition(condition)"
                                            class="mt-4 w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800">
                                            Select Condition
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="mt-6 px-6 text-sm text-gray-500" x-show="selections.year">
                            <span>Selected: </span>
                            <span x-text="selections.year"></span>
                            <template x-if="selections.memory">
                                <span> - <span x-text="selections.memory"></span></span>
                            </template>
                            <template x-if="selections.condition">
                                <span> - <span x-text="selections.condition"></span></span>
                            </template>
                        </div>
                        <div x-show="selections.condition" @click="step = 4"
                            class="flex justify-center text-2xl rounded-xl px-4 py-1 items-center bg-[#77c1d2] cursor-pointer">
                            next
                            <svg viewBox="0 0 24 24" width="16" height="16" class="rotate-180">
                                <path fill="currentColor" d="M20 11v2H8l5.5 5.5l-1.42 1.42L4.16 12l7.92-7.92L13.5 5.5L8 11z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- الخطوة 4: طريقة التسليم -->
            <div x-show="step === 4">
                <div class="my-5">
                    <button @click="step = 3" class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back to specifications</span>
                    </button>
                </div>
    
                <div class="grid md:grid-cols-2 gap-6">
                    <div @click="selectDeliveryMethod('mail-in')"
                        :class="selections.deliveryMethod === 'mail-in' ? 'border-blue-500 bg-blue-50' : ''"
                        class="border p-6 rounded-lg cursor-pointer text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-primary2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-xl font-medium mb-2">Mail-In</h3>
                        <p class="text-gray-600">Ship your device using our pre-paid shipping label</p>
                    </div>
    
                    <div @click="selectDeliveryMethod('in-store')"
                        :class="selections.deliveryMethod === 'in-store' ? 'border-blue-500 bg-blue-50' : ''"
                        class="border p-6 rounded-lg cursor-pointer text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-primary2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <h3 class="text-xl font-medium mb-2">In-Store</h3>
                        <p class="text-gray-600">Visit one of our locations to complete the trade-in</p>
                    </div>
                </div>
            </div>
    
            <!-- الخطوة 5: النموذج النهائي -->
            <div x-show="step === 5">
                <div class="my-5">
                    <button @click="step = 4" class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back to delivery method</span>
                    </button>
                </div>
    
                <!-- Mail-In Option -->
                <div x-show="selections.deliveryMethod === 'mail-in'" class="bg-white p-6 rounded-lg space-y-4">
                    <!-- Payout Section -->
                    <div>
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-semibold mb-4">Payout</h3>
                            <p class="text-2xl font-bold text-[#77c1d9]" x-text="'$' + selections.price"></p>
                        </div>
                        <!-- Payment Options -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                            <!-- Payment Options Here -->
                        </div>
                    </div>
    
                    <!-- Address Form -->
                    <div class="space-y-4">
                        <!-- Address Form Fields Here -->
                    </div>
    
                    <!-- Terms and Conditions -->
                    <div class="space-y-4">
                        <!-- Terms and Conditions Here -->
                    </div>
    
                    <!-- Submit Button -->
                    <button type="button" 
                        @click="submitOffer()"
                        :disabled="loading || Object.keys(errors).length > 0"
                        class="w-full bg-[#77c1d2] text-white py-3 px-6 rounded-lg hover:bg-[#50828d] transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="!loading">Lock in Offer</span>
                        <span x-show="loading">Processing...</span>
                    </button>
                </div>
                <div class="lg:max-w-2xl mx-auto bg-white rounded-lg shadow-sm">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-4">Your Order Summary</h2>
                        <div class="border-b border-blue-500" style="width: 100%; height: 2px;"></div>
                        <table class="w-full order-table">
                            <thead>
                                <tr class="border-b">
                                    <th>Product</th>
                                    <th>Details</th>
                                    <th>Qty</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td x-text="selectedProduct?.name"></td>
                                    <td class="details-cell">
                                        Year: <span x-text="selections.year"></span><br>
                                        Memory: <span x-text="selections.memory + 'GB'"></span><br>
                                        Condition: <span x-text="selections.condition?.name"></span>
                                    </td>
                                    <td>1</td>
                                    <td class="text-right text-red-500" x-text="'$' + selections.price"></td>
                                </tr>
                                <tr class="border-b">
                                    <td colspan="3" class="font-medium">Subtotal:</td>
                                    <td class="text-right text-red-500" x-text="'$' + selections.price"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="font-medium">Total:</td>
                                    <td class="text-right text-red-500" x-text="'$' + selections.price"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- In-Store Option -->
                <div x-show="selections.deliveryMethod === 'in-store'" class="bg-white p-6 rounded-lg space-y-4">
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold">Contact</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="firstName" class="block text-sm text-gray-600 mb-1">First Name</label>
                                <input type="text" id="firstName" x-model="userAddress.first_name"
                                    class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400"
                                    placeholder="First Name">
                                <span x-show="errors.first_name" class="text-red-600 text-sm text-danger" x-text="errors.first_name"></span>

                            </div>
                            <div>
                                <label for="lastName" class="block text-sm text-gray-600 mb-1">Last Name</label>
                                <input type="text" id="lastName" x-model="userAddress.last_name"
                                    class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400"
                                    placeholder="Last Name">
                                <span x-show="errors.last_name" class="text-red-600 text-sm text-danger" x-text="errors.last_name"></span>
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm text-gray-600 mb-1">Email Address</label>
                            <input type="email" id="email" x-model="userAddress.email"
                                class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400"
                                placeholder="your@email.com">
                            <span x-show="errors.email" class="text-red-600 text-sm text-danger" x-text="errors.email"></span>
                        </div>
                        <div>
                            <label for="addressDetails" class="block text-sm text-gray-600 mb-1">Address</label>
                            <input type="text" id="address" x-model="userAddress.address"
                                class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400"
                                placeholder="Apartment, suite, unit, building, floor, etc.">
                            <span x-show="errors.address" class="text-red-600 text-sm text-danger" x-text="errors.address"></span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="state" class="block text-sm text-gray-600 mb-1">State</label>
                                <select id="state" x-model="userAddress.state" @change="fetchCities()"
                                    class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400">
                                    <option value="">Select State</option>
                                    <template x-for="state in states" :key="state">
                                        <option :value="state" x-text="state"></option>
                                    </template>
                                </select>
                                <span x-show="errors.state" class="text-red-600 text-sm text-danger" x-text="errors.state"></span>
                            </div>
                            <div>
                                <label for="city" class="block text-sm text-gray-600 mb-1">City</label>
                                <select id="city" x-model="userAddress.city"
                                    class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400">
                                    <option value="">Select City</option>
                                    <template x-for="city in cities" :key="city">
                                        <option :value="city" x-text="city"></option>
                                    </template>
                                </select>
                                <span x-show="errors.city" class="text-red-600 text-sm text-danger" x-text="errors.city"></span>
                            </div>
                            <div>
                                <label for="zip" class="block text-sm text-gray-600 mb-1">Postal Code</label>
                                <input type="text" id="zip" x-model="userAddress.postal_code"
                                    class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400"
                                    placeholder="Postal Code">
                                <span x-show="errors.postal_code" class="text-red-600 text-sm text-danger" x-text="errors.postal_code"></span>
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm text-gray-600 mb-1">Phone Number</label>
                            <div class="flex">
                                <div
                                    class="w-20 flex items-center border border-gray-200 rounded-lg px-3 bg-gray-50">
                                    <span class="text-gray-500">🇺🇸 +1</span>
                                </div>
                                <input type="tel" id="phone" x-model="userAddress.phone"
                                    class="flex-1 p-3 border border-gray-200 rounded-lg ml-2 focus:outline-none focus:border-gray-400"
                                    placeholder="(201) 555-0123">
                            </div>
                            <span x-show="errors.phone" class="text-red-600 text-sm text-danger" x-text="errors.phone"></span>
                        </div>

                        <div class="space-y-4">
                            <h4 class="font-medium">Schedule Store Visit</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">Preferred Date</label>
                                    <input type="date" x-model="userAddress.preferred_date" id="preferred_date"
                                        class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400">
                                    <span x-show="errors.preferred_date" class="text-red-600 text-sm text-danger" x-text="errors.preferred_date"></span>
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">Preferred Time</label>
                                    <select x-model="userAddress.preferred_time" id="preferred_time"
                                        class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400">
                                        <option value="">Select a time</option>
                                        <option value="09:00">9:00 AM</option>
                                        <option value="10:00">10:00 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="12:00">12:00 PM</option>
                                        <option value="13:00">1:00 PM</option>
                                        <option value="14:00">2:00 PM</option>
                                        <option value="15:00">3:00 PM</option>
                                        <option value="16:00">4:00 PM</option>
                                        <option value="17:00">5:00 PM</option>
                                    </select>
                                    <span x-show="errors.preferred_time" class="text-red-600 text-sm text-danger" x-text="errors.preferred_time"></span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500">Please select your preferred date and time for store
                                visit. We'll confirm the appointment via email.</p>
                        </div>

                        <div class="text-sm text-gray-600">
                            <p>By signing up via text, you consent to receive automated text messages about your
                                offer (e.g. status updates and cart reminders) from SA-BBR at the number provided.
                                Consent is not mandatory. Message & data rates may apply. Unsubscribe at any time by
                                replying STOP.</p>
                        </div>

                        <div class="flex items-start space-x-2">
                            <input type="checkbox" class="mt-1" checked>
                            <span class="text-sm">Text me regarding updates on my offer, its status, or offer
                                promotions</span>
                        </div>
                    </div>

                    <div class="mt-8 space-y-6">
                        <h3 class="text-xl font-semibold">Payout</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div
                                class="border border-gray-200 rounded-lg p-4 text-center cursor-pointer hover:shadow-md transition-shadow">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-[#77c1d2] mb-2" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4M20 18H4V6H20V18Z" />
                                    </svg>
                                    <span>Paper Check</span>
                                </div>
                            </div>
                            <div
                                class="border border-gray-200 rounded-lg p-4 text-center cursor-pointer hover:shadow-md transition-shadow">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-[#77c1d2] mb-2" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M20 4H4C2.89 4 2.01 4.89 2.01 6L2 18C2 19.11 2.89 20 4 20H20C21.11 20 22 19.11 22 18V6C22 4.89 21.11 4 20 4M20 18H4V6H20V18Z" />
                                    </svg>
                                    <span>Store Credit</span>
                                    <span class="text-sm text-[#77c1d2]">(10.00% Bonus Payout)</span>
                                </div>
                            </div>
                            <div
                                class="border border-gray-200 rounded-lg p-4 text-center cursor-pointer hover:shadow-md transition-shadow">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-[#77c1d2] mb-2" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M12 21.35L10.55 20.03C5.4 15.36 2 12.27 2 8.5C2 5.41 4.42 3 7.5 3C9.24 3 10.91 3.81 12 5.08C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.41 22 8.5C22 12.27 18.6 15.36 13.45 20.03L12 21.35Z" />
                                    </svg>
                                    <span>Donate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <button @click="submitOffer()"
                            class="w-full bg-[#77c1d2] text-white py-3 px-6 rounded-lg hover:bg-[#50828d] transition-colors">
                            Lock in Offer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</main>
@endsection

@section('js')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="{{ asset('frontend_assets/assets/js/axios.min.js') }}"></script>

    <script>
function wizard() {
    return {
        step: 1,
        categories: [],
        products: [],
        filteredCategories: [], // For search results
        filteredProducts: [], // For search results
        searchQuery: '', // Search input
        availableYears: [],
        availableMemories: [],
        availableConditions: [],
        notification: '',
        errors: {},
        selectedProduct: null,  
        selectedCategory: null,
        loading: false,
        selections: {
            deliveryMethod: null,
            year: null,
            memory: null,
            condition: null,
            price: 0,
        },
        userAddress: {
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            address: '',
            address_details: '',
            city: '',
            state: '',
            postal_code: '',
            preferred_date: '',
            preferred_time: '',
        },
        states: [
            'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
            'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia',
            'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas',
            'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts',
            'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana',
            'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico',
            'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma',
            'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina',
            'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
            'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
        ],
        cities: [],
        activeCondition: null,

        init() {
            this.loadCategories();
        },

        // Search functionality
        handleSearch() {
            const query = this.searchQuery.toLowerCase().trim();
            
            if (this.step === 1) {
                // Search in categories
                if (query === '') {
                    this.filteredCategories = this.categories;
                } else {
                    this.filteredCategories = this.categories.filter(category => 
                        category.name.toLowerCase().includes(query)
                    );
                }
            } else if (this.step === 2) {
                // Search in products
                if (query === '') {
                    this.filteredProducts = this.products;
                } else {
                    this.filteredProducts = this.products.filter(product => 
                        product.name.toLowerCase().includes(query)
                    );
                }
            }
        },

        // Modified existing functions
        loadCategories() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                    this.filteredCategories = response.data; // Initialize filtered list
                })
                .catch(error => {
                    console.error('Error loading categories:', error);
                });
        },

        selectCategory(category) {
            this.selectedCategory = category;
            this.searchQuery = ''; // Clear search when selecting category
            
            axios.get(`/api/categories/${category.id}/products`)
                .then(response => {
                    this.products = response.data;
                    this.filteredProducts = response.data; // Initialize filtered products
                    this.step = 2;
                })
                .catch(error => {
                    console.error('Error loading products:', error);
                });
        },

        backToCategories() {
            this.step = 1;
            this.selectedCategory = null;
            this.products = [];
            this.filteredProducts = [];
            this.searchQuery = ''; // Clear search when going back
            this.selectedProduct = null;
        },
                fetchCities() {
                    if (!this.userAddress.state) {
                        this.cities = [];
                        return;
                    }
                    
                    axios.get(`/api/cities/${this.userAddress.state}`)
                        .then(response => {
                            this.cities = response.data.cities;
                        })
                        .catch(error => {
                            console.error('Error fetching cities:', error);
                            this.cities = [];
                        });
                },
                // عند اختيار منتج، نقوم بجلب تفاصيله (Years & Memories) من قاعدة البيانات
                selectProduct(product) {
                    if (!product) return;
                    this.selectedProduct = product;
                    this.selections.year = null; // إعادة تعيين السنة عند اختيار منتج جديد
                    this.selections.memory = null;
                    this.selections.condition = null;
                    
                    axios.get(`/api/products/${product.id}/details`) // نقوم بجلب السنوات فقط
                        .then(response => {
                            this.availableYears = response.data.years;
                            this.availableMemories = []; // إفراغ الذكريات حتى يتم اختيار سنة
                            this.step = 3;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },

                setYear(year) {
                    this.selections.year = year;
                    this.selections.memory = null;
                    this.selections.condition = null;
                    this.activeCondition = null;
                    this.availableConditions = [];
                    
                    axios.get(`/api/products/${this.selectedProduct.id}/years/${year}/memories`, {
                        params: { year: year }
                    })
                    .then(response => {
                        this.availableMemories = response.data.memories;
                    })
                    .catch(error => {
                        console.error(error);
                        this.availableMemories = [];
                    });
                },
                setMemory(memory) {
                    this.selections.memory = memory;
                    this.selections.condition = null;
                    this.activeCondition = null;
                    
                    // جلب الحالات المتاحة من API
                    axios.get(`/api/products/${this.selectedProduct.id}/memory/${memory}/conditions`, {
                        params: {
                            year: this.selections.year,
                            memory: memory
                        }
                    })
                    .then(response => {
                        this.availableConditions = response.data.conditions;
                    })
                    .catch(error => {
                        console.error(error);
                        this.availableConditions = [];
                    });
                },
                setCondition(condition) {
                    this.selections.condition = condition.name;
                    this.activeCondition = null;

                    // جلب السعر من API
                    axios.get(`/api/calculate-price`, {
                        params: {
                            product_id: this.selectedProduct.id,
                            year: this.selections.year,
                            memory: this.selections.memory,
                            condition: condition.name
                        }
                    })
                    .then(response => {
                        this.selections.price = response.data.price;
                    })
                    .catch(error => {
                        console.error(error);
                        this.selections.price = 0;
                    });
                },
                toggleCondition(condition) {
                    this.activeCondition = this.activeCondition === condition ? null : condition;
                },

                // اختيار طريقة التسليم
                selectDeliveryMethod(method) {
                    this.selections.deliveryMethod = method;
                    this.step = 5;
                },
                validateOffer() {
                    // إعادة تعيين الأخطاء قبل التحقق
                    this.errors = {};

                    // مثال على فحص بعض الحقول (يمكنك توسيعه حسب الحاجة)
                    if (!this.selections.year) {
                        this.errors.year = "Please select a year.";
                    }
                    if (!this.selections.memory) {
                        this.errors.memory = "Please select a memory option.";
                    }
                    if (!this.selections.condition) {
                        this.errors.condition = "Please select the device condition.";
                    }
                    if (!this.selections.deliveryMethod) {
                        this.errors.delivery_method = "Please select a delivery method.";
                    }
                    // فحص حقول العنوان
                    if (!this.userAddress.first_name) {
                        this.errors.first_name = "First name is required.";
                    }
                    if (!this.userAddress.last_name) {
                        this.errors.last_name = "Last name is required.";
                    }
                    if (!this.userAddress.email) {
                        this.errors.email = "Email is required.";
                    }
                    if (!this.userAddress.phone) {
                        this.errors.phone = "Phone number is required.";
                    }
                    if (!this.userAddress.address) {
                        this.errors.address = "Address is required.";
                    }
                    // if (!this.userAddress.city) {
                    //     this.errors.city = "City is required.";
                    // }
                    if (!this.userAddress.state) {
                        this.errors.state = "State is required.";
                    }
                    if (!this.userAddress.postal_code) {
                        this.errors.postal_code = "Postal code is required.";
                    }
                    if (!this.userAddress.preferred_date) {
                        this.errors.preferred_date = "Preferred date is required.";
                    }
                    if (!this.userAddress.preferred_time) {
                        this.errors.preferred_time = "Preferred time is required.";
                    }
                    // إذا كان هناك أخطاء، يتم إيقاف الإرسال
                    return Object.keys(this.errors).length === 0;
                },
                submitOffer() {
                    if (this.loading) return; // منع النقرات المتعددة
    if (!this.validateOffer()) { // تعديل هذا السطر
        console.log("Validation errors:", this.errors);
        return;
    }
    this.loading = true;
    // التأكد من وجود البيانات المطلوبة
    if (!this.selectedProduct?.id) {
        console.error("No product selected");
        return;
    }

    const payload = {
        product_id: this.selectedProduct.id,
        year: this.selections.year,
        memory: this.selections.memory,
        condition: this.selections.condition,
        delivery_method: this.selections.deliveryMethod,
        first_name: this.userAddress.first_name,
        last_name: this.userAddress.last_name,
        email: this.userAddress.email,
        phone: this.userAddress.phone,
        address: this.userAddress.address,
        address_details: this.userAddress.address_details,
        city: this.userAddress.city,
        state: this.userAddress.state,
        postal_code: this.userAddress.postal_code,
        preferred_date: this.userAddress.preferred_date,
        preferred_time: this.userAddress.preferred_time,
        price: this.selections.price // إضافة السعر للطلب
    };

    // إضافة معالجة أفضل للأخطاء
    axios.post('/api/checkout', payload)
        .then(response => {
            if (response.data.success) {
                alert('Order saved successfully!');
                setTimeout(() => {
                    window.location.href = '/';
                }, 1000);
            } else {
                alert(response.data.message || 'Something went wrong');
            }
        })
        .catch(error => {
            if (error.response?.data?.errors) {
                this.errors = error.response.data.errors;
                alert('Please check the form for errors.');
            } else {
                console.error('Error submitting order:', error);
                alert('An error occurred while processing your order.');
            }
        }).finally(() => {
            this.loading = false;
        });
}

            }
        }
    </script>
@endsection
