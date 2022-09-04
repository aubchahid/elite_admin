<section id="wrapper">
    <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" wire:submit.prevent="submit">
                    <div class="text-center"><img class="m-b-30 m-t-30 ms-auto me-auto"
                            src="{{ asset('dist/images/logo-light-icon.png') }}" height="40px" alt="-"
                            srcset="">
                    </div>
                    <h3 class="text-center m-b-20">S'identifier </h3>
                    <h6 class="text-center m-b-30">Connectez-vous à votre compte s'il vous plaît </h6>
                    @if (session()->has('message'))
                        <div class="alert alert-danger alert-dismissible text-white" style="background-color:#e46a76">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <span
                                    class="text-white" aria-hidden="true"></span> </button>
                        </div>
                    @endif
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" required="" placeholder="Adresse e-mail"
                                wire:model.lazy="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" placeholder="Mot de passe"
                                wire:model.lazy="password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">

                                <div class="ms-auto">
                                    <a href="javascript:void(0)" id="to-recover" class="text-muted">
                                        Mot de passe oubliée?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button class="btn w-100 btn-lg btn-info btn-rounded text-white" type="submit">
                                <span wire:loading.remove wire:target="submit" class="text-white font-bold">
                                    S'identifier</span>
                                <span wire:loading wire:target="submit" class="text-white font-bold"><i
                                        class="feather-loader"></i>
                                    &nbsp; En cours</span>

                            </button>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg w-100 text-uppercase waves-effect waves-light"
                                type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
