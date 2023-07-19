  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-7">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header">
                      <h3 class="text-center font-weight-light my-4">Create Account</h3>
                  </div>
                  <div class="card-body">
                      <form>
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <div class="form-floating mb-3 mb-md-0">
                                      <input class="form-control" id="inputFirstName" type="text"
                                          placeholder="Enter your first name" />
                                      <label for="inputFirstName">First name</label>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-floating">
                                      <input class="form-control" id="inputLastName" type="text"
                                          placeholder="Enter your last name" />
                                      <label for="inputLastName">Last name</label>
                                  </div>
                              </div>
                          </div>
                          <div class="form-floating mb-3">
                              <input class="form-control" id="inputEmail" type="email"
                                  placeholder="name@example.com" />
                              <label for="inputEmail">Email address</label>
                          </div>
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <div class="form-floating mb-3 mb-md-0">
                                      <input class="form-control" id="inputPassword" type="password"
                                          placeholder="Create a password" />
                                      <label for="inputPassword">Password</label>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-floating mb-3 mb-md-0">
                                      <input class="form-control" id="inputMobile" type="text"
                                          placeholder="mobile no" />
                                      <label for="inputMobile">Mobile</label>
                                  </div>
                              </div>
                              {{-- <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div> --}}
                          </div>
                          <div class="mt-4 mb-0">
                              <div class="d-grid"><a onclick="OnRegistration()" class="btn btn-primary btn-block">Create
                                      Account</a></div>
                          </div>
                      </form>
                  </div>
                  <div class="card-footer text-center py-3">
                      <div class="small"><a href="{{ url('/userLogin') }}">Have an account? Go to login</a></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script>
      async function OnRegistration() {

          let firstName = document.getElementById('inputFirstName').value;
          let lastName = document.getElementById('inputLastName').value;
          let email = document.getElementById('inputEmail').value;
          let mobile = document.getElementById('inputMobile').value;
          let password = document.getElementById('inputPassword').value;

          if (firstName.length === 0) {
              errorToast('firstName is required')
          } else if (lastName.length === 0) {
              errorToast('lastName is required')
          } else if (email.length === 0) {
              errorToast('email is required')
          } else if (mobile.length === 0) {
              errorToast('mobile is required')
          } else if (password.length === 0) {
              errorToast('password is required')
          } else {
              showLoader();
              const res = await axios.post('/user-registration', {
                  firstName: firstName,
                  lastName: lastName,
                  email: email,
                  mobile: mobile,
                  password: password
              });
              hideLoader();
              if (res.status === 200 && res.data['status'] == 'success') {
                  successToast(res.data['message']);
                  setTimeout(() => {
                      window.location.href = '/userLogin';
                  }, 2000);

              } else {
                  errorToast(res.data['message']);
              }
          }
      }
  </script>
