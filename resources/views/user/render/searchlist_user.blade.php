@foreach($lists as $list)
    <div class="col-md-2 col-sm-3 col-xs-6 text-center">
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