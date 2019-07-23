@extends('admin.master')
@section('content')
    <title>Manage User</title>
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
                        <tbody id="tbody-user">
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
                                    <a data-pjax href="{{route('admin.list').'?user_id='.$user->id}}"
                                       class="btn btn-sm btn-primary" style="color: whitesmoke"> List joined </a>
                                    <input id="vip{{$user->id}}" data-index="{{$user->id}}" type="button"
                                           class="btn btn-sm btn-primary vip_user" style="color: whitesmoke"
                                           @if($user->isVip) value="Remove Vip" @else value="Add Vip" @endif>
                                    @if($user->level != 2)
                                        <a data-index="{{$user->id}}" class="btn btn-sm btn-primary delete_u"
                                           style="color: whitesmoke"> Delete </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div data-pjax class="col-md-12 text-center" id="paginate-div">
                        {{$users->links()}}
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
        $('.vip_user').each(function () {
            $(this).click(function () {
                var user_id = $(this).attr('data-index');
                $.ajax({
                    url: '{{ route('toggle.vip') }}',
                    dataType: 'json',
                    data: {'user_id': user_id},
                    success: function (data) {
                        var temp = '#vip' + user_id;
                        if (data.success)
                            if (data.vip) {
                                $(temp).attr('value', 'Remove Vip');
                            } else {
                                $(temp).attr('value', 'Add Vip');
                            }
                    }
                });
            });
        });
        $('#search-list').hide();
        $('#search-user').show();
        $(function () {
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
            $('#nav-user').css('background-color', 'grey');
            $('#nav-list').css('background-color', 'white');
        });
    </script>

    <script type="text/javascript">
        try {
            var check1 = 0;
            var temp3 = '';

            function setNewEvent() {
                var dialog_delete2 = document.querySelector('#deleteuserdialog1');
                if (dialog_delete2 === null) return;
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
            }

            $('#search-user').on('keyup', function () {
                let search = $('#search-user').val();
                if (search !== '') {
                    check1++;
                    if (check1 === 1) {
                        temp3 = $('#tbody-user').html();
                    }
                    $('#paginate-div').hide();
                    $('#paginate-search').show();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('searchUser') }}',
                        dataType: 'json',
                        data: {'search': search, 'page': 1},
                        success: function (data) {
                            $('#page-search-current').html(data.page_current);
                            $('#tbody-user').html(data.table_data);
                            $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
                            $(document).on('submit', 'form[data-pjax]', function (event) {
                                $.pjax.submit(event, '#page');
                            });
                            // does current browser support PJAX
                            if ($.support.pjax) {
                                $.pjax.defaults.timeout = 2000; // time in milliseconds
                            }
                            setNewEvent();
                        }
                    });
                } else {
                    check1 = 0;
                    $('#paginate-div').show();
                    $('#paginate-search').hide();
                    $('#tbody-user').html(temp3);
                    $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
                    $(document).on('submit', 'form[data-pjax]', function (event) {
                        $.pjax.submit(event, '#page');
                    });
                    // does current browser support PJAX
                    if ($.support.pjax) {
                        $.pjax.defaults.timeout = 2000; // time in milliseconds
                    }
                }
                setNewEvent();
            });
            $('#page-search-pre').click(function () {
                var page = Number($('#page-search-current').html());
                if (page !== 1) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('searchUser') }}',
                        dataType: 'json',
                        data: {'search': $('#search-user').val(), 'page': page - 1},
                        success: function (data) {
                            $('#page-search-current').html(data.page_current);
                            $('#tbody-user').html(data.table_data);
                            $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
                            $(document).on('submit', 'form[data-pjax]', function (event) {
                                $.pjax.submit(event, '#page');
                            });
                            // does current browser support PJAX
                            if ($.support.pjax) {
                                $.pjax.defaults.timeout = 2000; // time in milliseconds
                            }
                            setNewEvent();
                        }
                    });
                }
            });
            $('#page-search-next').click(function () {
                var page = Number($('#page-search-current').html());
                console.log(page);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('searchUser') }}',
                    dataType: 'json',
                    data: {'search': $('#search-user').val(), 'page': page + 1},
                    success: function (data) {
                        $('#page-search-current').html(data.page_current);
                        $('#tbody-user').html(data.table_data);
                        $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
                        $(document).on('submit', 'form[data-pjax]', function (event) {
                            $.pjax.submit(event, '#page');
                        });
                        // does current browser support PJAX
                        if ($.support.pjax) {
                            $.pjax.defaults.timeout = 2000; // time in milliseconds
                        }
                        setNewEvent();
                    }
                });
            });
        } catch (e) {

        }
    </script>
    @include('user.layouts.notification')
@endsection
