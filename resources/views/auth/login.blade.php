{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}


<x-guest-layout >
    <nav class="uk-background-muted uk-width-1-1 uk-position-fixed  uk-flex " >
        {{-- logo --}}
        <div class="uk-width-1-3 uk-margin-auto-right uk-margin-left">
            <h1 class="uk-text-bold  " style="color: black">DAILY</h1>
            
        </div>

        {{-- auth --}}
        <div class="uk-flex  uk-margin-auto-left">
            <a role="button" href="{{ route('login') }}" class=" uk-button uk-button-default uk-button-small"  style="margin:auto;">Login</a>
            <a role="button" href="{{ route('register') }}" class=" uk-margin-left uk-margin-right uk-button uk-button-primary uk-button-default" style="margin:auto; color:white; ">register</a>
        </div>
      
    </nav>

    <div class="uk-background-muted uk-width-1-1 uk-flex uk-height-viewport ">

        <div class="uk-width-1-2@m uk-visible@m uk-height-viewport">
            left
        </div>
    
        <div class="uk-width-1-2@m  uk-margin-top uk-height-viewport">
            <div class=" uk-padding-small uk-margin-large-top uk-border-rounded  uk-width-3-5@m uk-box-shadow-small " style="background: white;" >

                <div class=" uk-text-center" >
                    <p class=" uk-margin-small uk-text-capitalize uk-text-bold uk-h2 " > {{ __('Login') }} </p>
                </div>
                
                
                <form method="POST" action="{{ route('login') }}" class="uk-form-stacked ">
                    @csrf
                    {{-- email --}}
                    <div>
                        <label class="uk-form-label uk-text-bold uk-text-capitalize " value="{{ __('Email') }}" for="email">email</label>
                        <div class="uk-form-controls">
                            <input class="uk-input  @error('email') uk-form-danger @enderror  " type="email" name="email" :value="old('email')" autocomplete="current-email" required autofocus placeholder="name@exemple.com">
                        </div>
                        @error('email')
                            <span class=" uk-text-capitalize uk-text-danger uk-text-small " > wrong email or password</span>
                        @enderror
                    </div>

                    {{-- password --}}
                    <div class="uk-margin-small-top">
                        <label class="uk-form-label uk-text-bold uk-text-capitalize " value="{{ __('Password') }}" for="password"> password</label>
                        <div class="uk-form-controls">
                            <input type="password" class="uk-input" name="password" required autocomplete="current-password" placeholder="********">
                        </div>
                      
                    </div>

                    {{-- remember --}}
                    <div class="uk-margin-small-top">
                        <label for="remember_me" class="uk-form-label">
                            <input id="remember_me" type="checkbox" class=" uk-checkbox" name="remember">
                            <span class=" uk-margin-small-left uk-text-small ">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    {{-- button --}}
                    <div class="uk-margin-small">
                        <button type="submit" class="uk-button uk-button-primary" style=" color:white;  ;">{{ __('Login') }}</button>
                    
                    </div>
                </form>
    
            </div>
          
        </div>
    
    </div>


</x-guest-layout>
