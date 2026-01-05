    <form method="post" action="{{ route('profile.update') }}" class="flex flex-col gap-5" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Avatar Upload -->
        <div class="flex items-center gap-4" x-data="{ photoName: null, photoPreview: null }">
            <!-- Profile Photo File Input -->
            <input type="file" id="avatar" name="avatar" class="hidden"
                        x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="rounded-full h-20 w-20 object-cover border border-slate-200 dark:border-[#324867]">
                @else
                    <div class="rounded-full h-20 w-20 bg-slate-100 dark:bg-[#324867] flex items-center justify-center text-slate-400">
                        <span class="material-symbols-outlined text-4xl">person</span>
                    </div>
                @endif
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center border border-slate-200 dark:border-[#324867]"
                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <div class="flex flex-col">
                 <x-secondary-button class="mt-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Pilih Foto Baru') }}
                </x-secondary-button>
                <span class="text-xs text-slate-500 mt-1" x-text="photoName ? photoName : 'Format: JPG, PNG (Max 1MB)'"></span>
                 @if($errors->has('avatar'))
                    <span class="text-xs text-red-500 mt-1">{{ $errors->first('avatar') }}</span>
                 @endif
            </div>
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nama Lengkap</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-[#324867] bg-white dark:bg-[#101822] text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-[#324867] bg-white dark:bg-[#101822] text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-slate-800 dark:text-slate-200">
                        {{ __('Alamat email belum diverifikasi.') }}
                        <button form="send-verification" class="underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Tautan verifikasi baru telah dikirim ke email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-4 py-2 bg-primary hover:bg-blue-600 text-white font-bold rounded-lg shadow-lg shadow-primary/30 transition-all">Simpan Perubahan</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 dark:text-emerald-400 font-medium"
                >{{ __('Berhasil disimpan.') }}</p>
            @endif
        </div>
    </form>
