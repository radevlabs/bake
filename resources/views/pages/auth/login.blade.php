<div class="card card-primary">
    <div class="card-header">
        <h4>Login</h4>
    </div>

    <div class="card-body">
        @include('bake::components.alerts')
        <form id="form" wire:submit.prevent="submit($('#form').serializeArray())">
            <div class="form-group">
                <label for="email">
                    Email
                </label>
                <input id="email"
                       name="email"
                       type="text"
                       class="form-control @error('email') is-invalid @enderror"
                       tabindex="1"
                       value="{{ $form['email'] ?? '' }}"
                       autofocus>
                <div class="invalid-feedback">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">
                        Password
                    </label>
                </div>
                <input id="password"
                       name="password"
                       type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       tabindex="2"
                       value="{{ $form['password'] ?? '' }}">
                <div class="invalid-feedback">
                    @error('password') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
