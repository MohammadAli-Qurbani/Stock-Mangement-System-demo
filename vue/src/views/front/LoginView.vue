<template>
  <div class="container">
    <section
      class="marginTop section register mt-5 d-flex flex-column align-items-center justify-content-center"
    >
      <div class="container mt-4">
        <div class="row justify-content-center">
          <div
            class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
          >
            <div class="card">
              <div class="card-body">
                <div class="pb-2">
                  <h5 class="card-title text-center">Login To System</h5>
                </div>

                <form class="row g-3 needs-validation" novalidate @submit.prevent="auth" id="loginForm">
                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input
                        type="email"
                        name="email"
                        class="form-control"
                        id="email"
                        required
                      />
                      <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input
                      type="password"
                      name="password"
                      class="form-control"
                      id="yourPassword"
                      required
                    />


                    <p class="text-danger" v-if="loginStore.errors.email">{{ loginStore.errors.email[0] }}</p>
                    <p class="text-danger" v-if="loginStore.errors.length">{{ loginStore.errors }}</p>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>

                </form>
              </div>
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
              Developed by <a href="https://github.com/MohammadAli735/">Mohammad Ali Qurbani</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script setup>
    import {useLoginStore} from '../../stores/login'
    const loginStore=useLoginStore()
    const auth=async()=>{
        const form=document.getElementById("loginForm")
        const formData=new FormData(form)
        await loginStore.login(formData)
    }
</script>
