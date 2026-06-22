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
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImVudmxvcGUiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMSI+PHBhdGggZD0iTTM2IDM0djItSDJ2LTJoMzR6TTM2IDE4djJIMnYtMmgzNHoiLz48L2c+PC9nPjwvc3ZnPg==');"></div>
            <!-- Gradient Orbs -->
            <div class="absolute top-20 left-10 w-96 h-96 bg-primary-400/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-40">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 text-white text-sm font-medium rounded-full mb-8 backdrop-blur-sm border border-white/10">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <?php echo e(__('app.hero_tagline')); ?>

                    </span>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white leading-[1.1]">
                        <?php echo e(__('app.hero_title_short')); ?><br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-200 to-primary-300">Go<span class="text-white">Ride</span></span>
                    </h1>
                    <p class="mt-8 text-xl text-primary-100/90 leading-relaxed max-w-lg">
                        <?php echo e(__('app.hero_title')); ?>

                    </p>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="<?php echo e(route('register')); ?>" class="group px-8 py-4 bg-white text-primary-700 font-bold rounded-2xl hover:bg-primary-50 transition-all duration-300 shadow-xl shadow-primary-900/30 flex items-center gap-3">
                            <?php echo e(__('app.get_started')); ?>

                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                        <a href="#services" class="px-8 py-4 bg-white/10 text-white font-bold rounded-2xl hover:bg-white/20 transition-all duration-300 border border-white/20 backdrop-blur-sm">
                            <?php echo e(__('app.explore_services')); ?>

                        </a>
                    </div>
                    <!-- Trust Indicators -->
                    <div class="mt-12 flex items-center gap-8">
                        <div class="flex -space-x-3">
                            <?php for($i = 0; $i < 4; $i++): ?>
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-300 to-primary-500 border-2 border-primary-700 flex items-center justify-center text-white text-xs font-bold">
                                    <?php echo e(chr(65 + $i)); ?>

                                </div>
                            <?php endfor; ?>
                        </div>
                        <div>
                            <div class="text-white font-semibold">2M+ Riders</div>
                            <div class="text-primary-200 text-sm">Trust GoRide daily</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="relative hidden lg:block">
                    <div class="relative bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20">
                        <div class="bg-gradient-to-br from-primary-500/80 to-primary-700/80 rounded-2xl p-8">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                </div>
                                <div>
                                    <div class="text-white font-semibold">Find Your Ride</div>
                                    <div class="text-primary-100 text-sm">Pickup: Dhanmondi 27</div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="bg-white/10 rounded-xl p-4 flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-primary-400/30 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-white text-sm font-medium">Bike</div>
                                        <div class="text-primary-200 text-xs">3 min away</div>
                                    </div>
                                    <div class="text-white font-semibold">Tk 45</div>
                                </div>
                                <div class="bg-white/10 rounded-xl p-4 flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-amber-400/30 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-white text-sm font-medium">Car</div>
                                        <div class="text-primary-200 text-xs">5 min away</div>
                                    </div>
                                    <div class="text-white font-semibold">Tk 120</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-white rounded-2xl shadow-xl flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-600">4.8</div>
                            <div class="flex gap-0.5 justify-center">
                                <?php for($i = 0; $i < 5; $i++): ?>
                                    <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-xl p-4 flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <div class="text-gray-900 font-semibold text-sm">Trip Completed</div>
                            <div class="text-gray-500 text-xs">Just now</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/60">
            <span class="text-xs font-medium">Scroll to explore</span>
            <div class="w-6 h-10 rounded-full border-2 border-white/30 flex justify-center pt-2">
                <div class="w-1.5 h-3 bg-white/60 rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-white relative -mt-16 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sm:p-10">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary-50 mb-4">
                            <svg class="w-7 h-7 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5" /></svg>
                        </div>
                        <div class="text-4xl sm:text-5xl font-extrabold text-gray-900">2M+</div>
                        <p class="mt-2 text-gray-500 font-medium"><?php echo e(__('app.app_downloads')); ?></p>
                    </div>
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-amber-50 mb-4">
                            <svg class="w-7 h-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        <div class="text-4xl sm:text-5xl font-extrabold text-gray-900">50M+</div>
                        <p class="mt-2 text-gray-500 font-medium"><?php echo e(__('app.trips_completed')); ?></p>
                    </div>
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-emerald-50 mb-4">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        </div>
                        <div class="text-4xl sm:text-5xl font-extrabold text-gray-900">100K+</div>
                        <p class="mt-2 text-gray-500 font-medium"><?php echo e(__('app.active_drivers')); ?></p>
                    </div>
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-rose-50 mb-4">
                            <svg class="w-7 h-7 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                        </div>
                        <div class="text-4xl sm:text-5xl font-extrabold text-gray-900">50+</div>
                        <p class="mt-2 text-gray-500 font-medium"><?php echo e(__('app.cities_covered')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 text-sm font-semibold rounded-full mb-4"><?php echo e(__('app.our_services')); ?></span>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900"><?php echo e(__('app.services_subtitle')); ?></h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Bike -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-primary-200 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-50 rounded-bl-[80px] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mb-6 shadow-lg shadow-primary-500/30 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900"><?php echo e(__('app.bike')); ?></h3>
                        <p class="mt-3 text-gray-500 text-sm leading-relaxed"><?php echo e(__('app.bike_desc')); ?></p>
                        <a href="#" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-primary-700 group/link">
                            <?php echo e(__('app.learn_more')); ?>

                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
                <!-- Car -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-amber-200 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center mb-6 shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900"><?php echo e(__('app.car')); ?></h3>
                        <p class="mt-3 text-gray-500 text-sm leading-relaxed"><?php echo e(__('app.car_desc')); ?></p>
                        <a href="#" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-amber-600 hover:text-amber-700 group/link">
                            <?php echo e(__('app.learn_more')); ?>

                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
                <!-- Food -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-rose-200 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[80px] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center mb-6 shadow-lg shadow-rose-500/30 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900"><?php echo e(__('app.food')); ?></h3>
                        <p class="mt-3 text-gray-500 text-sm leading-relaxed"><?php echo e(__('app.food_desc')); ?></p>
                        <a href="#" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-rose-600 hover:text-rose-700 group/link">
                            <?php echo e(__('app.learn_more')); ?>

                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
                <!-- Parcel -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-emerald-200 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900"><?php echo e(__('app.parcel')); ?></h3>
                        <p class="mt-3 text-gray-500 text-sm leading-relaxed"><?php echo e(__('app.parcel_desc')); ?></p>
                        <a href="#" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700 group/link">
                            <?php echo e(__('app.learn_more')); ?>

                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 text-sm font-semibold rounded-full mb-4"><?php echo e(__('app.about')); ?></span>
                    <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight"><?php echo e(__('app.why_choose')); ?></h2>
                    <p class="mt-6 text-lg text-gray-500 leading-relaxed"><?php echo e(__('app.why_subtitle')); ?></p>
                    <div class="mt-10 space-y-6">
                        <div class="flex items-start gap-5 p-5 rounded-2xl hover:bg-gray-50 transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg"><?php echo e(__('app.safe_secure')); ?></h4>
                                <p class="mt-1 text-gray-500"><?php echo e(__('app.safe_desc')); ?></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5 p-5 rounded-2xl hover:bg-gray-50 transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg"><?php echo e(__('app.affordable')); ?></h4>
                                <p class="mt-1 text-gray-500"><?php echo e(__('app.affordable_desc')); ?></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5 p-5 rounded-2xl hover:bg-gray-50 transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg"><?php echo e(__('app.lightning_fast')); ?></h4>
                                <p class="mt-1 text-gray-500"><?php echo e(__('app.fast_desc')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-[2rem] p-10 text-white shadow-2xl shadow-primary-600/30">
                        <div class="text-center">
                            <div class="text-7xl font-extrabold mb-4">4.8</div>
                            <div class="flex justify-center gap-1.5 mb-6">
                                <?php for($i = 0; $i < 5; $i++): ?>
                                    <svg class="w-7 h-7 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <?php endfor; ?>
                            </div>
                            <p class="text-primary-100 text-xl font-medium"><?php echo e(__('app.rated_by')); ?></p>
                        </div>
                    </div>
                    <!-- Decorative -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-primary-200 rounded-2xl -z-10"></div>
                    <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-primary-100 rounded-2xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="download" class="py-24 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-primary-600 rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-1.5 bg-white/10 text-white/90 text-sm font-semibold rounded-full mb-6 backdrop-blur-sm"><?php echo e(__('app.download')); ?></span>
            <h2 class="text-4xl sm:text-5xl font-extrabold text-white"><?php echo e(__('app.download_app')); ?></h2>
            <p class="mt-6 text-lg text-gray-400 max-w-xl mx-auto"><?php echo e(__('app.download_subtitle')); ?></p>
            <div class="mt-12 flex flex-wrap justify-center gap-4">
                <a href="#" class="inline-flex items-center gap-4 px-8 py-4 bg-white text-gray-900 rounded-2xl hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                    <div class="text-left">
                        <div class="text-xs text-gray-500 font-medium">Download on the</div>
                        <div class="text-lg font-bold -mt-0.5"><?php echo e(__('app.app_store')); ?></div>
                    </div>
                </a>
                <a href="#" class="inline-flex items-center gap-4 px-8 py-4 bg-white text-gray-900 rounded-2xl hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.199l2.807 1.626a1 1 0 010 1.732l-2.807 1.626L15.206 12l2.492-2.492zM5.864 2.658L16.8 8.99l-2.302 2.302-8.634-8.634z"/></svg>
                    <div class="text-left">
                        <div class="text-xs text-gray-500 font-medium">Get it on</div>
                        <div class="text-lg font-bold -mt-0.5"><?php echo e(__('app.google_play')); ?></div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-5 gap-10">
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-extrabold text-white mb-4">GoRide</h3>
                    <p class="text-sm leading-relaxed max-w-xs"><?php echo e(__('app.footer_desc')); ?></p>
                    <div class="flex gap-3 mt-6">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4"><?php echo e(__('app.services')); ?></h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.bike')); ?></a></li>
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.car')); ?></a></li>
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.food')); ?></a></li>
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.parcel')); ?></a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4"><?php echo e(__('app.company')); ?></h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.about_us')); ?></a></li>
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.careers')); ?></a></li>
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.blog')); ?></a></li>
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.press')); ?></a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4"><?php echo e(__('app.support')); ?></h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.help_center')); ?></a></li>
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.safety')); ?></a></li>
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.terms')); ?></a></li>
                        <li><a href="#" class="hover:text-white transition"><?php echo e(__('app.privacy')); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm">&copy; <?php echo e(date('Y')); ?> GoRide. <?php echo e(__('app.all_rights')); ?></p>
            </div>
        </div>
    </footer>
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
<?php /**PATH C:\Users\Hi\OneDrive\Documents\GoRide\go_ride\resources\views/home.blade.php ENDPATH**/ ?>