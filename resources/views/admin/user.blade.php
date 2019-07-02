<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.header')
</head>

<body>
@include('admin.layouts.sidenav')

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
                                @if(\Illuminate\Support\Facades\Auth::user()->level==2)
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

@include('admin.layouts.script')

</body>
</html>
