<x-header />
<x-navbar />

<div class="page text-center">
    <h1>Register</h1>
    <x-errors />
    <x-mssg />
    <form action="{{url('/User')}}" method="post">
        @csrf
        <div class="form-group my-4">
            <label>Name</label>
            <input  class="form-control  mx-auto" placeholder="enter your name" name="name" value={{ old('email')}}>
        </div>

        <div class="form-group my-4">
            <label>Email</label>
            <input class="form-control  mx-auto" placeholder="enter your email" name="email" value={{ old('email')}}>
        </div>

        <div class="form-group my-4">
            <label>Password</label>
            <input class="form-control  mx-auto"  type="password" name="password" >
        </div>

        <div class="form-group my-4">
            <label>Confirm Password</label>
            <input class="form-control  mx-auto"  type="password" name="password_confirmation" >
        </div>

        <button class="btn btn-primary my-5">Register</button>
    </form>
</div>

<x-footer/>

