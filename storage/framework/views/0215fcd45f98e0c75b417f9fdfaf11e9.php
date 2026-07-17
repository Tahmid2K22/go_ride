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
                        <div class="mt-6 p-4 bg-amber-50 rounded-xl border border-amber-100">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                                    <div class="absolute inset-0 w-3 h-3 bg-amber-500 rounded-full animate-ping"></div>
                                </div>
                                <p class="text-sm font-medium text-amber-700"><?php echo e(__('app.finding_drivers')); ?></p>
                            </div>
                        </div>
                    <?php elseif($activeRide->status === 'accepted'): ?>
                        <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                    <div class="absolute inset-0 w-3 h-3 bg-blue-500 rounded-full animate-ping"></div>
                                </div>
                                <p class="text-sm font-medium text-blue-700"><?php echo e(__('app.driver_coming')); ?></p>
                            </div>
                        </div>
                    <?php elseif($activeRide->status === 'ongoing'): ?>
                        <div class="mt-6 p-4 bg-green-50 rounded-xl border border-green-100">
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
            <?php else: ?>
                <!-- Book a Ride Form -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100" x-data="{ selectedService: null, services: <?php echo e(Js::from($services->map(fn($s) => ['id' => $s->id, 'base_fare' => $s->base_fare, 'per_km_rate' => $s->per_km_rate]))); ?> }">
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

                    <form method="POST" action="<?php echo e(route('rides.store')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Service Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3"><?php echo e(__('app.select_service')); ?></label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="relative cursor-pointer"
                                           @click="selectedService = <?php echo e($service->id); ?>">
                                        <input type="radio" name="service_id" value="<?php echo e($service->id); ?>" class="peer sr-only"
                                               <?php echo e(old('service_id') == $service->id ? 'checked' : ''); ?>>
                                        <div class="p-5 rounded-2xl border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:border-primary-300 transition-all duration-200">
                                            <div class="text-3xl mb-2"><?php echo e($service->icon); ?></div>
                                            <p class="font-bold text-gray-900"><?php echo e($service->name); ?></p>
                                            <p class="text-sm text-gray-500 mt-1">TK <?php echo e(number_format($service->base_fare, 0)); ?> <?php echo e(__('app.base_fare')); ?></p>
                                            <p class="text-xs text-primary-600 font-medium mt-1">TK <?php echo e(number_format($service->per_km_rate, 0)); ?>/<?php echo e(__('app.per_km')); ?></p>
                                        </div>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- Pickup Address -->
                        <div class="mb-4">
                            <label for="pickup_address" class="block text-sm font-semibold text-gray-700 mb-2"><?php echo e(__('app.pickup_address')); ?></label>
                            <input type="text" name="pickup_address" id="pickup_address" value="<?php echo e(old('pickup_address')); ?>"
                                   class="input-field" placeholder="<?php echo e(__('app.pickup_placeholder')); ?>" required>
                        </div>

                        <!-- Dropoff Address -->
                        <div class="mb-6">
                            <label for="dropoff_address" class="block text-sm font-semibold text-gray-700 mb-2"><?php echo e(__('app.dropoff_address')); ?></label>
                            <input type="text" name="dropoff_address" id="dropoff_address" value="<?php echo e(old('dropoff_address')); ?>"
                                   class="input-field" placeholder="<?php echo e(__('app.dropoff_placeholder')); ?>" required>
                        </div>

                        <!-- Fare Preview -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500"><?php echo e(__('app.estimated_fare')); ?></span>
                                <span class="text-lg font-bold text-gray-900" x-text="(() => { const s = services.find(s => s.id == selectedService); return 'TK ' + (s ? (s.base_fare + s.per_km_rate * 5).toFixed(2) : '0.00') })()">TK 0.00</span>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            <?php echo e(__('app.confirm_booking')); ?>

                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
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
<?php /**PATH C:\Users\Hi\OneDrive\Documents\GoRide\go_ride\resources\views\dashboard.blade.php ENDPATH**/ ?>