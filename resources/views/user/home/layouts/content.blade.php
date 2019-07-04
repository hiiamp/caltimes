<div class="colorlib-blog">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                <!--<h2>My board</h2>-->
            </div>
        </div>
        <div class="row display">

            @foreach($lists as $list)
                <div class="col-md-2 col-sm-3 col-xs-6 text-center animate-box">
                    <div class="product-entry">
                        <div class="product-img">
                            <article>
                                <h2>{{$list->name}}</h2>
                                <p class="admin"><span>{{$list->created_at}}</span></p>
                                @if($list->is_public==1)
                                    <p><span><i class="icon-globe"></i></span> Public <br></p>
                                @else
                                    <p><span><i class="icon-globe"></i></span> Private <br></p>
                                @endif
                                <p><span><i class="icon-location-2"></i></span> {{$list->owner->name}} <br></p>
                                <p><span><i class="icon-eye2"></i></span> Member: {{$list->member}} <br></p>
                                <p><a href="{{route('link.board', ['code' => $list->link])}}" class="btn btn-primary btn-outline with-arrow">See more</a></p>
                                <!--<div class="cart">
                                    <p class="breadcrumbs" style="font-size: small">
                                        <span>
                                            <a class="sharewith" >Share with</a>
                                        </span>
                                        <span>
                                            <a >Delete</a>
                                        </span>
                                    </p>
                                </div>-->
                            </article>
                        </div>
                    </div>
                </div>
            @endforeach

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
    var dialog1 = document.querySelector('#sharewithdialog');
    document.querySelector('.sharewith').onclick = function() {
        dialog1.showModal();
    };
    document.querySelector('#share').onclick = function() {
        dialog1.close();
    };
    document.querySelector('#cancelshare').onclick = function() {
        dialog1.close();
    };
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
                $('.display').html(data.table_data);
                console.log(data.total_data);
            }
        });
    })
</script>
