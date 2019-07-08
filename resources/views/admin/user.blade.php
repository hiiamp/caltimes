<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.header')
</head>

<body>
<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{route('home')}}">
            <h1>CALTIMES</h1>
        </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="#">
                            <img src="{{asset('admin/img/brand/blue.png')}}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.list')}}">
                        <i class="ni ni-bullet-list-67 text-red"></i> List management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.user')}}">
                        <i class="ni ni-circle-08 text-pink"></i> User management
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content">

    @include('admin.layouts.navbar')

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">{{$users->name_table}}</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->level == 2)
                                <th scope="col">Level</th>
                            @endif
                            <th scope="col">Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            @if($user->id == 1) @continue
                            @endif
                            @if($user->level == 3) @continue
                            @endif
                        <tr>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            @if(\Illuminate\Support\Facades\Auth::user()->level == 2)
                                <td>
                                    @if($user->level == 2) Admin
                                        @elseif($user->level == 1) User
                                        @else Not validate
                                    @endif
                                </td>
                            @endif
                            <td>
                                <a href="{{route('admin.list').'?user_id='.$user->id}}" class="btn btn-sm btn-primary" style="color: whitesmoke"> List joined </a>
                                @if($user->level != 2)
                                    <a data-index="{{$user->id}}" class="btn btn-sm btn-primary delete_u" style="color: whitesmoke"> Delete </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                    {{$users->links()}}
                    <!--<ul class="pagination">
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<dialog id="deleteuserdialog1">
    <form method="post" action="{{route('delete.user')}}">
        @csrf
        <div class="row form-group">
            <div class="col-md-12">
                <p>You really want to delete this user?</p>
                <input id="user_id_delete" type="hidden" class="form-control" name="user_id" value="">
                <input name="checkadmin" value="true" hidden="hidden">
            </div>
        </div>
        <div class="form-group">
            <input id="delete_submit2" type="submit" value="Yes, I'm sure." class="btn btn-primary">
            <input id="delete_cancel2" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>

<script>
    $(function(){
        var dialog_delete2 = document.querySelector('#deleteuserdialog1');
        $(".delete_u").each(function (index) {
            $(this).click(function () {
                dialog_delete2.showModal();
                var user_id = $(this).attr('data-index');
                $('#user_id_delete').attr('value', user_id);
            });
        });
        document.querySelector('#delete_submit2').onclick = function () {
            dialog_delete2.close();
        };
        document.querySelector('#delete_cancel2').onclick = function () {
            dialog_delete2.close();
        };
    });
</script>

<script type="text/javascript">
    $('#search').on('keyup',function(){
        let search = $('#search').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : '{{ route('searchUser') }}',
            dataType: 'json',
            data:{'search':search},
            success:function(data){
                $('tbody').html(data.table_data);
                console.log(data);
                console.log(data.total_data);
            }
        });
    })
</script>
@include('user.layouts.notification')
</body>
</html>
