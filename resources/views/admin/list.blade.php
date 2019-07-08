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
                    <a class="nav-link active" href="{{route('admin.list')}}">
                        <i class="ni ni-bullet-list-67 text-red"></i> List management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.user')}}">
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
                    <h3 class="mb-0">{{$lists->table_name}}</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Create at</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $list)
                            <tr>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{route('link.board',['code'=>$list->link])}}">{{$list->link}}</a>
                                </td>
                                <td>
                                    {{$list->name}}
                                </td>
                                <td>
                                    {{$list->created_at}}
                                </td>
                                <td>
                                    {{$list->owner}}
                                </td>
                                <td>
                                    <a href="{{route('admin.user').'?list_id='.$list->id}}" class="btn btn-sm btn-primary" style="color: whitesmoke"> Worker </a>
                                    @if(Auth::user()->level==2)
                                        <a data-index="{{$list->id}}" id="Delete{{$list->id}}" class="btn btn-sm btn-primary delete_l" style="color: whitesmoke"> Delete </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                    {{$lists->links()}}
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

<dialog id="deletelistdialog1">
    <form method="post" action="{{route('delete.list')}}">
        @csrf
        <div class="row form-group">
            <div class="col-md-12">
                <p>You really want to delete this list?</p>
                <input id="todo_list_id_delete" type="hidden" class="form-control" name="todo_list_id" value="">
                <input name="checkadmin" value="true" hidden="hidden">
            </div>
        </div>
        <div class="form-group">
            <input id="delete_submit1" type="submit" value="Yes, I'm sure." class="btn btn-primary">
            <input id="delete_cancel1" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>

<script>
    $(function(){
        var dialog_delete = document.querySelector('#deletelistdialog1');
        dialog_delete.close();
        $(".delete_l").each(function (index) {
            $(this).click(function () {
                dialog_delete.showModal();
                var list_id = $(this).attr('data-index');
                $('#todo_list_id_delete').attr('value', list_id);
            });
        });
        document.querySelector('#delete_submit1').onclick = function () {
            dialog_delete.close();
        };
        document.querySelector('#delete_cancel1').onclick = function () {
            dialog_delete.close();
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
            url : '{{ route('searchList') }}',
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

</body>
</html>
