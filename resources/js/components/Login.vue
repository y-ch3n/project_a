<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form @submit.prevent="login">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus v-model="email">

<!--                                    @error('email')-->
<!--                                    <span class="invalid-feedback" role="alert">-->
<!--                                        <strong>{{ $message }}</strong>-->
<!--                                    </span>-->
<!--                                    @enderror-->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="password">

<!--                                    @error('password')-->
<!--                                    <span class="invalid-feedback" role="alert">-->
<!--                                        <strong>{{ $message }}</strong>-->
<!--                                    </span>-->
<!--                                    @enderror-->
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Login</button>

<!--                                    @if (Route::has('password.request'))-->
<!--                                    <a class="btn btn-link" href="{{ route('password.request') }}">-->
<!--                                        {{ __('Forgot Your Password?') }}-->
<!--                                    </a>-->
<!--                                    @endif-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import env from '../env';
    export default {
        data: () => {
            return {
                email: null,
                password: null,
            }
        },
        methods: {
            login() {
                swal.loading();
                axios.post(env.app_domain+'oauth/token', {
                    'grant_type': 'password',
                    'client_id': env.client_id,
                    'client_secret': env.client_secret,
                    'username': this.email,
                    'password': this.password,
                }).then(response => {
                    // store the access token
                    this.$store.commit('authenticate', response.data.access_token);
                    swal.success("Successfully login")
                        .then(() => {
                            this.$router.push("/")
                        });
                }). catch(error => {
                    if (error.response.status === 400) {
                        swal.error("The email or password is not matched with our record. Please try again");
                    } else {
                        swal.error("Please contact our customer service for further assistance.");
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
