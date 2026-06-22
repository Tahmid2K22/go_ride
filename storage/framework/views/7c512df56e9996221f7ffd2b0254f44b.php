<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="<?php echo e(route('dashboard')); ?>" class="text-xl font-bold text-primary-600">
                        GoRide
                    </a>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex">
                    <?php $active = request()->routeIs('dashboard'); ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo e($active ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'); ?> transition duration-150">
                        Dashboard
                    </a>
                </div>
            </div>

            <?php if(auth()->guard()->check()): ?>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <div @click="open = ! open">
                        <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition duration-150">
                            <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center text-sm font-semibold"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                            <span class="hidden sm:inline"><?php echo e(Auth::user()->name); ?></span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </button>
                    </div>

                    <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-50 mt-2 w-48 rounded-xl shadow-lg border border-gray-100 ltr:origin-top-right rtl:origin-top-left end-0 py-1"
                            style="display: none;"
                            @click="open = false">
                        <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150">Profile</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-150">Log out</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <?php if(auth()->guard()->check()): ?>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-1 space-y-1">
            <?php $active = request()->routeIs('dashboard'); ?>
            <a href="<?php echo e(route('dashboard')); ?>" class="block px-4 py-2 text-sm font-medium <?php echo e($active ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'); ?> transition duration-150">Dashboard</a>
        </div>

        <div class="pt-1 pb-3 border-t border-gray-100">
            <div class="px-4 py-2">
                <div class="font-medium text-sm text-gray-800"><?php echo e(Auth::user()->name); ?></div>
                <div class="text-xs text-gray-500"><?php echo e(Auth::user()->email); ?></div>
            </div>

            <div class="mt-1 space-y-1">
                <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition duration-150">Profile</a>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-150">Log out</button>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
</nav>
<?php /**PATH C:\Users\Hi\OneDrive\Documents\GoRide\go_ride\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>