
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-secondary">
              <ul class="nav nav-tabs card-header-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link fw-medium active" href="#signin-tab" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-unlocked me-2 mt-n1"></i>Masuk</a></li>
                <li class="nav-item"><a class="nav-link fw-medium" href="#signup-tab" data-bs-toggle="tab" role="tab" aria-selected="false"><i class="ci-user me-2 mt-n1"></i>Daftar</a></li>
              </ul>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body tab-content py-4">
              <form method="POST" action="{{route('login')}}" class="needs-validation tab-pane fade show active" autocomplete="off" novalidate id="signin-tab">
                @if(session('error_login'))
                    <!-- Danger alert -->
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="fw-medium">Error:</span> {{session('error_login')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @csrf
                <div class="mb-3">
                  <label class="form-label" for="si-email">Email address</label>
                  <input class="form-control" type="email" name="email" id="si-email" placeholder="email@example.com" required>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="si-password">Password</label>
                  <div class="password-toggle">
                    <input class="form-control" type="password" name="password" id="si-password" required>
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                      <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                    </label>
                  </div>
                </div>
                <div class="mb-3 d-flex flex-wrap justify-content-between">
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="remember" id="si-remember">
                    <label class="form-check-label" for="si-remember">Remember me</label>
                  </div><a class="fs-sm" href="#">Forgot password?</a>
                </div>
                <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign in</button>
              </form>
              <form class="needs-validation tab-pane fade" autocomplete="off" novalidate id="signup-tab">
                <div class="mb-3">
                  <label class="form-label" for="su-name">Nama Lengkap</label>
                  <input class="form-control" type="text" id="su-name" placeholder="Nama Lengkap" required>
                  @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="su-email">Email address</label>
                  <input class="form-control" type="email" id="su-email" placeholder="email@contoh.com" required>
                  @error('email')
                    <div class="invalid-feedback">{{$message}}.</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label" for="su-password">Password</label>
                  <div class="password-toggle">
                    <input class="form-control" type="password" id="su-password" required>
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                      <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                    </label>
                  </div>
                  @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label" for="su-password-confirm">Confirm password</label>
                  <div class="password-toggle">
                    <input class="form-control" type="password" id="su-password-confirm" required>
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                      <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                    </label>
                  </div>
                  @error('c_password')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
                <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign up</button>
              </form>
            </div>
          </div>
        </div>
      </div>