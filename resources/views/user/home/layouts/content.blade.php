<div class="colorlib-blog colorlib-blog1" style="padding-top: 250px;">
    <div class="container-fluid" style="position: fixed; width: 100%">
        <div class="row display">
            @foreach($lists as $list)
                <div class="col-md-2 col-sm-3 col-xs-6 text-center animate-box">
                    <div class="product-entry">
                        <div class="product-img">
                            <article>
                                <h3 class="title_item_home">{{$list->name}}</h3>
                                <p class="admin margin_home"><span>{{$list->created_at}}</span></p>
                                @if($list->is_public==1)
                                    <p class="margin_home"><span><i class="icon-globe"></i></span> Public <br></p>
                                @else
                                    <p class="margin_home"><span><i class="icon-globe"></i></span> Private <br></p>
                                @endif
                                <p class="margin_home"><span><i class="icon-location-2"></i></span> {{$list->owner->name}} <br></p>
                                <p class="margin_home"><span><i class="icon-eye2"></i></span> Member: {{$list->member}} <br></p>
                                <p class="margin_home"><a data-pjax href="{{route('link.board', ['code' => $list->link])}}" class="btn btn-primary btn-outline with-arrow">See more</a></p>
                            </article>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div style="padding-top: 425px;" class="row">
    <div data-pjax class="col-md-12 text-center" id="paginate-home">
    {{$lists->links()}}
    </div>
    <div class="col-md-12 text-center" id="paginate-search" style="display: none">
        <ul class="pagination">
            <li class="page-item" id="page-search-pre"><span class="page-link">&laquo;</span></li>
            <li class="page-item active"><span id="page-search-current" class="page-link">0</span></li>
            <li class="page-item" id="page-search-next"><span class="page-link">&raquo;</span></li>
        </ul>
    </div>
</div>
<dialog id="sharewithdialog">
    <form method="post" action="">
        @csrf
        <div class="row form-group">
            <div class="col-md-12">
                <p>Input email of user that you want to share</p>
                <input id="email" type="email" class="form-control" name="email" required autofocus placeholder="Email you want to share">
            </div>
        </div>
        <div class="form-group">
            <input id="share" type="submit" value="Share" class="btn btn-primary">
            <input id="cancelshare" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>
<script>
    /*var dialog1 = document.querySelector('#sharewithdialog');
    document.querySelector('.sharewith').onclick = function() {
        dialog1.showModal();
    };
    document.querySelector('#share').onclick = function() {
        dialog1.close();
    };
    document.querySelector('#cancelshare').onclick = function() {
        dialog1.close();
    };*/
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#searchTask').hide();
        $('#search').show();
    });
    var check2 = 0;
    var temp2 = '';
    var search_temp = '';
    $('#search').on('keyup',function(){
        let search = $('#search').val();
        if(search !== '') {
            if(search_temp === search) return;
            search_temp = search;
            check2++;
            if(check2 === 1) {
                temp2 = $('.display').html();
            }
            $('#paginate-home').hide();
            $('#paginate-search').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '{{ route('searchList') }}',
                dataType: 'json',
                data:{'search':search,
                      'page': 1},
                success:function(data){
                    $('.display').html(data.table_data);
                    $('#page-search-current').html(data.page_current);
                }
            });
        } else {
            check2 = 0;
            $('.display').html(temp2);
            $('#paginate-home').show();
            $('#paginate-search').hide();
            search_temp = '';
        }
    });
    $('#page-search-pre').click(function () {
        var page = Number($('#page-search-current').html());
        if (page !== 1) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '{{ route('searchList') }}',
                dataType: 'json',
                data:{'search':$('#search').val(),
                    'page': page - 1},
                success:function(data){
                    $('.display').html(data.table_data);
                    $('#page-search-current').html(data.page_current);
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
            url : '{{ route('searchList') }}',
            dataType: 'json',
            data:{'search':$('#search').val(),
                'page': page + 1},
            success:function(data){
                $('.display').html(data.table_data);
                $('#page-search-current').html(data.page_current);
            }
        });
    });
    if($(window).height() > 700) {
        $('#paginate-home').show();
    }
</script>
