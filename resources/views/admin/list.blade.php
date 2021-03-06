@extends('admin.master')

@section('content')
    <title>Manage List</title>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">{{$lists->table_name}}</h3>
                </div>
                <div class="table-responsive">
                    <table id="customers">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Create at</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Option</th>
                        </tr>
                        </thead>
                        <tbody id="tbody-list">
                        @foreach($lists as $list)
                            <tr>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                       href="{{route('link.board',['code'=>$list->link])}}">{{$list->link}}</a>
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
                                    <a data-pjax href="{{route('admin.user').'?list_id='.$list->id}}"
                                       class="btn btn-sm btn-primary" style="color: whitesmoke"> Worker </a>
                                    @if(Auth::user()->level==2)
                                        <a data-index="{{$list->id}}" id="Delete{{$list->id}}"
                                           class="btn btn-sm btn-primary delete_l" style="color: whitesmoke">
                                            Delete </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div data-pjax class="col-md-12 text-center" id="paginate-div">
                        {{$lists->links()}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center" id="paginate-search" style="display: none">
                        <ul class="pagination">
                            <li class="page-item" id="page-search-pre"><span class="page-link">&laquo;</span></li>
                            <li class="page-item active"><span id="page-search-current" class="page-link">1</span></li>
                            <li class="page-item" id="page-search-next"><span class="page-link">&raquo;</span></li>
                        </ul>
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
            $('#nav-list').css('background-color', 'grey');
            $('#nav-user').css('background-color', 'white');
        });
    </script>
    <script type="text/javascript">
        $('#search-user').hide();
        $('#search-list').show();
        try {
            var check = 0;
            var temp1 = '';

            function setNewEvent_List() {
                var dialog_delete = document.querySelector('#deletelistdialog1');
                if (dialog_delete === null) return;
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
            }

            $('#search-list').on('keyup', function () {
                let search = $('#search-list').val();
                if (search !== '') {
                    check++;
                    if (check === 1) {
                        temp1 = $('#tbody-list').html();
                    }
                    $('#paginate-div').hide();
                    $('#paginate-search').show();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('searchList') }}',
                        dataType: 'json',
                        data: {
                            'search': search,
                            'page': 1,
                            'admin': true
                        },
                        success: function (data) {
                            $('#tbody-list').html(data.table_data);
                            $('#page-search-current').html(data.page_current);
                            $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
                            $(document).on('submit', 'form[data-pjax]', function (event) {
                                $.pjax.submit(event, '#page');
                            });
                            // does current browser support PJAX
                            if ($.support.pjax) {
                                $.pjax.defaults.timeout = 2000; // time in milliseconds
                            }
                            setNewEvent_List();
                        }
                    });
                } else {
                    check = 0;
                    $('#paginate-div').show();
                    $('#paginate-search').hide();
                    $('#tbody-list').html(temp1);
                    $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
                    $(document).on('submit', 'form[data-pjax]', function (event) {
                        $.pjax.submit(event, '#page');
                    });
                    // does current browser support PJAX
                    if ($.support.pjax) {
                        $.pjax.defaults.timeout = 2000; // time in milliseconds
                    }
                }
                setNewEvent_List();
            });
            $('#page-search-pre').click(function () {
                var page = Number($('#page-search-current').html());
                if (page !== 1) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('searchList') }}',
                        dataType: 'json',
                        data: {
                            'search': $('#search-list').val(),
                            'page': page - 1,
                            'admin': true
                        },
                        success: function (data) {
                            $('#tbody-list').html(data.table_data);
                            $('#page-search-current').html(data.page_current);
                            $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
                            $(document).on('submit', 'form[data-pjax]', function (event) {
                                $.pjax.submit(event, '#page');
                            });
                            // does current browser support PJAX
                            if ($.support.pjax) {
                                $.pjax.defaults.timeout = 2000; // time in milliseconds
                            }
                            setNewEvent_List();
                        }
                    });
                }
            });
            $('#page-search-next').click(function () {
                var page = Number($('#page-search-current').html());
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('searchList') }}',
                    dataType: 'json',
                    data: {
                        'search': $('#search-list').val(),
                        'page': page + 1,
                        'admin': true
                    },
                    success: function (data) {
                        $('#tbody-list').html(data.table_data);
                        $('#page-search-current').html(data.page_current);
                        $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
                        $(document).on('submit', 'form[data-pjax]', function (event) {
                            $.pjax.submit(event, '#page');
                        });
                        // does current browser support PJAX
                        if ($.support.pjax) {
                            $.pjax.defaults.timeout = 2000; // time in milliseconds
                        }
                        setNewEvent_List();
                    }
                });
            });
        } catch (e) {

        }
    </script>
@endsection
