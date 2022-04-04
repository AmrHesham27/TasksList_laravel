<x-header />
<x-navbar />
    <div class="page text-center">
        <h1>Login</h1>
        <x-errors />
        <x-mssg />
        <form action="<?php echo url('/loginAction');?>" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group my-4">
                <label>Email</label>
                <input class="form-control  mx-auto" placeholder="enter your email" name="email" value={{ old('email')}}>
            </div>
            <div class="form-group my-4">
                <label>Password</label>
                <input class="form-control  mx-auto" type="password" name="password" >
            </div>
            <button class="btn btn-primary">Login</button>
        </form>
    </div>
<x-footer/>
