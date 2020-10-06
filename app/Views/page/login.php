<div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <h1>Login</h1>
                <?=form_open(base_url('auth/login'), 'class="form"');?>
                  <input type="hidden" name="goto" value="">
                  <p class="text-muted">Login dengan username dan password Anda</p>
                  <?=session('error_login');?>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon-user"></i>
                      </span>
                    </div>
                    <?=form_input('usernames', '', 'class="form-control" autofocus required');?>
                  </div>
                  <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon-lock"></i>
                      </span>
                    </div>
                    <?=form_password('passwords', '', 'class="form-control" required');?>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button class="btn btn-primary px-4 col-12" type="submit">Login</button>
                    </div>
                    <!-- <div class="col-6 text-right">
                      <button class="btn btn-link px-0" type="button" onclick="return alert('Perubahan password, sementara baru bisa dilakukan oleh admin instansi. Silakan hubungi Admin Instansi...');">Lupa password?</button>
                    </div> -->
                  </div>
                </form>
              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <div class="logo">
                    <span style="margin-left: 10px; font-weight: bold; font-family: 'Teko', sans-serif; color: #274e5d; font-size: 43pt">APP-POS</span>
                  </div>

                  <h3>Aplikasi Point Of Sales (POS)</h3>
                </div>

              </div>
            </div>
          </div>
          

          <br>
        </div>
      </div>
    </div>
