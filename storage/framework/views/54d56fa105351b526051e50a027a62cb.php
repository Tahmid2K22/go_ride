<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="relative bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 rounded-3xl p-8 sm:p-10 mb-8 overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImVudmxvcGUiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzR2MkgyVjJoMzR6TTM2IDE4djJIMnYtMmgzNHoiLz48L2c+PC9nPjwvc3ZnPg==');"></div>
                </div>
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>

                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-white"><?php echo e(__('app.welcome')); ?>, <?php echo e(Auth::user()->name); ?>!</h1>
                        <p class="mt-3 text-primary-100 text-lg"><?php echo e(__('app.welcome_message')); ?></p>
                    </div>
                    <div class="mt-6 sm:mt-0">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition duration-150 backdrop-blur-sm border border-white/20">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                                <?php echo e(__('app.log_out')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-primary-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center shadow-lg shadow-primary-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium"><?php echo e(__('app.total_rides')); ?></p>
                            <p class="text-3xl font-extrabold text-gray-900"><?php echo e(Auth::user()->rides()->count()); ?></p>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-amber-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium"><?php echo e(__('app.avg_rating')); ?></p>
                            <p class="text-3xl font-extrabold text-gray-900">-</p>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-emerald-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium"><?php echo e(__('app.total_spent')); ?></p>
                            <p class="text-3xl font-extrabold text-gray-900">TK <?php echo e(number_format(Auth::user()->rides()->where('status', 'completed')->sum('fare_amount'), 2)); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($activeRide): ?>
                <!-- Active Ride Status Card -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 mb-8" x-data="{ show: true }" x-show="show" x-transition>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900"><?php echo e(__('app.active_ride')); ?></h2>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            <?php if($activeRide->status === 'pending'): ?> bg-amber-100 text-amber-700
                            <?php elseif($activeRide->status === 'accepted'): ?> bg-blue-100 text-blue-700
                            <?php elseif($activeRide->status === 'ongoing'): ?> bg-green-100 text-green-700
                            <?php endif; ?>">
                            <?php echo e(__('app.status_' . $activeRide->status)); ?>

                        </span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide"><?php echo e(__('app.pickup')); ?></p>
                                        <p class="text-sm font-semibold text-gray-900 mt-1"><?php echo e($activeRide->pickup_address); ?></p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide"><?php echo e(__('app.dropoff')); ?></p>
                                        <p class="text-sm font-semibold text-gray-900 mt-1"><?php echo e($activeRide->dropoff_address); ?></p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide"><?php echo e(__('app.fare')); ?></p>
                                        <p class="text-sm font-semibold text-gray-900 mt-1">TK <?php echo e(number_format($activeRide->fare_amount, 2)); ?></p>
                                    </div>
                                </div>
                            </div>

                            <?php if($activeRide->status === 'pending'): ?>
                                <div class="p-4 bg-amber-50 rounded-xl border border-amber-100">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                                            <div class="absolute inset-0 w-3 h-3 bg-amber-500 rounded-full animate-ping"></div>
                                        </div>
                                        <p class="text-sm font-medium text-amber-700"><?php echo e(__('app.finding_drivers')); ?></p>
                                    </div>
                                </div>
                            <?php elseif($activeRide->status === 'accepted'): ?>
                                <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                            <div class="absolute inset-0 w-3 h-3 bg-blue-500 rounded-full animate-ping"></div>
                                        </div>
                                        <p class="text-sm font-medium text-blue-700"><?php echo e(__('app.driver_coming')); ?></p>
                                    </div>
                                </div>
                            <?php elseif($activeRide->status === 'ongoing'): ?>
                                <div class="p-4 bg-green-50 rounded-xl border border-green-100">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                            <div class="absolute inset-0 w-3 h-3 bg-green-500 rounded-full animate-ping"></div>
                                        </div>
                                        <p class="text-sm font-medium text-green-700"><?php echo e(__('app.ride_in_progress')); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Active Ride Map -->
                        <?php if($activeRide->pickup_lat && $activeRide->dropoff_lat): ?>
                            <div id="active-ride-map"
                                 class="h-64 lg:h-auto lg:min-h-[280px] rounded-xl overflow-hidden"
                                 data-pickup-lat="<?php echo e($activeRide->pickup_lat); ?>"
                                 data-pickup-lng="<?php echo e($activeRide->pickup_lng); ?>"
                                 data-dropoff-lat="<?php echo e($activeRide->dropoff_lat); ?>"
                                 data-dropoff-lng="<?php echo e($activeRide->dropoff_lng); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <!-- Book a Ride with Map -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8"
                     x-data="bookingMap({
                         services: <?php echo e(Js::from($services->map(fn($s) => ['id' => $s->id, 'name' => $s->name, 'base_fare' => (float) $s->base_fare, 'per_km_rate' => (float) $s->per_km_rate]))); ?>,
                         orsApiKey: '<?php echo e(config('services.ors.key')); ?>',
                         errors: <?php echo e(Js::from($errors->getMessages())); ?>

                     })">

                    <!-- Map Panel -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden order-2 lg:order-1">
                        <div class="p-4 border-b border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-700"><?php echo e(__('app.route_map')); ?></h3>
                            <p class="text-xs text-gray-400 mt-1"><?php echo e(__('app.click_map_to_set_points')); ?></p>
                        </div>
                        <div id="booking-map" class="h-80 lg:h-[480px]"></div>
                        <div class="p-4 border-t border-gray-100 space-y-2" x-show="distance > 0" x-transition>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500"><?php echo e(__('app.route_distance')); ?></span>
                                <span class="text-sm font-semibold text-gray-900" x-text="distance.toFixed(2) + ' km'"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500"><?php echo e(__('app.estimated_time')); ?></span>
                                <span class="text-sm font-semibold text-gray-900" x-text="estimatedTime + ' min'"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form Panel -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 order-1 lg:order-2">
                        <h2 class="text-xl font-bold text-gray-900 mb-6"><?php echo e(__('app.book_ride')); ?></h2>

                        <?php if($errors->any()): ?>
                            <div class="mb-6 p-4 bg-red-50 rounded-xl border border-red-100">
                                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('rides.store')); ?>" id="booking-form">
                            <?php echo csrf_field(); ?>

                            <!-- Service Selection -->
                            <div class="mb-5">
                                <label class="block text-sm font-semibold text-gray-700 mb-3"><?php echo e(__('app.select_service')); ?></label>
                                <div class="grid grid-cols-3 gap-3">
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="relative cursor-pointer"
                                               @click="selectService(<?php echo e($service->id); ?>)">
                                            <input type="radio" name="service_id" value="<?php echo e($service->id); ?>" class="peer sr-only"
                                                   :checked="selectedServiceId == <?php echo e($service->id); ?>">
                                            <div class="p-3 sm:p-4 rounded-xl border-2 transition-all duration-200 text-center"
                                                 :class="selectedServiceId == <?php echo e($service->id); ?>

                                                     ? 'border-primary-500 bg-primary-50'
                                                     : 'border-gray-200 hover:border-primary-300'">
                                                <div class="text-2xl sm:text-3xl mb-1"><?php echo e($service->icon); ?></div>
                                                <p class="font-bold text-gray-900 text-sm"><?php echo e($service->name); ?></p>
                                                <p class="text-xs text-gray-500 mt-1">TK <?php echo e(number_format($service->base_fare, 0)); ?></p>
                                            </div>
                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <!-- Pickup Address -->
                            <div class="mb-3">
                                <label for="pickup_address" class="block text-sm font-semibold text-gray-700 mb-1.5"><?php echo e(__('app.pickup_address')); ?></label>
                                <div class="flex gap-2">
                                    <div class="flex-1 relative">
                                        <input type="text" name="pickup_address" id="pickup_address"
                                               x-model="pickupAddress"
                                               @input.debounce.500ms="geocodePickup()"
                                               class="input-field pr-8" placeholder="<?php echo e(__('app.pickup_placeholder')); ?>" required>
                                        <div class="absolute right-2 top-1/2 -translate-y-1/2" x-show="pickupLoading" x-transition>
                                            <div class="w-4 h-4 border-2 border-primary-500 border-t-transparent rounded-full animate-spin"></div>
                                        </div>
                                    </div>
                                    <button type="button" @click="setPickupFromMap()"
                                        class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition" title="<?php echo e(__('app.set_from_map')); ?>">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <input type="hidden" name="pickup_lat" :value="pickupLat">
                                <input type="hidden" name="pickup_lng" :value="pickupLng">
                            </div>

                            <!-- Dropoff Address -->
                            <div class="mb-4">
                                <label for="dropoff_address" class="block text-sm font-semibold text-gray-700 mb-1.5"><?php echo e(__('app.dropoff_address')); ?></label>
                                <div class="flex gap-2">
                                    <div class="flex-1 relative">
                                        <input type="text" name="dropoff_address" id="dropoff_address"
                                               x-model="dropoffAddress"
                                               @input.debounce.500ms="geocodeDropoff()"
                                               class="input-field pr-8" placeholder="<?php echo e(__('app.dropoff_placeholder')); ?>" required>
                                        <div class="absolute right-2 top-1/2 -translate-y-1/2" x-show="dropoffLoading" x-transition>
                                            <div class="w-4 h-4 border-2 border-primary-500 border-t-transparent rounded-full animate-spin"></div>
                                        </div>
                                    </div>
                                    <button type="button" @click="setDropoffFromMap()"
                                        class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition" title="<?php echo e(__('app.set_from_map')); ?>">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <input type="hidden" name="dropoff_lat" :value="dropoffLat">
                                <input type="hidden" name="dropoff_lng" :value="dropoffLng">
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-5">
                                <label class="block text-sm font-semibold text-gray-700 mb-2"><?php echo e(__('app.payment_method')); ?></label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="relative cursor-pointer" @click="paymentMethod = 'cash'">
                                        <input type="radio" name="payment_method" value="cash" class="peer sr-only"
                                               :checked="paymentMethod === 'cash'">
                                        <div class="p-3 rounded-xl border-2 flex items-center gap-2 transition-all duration-200"
                                             :class="paymentMethod === 'cash'
                                                 ? 'border-primary-500 bg-primary-50'
                                                 : 'border-gray-200 hover:border-primary-300'">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900 text-sm">Cash</p>
                                                <p class="text-xs text-gray-500">Pay driver</p>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer" @click="paymentMethod = 'bkash'">
                                        <input type="radio" name="payment_method" value="bkash" class="peer sr-only"
                                               :checked="paymentMethod === 'bkash'">
                                        <div class="p-3 rounded-xl border-2 flex items-center gap-2 transition-all duration-200"
                                             :class="paymentMethod === 'bkash'
                                                 ? 'border-primary-500 bg-primary-50'
                                                 : 'border-gray-200 hover:border-primary-300'">
                                            <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center shrink-0">
                                                <span class="text-pink-600 font-bold text-xs">bK</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900 text-sm">bKash</p>
                                                <p class="text-xs text-gray-500">Mobile pay</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <input type="hidden" name="payment_method" :value="paymentMethod">
                            </div>

                            <!-- Fare Summary -->
                            <div class="mb-5 p-4 bg-gray-50 rounded-xl space-y-2">
                                <div class="flex justify-between items-center" x-show="distance > 0">
                                    <span class="text-sm text-gray-500"><?php echo e(__('app.distance')); ?></span>
                                    <span class="text-sm font-semibold text-gray-900" x-text="distance.toFixed(2) + ' km'"></span>
                                </div>
                                <div class="flex justify-between items-center" x-show="distance > 0">
                                    <span class="text-sm text-gray-500"><?php echo e(__('app.base_fare')); ?></span>
                                    <span class="text-sm font-semibold text-gray-900" x-text="'TK ' + (selectedService ? selectedService.base_fare.toFixed(2) : '0.00')"></span>
                                </div>
                                <div class="flex justify-between items-center" x-show="distance > 0">
                                    <span class="text-sm text-gray-500"><?php echo e(__('app.distance_fare')); ?></span>
                                    <span class="text-sm font-semibold text-gray-900" x-text="'TK ' + (selectedService ? (selectedService.per_km_rate * distance).toFixed(2) : '0.00')"></span>
                                </div>
                                <div class="border-t border-gray-200 pt-2 flex justify-between items-center">
                                    <span class="text-sm font-semibold text-gray-700"><?php echo e(__('app.total_fare')); ?></span>
                                    <span class="text-lg font-bold text-gray-900" x-text="'TK ' + estimatedFare.toFixed(2)"></span>
                                </div>
                            </div>

                            <button type="submit" class="btn-primary w-full"
                                    :disabled="!canSubmit"
                                    :class="{ 'opacity-50 cursor-not-allowed': !canSubmit }">
                                <?php echo e(__('app.confirm_booking')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function bookingMap({ services, orsApiKey, errors }) {
            return {
                services,
                orsApiKey,
                errors,
                selectedServiceId: null,
                pickupAddress: '',
                pickupLat: null,
                pickupLng: null,
                dropoffAddress: '',
                dropoffLat: null,
                dropoffLng: null,
                paymentMethod: 'cash',
                distance: 0,
                estimatedTime: 0,
                pickupLoading: false,
                dropoffLoading: false,
                map: null,
                pickupMarker: null,
                dropoffMarker: null,
                routeLine: null,
                settingPickup: false,
                settingDropoff: false,

                init() {
                    this.initMap();
                },

                initMap() {
                    this.map = L.map('booking-map').setView([23.8103, 90.4125], 12);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19,
                    }).addTo(this.map);

                    this.map.on('click', (e) => {
                        if (this.settingPickup) {
                            this.placePickup(e.latlng.lat, e.latlng.lng);
                            this.settingPickup = false;
                            this.updateMapCursor('default');
                        } else if (this.settingDropoff) {
                            this.placeDropoff(e.latlng.lat, e.latlng.lng);
                            this.settingDropoff = false;
                            this.updateMapCursor('default');
                        } else if (!this.pickupLat) {
                            this.placePickup(e.latlng.lat, e.latlng.lng);
                        } else if (!this.dropoffLat) {
                            this.placeDropoff(e.latlng.lat, e.latlng.lng);
                        }
                    });
                },

                updateMapCursor(type) {
                    const container = document.getElementById('booking-map');
                    if (type === 'pickup') {
                        container.style.cursor = 'crosshair';
                    } else if (type === 'dropoff') {
                        container.style.cursor = 'crosshair';
                    } else {
                        container.style.cursor = '';
                    }
                },

                setPickupFromMap() {
                    this.settingPickup = true;
                    this.settingDropoff = false;
                    this.updateMapCursor('pickup');
                },

                setDropoffFromMap() {
                    this.settingDropoff = true;
                    this.settingPickup = false;
                    this.updateMapCursor('dropoff');
                },

                placePickup(lat, lng) {
                    this.pickupLat = lat;
                    this.pickupLng = lng;

                    if (this.pickupMarker) {
                        this.map.removeLayer(this.pickupMarker);
                    }

                    const icon = L.divIcon({
                        className: 'custom-marker',
                        html: '<div style="background:#10b981;width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);"></div>',
                        iconSize: [24, 24],
                        iconAnchor: [12, 12],
                    });

                    this.pickupMarker = L.marker([lat, lng], { icon }).addTo(this.map);
                    this.reverseGeocode(lat, lng, 'pickup');
                    this.fitMapBounds();
                    this.fetchRoute();
                },

                placeDropoff(lat, lng) {
                    this.dropoffLat = lat;
                    this.dropoffLng = lng;

                    if (this.dropoffMarker) {
                        this.map.removeLayer(this.dropoffMarker);
                    }

                    const icon = L.divIcon({
                        className: 'custom-marker',
                        html: '<div style="background:#ef4444;width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);"></div>',
                        iconSize: [24, 24],
                        iconAnchor: [12, 12],
                    });

                    this.dropoffMarker = L.marker([lat, lng], { icon }).addTo(this.map);
                    this.reverseGeocode(lat, lng, 'dropoff');
                    this.fitMapBounds();
                    this.fetchRoute();
                },

                fitMapBounds() {
                    if (this.pickupLat && this.dropoffLat) {
                        const bounds = L.latLngBounds(
                            [this.pickupLat, this.pickupLng],
                            [this.dropoffLat, this.dropoffLng]
                        );
                        this.map.fitBounds(bounds, { padding: [50, 50] });
                    } else if (this.pickupLat) {
                        this.map.setView([this.pickupLat, this.pickupLng], 14);
                    }
                },

                async reverseGeocode(lat, lng, type) {
                    try {
                        const response = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18`
                        );
                        const data = await response.json();
                        if (data.display_name) {
                            const short = data.display_name.split(',').slice(0, 3).join(',');
                            if (type === 'pickup') {
                                this.pickupAddress = short;
                            } else {
                                this.dropoffAddress = short;
                            }
                        }
                    } catch (e) {
                        console.warn('Reverse geocoding failed:', e);
                    }
                },

                async fetchRoute() {
                    if (!this.pickupLat || !this.pickupLng || !this.dropoffLat || !this.dropoffLng) return;
                    if (!this.orsApiKey) {
                        this.calculateSimpleDistance();
                        return;
                    }

                    try {
                        const response = await fetch(
                            `https://api.openrouteservice.org/v2/directions/driving-car/geojson`,
                            {
                                method: 'POST',
                                headers: {
                                    'Authorization': this.orsApiKey,
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    coordinates: [
                                        [this.pickupLng, this.pickupLat],
                                        [this.dropoffLng, this.dropoffLat],
                                    ],
                                }),
                            }
                        );

                        if (!response.ok) throw new Error('ORS request failed');

                        const data = await response.json();
                        const segment = data.features[0].properties.segments[0];
                        this.distance = segment.distance / 1000;
                        this.estimatedTime = Math.ceil(segment.duration / 60);

                        this.drawRoute(data.features[0].geometry.coordinates);
                    } catch (e) {
                        console.warn('ORS routing failed, using fallback:', e);
                        this.calculateSimpleDistance();
                    }
                },

                drawRoute(coordinates) {
                    if (this.routeLine) {
                        this.map.removeLayer(this.routeLine);
                    }

                    const latLngs = coordinates.map(c => [c[1], c[0]]);
                    this.routeLine = L.polyline(latLngs, {
                        color: '#6366f1',
                        weight: 5,
                        opacity: 0.8,
                        dashArray: null,
                    }).addTo(this.map);
                },

                calculateSimpleDistance() {
                    const R = 6371;
                    const dLat = (this.dropoffLat - this.pickupLat) * Math.PI / 180;
                    const dLng = (this.dropoffLng - this.pickupLng) * Math.PI / 180;
                    const a = Math.sin(dLat / 2) ** 2 +
                              Math.cos(this.pickupLat * Math.PI / 180) * Math.cos(this.dropoffLat * Math.PI / 180) *
                              Math.sin(dLng / 2) ** 2;
                    this.distance = R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    this.estimatedTime = Math.ceil(this.distance * 3);

                    if (this.pickupLat && this.dropoffLat) {
                        if (this.routeLine) this.map.removeLayer(this.routeLine);
                        this.routeLine = L.polyline(
                            [[this.pickupLat, this.pickupLng], [this.dropoffLat, this.dropoffLng]],
                            { color: '#6366f1', weight: 5, opacity: 0.8, dashArray: '10, 10' }
                        ).addTo(this.map);
                    }
                },

                get selectedService() {
                    return this.services.find(s => s.id == this.selectedServiceId) || null;
                },

                get estimatedFare() {
                    if (!this.selectedService) return 0;
                    const dist = this.distance > 0 ? this.distance : 5.0;
                    return this.selectedService.base_fare + (this.selectedService.per_km_rate * dist);
                },

                get canSubmit() {
                    return this.selectedServiceId
                        && this.pickupAddress.trim() !== ''
                        && this.dropoffAddress.trim() !== ''
                        && this.pickupLat !== null
                        && this.dropoffLat !== null;
                },

                selectService(id) {
                    this.selectedServiceId = id;
                },

                async geocodePickup() {
                    if (!this.pickupAddress || this.pickupAddress.length < 3) return;
                    this.pickupLoading = true;
                    try {
                        const response = await fetch(
                            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(this.pickupAddress)}&limit=1&countrycodes=bd`
                        );
                        const data = await response.json();
                        if (data.length > 0) {
                            const { lat, lon } = data[0];
                            this.placePickup(parseFloat(lat), parseFloat(lon));
                        }
                    } catch (e) {
                        console.warn('Geocoding failed:', e);
                    } finally {
                        this.pickupLoading = false;
                    }
                },

                async geocodeDropoff() {
                    if (!this.dropoffAddress || this.dropoffAddress.length < 3) return;
                    this.dropoffLoading = true;
                    try {
                        const response = await fetch(
                            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(this.dropoffAddress)}&limit=1&countrycodes=bd`
                        );
                        const data = await response.json();
                        if (data.length > 0) {
                            const { lat, lon } = data[0];
                            this.placeDropoff(parseFloat(lat), parseFloat(lon));
                        }
                    } catch (e) {
                        console.warn('Geocoding failed:', e);
                    } finally {
                        this.dropoffLoading = false;
                    }
                },
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            const activeMapEl = document.getElementById('active-ride-map');
            if (activeMapEl) {
                const pickupLat = parseFloat(activeMapEl.dataset.pickupLat);
                const pickupLng = parseFloat(activeMapEl.dataset.pickupLng);
                const dropoffLat = parseFloat(activeMapEl.dataset.dropoffLat);
                const dropoffLng = parseFloat(activeMapEl.dataset.dropoffLng);

                const map = L.map(activeMapEl).setView([pickupLat, pickupLng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19,
                }).addTo(map);

                const pickupIcon = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="background:#10b981;width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);"></div>',
                    iconSize: [24, 24],
                    iconAnchor: [12, 12],
                });

                const dropoffIcon = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="background:#ef4444;width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);"></div>',
                    iconSize: [24, 24],
                    iconAnchor: [12, 12],
                });

                L.marker([pickupLat, pickupLng], { icon: pickupIcon }).addTo(map);
                L.marker([dropoffLat, dropoffLng], { icon: dropoffIcon }).addTo(map);

                L.polyline(
                    [[pickupLat, pickupLng], [dropoffLat, dropoffLng]],
                    { color: '#6366f1', weight: 5, opacity: 0.8, dashArray: '10, 10' }
                ).addTo(map);

                map.fitBounds(
                    L.latLngBounds([pickupLat, pickupLng], [dropoffLat, dropoffLng]),
                    { padding: [50, 50] }
                );
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Hi\OneDrive\Documents\GoRide\go_ride\resources\views/dashboard.blade.php ENDPATH**/ ?>