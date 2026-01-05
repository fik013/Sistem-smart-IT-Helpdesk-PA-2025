    <form method="post" action="{{ route('password.update') }}" class="flex flex-col gap-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-[#324867] bg-white dark:bg-[#101822] text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm sm:text-sm" autocomplete="current-password" />
            <div class="flex justify-between items-center mt-1">
                <x-input-error :messages="$errors->updatePassword->get('current_password')" />
                <a href="{{ route('password.request') }}" class="text-xs text-primary hover:text-blue-600 dark:hover:text-blue-400 font-medium">Lupa Password?</a>
            </div>
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-[#324867] bg-white dark:bg-[#101822] text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm sm:text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-[#324867] bg-white dark:bg-[#101822] text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm sm:text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-4 py-2 bg-slate-800 dark:bg-slate-700 hover:bg-slate-700 dark:hover:bg-slate-600 text-white font-bold rounded-lg shadow-lg transition-all">Update Password</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 dark:text-emerald-400 font-medium"
                >{{ __('Berhasil diupdate.') }}</p>
            @endif
        </div>
    </form>
