<x-header />
<x-navbar />

<div class="text-center page">
    <h1 class="text-center">Add Task</h1>
    <x-errors />
    <x-mssg />
    <form action="{{url('/Task')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group my-4">
            <label >Title</label>
            <input class="form-control  mx-auto" placeholder="enter title" name="title" value={{ old('email')}}>
        </div>

        <div class="form-group my-4">
            <label>Content</label>
            <input class="form-control  mx-auto" max="100" placeholder="enter content" name="content" value={{ old('email')}}>
        </div>

        <div class="form-group my-4">
            <label for="startDate">Start Date</label>
            <input class="form-control  mx-auto" type="date" name="startDate" >
        </div>

        <div class="form-group my-4">
            <label>End Date</label>
            <input class="form-control  mx-auto" type="date" name="endDate" >
        </div>

        <div class="form-group my-4">
            <label>Image</label>
            <input class="form-control  mx-auto" type="file" name="image" >
        </div>

        <button class="btn btn-primary my-5">Add Task</button>
    </form>
</div>

<x-footer />

