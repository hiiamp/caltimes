<div class="container container1" style="padding-top: 15%">
    <div class="colorlib-featured ">
        <div class="row animate-box">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h2 class="mb-0">Recycle</h2>
                </div>
                <div class="">
                    <table id="customers">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Number of tasks</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recycleList as $list)
                            <tr>
                                <td>
                                    {{$list->name}}
                                </td>
                                <td>
                                    {{$list->numtask}}
                                </td>
                                <td>
                                    {{$list->created_at}}
                                </td>
                                <td>
                                    <a data-pjax class="btn btn-sm btn-primary"
                                       href="{{route('list.recover',['code'=>$list->link])}}">Recover List</a>
                                    <a data-pjax data-index="{{$list->id}}" id="Delete{{$list->id}}"
                                       class="btn btn-sm btn-primary delete_l" style="color: whitesmoke"> Delete </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div data-pjax class="col-md-12 text-center">
                        <ul class="pagination">
                            {{$recycleList->links()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<dialog id="deletelistdialog1">
    <form data-pjax method="post" action="{{route('delete.list')}}">
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
    $(function () {
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