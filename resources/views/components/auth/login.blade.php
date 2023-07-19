  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header">
                      <h3 class="text-center font-weight-light my-4">Login</h3>
                  </div>
                  <div class="card-body">
                      <form>
                          <div class="form-floating mb-3">
                              <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                              <label for="inputEmail">Email address</label>
                          </div>
                          <div class="form-floating mb-3">
                              <input class="form-control" id="inputPassword" type="password" placeholder="Password" />
                              <label for="inputPassword">Password</label>
                          </div>
                          {{-- <div class="form-check mb-3">
                              <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                  value="" />
                              <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                          </div> --}}
                          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                              <a class="small" href="{{ url('/sendOtp') }}">Forgot Password?</a>
                              <a onclick="SubmitLogin()" class="btn btn-primary">Login</a>
                          </div>
                      </form>
                  </div>
                  <div class="card-footer text-center py-3">
                      <div class="small"><a href="{{ url('/userRegistration') }}">Need an account? Sign up!</a></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script>
      async function SubmitLogin() {

          let email = document.getElementById('inputEmail').value;
          let password = document.getElementById('inputPassword').value;

          if (email.length === 0) {
              errorToast('Email is required')
          } else if (password.length === 0) {
              errorToast('password is required')
          } else {
              showLoader();
              const res = await axios.post('/user-login', {
                  email: email,
                  password: password
              });
              hideLoader();
              if (res.status === 200 && res.data['status'] == 'success') {
                  window.location.href = '/dashboard';
              } else {
                  errorToast(res.data['message']);
              }
          }
      }
  </script>
