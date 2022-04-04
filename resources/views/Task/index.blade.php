<x-header />
<x-navbar />

<div class="page">
    <h1 class="text-center">My Tasks</h1>
    <x-mssg />
    <table class="table table-striped table-bordered my-5">
        @if ( $no_of_tasks == 0 )
            <p>you do not have tasks yet.</p>
        @else
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data as $task)
                <tr scope="row">
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->content }}</td>
                    <td>{{ $task->startDate }}</td>
                    <td>{{ $task->endDate }}</td>
                    <td> <img width="100" height="100" src={{ asset('uploads/'.$task->image) }}> </td>
                    <td class="d-flex flex-row">
                        <a href={{'Task/'.$task->id.'/edit'}} class="btn btn-primary mx-2">Edit</a>
                        <form action={{ url('/Task/' . $task->id) }} method="post" class="mx-2">
                            @method('delete')
                            @csrf
                            <input type="hidden" name="endDate" value={{$task->endDate}} readonly>
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        <form action={{ url('/status') }} method="post" class="mx-2">
                            @csrf
                            <input type="hidden" name="id" value={{$task->id}} readonly>
                            <button type="submit" class="btn btn-primary" style="background: white">
                                @if ($task->status)
                                    <i style="color: green" class="fas fa-check"></i>
                                @else
                                    <i class="fas fa-check"></i>
                                @endif
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>

    <!-- pagination -->
    @if ($no_of_tasks != 0)
        <nav aria-label="..." class="mx-auto my-5 pagination">
            <ul class="pagination">
                @php
                    $number_of_pages = ceil($no_of_tasks/7);
                @endphp
                @for ($firstTask = 1; $firstTask <= $no_of_tasks; $firstTask += 7)
                    @php
                        $page = ceil($firstTask / 7);
                    @endphp
                    <li class='page-item' aria-current='page'>
                        <a class='page-link' href={{ url('/'. $firstTask); }}>{{ $page }}</a>
                    </li>
                @endfor
            </ul>
        </nav>
    @endif
</div>
<x-footer/>


